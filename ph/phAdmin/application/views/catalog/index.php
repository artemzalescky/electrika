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
            $tip = 'Просмотреть товары';
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

<?php $ph->tag('hr')->renderAllMessages(); ?>

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