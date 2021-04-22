<?php

namespace Intec\TransparenciaViagensServico\Repository;

use Intec\IntecSlimBase\Exception\Domain\GenericDomainException;
use PDO;

class AuxilioBpcRepository implements RepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findAuxilioByCode(int $codigoIbge)
    {
        $sth = $this->pdo->prepare('select * from auxilio_codes where municipio_codigoIBGE = ?');
        $sth->execute([$codigoIbge]);

        $auxilio = $sth->fetch();

        if (!$auxilio) {
            throw new GenericDomainException(
                ['municipio_codigoIBGE' => $codigoIbge],
                "ibge code '{$codigoIbge}' not found",
                100_000_101
            );
        }

        return $auxilio;
    }

    public function findBpcByCode(int $codigoIbge)
    {
        $sth = $this->pdo->prepare('select * from bpc_codes where municipio_codigoIBGE = ?');
        $sth->execute([$codigoIbge]);

        $bpc = $sth->fetch();

        if (!$bpc) {
            throw new GenericDomainException(
                ['municipio_codigoIBGE' => $codigoIbge],
                "ibge code '{$codigoIbge}' not found",
                100_000_101
            );
        }

        return $bpc;
    }

    public function saveAuxilioData(array $data) 
    {
        $sql = $this->pdo->prepare('INSERT INTO auxilio_codes (
            dataReferencia,
            municipio_codigoIBGE,
            municipio_codigoRegiao,
            municipio_nomeIBGE,
            municipio_nomeRegiao,
            municipio_pais,
            uf_nome,
            uf_sigla,
            quantidadeBeneficiados,
            tipo_descricao,
            tipo_descricaoDetalhada,
            tipo_id,
            valor
            ) VALUES (
                :dataReferencia,
                :municipio_codigoIBGE,
                :municipio_codigoRegiao,
                :municipio_nomeIBGE,
                :municipio_nomeRegiao,
                :municipio_pais,
                :uf_nome,
                :uf_sigla,
                :quantidadeBeneficiados,
                :tipo_descricao,
                :tipo_descricaoDetalhada,
                :tipo_id,
                :valor
            )',
            $data);
        $sql->execute($data);
    }

    public function saveBpcData(array $data) 
    {
        $sql = $this->pdo->prepare('INSERT INTO bpc_codes (
            dataReferencia,
            municipio_codigoIBGE,
            municipio_codigoRegiao,
            municipio_nomeIBGE,
            municipio_nomeRegiao,
            municipio_pais,
            uf_nome,
            uf_sigla,
            quantidadeBeneficiados,
            tipo_descricao,
            tipo_descricaoDetalhada,
            tipo_id,
            valor
            ) VALUES (
                :dataReferencia,
                :municipio_codigoIBGE,
                :municipio_codigoRegiao,
                :municipio_nomeIBGE,
                :municipio_nomeRegiao,
                :municipio_pais,
                :uf_nome,
                :uf_sigla,
                :quantidadeBeneficiados,
                :tipo_descricao,
                :tipo_descricaoDetalhada,
                :tipo_id,
                :valor
            )',
            $data);
        $sql->execute($data);
    }
}