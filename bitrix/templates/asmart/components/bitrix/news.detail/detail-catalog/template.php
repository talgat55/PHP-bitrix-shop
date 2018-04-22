<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="product-detail">
    <div class="container">
        <div class="col-md-4">
            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
                <img
                        class="detail_picture"
                        border="0"
                        src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                    <?php /* width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                    height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>"  */ ?>
                        alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                        title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                />

            <? endif ?>
            <?php
            if( $arResult["DISPLAY_PROPERTIES"]['ATTR_TYPE']["DISPLAY_VALUE"] == "Абонимент"){
                echo '
                    <img  
                        class="detail_picture aboniment-img"
                        border="0"
                        src="'.SITE_TEMPLATE_PATH.'/images/type-2.jpg"  />';

            }



            ?>

        </div>
        <div class="col-md-8">
            <? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
                <span class="news-date-time"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span>
            <? endif; ?>
            <? if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]): ?>
                <h1><?= $arResult["NAME"] ?></h1>
            <? endif; ?>
            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arResult["FIELDS"]["PREVIEW_TEXT"]): ?>
                <p><?= $arResult["FIELDS"]["PREVIEW_TEXT"];
                    unset($arResult["FIELDS"]["PREVIEW_TEXT"]); ?></p>
            <? endif; ?>
            <? if ($arResult["NAV_RESULT"]): ?>
                <? if ($arParams["DISPLAY_TOP_PAGER"]): ?><?= $arResult["NAV_STRING"] ?><br/><? endif; ?>
                <? echo $arResult["NAV_TEXT"]; ?>
                <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?><br/><?= $arResult["NAV_STRING"] ?><? endif; ?>
            <? elseif (strlen($arResult["DETAIL_TEXT"]) > 0): ?>
                <? echo $arResult["DETAIL_TEXT"]; ?>
            <? else: ?>
                <? echo $arResult["PREVIEW_TEXT"]; ?>
            <? endif ?>
            <?php
            $rsPrices = CPrice::GetList(array(),
                array(
                    "PRODUCT_ID" => $arResult['ID'],
                    "CATALOG_GROUP_ID" => '1'
                ));
            $price = $rsPrices->Fetch();
            $priceRedy = explode(".", $price["PRICE"]);
            ?>
        </div>

    </div>
    <div style="clear:both"></div>
    <div class="item-modal-order clearfix">
        <div class="block-price-order">
            <div class="container">
                <div class="block-price-order-walp"  data-id="<?=$arResult['ID']; ?>">
                    <div class="price-value-detail">
                        <span><?php echo $priceRedy[0]; ?></span><i class="fas fa-ruble-sign"></i>
                    </div>
                    <a href="#" class="addtocard">Заказать</a>

                </div>
            </div>
        </div>
    </div>
    <br/>
    <? foreach ($arResult["FIELDS"] as $code => $value):
        if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code) {
            ?><?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?
            if (!empty($value) && is_array($value)) {
                ?><img border="0" src="<?= $value["SRC"] ?>" width="<?= $value["WIDTH"] ?>"
                       height="<?= $value["HEIGHT"] ?>"><?
            }
        } else {
            ?><?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?><?
        }
        ?><br/>
    <?endforeach;
    /*
    foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty):?>

        <?= $arProperty["NAME"] ?>:&nbsp;
        <?
        if (is_array($arProperty["DISPLAY_VALUE"])):?>
            <?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
        <? else: ?>
            <?= $arProperty["DISPLAY_VALUE"]; ?>
        <? endif ?>
        <br/>
    <?endforeach;
    */
    if (array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y") {
        ?>
        <div class="news-detail-share">
            <noindex>
                <?
                $APPLICATION->IncludeComponent("bitrix:main.share", "", array(
                    "HANDLERS" => $arParams["SHARE_HANDLERS"],
                    "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
                    "PAGE_TITLE" => $arResult["~NAME"],
                    "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                    "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                    "HIDE" => $arParams["SHARE_HIDE"],
                ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );
                ?>
            </noindex>
        </div>
        <?
    }
    ?>
</div>