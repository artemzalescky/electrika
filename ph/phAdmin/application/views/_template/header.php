<nav id="main-nav-bar" class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <?php $ph->system_link('phAdmin', '/', ['class' => 'navbar-brand']) ?>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><?php $ph->system_link('Продукция', '/catalog')?></li>
                <li><?php $ph->system_link('Курсы валют', '/currency')?></li>
                <li><?php $ph->system_link($ph->lang->Ph_NavBar_Users, '/user')?></li>
                <li><?php $ph->system_link($ph->lang->Ph_NavBar_Themes, '/theme')?></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php
                if (\ph\phAdmin\application\models\AuthModel::getInstance()->isUserLoggedIn()) {
                    $ph->tag_open('li')
                        ->system_link($ph->lang->Ph_NavBar_Logout, '/auth/logout')
                        ->tag_close('li');
                }
                ?>
            </ul>
        </div>
    </div>
</nav>