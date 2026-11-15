<?php


use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Application;
use Bitrix\Main\EventManager;

Loc::loadMessages(__FILE__);

class custom_booking extends CModule {

    public $MODULE_ID = "custom.booking";
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

        $this->MODULE_NAME = Loc::getMessage('CUSTOM_BOOKING_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('CUSTOM_BOOKING_MODULE_DESCRIPTION');
        

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
            $_SERVER['DOCUMENT_ROOT'] . '/local/modules/custom.booking/install/js/custom/booking',
            $_SERVER['DOCUMENT_ROOT'] . '/local/js/custom/booking',
            true,
            true
        );
    }

    public function InstallEvents() {
        EventManager::getInstance()->registerEventHandler(
            'iblock',                              
            'OnIBlockPropertyBuildList',   
            'custom.booking',                     
            'Custom\\Booking\\CustomBookProp', 
            'GetUserTypeDescription',
        );
    }



    public function DoUninstall(){
        global $USER, $APPLICATION;

        if (!$USER->isAdmin()) {
            return;
        };

        ModuleManager::unregisterModule($this->MODULE_ID);

        $this->UnInstallEvents();
        $this->UnInstallFiles();

        $APPLICATION->IncludeAdminFile(
            'Удаление модуля ' . $this->MODULE_NAME,
            __DIR__ . '/unstep.php'
        );
    }

    public function UnInstallEvents() {
        EventManager::getInstance()->unRegisterEventHandler(
            'iblock',                              
            'OnIBlockPropertyBuildList',   
            'custom.booking',                     
            'Custom\\Booking\\CustomBookProp', 
            'GetUserTypeDescription',
        );
    }

    public function UnInstallFiles() {
        global $APPLICATION;
        $path = $_SERVER['DOCUMENT_ROOT'] . '/local/js/custom/booking';
        if (is_dir($path)) {
            Directory::deleteDirectory($path);
        }

    }




}