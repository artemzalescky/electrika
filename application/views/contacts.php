<?php $ph->include_css('children-catalog.css') ?>

      <div class="container">
          <div class="col-lg-8">
                <div style="width: 100%; height: 370px; outline: 0; border: 0;" id="map">
                <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=L6EXPO3e_tQbK8PVSs3OrCReVhyaCTlN&lang=ru_RU&sourceType=constructor"></script>
                </div>
          </div>
          <div class="col-lg-4">
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
                    г.Минск ул. Малинина 35а <br>рынок “Свелта” павильон 2/7-50
                </li>
            </ul>
          </div>
      </div>

<br>
