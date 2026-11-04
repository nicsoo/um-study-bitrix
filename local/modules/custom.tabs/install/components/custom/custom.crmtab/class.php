<?php

use Bitrix\Crm\Service\Container;
use Bitrix\Main\Loader;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\UI\PageNavigation;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class MyGridComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams): array
    {
        $arParams['DEAL_ID'] = (int)($arParams['DEAL_ID'] ?? null);
        $arParams['GRID_ID'] = 'MY_IBLOCK_GRID_' . $arParams['IBLOCK_ID'];
        return $arParams;
    }

    public function executeComponent(): void
    {
        Loader::includeModule('crm');

        $gridID = $this->arParams['GRID_ID'];

        $columns = [
            [
                'id' => 'ID',
                'name' => 'ID',
                'sort' => 'ID',
                'default' => true,
            ],
            [
                'id' => 'TITLE',
                'name' => 'Название',
                'sort' => 'TITLE',
                'default' => true,
            ],
            [
                'id' => 'RESP_NAME',
                'name' => 'Ответственный',
                'sort' => 'RESP_NAME',
                'default' => true,
            ],
            [
                'id' => 'BEGINDATE',
                'name' => 'Сделка начата (Время)',
                'sort' => 'BEGINDATE',
                'default' => true,
            ],
        ];
        
        $dealId = (int)$this->arParams['DEAL_ID'];
        if ($dealId === null) {
            ShowError('Deal ID is not found');
            return;
        }
        $factory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);
        $deal = $factory->getItem($dealId);
        $title = $deal->getTitle();
        $respId = $deal->get('ASSIGNED_BY_ID');
        $beginDate = $deal->get('BEGINDATE')->toString();
        $user = \Bitrix\Main\UserTable::getByPrimary($respId, [
            'select' => ['NAME', 'LAST_NAME'],
        ])->fetchObject();
        $respFullName = $user->getName() . $user->getLastName();
        $rows = [
            [
                'id' => 1,
                'data' => [
                    'ID' => $dealId,
                    'TITLE' => $title,
                    'RESP_NAME' => $respFullName,
                    'BEGINDATE' => $beginDate,
                ]
            ],
        ];
        
        

        
        // $this->arResult['NAV'] = $nav;
        $this->arResult['GRID_ID'] = $gridID;
        $this->arResult['COLUMNS'] = $columns;
        $this->arResult['ROWS'] = $rows;

        $this->includeComponentTemplate();
    }
}