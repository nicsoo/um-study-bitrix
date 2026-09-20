<?
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("ДЗ #1: Создание и настройка проекта в VScode");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');


?>
<h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

<h4 class="mb-3">Пояснительная записка</h4>
    <div style="color: red;font-style: italic;">
        • Произведена установка BITRIX VM<br>
        • Подключен composer<br>
        • Создан .gitignore со всеми созданными установщиком директориями<br>
        • Создан init commit в репозитории github<br>
    </div>
<br>
<br>
<hr>




<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>