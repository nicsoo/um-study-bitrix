<?
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Loader;
use Bitrix\Iblock\ORM\PropertyValue;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Доктора");

Asset::getInstance()->addCss('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

Loader::includeModule('iblock');

$method = $_SERVER['REQUEST_METHOD'];
$operation = $_POST['operation'] ?? $_GET['operation'] ?? '';
$object = $_POST['object'] ?? $_GET['object'] ?? '';
$doctorID = isset($_GET['id']) ? (int) $_GET['id'] : null;

if ($method === "GET") {
    if ($operation === '') {
        if ($doctorID > 0) {
            $doctor = \Bitrix\Iblock\Elements\ElementDoctorsTable::getByPrimary($doctorID, [
                'select' => ['ID', 'NAME', 'AGE', 'PROCEDURES.ELEMENT.NAME'],
                'data_doubling' => true,
            ])->fetchObject();
            $name = $doctor->get('NAME');
            $age = $doctor->get('AGE');
            $procedures = $doctor->get('PROCEDURES')->getAll();
            ?>
            <div class="container py-4">
                <div class="row justify-content-left">
                    <div class="col-md-8 col-lg-6">
                        <p class="mb-3"><a href="/doctors/" class="link-secondary">К списку</a></p>
                        <h1 class="h3 mb-2"><?= htmlspecialcharsbx($name) ?></h1>
                        <p class="text-muted mb-4">Возраст: <?= (int) $age->getValue() ?></p>
                        <h2 class="h6 text-uppercase text-muted mb-2">Процедуры</h2>
                        <?php if (count($procedures) > 0) { ?>
                            <ul class="mb-0">
                                <?php foreach ($procedures as $proc) {
                                    $procName = $proc->getElement()->get('NAME'); ?>
                                    <li><?= htmlspecialcharsbx($procName) ?></li>
                                <?php } ?>
                            </ul>
                        <?php } else { ?>
                            <p class="text-muted mb-0">Не доступных процедур</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        } else {
            $doctors = \Bitrix\Iblock\Elements\ElementDoctorsTable::getList([
                'select' => ['ID', 'NAME'],
            ])->fetchCollection();
            ?>
            <div class="container py-4">
                <div class="row justify-content-left">
                    <div class="col-md-8 col-lg-6">
                        <h1 class="h3 mb-3"><?php $APPLICATION->ShowTitle(); ?></h1>
                        <p class="mb-4">
                            <a href="/doctors/?operation=add&amp;object=doctors">Добавить врача</a>
                            <a href="/doctors/?operation=add&amp;object=procedures">Добавить процедуру</a>
                        </p>
                        <div class="list-group">
                            <?php foreach ($doctors as $doctor) {
                                $id = $doctor->get('ID');
                                $name = $doctor->get('NAME'); ?>
                                <a class="list-group-item list-group-item-action" href="/doctors/?id=<?= (int) $id ?>">
                                    <?= htmlspecialcharsbx($name) ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } elseif ($operation === "add" && $object === 'doctors') {
        $procedures = \Bitrix\Iblock\Elements\ElementProceduresTable::getList([
            'select' => ['ID', 'NAME'],
        ])->fetchCollection();
        ?>
        <div class="container py-4">
            <div class="row justify-content-left">
                <div class="col-md-8 col-lg-6">
                    <p class="mb-3"><a href="/doctors/" class="link-secondary">К списку</a></p>
                    <h1 class="h3 mb-4">Новый врач</h1>
                    <form action="/doctors/" method="POST">
                        <input type="hidden" name="operation" value="add">
                        <input type="hidden" name="object" value="doctors">
                        <div class="mb-3">
                            <label class="form-label" for="doctor-name">Имя</label>
                            <input type="text" class="form-control" id="doctor-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="doctor-age">Возраст</label>
                            <input type="number" class="form-control" id="doctor-age" name="age" required>
                        </div>
                        <p class="form-label mb-2">Процедуры</p>
                        <?php foreach ($procedures as $proc) {
                            $procID = $proc->get('ID');
                            $procName = $proc->get('NAME'); ?>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="checkbox" name="procedures[]" value="<?= (int) $procID ?>" id="proc-<?= (int) $procID ?>">
                                <label class="form-check-label" for="proc-<?= (int) $procID ?>"><?= htmlspecialcharsbx($procName) ?></label>
                            </div>
                        <?php } ?>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="/doctors/" class="btn btn-link">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    } elseif ($operation === "add" && $object === 'procedures') {
        ?>
        <div class="container py-4">
            <div class="row justify-content-left">
                <div class="col-md-8 col-lg-6">
                    <p class="mb-3"><a href="/doctors/" class="link-secondary">К списку</a></p>
                    <h1 class="h3 mb-4">Новая процедура</h1>
                    <form action="/doctors/" method="POST">
                        <input type="hidden" name="operation" value="add">
                        <input type="hidden" name="object" value="procedures">
                        <div class="mb-3">
                            <label class="form-label" for="procedure-name">Название</label>
                            <input type="text" class="form-control" id="procedure-name" name="name" required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="/doctors/" class="btn btn-link">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
} elseif ($method === "POST") {
    if ($operation === "add" && $object === "doctors") {
        $name = $_POST['name'] ?? '';
        $age = $_POST['age'] ?? '';
        $procedures = $_POST['procedures'];
        $result = \Bitrix\Iblock\Elements\ElementDoctorsTable::add([
            'NAME'   => $name,
            'ACTIVE' => 'Y',
        ]);
        if ($result->isSuccess()) {
            $doctorID = $result->getID();
            $doctor = \Bitrix\Iblock\Elements\ElementDoctorsTable::getByPrimary($doctorID, [
                'select' => ['ID', 'AGE', 'PROCEDURES'],
            ])->fetchObject();
            $doctor->get('AGE')->setValue($age);
            foreach ($procedures as $procID) {
                $doctor->addToProcedures(new PropertyValue($procID));
            }
            $doctor->save();
            LocalRedirect('/doctors/');
        }
    } elseif ($operation === "add" && $object === "procedures") {
        $name = $_POST['name'] ?? '';
        $result = \Bitrix\Iblock\Elements\ElementProceduresTable::add([
            'NAME'   => $name,
            'ACTIVE' => 'Y',
        ]);
        if ($result->isSuccess()) {
            LocalRedirect('/doctors/');
        }
    }
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
