<?php

namespace Ano\DataGrid;

use Ano\DataGrid\Column\ColumnTypeInterface;

interface DataGridFactoryInterface
{
    /**
     * Creates and returns a DataGrid instance
     *
     * @param  string $name
     *
     * @return DataGridBuilderInterface
     */
    public function createBuilder($name);

    /**
     * Loads a ColumnType instance
     *
     * @param string $name
     */
    public function loadColumnType($name);

    /**
     * Returns a Column Type by its name
     * Loads the Column Type if not already loaded
     *
     * @param string $name
     *
     * @return ColumnTypeInterface
     *
     * @throws UnexpectedTypeException if $name is not a string
     */
    public function getColumnType($name);

    /**
     * Check whether or not a column type is available
     *
     * @param string $name
     *
     * @return boolean
     */
    public function hasColumnType($name);

    /**
     * Registers and loads a new column type
     *
     * @param ColumnTypeInterface $columnType
     */
    public function addColumnType(ColumnTypeInterface $columnType);
}