<?php
namespace DEC\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class IndexFieldset extends Fieldset {

	protected $inputFilter;

	public function __construct() {
        parent::__construct('indexFieldset');
        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'index',
            'attributes' => [
                'placeholder' => 'Index name',
                'class' => 'form-control indexInput',
            ],
            'options' => [
                'label' => 'Index: ',
            ],
        ]);
        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'columns',
            'attributes' => [
                'placeholder' => 'Comma-separated list of column names',
                'class' => 'form-control columnsInput',
            ],
            'options' => [
                'label' => 'Columns: ',
            ],
        ]);
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();
            $inputFilter->add($factory->createInput([
                'name' => 'index',
                'required' => false,
                'filters' => [
                    [
                        'name' => 'StringTrim',
                    ],
                    [
                        'name' => 'StripTags',
                    ],
                ],
            ]));
            $inputFilter->add($factory->createInput([
                'name' => 'columns',
                'required' => false,
                'filters' => [
                    [
                        'name' => 'StringTrim',
                    ],
                    [
                        'name' => 'StripTags',
                    ],
                ],
            ]));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}