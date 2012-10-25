<?php
class Phone extends AppModel {
	const UNKNOWN_TYPE = 0;
	const HOME_TYPE = 1;
	const MOBILE_TYPE = 2;
	const OFFICE_TYPE = 3;
	
	public $name = "Phone";
	public $belongsTo = array(
		'PhoneOwner' => array(
			'className' => 'Employee',
			'foreignKey' => 'employee_nip'	
		)
	);
	
	public $validate = array(
		'phone_number' => array(
			'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => false	
		),
		'phone_type' => array(
			'rule' => 'decimal',
			'allowEmpty' => false
		)
	);
}