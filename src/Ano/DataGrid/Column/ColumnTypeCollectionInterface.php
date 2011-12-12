<?php

namespace Ano\DataGrid\Column;

interface ColumnTypeCollectionInterface
{
    /**
     * Returns a column type by its name
     *
     * @param string $name
     *
     * @return ColumnTypeInterface
     */
    public function getColumnType($name);

    /**
     * Check whether or not the collection has the given type
     *
     * @param string $name
     *
     * @return boolean
     */
    public function hasColumnType($name);

    /**
     * Registers the column types.
     *
     * @return ColumnTypeInterface[]
     */
    public function registerColumnTypes();
}