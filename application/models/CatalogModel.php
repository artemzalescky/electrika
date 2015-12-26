<?php

namespace application\models;

use application\models\dao\CatalogDAO;
use ph\exception\PhException;
use ph\utils\FileUtil;
use ph\utils\Util;

class CatalogModel {
    private static $instance;
    private $catalogDAO;

    private function __construct() {
        $this->catalogDAO = new CatalogDAO();
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function get() {
        try {
            return $this->catalogDAO->get();
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getById($id) {
        try {
            return $this->catalogDAO->getById($id);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getByUrl($url) {
        try {
            return $this->catalogDAO->getByUrl($url);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getNearestChildren($id) {
        try {
            $children = $this->catalogDAO->getNearestChildren($id);
            $this->sortByPriority($children);
            return $children;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getPathToCatalogById($id) {
        return $this->getPathToCatalogFor($this->getById($id));
    }

    public function getPathToCatalogByUrl($url) {
        return $this->getPathToCatalogFor($this->getByUrl($url));
    }

    public function getFullCatalogTree() {
        try {
            return $this->getFullCatalogTreeFor($this->getRootCatalog(), $this->get());
        } catch (\Exception $e) {
            return [];
        }
    }

    public function catalogExist($id) {
        $catalog = $this->getById($id);
        return !empty($catalog);
    }

    public function catalogExistForUrl($url) {
        $catalog = $this->getByUrl($url);
        return !empty($catalog);
    }

    public function create($catalog) {
        $validationErrors = $this->validateCatalog($catalog);
        if (!empty($validationErrors)) {
            PhException::throwErrors($validationErrors);
        }
        $catalog['url'] = strtolower(str_replace(' ', '-', $catalog['url']));
        return $this->catalogDAO->add($catalog);
    }

    public function update($catalog) {
        $this->checkCatalogExist($catalog['id']);
        $validationErrors = $this->validateCatalog($catalog);
        if (!empty($validationErrors)) {
            PhException::throwErrors($validationErrors);
        }
        return $this->catalogDAO->update($catalog);
    }

    public function updateDescription($catalog) {
        $this->checkCatalogExist($catalog['id']);
        return $this->catalogDAO->updateDescription($catalog);
    }

    public function delete($id) {
        $this->checkCatalogExist($id);
        return $this->catalogDAO->delete($id);
    }

    public function checkCatalogExist($id) {
        $catalog = $this->catalogDAO->getById($id);
        if (empty($catalog)) {
            PhException::throwErrors(['Catalog_IdNotFound' => 1]);
        }
        return $catalog;
    }

    public function getRootCatalog() {
        return [
            'id' => 0,
            'parentId' => null,
            'name' => 'Каталог',
            'url' => 'catalog'
        ];
    }

    public function getImagesDir() {
        return 'resources/images/catalog/';
    }

    public function getImagePath($catalogId) {
        return $this->getImagesDir() . $catalogId . '.jpeg';
    }

    public function deleteImage($catalogId) {
        return FileUtil::deleteFile($this->getImagePath($catalogId));
    }

    public function imageExist($catalogId) {
        return FileUtil::fileExist($this->getImagePath($catalogId));
    }

    public function getMaxImageSizeToUpload() {
        return FileUtil::getMaxFileSizeToUpload();
    }

    private function getFullCatalogTreeFor($root, $catalogList) {
        $root['_children'] = null;
        foreach ($catalogList as $catalog) {
            if (intval($catalog['parentId']) === intval($root['id'])) {
                $root['_children'][] = $this->getFullCatalogTreeFor($catalog, $catalogList);
            }
        }
        $this->sortByPriority( $root['_children']);
        return $root;
    }

    private function getPathToCatalogFor($catalog) {  // TODO - ADD FIELD FULL URL
        try {
            $res = [];
            $parent = $catalog;
            if (!empty($catalog)) {
                $res[] = $parent;
                while (!empty($parent) && !empty($parent['parentId'])) {
                    $parent = $this->getById($parent['parentId']);
                    $res[] = $parent;
                }
            }
            $res[] = $this->getRootCatalog();
            $res = array_reverse($res);
            return $res;
        } catch (\Exception $e) {
            return [];
        }
    }

    private function validateCatalog($catalog) {
        $errors = $this->getNameValidationErrors($catalog);
        $errors = array_merge($errors, $this->getUrlValidationErrors($catalog));
        $errors = array_merge($errors, $this->getPriorityValidationErrors($catalog));
        return $errors;
    }

    private function getNameValidationErrors($catalog) {
        $errors = [];
        if (Util::isEmpty($catalog['name'])) {
            $errors['Catalog_EmptyName'] = 1;
            return $errors;
        }
        return $errors;
    }

    private function getUrlValidationErrors($catalog) {
        $errors = [];
        if (Util::isEmpty($catalog['url'])) {
            $errors['Catalog_EmptyUrl'] = 1;
            return $errors;
        }
        $catalogWithSameUrl = $this->catalogDAO->getByUrl($catalog['url']);
        if (!Util::isEmpty($catalogWithSameUrl) && $catalogWithSameUrl['id'] !== $catalog['id']) {
            $errors['Catalog_ExistingUrl'] = ['url' => $catalog['url']];
        }
        return $errors;
    }

    private function getPriorityValidationErrors($catalog) {
        $errors = [];
        $priority = $this->convertPriority($catalog);
        if ($priority < 0 || $priority >= 100) {
            $errors['Catalog_PriorityOutOfBounds'] = 1;
            return $errors;
        }
        return $errors;
    }

    private function convertPriority($catalog) {
        return intval($catalog['priority']);
    }

    private function sortByPriority(&$catalogList) {
        if (!empty($catalogList)) {
            usort($catalogList, "self::priorityComparator");
        }
    }

    private static function priorityComparator($catalog1, $catalog2) {
        $priorityDif = intval($catalog2['priority']) - intval($catalog1['priority']);
        if ($priorityDif !== 0) {
            return $priorityDif;
        }
        return intval($catalog1['id']) - intval($catalog2['id']);
    }
}
