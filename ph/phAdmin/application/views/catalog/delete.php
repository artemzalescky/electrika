<h3> Удаление каталога <span class="underlined"> <?= $catalog['name'] ?> </span> </h3>

<hr>

<?php $ph->renderAllMessages();?>

<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"> Внимание </h3>
    </div>
    <div class="panel-body">
        Вы уверены, что хотите удалить каталог <span class="underlined"><?= $catalog['name'] ?></span> ?
    </div>
</div>

<?php $ph->system_form_link($ph->lang->Ph_Button_Delete, '/catalog/destroy/' . $catalog['id'], 'post', ['class' => 'btn btn-default'])
        ->link_back($ph->lang->Ph_Button_Cancel, ['class' => 'btn btn-primary', 'style' => 'margin-left: 5px']);

$ph->tag('hr');