<?php
/**
 * Created by PhpStorm.
 * User: talgat
 * Date: 29.03.2018
 * Time: 12:01
 */
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (CModule::IncludeModule("iblock")):
 //   $arSelect = Array("DETAIL_TEXT","NAME");
  $arSelect = Array("*");
    $arFilter = Array("IBLOCK_ID"=>$_POST['blockid'], "ID"=>array($_POST['itemid']), "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(),
        $arFilter,
        false,
        Array("nPageSize" => 50),
        $arSelect);
    $ob = $res->GetNextElement();

   /* while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();

        //  $img_path = CFile::GetPath($arFields["PREVIEW_PICTURE"]);
        //  $replacements = array('DETAIL_PICTURE'=> $img_path);

        //  $result = array_merge($arFields, array_intersect_key($replacements, $arFields));



    }*/
    $rsPrices = CPrice::GetList(array(),
        array(
            "PRODUCT_ID" => $_POST['itemid'],
            "CATALOG_GROUP_ID" => '1'
        ));
    $price = $rsPrices->Fetch();
    $priceRedy = explode(".", $price["PRICE"]);

    $arFields = $ob->GetFields();
    $img_path = CFile::GetPath($arFields["DETAIL_PICTURE"]);
    $replacements = array('DETAIL_PICTURE'=> $img_path);

    $result = array_merge($arFields, array_intersect_key($replacements, $arFields));

    echo json_encode(array_merge($result, ['PRICE'=> $priceRedy[0]]));
endif;


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");