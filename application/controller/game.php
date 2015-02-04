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
		$this->model = $this->loadModel('game');

        $location = $this->model->checkLocation($id);

        $latlng = array("lat" => $location->latitude, "lng" => $location->longitude);
        
        echo json_encode($latlng);
	}

	public function score($id, $distance){
		$this->model = $this->loadModel('game');

		$this->model->insertScore($id, $distance,  $_SESSION['user_id']);

		$this->view->render('game/score');	
	}
}
