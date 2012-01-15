<?php

namespace Ano\DataGrid\Column\Type;

use Ano\DataGrid\Column\ColumnTypeInterface;
use Ano\DataGrid\Column\ColumnView;
use Ano\DataGrid\DataGridInterface;

class TextColumnType implements ColumnTypeInterface
{
    /**
     * {@inheritDoc}
     */
    public function buildView(ColumnView $view)
    {

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