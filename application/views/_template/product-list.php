<h2 class="title text-center">Продукция</h2>

<div class="tab-content">
    <div class="tab-pane fade active in">
        <?php foreach ($products as $product) {
            $this->setViewVariable('_product', $product);
            $this->renderTemplate('product-preview');
        } ?>
    </div>
</div>

<div class="row"></div>

<?php if ($productPageInfo['pagesCount'] != 1) {
    $ph->tag('hr')
        ->tag_open('ul', ['class' => 'pagination pagination-lg', 'style' => 'display:table; margin: 0 auto']);
    $ph->tag_open('li', ['class' =>  $productPageInfo['currentPage'] == 1 ? 'disabled' : ''])
        ->link('&laquo;', $ph->current_url(true, false) . '?page=' . ($productPageInfo['currentPage'] - 1))
        ->tag_close('li');
    for ($i = 1; $i <= $productPageInfo['pagesCount']; $i++) {
        $ph->tag_open('li', ['class' =>  $i == $productPageInfo['currentPage'] ? 'active' : ''])
            ->link($i, $ph->current_url(true, false) . "?page=$i")
            ->tag_close('li');
    }
    $ph->tag_open('li', ['class' =>  $productPageInfo['currentPage'] == $productPageInfo['pagesCount'] ? 'disabled' : ''])
        ->link('&raquo;', $ph->current_url(true, false) . '?page=' . ($productPageInfo['currentPage'] + 1))
        ->tag_close('li');
    $ph->tag_close('ul');
} ?>
