<?php

require_once 'components/application.php';
require_once 'components/page/page.php';
require_once 'components/security/permission_set.php';
require_once 'components/security/user_authentication/hard_coded_user_authentication.php';
require_once 'components/security/grant_manager/hard_coded_user_grant_manager.php';

include_once 'components/security/user_identity_storage/user_identity_session_storage.php';

$users = array('Resto' => '411b8246e14f0e62c86dc4468398086a');

$grants = array('guest' => 
        array()
    ,
    'defaultUser' => 
        array('chek' => new PermissionSet(false, false, false, false),
        'client' => new PermissionSet(false, false, false, false),
        'menu' => new PermissionSet(false, false, false, false),
        'menu_season_price' => new PermissionSet(false, false, false, false),
        'order' => new PermissionSet(false, false, false, false),
        'price' => new PermissionSet(false, false, false, false),
        'restorans' => new PermissionSet(false, false, false, false),
        'season_price_service' => new PermissionSet(false, false, false, false),
        'service' => new PermissionSet(false, false, false, false),
        'service_client' => new PermissionSet(false, false, false, false),
        'service_season_price' => new PermissionSet(false, false, false, false),
        'ticket' => new PermissionSet(false, false, false, false),
        'users' => new PermissionSet(false, false, false, false),
        'online_order' => new PermissionSet(false, false, false, false))
    ,
    'Resto' => 
        array('chek' => new PermissionSet(false, false, false, false),
        'client' => new PermissionSet(false, false, false, false),
        'menu' => new PermissionSet(false, false, false, false),
        'menu_season_price' => new PermissionSet(false, false, false, false),
        'order' => new PermissionSet(false, false, false, false),
        'price' => new PermissionSet(false, false, false, false),
        'restorans' => new PermissionSet(false, false, false, false),
        'season_price_service' => new PermissionSet(false, false, false, false),
        'service' => new PermissionSet(false, false, false, false),
        'service_client' => new PermissionSet(false, false, false, false),
        'service_season_price' => new PermissionSet(false, false, false, false),
        'ticket' => new PermissionSet(false, false, false, false),
        'users' => new PermissionSet(false, false, false, false),
        'online_order' => new PermissionSet(false, false, false, false))
    );

$appGrants = array('guest' => new PermissionSet(false, false, false, false),
    'defaultUser' => new PermissionSet(true, false, false, false),
    'Resto' => new AdminPermissionSet());

$dataSourceRecordPermissions = array();

$tableCaptions = array('chek' => 'Счета',
'client' => 'Клиенты',
'menu' => 'Меню',
'menu_season_price' => 'Сезонные цены на меню',
'order' => 'Заказы',
'price' => 'Цены меню',
'restorans' => 'Рестораны',
'season_price_service' => 'Цены на услуги',
'service' => 'Услуги',
'service_client' => 'Заказанные услуги',
'service_season_price' => 'Цены на услуги',
'ticket' => 'Чеки',
'users' => 'Пользователи',
'online_order' => 'Онлайн заказы');

function SetUpUserAuthorization()
{
    global $users;
    global $grants;
    global $appGrants;
    global $dataSourceRecordPermissions;

    $hasher = GetHasher('md5');
    $userAuthentication = new HardCodedUserAuthentication(new UserIdentitySessionStorage(), false, $hasher, $users);
    $grantManager = new HardCodedUserGrantManager($grants, $appGrants);

    GetApplication()->SetUserAuthentication($userAuthentication);
    GetApplication()->SetUserGrantManager($grantManager);
    GetApplication()->SetDataSourceRecordPermissionRetrieveStrategy(new HardCodedDataSourceRecordPermissionRetrieveStrategy($dataSourceRecordPermissions));
}
