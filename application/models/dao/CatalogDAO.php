<?php

namespace application\models\dao;

use ph\db\DbDataAccessObject;

class CatalogDAO extends DbDataAccessObject {

    public function __construct() {
        parent::__construct('catalog');
    }

    public function get() {
        return parent::get();
    }

    public function getById($id) {
        return parent::getBy(['id' => $id])[0];
    }

    public function getByUrl($url) {
        return parent::getBy(['url' => $url])[0];
    }

    public function getNearestChildren($id) {
        return $this->select("SELECT * FROM catalog WHERE parent_id = $id");
    }

    public function add($catalog) {
        return parent::add([
            'parent_id' => $catalog['parent_id'],
            'name' => $catalog['name'],
            'url' => $catalog['url'],
            'priority' => $catalog['priority']
        ]);
    }

    public function update($catalog) {
        return parent::update([
            'name' => $catalog['name'],
            'url' => $catalog['url'],
            'priority' => $catalog['priority']
        ], [
            'id' => $catalog['id']
        ]);
    }

    public function updateDescription($catalog) {
        return parent::update([
            'description' => $catalog['description']
        ], [
            'id' => $catalog['id']
        ]);
    }

    public function delete($id) {
        return parent::deleteBy([
            'id' => $id
        ]);
    }
}
