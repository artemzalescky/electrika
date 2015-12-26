<ul class="nav nav-pills">
    <li class="active">
        <?php $ph->system_link('Все каталоги', '/catalog') ?>
    </li>
</ul>

<?php $ph->tag('hr')->renderAllMessages(); ?>

<div class="well">
    <form action="<?= $ph->system_url('/catalog/create/' . $parentCatalog['id'])?>" method="post" class="form-horizontal">
        <fieldset>
            <legend> Добавление подкаталога для <span class="underlined"> <?= $parentCatalog['name'] ?> </span> </legend>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label"> Название </label>
                <div class="col-lg-10">
                    <input type="text" value="<?= $this->param('catalog')['name'] ?>" name="catalog[name]" placeholder="Название" id="inputName" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="inputUrl" class="col-lg-2 control-label"> URL </label>
                <div class="col-lg-10">
                    <input type="text" value="<?= $this->param('catalog')['url'] ?>" name="catalog[url]" placeholder="URL" id="inputUrl"
                           class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="inputUrl" class="col-lg-2 control-label"> Приоритет </label>
                <div class="col-lg-10">
                    <input type="text" value="<?= !empty($this->param('catalog')['priority']) ? $this->param('catalog')['priority'] : 0 ?>"
                           name="catalog[priority]" placeholder="Приоритет" id="inputPriority"
                           class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php $ph->input_submit(['value' => $ph->lang->Ph_Button_Save, 'class' => 'btn btn-primary'])
                        ->space()
                        ->system_link($ph->lang->Ph_Button_Cancel, '/catalog', ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </fieldset>
    </form>
</div>
