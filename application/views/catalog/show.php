<?php $ph->include_css('catalog.css')?>
<?php $ph->include_css('logo.css')?>
<?php $ph->include_css('productList.css')?>


<ol class="breadcrumb">
    <?php foreach ($pathToCatalog as $part) {
        if ($part['id'] == $currentCatalog['id']) {
            $ph->tag('li', $part['name'], ['class' => 'active']);
        } else {
            $ph->tag_open('li')
                ->link($part['name'], $part['fullUrl'])
                ->tag_close('li');
        }
     } ?>
</ol>

<hr>

<?php
    if (!empty($nearestChildren)) {
     $this->renderTemplate('childrenCatalog');
    }
?>

<?php
    if (!empty($products)) {
        $this->renderTemplate('productList');
    }
?>
