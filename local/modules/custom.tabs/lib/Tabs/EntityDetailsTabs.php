<?php

namespace Custom\Tabs;

use Bitrix\Main\Event;
use Bitrix\Main\EventResult;


class EntityDetailsTabs {
    public static function onEntityDetailsTabsInitialized(Event $event): EventResult
    {
        $dealId = (int)$event->getParameter('entityID');


        $tabs = $event->getParameter('tabs');
        $tabs[] = [
            'id' => 'custom_tabs',
            'name' => 'Дополнительный таб',
            'loader' => [
                'serviceUrl' => '/local/components/custom/custom.crmtab/lazyload.ajax.php?' . bitrix_sessid_get(),
                'componentData' => [
                    'template' => '',
                    'params' => [
                        'DEAL_ID' => $dealId,
                    ],
                ],
            ]

        ];
        return new EventResult(EventResult::SUCCESS, [
            'tabs' => $tabs,
        ]);
    }
}

