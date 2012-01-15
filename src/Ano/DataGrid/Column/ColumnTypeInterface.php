<?php

namespace Ano\DataGrid\Column;

use Ano\DataGrid\DataGridInterface;
use Ano\DataGrid\Column\ColumnView;

interface ColumnTypeInterface
{
    public function buildView(ColumnView $view);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param array $options
     */
    public function getDefaultOptions(array $options);
}