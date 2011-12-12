<?php

namespace Ano\DataGrid\Column;

use Ano\DataGrid\DataGridInterface;
use Ano\DataGrid\DataGridView;

interface ColumnTypeInterface
{
    /**
     * @param DataGridView      $view
     * @param DataGridInterface $dataGrid
     */
    public function buildView(DataGridView $view, DataGridInterface $dataGrid);

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param array $options
     */
    public function getDefaultOptions(array $options);
}