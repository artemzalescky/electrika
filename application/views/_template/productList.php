<h2 class="title text-center">Продукция</h2>
<div class="category-tab"><!--category-tab-->

    <div class="tab-content">
        <div class="tab-pane fade active in" id="tshirt" >

            <?php foreach($products as $product) { ?>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <?php $ph->tag('img', null, ['src' => $ph->path($product['imagePath'])]) ?>
                            <h3 style="color: #000000"><?=$product['name'];?></h3>
                            <h2><?=$product['priceByr']?> <span style="color: #000000">руб</span></h2>

                            <?php $ph->link('<i class="glyphicon glyphicon-plus"></i>Подробнее', $product['fullUrl'], ['class'=> 'btn btn-default read-more']);?>
                        </div>

                    </div>
                </div>
            </div>
           <? } ?>
        </div>
    </div>
</div><!--/category-tab-->