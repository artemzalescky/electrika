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
    <div class="carousel-inner">
        <div class="item">
            <?php $ph->image('Carousel/1.jpg', ['data-src' => 'holder.js/900x500/auto/#777:#7a7a7a/text: Резетки' ]) ?>
            <div class="container">
                <div class="carousel-caption">
                    <h1>Розетки и выключатели</h1>
                    <p>Продажа розеток и выключателей всех моделей м производителей в Минске</p>
                    <p><a class="btn btn-lg btn-primary" href="./Carousel/Carousel.html" role="button">Подробнее</a></p>
                </div>
            </div>
        </div>
        <div class="item active">
            <?php $ph->image('Carousel/2.jpg', ['data-src' => 'holder.js/900x500/auto/#777:#7a7a7a/text: Лампочкм' ]) ?>
            <div class="container">
                <div class="carousel-caption">
                    <h1>Светотехника</h1>
                    <p> Продажа ламп накаливания, прожекторов светодиодных и много другого</p>
                    <p><a class="btn btn-lg btn-primary" href="./Carousel/Carousel.html" role="button">Подробнее</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <?php $ph->image('Carousel/3.jpg', ['data-src' => 'holder.js/900x500/auto/#777:#7a7a7a/text: Кабель и провода' ]) ?>
            <div class="container">
                <div class="carousel-caption">
                    <h1>Кабель и провод</h1>
                    <p>Продажа кабеля и провода в любом количестве и любой длины в Минске</p>
                    <p><a class="btn btn-lg btn-primary" href="./Carousel/Carousel.html" role="button">Подробнее</a></p>
                </div>
            </div> 
        </div>
    </div>
    <a class="left carousel-control" href="http://bootstrap-3.ru/examples/carousel/#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="http://bootstrap-3.ru/examples/carousel/#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div><!-- /.carousel -->

<div class="container marketing">
    <div class="row">
      <?php  foreach($mainCatalogs as $catalog) { ?>
        <div class="col-lg-4">
            <?php $ph->image_link('catalog/'.$catalog['id'].'.jpeg', '/catalog/' . $catalog['url'], [
                    'class' => 'img-circle',
                    'data-src' => 'holder.js/140x140',
                    'style' => 'max-width: 140px; max-height: 140px;'
                ])
                ->link_open('/catalog/' . $catalog['url'])
                ->tag('h4', $catalog['name'], ['class' => 'catalog-name'])
                ->tag_close('a');
            ?>
            <p class="catalog-short-description">
                <?php
                    if (!empty($catalog['description'])) {
                        $ph->cut_text($catalog['description'], 65)
                            ->text('...');
                    }
                ?>
            </p>
            <p>
                <?php
                    $ph->link_open('/catalog/' . $catalog['url'], ['class' => 'btn btn-default'])
                        ->tag('span', null, ['class' => 'glyphicon glyphicon-list'])
                        ->text(' Посмотреть')
                        ->link_close('a');
                ?>
            </p>
        </div>
        <?php }?>
    </div>
</div>
<br>

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