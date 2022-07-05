<?php

use LandKit\Route\Route;


/* *** *** *** *** *** *** *** *** *** ***
 * Ativos
 * *** *** *** *** *** *** *** *** *** ***/

/**
 * @param int $code
 * @param bool $returnArray
 * @return string|null
 */
function errorByCode(int $code, bool $returnArray = true): ?string
{
    $arr = [];

    return ($arr[$code] ?? null);
}

/**
 * @param int $httpResponseCode
 * @return never
 */
function httpErrorResponse(int $httpResponseCode): never
{
    http_response_code($httpResponseCode);

    $message = match ($httpResponseCode) {
        400 => 'Bad request',
        403 => 'Forbidden',
        404 => 'Not found',
        405 => 'Partially implemented',
        501 => 'Not implemented',
        default => 'Undefined',
    };

    echo json_encode([
        'erro' => $httpResponseCode,
        'data' => date('Y-m-d H:i:s'),
        'mensagem' => $message,
        'url' => Route::currentUrl()
    ]);

    exit;
}