<h3> Специальные предложения </h3>

<hr>

<?php $ph->renderAllMessages() ?>

<?php if (!empty($specialOfferProducts)) { ?>
<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th class="col-lg-1">#</th>
            <th>Товар</th>
            <th>Цена BYR</th>
            <th class="col-lg-1"></th>
        </tr>
    </thead>
    <tbody>
    <?php for ($i = 0; $i < count($specialOfferProducts); $i++) { $product = $specialOfferProducts[$i]; ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?php $ph->system_link($product['name'], "/product/edit/{$product['catalogId']}/{$product['id']}") ?></td>
            <td><?php $ph->text(number_format($product['priceByr'], 0, '.', ' ')) ?></td>
            <td>
                <?php
                    $ph->system_link('Удалить', "/specialOffer/delete/{$product['catalogId']}/{$product['id']}", [
                        'class' => 'btn btn-danger btn-xs'
                    ])
                ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<hr>
<?php } else {
    $ph->text('Специальных предложений нет')->tag('hr');
} ?>

<button id="how-to-button" class="btn btn-info" onclick="showHowToPanel()">Как добавить товар в специальные предложения</button>

<div id="how-to-panel" class="panel panel-info" style="display: none">
    <div class="panel-heading">
        <h3 class="panel-title">Как добавить товар в специальные предложения</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-8">
                Для добавления товара в категорию "специальные предложения" необходимо выполнить следующие действия: <br>
                1. Зайти в меню "<?php $ph->system_link('Продукция', '/catalog') ?>" <br>
                2. Найти каталог с требуемым товаром <br>
                3. Нажать на иконку <span class="glyphicon glyphicon-list-alt"></span> "Редактировать товары" рядом с именем каталога <br>
                4. Найти требуемый товар в списке <br>
                5. Нажать на кнопку "Добавить товар в спецпредложения"
            </div>
            <div class="col-lg-4">
                <?php $ph->system_image('/specialOffer/how-to-add-to-special-offers.png', [
                    'style' => 'max-width: 100%'
                ]) ?>
            </div>
        </div>
    </div>
</div>

<hr>

<script>
    function showHowToPanel() {
        $('#how-to-button').css('display', 'none');
        $('#how-to-panel').css('display', 'block');
    }
</script>