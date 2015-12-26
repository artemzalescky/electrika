<?php $this->renderTemplate('catalog-edit-menu');
$this->renderTemplate('catalog-editProducts-header');
$ph->renderAllMessages(); ?>

<div class="well">
    <form action="<?= $ph->system_url('/product/create/' . $catalog['id'])?>" method="post" class="form-horizontal">
        <fieldset>
            <legend> Добавление нового товара </legend>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label"> Название </label>
                <div class="col-lg-10">
                    <input type="text" value="<?= $product['name'] ?>" name="product[name]" placeholder="Название" id="inputName" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescription" class="col-lg-2 control-label"> Описание </label>
                <div class="col-lg-10">
                    <textarea id="inputDescription" name="product[description]" class="form-control exploded-textarea"><?= urldecode($product['description']) ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputUrl" class="col-lg-2 control-label"> Приоритет </label>
                <div class="col-lg-10">
                    <input type="text" value="<?= !empty($product['priority']) ? $product['priority'] : 0 ?>"
                           name="product[priority]" placeholder="Приоритет" id="inputPriority"
                           class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="inputMeasure" class="col-lg-2 control-label"> Единица измерения </label>
                <div class="col-lg-10">
                    <input type="text" value="<?= !empty($product['measure']) ? $product['measure'] : 'шт.' ?>"
                           name="product[measure]" placeholder="Единица измерения" id="inputMeasure" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAvailable" class="col-lg-2 control-label"> В наличии </label>
                <div class="col-lg-10">
                    <div class="checkbox">
                        <label>
                            <input id="inputAvailable" name="product[available]" type="checkbox" <?php if ($product['available'] == 1) echo 'checked' ?>>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPriceUsd" class="col-lg-2 control-label"> Цена в USD </label>
                <div class="col-lg-10">
                    <input type="text" value="<?= $product['priceUsd'] ?>" name="product[priceUsd]" placeholder="Цена в USD" id="inputPriceUsd"
                           class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPriceByr" class="col-lg-2 control-label"> Цена в BYR </label>
                <div class="col-lg-10">
                    <input type="text" value="<?= $product['priceByr'] ?>" name="product[priceByr]" placeholder="Цена в BYR" id="inputPriceByr"
                           class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php $ph->input_submit(['value' => $ph->lang->Ph_Button_Save, 'class' => 'btn btn-primary'])
                        ->space()
                        ->system_link($ph->lang->Ph_Button_Cancel, '/catalog/editProducts/' . $catalog['id'], ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </fieldset>
    </form>
</div>
