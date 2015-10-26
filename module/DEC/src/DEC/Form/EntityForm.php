<?php

namespace DEC\Form;

use Zend\Form\Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\CollectionInputFilter;

class EntityForm extends Form implements InputFilterAwareInterface {

	protected $inputFilter;

	public function __construct() {
		parent::__construct("entityForm");
		$this->setAttribute('method', 'post');
		$this->setAttribute('role', 'form');
		$this->setAttribute('class', 'form-horizontal');
		$this->add([
			'type' => 'Zend\Form\Element\Text',
			'name' => 'namespace',
			'attributes' => [
				'value' => 'Application\Entity',
				'class' => 'form-control',
				'id' => "entityNamespace",
			],
			'options' => [
				'label' => 'Namespace: ',
				'label_attributes' => [
					'class' => 'required',
				]
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Text',
			'name' => 'classname',
			'attributes' => [
				'class' => 'form-control',
				'id' => "entityClassname",
			],
			'options' => [
				'label' => 'Class name: ',
				'label_attributes' => [
					'class' => 'required',
				],
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Text',
			'name' => 'tablename',
			'attributes' => [
				'class' => 'form-control',
				'id' => "entityTablename",
			],
			'options' => [
				'label' => 'Table name: ',
				'label_attributes' => [
					'class' => 'required',
				],
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Text',
			'name' => 'repositoryclass',
			'attributes' => [
				'class' => 'form-control',
				'id' => "entityRepoClass",
			],
			'options' => [
				'label' => 'Repository FQCN: ',
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Select',
			'name' => 'driver',
			'attributes' => [
				'class' => 'form-control text-center',
				'id' =>'driver',
			],
			'options' => [
				'label' => 'Driver: ',
				'value_options' => [
					'pdo_mysql' => 'pdo_mysql',
					'drizzle_pdo_mysql' => 'drizzle_pdo_mysql',
					'mysqli' => 'mysqli',
					'pdo_sqlite' => 'pdo_sqlite',
					'pdo_pgsql' => 'pdo_pgsql',
					'pdo_oci' => 'pdo_oci',
					'pdo_sqlsrv' => 'pdo_sqlsrv',
					'sqlsrv' => 'sqlsrv',
					'oci8' => 'oci8',
					'sqlanywhere' => 'sqlanywhere',
				]
			],
		]);
        $this->add([
            'type' => 'Zend\Form\Element\Text',
            'name' => 'entityFilesNamespace',
            'attributes' => [
                'class' => 'form-control text-center',
                'id' =>'entityFilesNamespace',
                'value' => 'Application\Entity',
            ],
            'options' => [
                'label' => 'Entity files namespace: ',
            ],
        ]);
		$this->add([
			'type' => 'Zend\Form\Element\Text',
			'name' => 'dbname',
			'attributes' => [
				'class' => 'form-control text-center',
                'id' =>'dbname',
			],
			'options' => [
				'label' => 'DB name: ',
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Text',
			'name' => 'user',
			'attributes' => [
				'class' => 'form-control text-center',
                'autocomplete' => false,
                'id' => 'user',
			],
			'options' => [
				'label' => 'User: ',
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Password',
			'name' => 'password',
			'attributes' => [
				'class' => 'form-control text-center',
                'autocomplete' => "off",
                'id' => 'password',
            ],
			'options' => [
				'label' => 'Password: ',
			],
		]);
        $this->add([
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'indexes',
            'options' => [
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => [
                    'type' => 'DEC\Form\IndexFieldset',
                ],
            ],
        ]);
		$this->add([
			'type' => 'Zend\Form\Element\Collection',
            'name' => 'entityProperties',
            'options' => [
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => [
	                'type' => 'DEC\Form\PropertyFieldset',
                ],
            ],
        ]);
		$this->add([
			'name' => 'submit',
			'attributes' => [
				'type' => 'submit',
				'value' => 'Show Code',
				'class' => 'btn btn-lg btn-primary',
				'id' => 'getEntityString',
			],
		]);
		$this->setAllInputFilters();
	}

	public function setInputFilter(InputFilterInterface $inputFilter) {
		parent::setInputFilter($inputFilter);
	}

    public function getInputFilter()
    {
        return $this->filter;
    }

	public function createBaseInputFilter() {
        $inputFilter = new InputFilter();
        $factory = new InputFactory();

        $inputFilter->add($factory->createInput([
            'name' => 'namespace',
            'required' => true,
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
            'name' => 'classname',
            'required' => true,
            'validators' => [
                [
                    'name' => 'NotEmpty',
                ],
            ],
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
            'name' => 'tablename',
            'required' => true,
            'validators' => [
                [
                    'name' => 'NotEmpty',
                ],
            ],
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
            'name' => 'repositoryclass',
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
			'name' => 'driver',
			'required' => false,
			'filters' => [
				[
					'name' => 'StringTrim',
				],
				[
					'name' => 'StripTags',
				]
			]
		]));
        $inputFilter->add($factory->createInput([
            'name' => 'entityFilesNamespace',
            'required' => false,
            'filters' => [
                [
                    'name' => 'StringTrim',
                ],
                [
                    'name' => 'StripTags',
                ]
            ]
        ]));
        $inputFilter->add($factory->createInput([
            'name' => 'dbname',
            'required' => false,
            'filters' => [
                [
                    'name' => 'StringTrim',
                ],
                [
                    'name' => 'StripTags',
                ]
            ]
        ]));
        $inputFilter->add($factory->createInput([
            'name' => 'user',
            'required' => false,
            'filters' => [
                [
                    'name' => 'StringTrim',
                ],
                [
                    'name' => 'StripTags',
                ]
            ]
        ]));
        $inputFilter->add($factory->createInput([
            'name' => 'password',
            'required' => false,
            'filters' => [
                [
                    'name' => 'StringTrim',
                ],
                [
                    'name' => 'StripTags',
                ]
            ]
        ]));
        return $inputFilter;
	}

	private function setAllInputFilters() {
		$finalInputFilter = $this->createBaseInputFilter();
		//set filters for entityProperties collection
		$propertyFieldset = new PropertyFieldset();
		$propertiesFilter = new CollectionInputFilter();
		$propertiesFilter->setInputFilter($propertyFieldset->getInputFilter());
		$finalInputFilter->add($propertiesFilter, 'entityProperties');
		//set filters for indexes collection
		$indexFieldset = new IndexFieldset();
		$indexesFilter = new CollectionInputFilter();
		$indexesFilter->setInputFilter($indexFieldset->getInputFilter());
		$finalInputFilter->add($indexesFilter, 'indexes');
		//set the completed input filter as the form's filter
		$this->setInputFilter($finalInputFilter);
	}

    public function getFilterForDbFields() {
        $inputFilter = new InputFilter();
        $inputFilter->add($this->getInputFilter()->get('driver')->setRequired(true));
        $inputFilter->add($this->getInputFilter()->get('entityFilesNamespace')->setRequired(true));
        $inputFilter->add($this->getInputFilter()->get('dbname')->setRequired(true));
        $inputFilter->add($this->getInputFilter()->get('user')->setRequired(true));
        $inputFilter->add($this->getInputFilter()->get('password')->setRequired(true));
        return $inputFilter;
    }

}