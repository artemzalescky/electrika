<?php

namespace ph\phAdmin\application\controllers;

use application\models\CatalogModel;
use application\models\ProductModel;
use ph\controller\BaseController;
use ph\exception\PhException;
use ph\sessions\flash\FlashMessageStorage as messages;
use ph\utils\FileUtil;
use ph\utils\ImageUtil;

class CatalogController extends BaseController {

    public function index() {
        $this->setViewVariable('catalogTree', CatalogModel::getInstance()->getFullCatalogTree());
        $this->render();
    }

    public function get() {
        $this->renderJson(CatalogModel::getInstance()->get(), 'UTF-8');
    }

    public function addSubcatalog($parentCatalogId) {
        if (intval($parentCatalogId) !== 0) {
            $parentCatalog = CatalogModel::getInstance()->getById($parentCatalogId);
        } else {
            $parentCatalog = CatalogModel::getInstance()->getRootCatalog();
        }

        if (!empty($parentCatalog)) {
            $this->setViewVariable('parentCatalog', $parentCatalog);
            $this->render();
        } else {
            messages::add('Catalog_IdNotFound', 1, 'error');
            $this->systemRedirect('/catalog');
        }
    }

    public function create($parentCatalogId) {
        if (!$this->isPostRequest()) exit;

        $catalog = $this->param('catalog');
        try {
            $catalog['parent_id'] = $parentCatalogId;
            CatalogModel::getInstance()->create($catalog);
            messages::add('Catalog_Added', ['name' => $catalog['name']], 'success');
            $this->systemRedirect('/catalog');
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog/addSubcatalog/' . $parentCatalogId . '?' . $this->array2ParamString($catalog, 'catalog'));
        }
    }

    public function edit($catalogId) {
        $catalog = $this->param('catalog');
        if (empty($catalog)) {
            $catalog = CatalogModel::getInstance()->getById($catalogId);
        }

        if (!empty($catalog)) {
            $this->setViewVariable('catalog', $catalog);
            $this->render();
        } else {
            messages::add('Catalog_IdNotFound', 1, 'error');
            $this->systemRedirect('/catalog');
        }
    }

    public function update($catalogId) {
        if (!$this->isPostRequest()) exit;

        $catalog = $this->param('catalog');
        $catalog['id'] = $catalogId;
        try {
            CatalogModel::getInstance()->update($catalog);
            messages::add('Catalog_Updated', ['name' => $catalog['name']], 'success');
            $this->systemRedirect('/catalog/edit/' . $catalogId);
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog/edit/' . $catalogId . '?' . $this->array2ParamString($catalog, 'catalog'));
        }
    }

    public function editDescription($catalogId) {
        $catalog = CatalogModel::getInstance()->getById($catalogId);

        if (!empty($catalog)) {
            $this->setViewVariable('catalog', $catalog);
            $this->render();
        } else {
            messages::add('Catalog_IdNotFound', 1, 'error');
            $this->systemRedirect('/catalog');
        }
    }

    public function updateDescription($catalogId) {
        if (!$this->isPostRequest()) exit;

        $catalog = $this->param('catalog');
        $catalog['id'] = $catalogId;
        try {
            CatalogModel::getInstance()->updateDescription($catalog);
            messages::add('Catalog_DescriptionUpdated', ['name' => $catalog['name']], 'success');
            $this->redirectBack();
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->redirectBack();
        }
    }

    public function delete($catalogId) {
        $catalog = CatalogModel::getInstance()->getById($catalogId);

        if (!empty($catalog)) {
            $this->setViewVariable('catalog', $catalog);
            $this->render();
        } else {
            messages::add('Catalog_IdNotFound', 1, 'error');
            $this->systemRedirect('/catalog');
        }
    }

    public function destroy($catalogId) {
        if (!$this->isPostRequest()) exit;

        try {
            $catalog = CatalogModel::getInstance()->getById($catalogId);
            if (empty($catalog)) {
                PhException::throwErrors(['Catalog_IdNotFound' => 1]);
            }

            FileUtil::deleteDir(ProductModel::getInstance()->getImagesDir($catalogId));
            if (CatalogModel::getInstance()->imageExist($catalogId)) {
                CatalogModel::getInstance()->deleteImage($catalogId);
            }
            ProductModel::getInstance()->deleteProductsTable($catalogId);
            CatalogModel::getInstance()->delete($catalogId);

            messages::add('Catalog_Deleted', ['name' => $catalog['name']], 'success');
            $this->systemRedirect('/catalog');
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog');
        }
    }

    public function editProducts($catalogId) {
        try {
            $catalog = CatalogModel::getInstance()->checkCatalogExist($catalogId);
            $this->setViewVariable("catalog", $catalog);
            if (ProductModel::getInstance()->productTableExist($catalogId)) {
                $this->setViewVariable("products", ProductModel::getInstance()->get($catalogId));
            }
            $this->render();
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->redirectBack();
        }
    }

    public function uploadImage($catalogId) {
        $catalog = CatalogModel::getInstance()->getById($catalogId);

        if (!empty($catalog)) {
            $this->setViewVariable('catalog', $catalog);
            if (CatalogModel::getInstance()->imageExist($catalogId)) {
                $this->setViewVariable('currentImagePath', CatalogModel::getInstance()->getImagePath($catalogId));
            }
            $this->setViewVariable('maxImageSizeMb', CatalogModel::getInstance()->getMaxImageSizeToUpload() / 1024 / 1024);
            $this->render();
        } else {
            messages::add('Catalog_IdNotFound', 1, 'error');
            $this->systemRedirect('/catalog');
        }
    }

    public function saveImage($catalogId) {
        if (!$this->isPostRequest()) exit;

        try {
            $uploadedFile = $_FILES['catalogImage'];
            if (empty($uploadedFile) || $uploadedFile['error'] != 0) {
                messages::add('Catalog_ImageNotUploaded', 1, 'error');
                $this->redirectBack();
            }

            $fileExt = FileUtil::getFileExtension($uploadedFile['name']);
            if (!in_array($fileExt, ImageUtil::getSupportedExtension())) {
                messages::add('Catalog_InvalidImageFormat', 1, 'error');
                $this->redirectBack();
            }

            $imgDir = CatalogModel::getInstance()->getImagesDir();
            FileUtil::createDirIfNotExist($imgDir);
            $targetFilename = $catalogId . '.' . $fileExt;

            move_uploaded_file($uploadedFile['tmp_name'], $imgDir . $targetFilename);
            ImageUtil::convertToJpeg($imgDir . $targetFilename);

            messages::add('Catalog_ImageSaved', 1, 'success');
            $this->redirectBack();
        } catch (\Exception $e) {
            messages::add('Catalog_ImageUploadError', 1, 'success');
            $this->redirectBack();
        }
    }
}
