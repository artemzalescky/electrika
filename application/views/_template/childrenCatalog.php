<div class="container marketing">
    <div class="row">
      <?php  foreach($nearestChildren as $catalog) { ?>
    <div class="col-lg-4">
        <?php $ph->image_link('catalog/'.$catalog['id'].'.jpeg', '/catalog/' . $catalog['url'], [
            'class' => 'img-circle',
            'data-src' => 'holder.js/140x140',
            'style' => 'max-width: 140px; max-height: 140px;'
        ])
            ->link_open('/catalog/' . $catalog['url'])
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