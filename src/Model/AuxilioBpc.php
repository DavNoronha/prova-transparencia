<?php

namespace Intec\TransparenciaViagensServico\Model;

use Exception;
use Intec\TransparenciaViagensServico\Repository\AuxilioBpcRepository;
use Intec\TransparenciaViagensServico\Service\AuxilioBpcService;

class AuxilioBpc
{
    public function __construct(private AuxilioBpcRepository $auxilioBpcRepository, private AuxilioBpcService $auxilioBpcService)
    {
    }

    public function getAuxilioBpcByCode(string $codigoIbge, int $mesAno, int $pagina): array
    {
        $auxilio = $this->auxilioBpcRepository->findAuxilioByCode($codigoIbge);
        $bpc = $this->auxilioBpcRepository->findBpcByCode($codigoIbge);

        if($auxilio && $bpc)
        {
            return [
                'auxilio' => $auxilio,
                'bpc' => $bpc,
                'is_db' => true
            ];

        } else {
            $auxilio = $this->auxilioBpcService->getAuxilioCodes($pagina, $codigoIbge, $mesAno);
            $bpc = $this->auxilioBpcService->getBpcCodes($pagina, $codigoIbge, $mesAno);

            return [
                'auxilio' => $auxilio[0],
                'bpc' => $bpc[0],
                'is_db' => false
            ];
        }        

    }

    public function saveAuxilioBpc(array $data) 
    {
        if(!$data)
        {
            throw new Exception('Não foi possível buscar dados do auxilio ou do bpc');
        }
        if($data['auxilio']) 
        {
            $auxilioBpcFormat = $this->formatAuxilioBpc($data['auxilio']);
            $this->auxilioBpcRepository->saveAuxilioData($auxilioBpcFormat);
        }
        if($data['bpc'])
        {
            $bpcFormat = $this->formatAuxilioBpc($data['bpc']);
            $this->auxilioBpcRepository->saveBpcData($bpcFormat);
        }
    }

    private function formatAuxilioBpc(array $data): array
    {
        $municipio = $data['municipio'];
        
        return [
            'data_referencia' => $data['dataReferencia'],
            'cod_id' => $data['id'],
            'municipio_codigoIBGE' => $municipio['codigoIBGE'],
            'municipio_codigoRegiao' => $municipio['codigoRegiao'],
            'municipio_nomeIBGE' => $municipio['nomeIBGE'],
            'municipio_nomeRegiao' => $municipio['nomeRegiao'],
            'municipio_pais' => $municipio['pais'],
            'uf_nome' => $municipio['uf']['nome'],
            'uf_sigla' => $municipio['uf']['sigla'],
            'quantidade_beneficiados' => $data['quantidadeBeneficiados'],
            'tipo_descricao' => $data['tipo']['descricao'],
            'tipo_descricao_detalhada' => $data['tipo']['descricaoDetalhada'],
            'tipo_id' => $data['tipo']['id'],
            'valor' => $data['valor'],
        ];
    }
}