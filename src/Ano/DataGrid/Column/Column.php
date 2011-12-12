<?php

namespace Ano\DataGrid\Column;

use Ano\DataGrid\DataGridInterface;
use Ano\DataGrid\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Util\PropertyPath;

class Column implements ColumnInterface
{
    /* @var string */
    protected $name;

    /* @var ColumnTypeInterface */
    protected $type;

    /* @var PropertyPath */
    protected $propertyPath;

    /* @var DataGridInterface */
    protected $grid;

    /**
     * Constructor
     *
     * @param string              $name          The column name
     * @param ColumnTypeInterface $type          The column type
     * @param PropertyPath|string $propertyPath  The data property path
     */
    public function __construct($name, ColumnTypeInterface $type, $propertyPath)
    {
        $this->setName($name);
        $this->setPropertyPath($propertyPath);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPropertyPath($propertyPath)
    {
        if (!is_string($propertyPath) && !$propertyPath instanceof PropertyPath) {
            throw new UnexpectedTypeException($propertyPath, 'string or Symfony\Component\Form\Util\PropertyPath');
        }

        $this->propertyPath = is_string($propertyPath) ? new PropertyPath($propertyPath) : $propertyPath;
    }

    public function getPropertyPath()
    {
        return $this->propertyPath;
    }

    public function setType(ColumnTypeInterface $type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getValue()
    {
        // TODO: Implement getValue() method.
    }

    public function setGrid(DataGridInterface $grid)
    {
        $this->grid = $grid;
    }

    public function getGrid()
    {
        return $this->grid;
    }
}