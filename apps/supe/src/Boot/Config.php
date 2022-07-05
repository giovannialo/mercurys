<?php

use LandKit\LoadFileEnv\LoadFileEnv;


/*
 * Carrega as variáveis de ambiente (.env)
 */
if (!LoadFileEnv::load(__DIR__ . '/../../')) {
    http_response_code(500);
    echo 'O arquivo .env não foi encontrado';
    exit;
}

/*
 * URL do sistema
 */
$https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 's' : null);
define('CONF_BASE_URL', "http{$https}://" . getenv('HOST') . '/supe');


/*
 * Banco de dados
 */
$databaseKey = getenv('DATABASE_KEY');
$databaseDriver = getenv('DATABASE_DRIVER');
$databaseHost = getenv('DATABASE_HOST');
$databasePort = getenv('DATABASE_PORT');
$databaseDbname = getenv('DATABASE_DBNAME');
$databaseUsername = getenv('DATABASE_USERNAME');
$databasePassword = getenv('DATABASE_PASSWORD');
$databaseOptions = getenv('DATABASE_OPTIONS');

if (!$databaseKey || !$databaseDriver || !$databaseHost || !$databasePort
    || !$databaseDbname || !$databaseUsername || !$databasePassword
) {
    http_response_code(500);
    echo 'As configurações de banco de dados no arquivo .env não foram devidamente preenchidas';
    exit;
}

$database = [];
$databaseKey = explode(';', $databaseKey);
$databaseDriver = explode(';', $databaseDriver);
$databaseHost = explode(';', $databaseHost);
$databasePort = explode(';', $databasePort);
$databaseDbname = explode(';', $databaseDbname);
$databaseUsername = explode(';', $databaseUsername);
$databasePassword = explode(';', $databasePassword);
$databaseOptions = explode(';', $databaseOptions);

foreach ($databaseKey as $i => $value) {
    $database[$value] = [
        'driver' => $databaseDriver[$i],
        'host' => $databaseHost[$i],
        'port' => (int) $databasePort[$i],
        'dbname' => $databaseDbname[$i],
        'username' => $databaseUsername[$i],
        'password' => $databasePassword[$i]
    ];

    if ($databaseOptions[$i]) {
        parse_str($databaseOptions[$i], $options);
        $database[$value]['options'] = array_map(fn($item) => (is_numeric($item) ? (int) $item : $item), $options);
    }
}

define('CONF_DATABASE', $database);


/*
 * JWT
 */
define('CONF_JWT_KEY', getenv('JWT_KEY'));
define('CONF_JWT_ALGORITHM', getenv('JWT_ALGORITHM'));
