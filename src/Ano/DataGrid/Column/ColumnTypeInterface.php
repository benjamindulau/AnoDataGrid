<?php

namespace Ano\DataGrid\Column;

use Ano\DataGrid\DataGridInterface;
use Ano\DataGrid\Column\ColumnView;
use Ano\DataGrid\Column\ColumnInterface;

interface ColumnTypeInterface
{
    /**
     * Aggregates attributes on the view object
     *
     * @param ColumnView $view
     * @param ColumnInterface $column
     *
     * @return void
     */
    public function buildView(ColumnView $view, ColumnInterface $column);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param array $options
     */
    public function getDefaultOptions(array $options);

    /**
     * Returns the allowed option values for each option (if any).
     *
     * @param array $options
     *
     * @return array The allowed option values
     */
    public function getAllowedOptionValues(array $options);
}