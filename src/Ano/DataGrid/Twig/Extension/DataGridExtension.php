<?php

namespace Ano\DataGrid\Twig\Extension;

use Ano\DataGrid\Twig\TokenParser\DataGridThemeTokenParser;
use Ano\DataGrid\DataGridView;
use Ano\DataGrid\Column\ColumnView;
use Ano\DataGrid\View;
use Ano\DataGrid\Exception\DataGridException;
use Symfony\Component\Form\Util\FormUtil;

class DataGridExtension extends \Twig_Extension
{
    protected $resources;
    protected $blocks;
    protected $environment;
    protected $themes;
    protected $varStack;
    protected $template;

    public function __construct(array $resources = array())
    {
        $this->themes = new \SplObjectStorage();
        $this->varStack = array();
        $this->blocks = new \SplObjectStorage();
        $this->resources = $resources;
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Sets a theme for a given view.
     *
     * @param DataGridView $view      A DataGridView instance
     * @param array        $resources An array of resources
     */
    public function setTheme(DataGridView $view, array $resources)
    {
        $this->themes->attach($view, $resources);
        $this->blocks = new \SplObjectStorage();
    }

    /**
     * Returns the token parser instance to add to the existing list.
     *
     * @return array An array of Twig_TokenParser instances
     */
    public function getTokenParsers()
    {
        return array(
            // {% data_grid_theme dataGrid "SomeBungle::widgets.twig" %}
            new DataGridThemeTokenParser(),
        );
    }

    public function getFunctions()
    {
        return array(
            'grid_head'         => new \Twig_Function_Method($this, 'renderHead', array('is_safe' => array('html'))),
            'grid_row'          => new \Twig_Function_Method($this, 'renderRow', array('is_safe' => array('html'))),
            'grid_rows'         => new \Twig_Function_Method($this, 'renderRows', array('is_safe' => array('html'))),

            'grid_column_head'       => new \Twig_Function_Method($this, 'renderColumnHead', array('is_safe' => array('html'))),
            'grid_column_body'       => new \Twig_Function_Method($this, 'renderColumnBody', array('is_safe' => array('html'))),
        );
    }

    /**
     * Renders column head for the view.
     *
     * @param ColumnView $view      The view to render
     * @param array      $variables An array of variables
     *
     * @return string The html markup
     */
    public function renderColumnHead(ColumnView $view, array $variables = array())
    {
        return $this->render($view, 'column_head', $variables);
    }

    /**
     * Renders column body.
     *
     * @param ColumnView $view      The view to render
     * @param array      $variables An array of variables
     *
     * @return string The html markup
     */
    public function renderColumnBody(ColumnView $view, array $variables = array())
    {
        return $this->render($view, 'column_' . $view->get('type'), $variables);
    }

    /**
     * Renders grid head for the view.
     *
     * @param DataGridView $view      The view to render as a row
     * @param array        $variables An array of variables
     *
     * @return string The html markup
     */
    public function renderHead(DataGridView $view, array $variables = array())
    {
        return $this->render($view, 'head', $variables);
    }

    /**
     * Renders a row for the view.
     *
     * @param DataGridView $view      The view to render as a row
     * @param array        $variables An array of variables
     *
     * @return string The html markup
     */
    public function renderRow(DataGridView $view, array $variables = array())
    {
        return $this->render($view, 'row', $variables);
    }

    public function renderRows(DataGridView $view, array $variables = array())
    {
        return $this->render($view, 'rows', $variables);
    }

    /**
     * Renders a template.
     *
     * 1. This function first looks for a block named "_<view id>_<section>",
     * 2. if such a block is not found the function will look for a block named
     *    "<type name>_<section>",
     * 3. the type name is recursively replaced by the parent type name until a
     *    corresponding block is found
     *
     * @param View     $view       The data grid view
     * @param string   $section    The section to render (i.e. 'row', 'widget', 'label', ...)
     * @param array    $variables  Additional variables
     *
     * @return string The html markup
     *
     * @throws DataGridException if no template block exists to render the given section of the view
     */
    protected function render(View $view, $section, array $variables = array())
    {
        if (null === $this->template) {
            $this->template = reset($this->resources);
            if (!$this->template instanceof \Twig_Template) {
                $this->template = $this->environment->loadTemplate($this->template);
            }
        }

        $rendering = 'grid_' . $section;
        $blocks = $this->getBlocks($view->get('dataGrid'));

        if (isset($blocks[$rendering])) {

            $html = $this->template->renderBlock($rendering, $view->all(), $blocks);

            return $html;
        }

        throw new DataGridException(sprintf(
            'Unable to render the data grid as the following block doesn\'t exist: "%s".', $rendering
        ));
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'data_grid';
    }

    /**
     * Returns the blocks used to render the view.
     *
     * Templates are looked for in the resources in the following order:
     *   * resources from the themes (and its parents)
     *   * resources from the themes of parent views (up to the root view)
     *   * default resources
     *
     * @param DataGridView $view The view
     *
     * @return array An array of Twig_TemplateInterface instances
     */
    protected function getBlocks(DataGridView $view)
    {
        if (!$this->blocks->contains($view)) {

            $templates = $this->resources;

            if (isset($this->themes[$view])) {
                $templates = array_merge($templates, $this->themes[$view]);
            }

            $blocks = array();

            foreach ($templates as $template) {
                if (!$template instanceof \Twig_Template) {
                    $template = $this->environment->loadTemplate($template);
                }
                $templateBlocks = array();
                do {
                    $templateBlocks = array_merge($template->getBlocks(), $templateBlocks);
                } while (false !== $template = $template->getParent(array()));
                $blocks = array_merge($blocks, $templateBlocks);
            }

            $this->blocks->attach($view, $blocks);
        } else {
            $blocks = $this->blocks[$view];
        }

        return $blocks;
    }
}
