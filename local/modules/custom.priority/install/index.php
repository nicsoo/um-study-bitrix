<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class custom_priority extends CModule {

    public $MODULE_ID = 'custom.priority';

    function __construct() {
        $this->MODULE_NAME = Loc::getMessage('CUSTOM_PRIORITY_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('CUSTOM_PRIORITY_MODULE_DESCRIPTION');

        include(__DIR__ . '/version.php');

        if (isset($arModuleVersion['VERSION'])) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'] ?? null;
        }

    }

    public function DoInstall() {
        global $USER, $APPLICATION;
        
        if ($USER->IsAdmin() === false) {
            die();
            return false;
        }

        ModuleManager::registerModule($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile(
            Loc::getMessage('CUSTOM_PRIORITY_INSTALL_TITLE'),
            __DIR__ . '/step.php'
        );
        
    }
    public function UnInstall() {
        global $USER, $APPLICATION;
        
        if ($USER->IsAdmin() === false) {
            die();
        }

        ModuleManager::unregisterModule($this->MODULE_ID);
        
        $APPLICATION->IncludeAdminFile(
            Loc::getMessage('CUSTOM_PRIORITY_UNINSTALL_TITLE'),
            __DIR__ . '/unstep.php'
        );
    }



}

