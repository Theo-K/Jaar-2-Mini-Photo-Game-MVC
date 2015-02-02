<?php

Class Game extends Controller {

	public function index() {
		$this->model = $this->loadModel('game');
		$this->view->render('game/index');
	}

	public function play($id = null) {
		$this->model = $this->loadModel('game');

		if (is_numeric($id)) {
			$this->view->game = $this->model->getPhoto($id);
		}
		elseif ($id == null) {
			$this->view->game = $this->model->getRandomPhoto($id);
		}
		else {
			header('location: ' . URL . 'photo/index');
		}

		$this->view->render('game/play');	
	}

	public function checkLocation($id){
		echo json_encode();
	}
}
