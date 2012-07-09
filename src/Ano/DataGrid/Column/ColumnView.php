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

    /**
     * {@inheritDoc}
     */
    public function get($name, $default = null)
    {
        if ('value' === $name) {
            $dataGrid = $this->get('dataGrid');
            $data = $dataGrid->get('data');
            if (null !== ($index = $this->get('index', null))) {
                $this->set('value', $this->get('column')->getValue($data, $index));
            }
        }

        return parent::get($name, $default);
    }
}