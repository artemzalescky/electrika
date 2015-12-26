<?php use ph\constants\UserRole;

$ph->system_button_link($ph->lang->Ph_User_Index_Button_AddUser, '/user/add', [
    'class'=>'btn btn-default',
    'style'=>'margin-bottom:10px'
]);

$ph->tag('hr')->renderAllMessages();

if (!empty($users)) { ?>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th><?= $ph->lang->Ph_User_Login ?></th>
                <th><?= $ph->lang->Ph_User_Name ?></th>
                <th><?= $ph->lang->Ph_User_Role ?></th>
                <th><?= $ph->lang->Ph_Button_View ?></th>
                <th><?= $ph->lang->Ph_Button_Edit ?></th>
                <th><?= $ph->lang->Ph_Button_Delete ?></th>
            </tr>
        </thead>
        <tbody>
            <?php  $i = 1;
            foreach ($users as $user) {   $isCurrentUser = $user['id'] == $currentUserId; ?>
                <tr>
                    <td class="col-md-1"> <?= $i ?> </td>
                    <td> <?= $user['login'] ?> </td>
                    <td> <?= $user['name'] ?> </td>
                    <td> <?= $ph->lang->getText("Ph_User_Role_" . UserRole::getName($user['role'])) ?> </td>
                    <td class="col-md-1">
                        <?php $ph->system_link($ph->lang->Ph_Button_View, '/user/show/' . $user['id'], ['class'=>'btn btn-default btn-xs']) ?>
                    </td>
                    <td class="col-md-1">
                        <?php $ph->system_link($ph->lang->Ph_Button_Edit, '/user/edit/' . $user['id'], ['class'=>'btn btn-default btn-xs']) ?>
                    </td>
                    <td class="col-md-1">
                        <?php
                            $deleteButtonClasses = $isCurrentUser ? ' disabled' : '';
                            $ph->system_link($ph->lang->Ph_Button_Delete, '/user/delete/' . $user['id'], ['class'=>'btn btn-default btn-xs' . $deleteButtonClasses])
                        ?>
                    </td>
                </tr>
       <?php $i++;
            } ?>
        </tbody>
    </table>
    <hr>
<?php } ?>
