<?php
	class WebUser extends CWebUser {
		private $_model = null;

		function getRole() {
			if($user = $this->getModel()){
				return $user->role;
			}
		}

		function getLogin() {
			if($user = $this->getModel()){
				return $user->login;
			}
		}

		private function getModel() {
			if (!$this->isGuest && $this->_model === null){
				$this->_model = Users::model()->findByPk($this->id);
			}
			return $this->_model;
		}
	}