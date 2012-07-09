<?php

namespace Ano\DataGrid\Column\Type;

use Ano\DataGrid\Column\ColumnInterface;
use Ano\DataGrid\Column\ColumnView;

class DateColumnType extends AbstractColumnType
{
    public function buildView(ColumnView $view, ColumnInterface $column)
    {
        parent::buildView($view, $column);

        $view
            ->set('format', 'd/m/Y') // TODO
        ;
    }


    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'date';
    }
}