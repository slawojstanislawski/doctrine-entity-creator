<?php
namespace DEC\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class PropertyFieldset extends Fieldset {

	public function __construct() {
		parent::__construct('propertyFieldset');
		$this->setLabel('Entity Property');
		$this->setAttribute('class', 'entityPropertyFieldset');

		$this->add([
			'type' => 'Zend\Form\Element\Text',
			'name' => 'propertyName',
			'attributes' => [
				'class' => 'form-control propertyName',
			],
			'options' => [
				'label' => 'Property name: ',
				'label_attributes' => [
					'class' => 'required',
				],
			],
		]);
        $this->add([
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'primary',
            'attributes' => [
                'class' => 'form-control primary primaryCheckbox',
            ],
            'options' => [
                'label' => 'Primary: ',
            ],
        ]);
		$this->add([
			'type' => 'Zend\Form\Element\Select',
			'name' => 'strategy',
			'attributes' => [
				'class' => 'form-control strategy',
			],
			'options' => [
				'label' => 'Strategy: ',
				"value_options" => [
					'AUTO' => 'AUTO',
					'SEQUENCE' => 'SEQUENCE',
					'IDENTITY' => 'IDENTITY',
					'TABLE' => 'TABLE',
					'NONE' => 'NONE',
				],
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Text',
			'name' => 'column',
			'attributes' => [
				'placeholder' => '--Defaults to Property name--',
				'class' => 'form-control column'
			],
			'options' => [
				'label' => 'Column: ',
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Select',
			'name' => 'columnType',
			'attributes' => [
				'class' => 'form-control columnType',
			],
			'options' => [
				'label' => 'Col. type: ',
				"value_options" => [
					'string' => 'string',
					'integer' => 'integer',
					'smallint' => 'smallint',
					'bigint' => 'bigint',
					'boolean' => 'boolean',
					'decimal' => 'decimal',
					'date' => 'date',
					'time' => 'time',
					'datetime' => 'datetime',
					'text' => 'text',
					'object' => 'object',
					'array' => 'array',
					'float' => 'float'
				],
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Checkbox',
			'name' => 'nullable',
			'attributes' => [
				'class' => 'form-control nullable'
			],
			'options' => [
				'label' => 'Nullable: ',
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Text',
			'name' => 'default',
			'attributes' => [
				'class' => 'form-control default'
			],
			'options' => [
				'label' => 'Default: ',
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Checkbox',
			'name' => 'unique',
			'attributes' => [
				'class' => 'form-control unique'
			],
			'options' => [
				'label' => 'Unique: ',
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Checkbox',
			'name' => 'unsigned',
			'attributes' => [
				'class' => 'form-control unsigned'
			],
			'options' => [
				'label' => 'Unsigned: ',
			],
		]);
		$this->add([
			'type' => 'Zend\Form\Element\Select',
			'name' => 'association',
			'attributes' => [
				'class' => 'form-control associationSelect',
			],
			'options' => [
				'label' => 'Association: ',
				'value_options' => [
					0 => "",
					1 => "OneToOne UniDirectional",
					2 => "OneToOne BiDirectional (inverse)",
					3 => "OneToOne BiDirectional (owning)",
					4 => "OneToMany UniDirectional",
					5 => "OneToMany BiDirectional (inverse)",
					6 => "ManyToOne BiDirectional (owning)",
					7 => "ManyToOne UniDirectional",
					8 => "ManyToMany UniDirectional",
					9 => "ManyToMany BiDirectional (inverse)",
					10 => "ManyToMany BiDirectional (owning)",
					11 => "OneToOne SelfReferencing",
					12 => "OneToMany SelfRef. (inverse)",
					13 => "ManyToOne SelfRef. (owning)",
					14 => "ManyToMany SelfRef."
				],
			],
		]);
	}

	protected $inputFilter;

	public function getInputFilter() {
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory = new InputFactory();

			$inputFilter->add($factory->createInput([
				'name' => 'propertyName',
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
				'name' => 'primary',
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
				'name' => 'strategy',
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
				'name' => 'column',
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
				'name' => 'columnType',
				'required' => false,
				'filters' => [
					[
						'name' => 'StripTags',
					],
				],
			]));
			$inputFilter->add($factory->createInput([
				'name' => 'nullable',
				'required' => false,
				'filters' => [
					[
						'name' => 'StripTags',
					],
				],
			]));
			$inputFilter->add($factory->createInput([
				'name' => 'default',
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
				'name' => 'unique',
				'required' => false,
				'filters' => [
					[
						'name' => 'StripTags',
					],
				],
			]));
			$inputFilter->add($factory->createInput([
				'name' => 'unsigned',
				'required' => false,
				'filters' => [
					[
						'name' => 'StripTags',
					],
				],
			]));
			$inputFilter->add($factory->createInput([
				'name' => 'association',
				'required' => false,
				'filters' => [
					[
						'name' => 'StripTags',
					],
				],
			]));
			$inputFilter->add($factory->createInput([
				'name' => 'targetEntity',
				'required' => false,
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
				'name' => 'cascade',
				'required' => false,
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
				'name' => 'map',
				'required' => false,
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
				'name' => 'inverse',
				'required' => false,
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
				'name' => 'indexBy',
				'required' => false,
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
				'name' => 'joinColumn1',
				'required' => false,
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
				'name' => 'refColumn1',
				'required' => false,
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
				'name' => 'joinColumn2',
				'required' => false,
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
				'name' => 'refColumn2',
				'required' => false,
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
				'name' => 'joinTable',
				'required' => false,
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
			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}

}