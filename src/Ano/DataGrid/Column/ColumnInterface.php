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
     * @return \Symfony\Component\Form\Util\PropertyPath|string $propertyPath
     */
    public function setPropertyPath($propertyPath);

    /**
     * @return \Symfony\Component\Form\Util\PropertyPath
     */
    public function getPropertyPath();

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param DataGridInterface $grid
     */
    public function setGrid(DataGridInterface $grid);

    /**
     * @return DataGridInterface
     */
    public function getGrid();
}