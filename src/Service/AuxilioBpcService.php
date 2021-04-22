<?php

namespace Intec\TransparenciaViagensServico\Service;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Intec\IntecSlimBase\Exception\Domain\GenericDomainException;

class AuxilioBpcService
{
    private const AUXILIO_CODES = '/api-de-dados/auxilio-emergencial-por-municipio';
    private const BPC_CODES = '/api-de-dados/bpc-por-municipio';

    public function __construct(private Client $httpClient)
    {
    }

    public function getAuxilioCodes(int $pageNumber, string $codigoIBGE, int $mesAno): ?array
    {
        $queryParams = [
            'pagina' => $pageNumber,
            'codigoIbge' => $codigoIBGE,
            'mesAno' => $mesAno
        ];

        try {
            return $this->get(self::AUXILIO_CODES, $queryParams);
        } catch (Exception $e) {
            throw new GenericDomainException($queryParams, $e->getMessage(), 100_000_100, $e);
        }
    }
    public function getBpcCodes(int $pageNumber, string $codigoIBGE, int $mesAno): ?array
    {
        $queryParams = [
            'pagina' => $pageNumber,
            'codigoIbge' => $codigoIBGE,
            'mesAno' => $mesAno
        ];

        try {
            return $this->get(self::BPC_CODES, $queryParams);
        } catch (Exception $e) {
            throw new GenericDomainException($queryParams, $e->getMessage(), 100_000_100, $e);
        }
    }

    private function get(string $path, array $queryParams): ?array
    {
        try {
            $response = $this->httpClient->request('GET', $path, [
                'query' => $queryParams,
            ]);

            return $response->getStatusCode() != 204
                ? json_decode((string) $response->getBody(), true)
                : null;
        } catch (BadResponseException $e) {
            $message = (string) ($e->getResponse())->getBody();
            if (!$message) {
                $message = $e->getMessage();
            }

            throw new Exception($message, 0, $e);
        }
    }
}
