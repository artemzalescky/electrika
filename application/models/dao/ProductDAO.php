<?php

namespace application\models\dao;

use ph\db\DbAccessor;

class ProductDAO extends DbAccessor {

    public function __construct() {
        parent::__construct();
    }

    public function get($catalogId) {
        $sql = "SELECT * FROM product_{$catalogId}";
        return $this->select($sql);
    }

    public function getById($catalogId, $productId) {
        $sql = "SELECT * FROM product_{$catalogId} WHERE id = '$productId'";
        $products = $this->select($sql);
        return !empty($products) ? $products[0] : null;
    }

    public function add($product) {
        $sql = "INSERT INTO product_{$product['catalogId']} (name, description, priority, measure, available, price_usd, price_byr) VALUES ("
                ."'{$product['name']}',"
                ."'{$product['description']}',"
                ."'{$product['priority']}',"
                ."'{$product['measure']}',"
                ."'{$product['available']}',"
                ."'{$product['priceUsd']}',"
                ."'{$product['priceByr']}'"
            .")";
        return $this->execute($sql);
    }

    public function update($product) {
        $sql = "UPDATE product_{$product['catalogId']} SET "
            ."name='{$product['name']}', "
            ."description='{$product['description']}', "
            ."priority='{$product['priority']}', "
            ."measure='{$product['measure']}', "
            ."available='{$product['available']}', "
            ."price_usd='{$product['priceUsd']}', "
            ."price_byr='{$product['priceByr']}' "
            ." WHERE id='{$product['id']}'";
        return $this->execute($sql);
    }

    public function updatePriceByr($product) {
        $sql = "UPDATE product_{$product['catalogId']} SET "
            ."price_byr='{$product['priceByr']}' "
            ." WHERE id='{$product['id']}'";
        return $this->execute($sql);
    }

    public function updatePriceByrForAll($products) {
        $sql = "";
        foreach ($products as $product) {
            $sql .= "UPDATE product_{$product['catalogId']} SET "
                ."price_byr='{$product['priceByr']}' "
                ." WHERE id='{$product['id']}';";
        }
        if (!empty($sql)) {
            return $this->execute($sql);
        }
        return true;
    }

    public function delete($catalogId, $productId) {
        $sql = "DELETE FROM product_{$catalogId} "
            ." WHERE id='{$productId}'";
        return $this->execute($sql);
    }

    public function createProductsTable($catalogId) {
        $sql = "CREATE TABLE IF NOT EXISTS product_{$catalogId} ("
                    ."id int(6) NOT NULL AUTO_INCREMENT ,"
                    ."name varchar(50) NOT NULL ,"
                    ."description text NOT NULL ,"
                    ."priority int(2) unsigned NOT NULL DEFAULT '0' ,"
                    ."available int(1) unsigned NOT NULL DEFAULT '1' ,"
                    ."measure varchar(10) NOT NULL DEFAULT 'шт.' ,"
                    ."price_usd float unsigned NOT NULL DEFAULT '0',"
                    ."price_byr int(10) unsigned NOT NULL DEFAULT '0' ,"
                    ."PRIMARY KEY (id)"
               .") ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
        return $this->execute($sql);
    }

    public function deleteProductsTable($catalogId) {
        $sql = "DROP TABLE IF EXISTS product_{$catalogId}";
        return $this->execute($sql);
    }

    public function productsTableExist($catalogId) {
        $sql = "SELECT 1 FROM product_{$catalogId}";
        return $this->select($sql);
    }
}
