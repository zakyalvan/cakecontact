<?php
/**
 * Controller yang handle seluruh request terkait crud dari employee.
 * 
 * @author zakyalvan
 */
class EmployeeController extends AppController {
	public $components = array('PhotoUpload' => array(
		'storage_directory' => '/home/zakyalvan/Documents/cakecontact'
	));
	
	public function index($page = 1) {
		$employees = $this->Employee->find('all');
		$this->set('employees', $employees);
		$this->set('page', $page);
		$this->set('numberOfPage', 2);
	}
	public function register() {
		if(!$this->Session->check('RegisterEmployee.Step')) {
			$this->Session->write('RegisterEmployee.Step', 1);
		}

		$createStep = $this->Session->read('RegisterEmployee.Step');
		$this->set('createStep', $createStep);
		
		if($this->request->is('post')) {
			$errorOccured = false;
			$errorFields = array();
			
			$data = array();
			if($this->Session->check('RegisterEmployee.Data')) {
				$data = array_merge($data, $this->Session->read('RegisterEmployee.Data'));
			}
			
			// Step pertama data pribadi.
			if($createStep == 1) {
				$data['Employee'] = $this->request->data;
				$this->Employee->set($data);
				if($this->Employee->validates()) {
					$errorOccured = false;
					$this->Session->write('RegisterEmployee.Data', $data);
					$this->Session->write('RegisterEmployee.Step', $createStep+1);
					$this->redirect('register', 302, true);
				}
				else {
					$errorOccured = true;
					$errorFields = array_merge($errorFields, $this->Employee->validationErrors);
					var_dump($errorFields);
					$this->set(array(
						'error_occured'	=> $errorOccured,
						'error_fields' => $errorFields
					));
				}
			}
			// Step kedua data alamat email.
			else if($createStep == 2) {
				$data['Email'] = $this->request->data;
				$this->Employee->Email->set($data['Email']);
				if($this->Employee->Email->validates()) {
					$errorOccured = false;
					$this->Session->write('RegisterEmployee.Data', $data);
					$this->Session->write('RegisterEmployee.Step', $createStep+1);
					$this->redirect('register', 302, true);
				}
				else {
					$errorOccured = true;
					$errorFields = array_merge($errorFields, $this->Employee->Email->validationErrors);
				
					$this->set(array(
						'error_occured'	=> $errorOccured,
						'error_fields' => $errorFields
					));
				}
			}
			// Data alamat utama pegawai.
			else if($createStep == 3) {
				$data['PrimaryAddress'] = $this->request->data;
				$data['PrimaryAddress']['is_primary'] = true;
				$this->Employee->PrimaryAddress->set($data['PrimaryAddress']);
				if($this->Employee->PrimaryAddress->validates()) {
					$errorOccured = false;
					$this->Session->write('RegisterEmployee.Data', $data);
					$this->Session->write('RegisterEmployee.Step', $createStep+1);
					$this->redirect('register', 302, true);
				}
				else {
					$errorOccured = true;
					$errorFields = array_merge($errorFields, $this->Employee->PrimaryAddress->validationErrors);
					var_dump($this->Employee->PrimaryAddress->validationErrors);
					$this->set(array(
						'error_occured'	=> $errorOccured,
						'error_fields' => $errorFields
					));
				}
			}
			// Data telepon utama pegawai.
			else if($createStep == 4) {
				$data['PrimaryPhone'] = $this->request->data;
				$data['PrimaryPhone']['is_primary'] = true;
				$this->Employee->PrimaryPhone->set($data['PrimaryPhone']);
				if($this->Employee->PrimaryPhone->validates()) {
					$errorOccured = false;
					$this->Session->write('RegisterEmployee.Data', $data);
					$this->Session->write('RegisterEmployee.Step', $createStep+1);
					$this->redirect('register', 302, true);
				}
				else {
					$errorOccured = true;
					$errorFields = array_merge($errorFields, $this->Employee->PrimaryPhone->validationErrors);
					
					$this->set(array(
						'error_occured'	=> $errorOccured,
						'error_fields' => $errorFields
					));
				}
			}
			// Upload foto profile pegawai.
			else if($createStep == 5) {
				$data['ProfilePhoto'] = $this->PhotoUpload->handle(array('uploaded_photo'))['uploaded_photo'];
				if(!$this->PhotoUpload->isErrorOccured()) {
					$data['ProfilePhoto']['is_profile'] = true;
					if($this->Employee->ProfilePhoto->validates()) {
						$errorOccured = false;
						$this->Session->write('RegisterEmployee.Data', $data);
						$this->Session->write('RegisterEmployee.Step', $createStep+1);
						$this->redirect('register', 302, true);
					}
					else {
						$errorOccured = true;
						$errorFields = array_merge($errorFields, $this->Employee->ProfilePhoto->validationErrors);
						
						$this->set(array(
							'error_occured'	=> $errorOccured,
							'error_fields' => $errorFields
						));
					}
				}
			}
			// Tahap konfirmasi.
			else if($createStep == 6) {
				$datas = $this->Session->read('RegisterEmployee.Data');
				$this->Employee->saveAssociated($datas, array('deep' => true, 'validate' => false));
				
				$this->Session->delete('RegisterEmployee.Data');
				$this->Session->delete('RegisterEmployee.Step');
				
				$this->redirect('index');
			}
		}
		else {
			$this->Session->write('RegisterEmployee.Step', $createStep);
			//$this->Session->delete('RegisterEmployee.Data');
			//$this->Session->delete('RegisterEmployee.Step');
		}
	}
	public function detail($nip) {
		if($nip != null && $this->Employee->exists($nip)) {
			// Retrieve employee data with supplied nip.
			
		}
	}
	public function update($nip) {
		
	}
	public function delete($nip) {
		if($nip != null && $this->Employee->exists($nip)) {
			if($this->request->is('post')) {
				$this->Employee->delete($nip);
				$this->redirect('index', 302, true);
			}
			$this->set('deletedNip', $nip);
		}
		else {
			$this->redirect('index');
		}
	}
}