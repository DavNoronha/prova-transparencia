<?php

use Phinx\Migration\AbstractMigration;

class BpcTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $bpcCodesTable = $this->table('bpc_codes');

        $bpcCodesTable
        ->addColumn('data_referencia', 'string', [
            'limit' => 10,
            'null' => false,
        ])
        ->addColumn('cod_id', 'integer', [
            'limit' => 10,
            'null' => false,
        ])
        ->addColumn('municipio_codigoIBGE', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('municipio_codigoRegiao', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('municipio_nomeIBGE', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('municipio_nomeRegiao', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('municipio_pais', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('uf_nome', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('uf_sigla', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('quantidade_beneficiados', 'integer', [
            'limit' => 10,
            'null' => false,
        ])
        ->addColumn('tipo_descricao', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('tipo_descricao_detalhada', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('tipo_id', 'integer', [
            'limit' => 10,
            'null' => false,
        ])
        ->addColumn('valor', 'integer', [
            'limit' => 10,
            'null' => false,
        ])

        ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at', 'timestamp', [
            'default' => 'CURRENT_TIMESTAMP',
            'update' => 'CURRENT_TIMESTAMP',
        ])
        ->create();
    }
}
