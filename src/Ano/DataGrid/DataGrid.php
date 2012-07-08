<?php

namespace Ano\DataGrid;

use Ano\DataGrid\Column\ColumnInterface;
use Ano\DataGrid\Exception\UnexpectedTypeException;
use Ano\DataGrid\Exception\DataGridException;

class DataGrid implements DataGridInterface
{
    /* @var array|ColumnInterface[] */
    protected $columns;

    /* @var array|object */
    protected $data;

    /**
     * Constructor
     *
     * @param ColumnInterface[] $columns
     */
    public function __construct(array $columns = array())
    {
        $this->setColumns($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function addColumn(ColumnInterface $column)
    {
        $column->setGrid($this);
        $this->columns[$column->getName()] = $column;

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
    public function hasColumn($name)
    {
        return isset($this->columns[$name]);
    }

    /**
     * @param array|ColumnInterface[] $columns
     */
    public function setColumns(array $columns)
    {
        $this->columns = array();
        foreach($columns as $column) {
            $this->columns[$column->getName()] = $column;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setData($data)
    {
        if (!is_object($data) && !is_array($data)) {
            throw new UnexpectedTypeException($data, 'array or object');
        }

        $this->data = $data;
        // $this->prepareRows();
    }

    /**
     * @return array|object
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritDoc}
     */
    public function createView()
    {
        $view = new DataGridView();

        foreach($this->columns as $column) {
            $columnView = $column->createView($view);
            $view->addColumn($column->getName(), $columnView);
        }

        $view
            ->set('dataGrid', $view)
            ->set('data', $this->getData())
        ;

        return $view;
    }
}