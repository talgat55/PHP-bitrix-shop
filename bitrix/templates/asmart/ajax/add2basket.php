<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")) {

    if (isset($_POST['actionADD2BASKET'])) {
        if (isset($_POST['id']) && isset($_POST['QUANTITY'])) {
            $PRODUCT_ID = intval($_POST['id']);
            $QUANTITY = intval($_POST['QUANTITY']);
           $returnvalue =  Add2BasketByProductID($PRODUCT_ID, $QUANTITY);

        } else {
            echo "Нет параметров";
        }
    }
    if (isset($_POST['delete'])) {

        CSaleBasket::Delete(16);
    }

} else {
    echo "Не подключены модули";
}


$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket.line",
    "small_basket",
    array(
        "HIDE_ON_BASKET_PAGES" => "Y",
        "PATH_TO_AUTHORIZE" => "",
        "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
        "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
        "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
        "PATH_TO_PROFILE" => SITE_DIR . "personal/",
        "PATH_TO_REGISTER" => SITE_DIR . "login/",
        "POSITION_FIXED" => "N",
        "SHOW_AUTHOR" => "N",
        "SHOW_EMPTY_VALUES" => "Y",
        "SHOW_NUM_PRODUCTS" => "Y",
        "SHOW_PERSONAL_LINK" => "N",
        "SHOW_PRODUCTS" => "N",
        "SHOW_TOTAL_PRICE" => "Y",
        "COMPONENT_TEMPLATE" => "small_basket"
    ),
    false
);


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>