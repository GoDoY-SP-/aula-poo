<?php

namespace SoNAula\Entidade;

/**
 * Class AbstractColecao
 * @package SoNAula\Entidade
 */
abstract class AbstractColecao implements InterfaceColecao
{
    /**
     * @var array
     */
    protected $colecao;

    /* (non-PHPdoc)
    * @see /Iterator::current()
    */
    public function current()
    {
        return current($this->colecao);
    }

    /* (non-PHPdoc)
    * @see /Iterator::key()
    */
    public function key()
    {
        return key($this->colecao);
    }

    /* (non-PHPdoc)
    * @see /Iterator::next()
    */
    public function next()
    {
        return next($this->colecao);
    }

    /* (non-PHPdoc)
    * @see /Iterator::rewind()
    */
    public function rewind()
    {
        return reset($this->colecao);
    }

    /* (non-PHPdoc)
    * @see /Iterator::valid()
    */
    public function valid()
    {
        return isset($this->colecao[$this->key()]);
    }

    /**
     * @param $entidade
     * @return $this
     */
    public function add($entidade)
    {
        $this->colecao[(method_exists($entidade, "getId") ? $entidade->getId() : $entidade)] = $entidade;
        return $this;
    }

    /**
     * @param $entidade
     */
    public function remove($entidade)
    {
        unset($this->colecao[(method_exists($entidade, "getId") ? $entidade->getId() : $entidade)]);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->colecao);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function seek($id)
    {
        return $this->colecao [$id];
    }
}