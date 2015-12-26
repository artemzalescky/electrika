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

<?php foreach ($nearestChildren as $child) {
    $ph->link($child['name'], $currentCatalog['fullUrl'] . '/' . $child['url'])->tag('br');
}
