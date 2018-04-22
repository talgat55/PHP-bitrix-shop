<?php
/**
 * Created by PhpStorm.
 * User: talga
 * Date: 29.03.2018
 * Time: 2:05
 */
 require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

global $USER;

use \Bitrix\Main,
    \Bitrix\Main\Localization\Loc as Loc,
    Bitrix\Main\Loader,
    Bitrix\Main\Config\Option,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem,
    Bitrix\Sale,
    Bitrix\Sale\Order,
    Bitrix\Sale\DiscountCouponsManager,
    Bitrix\Main\Context;


if (!Loader::IncludeModule('sale'))
    die();

function getPropertyByCode($propertyCollection, $code)  {
    foreach ($propertyCollection as $property)
    {
        if($property->getField('CODE') == $code)
            return $property;
    }
}

$siteId = \Bitrix\Main\Context::getCurrent()->getSite();

$nameUser = $_POST['nameorder'];
$phone = $_POST['phoneorder'];
$email = $_POST['emailorder'];
$city =$_POST['cityorder'];
$adress =$_POST['adressorder'];
$currencyCode = Option::get('sale', 'default_currency', 'RUB');

DiscountCouponsManager::init();

$order = Order::create($siteId, \CSaleUser::GetAnonymousUserID());

$order->setPersonTypeId(1);
//$basket = Sale\Basket::loadItemsForFUser(\CSaleBasket::GetBasketUserID(), $siteId)->getOrderableItems();

/* Действия над товарами
$basketItems = $basket->getBasketItems();
foreach ($basketItems as $basketItem) {

}
*/
$basket = Bitrix\Sale\Basket::create($siteId);
/*$products = array(
    array('PRODUCT_ID' => 1811, 'NAME' => 'Товар 1', 'PRICE' => 500, 'CURRENCY' => 'RUB', 'QUANTITY' => 5)
);*/
 $products = json_decode ($_POST['products'], true);

 foreach ($products as $product)
{

  $item = $basket->createItem("catalog", $product["PRODUCT_ID"]);
    unset($product["PRODUCT_ID"]);
   $item->setFields($product);
}



$order->setBasket($basket);

/*Shipment*/
$shipmentCollection = $order->getShipmentCollection();
$shipment = $shipmentCollection->createItem();
$shipmentItemCollection = $shipment->getShipmentItemCollection();
$shipment->setField('CURRENCY', $order->getCurrency());
foreach ($order->getBasket() as $item)
{
    $shipmentItem = $shipmentItemCollection->createItem($item);
    $shipmentItem->setQuantity($item->getQuantity());
}
$arDeliveryServiceAll = Delivery\Services\Manager::getRestrictedObjectsList($shipment);
$shipmentCollection = $shipment->getCollection();

if (!empty($arDeliveryServiceAll)) {
    reset($arDeliveryServiceAll);
    $deliveryObj = current($arDeliveryServiceAll);

    if ($deliveryObj->isProfile()) {
        $name = $deliveryObj->getNameWithParent();
    } else {
        $name = $deliveryObj->getName();
    }

    $shipment->setFields(array(
        'DELIVERY_ID' => $deliveryObj->getId(),
        'DELIVERY_NAME' => $name,
        'CURRENCY' => $order->getCurrency()
    ));

    $shipmentCollection->calculateDelivery();
}
/**/

/*Payment*/
$arPaySystemServiceAll = [];
$paySystemId = 1;
$paymentCollection = $order->getPaymentCollection();

$remainingSum = $order->getPrice() - $paymentCollection->getSum();
if ($remainingSum > 0 || $order->getPrice() == 0)
{
    $extPayment = $paymentCollection->createItem();
    $extPayment->setField('SUM', $remainingSum);
    $arPaySystemServices = PaySystem\Manager::getListWithRestrictions($extPayment);

    $arPaySystemServiceAll += $arPaySystemServices;

    if (array_key_exists($paySystemId, $arPaySystemServiceAll))
    {
        $arPaySystem = $arPaySystemServiceAll[$paySystemId];
    }
    else
    {
        reset($arPaySystemServiceAll);

        $arPaySystem = current($arPaySystemServiceAll);
    }

    if (!empty($arPaySystem))
    {
        $extPayment->setFields(array(
            'PAY_SYSTEM_ID' => $arPaySystem["ID"],
            'PAY_SYSTEM_NAME' => $arPaySystem["NAME"]
        ));
    }
    else
        $extPayment->delete();
}
/**/

$order->doFinalAction(true);
$propertyCollection = $order->getPropertyCollection();

$emailProperty = getPropertyByCode($propertyCollection, 'EMAIL');
$emailProperty->setValue($email);

$phoneProperty = getPropertyByCode($propertyCollection, 'PHONE');
$phoneProperty->setValue($phone);
$cityProperty = getPropertyByCode($propertyCollection, 'CITY');
$cityProperty->setValue($city);
$addressProperty = getPropertyByCode($propertyCollection, 'ADDRESS');
$addressProperty->setValue($adress);

$fioProperty = getPropertyByCode($propertyCollection, 'FIO');
$fioProperty->setValue($nameUser);


$order->setField('CURRENCY', $currencyCode);
$order->setField('USER_DESCRIPTION', 'Комментарии пользователя');

$order->save();

$orderId = $order->GetId();
if($orderId > 0){
    echo "Ваш заказ оформлен";
}
else{
    echo "Ошибка оформления";
}
//echo json_encode($_POST);


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
