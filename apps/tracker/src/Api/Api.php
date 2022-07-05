<?php

namespace Source\Api;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;

class Api implements ApiInterface
{
    /**
     * Api constructor.
     */
    public function __construct()
    {
        header('Content-Type: application/json');
    }

    /**
     * @return never
     */
    protected function notFound(): never
    {
        httpErrorResponse(self::NOT_FOUND);
    }

    /**
     * @return never
     */
    protected function unexpected(): never
    {
        http_response_code(self::INTERNAL_SERVER);
        echo json_encode('Algo inesperado aconteceu');
        exit;
    }

    /**
     * @param array|GuzzleException $obj
     * @param int $httpResponseCode
     * @return never
     */
    protected function debugger(
        array|GuzzleException $obj,
        int $httpResponseCode = self::BAD_REQUEST
    ): never {
        if (is_array($obj)) {
            $errors = $obj;
        } elseif ($obj instanceof ConnectException) {
            $errors[$obj->getHandlerContext()['errno']] = $obj->getHandlerContext()['error'];
            $httpResponseCode = self::INTERNAL_SERVER;
        } elseif ($obj instanceof ClientException || $obj instanceof ServerException) {
            $errors = ['tracker' => json_decode($obj->getResponse()->getBody(), true)];
            $httpResponseCode = $obj->getResponse()->getStatusCode();
        } else {
            $errors[99999] = 'Algo inesperado aconteceu';
            $httpResponseCode = self::INTERNAL_SERVER;
        }

        http_response_code($httpResponseCode);
        echo json_encode(['error' => true, 'errors' => $errors]);
        exit;
    }
}