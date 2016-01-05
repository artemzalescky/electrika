<h3> Удаление специального предложения <span class="underlined"> <?= $specialOfferProduct['name'] ?> </span> </h3>

<hr>

<?php $ph->renderAllMessages();?>

<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"> Внимание </h3>
    </div>
    <div class="panel-body">
        Вы уверены, что хотите удалить специальное предложение <span class="underlined"><?= $specialOfferProduct['name'] ?></span> ?
    </div>
</div>

<?php $ph->system_form_link('Удалить', '/specialOffer/destroy/' . $specialOfferProduct['catalogId'] . '/' . $specialOfferProduct['id'], 'post', ['class' => 'btn btn-default'])
    ->space()
    ->link_back('Отмена', ['class' => 'btn btn-primary']);

$ph->tag('hr');
