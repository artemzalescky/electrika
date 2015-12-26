<?php

namespace ph\phAdmin\application\models;

use ph\exception\PhException;
use ph\phAdmin\application\models\dao\UserDAO;
use ph\utils\SecurityUtil;
use ph\utils\StringUtil;
use ph\utils\Util;

class UserModel {
    private static $instance;
    private $userDAO;

    private function __construct() {
        $this->userDAO = new UserDAO();
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function get() {
        return $this->userDAO->get();
    }

    public function getById($id) {
        $user = $this->userDAO->getById($id);
        if (empty($user)) {
            PhException::throwErrors(['User_IdNotFound' => 1]);
        }
        return $user;
    }

    public function create($user) {
        $validationErrors = $this->validateNewUser($user);
        if (!empty($validationErrors)) {
            PhException::throwErrors($validationErrors);
        }
        $this->encryptUserPassword($user);
        return $this->userDAO->add($user);
    }

    public function update($user) {
        $this->checkUserExist($user['id']);
        $validationErrors = $this->validateExistingUser($user);
        if (!empty($validationErrors)) {
            PhException::throwErrors($validationErrors);
        }
        return $this->userDAO->update($user);
    }

    public function updatePassword($user) {
        $this->checkUserExist($user['id']);
        $validationErrors = $this->getPasswordValidationErrors($user);
        if (!empty($validationErrors)) {
            PhException::throwErrors($validationErrors);
        }
        $this->encryptUserPassword($user);
        return $this->userDAO->updatePassword($user);
    }

    public function delete($id) {
        $this->checkUserExist($id);
        return $this->userDAO->delete($id);
    }

    public function checkUserExist($id) {
        $user = $this->userDAO->getById($id);
        if (empty($user)) {
            PhException::throwErrors(['User_IdNotFound' => 1]);
        }
    }

    private function encryptUserPassword(&$user) {
        $user['password'] = SecurityUtil::encrypt($user['password']);
    }

    private function validateNewUser($user) {
        $errors = $this->getLoginValidationErrors($user);
        $errors = array_merge($errors, $this->getNameValidationErrors($user));
        $errors = array_merge($errors, $this->getRoleValidationErrors($user));
        return array_merge($errors, $this->getPasswordValidationErrors($user));
    }

    private function validateExistingUser($user) {
        $errors = $this->getLoginValidationErrors($user);
        $errors = array_merge($errors, $this->getNameValidationErrors($user));
        return array_merge($errors, $this->getRoleValidationErrors($user));
    }

    private function getLoginValidationErrors($user) {
        $errors = [];
        if (Util::isEmpty($user['login'])) {
            $errors['User_EmptyLogin'] = 1;
            return $errors;
        }
        $userWithSameLogin = $this->userDAO->getByLogin($user['login']);
        if (!Util::isEmpty($userWithSameLogin) && $userWithSameLogin['id'] !== $user['id']) {
            $errors['User_ExistingLogin'] = ['login' => $user['login']];
        }
        return $errors;
    }

    private function getNameValidationErrors($user) {
        $errors = [];
        if (Util::isEmpty($user['name'])) {
            $errors['User_EmptyName'] = 1;
        }
        return $errors;
    }

    private function getPasswordValidationErrors($user) {
        $errors = [];
        if (Util::isEmpty($user['password'])) {
            $errors['User_EmptyPassword'] = 1;
        } else if (!StringUtil::equal($user['password'], $user['password_confirm'])) {
            $errors['User_PasswordNotConfirmed'] = 1;
        }
        return $errors;
    }

    private function getRoleValidationErrors($user) {
        $errors = [];
        if (empty($user['role'])) {
            $errors['User_EmptyRole'] = 1;
        }
        return $errors;
    }
}
