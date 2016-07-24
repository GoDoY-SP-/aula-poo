<?php

namespace SoNAula\Entidade;

/**
 * Interface InterfaceColecao
 * @package SoNAula\Entidade
 */
interface InterfaceColecao extends \Iterator
{
    /**
     * @param $entidade
     * @return mixed
     */
    public function add($entidade);

    /**
     * @param $entidade
     * @return mixed
     */
    public function remove($entidade);
}