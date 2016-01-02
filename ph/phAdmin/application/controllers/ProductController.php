<?php

namespace ph\phAdmin\application\controllers;

use application\models\CatalogModel;
use application\models\ProductModel;
use ph\controller\BaseController;
use ph\exception\PhException;
use ph\sessions\flash\FlashMessageStorage as messages;
use ph\utils\FileUtil;
use ph\utils\ImageUtil;

class ProductController extends BaseController {

    public function __construct($inputData) {
        parent::__construct($inputData);
    }

    public function add($catalogId) {
        $catalog = CatalogModel::getInstance()->getById($catalogId);
        if (!empty($catalog)) {
            $product = $this->param('product');
            if (empty($product)) {
                $product['available'] = 1;
            } else {
                $product['available'] = !empty($product['available']) ? 1 : 0;
            }
            $product['catalogId'] = $catalogId;

            $this->setViewVariable('catalog', $catalog);
            $this->setViewVariable('product', $product);
            $this->render();
        } else {
            messages::add('Catalog_IdNotFound', 1, 'error');
            $this->systemRedirect("/catalog");
        }
    }

    public function create($catalogId) {
        if (!$this->isPostRequest()) exit;

        $product = $this->param('product');
        try {
            $product['catalogId'] = $catalogId;
            $product['available'] = !empty($product['available']) ? 1 : 0;
            ProductModel::getInstance()->create($product);
            messages::add('Product_Added', ['name' => $product['name']], 'success');
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $product['description'] = urlencode($product['description']);  //impossible to pass newLineChar to url
            $this->systemRedirect('/product/add/' . $catalogId . '?' . $this->array2ParamString($product, 'product'));
        }
    }

    public function edit($catalogId, $productId) {
        try {
            ProductModel::getInstance()->checkProductExist($catalogId, $productId);

            $catalog = CatalogModel::getInstance()->getById($catalogId);

            $realProduct = ProductModel::getInstance()->getById($catalogId, $productId);
            $product = $this->param('product');
            if (empty($product)) {
                $product = $realProduct;
            } else {
                $product['id'] = $productId;
            }

            $this->setViewVariable('catalog', $catalog);
            $this->setViewVariable('product', $product);
            $this->setViewVariable('realProduct', $realProduct);
            $this->render();
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        }
    }

    public function update($catalogId, $productId) {
        if (!$this->isPostRequest()) exit;

        try {
            ProductModel::getInstance()->checkProductExist($catalogId, $productId);
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        }

        try {
            $product = $this->param('product');
            $product['id'] = $productId;
            $product['catalogId'] = $catalogId;
            $product['available'] = !empty($product['available']) ? 1 : 0;
            ProductModel::getInstance()->update($product);
            messages::add('Product_Updated', ['name' => $product['name']], 'success');
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $product['description'] = urlencode($product['description']);  //impossible to pass newLineChar to url
            $this->systemRedirect('/product/edit/' . $catalogId . '/' . $productId . '?' . $this->array2ParamString($product, 'product'));
        }
    }

    public function copy($catalogId, $productId) {
        try {
            ProductModel::getInstance()->checkProductExist($catalogId, $productId);
            $product = ProductModel::getInstance()->getById($catalogId, $productId);
            $product['description'] = urlencode($product['description']);  //impossible to pass newLineChar to url
            $this->systemRedirect('/product/add/' . $catalogId . '?' . $this->array2ParamString($product, 'product', ['priceByr', 'priceUsd']));
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        }
    }

    public function convertPrice($catalogId, $productId) {
        try {
            ProductModel::getInstance()->checkProductExist($catalogId, $productId);

            $product = ProductModel::getInstance()->getById($catalogId, $productId);
            $product['catalogId'] = $catalogId;
            ProductModel::getInstance()->updatePriceByr($product);

            messages::add('Product_PriceConverted', ['name' => $product['name']], 'success');
            $this->redirectBack();
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        }
    }

    public function convertCatalogPrices($catalogId) {
        try {
            CatalogModel::getInstance()->checkCatalogExist($catalogId);

            $catalog = CatalogModel::getInstance()->getById($catalogId);
            ProductModel::getInstance()->updatePriceByrForAll($catalogId);

            messages::add('Product_CatalogPricesConverted', ['name' => $catalog['name']], 'success');
            $this->redirectBack();
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        }
    }

    public function convertAllPrices() {
        if (!$this->isPostRequest()) exit;

        try {
            $catalogs = CatalogModel::getInstance()->get();
            foreach ($catalogs as $catalog) {
                ProductModel::getInstance()->updatePriceByrForAll($catalog['id']);
            }

            messages::add('Product_AllPricesConverted', 1, 'success');
            $this->redirectBack();
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog');
        }
    }

    public function delete($catalogId, $productId) {
        try {
            ProductModel::getInstance()->checkProductExist($catalogId, $productId);

            $catalog = CatalogModel::getInstance()->getById($catalogId);
            $product = ProductModel::getInstance()->getById($catalogId, $productId);

            $this->setViewVariable('catalog', $catalog);
            $this->setViewVariable('product', $product);
            $this->render();
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        }
    }

    public function destroy($catalogId, $productId) {
        if (!$this->isPostRequest()) exit;

        try {
            ProductModel::getInstance()->checkProductExist($catalogId, $productId);
            $product = ProductModel::getInstance()->getById($catalogId, $productId);

            ProductModel::getInstance()->deleteImage($catalogId, $productId);
            ProductModel::getInstance()->delete($catalogId, $productId);

            messages::add('Product_Deleted', ['name' => $product['name']], 'success');
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        }
    }

    public function createTable($catalogId) {
        if (!$this->isPostRequest()) exit;

        if (CatalogModel::getInstance()->catalogExist($catalogId)) {
            ProductModel::getInstance()->createProductsTable($catalogId);
            messages::add('Product_TableCreated', 1, 'success');
            $this->redirectBack();
        } else {
            messages::add('Catalog_IdNotFound', 1, 'error');
            $this->redirectBack();
        }
    }

    public function uploadImage($catalogId, $productId) {
        try {
            ProductModel::getInstance()->checkProductExist($catalogId, $productId);

            $catalog = CatalogModel::getInstance()->getById($catalogId);
            $product = ProductModel::getInstance()->getById($catalogId, $productId);

            $this->setViewVariable('catalog', $catalog);
            $this->setViewVariable('product', $product);
            if (ProductModel::getInstance()->imageExist($catalogId, $productId)) {
                $this->setViewVariable('currentImagePath', ProductModel::getInstance()->getImagePath($catalogId, $productId));
            }
            $this->setViewVariable('maxImageSizeMb', ProductModel::getInstance()->getMaxImageSizeToUpload() / 1024 / 1024);
            $this->render();
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        }
    }

    public function saveImage($catalogId, $productId) {
        if (!$this->isPostRequest()) exit;

        try {
            $uploadedFile = $_FILES['productImage'];
            if (empty($uploadedFile) || $uploadedFile['error'] != 0) {
                messages::add('Product_ImageNotUploaded', 1, 'error');
                $this->redirectBack();
            }

            $fileExt = FileUtil::getFileExtension($uploadedFile['name']);
            if (!in_array($fileExt, ImageUtil::getSupportedExtension())) {
                messages::add('Product_InvalidImageFormat', 1, 'error');
                $this->redirectBack();
            }

            $imgDir = ProductModel::getInstance()->getImagesDir($catalogId);
            FileUtil::createDirIfNotExist($imgDir);
            $targetFilename = $productId . '.' . $fileExt;

            move_uploaded_file($uploadedFile['tmp_name'], $imgDir . $targetFilename);
            ImageUtil::convertToJpeg($imgDir . $targetFilename);

            messages::add('Product_ImageSaved', 1, 'success');
            $this->systemRedirect('/catalog/editProducts/' . $catalogId);
        } catch (PhException $e) {
            messages::add('Product_ImageUploadError', 1, 'success');
            $this->redirectBack();
        }
    }
}
