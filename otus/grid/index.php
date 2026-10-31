<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Кастомная грид-таблица");

$APPLICATION->IncludeComponent(
	"custom:iblock.mygrid",
	"",
	Array(
		"GRID_ID" => "6",
		"IBLOCK_ID" => "6"
	)
);
    
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>