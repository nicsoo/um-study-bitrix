<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
$APPLICATION->SetTitle("ДЗ #4: Создание своих таблиц БД и написание модели данных к ним");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

?>
    <h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

    <h4 class="mb-3">Пояснительная записка</h4>
    <div style="color: red;font-style: italic;">
        • Реализован класс "HospitalsTable" - описывающий БД "hospitals_table";<br>
        • Созданы поля: <br>
        • ID(INT|PRIMARY|AUTOINCREMENT); NAME(STRING); DATE_OF_FOUNDATION(DATE);<br>
        • TYPE_ID (INT) + создано отношение через Reference к ИБ "Типы больниц';<br>
        • CITY_ID (INT) + создано отношение через Reference к ИБ "Города';<br>
        • AGE_DAYS (ExpressionField) - вычисляемое поле "сколько дней прошло с момента основания";<br>
        <br>
        • В list.php через getList(...)->fetchCollection() получаю коллекцию, далее через цикл вывожу все данные<br>
        • Еще созданы вспомогательные кнопки "Создать записи", "Создать БД" для удобства проверки.
    </div>

    <hr>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            Файлы проекта
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/perfmon_table.php?lang=ru&table_name=hospitals_table"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылка на таблицу
                </span>
                    <span class="badge bg-success">
                   Ссылка на просмотр в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/iblock_list_admin.php?IBLOCK_ID=19&type=lists&lang=ru&find_section_section=0&SECTION_ID=0&apply_filter=Y"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Список на ИБ "Типы больниц"
                </span>
                    <span class="badge bg-primary">
                   Ссылка на просмотр в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/iblock_list_admin.php?IBLOCK_ID=18&type=lists&lang=ru&find_section_section=0&SECTION_ID=0&apply_filter=Y"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Список на ИБ "Города"
                </span>
                    <span class="badge bg-primary">
                   Ссылка на просмотр в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/homeworks/homework4/list.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылка на тестовую страницу
                </span>
                    <span class="badge bg-secondary">
                   Ссылка на просмотр
                </span>
                </a>
            </li>

            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/homeworks/homework4/list.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылка на тестовую страницу
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>

            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/App/Models/HospitalsTable.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылки на просмотр кода HospitalsTable.php
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/homeworks/homework4/list.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылки на просмотр кода list.php
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
        </ul>
        <br>
        <div style="color: red;font-style: italic; margin:15px 0px;">Вспомогательные кнопки</div>
        <br>
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action">
                <a href="/homeworks/homework4/createRow.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Создать записи в БД
                </span>
                    <span class="badge bg-secondary">
                   Ссылка на файл
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/homeworks/homework4/createTable.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Создать БД
                </span>
                    <span class="badge bg-secondary">
                   Ссылка на файл
                </span>
                </a>
            </li>
        </ul>
    </div>





<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>