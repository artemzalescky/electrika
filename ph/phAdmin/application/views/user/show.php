<?php use ph\constants\UserRole;

$ph->system_button_link($ph->lang->Ph_User_Show_Button_ViewAllUsers, '/user', [
    'class'=>'btn btn-default',
    'style'=>'margin-bottom:10px'
]); ?>

<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th><?= $ph->lang->Ph_User_Login ?></th>
            <th><?= $ph->lang->Ph_User_Name ?></th>
            <th><?= $ph->lang->Ph_User_Role ?></th>
            <th><?= $ph->lang->Ph_Button_Edit ?></th>
            <th><?= $ph->lang->Ph_Button_Delete ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $user['login'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $ph->lang->getText("Ph_User_Role_" . UserRole::getName($user['role'])) ?></td>
            <td class="col-md-1">
                <?php $ph->system_link($ph->lang->Ph_Button_Edit, '/user/edit/' . $user['id'], ['class'=>'btn btn-default btn-xs']) ?>
            </td>
            <td class="col-md-1">
                <?php $ph->system_link($ph->lang->Ph_Button_Delete, '/user/delete/' . $user['id'], ['class'=>'btn btn-default btn-xs']) ?>
            </td>
        </tr>
    </tbody>
</table>

<hr>