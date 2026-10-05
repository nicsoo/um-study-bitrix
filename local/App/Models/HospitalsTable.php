<?php
namespace App\Models;

use Bitrix\Main\Entity;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields;
use Bitrix\Iblock\Elements;
use Bitrix\Main\ORM\Query\Join;

class HospitalsTable extends DataManager {
    public static function getTableName(): string
    {
        return 'hospitals_table';
    }

    public static function getMap(): array
    {
        return [
            (new Fields\IntegerField('ID'))
                ->configurePrimary()
                ->configureAutocomplete(),
            (new Fields\StringField('NAME'))
                ->configureRequired()
                ->configureSize(255),
            new Fields\DateField('DATE_OF_FOUNDATION'),
            new Fields\IntegerField('CITY_ID'),
            new Fields\Relations\Reference(
                'CITIES',
                Elements\ElementCitiesTable::class,
                Join::on('this.CITY_ID', 'ref.ID')
            ),
            new Fields\IntegerField('TYPE_ID'),
            new Fields\Relations\Reference(
                'TYPES',
                Elements\ElementHospitalsTypesTable::class,
                Join::on('this.TYPE_ID', 'ref.ID')
            ),
            new Fields\ExpressionField(
                'AGE_DAYS',
                'DATEDIFF(NOW(), %s)',
                ['DATE_OF_FOUNDATION']
            ),
        ];
    }

}


?>