<!DOCTYPE html>
<html>
<head>
    <title> phAdmin </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $ph->include_system_css('themes/' . \ph\phAdmin\application\models\ThemeModel::getInstance()->getCurrentThemeFile())
            ->include_system_css('skeleton.css')
            ->include_system_css('glyphicon.css')
            ->include_system_js_lib('jquery-2.1.4.min.js')
            ->include_system_js_lib('bootstrap-3.3.5-dist/bootstrap.min.js'); ?>
</head>

<body>

    <?php $this->renderTemplate('header-unathorized') ?>

    <div class="container">
        <?php $this->renderContent() ?>
    </div>

    <?php $this->renderTemplate('footer') ?>

</body>
</html>