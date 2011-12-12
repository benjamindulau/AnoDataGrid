<?php

namespace Ano\DataGrid\Column\Type;

use Ano\DataGrid\Column\ColumnTypeInterface;
use Ano\DataGrid\DataGridView;
use Ano\DataGrid\DataGridInterface;

class TextColumnType implements ColumnTypeInterface
{
    /**
     * {@inheritDoc}
     */
    public function buildView(DataGridView $view, DataGridInterface $dataGrid)
    {
        // TODO: Implement buildView() method.
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'text';
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultOptions(array $options)
    {
        return $options;
    }

}