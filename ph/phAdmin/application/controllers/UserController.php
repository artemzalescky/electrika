<?php

namespace ph\phAdmin\application\controllers;

use ph\controller\BaseController;
use ph\exception\PhException;
use ph\phAdmin\application\models\AuthModel;
use ph\phAdmin\application\models\UserModel;
use ph\sessions\flash\FlashMessageStorage as messages;

class UserController extends BaseController {

    public function index() {
        $this->setViewVariable('users', UserModel::getInstance()->get());
        $this->setViewVariable('currentUserId', AuthModel::getInstance()->getLoggedInUserId());
        $this->render();
    }

    public function show($userId) {
        try {
            $user = UserModel::getInstance()->getById($userId);
            $this->setViewVariable('user', $user);
            $this->render();
        } catch (PhException $e) {
            var_dump($e->getErrors());
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/user');
        }
    }

    public function create() {
        if (!$this->isPostRequest()) exit;

        $user = $this->param('user');
        try {
            UserModel::getInstance()->create($user);
            messages::add('User_Added', ['login' => $user['login']], 'success');
            $this->systemRedirect('/user');
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/user/add?' . $this->array2ParamString($user, 'user', ['password', 'password_confirm']));
        }
    }

    public function edit($userId) {
        $user = $this->param('user');
        try {
            if (empty($user)) {
                $user = UserModel::getInstance()->getById($userId);
            }
            $this->setViewVariable('user', $user);
            $this->setViewVariable('currentUser', AuthModel::getInstance()->getLoggedInUser());
            $this->render();
        } catch (PhException $e) {
            messages::add('User_IdNotFound', 1, 'error');
            $this->systemRedirect('/user');
        }
    }

    public function editPassword($userId) {
        try {
            $user = UserModel::getInstance()->getById($userId);
            $this->setViewVariable('user', $user);
            $this->render();
        } catch (PhException $e) {
            messages::add('User_IdNotFound', 1, 'error');
            $this->systemRedirect('/user');
        }
    }

    public function update($userId) {
        if (!$this->isPostRequest()) exit;

        $user = $this->param('user');
        $user['id'] = $userId;
        try {
            UserModel::getInstance()->update($user);
            messages::add('User_Updated', ['login' => $user['login']], 'success');
            $this->systemRedirect('/user');
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/user/edit/' . $userId . '?' . $this->array2ParamString($user, 'user', ['password']));
        }
    }

    public function updatePassword($userId) {
        if (!$this->isPostRequest()) exit;

        $user = $this->param('user');
        $user['id'] = $userId;
        try {
            UserModel::getInstance()->updatePassword($user);
            messages::add('User_Password_Updated', ['login' => $user['login']], 'success');
            $this->systemRedirect("/user/edit/$userId");
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/user/editPassword/' . $userId . '?' . $this->array2ParamString($user, 'user', ['password']));
        }
    }

    public function delete($userId) {
        try {
            if ($userId === AuthModel::getInstance()->getLoggedInUserId()) {
                PhException::throwErrors(['User_DeleteCurrentUser' => 1]);
            }
            $user = UserModel::getInstance()->getById($userId);
            $this->setViewVariable('user', $user);
            messages::add('User_DeleteConfirmation', ['login' => $user['login']], 'warning');
            $this->render();
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/user');
        }
    }

    public function destroy($userId) {
        if (!$this->isPostRequest()) exit;

        try {
            if ($userId === AuthModel::getInstance()->getLoggedInUserId()) {
                PhException::throwErrors(['User_DeleteCurrentUser' => 1]);
            }
            $user = UserModel::getInstance()->getById($userId);
            UserModel::getInstance()->delete($userId);
            messages::add('User_Deleted', ['login' => $user['login']], 'success');
            $this->systemRedirect('/user');
        } catch (PhException $e) {
            messages::addGroup('error', $e->getErrors());
            $this->systemRedirect('/user');
        }
    }
}
