<?php

namespace Ano\DataGrid\Column;

use Ano\DataGrid\DataGridInterface;
use Ano\DataGrid\DataGridView;
use Ano\DataGrid\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Util\PropertyPath;
use Ano\DataGrid\Exception\NotAllowedOptionException;

class Column implements ColumnInterface
{
    /* @var string */
    protected $name;

    /* @var ColumnTypeInterface */
    protected $type;

    /* @var PropertyPath */
    protected $propertyPath;

    /* @var DataGridInterface */
    protected $grid;

    /* @var array */
    protected $options;

    /**
     * Constructor
     *
     * @param string              $name          The column name
     * @param ColumnTypeInterface $type          The column type
     * @param array               $options       The column options
     */
    public function __construct($name, ColumnTypeInterface $type, array $options = array())
    {
        $this->setName($name);
        $this->setType($type);
        $this->setOptions($options);

        if ($this->hasOption('property_path')) {
            $this->setPropertyPath($this->getOption('property_path'));
        }
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPropertyPath($propertyPath)
    {
        if (!is_string($propertyPath) && !$propertyPath instanceof PropertyPath) {
            throw new UnexpectedTypeException($propertyPath, 'string or Symfony\Component\Form\Util\PropertyPath');
        }

        $this->propertyPath = is_string($propertyPath) ? new PropertyPath($propertyPath) : $propertyPath;
    }

    public function getPropertyPath()
    {
        return $this->propertyPath;
    }

    public function setType(ColumnTypeInterface $type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getValue()
    {
        // TODO: Implement getValue() method.
    }

    public function setGrid(DataGridInterface $grid)
    {
        $this->grid = $grid;
    }

    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * {@inheritDoc}
     */
    public function createView(DataGridView $dataGrid)
    {
        $view = new ColumnView($dataGrid);
        $this->getType()->buildView($view, $this);

        return $view;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllowedOptions()
    {
        return array(
            'label',
            'property_path',
            'attr',
        );
    }

    /**
     * {@inheritDoc}
     */
    public function setOptions(array $options = array())
    {
        $this->validateOptions($options);

        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function validateOptions(array $options = array())
    {
        $self = $this;
        array_walk($options, function($value, $key) use ($self) {
            if (!in_array($key, $self->getAllowedOptions())) {
                throw new NotAllowedOptionException(sprintf('Option "%s" is not allowed for column "%s"',
                    $key,
                    $self->getName()
                ));
            }
        });
    }

    /**
     * {@inheritDoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $name
     *
     * @return boolean
     */
    public function hasOption($name)
    {
        return array_key_exists($name, $this->options);
    }

    /**
     * {@inheritDoc}
     */
    public function getOption($name, $default = null)
    {
        if ($this->hasOption($name)) {
            return $this->options[$name];
        }

        return $default;
    }
}