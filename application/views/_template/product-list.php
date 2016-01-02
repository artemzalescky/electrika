<h2 class="title text-center">Продукция</h2>

<div class="tab-content">
    <div class="tab-pane fade active in">
        <?php foreach ($products as $product) { ?>
        <div class="col-sm-3">
            <div class="product-container text-center">
                <?php $ph->tag_open('a', ['href' => $ph->url($product['fullUrl']), 'class' => 'image-container'])
                    ->tag('img', null, [
                        'src' => !empty($product['imagePath']) ? $ph->path($product['imagePath']) : $ph->image_path('no-photo.jpg'),
                        'class' => 'image'
                    ])
                    ->tag_close('a')
                    ->link($product['name'], $product['fullUrl'], ['class' => 'name'])
                ?>
                <div class="price">
                    <?php
                        if ($product['available']) {
                            if (!empty($product['priceByr'])) {
                                $ph->text(number_format($product['priceByr'], 0, '.', ' ') . ' ')
                                    ->tag('span', 'руб.', ['class' => 'price-currency']);
                            } else {
                                $ph->tag('span', 'Цену уточняйте', ['class' => 'price-currency']);
                            }
                        } else {
                            $ph->tag('span', 'Нет в наличии', ['class' => 'not-available']);
                        }
                    ?>
                </div>
                <?php $ph->link('<i class="glyphicon glyphicon-plus"></i>Подробнее', $product['fullUrl'], ['class'=> 'btn btn-default read-more']);?>
            </div>
        </div>
       <?php } ?>
    </div>
</div>

<div class="row"></div>

<?php if ($productPageInfo['pagesCount'] != 1) {
    $ph->tag('hr')
        ->tag_open('ul', ['class' => 'pagination pagination-lg', 'style' => 'display:table; margin: 0 auto']);
    $ph->tag_open('li', ['class' =>  $productPageInfo['currentPage'] == 1 ? 'disabled' : ''])
        ->link('&laquo;', $ph->currentUrlWithoutParams() . '?page=' . ($productPageInfo['currentPage'] - 1))
        ->tag_close('li');
    for ($i = 1; $i <= $productPageInfo['pagesCount']; $i++) {
        $ph->tag_open('li', ['class' =>  $i == $productPageInfo['currentPage'] ? 'active' : ''])
            ->link($i, $ph->currentUrlWithoutParams() . "?page=$i")
            ->tag_close('li');
    }
    $ph->tag_open('li', ['class' =>  $productPageInfo['currentPage'] == $productPageInfo['pagesCount'] ? 'disabled' : ''])
        ->link('&raquo;', $ph->currentUrlWithoutParams() . '?page=' . ($productPageInfo['currentPage'] + 1))
        ->tag_close('li');
    $ph->tag_close('ul');
} ?>
