<?php

namespace Ano\DataGrid;

use Ano\DataGrid\Column\ColumnInterface;

interface DataGridInterface
{
    /**
     * @param ColumnInterface $column
     */
    public function addColumn(ColumnInterface $column);

    /**
     * @param  string $name
     *
     * @return ColumnInterface by its name
     */
    public function getColumn($name);

    /**
     * Checks whether a column with the given name exists in the grid
     *
     * @param string $name
     *
     * @return boolean
     */
    public function hasColumn($name);

    /**
     * @param ColumnInterface[] $columns
     */
    public function setColumns(array $columns);

    /**
     * @param object|array $data The Data to be binded to the grid
     */
    public function setData($data);

    /**
     * @return object|array
     */
    public function getData();
}