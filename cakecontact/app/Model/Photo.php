<?php
class Photo extends AppModel {
	public $name = "Photo";
	public $belongsTo = array(
		'PhotoOwner' => array(
			'className' => 'Employee',
			'foreignKey' => 'employee_nip'	
		)
	);
}