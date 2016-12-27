<?php

namespace ph\phAdmin\application\controllers;

use application\models\CatalogModel;
use application\models\ProductModel;
use ph\controller\BaseController;
use ph\db\DbAccessor;

class MigrationController extends BaseController {
    private $db;
    
    public function __construct($inputData) {
        parent::__construct($inputData);
        $this->db = new DbAccessor();
    }

    public function fix_product_tables_2016_12_27() {
        $TARGET_COLUMN_TYPES = [
            'name' => 'varchar(100)',
            'price_byr' => 'float unsigned'
        ];

        foreach (CatalogModel::getInstance()->get() as $catalog) {
            $this->log('<hr>' . $catalog['id'] . ' ' . $catalog['name']);

            $productTableExist = ProductModel::getInstance()->productTableExist($catalog['id']);
            $this->log('table exist: ' . ($productTableExist ? 'YES' : 'NO'));

            if (!$productTableExist) continue;

            foreach ($TARGET_COLUMN_TYPES as $columnName => $targetType) {
                $tableName = 'product_' . $catalog['id'];
                $currentType = $this->db->select("SHOW FIELDS FROM $tableName where Field ='$columnName'")[0]['type'];
                if ($currentType === $targetType) {
                    $this->log_success($currentType);
                } else {
                    $this->log_error($currentType);
                    try {
                        $this->db->execute("ALTER TABLE $tableName MODIFY `$columnName` $targetType");
                        $this->log_success('FIXED');
                    } catch (\Exception $e) {
                        $this->log_error('ERROR ' . $e->getMessage());
                    }
                }
            }
        }
    }

    private function log($msg = '', $color = '#000') {
        echo "<span style='color: $color'>$msg</span><br>";
    }

    private function log_success($msg) {
        $this->log($msg, '#0d0');
    }

    private function log_error($msg) {
        $this->log($msg, '#d00');
    }
}
