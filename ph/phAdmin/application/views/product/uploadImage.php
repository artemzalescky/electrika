<?php

$ph->include_system_css('upload-image.css');

$this->renderTemplate('catalog-edit-menu');
$this->renderTemplate('catalog-editProducts-header');?>

<h3> Редактирование изображения товара <span class="underlined"> <?= $product['name'] ?> </h3>

<hr>

<?php $ph->renderAllMessages(); ?>

<?php if (isset($currentImagePath)) { ?>
    <div class="well">
        <form class="form-horizontal">
            <fieldset>
                <legend> Текущее изображение товара <span class="underlined"> <?= $product['name'] ?> </span> </legend>
                <div class="form-group">
                    <label for="inputImage" class="col-lg-2 control-label"> Изображение </label>
                    <div class="col-lg-10">
                        <?php $ph->tag('img', null, ['src' => $ph->path($currentImagePath), 'class' => 'image-preview']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <?php $ph->link('Скачать', $currentImagePath, ['class' => 'btn btn-primary', 'download' => $currentImagePath])
                            ->space()
                            ->system_link($ph->lang->Ph_Button_Cancel, '/catalog/editProducts/' . $catalog['id'], ['class' => 'btn btn-default'])
                        ?>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
<?php } else { ?>
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title"> Текущее изображение товара отсутствует </h3>
        </div>
        <div class="panel-body">
            Для закрузки изображения товара перейдите к форме 'Редактирование изображения товара' <br>
            Выберите подходящий файл на своем компьютере <br>
            Затем нажмите 'Зарузить'
        </div>
    </div>
<?php } ?>

<div class="well">
    <form action="<?= $ph->system_url('/product/saveImage/' . $catalog['id'] . '/' . $product['id'])?>"
          method="post" class="form-horizontal" enctype="multipart/form-data" >
        <fieldset>
            <legend> Редактирование изображения товара <span class="underlined"> <?= $product['name'] ?> </span> </legend>
            <div class="form-group">
                <label for="inputImage" class="col-lg-2 control-label"> Изображение </label>
                <div class="col-lg-10">
                    <input type="file" name="productImage" id="inputImage" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php $ph->input_submit(['value' => 'Загрузить', 'class' => 'btn btn-primary'])
                        ->space()
                        ->system_link($ph->lang->Ph_Button_Cancel, '/catalog/editProducts/' . $catalog['id'], ['class' => 'btn btn-default'])
                    ?>
                </div>
            </div>
        </fieldset>
    </form>
</div>


<div class="panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title"> Внимание </h3>
    </div>
    <div class="panel-body">
        Файл изображения товара может иметь формат jpg(jpeg), png или gif <br>
        Размер файла не должен превышать <b><?= $maxImageSizeMb ?> Мб </b> <br>
        Если файл имеет формат, отличный от jpeg, то после загрузки он будет переконвертирован
    </div>
</div>

<hr>