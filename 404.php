<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена"); ?>
    <div class="container">
        <h1 class="home-headeing-hidden">Страница не найдена</h1>
        <div class="bx-404-container">
            Запрошенная страница не найдена. Возможно, что сейчас она находится по другому адресу или временно недоступна по технических причинам.

            Для того, чтобы найти интересующую Вас информацию:
        <ul>
            <li>Убедитесь, что адрес страницы был введен без ошибок;</li>
            <li>Обратитесь к <a href="<?= SITE_DIR ?>">главной странице</a> сайта. Она может содержать ссылку на необходимую страницу.</li>
        </ul>

        </div>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>