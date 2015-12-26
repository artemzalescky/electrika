<?php $this->renderTemplate('catalog-edit-menu');
$ph->renderAllMessages(); ?>

<div class="well">
    <form action="<?= $ph->system_url('/catalog/updateDescription/' . $catalog['id'])?>" method="post" class="form-horizontal">
        <fieldset>
            <legend> Редактирование описания каталога <span class="underlined"> <?= $catalog['name'] ?> </span> </legend>
            <div class="form-group">
                <label for="inputDescription" class="col-lg-2 control-label"> Описание </label>
                <div class="col-lg-10">
                    <textarea id="inputDescription" name="catalog[description]" class="form-control exploded-textarea"><?= $catalog['description'] ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php $ph->input_submit(['value' => $ph->lang->Ph_Button_Save, 'class' => 'btn btn-primary'])
                        ->space()
                        ->system_link($ph->lang->Ph_Button_Cancel, '/catalog/edit/' . $catalog['id'], ['class' => 'btn btn-default'])
                    ?>
                </div>
            </div>
        </fieldset>
    </form>
</div>
