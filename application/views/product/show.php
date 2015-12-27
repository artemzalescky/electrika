<ol class="breadcrumb">
    <?php foreach ($pathToCatalog as $part) {
        $ph->tag_open('li')
            ->link($part['name'], $part['fullUrl'])
            ->tag_close('li');
    }
    $ph->tag('li', $product['name'], ['class' => 'active']);
    ?>
</ol>

<hr>

<?php

\ph\utils\DebugUtil::varDump($product);
