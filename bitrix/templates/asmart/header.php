<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><!doctype html>
<html>
<head>
    <? $APPLICATION->ShowHead() ?>

    <title><? $APPLICATION->ShowTitle() ?></title>
    <link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>

    <?
    CJSCore::Init(array("jquery"));

    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery-1.8.2.min.js");
    //$APPLICATION->AddHeadScript('https://code.jquery.com/jquery-3.3.1.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/default_js.js" );
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.form.js");
   // $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.jgrowl.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/owl.carousel.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/js.cookie.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.mousewheel.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.inputmask.js");
    $APPLICATION->AddHeadScript("https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.5/lodash.js");

  //  $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/jquery.jgrowl.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/fontawesome-all.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/../../css/main/font-awesome.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/owl.carousel.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/owl.theme.default.min.css");


    // Пример подключения js $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.sudoSlider.min.js" );

    //Пример подключения css $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/type.css");
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/images/Favicon64.png"/>
</head>
<body>
<div class="overlay-layer"></div>
<? $APPLICATION->ShowPanel(); ?>
<header>
    <div class="container">
        <div class="header-walp clearfix">
            <div id="logo">
                <a href="/" class="logo">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/logo.png">
                    <div class="text-logo">УЖК «Зелёный сад — Мой дом»</div>
                </a>
            </div>
            <div class="center-header">
                <?php $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top_menu",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "top",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "Y",
                        "MENU_CACHE_USE_GROUPS" => "N",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "top_menu"
                    ),
                    false
                ); ?>
            </div>

            <div class="header-cart">
                
                <a href="#">
                    <img class="empty-cart" src="<?= SITE_TEMPLATE_PATH ?>/images/empty_cart.png">
                    <img class="full-cart"  src="<?= SITE_TEMPLATE_PATH ?>/images/full_cart.png">
                    <span class="count-cart">0</span>
                </a>
                
            </div>

        </div>
    </div>

</header>

<div class="content-main">
