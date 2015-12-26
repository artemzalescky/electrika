<h3> Удаление товара <span class="underlined"> <?= $product['name'] ?> </span> </h3>

<hr>

<?php $ph->renderAllMessages();?>

<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"> Внимание </h3>
    </div>
    <div class="panel-body">
        Вы уверены, что хотите удалить товар <span class="underlined"><?= $product['name'] ?></span> каталога <span class="underlined"><?= $catalog['name'] ?></span> ?
    </div>
</div>

<?php $ph->system_form_link($ph->lang->Ph_Button_Delete, '/product/destroy/' . $catalog['id'] . '/' . $product['id'], 'post', ['class' => 'btn btn-default'])
        ->space()
        ->link_back('Отмена', ['class' => 'btn btn-primary']);

$ph->tag('hr');
