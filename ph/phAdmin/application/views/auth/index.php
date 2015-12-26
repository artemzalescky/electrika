<?php $ph->renderAllMessages(); ?>

<div class="well">
    <form action="<?= $ph->system_url('/auth/login')?>" method="post" class="form-horizontal">
        <fieldset>
            <legend><?= $ph->lang->Ph_Auth_Index_FormTitle ?></legend>
            <div class="form-group">
                <label for="inputLogin" class="col-lg-2 control-label"><?= $ph->lang->Ph_User_Login ?></label>
                <div class="col-lg-10">
                    <input type="text" name="user[login]" placeholder="<?= $ph->lang->Ph_User_Login ?>" id="inputLogin" class="form-control" autocomplete="off" autofocus>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-lg-2 control-label"><?= $ph->lang->Ph_User_Password ?></label>
                <div class="col-lg-10">
                    <input type="password" name="user[password]" placeholder="<?= $ph->lang->Ph_User_Password ?>" id="inputPassword" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php $ph->input_submit(['value' => $ph->lang->Ph_Auth_Index_FormButton_Enter, 'class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </fieldset>
    </form>
</div>
