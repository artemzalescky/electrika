<?php

$ph->include_system_css('glyphicon.css');
$ph->include_system_css('catalog-tree.css');
$ph->include_system_js('catalog-tree.js');

function renderCatalog($root) {
    global $ph;

    if (empty($root)) {
        return;
    }

    if (!empty($root['_children'])) {
        $ph->tag('span', null, ['class' => 'arrow glyphicon glyphicon-menu-down expander']);
        $ph->tag('span', $root['name'], ['class' => 'catalog-name expander']);
        if ($root['id'] != 0) {
            renderActionIcon($root, 'list-alt', 'editProducts');
        }
        renderActionIcon($root, 'plus', 'addSubcatalog');
        if ($root['id'] != 0) {
            renderActionIcon($root, 'edit', 'edit');
        }

        $ph->tag_open('ul', ['class' => 'to-expand']);
        foreach ($root['_children'] as $child) {
            $ph->tag_open('li');
            renderCatalog($child);
            $ph->tag_close('li');
        }
        $ph->tag_close('ul');
    } else {
        $ph->tag('span', null, ['class' => 'arrow glyphicon glyphicon-ok-circle']);
        $ph->tag('span', $root['name'], ['class' => 'catalog-name']);
        if ($root['id'] != 0) {
            renderActionIcon($root, 'list-alt', 'editProducts');
        }
        renderActionIcon($root, 'plus', 'addSubcatalog');
        if ($root['id'] != 0) {
            renderActionIcon($root, 'edit', 'edit');
            renderActionIcon($root, 'remove', 'delete');
        }
    }
};

function renderActionIcon($root, $iconClassPostfix, $action) {
    global $ph;

    switch ($action) {
        case 'addSubcatalog':
            $tip = 'Добавить подкаталог';
            break;
        case 'editProducts':
            $tip = 'Редактировать товары';
            break;
        case 'edit':
            $tip = 'Редактировать';
            break;
        case 'delete':
            $tip = 'Удалить';
            break;
        default:
            $tip = $action;
    }

    $ph->tag('span', null, [
        'class' => 'action glyphicon glyphicon-' . $iconClassPostfix,
        'data-action' => $action,
        'data-catalog-id' => $root['id'],
        'data-toggle' => 'tooltip',
        'title' => $tip
    ]);
}
?>

<h3> Редактирование продукции </h3>

<hr>

<ul class="nav nav-pills">
    <li class="active">
        <?php $ph->system_link('Специальные предложения', '/specialOffer') ?>
    </li>
    <li>
        <a href="#" role="button" data-toggle="modal" data-target="#priceConversionConfirm">Пересчитать цены</a>
    </li>
</ul>

<div id="price-conversion-progress-container" class="well well-lg" style="display: none; margin-top: 10px">
    Пересчет цен для каталога <span id="current-catalog-name"></span>
    <div class="progress progress-striped active">
        <div id="conversion-progress" class="progress-bar progress-bar-info" style="width:0"></div>
    </div>
</div>

<hr>

<?php $ph->renderAllMessages(); ?>

<div id="catalog-tree">
    <?php renderCatalog($catalogTree) ?>
</div>

<script>
    var catalogTree = new CatalogTree({
        holderElem: $("#catalog-tree"),
        baseCatalogPath: "<?= $ph->system_url('catalog') . '/' ?>"
    });

    $(function () {     // activate bootstrap tooltips
        $("[data-toggle='tooltip']").tooltip();
    });
</script>

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
                    Вы уверены, что хотите пересчитать цены всей продукции сайта ? <br>
                    Старые цены в BYR будут пересчитаны с учетом <?php $ph->system_link('курса валюты', 'currency') ?> на сайте
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="convertAllPrices()">Пересчитать</button>
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

    function convertAllPrices() {
        $('#price-conversion-progress-container').css('display', 'block');

        $.get("<?= $ph->system_url('/catalog/get') ?>", function(catalogs) {
            if (catalogs.length == 0) {
                return;
            }

            convertCatalogPrices({'i': 0});

            function convertCatalogPrices(input) {
                var i = input['i'];
                $('#current-catalog-name').html(catalogs[i]['name']);

                $.get("<?= $ph->system_url('/product/convertCatalogPrices') ?>/" + catalogs[i]['id'], function(responce) {
                    $('#conversion-progress').css('width', (i + 1) / catalogs.length * 100 + '%');
                    input['i'] = input['i'] + 1;
                    if (input['i'] < catalogs.length) {
                        convertCatalogPrices(input);
                    } else {
                        alert('Цены всей продукции пересчитаны\nНажмите Ок для применения изменений');
                        location.reload();
                    }
                });
            }
        });
    }
</script>