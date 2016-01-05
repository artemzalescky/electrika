<?php

namespace application\models\dao;

use ph\db\DbDataAccessObject;

class SpecialOfferDAO extends DbDataAccessObject {

    public function __construct() {
        parent::__construct('special_offer');
    }

    public function get() {
        return parent::get();
    }

    public function getById($catalogId, $productId) {
        return parent::getBy([
            'catalog_id' => $catalogId,
            'product_id' => $productId
        ])[0];
    }

    public function add($specialOffer) {
        return parent::add([
            'catalog_id' => $specialOffer['catalogId'],
            'product_id' => $specialOffer['productId'],
            'description' => $specialOffer['description']
        ]);
    }

    public function delete($catalogId, $productId) {
        return parent::deleteBy([
            'catalog_id' => $catalogId,
            'product_id' => $productId
        ]);
    }
}
