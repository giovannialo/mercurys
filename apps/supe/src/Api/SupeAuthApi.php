<?php

namespace Source\Api;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;

abstract class SupeAuthApi implements ApiInterface
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @var array
     */
    private array $multiUser;

    /**
     * @var array
     */
    private array $urls;

    /**
     * @var array
     */
    private array $token;

    /**
     * SupeAuthApi constructor.
     */
    public function __construct()
    {
        $this->multiUser = [
            2700 => [
                'auth' => [
                    'login' => 'onlinemaceio',
                    'senha' => 'maceio@2022',
                    'hashSistema' => '5K64BM904623TY70Z942H38J6WVXAD273J4G613B6K4G16C43O9N2SD4V8U5820F1'
                ],
                'protocolSector' => 3967
            ]
        ];
        $this->urls = [
            'auth' => 'http://192.168.10.235:8082/autenticacao-api/api/',
            'protocol' => 'http://192.168.10.235:8082/protocolo-api/api/'
        ];
        $this->client = new Client([
            'base_uri' => $this->urls['protocol'],
            'timeout' => 10
        ]);
        $this->token = [];
    }

    /**
     * @param int $secretary
     * @return int|null
     */
    protected function getProtocolSector(int $secretary = 2700): ?int
    {
        if (empty($this->multiUser[$secretary]['protocolSector'])) {
            return null;
        }

        return $this->multiUser[$secretary]['protocolSector'];
    }

    /**
     * @param int $secretary
     * @return string|null
     */
    protected function getToken(int $secretary = 2700): ?string
    {
        return ($this->token[$secretary] ?? $this->generateToken($secretary));
    }

    /**
     * @param int $secretary
     * @return string
     */
    private function generateToken(int $secretary): string
    {
        try {
            if (
                !empty($_SESSION['supe']['api']['token'][$secretary])
                && strtotime('now') < $_SESSION['supe']['api']['token'][$secretary]['exp']
            ) {
                return $_SESSION['supe']['api']['token'][$secretary]['value'];
            }

            if (!isset($this->multiUser[$secretary])) {
                throw new Exception('O usuário para a secretaria informada não existe');
            }

            $client = new Client(['base_uri' => $this->urls['auth']]);
            $response = $client->post('autenticar', ['json' => $this->multiUser[$secretary]['auth']]);

            $token = json_decode($response->getBody(), true)['token'];
            $decodedToken = json_decode(
                base64_decode(
                    str_replace('_', '/', str_replace('-', '+', explode('.', $token)[1]))
                ),
                true
            );

            $_SESSION['supe']['api']['token'][$secretary] = [
                'value' => $token,
                'exp' => $decodedToken['exp']
            ];

            return $token;
        } catch (GuzzleException|Exception $e) {
            http_response_code(self::UNAUTHORIZED);
            echo json_encode('Não autorizado');
            exit;
        }
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
            $errors = ['supe' => json_decode($obj->getResponse()->getBody(), true)];
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
