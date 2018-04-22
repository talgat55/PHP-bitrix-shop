</div>
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<footer>
    <div class="container clearfix">
        <div class="col-md-7 clearfix">
            <div class="col-md-3">
                <h4>Закажи сейчас</h4>
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/phone.png">
                <p><a href="tel:+74912777774" class="footer-link-phone">8 (4912) 77-77-74</a></p>
            </div>
            <div class="col-md-3">
                <h4>Адрес</h4>
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/geo.png">
                <p>г. Рязань, Солотчинское шоссе, дом 2</p>
            </div>
            <div class="col-md-3">
                <h4>Время работы</h4>
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/clock.png">
                <p>Пн Вт Ср Чт Пт СБ <span class="footer-calendar-spec">ВС</span><br/>
                    8:00–19:00</p>
            </div>

        </div>
        <div class="col-md-5">
            <a href="#" class="btn-modal-feedback">
                Обратная связь
            </a>

        </div>


    </div>

</footer>
<div class="footer-bottom clearfix">
    <div class="container">
        <a target="_blank" title="Перейти на сайт разработчика" href="http://asmart-group.ru/">Сайт разработан
            IT-Company <span>ASMART</span></a>
    </div>

</div>
<div class="item-product-modal"   >


    <div class="container-item clearfix">
        <i class="close fas fa-times"></i>
        <div class="bx-breadcrumb">
            <div class="bx-breadcrumb-item" id="bx_breadcrumb_0" itemscope=""
                 itemtype="http://data-vocabulary.org/Breadcrumb" itemref="bx_breadcrumb_1">

                <a href="/" title="Главная" itemprop="url">
                    <span itemprop="title">Главная</span>
                </a>
            </div>
            <div class="bx-breadcrumb-item second" id="bx_breadcrumb_1"  itemprop="child">
                <i class="fa fa-angle-right"></i>
                <a href="#"   itemprop="url">
                    <span></span>
                </a>
            </div>
            <div class="bx-breadcrumb-item last">
                <i class="fa fa-angle-right"></i>
                <span></span>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="col-md-4">

        </div>
        <div class="col-md-8">

        </div>
    </div>


        <div class="item-modal-order clearfix">
            <div class="block-price-order">

            </div>
        </div>
</div>
<!--  feedback -->

<div class="feedback-modal">
    <i class="  fas fa-times"></i>
    <? $APPLICATION->IncludeComponent(
        "slam:easyform",
        ".default",
        array(
            "CATEGORY_EMAIL_PLACEHOLDER" => "",
            "CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
            "CATEGORY_EMAIL_TYPE" => "email",
            "CATEGORY_EMAIL_VALIDATION_ADDITIONALLY_MESSAGE" => "data-bv-emailaddress-message=\"E-mail введен некорректно\"",
            "CATEGORY_EMAIL_VALIDATION_MESSAGE" => "Обязательное поле",
            "CATEGORY_EMAIL_VALUE" => "",
            "CATEGORY_MESSAGE_PLACEHOLDER" => "",
            "CATEGORY_MESSAGE_TITLE" => "Сообщение",
            "CATEGORY_MESSAGE_TYPE" => "textarea",
            "CATEGORY_MESSAGE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
            "CATEGORY_MESSAGE_VALUE" => "",
            "CATEGORY_PHONE_INPUTMASK" => "N",
            "CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
            "CATEGORY_PHONE_PLACEHOLDER" => "",
            "CATEGORY_PHONE_TITLE" => "Мобильный телефон",
            "CATEGORY_PHONE_TYPE" => "tel",
            "CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
            "CATEGORY_PHONE_VALUE" => "",
            "CATEGORY_TITLE_PLACEHOLDER" => "",
            "CATEGORY_TITLE_TITLE" => "Ваше имя",
            "CATEGORY_TITLE_TYPE" => "text",
            "CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
            "CATEGORY_TITLE_VALUE" => "",
            "CREATE_SEND_MAIL" => "",
            "DISPLAY_FIELDS" => array(
                0 => "TITLE",
                1 => "EMAIL",
                2 => "PHONE",
                3 => "MESSAGE",
                4 => "",
            ),
            "EMAIL_BCC" => "",
            "EMAIL_TO" => "lightx_design@yahoo.com",
            "ENABLE_SEND_MAIL" => "Y",
            "ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
            "EVENT_MESSAGE_ID" => array(),
            "FIELDS_ORDER" => "TITLE,EMAIL,PHONE,MESSAGE",
            "FORM_AUTOCOMPLETE" => "Y",
            "FORM_ID" => "FORM10",
            "FORM_NAME" => "Форма обратной связи",
            "FORM_SUBMIT_VALUE" => "Отправить",
            "FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" href=\"/privacy\">персональных данных</a>",
            "HIDE_ASTERISK" => "N",
            "HIDE_FIELD_NAME" => "N",
            "HIDE_FORMVALIDATION_TEXT" => "N",
            "INCLUDE_BOOTSRAP_JS" => "Y",
            "MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи",
            "OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение 2х часов",
            "REPLACE_FIELD_FROM" => "N",
            "REQUIRED_FIELDS" => array(
                0 => "EMAIL",
            ),
            "SEND_AJAX" => "Y",
            "SHOW_MODAL" => "N",
            "TITLE_SHOW_MODAL" => "Спасибо!",
            "USE_BOOTSRAP_CSS" => "Y",
            "USE_BOOTSRAP_JS" => "N",
            "USE_CAPTCHA" => "N",
            "USE_FORMVALIDATION_JS" => "Y",
            "USE_IBLOCK_WRITE" => "N",
            "USE_JQUERY" => "N",
            "USE_MODULE_VARNING" => "N",
            "WIDTH_FORM" => "500px",
            "WRITE_MESS_FILDES_TABLE" => "N",
            "_CALLBACKS" => "",
            "COMPONENT_TEMPLATE" => ".default"
        ),
        false
    ); ?>

</div>

</body>
</html>