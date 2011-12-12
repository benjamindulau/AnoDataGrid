<?php

namespace Ano\DataGrid\Column;

use Ano\DataGrid\Exception\DataGridException;
use Ano\DataGrid\Exception\UnexpectedTypeException;

class CoreColumnTypeCollection extends AbstractColumnTypeCollection
{
    public function registerColumnTypes()
    {
        return array(
            new Type\TextColumnType(),
        );
    }
}