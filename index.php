<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("УЖК «Зелёный сад — Мой дом»"); ?><!-- SubMenu  -->
<h1 class="home-headeing-hidden">Главная страница</h1>
<div class="sub-menu clearfix">
    <ul class="list-sub-menu">
        <?
        if (CModule::IncludeModule("iblock")) {
            //выбираем все информационные блоки типа "catalog"
            $iblocks = GetIBlockList("service");
            $count = 0;
            while ($arIBlock = $iblocks->GetNext()) //цикл по всем блокам
            {
                // здесь мы НЕ используем функцию htmlspecialchars($arIBlock["NAME"]),
                // т.к. метод GetNext() делает это за нас
                //   echo "Название: ".$arIBlock["NAME"]."<br>";
                $img_path = CFile::GetPath($arIBlock["PICTURE"]);
                if ($count == 0) {

                    $current_block = 'current';

                } else {
                    $current_block = '';
                }

                echo '        
                    <li><a href="#" class="link-to-service ' . $current_block . '" data-id="infoblock-' . $arIBlock['ID'] . '">
                        <div class="img">
                             <img src="' . $img_path . '"/>
                        </div>
                        <h2>' . $arIBlock["NAME"] . '</h2>
                        <div class="overlay-sub-menu">
                        </div>
                    </a></li>';
                $count++;
            }
        }
        ?>


    </ul>
</div>


<div class="service-contents-walp">
    <div class="service-contents-walp">
        <?

        if (CModule::IncludeModule("iblock")):

            $iblocks = GetIBlockList("service");
            $count = 0;
            while ($arIBlock = $iblocks->GetNext()) {
                if ($count == 0) {
                    $display = 'display';
                } else {
                    $display = 'no-display';
                }

                echo '
                    <div class="service-contents ' . $display . ' infoblock-' . $arIBlock['ID'] . '">
                        <div class="container">
                            <h2 class="title-section">
                                ' . $arIBlock["NAME"] . '
                            </h2>
                            <ul class="service-content-list clearfix owl-carousel owl-theme ">
                ';
                // $arSelect = Array('*','1');
                $arSelect = Array(
                    'ID',
                    'NAME',
                    'DETAIL_PAGE_URL',
                    'PROPERTY_ATTR_TYPE',
                    'PREVIEW_PICTURE'
                );


                // $arFilter = Array("IBLOCK_ID"=>IntVal(1), "SECTION_ID"=>$arResult['IBLOCK_SECTION_ID'], "INCLUDE_SUBSECTIONS"=>"N");
                $arFilter = Array("IBLOCK_ID" => IntVal($arIBlock['ID']), "SECTION_ID" => $arResult['IBLOCK_SECTION_ID'], "INCLUDE_SUBSECTIONS" => "N");
                $res = CIBlockElement::GetList(
                    Array(),
                    $arFilter,
                    false,
                    Array("nPageSize" => 50),
                    $arSelect);


                while ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();

                    $img_path = CFile::GetPath($arFields["PREVIEW_PICTURE"]);

                    $rsPrices = CPrice::GetList(array(),
                        array(
                            "PRODUCT_ID" => $arFields['ID'],
                            "CATALOG_GROUP_ID" => '1'
                        ));
                    $price = $rsPrices->Fetch();
                    $priceRedy = explode(".", $price["PRICE"]);

                    if($arFields['PROPERTY_ATTR_TYPE_VALUE'] == "Абонимент"){
                        $imgpath = SITE_TEMPLATE_PATH.'/images/type-2.jpg';
                    }else{
                        $imgpath= '';
                    }


                    echo '
                                        <li class="item-product" data-type-img-url="'.$imgpath.'"   data-url="'.$arFields['DETAIL_PAGE_URL'].'" data-block-name="'.$arIBlock['NAME'].'"  data-block-id="' . $arIBlock['ID'] . '"  data-item-id="' . $arFields["ID"] . '">
                                               <form action="' . POST_FORM_ACTION_URI . '" method="post" enctype="multipart/form-data" class="add_form">
                                                   <div class="overlay-img">
                                                       <div class="overlay-img-layer"><span>Товар в корзине</span> </div>
                                                       
                                                       <img src="' . $img_path . '" />
                                                   </div>
                                                   <h3 class="name-product">' . $arFields['NAME'] . '</h3> 
                                                   <input type="hidden" name="id" value="' . $arFields["ID"] . '">
                            
                                                   <div class="bottom-block">
                                                       <div class="price-value" data-price="' . $priceRedy[0] . '"><p>' . $priceRedy[0] . '</p><i class="fas fa-ruble-sign"></i></div>
                                                       <a href="#" class="link-to-basket-in-item">Перейти в корзину</a>
                                                       <input class="addtocard"  type="submit" id="link2card' . $arFields["ID"] . '" name="actionADD2BASKET" value="Заказать" />
                            
                                                   </div>
                            
                                               </form>
                                        </li>
                    ';
                }
                echo '
                            </ul>
                        </div>
                    </div>
            
            ';

                $count++;
            }



        endif;
        ?>

    </div>
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
                    <div class="spiner-order onclic"></div>
                    <input type="submit" class="submit-order-form " value="Отправить"/>


                </form>
            </div>

        </div>
    </div>
</div>
 <? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>