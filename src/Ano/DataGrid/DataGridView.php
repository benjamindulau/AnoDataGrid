<?php

namespace Ano\DataGrid;

use Ano\DataGrid\Exception\UnexpectedTypeException;
use Ano\DataGrid\Column\ColumnView;

class DataGridView extends View
{
    private $columns = array();

    /**
     * Sets the columns view.
     *
     * @param array $columns The columns views
     *
     * @return DataGridView Fluent interface
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Returns the columns.
     *
     * @return ColumnView[] The columns views
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Adds a column view
     *
     * @param  string     $name
     * @param  ColumnView $column
     * @return DataGridView Fluent interface
     */
    public function addColumn($name, ColumnView $column)
    {
        $this->columns[$name] = $column;

        return $this;
    }

    /**
     * Returns whether this view has columns.
     *
     * @return boolean Whether this view has columns
     */
    public function hasColumns()
    {
        return count($this->columns) > 0;
    }

    /**
     * Returns whether this view has the given column.
     *
     * @param string $name
     *
     * @return boolean
     */
    public function hasColumn($name)
    {
        return isset($this->columns[$name]);
    }
}