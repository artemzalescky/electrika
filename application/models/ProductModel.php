<?php

namespace application\models;

use application\models\dao\ProductDAO;
use ph\exception\PhException;
use ph\phAdmin\application\models\CurrencyModel;
use ph\utils\FileUtil;
use ph\utils\Util;

class ProductModel {
    private static $instance;
    private $productDAO;

    private function __construct() {
        $this->productDAO = new ProductDAO();
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function get($catalogId, $getFullInfo = true) {
        try {
            $products = $this->productDAO->get($catalogId);
            $this->sortByPriority($products);
            if ($getFullInfo) {
                $this->provideFullInfo($products, $catalogId);
            }
            return $products;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getById($catalogId, $productId) {
        try {
            return $this->productDAO->getById($catalogId, $productId);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function calculateFullProductsUrl(&$products, $parentFullUrl) {
        $prefix = trim($parentFullUrl, '/');
        if (strpos($prefix, 'catalog/') === 0) {
            $prefix = substr($prefix, strlen('catalog/'));
        }
        $prefix = '/product/' . $prefix;

        for ($i = 0; $i < count($products); $i++) {
            $products[$i]['fullUrl'] = $prefix . '/' . $products[$i]['id'];
        }
    }

    public function checkProductExist($catalogId, $productId) {
        $productView = ['catalogId' => $catalogId, 'id' => $productId];
        $errors = $this->getCatalogExistenceValidationErrors($productView);
        $errors = array_merge($errors, $this->getProductExistenceValidationErrors($productView));
        if (!empty($errors)) {
            PhException::throwErrors($errors);
        }
    }

    public function create($product) {
        $validationErrors = $this->validateProduct($product);
        if (!empty($validationErrors)) {
            PhException::throwErrors($validationErrors);
        }
        $product = $this->prepareForSaving($product);
        return $this->productDAO->add($product);
    }

    public function update($product) {
        $validationErrors = $this->validateProduct($product);
        if (!empty($validationErrors)) {
            PhException::throwErrors($validationErrors);
        }
        $product = $this->prepareForSaving($product);
        return $this->productDAO->update($product);
    }

    public function updatePriceByr($product) {
        $product['priceByr'] = CurrencyModel::getInstance()->convertWithRounding($product['priceUsd']);
        return $this->productDAO->updatePriceByr($product);
    }

    public function updatePriceByrForAll($catalogId) {
        $products = $this->get($catalogId, false);
        for ($i = 0; $i < count($products); $i++) {
            $products[$i]['priceByr'] = CurrencyModel::getInstance()->convertWithRounding($products[$i]['priceUsd']);
            $products[$i]['catalogId'] = $catalogId;
        }
        return $this->productDAO->updatePriceByrForAll($products);
    }

    public function delete($catalogId, $productId) {
        $this->checkProductExist($catalogId, $productId);
        return $this->productDAO->delete($catalogId, $productId);
    }

    public function createProductsTable($catalogId) {
        return $this->productDAO->createProductsTable($catalogId);
    }

    public function deleteProductsTable($catalogId) {
        return $this->productDAO->deleteProductsTable($catalogId);
    }

    public function productTableExist($catalogId) {
        try {
            $this->productDAO->productsTableExist($catalogId);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getImagesDir($catalogId = null) {
        $base = 'resources/images/product/';
        if (empty($catalogId)) {
            return $base;
        }
        return $base . $catalogId . '/';
    }

    public function getImagePath($catalogId, $productId) {
        return $this->getImagesDir($catalogId) . $productId . '.jpeg';
    }

    public function deleteImage($catalogId, $productId) {
        return FileUtil::deleteFile($this->getImagePath($catalogId, $productId));
    }

    public function imageExist($catalogId, $productId) {
        return FileUtil::fileExist($this->getImagePath($catalogId, $productId));
    }

    public function getMaxImageSizeToUpload() {
        return FileUtil::getMaxFileSizeToUpload();
    }

    private function validateProduct($product) {
        $errors = $this->getCatalogExistenceValidationErrors($product);
        $errors = array_merge($errors, $this->getNameValidationErrors($product));
        $errors = array_merge($errors, $this->getPriorityValidationErrors($product));
        return $errors;
    }

    private function getCatalogExistenceValidationErrors($product) {
        $errors = [];
        if (!CatalogModel::getInstance()->catalogExist($product['catalogId'])) {
            $errors['Catalog_IdNotFound'] = 1;
            return $errors;
        }
        if (!$this->productTableExist($product['catalogId'])) {
            $errors['Product_TableNotFound'] = 1;
            return $errors;
        }
        return $errors;
    }

    private function getProductExistenceValidationErrors($product) {
        $realProduct = $this->getById($product['catalogId'], $product['id']);
        if (empty($realProduct)) {
            return ['Product_IdNotFound' => 1];
        }
        return [];
    }

    private function getNameValidationErrors($product) {
        $errors = [];
        if (Util::isEmpty($product['name'])) {
            $errors['Product_EmptyName'] = 1;
            return $errors;
        }
        return $errors;
    }

    private function getPriorityValidationErrors($product) {
        $errors = [];
        $priority = $this->convertPriority($product);
        if ($priority < 0 || $priority >= 100) {
            $errors['Product_PriorityOutOfBounds'] = 1;
            return $errors;
        }
        return $errors;
    }

    private function convertPriority($product) {
        return intval($product['priority']);
    }

    private function prepareForSaving($product) {
        $resProduct = $product;
        $resProduct['priority'] = intval($product['priority']);
        $resProduct['priceUsd'] = !empty($product['priceUsd']) ? str_replace(',', '.', $product['priceUsd']) : 0;
        if (empty($resProduct['priceByr'])) {
            $resProduct['priceByr'] = CurrencyModel::getInstance()->convertWithRounding($resProduct['priceUsd']);
        }
        return $resProduct;
    }

    private function provideFullInfo(&$productList, $catalogId) {
        for ($i = 0; $i < count($productList); $i++) {
            $this->provideFullInfoAboutOne($productList[$i], $catalogId);
        }
    }

    private function provideFullInfoAboutOne(&$product, $catalogId) {
        $product['catalogId'] = $catalogId;
        if ($this->imageExist($catalogId, $product['id'])) {
            $product['imagePath'] = $this->getImagePath($catalogId, $product['id']);
        }
    }

    private function sortByPriority(&$productList) {
        if (!empty($productList)) {
            usort($productList, "self::priorityComparator");
        }
    }

    private static function priorityComparator($p1, $p2) {
        $priorityDif = intval($p2['priority']) - intval($p1['priority']);
        if ($priorityDif !== 0) {
            return $priorityDif;
        }
        return intval($p1['id']) - intval($p2['id']);
    }
}
