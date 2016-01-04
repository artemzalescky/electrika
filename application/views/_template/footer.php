<div id="divFooter" class="footerArea">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3>Каталог</h3>
                <p>
                    <?php
                        $ph
                            ->link('Кабель и провод', '/catalog/kabel-i-provod')->single_tag('br')
                            ->link('Розетки и выключатели', '/catalog/rozetki-i-vykljuchateli')->single_tag('br')
                            ->link('Корпуса металлические, боксы', '/catalog/korpusa-metallicheskie-i-boksy')->single_tag('br')
                            ->link('Коробки распределительные', '/catalog/korobki-raspredelitelnye-raspajachnye')->single_tag('br')
                            ->link('Модульное оборудование', '/catalog/modulnoe-oborudovanie')->single_tag('br')
                            ->link('Светотехника', '/catalog/svetotehnika')->single_tag('br')
                            ->link('Силовые разъемы', '/catalog/silovye-razjomy')->single_tag('br')
                            ->link('Счётчики', '/catalog/schjotchiki')->single_tag('br')
                            ->link('Стабилизаторы напряжения', '/catalog/stabilizatory-naprjazhenija')->single_tag('br')
                            ->link('Системы для прокладки кабеля', '/catalog/sistemy-dlja-prokladki-kabelja')->single_tag('br')
                            ->link('Аксессуары для монтажа', '/catalog/aksesuary-dlja-montazha')->single_tag('br')
                            ->link('Труба ПНД', '/catalog/truba-pnd')->single_tag('br')
                    ?>
                </p>
            </div>
            <div class="col-md-3">
                <h3>Последние новости</h3>
                <p>
                    <?php $ph->link('Мобильная версия сайта', '/news') ?>
                    <br>
                    <span style="text-transform:none;">20.12.2015</span>
                </p>
                <p>
                    <?php $ph->link('Новый дизайн сайта', '/news') ?>
                    <br>
                    <span style="text-transform:none;">05.12.2015</span>
                </p>
                <p>
                    <?php $ph->link('Снижение цен на кабели и провода', '/news') ?><br>
                    <span style="text-transform:none;">03.11.2015</span>
                </p>
                <p>
                    <?php $ph->link('Все новости', '/news') ?>
                </p>
            </div>
            <div class="col-md-3">
                <h3>График работы</h3>
                Понедельник     Выходной <br>
                Вторник 08:00 — 18:00 <br>
                Среда   08:00 — 18:00 <br>
                Четверг 08:00 — 18:00 <br>
                Пятница 08:00 — 18:00 <br>
                Суббота 08:00 — 18:00 <br>
                Воскресенье     08:00 — 15:00 <br>
                для того чтобы заказать товар на завтра звоните до 20-00 <br>
            </div>
            <div class="col-md-3">
                <h3>Контакты</h3>
                <ul id="contact-info">
                    <li>
                        <span class="glyphicon glyphicon-phone-alt"></span>
                        <span class="field">Телефон:</span>
                        <br>
                        <?php $ph->link('8 029 850 40 85', '/contacts')
                            ->single_tag('br')
                            ->link('8 044 461 09 06', '/contacts') ?>
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-envelope"></span>
                        <span class="field">Email:</span>
                        <br>
                        <?php $ph->link('north-s@tut.by', '/contacts') ?>
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-home"></span>
                        <span class="field">Адрес:</span>
                        <br>
                        <?php $ph->link('г.Минск ул. Малинина 35а <br> рынок “Свелта” павильон 2/7-50', '/contacts') ?>
                    </li>
                </ul>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-12">
                <p class="copyright">
                    Copyright © 2015 &nbsp; 220minsk.by. &nbsp; All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</div>