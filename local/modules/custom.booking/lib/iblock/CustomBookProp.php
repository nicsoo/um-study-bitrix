<?php

namespace Custom\Booking;

use CUtil;

\Bitrix\Main\UI\Extension::load('custom.booking');

class CustomBookProp {
    public static function GetUserTypeDescription() {
        return [
            'PROPERTY_TYPE' => 'S',
            'USER_TYPE' => 'BookingProperty',
            'DESCRIPTION' => 'Бронирование записи на процедуры',
            'CLASS_NAME' => 'CustomBookProp',
            'GetAdminListViewHTML' => [static::class, 'GetAdminListViewHTML'],
            'GetPublicViewHTML' => [static::class, 'GetPublicViewHTML'],
            'GetPropertyFieldHtml' => [static::class, 'GetPropertyFieldHtml'],
        ];
    }

    public static function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName) {
        $html = '';
        $controlName = (string)$strHTMLControlName['VALUE'];
        $doctorId = 0;
        if (isset($arProperty['ELEMENT_ID'])) {
            $doctorId = (int)$arProperty['ELEMENT_ID'];
        } else if (preg_match('/FIELDS\[E?(\d+)\]/', $controlName, $matches)) {
            $doctorId = (int)$matches[1];
        }
        if ($doctorId === 0) {
            return $html;
        } else {

            $doctor = \Bitrix\Iblock\Elements\ElementDoctorsTable::getByPrimary($doctorId, [
                'select' => ['PROCEDURES.ELEMENT.NAME', 'PROCEDURES.ELEMENT.ID'],
                'data_doubling' => false,
            ])->fetchObject();
            if ($doctor === null) {
                return $html;
            }
            $proceduresProp = $doctor->get('PROCEDURES');
            if ($proceduresProp === null) {
                return $html;
            }
            $procedures = $proceduresProp->getAll();
            foreach ($procedures as $proc) {
                $procID = $proc->getElement()->get('ID');
                $procName = $proc->getElement()->get('NAME');
                $html .= '<a href="javascript:void(0)" onclick="bookingPopupOpen('
                    . (int)$procID . ', \'' . CUtil::JSEscape($procName) . '\')">'
                    . htmlspecialcharsbx($procName) . '</a><br>';
            }
            return $html;
        }
    }
    public static function GetPublicViewHTML($arProperty, $value, $strHTMLControlName) {
        return self::GetAdminListViewHTML($arProperty, $value, $strHTMLControlName);
    }
    
    public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
    $current = (string)($value['VALUE'] ?? '');

        $html = '<input type="text" name="' . htmlspecialcharsbx($strHTMLControlName['VALUE']) . '" value="' . htmlspecialcharsbx($current) . '">';
        return $html;
    }

}