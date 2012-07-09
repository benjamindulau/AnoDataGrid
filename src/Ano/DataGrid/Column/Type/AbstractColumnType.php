<?php

namespace Ano\DataGrid\Column\Type;

use Ano\DataGrid\Column\ColumnInterface;
use Ano\DataGrid\Column\ColumnTypeInterface;
use Ano\DataGrid\Column\ColumnView;
use Ano\DataGrid\DataGridInterface;

abstract class AbstractColumnType implements ColumnTypeInterface
{
    /**
     * {@inheritDoc}
     */
    public function buildView(ColumnView $view, ColumnInterface $column)
    {
        $view
            ->set('column', $column)
            ->set('name', $column->getName())
            ->set('label', $column->getOption('label', null))
            ->set('attr', $column->getOption('attr', array()))
            ->set('type', $column->getType()->getName())
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllowedOptionValues(array $options)
    {
        return array();
    }
}