<?php

namespace Ano\DataGrid;

use Ano\DataGrid\Column\ColumnTypeInterface;
use Ano\DataGrid\Exception\DataGridException;
use Ano\DataGrid\Exception\UnexpectedTypeException;
use Ano\DataGrid\Column\Column;

class DataGridBuilder implements DataGridBuilderInterface
{
    /* @var string */
    protected $name;

    /**
     * The data grid factory
     * @var DataGridFactoryInterface
     */
    protected $factory;

    /* @var array */
    private $columns = array();

    /**
     * Constructor.
     *
     * @param string                    $name
     * @param DataGridFactoryInterface  $factory
     */
    public function __construct($name, DataGridFactoryInterface $factory)
    {
        $this->name = $name;
        $this->factory = $factory;
    }

    /**
     * {@inheritDoc}
     */
    public function getDataGridFactory()
    {
        return $this->factory;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function addColumn($name, $columnType = null, $propertyPath = null, array $options = array())
    {
        if (null !== $columnType && !is_string($columnType) && !$columnType instanceof ColumnTypeInterface) {
            throw new UnexpectedTypeException($columnType, 'string or Ano\DataGrid\Column\ColumnTypeInterface');
        }

        $this->columns[$name] = array(
            'columnType'   => $columnType,
            'propertyPath' => $propertyPath,
            'options'      => $options,
        );

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getColumn($name)
    {
        if (!$this->hasColumn($name)) {
            throw new DataGridException(sprintf('The column "%s" does not exist', $name));
        }

        return $this->columns[$name];
    }

    /**
     * {@inheritDoc}
     */
    public function removeColumn($name)
    {
        if ($this->hasColumn($name)) {
            unset($this->columns[$name]);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasColumn($name)
    {
        return isset($this->columns[$name]);
    }

    /**
     * {@inheritDoc}
     */
    public function getDataGrid()
    {
        $columns = array();
        foreach($this->columns as $name => $column) {
            $type = $this->getDataGridFactory()->getColumnType($column['columnType']);
            $columns[] = new Column($name, $type, $column['propertyPath']);
        }

        $dataGrid = new DataGrid($columns);

        return $dataGrid;
    }
}