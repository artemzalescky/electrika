<ul class="nav nav-pills">
    <li class="active">
        <?php $ph->system_link('Добавить новый товар', '/product/add/' . $catalog['id']) ?>
    </li>
    <li>
        <a href="#" role="button" data-toggle="modal" data-target="#priceConversionConfirm">Пересчитать цены каталога</a>
    </li>
</ul>

<hr>

<!-- modal confirm on price conversion -->
<div class="modal" id="priceConversionConfirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Внимание!</h4>
            </div>
            <div class="modal-body">
                <p>
                    Вы уверены, что хотите пересчитать цены каталога ? <br>
                    Старые цены в BYR будут пересчитаны с учетом <?php $ph->system_link('курса валюты', 'currency') ?> на сайте
                </p>
            </div>
            <div class="modal-footer">
                <?php $ph->system_link('Пересчитать', '/product/convertCatalogPrices/' . $catalog['id'],[
                        'class' => 'btn btn-danger'
                    ]) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('document').ready(function(){
        $('#priceConversionConfirm').modal({
            show: false
        });
    });
</script>