<ul class="nav nav-pills">
    <li class="active">
        <?php $ph->system_link('Все каталоги', '/catalog') ?>
    </li>
    <li>
        <?php
            if (isset($products)) {
                $ph->tag_open('a', ['href' => $ph->system_url('/catalog/editProducts/' . $catalog['id'])])
                    ->text('Продукция')
                    ->tag('span', count($products), ['class' => 'badge'])
                    ->tag_close('a');
            } else {
                $ph->system_link('Продукция', '/catalog/editProducts/' . $catalog['id']);
            }
        ?>
    </li>
    <li>
        <?php $ph->system_link('Редактировать', '/catalog/edit/' . $catalog['id']) ?>
    </li>
    <li>
        <?php $ph->system_link('Изображение', '/catalog/uploadImage/' . $catalog['id']) ?>
    </li>
    <li>
        <?php $ph->system_link('Описание', '/catalog/editDescription/' . $catalog['id']) ?>
    </li>
</ul>

<hr>