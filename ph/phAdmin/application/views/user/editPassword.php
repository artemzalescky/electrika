<?php $ph->system_button_link($ph->lang->Ph_User_EditPassword_Button_ViewAllUsers, '/user', [
    'class'=>'btn btn-default',
]);

$ph->tag('hr')->renderAllMessages(); ?>

<div class="well">
    <form action="<?= $ph->system_url('/user/updatePassword/' . $user['id'])?>" method="post" class="form-horizontal">
        <fieldset>
            <legend><?= $ph->lang->Ph_User_EditPassword_FormTitle ?></legend>
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
                <div class="col-lg-10 col-lg-offset-2">
                    <?php $ph->input_submit(['value' => $ph->lang->Ph_Button_Save, 'class' => 'btn btn-primary']) ?>
                    <?php $ph->system_link($ph->lang->Ph_Button_Cancel, "/user/edit/{$user['id']}", ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </fieldset>
    </form>
</div>
