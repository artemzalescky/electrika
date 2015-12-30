<?php $ph->include_css('children-catalog.css') ?>

<div class="container marketing">
    <div class="row">
      <?php  foreach($nearestChildren as $catalog) { ?>
    <div class="col-lg-4 catalog-container">
        <?php
        $ph->link_open('/catalog/' . $catalog['url'], ['class' => 'image-container']);
            if (\application\models\CatalogModel::getInstance()->imageExist($catalog['id'])) {
                $ph->image('catalog/'.$catalog['id'].'.jpeg', [
                    'class' => 'img-circle image',
                    'data-src' => 'holder.js/140x140'
                ]);
            } else {
                $ph->image('no-photo.jpg', [
                    'class' => 'img-circle image',
                    'data-src' => 'holder.js/140x140'
                ]);
            }
            $ph->link_close();

            $ph->link_open('/catalog/' . $catalog['url'])
            ->tag('h4', $catalog['name'], ['class' => 'catalog-name'])
            ->tag_close('a');
        ?>
        <p class="catalog-short-description">
            <?php
            if (!empty($catalog['description'])) {
                $ph->cut_text($catalog['description'], 65)
                    ->text('...');
            }
            ?>
        </p>
        <p>
            <?php
            $ph->link_open('/catalog/' . $catalog['url'], ['class' => 'btn btn-default'])
                ->tag('span', null, ['class' => 'glyphicon glyphicon-list'])
                ->text(' Посмотреть')
                ->link_close('a');
            ?>
        </p>
    </div>
<?php }?>
</div>
</div>