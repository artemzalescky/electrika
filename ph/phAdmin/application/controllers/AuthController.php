<?php

namespace ph\phAdmin\application\controllers;

use ph\controller\BaseController;
use ph\exception\PhException;
use ph\phAdmin\application\models\AuthModel;
use ph\sessions\flash\FlashMessageStorage as messages;

class AuthController extends BaseController {
    public function __construct($inputData) {
        parent::__construct($inputData);
    }

    public function index() {
        $this->render([
            'layout' => 'unauthorized'
        ]);
    }

    public function login() {
        if (!$this->isPostRequest()) exit;

        $userLogin = $this->paramPost('user')['login'];
        $userPassword = $this->paramPost('user')['password'];

        try {
            $loggedInUser = AuthModel::getInstance()->login($userLogin, $userPassword);
            messages::add('Auth_UserLoggedIn', ['login' => $loggedInUser['login']], 'success');
            $this->systemRedirect('/');
        } catch (PhException $e) {
            messages::add('Auth_WrongLoginPassword', 1, 'error');
            $this->systemRedirect('/auth');
        }
    }

    public function logout() {
        AuthModel::getInstance()->logout();
        $this->systemRedirect("/");
    }
}
