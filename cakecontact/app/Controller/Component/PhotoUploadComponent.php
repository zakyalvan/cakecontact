<?php
App::uses('Component', 'Controller');
class PhotoUploadComponent extends Component {
	const NO_FIELD_SUPPLIED_ERROR = 100;
	const INVALID_FIELD_SUPPLIED_ERROR = 101;
	const UPLOAD_PROCESS_ERROR = 102;
	
	/**
	 * @var AppController
	 */
	private $_controller;
	
	/**
	 * Error status, true if error occured on last upload handling.
	 *
	 * @var boolean
	 */
	private $_errorOccured = false;
	private $_errorCode;
	private $_errorMessage;
	
	public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings);
		$this->_controller = $collection->getController();
	}
	
	public function handle($fields = array()) {
		$this->_errorOccured = false;
	
		if(!(count($fields) > 0)) {
			$this->_errorOccured = true;
			$this->_errorCode = self::NO_FIELD_SUPPLIED_ERROR;
		}
		$request = $this->_controller->request;
		
		$result = array();
		foreach ($fields as $field) {
			$uploadedInfo = $request->data[$field];
			if(array_key_exists('name', $uploadedInfo)) {
				// Ini berarti single file.
				if(!($result[$field] = $this->_processSingleFile($uploadedInfo))) {
					$this->_errorOccured = true;
					$this->_errorCode = self::UPLOAD_PROCESS_ERROR;
					$this->_errorMessage[$field] = "Terjadi kesalahan dalam proses upload file";
				}
			}
			else {
				// Ini berarti multiple file.
				foreach ($uploadedInfo as $key => $uploaded) {
					if(!($result[$field][$key] = $this->_processSingleFile($uploaded))) {
						$this->_errorOccured = true;
						$this->_errorCode = self::UPLOAD_PROCESS_ERROR;
						$this->_errorMessage[$field] = "Terjadi kesalahan dalam proses upload file";
					}
				}
			}
		}
		return $result;
	}
	protected function _processSingleFile($uploadedInfo) {
		if($uploadedInfo['error'] != UPLOAD_ERR_OK) {
			return false;
		}
		
		// Simpan filenya di storage_directory.
		move_uploaded_file($uploadedInfo['tmp_name'], $this->settings['storage_directory'] . DS . $uploadedInfo["name"]);
		
		$result = array();
		$result['file_name'] = $uploadedInfo["name"];
		$result['file_type'] = $uploadedInfo["type"];
		$result['file_size'] = $uploadedInfo["size"];
		return $result;
	}
	/**
	 * Ask whether error occured on last upload handling.
	 *
	 * @return boolean
	 */
	public function isErrorOccured() {
		return $this->_errorOccured;
	}
	/**
	 * Retrieve last error code.
	 */
	public function getErrorCode() {
		if($this->_errorOccured) {
			return $this->_errorCode;
		}
		return null;
	}
	/**
	 * Retrieve last error message.
	 */
	public function getErrorMessage() {
		if($this->_errorOccured) {
			return $this->_errorMessage;
		}
		return null;
	}
}