<?php

namespace Ano\DataGrid\Column;

use Ano\DataGrid\View;
use Ano\DataGrid\DataGridView;
use Ano\DataGrid\Exception\UnexpectedTypeException;

class ColumnView extends View
{
    public function __construct(DataGridView $dataGrid)
    {
        $this->set('dataGrid', $dataGrid);
    }

    public function getValue($index)
    {
        $dataGrid = $this->get('dataGrid');
        $data = $dataGrid->get('data');

        return $data[$index];
    }
}