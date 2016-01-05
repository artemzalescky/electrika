<?php

$ph->include_system_css('edit-products.css');

$this->renderTemplate('catalog-edit-menu');
$this->renderTemplate('catalog-editProducts-header');
if (isset($products)) {
    $this->renderTemplate('catalog-editProducts-menu');
}

$ph->renderAllMessages();

if (isset($products)) { ?>
    <?php if (!empty($products)) {
        for ($i = 0; $i < count($products); $i++) { $product = $products[$i] ?>
            <div class="well">
                <form action="<?= $ph->system_url('/catalog/update/' . $catalog['id'])?>" method="post" class="form-horizontal">
                    <fieldset>
                        <legend>
                            <?php $ph->tag('span', $product['name'], [
                                'class' => 'product-title',
                                'onclick' => 'window.location.href = "' . $ph->system_url('/product/edit/' . $catalog['id'] . '/' . $product['id']) . '"'
                            ]) ?>
                            <div style="position:relative; float:right; font-size:15px"># <?= $i+1 ?></div>
                        </legend>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <b><em><span class="text-danger"><?= number_format($product['priceByr'], 0, '.', ' ') ?></span></em></b>&nbsp; BYR <br>
                                <em><span class="text-primary"><?= $product['priceUsd'] ?></span></em> $
                            </div>
                            <div class="col-lg-1">
                                <?php
                                if ($product['available']) {
                                    $ph->system_link('Есть в наличии', '/product/edit/' . $catalog['id'] . '/' . $product['id'], [
                                        'class' => 'text-success small-reference'
                                    ]);
                                } else {
                                    $ph->system_link('Нет в наличии', '/product/edit/' . $catalog['id'] . '/' . $product['id'], [
                                        'class' => 'text-danger small-reference'
                                    ]);
                                }
                                ?>
                            </div>
                            <div class="col-lg-1">
                                <span style="font-size: 0.8em;">приор. </span>
                                <b><em>
                                <?php $ph->system_link($product['priority'], '/product/edit/' . $catalog['id'] . '/' . $product['id'], [
                                        'class' => 'text-success small-reference',
                                        'style' => 'font-size: 1em'
                                    ]); ?>
                                    </em></b>
                            </div>
                            <div class="col-lg-1">
                                <?php
                                    if (isset($product['imagePath'])) {
                                        $ph->tag_open('a', ['href' => $ph->system_url('/product/uploadImage/' . $catalog['id'] . '/' . $product['id'])])
                                            ->tag('img', null, ['src' => $ph->path($product['imagePath']), 'class' => 'image-preview', 'style' => 'max-width:100%; max-height:70px'])
                                            ->tag_close('a');

                                    } else {
                                        $ph->system_link('Изображение отсутствует', '/product/uploadImage/' . $catalog['id'] . '/' . $product['id'], [
                                            'class' => 'text-danger small-reference'
                                        ]);
                                    }
                                ?>
                            </div>
                            <div class="col-lg-1">
                                <?php
                                    if (!empty($product['description'])) {
                                        $ph->system_link('Есть описание', '/product/edit/' . $catalog['id'] . '/' . $product['id'], [
                                            'class' => 'text-success small-reference'
                                        ]);
                                    } else {
                                        $ph->system_link('Описание отсутствует', '/product/edit/' . $catalog['id'] . '/' . $product['id'], [
                                            'class' => 'text-danger small-reference'
                                        ]);
                                    }
                                ?>
                            </div>
                            <div class="col-lg-4 col-lg-offset-2">
                                <div class="btn-group">
                                    <?php $ph->system_link('Редактировать', '/product/edit/' . $catalog['id'] . '/' . $product['id'], ['class' => 'btn btn-primary']) ?>
                                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <?php $ph->system_link('Изображение', '/product/uploadImage/' . $catalog['id'] . '/' . $product['id']) ?>
                                        </li>
                                        <li>
                                            <?php $ph->system_link('Пересчитать цену', '/product/convertPrice/' . $catalog['id'] . '/' . $product['id']) ?>
                                        </li>
                                        <li>
                                            <?php $ph->system_link('Копировать', '/product/copy/' . $catalog['id'] . '/' . $product['id']) ?>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                                $ph->space()
                                    ->system_link('Удалить', '/product/delete/' . $catalog['id'] . '/' . $product['id'], ['class' => 'btn btn-danger'])
                                    ->space()
                                    ->tag('button', '<span class="glyphicon glyphicon-star"></span>', [
                                        'class' => 'btn btn-info',
                                        'data-toggle' => 'tooltip',
                                        'title' => 'Добавить товар в спецпредложения',
                                        'onclick' => "addToSpecialOffers({$catalog['id']}, {$product['id']}); return false;"
                                    ])
                                ?>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
<?php   }
        $ph->single_tag('hr')->system_link('Добавить новый товар', '/product/add/' . $catalog['id'], ['class' => 'btn btn-primary']);
    } else { ?>
        <div class="panel panel-info">
            <div class="panel-heading"> Товары отсутствуют </div>
            <div class="panel-body">
                В данном каталоге отсутствуют товары <br>
                Для добавления продукции нажмите кнопку "Добавить новый товар"
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="panel panel-warning">
        <div class="panel-heading"> Отсутствует таблица товаров </div>
        <div class="panel-body">
            В базе данных отсутствует таблица товаров для данного каталога <br>
            Нажмите кнопку "Создать" для дальнейшего добавления продукции
        </div>
    </div>
<?php
    $ph->system_form_link('Создать таблицу', '/product/createTable/' . $catalog['id'], 'post', ['class' => 'btn btn-primary'])
    ->space()
    ->link_back('Назад', ['class' => 'btn btn-default']);
} ?>

<hr>

<script>
    $(function () {     // activate bootstrap tooltips
        $("[data-toggle='tooltip']").tooltip();
    });

    $('document').ready(function(){
        $('#specialOfferSuccessModal').modal({
            show: false
        });
    });

    function addToSpecialOffers(catalogId, productId) {
        $.ajax("<?= $ph->system_url('/specialOffer/create') ?>/" + catalogId + "/" + productId, {
            method: 'POST',
            success: function(data, textStatus, jqXHR) {
                $('#specialOfferSuccessModal').modal({
                    show: true
                });
                console.log(jqXHR);
            },
            error: function(jqXHR) {
                if (jqXHR.status == 406) {
                    $('#specialOfferDuplicateErrorModal').modal({
                        show: true
                    });
                } else {
                    $('#specialOfferErrorModal').modal({
                        show: true
                    });
                }
            }
        })
    }
</script>

<!-- modal confirm on adding to special offers -->
<div class="modal" id="specialOfferSuccessModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-primary">Товар добавлен в специальные предложения</h4>
            </div>
            <div class="modal-body">
                <p>
                    Список товаров на акции обновлен <br>
                    Для просмотра всех специальных предложений перейдите по <?php $ph->system_link('ссылке', '/specialOffer') ?>.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ок</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="specialOfferDuplicateErrorModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-danger">Ошибка</h4>
            </div>
            <div class="modal-body">
                <p>
                    Данный товар уже находится в специальных предложениях. <br>
                    Нельзя добавлять один и тот же товар несколько раз. <br>
                    Для просмотра всех специальных предложений перейдите по <?php $ph->system_link('ссылке', '/specialOffer') ?>.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Ок</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="specialOfferErrorModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-danger">Ошибка</h4>
            </div>
            <div class="modal-body">
                <p>
                    Неизвестная ошибка. <br>
                    Проверьте подсоединение к сети. <br>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Ок</button>
            </div>
        </div>
    </div>
</div>
