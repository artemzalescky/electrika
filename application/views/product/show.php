
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
            'class' => 'img-circle image',
            'data-src' => 'holder.js/140x140'
        ]);
        ?>
    </div>
    <div class="col-lg-8">
        <h3><?php echo $product['name']?></h3>
        <?php echo $product['description']; ?>
        <br><br/>
        <h3>Приобрести данный товар можно по телефону:</h3>
        мтс <?php $ph->link('8 029 850 40 85', '/contacts')?>
        <?php $ph->single_tag('br') ?>
        Velcom <?php $ph->link('8 044 461 09 06', '/contacts') ?>

    </div>
</div>

