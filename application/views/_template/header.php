
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
