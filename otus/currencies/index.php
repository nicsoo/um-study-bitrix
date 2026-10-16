<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Курс валют");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    $APPLICATION->IncludeComponent(
	"custom:currency.rates", 
	".default", 
	[
		"CACHE_TIME" => "86400",
		"CACHE_TYPE" => "A",
		"SHOW_CB" => "N",
		"ARR_CURRENCY" => [
			0 => "USD",
			1 => "EUR",
		],
		"COMPONENT_TEMPLATE" => ".default",
		"arrCURRENCY_FROM" => [
			0 => "EUR",
		],
		"CURRENCY_BASE" => "RUB",
		"RATE_DAY" => ""
	],
	false
);
    
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>