<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
$APPLICATION->SetTitle("ДЗ #8: Учимся подключать свои скрипты, взаимодействовать с компонентами из фронтенда");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');


?>
<h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

<h4 class="mb-3">Пояснительная записка</h4>
    <div style="color: red;font-style: italic;">
        • Создал js скрипт, в котором привязываюсь к событию onTimemanInit<br>
        • При событии я переопределяю JS функцию BXTIMEMAN.WND.ACTIONS.OPEN. В переменную завожу старую функцию и вызываю ее уже при клике на кнопку "ПОДТВЕРДИТЬ"<br>



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
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/js/custom/time/script.js"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    script.js
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/js/custom/time/config.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    config.php
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
        </ul>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>