<?php

$ph->renderAllMessages();

$ph->system_form_link($ph->lang->Ph_Button_Delete, '/user/destroy/' . $user['id'], 'post', ['class' => 'btn btn-default'])
    ->system_link($ph->lang->Ph_Button_Cancel, '/user/', ['class' => 'btn btn-primary', 'style' => 'margin-left: 5px']);

$ph->tag('hr');