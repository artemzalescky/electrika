<?php use application\helpers\CurrencyHelper; ?>

<div class="col-sm-3">
    <div class="product-container text-center">
        <?php $ph->tag_open('a', ['href' => $ph->url($_product['fullUrl']), 'class' => 'image-container'])
            ->tag('img', null, [
                'src' => !empty($_product['imagePath']) ? $ph->path($_product['imagePath']) : $ph->image_path('no-photo.jpg'),
                'class' => 'image'
            ])
            ->tag_close('a')
            ->link($_product['name'], $_product['fullUrl'], ['class' => 'name'])
        ?>
        <div class="price-container">
            <?php
            if ($_product['available']) {
                if (!empty($_product['priceByr'])) {
                    $ph->tag('span', CurrencyHelper::price_byr($_product['priceByr']), [
                            'class' => 'price',
                            'data-toggle' => 'tooltip',
                            'title' => 'цена после деноминации',
                        ])
                        ->tag('span', ' р. ', ['class' => 'price-currency'])
                        ->tag('span', '&nbsp; / &nbsp; <span>' . CurrencyHelper::price_byr_before_denomination($_product['priceByr']) . '</span> р.', [
                            'class' => 'price-before-denomination',
                            'data-toggle' => 'tooltip',
                            'title' => 'цена до деноминации',
                        ]);
                } else {
                    $ph->tag('span', 'Цену уточняйте', ['class' => 'price-currency']);
                }
            } else {
                $ph->tag('span', 'Нет в наличии', ['class' => 'not-available']);
            }
            ?>
        </div>
        <?php $ph->link('<i class="glyphicon glyphicon-plus"></i>Подробнее', $_product['fullUrl'], ['class'=> 'btn btn-default read-more']);?>
    </div>
</div>

<script>
    $(function () {     // activate bootstrap tooltips
        $("[data-toggle='tooltip']").tooltip();
    });
</script>