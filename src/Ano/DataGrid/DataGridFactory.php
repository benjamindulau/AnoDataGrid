<?php

namespace Ano\DataGrid;

use Ano\DataGrid\Exception\DataGridException;
use Ano\DataGrid\Exception\UnexpectedTypeException;
use Ano\DataGrid\Column\ColumnTypeCollectionInterface;
use Ano\DataGrid\Column\ColumnTypeInterface;

class DataGridFactory implements DataGridFactoryInterface
{
    /**
     * All known column types
     * @var ColumnTypeCollectionInterface[]
     */
    private $columnTypeCollections = array();

    private $columnTypes = array();

    /**
     * Constructor
     *
     * @param ColumnTypeCollectionInterface[]
     */
    public function __construct(array $columnTypeCollections)
    {
        foreach ($columnTypeCollections as $collection) {
            if (!$collection instanceof ColumnTypeCollectionInterface) {
                throw new UnexpectedTypeException($collection, 'Ano\DataGrid\Column\ColumnTypeCollectionInterface');
            }

            $this->columnTypeCollections[] = $collection;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function createBuilder($name, $data = null)
    {
        $builder = new DataGridBuilder($name, $this);
        $builder->setData($data);

        return $builder;
    }

    /**
     * {@inheritDoc}
     */
    public function loadColumnType($name)
    {
        $columnType = null;

        foreach ($this->columnTypeCollections as $collection) {
            if ($collection->hasColumnType($name)) {
                $columnType = $collection->getColumnType($name);
                break;
            }
        }

        if (!$columnType) {
            throw new DataGridException(sprintf('Could not load column type "%s"', $name));
        }

        $this->columnTypes[$name] = $columnType;
    }

    /**
     * {@inheritDoc}
     */
    public function getColumnType($name)
    {
        if (!is_string($name)) {
            throw new UnexpectedTypeException($name, 'string');
        }

        if (!isset($this->columnTypes[$name])) {
            $this->loadColumnType($name);
        }

        return $this->columnTypes[$name];
    }

    /**
     * {@inheritDoc}
     */
    public function hasColumnType($name)
    {
        if (isset($this->columnTypes[$name])) {
            return true;
        }

        try {
            $this->loadColumnType($name);
        } catch (DataGridException $e) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function addColumnType(ColumnTypeInterface $columnType)
    {
        // TODO: Implement addColumnType() method.
    }


}