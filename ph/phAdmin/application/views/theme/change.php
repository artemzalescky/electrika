<div class="well">
    <form action="<?= $ph->system_url('/theme/update')?>" method="post" class="form-horizontal">
        <fieldset>
            <legend><?= $ph->lang->Ph_Theme_Change_FormTitle ?></legend>
            <div class="form-group">
                <label for="inputTheme" class="col-lg-2 control-label"><?= $ph->lang->Ph_Theme_Change_FormLabel_Theme ?></label>
                <div class="col-lg-10">
                    <select id="inputTheme" name="theme" class="form-control">
                        <?php foreach ($themes as $theme) {
                            if ($theme === $currentTheme) {
                                $ph->tag('option', $theme, ['value' => $theme, 'selected' => 'selected']);
                            } else {
                                $ph->tag('option', $theme, ['value' => $theme]);
                            }
                         } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php $ph->input_submit(['value' => $ph->lang->Ph_Button_Save, 'class' => 'btn btn-primary']) ?>
                    <?php $ph->system_link($ph->lang->Ph_Button_Cancel, '/theme', ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </fieldset>
    </form>
</div>