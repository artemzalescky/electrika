<h3> Редактирование курсов валют </h3>
<hr>
<a href="http://myfin.by/bank/kursy_valjut_nbrb" target="_blank"> Курсы валют НацБанка РБ </a>
<hr>

<?php $ph->renderAllMessages(); ?>

<?php foreach($exchangeRates as $exchangeRate) { ?>
<div class="well">
    <form action="<?= $ph->system_url('/currency/save/' . $exchangeRate['currency']) ?>" method="post" class="form-horizontal">
        <fieldset>
            <legend><?= $exchangeRate['name'] ?></legend>
            <div class="form-group">
                <label for="inputValue" class="col-lg-2 control-label"> Курс </label>
                <div class="col-lg-10">
                    <input type="text" value="<?= $exchangeRate['value'] ?>" class="form-control" id="inputValue"
                           placeholder="Курс" name="exchangeRate[value]" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <?php $ph->input_submit(['value' => 'Сохранить', 'class' => 'btn btn-primary'])
                        ->space()
                        ->system_link('Отмена', '/', ['class' => 'btn btn-default']);
                    ?>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<?php } ?>

<hr>
