<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("");


?>
    <div class=" walp">
        <div class="container">
            <? $APPLICATION->AddChainItem('Главная', "/");
            $APPLICATION->IncludeComponent("bitrix:breadcrumb", "bredscrumb", Array(
                "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
            ),
                false
            ); ?>
        </div>
        <?
        $url = parse_url($_SERVER['REQUEST_URI']);
        $redyelementcode = explode("/", $url['path']);

        $APPLICATION->IncludeComponent("bitrix:news.detail", "detail-catalog", Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
            "ADD_ELEMENT_CHAIN" => "Y",    // Включать название элемента в цепочку навигации
            "ADD_SECTIONS_CHAIN" => "Y",    // Включать раздел в цепочку навигации
            "AJAX_MODE" => "N",    // Включить режим AJAX
            "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
            "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
            "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
            "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
            "BROWSER_TITLE" => "-",    // Установить заголовок окна браузера из свойства
            "CACHE_GROUPS" => "Y",    // Учитывать права доступа
            "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
            "CACHE_TYPE" => "A",    // Тип кеширования
            "CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
            "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
            "DISPLAY_BOTTOM_PAGER" => "Y",    // Выводить под списком
            "DISPLAY_DATE" => "Y",    // Выводить дату элемента
            "DISPLAY_NAME" => "Y",    // Выводить название элемента
            "DISPLAY_PICTURE" => "Y",    // Выводить детальное изображение
            "DISPLAY_PREVIEW_TEXT" => "Y",    // Выводить текст анонса
            "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
            // "ELEMENT_CODE" => "{$_REQUEST["ELEMENT_CODE"]}",    // Код новости
            "ELEMENT_CODE" => "$redyelementcode[2]",    // Код новости
            "ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],    // ID новости
            "FIELD_CODE" => array(    // Поля
                0 => "",
                1 => "",
            ),
            "IBLOCK_ID" => "",    // Код информационного блока
            "IBLOCK_TYPE" => "service",    // Тип информационного блока (используется только для проверки)
            "IBLOCK_URL" => "",    // URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",    // Включать инфоблок в цепочку навигации
            "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
            "META_DESCRIPTION" => "-",    // Установить описание страницы из свойства
            "META_KEYWORDS" => "-",    // Установить ключевые слова страницы из свойства
            "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
            "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
            "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
            "PAGER_TITLE" => "Страница",    // Название категорий
            "PROPERTY_CODE" => array('ATTR_TYPE' => "ATTR_TYPE"),
            "SET_BROWSER_TITLE" => "Y",    // Устанавливать заголовок окна браузера
            "SET_CANONICAL_URL" => "N",    // Устанавливать канонический URL
            "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
            "SET_META_DESCRIPTION" => "Y",    // Устанавливать описание страницы
            "SET_META_KEYWORDS" => "Y",    // Устанавливать ключевые слова страницы
            "SET_STATUS_404" => "N",    // Устанавливать статус 404
            "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
            "SHOW_404" => "N",    // Показ специальной страницы
            "STRICT_SECTION_CHECK" => "N",    // Строгая проверка раздела для показа элемента
            "USE_PERMISSIONS" => "N",    // Использовать дополнительное ограничение доступа
            "USE_SHARE" => "N",    // Отображать панель соц. закладок
            "COMPONENT_TEMPLATE" => ".default"
        ),
            false
        ); ?>
        <? //$APPLICATION->AddChainItem($APPLICATION->GetTitle());?>
    </div>
    <!--  </div>-->
    <div class="aside">
        <div class="title-basket">Корзина</div>
        <div class="content-aside-walp">
            <div class="empty-basket">Ваша корзина пуста</div>
            <div class="status-basket"></div>
            <div class="content-basket"></div>
        </div>

        <div class="oreder-link">
            <div class="back-button clearfix">
                <i class="fas fa-angle-down"></i>
            </div>
            <span class="order-link-text">Оформить заказ</span>
            <div class="overlay-form">
                <form id="order_form" action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data"
                      class="order-form ">
                    <div class="form-group">
                        <input type="text" name="name-order" placeholder="Имя*" required>
                        <input type="email" name="email-order" placeholder="E-mail">
                        <input class="phone" type="text" name="phone-order" placeholder="Телефон*" required>
                        <select class="select-box2" name="zhk-order">
                            <?php
                            /*
                                                        if (date('m') != 04 || date('m') != 05 || date('m') != 06 || date('m') != 07 || date('m') != 08 || date('m') != 09) {
                                                            echo '
                                                            <option value="ЖК «Grand Comfort 2">
                                                                ЖК «Grand Comfort 2»
                                                            </option>
                                                        ';
                                                        }
                                                        ?>
                                                        <?php
                                                        if (date('m') != 04 || date('m') != 05 || date('m') != 06  ) {
                                                            echo '
                                                            <option value="Элитный комплекс «Green Park Солотча-2»">
                                                                Элитный комплекс «Green Park Солотча-2»
                                                            </option>
                                                        ';
                                                        }*/
                            ?>
                            <option value="По умолчанию">Выберите ваш ЖК</option>
                            <option value="Элитный комплекс «Green Park Солотча»">
                                Элитный комплекс «Green Park Солотча»
                            </option>
                            <option value="ЖК «Grand Comfort»">
                                ЖК «Grand Comfort»
                            </option>
                            <option value="ЖК «Евросити»">
                                ЖК «Евросити»
                            </option>
                            <option value="ЖК «Изумрудная поляна»">
                                ЖК «Изумрудная поляна»
                            </option>
                            <option value="ЖК «Еврокомфорт 2»">
                                ЖК «Еврокомфорт 2»
                            </option>
                            <option value="ЖК «Еврокомфорт»">
                                ЖК «Еврокомфорт»
                            </option>
                            <option value="ЖК «Премьер»">
                                ЖК «Премьер»
                            </option>


                        </select>
                        <input type="text" name="adress-order" placeholder="Адрес*" required>
                        <textarea name="text-order" placeholder="Комментарий"></textarea>
                    </div>
                    <div class="last-field-order-form">* - поля, обязательные для заполнения</div>
                    <input type="submit" class="submit-order-form" value="Отправить"/>


                </form>
            </div>

        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>