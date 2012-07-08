<?php

namespace Ano\DataGrid;

use Ano\DataGrid\Column\ColumnTypeInterface;

interface DataGridBuilderInterface
{
    /**
     * Returns the associated data grid factory.
     *
     * @return DataGridFactory The factory
     */
    public function getDataGridFactory();

    /**
     * Returns the name of the data grid.
     *
     * @return string The data grid name
     */
    public function getName();

    /**
     * Adds a new column to the data grid. A column must have a unique name within
     * the data grid. Otherwise the existing column is overwritten.
     *
     * @param string                     $name
     * @param ColumnTypeInterface|string $columnType
     * @param array                      $options
     *
     * @return DataGridBuilderInterface Fluent interface
     */
    public function addColumn($name, $columnType = null, array $options = array());

    /**
     * Returns a column by name.
     *
     * @param string $name The name of the column
     *
     * @return ColumnTypeInterface The column type
     *
//     * @throws FormException if the given child does not exist
     */
    public function getColumn($name);

    /**
     * Removes the column with the given name.
     *
     * @param string $name
     *
     * @return DataGridBuilderInterface Fluent interface
     */
    public function removeColumn($name);

    /**
     * Returns whether a column with the given name exists.
     *
     * @param  string $name
     *
     * @return boolean
     */
    public function hasColumn($name);

    /**
     * Creates the data grid.
     *
     * @return DataGridInterface The data grid
     */
    public function getDataGrid();

}