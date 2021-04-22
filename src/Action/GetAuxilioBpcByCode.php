<?php

namespace Intec\TransparenciaViagensServico\Action;

use Intec\IntecSlimBase\Action\JsonAction;
use Intec\TransparenciaViagensServico\Model\AuxilioBpc;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetAuxilioBpcByCode extends JsonAction
{
    public function __construct(private AuxilioBpc $auxilioBpc)
    {
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $params = $request->getQueryParams();

        $auxilioBpc = $this->auxilioBpc->getAuxilioBpcByCode($params['codigo_ibge'], $params['mes_ano'], $params['pagina']);

        if($$auxilioBpc['is_db'] === false)
        {
            $this->auxilioBpc->saveAuxilioBpc($auxilioBpc);
        }        

        return $this->toJson(response: $response, data: $auxilioBpc);
    }
}
