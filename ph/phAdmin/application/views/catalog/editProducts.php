<?php $this->renderTemplate('catalog-edit-menu');
$this->renderTemplate('catalog-editProducts-header');
if (isset($products)) {
    $this->renderTemplate('catalog-editProducts-menu');
}

$ph->renderAllMessages();

if (isset($products)) { ?>
    <?php if (!empty($products)) {
        foreach ($products as $product) { ?>
            <div class="well">
                <form action="<?= $ph->system_url('/catalog/update/' . $catalog['id'])?>" method="post" class="form-horizontal">
                    <fieldset>
                        <legend> <?= $product['name'] ?> </legend>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <b><em><span class="text-danger"><?= number_format($product['priceByr'], 0, '.', ' ') ?></span></em></b>&nbsp; BYR <br>
                                <em><span class="text-primary"><?= $product['priceUsd'] ?></span></em> $
                            </div>
                            <div class="col-lg-1">
                                <?php
                                if ($product['available']) {
                                    $ph->tag('span', 'Есть в наличии', [
                                        'class' => 'text-success',
                                        'style' => 'font-size: 0.7em; font-weight: bold'
                                    ]);
                                } else {
                                    $ph->tag('span', 'Нет в наличии', [
                                        'class' => 'text-danger',
                                        'style' => 'font-size: 0.7em; font-weight: bold'
                                    ]);
                                }
                                ?>
                            </div>
                            <div class="col-lg-1">
                                <span style="font-size: 0.8em;">приор. </span>
                                <b><em><span class="text-success"><?= $product['priority'] ?></span></em></b>
                            </div>
                            <div class="col-lg-1">
                                <?php
                                    if (isset($product['imagePath'])) {
                                        $ph->tag('img', null, ['src' => $ph->path($product['imagePath']), 'class' => 'image-preview', 'style' => 'max-width:100%; max-height:70px']);
                                    } else {
                                        $ph->tag('span', 'Изображение отсутствует', [
                                            'class' => 'text-danger',
                                            'style' => 'font-size: 0.7em; font-weight: bold'
                                        ]);
                                    }
                                ?>
                            </div>
                            <div class="col-lg-1">
                                <?php
                                    if (!empty($product['description'])) {
                                        $ph->tag('span', 'Есть описание', [
                                            'class' => 'text-success',
                                            'style' => 'font-size: 0.7em; font-weight: bold'
                                        ]);
                                    } else {
                                        $ph->tag('span', 'Описание отсутствует', [
                                            'class' => 'text-danger',
                                            'style' => 'font-size: 0.7em; font-weight: bold'
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
                                            <?php $ph->system_link('Общая информация', '/product/edit/' . $catalog['id'] . '/' . $product['id']) ?>
                                        </li>
                                        <li>
                                            <?php $ph->system_link('Изображение', '/product/uploadImage/' . $catalog['id'] . '/' . $product['id']) ?>
                                        </li>
                                        <li>
                                            <?php $ph->system_link('Пересчитать цену', '/product/convertPrice/' . $catalog['id'] . '/' . $product['id']) ?>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                                $ph->space()
                                    ->system_link('Удалить', '/product/delete/' . $catalog['id'] . '/' . $product['id'], ['class' => 'btn btn-danger'])
                                ?>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
<?php   }
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