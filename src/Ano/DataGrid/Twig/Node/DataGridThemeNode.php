<?php

namespace Ano\DataGrid\Twig\Node;

class DataGridThemeNode extends \Twig_Node
{
    public function __construct(\Twig_NodeInterface $dataGrid, \Twig_NodeInterface $resources, $lineno, $tag = null)
    {
        parent::__construct(array('dataGrid' => $dataGrid, 'resources' => $resources), array(), $lineno, $tag);
    }

    /**
     * Compiles the node to PHP.
     *
     * @param \Twig_Compiler $compiler A Twig_Compiler instance
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('echo $this->env->getExtension(\'data_grid\')->setTheme(')
            ->subcompile($this->getNode('dataGrid'))
            ->raw(', array(')
        ;

        foreach ($this->getNode('resources') as $resource) {
            $compiler
                ->subcompile($resource)
                ->raw(', ')
            ;
        }

        $compiler->raw("));\n");
    }
}
