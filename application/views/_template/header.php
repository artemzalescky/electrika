
<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top headroom" >
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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Каталог <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Розетки и выключатели</a></li>
                        <li><a href="#">Лампочки</a></li>
                        <li><a href="#">Кабель и провод</a></li>
                    </ul>
                </li>
                <li>
                    <?php $ph->link('Контакты', '/') ?>
                </li>
                <li>
                    <?php $ph->link('Доставка', '/') ?>
                </li>
                <li>
                    <?php $ph->link('О компании', '/') ?>
                </li>
                <li>
                    <?php $ph->link('Новости', '/') ?>
                </li>
                <li><a class="btn" href="#">SIGN IN / SIGN UP</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>