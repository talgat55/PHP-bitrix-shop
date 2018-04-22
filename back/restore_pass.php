<?php
/**
 * Created by PhpStorm.
 * User: talga
 * Date: 28.03.2018
 * Time: 11:55
 */

require($_SERVER['DOCUMENT_ROOT']."/bitrix/header.php");
echo $USER->Update(1,array("PASSWORD"=>'Bitrix*123456'));
echo $USER->LAST_ERROR;
require($_SERVER['DOCUMENT_ROOT']."/bitrix/footer.php");
?>