
<!-- Fixed navbar -->
<div id="top-menu" class="navbar navbar-inverse navbar-fixed-top headroom" >
    <div class="container">
        <div class="navbar-header">
            <!-- Button for smallest screens -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <?php $ph->image_link('logo.png', '/', ['alt' => '220minsk.by'], ['class' => 'navbar-brand']) ?>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right">
                <li class="active">
                    <?php $ph->link('Главная', '/') ?>
                </li>
                <li>
                    <?php $ph->link('Каталог', '/catalog') ?>
                </li>
                <li>
                    <?php $ph->link('Контакты', '/contacts') ?>
                </li>
                <li>
                    <?php $ph->link('Доставка', '/delivery') ?>
                </li>
                <li>
                    <?php $ph->link('О компании', '/about') ?>
                </li>
                <li>
                    <?php $ph->link('Новости', '/news') ?>
                </li>

            </ul>
        </div>
    </div>
</div>

<!-- динамическое подменю Каталога -->
<!--                <li id="catalog-menu-item" class="dropdown">-->
<!--                    --><?php
//                        $ph->link('Каталог <b class="caret"></b>', 'catalog', ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown']);
//                        if (!empty($mainCatalogs)) {
//                            $ph->tag_open('ul', ['class' => 'dropdown-menu', 'id' => 'catalog-dropdown-menu']);
//                            foreach ($mainCatalogs as $mainCatalog) {
//                                $ph->tag_open('li');
//                                $ph->link($mainCatalog['name'], '/catalog/' . $mainCatalog['url']);
//                                $ph->tag_close('li');
//                            }
//                            $ph->tag_close('ul');
//                        }
//                    ?>
<!--                </li>-->