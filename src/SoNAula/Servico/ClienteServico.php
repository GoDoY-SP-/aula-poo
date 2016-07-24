<?php

namespace SoNAula\Servico;

use SoNAula\Entidade\ClienteColecao;
use SoNAula\Entidade\ClienteEntidade;

/**
 * Class ClienteServico
 * @package SoNAula\Servico
 */
class ClienteServico
{

    /**
     * Obter Lista de Clientes
     * @param $ordem
     * @return ClienteColecao
     */
    public function obterClientes($ordem = 'ASC')
    {
        // Tratar parâmetros
        $ordem = trim($ordem);
        $ordem = (!in_array($ordem, ['ASC', 'DESC'])) ? 'ASC' : $ordem;

        // Instanciar coleção de clientes
        $clientesColecao = new ClienteColecao();

        // Adicionar 10 clientes randomicos
        for ($i = 1; $i <= 10; $i++) {
            // Instanciar entidade
            $clienteEntidade = new ClienteEntidade();

            // Hidratar entidade
            $clienteEntidade->setId($i);
            $clienteEntidade->setNome("Nome de Cliente " . rand(0, 100));
            $clienteEntidade->setCpf(rand(111111111, 999999999) * 10);
            $clienteEntidade->setEndereco("Endereço " . rand(0, 100));
            $clienteEntidade->setBairro("Bairro " . rand(0, 100));
            $clienteEntidade->setCidade("Cidade " . rand(0, 100));
            $clienteEntidade->setEstado("SP");

            // Adicionar na coleção
            $clientesColecao->add($clienteEntidade);
        }

        // Retornar coleção
        return $this->sortClientes($clientesColecao, $ordem);
    }

    /**
     * Ordenar Coleção de Clientes
     * @param $colecao
     * @param $ordem
     * @return ClienteColecao
     */
    private function sortClientes($colecao, $ordem)
    {
        if ($colecao->count() > 0 && $ordem == 'DESC') {
            // Total de clientes
            $total = $colecao->count();

            // Nova colecao
            $novaColecao = new ClienteColecao();

            // Ordenar DESC
            for ($i = $total; $i >= 1; $i--) {
                $novaColecao->add($colecao->seek($i));
            }

            return $novaColecao;
        }

        return $colecao;
    }
}