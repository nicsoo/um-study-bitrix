<?php


use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Application;

Loc::loadMessages(__FILE__);

class custom_tabs extends CModule {

    public $MODULE_ID = "custom_tabs";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;

    function __construct(){
        include __DIR__ . "/version.php";

        if (isset($arModuleVersion['VERSION'], $arModuleVersion['VERSION_DATE']))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = Loc::getMessage('CUSTOM_TABS_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('CUSTOM_TABS_MODULE_DESCRIPTION');
        

    }

    public function DoInstall() {
        global $USER, $APPLICATION;

        if (!$USER->isAdmin()) {
            return;
        };

        ModuleManager::registerModule('custom_tabs');

        $this->InstallFiles();


        $APPLICATION->IncludeAdminFile(
            'Установка модуля ' . $this->MODULE_NAME,
            __DIR__ . '/step.php'
        );

    }

    public function InstallFiles() {
        CopyDirFiles(
            $_SERVER['DOCUMENT_ROOT'] . '/local/modules/custom.tabs/install/components/custom/',
            $_SERVER['DOCUMENT_ROOT'] . '/local/components/custom/',
            true,
            true
        );
    }

    public function UnInstallFiles() {
        global $APPLICATION;

        $components = $this->getAllComponentsDirsForDelete();
        if (count($components) === 0) {
            return;
        } else {
            foreach ($components as $dir) {
                Directory::deleteDirectory($dir);
            }
        }

    }

    public function DoUninstall(){
        global $USER, $APPLICATION;

        if (!$USER->isAdmin()) {
            return;
        };

        ModuleManager::unregisterModule('custom_tabs');

        $this->UnInstallFiles();


        $APPLICATION->IncludeAdminFile(
            'Удаление модуля ' . $this->MODULE_NAME,
            __DIR__ . '/unstep.php'
        );
    }

    private function getAllComponentsDirsForDelete(): array {
        $root = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
        $source = $root . '/local/modules/custom.tabs/install/components/custom';
        $components = scandir($source);
        if ($components === false) {
            return [];
        }
        $result = [];
        foreach ($components as $dirName) {
            if ($dirName === '.' || $dirName === '..') {
                continue;
            }
            $dirPath = $root . '/local/components/custom/' . $dirName;
            if (is_dir($dirPath)) {
                $result[] = $dirPath;
            }
        }
        return $result;
    }

}