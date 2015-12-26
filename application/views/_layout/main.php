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
        ->include_css('header/bootstrap-theme.css')

        /*Footer*/
        ->include_css('footer/footer.css')
    ?>
</head>

<body>

<?php $this->renderTemplate('header') ?>

<div class="container" style="margin-top: 100px">
    <?php $this->renderContent() ?>
</div>

<?php $this->renderTemplate('footer') ?>

</body>
</html>