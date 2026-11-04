<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
$APPLICATION->SetTitle("ДЗ #6: Написание своего модуля");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');


?>
<h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

<h4 class="mb-3">Пояснительная записка</h4>
    <div style="color: red;font-style: italic;">
        • Создал модуль custom.tabs. При установке копируется компонент custom.crmtab;<br>
        • Также при установке регистрируется событие на событие модуля crm(onEntityDetailsTabsInitialized) через registerEventHandler;<br>
        • В модуле создан include.php c регистрацией класса;<br>
        • в классе EntityDetailsTabs в $event получаем ID сущности CRM (сделки) entityID; <br>
        • Также в $event получаем табы и добавляем туда свой кастомный таб;<br>
        • В параметрах таба в loader указан serviceUrl (ссылку на lazyload.ajax.php);<br>
        • В componentData передаем ID сделки, который получили ранее;<br>
        • В lazyload.ajax.php мы вызываем наш компонент и передаем в параметры ID сделки;<br>
        • В шаблоне компонента мы уже используем стандартный bitrix:main.ui.grid;<br>
        <br>
        • В модуле нет настроек, а в табе выводится таблица с данными по сделке;<br>



    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            Файлы проекта
        </div>
        <ul class="list-group list-group-flush">

            <li class="list-group-item list-group-item-action">
                <a href="/crm/deal/details/9"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылка на тестовую страницу с компонентом
                </span>
                    <span class="badge bg-warning">
                    Ссылка на просмотр
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/partner_modules.php?lang=ru"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылка на установленные решения, модуль: CUSTOM.TABS
                </span>
                    <span class="badge bg-warning">
                    Ссылка на просмотр в админке
                </span>
                </a>
            </li>


            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/modules/custom.tabs/install/index.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    /local/modules/install/index.php - Файл установки
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/modules/custom.tabs/install/components/custom/custom.crmtab/class.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    /components/custom/custom.crmtab/class.php - класс компонента 
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/modules/custom.tabs/install/components/custom/custom.crmtab/lazyload.ajax.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    /components/custom/custom.crmtab/lazyload.ajax.php - AJAX компонента, для работы в табе 
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/modules/custom.tabs/install/components/custom/custom.crmtab/templates/.default/template.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    /components/custom/custom.crmtab/templates/.default/template.php - шаблон компонента
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
        </ul>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>