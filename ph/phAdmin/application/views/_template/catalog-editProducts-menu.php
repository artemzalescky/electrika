<ul class="nav nav-pills">
    <li class="active">
        <?php $ph->system_link('Добавить новый товар', '/product/add/' . $catalog['id']) ?>
    </li>
    <li>
        <?php $ph->system_link('Пересчитать цены каталога', '/product/convertAllPrices/' . $catalog['id'], [
            'onclick' => 'return confirm("Вы уверены, что хотите пересчитать цены каталога ' . $catalog['name'] . '?\n'
                .'Старые цены в BYR будут пересчитаны с учетом курса валют на сайте")'
        ]) ?>
    </li>
</ul>

<hr>