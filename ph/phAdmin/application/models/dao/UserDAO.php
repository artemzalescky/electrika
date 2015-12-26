<?php

namespace ph\phAdmin\application\models\dao;

use ph\config\Settings;
use ph\db\DbDataAccessObject;

class UserDAO extends DbDataAccessObject {

    public function __construct() {
        parent::__construct(Settings::SYSTEM_TABLE_PREFIX . 'user');
    }

    public function get() {
        return parent::get();
    }

    public function getById($id) {
        return parent::getBy(['id' => $id])[0];
    }

    public function getByLogin($login) {
        return parent::getBy(['login' => $login])[0];
    }

    public function getByLoginAndPassword($login, $password) {
        return parent::getBy(['login' => $login, 'password' => $password])[0];
    }

    public function add($user) {
        return parent::add([
            'login' => $user['login'],
            'password' => $user['password'],
            'name' => $user['name'],
            'role' => $user['role']
        ]);
    }

    public function update($user) {
        return parent::update([
            'login' => $user['login'],
            'name' => $user['name'],
            'role' => $user['role']
        ], [
            'id' => $user['id']
        ]);
    }

    public function updatePassword($user) {
        return parent::update([
            'password' => $user['password']
        ], [
            'id' => $user['id']
        ]);
    }

    public function delete($id) {
        return parent::deleteBy(['id' => $id]);
    }
}
