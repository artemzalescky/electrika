<?php

namespace ph\phAdmin\application\models;

use ph\constants\UserRole;
use ph\exception\PhException;
use ph\phAdmin\application\models\dao\UserDAO;
use ph\routing\Router;
use ph\sessions\SessionStorage;
use ph\utils\SecurityUtil;

class AuthModel {
    private static $USER_VAR = 'ph_loggedUser';

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

    public function login($userLogin, $userPassword) {
        $user = $this->getUserByLoginAndPassword($userLogin, $userPassword);
        SessionStorage::add(self::$USER_VAR, $user);
        return $user;
    }

    public function logout() {
        SessionStorage::delete(self::$USER_VAR);
    }

    public function checkAuth() {
        if (!$this->isUserLoggedIn()) {
            Router::systemRedirect('/auth');
        }
    }

    public function isUserLoggedIn() {
        return SessionStorage::contains(self::$USER_VAR);
    }

    public function isAdminLoggedIn() {
        return $this->isUserLoggedIn() && $this->getLoggedInUser()['role'] == UserRole::ADMIN;
    }

    public function isGuestLoggedIn() {
        return $this->isUserLoggedIn() && $this->getLoggedInUser()['role'] == UserRole::GUEST;
    }

    public function getLoggedInUser() {
        return SessionStorage::get(self::$USER_VAR);
    }

    public function getLoggedInUserId() {
        return $this->getLoggedInUser()['id'];
    }

    private function getUserByLoginAndPassword($login, $password) {
        $password = SecurityUtil::encrypt($password);
        $user = $this->userDAO->getByLoginAndPassword($login, $password);
        if (empty($user)) {
            PhException::throwErrors(['User_IdNotFound' => 1]);
        }
        return $user;
    }
}
