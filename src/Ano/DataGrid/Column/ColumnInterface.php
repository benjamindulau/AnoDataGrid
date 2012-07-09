<?php

namespace Ano\DataGrid\Column;

use Ano\DataGrid\DataGridInterface;

interface ColumnInterface
{
    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param ColumnTypeInterface $type
     */
    public function setType(ColumnTypeInterface $type);

    /**
     * @return ColumnTypeInterface
     */
    public function getType();

    /**
     * @param string|\Symfony\Component\Form\Util\PropertyPath $propertyPath
     */
    public function setPropertyPath($propertyPath);

    /**
     * @return \Symfony\Component\Form\Util\PropertyPath
     */
    public function getPropertyPath();

    /**
     * @return mixed
     */
    public function getValue($data, $index);

    /**
     * @param DataGridInterface $grid
     */
    public function setGrid(DataGridInterface $grid);

    /**
     * @return DataGridInterface
     */
    public function getGrid();

    /**
     * Returns the allowed option
     *
     * @return array The allowed option names
     */
    public function getAllowedOptions();

    /**
     * Set the allowed options.
     *
     * @param array $options
     *
     * @return void
     */
    public function setOptions(array $options = array());

    /**
     * Returns the current column options.
     *
     * @return array
     */
    public function getOptions();

    /**
     * Returns the option value if it exists or a user defined default value
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getOption($name, $default = null);

    /**
     * Return boolean
     *
     * @param array $options
     *
     * @return void
     *
     * @throws \Ano\DataGrid\Exception\NotAllowedOptionException
     */
    public function validateOptions(array $options = array());
}