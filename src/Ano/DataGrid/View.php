<?php

namespace Ano\DataGrid;

use Ano\DataGrid\Exception\UnexpectedTypeException;

abstract class View
{
    protected $vars = array(
        'value' => null,
        'attr'  => array(),
    );

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
}