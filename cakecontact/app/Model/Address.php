<?php
class Address extends AppModel {
	public $name = "Address";
	public $belongsTo = array(
		'AddressOwner' => array(
			'className' => 'Employee',
			'foreignKey' => 'employee_nip'	
		)
	);
	
	public $validate = array(
		'street' => array(
			'rule' => 'notEmpty',
			'message' => 'Data alamat harus diberikan',
			'required' => true
		),
		'city' => array(
			'rule' => 'notEmpty',
			'message' => 'Data nama kota harus diberikan',
			'required' => true
		),
		'province' => array(
			'rule' => 'notEmpty',
			'message' => 'Data nama propinsi harus diberikan',
			'required' => true
		),
		'postal_code' => array(
			'rule' => 'numeric',
			'message' => 'Data kode pos harus diberikan',
			'required' => true
		)
	);
}