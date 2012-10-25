<?php
class Employee extends AppModel {
	public $name = "Employee";
	public $primaryKey = "nip";
	public $hasOne = array(
		'Email' => array(
			'className' => 'Email',
			'foreignKey' => 'employee_nip',
			'dependent' => true
		),
		'PrimaryAddress' => array(
			'className' => 'Address',
			'foreignKey' => 'employee_nip',
			'condition' => array('Address.is_primary' => true)
		),
		'PrimaryPhone' => array(
			'className' => 'Phone',
			'foreignKey' => 'employee_nip',
			'condition' => array('Phone.is_primary' => true)
		),
		'ProfilePhoto' => array(
			'className' => 'Photo',
			'foreignKey' => 'employee_nip',
			'condition' => array('Photo.is_profile' => true)
		)
	);
	public $hasMany = array(
		'Addresses' => array(
			'className' => 'Address',
			'foreignKey' => 'employee_nip'
		),
		'Phones' => array(
			'className' => 'Phone',
			'foreignKey' => 'employee_nip'
		),
		'Photos' => array(
			'className' => 'Photo',
			'foreignKey' => 'employee_nip'
		)
	);
	public $validate = array(
		'nip' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'NIP pegawai harus diberikan',
				'required' => true
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => 'Nip pegawai harus diisi dengan karakter alpha-numerik',
				'required' => true
			),
			// Ini pake custom validator method. Sebenarnya untuk unique field bisa pake validator 'isUnique'
			'isNotRegisteredNip' => array(
				'rule' => 'isNotRegisteredNip',
				'message' => 'NIP pegawai yang diberikan sudah digunakan.',
				'required' => true
			)
		),
		'first_name' => array(
			'rule' => 'alphaNumeric',
			'required' => true,
			'allowEmpty' => false	
		),
		'middle_name' => array(
			'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => true
		),
		'last_name' => array(
			'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => true
		),
		'birth_place' => array(
			'rule' => 'alphaNumeric',
			'message' => 'Tempat lahir harus diberikan',
			'required' => true,
			'allowEmpty' => false
		),
		'birth_date' => array(
			'rule' => array('date', 'ymd'),
			'message' => 'Tanggal lahir harus diberikan',
			'required' => true,
			'allowEmpty' => false
		),
		'sex' => array(
			'rule' => 'alphaNumeric',
			'required' => true,
			'allowEmpty' => false
		)
	);
	
	public function isNotRegisteredNip($nip) {
		return !($this->exists($nip));
	}
}