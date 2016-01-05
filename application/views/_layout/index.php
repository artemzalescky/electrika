<!DOCTYPE html>
<html>
<head>
    <title> 220minsk.by </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        $ph->include_system_css('/themes/bootstrap.min.css')
        ->include_system_css('glyphicon.css')
        ->include_system_js_lib('jquery-2.1.4.min.js')
        ->include_system_js_lib('bootstrap-3.3.5-dist/bootstrap.min.js')

        /*Header*/
        ->include_css('header/header.css')
        ->include_css('header/bootstrap-theme.css')

        /*Footer*/
        ->include_css('footer/footer.css')

        /*Carousel*/
        ->include_css('carousel.css')

        /*index*/
        ->include_css('catalog.css')
        ->include_css('logo.css')

        /*Special Offers*/
        ->include_css('special-offer-carousel.css')
        ->include_css('product-list.css')
    ?>
</head>

<body>

<?php $this->renderTemplate('header') ?>

<!--=========================== Carousel ================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
    </ol>
    <div class="carousel-inner" style="height: 500px !important;">
        <div class="item">
            <?php $ph->image('Carousel/1.jpg', ['data-src' => 'holder.js/900x500/auto/#777:#7a7a7a/text: Резетки' ]) ?>
            <div class="container">
                <div class="carousel-caption">
                    <h1>Розетки и выключатели</h1>
                    <p>Продажа розеток и выключателей всех моделей м производителей в Минске</p>
                    <p>
                        <?php $ph->link('Подробнее', '/catalog/rozetki-i-vykljuchateli', ['class' => 'btn btn-lg btn-primary', 'role' => 'button']) ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="item active">
            <?php $ph->image('Carousel/2.jpg', ['data-src' => 'holder.js/900x500/auto/#777:#7a7a7a/text: Лампочкм' ]) ?>
            <div class="container">
                <div class="carousel-caption">
                    <h1>Светотехника</h1>
                    <p> Продажа ламп накаливания, прожекторов светодиодных и много другого</p>
                    <p>
                        <?php $ph->link('Подробнее', '/catalog/svetotehnika', ['class' => 'btn btn-lg btn-primary', 'role' => 'button']) ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="item">
            <?php $ph->image('Carousel/3.jpg', ['data-src' => 'holder.js/900x500/auto/#777:#7a7a7a/text: Кабель и провода' ]) ?>
            <div class="container">
                <div class="carousel-caption">
                    <h1>Кабель и провод</h1>
                    <p>Продажа кабеля и провода в любом количестве и любой длины в Минске</p>
                    <p>
                        <?php $ph->link('Подробнее', '/catalog/kabel-i-provod', ['class' => 'btn btn-lg btn-primary', 'role' => 'button']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="http://bootstrap-3.ru/examples/carousel/#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="http://bootstrap-3.ru/examples/carousel/#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div><!-- /.carousel -->

<?php $this->renderTemplate('children-catalog') ?>

<br>

<!--=========================== Special Offers ================================================== -->
<?php if (!empty($specialOfferProducts)) { ?>
<section>
    <br>
    <div class="container">
        <div class="recommended_items"><!--recommended_items-->
            <h2 id="sale-title" class="title text-center"> Специальные предложения </h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    for ($i = 0; $i < count($specialOfferProducts); $i++) {
                        $groupClass = ($i == 0) ? 'item active' : 'item';
                        $ph->tag_open('div', ['class' => $groupClass]);
                        foreach ($specialOfferProducts[$i] as $product) { ?>
                            <div class="col-sm-3">
                                <div class="product-container text-center">
                                    <?php $ph->tag_open('a', [
                                            'href' => $ph->url("/product/id/{$product['catalogId']}/{$product['id']}"),
                                            'class' => 'image-container'
                                        ])
                                        ->tag('img', null, [
                                            'src' => \application\models\ProductModel::getInstance()->imageExist($product['catalogId'], $product['id'])
                                                ? $ph->image_path("/product/{$product['catalogId']}/{$product['id']}.jpeg")
                                                : $ph->image_path('no-photo.jpg'),
                                            'class' => 'image'
                                        ])
                                        ->tag_close('a')
                                        ->link($product['name'], "/product/id/{$product['catalogId']}/{$product['id']}", ['class' => 'name'])
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
                                    <?php $ph->link('<i class="glyphicon glyphicon-plus"></i>Подробнее',
                                        "/product/id/{$product['catalogId']}/{$product['id']}", ['class'=> 'btn btn-default read-more']);?>
                                </div>
                            </div>
                  <?php }
                        $ph->tag_close('div');
                    } ?>
                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="glyphicon glyphicon-chevron-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa glyphicon glyphicon-chevron-right"></i>
                </a>
            </div>
        </div><!--/recommended_items-->
    </div>
</section>
<?php } ?>

<div class="container">
    <hr>
</div>

<section class="section section--medium">
    <div class="container">
        <ul class="logo-bar">
            <li>
                <?php $ph->image('brands/iek.jpg', ['style' => 'height="52px; width="140px'])?>
            </li>
            <li>
                <?php $ph->image('brands/EATON.gif', ['style' => 'height="52px; width="140px'])?>
            </li>
            <li>
                <?php $ph->image('brands/viko.jpg', ['style' => 'height="52px; width="140px'])?>
            </li>
            <li>
                <?php $ph->image('brands/tdm.jpg', ['style' => 'height="52px; width="140px'])?>
            </li>
            <li>
                <?php $ph->image('brands/ff.jpg', ['style' => 'height="52px; width="140px'])?>
            </li>
            <li>
                <?php $ph->image('brands/Nexans.png', ['style' => 'height="52px; width="140px'])?>
            </li>

        </ul>
    </div>
</section>

<section class="section section--medium padding-bottom-0">
    <div class="container">
        <ul class="logo-bar">
            <li>
                <?php $ph->image('brands/abb.png', ['style' => 'height="52px; width="140px'])?>
            </li>
            <li>
                <?php $ph->image('brands/EKF.jpg', ['style' => 'height="52px; width="140px'])?>
            </li>
            <li>
                <?php $ph->image('brands/gunsan.jpg', ['style' => 'height="52px; width="140px'])?>
            </li>
            <li>
                <?php $ph->image('brands/legrand.jpg', ['style' => 'height="52px; width="140px'])?>
            </li>
            <li>
                <?php $ph->image('brands/avtoprovod.jpg', ['style' => 'height="52px; width="140px'])?>
            </li>
            <li>
                <?php $ph->image('brands/universal.png', ['style' => 'height="52px; width="140px'])?>
            </li>
        </ul>
    </div>
</section>

<br>
<h1 style="text-align: center">Расположение </h1>
<div class="container">
    <hr>
</div>

<div style="width: 100%; height: 370px;outline: 0; border: 0;" id="map">
    <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=L6EXPO3e_tQbK8PVSs3OrCReVhyaCTlN&lang=ru_RU&sourceType=constructor"></script>
</div>

<?php $this->renderTemplate('footer') ?>

</body>
</html>