<?
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

if (!check_bitrix_sessid()) {
    die();
}
global $APPLICATION;

$APPLICATION->ShowAjaxHead();

$post = $_POST['PARAMS'] ?? null;

if (!(is_array($post['params'])) || count($post['params']) === 0) {
    ShowError('No deal ID');
    return;
} else {
    $params = $post['params'];
}


$APPLICATION->IncludeComponent(
    'custom:custom.crmtab',
    '',
    $params,
);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
