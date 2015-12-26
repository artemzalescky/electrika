<?php use ph\constants\UserRole;

$ph->system_button_link($ph->lang->Ph_User_Add_Button_ViewAllUsers, '/user', [
    'class'=>'btn btn-default',
]);

$ph->tag('hr')->renderAllMessages(); ?>

<div class="well">
    <form action="<?= $ph->system_url('/user/create')?>" method="post" class="form-horizontal">
        <fieldset>
            <legend><?= $ph->lang->Ph_User_Add_FormTitle ?></legend>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label"><?= $ph->lang->Ph_User_Name ?></label>
                <div class="col-lg-10">
                    <input type="text" value="<?= $this->param('user')['name'] ?>" name="user[name]" placeholder="<?= $ph->lang->Ph_User_Name ?>" id="inputName" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="inputLogin" class="col-lg-2 control-label"><?= $ph->lang->Ph_User_Login ?></label>
                <div class="col-lg-10">
                    <input type="text" value="<?= $this->param('user')['login'] ?>" name="user[login]" placeholder="<?= $ph->lang->Ph_User_Login ?>" id="inputLogin" class="form-control"  autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-lg-2 control-label"><?= $ph->lang->Ph_User_Password ?></label>
                <div class="col-lg-10">
                    <input type="password" name="user[password]" placeholder="<?= $ph->lang->Ph_User_Password ?>" id="inputPassword" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPasswordConfirm" class="col-lg-2 control-label"><?= $ph->lang->Ph_User_PasswordConfirm ?></label>
                <div class="col-lg-10">
                    <input type="password" name="user[password_confirm]" placeholder="<?= $ph->lang->Ph_User_PasswordConfirm ?>" id="inputPasswordConfirm" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label"><?= $ph->lang->Ph_User_Role ?></label>
                <div class="col-lg-10">
                    <div class="radio">
                        <label>
                            <?php $roleChecked = ($this->param('user')['role'] == UserRole::GUEST) ? "checked" : '' ?>
                            <input type="radio" name="user[role]" value="<?= UserRole::GUEST ?>" <?= $roleChecked ?>>
                            <?= $ph->lang->getText('Ph_User_Role_' . UserRole::getName(UserRole::GUEST)) ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <?php $roleChecked = ($this->param('user')['role'] == UserRole::ADMIN) ? "checked" : '' ?>
                            <input type="radio" name="user[role]" value="<?= UserRole::ADMIN ?>" <?= $roleChecked ?>>
                            <?= $ph->lang->getText('Ph_User_Role_' . UserRole::getName(UserRole::ADMIN)) ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php $ph->input_submit(['value' => $ph->lang->Ph_Button_Add, 'class' => 'btn btn-primary']) ?>
                    <?php $ph->system_link($ph->lang->Ph_Button_Cancel, '/user', ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </fieldset>
    </form>
</div>
