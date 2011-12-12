<?php

namespace Ano\DataGrid\Column;

use Ano\DataGrid\Exception\DataGridException;
use Ano\DataGrid\Exception\UnexpectedTypeException;

abstract class AbstractColumnTypeCollection implements ColumnTypeCollectionInterface
{
    /**
     * The column types provided by this collection
     * @var ColumnTypeInterface[]
     */
    private $columnTypes;


    /**
     * {@inheritDoc}
     */
    public function getColumnType($name)
    {
        if (null === $this->columnTypes) {
            $this->initColumnTypes();
        }

        if (!isset($this->columnTypes[$name])) {
            throw new DataGridException(sprintf('The column type "%s" can not be loaded by this extension', $name));
        }

        return $this->columnTypes[$name];
    }

    /**
     * {@inheritDoc}
     */
    public function hasColumnType($name)
    {
        if (null === $this->columnTypes) {
            $this->initColumnTypes();
        }

        return isset($this->columnTypes[$name]);
    }


    private function initColumnTypes()
    {
        $this->columnTypes = array();

        foreach ($this->registerColumnTypes() as $columnType) {
            if (!$columnType instanceof ColumnTypeInterface) {
                throw new UnexpectedTypeException($columnType, 'Ano\DataGrid\Column\ColumnTypeInterface');
            }

            $this->columnTypes[$columnType->getName()] = $columnType;
        }
    }
}