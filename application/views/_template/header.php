<?php
    $currentPage = 'index';
    $routeData = $this->viewData->getRouteData();
    if ($routeData->getControllerName() == 'catalog' || $routeData->getControllerName() == 'product') {
        $currentPage = 'catalog';
    }
    if ($routeData->getControllerName() == 'contacts') {
        $currentPage = 'contacts';
    }
    if ($routeData->getControllerName() == 'delivery') {
        $currentPage = 'delivery';
    }
    if ($routeData->getControllerName() == 'about') {
        $currentPage = 'about';
    }
    if ($routeData->getControllerName() == 'news') {
        $currentPage = 'news';
    }
?>

<div id="top-menu" class="navbar navbar-inverse navbar-fixed-top headroom" >
    <div id="menu-content" class="container">
        <div class="navbar-header">
            <!-- Button for smallest screens -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <?php $ph->image_link('logo.png', '/', ['alt' => '220minsk.by'], ['class' => 'navbar-brand']) ?>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right">
                <li <?php if ($currentPage == 'index') {echo 'class="active"';} ?>>
                    <?php $ph->link('Главная', '/') ?>
                </li>
                <li <?php if ($currentPage == 'catalog') {echo 'class="active"';} ?>>
                    <?php $ph->link('Каталог', '/catalog') ?>
                </li>
                <li <?php if ($currentPage == 'contacts') {echo 'class="active"';} ?>>
                    <?php $ph->link('Контакты', '/contacts') ?>
                </li>
                <li <?php if ($currentPage == 'delivery') {echo 'class="active"';} ?>>
                    <?php $ph->link('Доставка', '/delivery') ?>
                </li>
                <li <?php if ($currentPage == 'about') {echo 'class="active"';} ?>>
                    <?php $ph->link('О компании', '/about') ?>
                </li>
                <li <?php if ($currentPage == 'news') {echo 'class="active"';} ?>>
                    <?php $ph->link('Новости', '/news') ?>
                </li>
            </ul>
        </div>
    </div>
</div>
