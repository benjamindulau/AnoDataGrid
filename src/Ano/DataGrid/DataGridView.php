<?php

namespace Ano\DataGrid;

use Ano\DataGrid\Exception\UnexpectedTypeException;

class DataGridView
{
    private $vars = array(
        'value' => null,
        'attr'  => array(),
    );

    private $columns = array();

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return DataGridView Fluent interface
     */
    public function set($name, $value)
    {
        $this->vars[$name] = $value;

        return $this;
    }

    /**
     * @param $name
     * @return Boolean
     */
    public function has($name)
    {
        return array_key_exists($name, $this->vars);
    }

    /**
     * @param $name
     * @param $default
     *
     * @return mixed
     */
    public function get($name, $default = null)
    {
        if (false === $this->has($name)) {
            return $default;
        }

        return $this->vars[$name];
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->vars;
    }

    /**
     * Sets the value for an attribute.
     *
     * @param string $name  The name of the attribute
     * @param string $value The value
     *
     * @return DataGridView Fluent interface
     */
    public function setAttribute($name, $value)
    {
        $this->vars['attr'][$name] = $value;

        return $this;
    }

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
     * @return array The columns views
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Adds a column view
     *
     * @param  string $name
     * @param  $column
     * @return DataGridView Fluent interface
     */
    public function addColumn($name, $column)
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