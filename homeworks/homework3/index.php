<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
$APPLICATION->SetTitle("ДЗ #3: Связывание моделей");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

?>
    <h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

    <h4 class="mb-3">Пояснительная записка</h4>
    <div style="color: red;font-style: italic;">
        • Созданы 2 списка Доктора и Процедуры;<br>
        • Создана связь между списками. У докторов создано свойство "Привязка к элементам" списка процедуры;<br>
        • Создана страница /doctors/, на которой отображаются все существующие доктора. Нажав на доктора - можно провалиться на его карточку, а также увидеть, какие он выполняет процедуры.;<br>
        • В верхней части страницы можно также наблюдать 2 кнопки - "создать доктора" и "создать процедуру";<br>
        • В doctors/index.php я организовал "мини-роутер", который отображает нужную информацию. Сначала идет проверка по методу, а потом по переданным в скрытых инпутах object и operation;<br>
        • Все действия я производил через динамический класс, который генерирует битрикс и его методы;<br>
    </div>
    <br>
    <br>
    <hr>

    <div style="color: red;font-style: italic;">
        &darr;&darr;&darr; ссылки ниже заменить на свои &darr;&darr;&darr;
    </div>


    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            Файлы проекта
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action">
                <a href="#"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Список врачей
                </span>
                    <span class="badge bg-primary">
                   Ссылка на просмотр
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="#"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Список процедур
                </span>
                    <span class="badge bg-success">
                   Ссылка на просмотр
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Врачи и процедуры
                </span>
                    <span class="badge bg-secondary">
                   Ссылка на просмотр
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/doctors/index.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Ссылки на просмотр кода основных файлов ДЗ (связь таблиц и ORM)
                </span>
                    <span class="badge bg-warning">
                    файл в админке
                </span>
                </a>
            </li>
        </ul>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>