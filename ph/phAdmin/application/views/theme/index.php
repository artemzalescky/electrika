<?php $ph->renderAllMessages(); ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $ph->lang->Ph_Theme_Index_CurrentTheme ?></h3>
    </div>
    <div class="panel-body">
        <span><?= $currentTheme?>
    </div>
</div>

<?php $ph->system_link($ph->lang->Ph_Theme_Index_Button_Change, '/theme/change', ['class' => 'btn btn-default'])
    ->system_form_link($ph->lang->Ph_Theme_Index_Button_SetDefault, '/theme/setDefault', 'post', ['class' => 'btn btn-default', 'style' => 'margin-left: 5px']) ?>
