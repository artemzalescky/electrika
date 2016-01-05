<?php

namespace application\models;

use application\models\dao\SpecialOfferDAO;

class SpecialOfferModel {
    private static $instance;
    private $specialOfferDAO;

    private function __construct() {
        $this->specialOfferDAO = new SpecialOfferDAO();
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getProducts() {
        $specialOffers = $this->specialOfferDAO->get();

        $products = [];
        foreach ($specialOffers as $specialOffer) {
            $product = ProductModel::getInstance()->getById($specialOffer['catalogId'], $specialOffer['productId']);
            $product['specialOfferDescription'] = $specialOffer['description'];
            $products[] = $product;
        }
        return $products;
    }

    public function getProductById($catalogId, $productId) {
        $specialOffer = $this->specialOfferDAO->getById($catalogId, $productId);
        $product = ProductModel::getInstance()->getById($specialOffer['catalogId'], $specialOffer['productId']);
        $product['specialOfferDescription'] = $specialOffer['description'];
        return $product;
    }

    public function create($specialOffer) {
        try {
            $this->specialOfferDAO->add($specialOffer);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($catalogId, $productId) {
        return $this->specialOfferDAO->delete($catalogId, $productId);
    }
}
