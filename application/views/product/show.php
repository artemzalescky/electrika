
<ol class="breadcrumb">
    <?php foreach ($pathToCatalog as $part) {
        $ph->tag_open('li')
            ->link($part['name'], $part['fullUrl'])
            ->tag_close('li');
    }
    $ph->tag('li', $product['name'], ['class' => 'active']);
    ?>
</ol>

<hr>

<div class="container" style="min-height: 300px">

    <div class="col-lg-4" style="margin-top: 20px">
        <?php  $ph->image('product/'.$currentCatalog['id'].'/'.$product['id'].'.jpeg', [
            'class' => 'image',
            'style' => 'max-width: 100%',
            'data-src' => 'holder.js/140x140'
        ]);
        ?>
    </div>
    <div class="col-lg-8">
        <h3><?php echo $product['name']?></h3>
        <?php echo $product['description']; ?>
        <br><br>
        <?php if ($product['available']) {
            echo '<h5><span class="glyphicon glyphicon-ok text-success"></span> &nbsp;Есть в наличии</h5>';
        } else {
            echo '<h5><span class="glyphicon glyphicon-remove text-danger"></span> Нет в наличии</h5>';
        } ?>
        <br>
        <h4>Цена : <span class="text-info" style="font-weight: bold; font-size:20px"> <?= number_format($product['priceByr'], 0, '.', ' ') ?> </span> руб. </h4>
        <br>
        <h4>Приобрести данный товар можно по телефонам:</h4>
        мтс <?php $ph->link('8 029 850 40 85', '/contacts')?>
        <?php $ph->single_tag('br') ?>
        Velcom <?php $ph->link('8 044 461 09 06', '/contacts') ?>

    </div>
</div>

