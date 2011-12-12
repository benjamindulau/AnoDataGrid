<?php

namespace Ano\DataGrid;

use Ano\DataGrid\Exception\UnexpectedTypeException;
use Ano\DataGrid\Column\ColumnTypeCollectionInterface;

class DataGridFactory implements DataGridFactoryInterface
{
    /**
     * All known column types
     * @var ColumnTypeCollectionInterface[]
     */
    private $columnTypeCollections = array();

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
    public function createBuilder($name)
    {
        return new DataGridBuilder($name, $this);
    }

    /**
     * {@inheritDoc}
     */
    public function loadColumnType($name)
    {
        // TODO: Implement loadColumnType() method.
    }

    /**
     * {@inheritDoc}
     */
    public function getColumnType($name)
    {
        // TODO: Implement getColumnType() method.
    }

    /**
     * {@inheritDoc}
     */
    public function hasColumnType($name)
    {
        // TODO: Implement hasColumnType() method.
    }

    /**
     * {@inheritDoc}
     */
    public function addColumnType(ColumnTypeInterface $columnType)
    {
        // TODO: Implement addColumnType() method.
    }


}