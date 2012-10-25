<?php
class Email extends AppModel {
	public $name = "Email";
	
	public $validate = array(
		'address' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Alamat email pegawai harus diberikan',
				'required' => true
			),
			'email' => array (
				'rule' => 'email',
				'message' => 'Alamat email pegawai yang Anda berikan tidak valid',
				'required' => true
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Alamat email pegawai yang Anda berikan sudah digunakan/terdaftar',
				'required' => true
			)
		)
	);
}