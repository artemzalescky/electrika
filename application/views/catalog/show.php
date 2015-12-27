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
     foreach ($nearestChildren as $child) {
         $ph->link($child['name'], $currentCatalog['fullUrl'] . '/' . $child['url'])->tag('br');
     }
     $ph->tag('hr');
    }
?>

<?php
    if (!empty($products)) {
        foreach ($products as $product) {
            $ph->link($product['name'], $product['fullUrl'])->tag('br');
        }
        $ph->tag('hr');
    }
?>
