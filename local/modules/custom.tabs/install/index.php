<?php


use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Application;
use Bitrix\Main\EventManager;

Loc::loadMessages(__FILE__);

class custom_tabs extends CModule {

    public $MODULE_ID = "custom.tabs";
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

        if (!ModuleManager::isModuleInstalled($this->MODULE_ID)) {
            ModuleManager::registerModule($this->MODULE_ID);
        }

        $this->InstallFiles();
        $this->InstallEvents();


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

    public function InstallEvents() {
        EventManager::getInstance()->registerEventHandler(
            'crm',                              
            'onEntityDetailsTabsInitialized',   
            'custom.tabs',                     
            'Custom\\Tabs\\EntityDetailsTabs', 
            'onEntityDetailsTabsInitialized',
        );
    }
    public function UnInstallEvents() {
        EventManager::getInstance()->unRegisterEventHandler(
            'crm',                              
            'onEntityDetailsTabsInitialized',   
            'custom.tabs',                     
            'Custom\\Tabs\\EntityDetailsTabs', 
            'onEntityDetailsTabsInitialized',
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

        ModuleManager::unregisterModule($this->MODULE_ID);

        $this->UnInstallFiles();
        $this->UnInstallEvents();


        $APPLICATION->IncludeAdminFile(
            'Удаление модуля ' . $this->MODULE_NAME,
            __DIR__ . '/unstep.php'
        );
    }
    /**
     * Функция получения путей компонентов модуля custom.tabs для удаления
     *
     * @return array массив, в котором хранятся готовые пути для удаления
     */
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