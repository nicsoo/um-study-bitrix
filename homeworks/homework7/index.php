<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
$APPLICATION->SetTitle("ДЗ #7: Создание кастомных полей и встраивание их в систему");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');


?>
<h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

<h4 class="mb-3">Пояснительная записка</h4>
    <div style="color: red;font-style: italic;">
        • Создал модуль custom.booking.<br>
        • Модуль регистрирует на событие iblock.OnIBlockPropertyBuildList кастомный метод GetUserTypeDescription класс Custom\Booking\CustomBookProp;<br>
        • В этом классе мы также описываем GetAdminListViewHTML/GetPublicViewHTML - методы, которые описывают способ генерации HTML для элемента (чтобы он отобразился у нас в Списке врачей);<br>
        • При генерации html в атрибут href вставляем javascript:void(0), чтобы ссылка никуда не вела, а в атрибут onclick мы вставляем название js функции bookingPopupOpen и передаем туда нужные аргументы;<br>
        • При клике на данную ссылку у нас вызывается JS метод, в котором мы с помощью BX.PopupWindow создаем модальное окно;<br>
        • В модальном окне по клику на кнопку отправляется POST запрос на /local/modules/custom.booking/lib/booking/addBooking.php с телом запроса, в котором хранится дата, фио пациента и id процедуры;<br>



    </div>
<br>
<br>
<hr>


    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            Файлы проекта
        </div>
        <ul class="list-group list-group-flush">

            <li class="list-group-item list-group-item-action">
                <a href="/services/lists/21/view/0/?list_section_id="
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылка на список бронирование
                </span>
                    <span class="badge bg-warning">
                    Ссылка на просмотр
                </span>
                </a>
            </li>

            <li class="list-group-item list-group-item-action">
                <a href="/services/lists/17/view/0/?list_section_id="
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылка на список врачей
                </span>
                    <span class="badge bg-warning">
                    Ссылка на просмотр
                </span>
                </a>
            </li>

            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/modules/custom.booking/install/index.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    /local/modules/custom.booking/install/index.php - Установка модуля.
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/modules/custom.booking/lib/iblock/CustomBookProp.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    local/modules/custom.booking/lib/iblock/CustomBookProp.php - Класс кастомного свойства.
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/modules/custom.booking/lib/booking/addBooking.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    local/lib/booking/addBooking.php - php добавления бронирования. К нему обращается js функция bookingPopupOpen.
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/modules/custom.booking/install/js/custom/booking/config.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    /local/modules/custom.booking/install/js/custom/booking/config.php
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/modules/custom.booking/install/js/custom/booking/script.js"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    /local/modules/custom.booking/install/js/custom/booking/script.js
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
        </ul>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>