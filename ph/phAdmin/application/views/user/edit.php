<?php use ph\constants\UserRole;

$ph->system_button_link($ph->lang->Ph_User_Edit_Button_ViewAllUsers, '/user', [
    'class'=>'btn btn-default',
]);

$ph->tag('hr')->renderAllMessages(); ?>

<div class="well">
    <form action="<?= $ph->system_url('/user/update/' . $user['id'])?>" method="post" class="form-horizontal">
        <fieldset>
            <legend><?= $ph->lang->Ph_User_Edit_FormTitle ?></legend>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label"><?= $ph->lang->Ph_User_Name ?></label>
                <div class="col-lg-10">
                    <input type="text" value="<?= $user['name'] ?>" name="user[name]" placeholder="<?= $ph->lang->Ph_User_Name ?>" id="inputName" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="inputLogin" class="col-lg-2 control-label"><?= $ph->lang->Ph_User_Login ?></label>
                <div class="col-lg-10">
                    <input type="text" value="<?= $user['login'] ?>" name="user[login]" placeholder="<?= $ph->lang->Ph_User_Login ?>" id="inputLogin" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="form-group" <?php if ($currentUser['id'] == $user['id']) echo 'style="display:none"' ?> >
                <label class="col-lg-2 control-label"><?= $ph->lang->Ph_User_Role ?></label>
                <div class="col-lg-10">
                    <div class="radio">
                        <label>
                            <?php $roleChecked = ($user['role'] == UserRole::GUEST) ? "checked" : '' ?>
                            <input type="radio" name="user[role]" value="<?= UserRole::GUEST ?>" <?= $roleChecked ?>>
                            <?= $ph->lang->getText('Ph_User_Role_' . UserRole::getName(UserRole::GUEST)) ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <?php $roleChecked = ($user['role'] == UserRole::ADMIN) ? "checked" : '' ?>
                            <input type="radio" name="user[role]" value="<?= UserRole::ADMIN ?>" <?= $roleChecked ?>>
                            <?= $ph->lang->getText('Ph_User_Role_' . UserRole::getName(UserRole::ADMIN)) ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php $ph->input_submit(['value' => $ph->lang->Ph_Button_Save, 'class' => 'btn btn-primary'])
                        ->space()
                        ->system_link($ph->lang->Ph_Button_Cancel, '/user', ['class' => 'btn btn-default'])
                        ->space()
                        ->system_link($ph->lang->Ph_User_Edit_FormButton_EditPassword, '/user/editPassword/' . $user['id'], ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </fieldset>
    </form>
</div>
