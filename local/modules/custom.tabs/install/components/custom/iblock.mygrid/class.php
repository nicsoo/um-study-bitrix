<?php

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
        $arParams['IBLOCK_ID'] = (int)($arParams['IBLOCK_ID'] ?? 0);
        $arParams['GRID_ID'] = 'MY_IBLOCK_GRID_' . $arParams['IBLOCK_ID'];
        return $arParams;
    }

    public function executeComponent(): void
    {
        if (!Loader::includeModule('iblock')) {
            ShowError('Модуль инфоблоков не установлен');
            return;
        }

        if ($this->arParams['IBLOCK_ID'] <= 0) {
            ShowError('Не указан ID инфоблока');
            return;
        }
        $gridID = $this->arParams['GRID_ID'];


        $gridOptions = new GridOptions($gridID);
        
        
        $sorting = $gridOptions->getSorting([
            'sort' => ['ID' => 'ASC'],
            'vars' => ['by'=> 'by', 'order'=>'order'],
        ]);
        $sort = $sorting['sort'];

        $navParams = $gridOptions->getNavParams(['nPageSize' => 5]);
        $nav = new PageNavigation($gridID);
        $nav->allowAllRecords(false)
        ->setPageSize($navParams['nPageSize'])
        ->initFromUri();

        $columns = [
            ['id' => 'ID', 'name' => 'Идентификатор', 'sort' => 'ID', 'default' => true],
            ['id' => 'NAME', 'name' => 'Наименование', 'sort' => 'NAME', 'default' => true],
            ['id' => 'DATE_CREATE', 'name' => 'Дата создания', 'sort' => 'DATE_CREATE', 'default' => true],
        ];

        $result = \Bitrix\Iblock\Elements\ElementMasterTable::getList([
            'select' => ['ID', 'NAME', 'DATE_CREATE'],
            'filter' => ['=ACTIVE' => 'Y'],
            'order' => $sort,
            'count_total' => true,
            'offset' => $nav->getOffset(),
            'limit' => $nav->getLimit(),
        ]);
        $nav->setRecordCount($result->getCount());
        $masters = $result->fetchCollection();
        
        $rows = [];
        foreach ($masters as $master) {
            $date = $master->getDateCreate();
            if ($date) {
                $dateText = $date->toString();
            } else {
                $dateText = '';
            }
            $rows[] = [
                'id' => $master->getId(),
                'data' => [
                    'ID' => $master->getId(),
                    'NAME' => $master->getName(),
                    'DATE_CREATE' => $dateText,
                ],
            ];
        }
        $this->arResult['NAV'] = $nav;
        $this->arResult['GRID_ID'] = $gridID;
        $this->arResult['COLUMNS'] = $columns;
        $this->arResult['ROWS'] = $rows;

        $this->includeComponentTemplate();
    }
}