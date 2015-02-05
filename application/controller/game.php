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


        if (!$this->model->getYourScore($id, Session::get('user_id'))) {
            $this->model->insertScore($id, $distance, Session::get('user_id'));
        }

		header('location: ' . URL . 'game/highscores/' . $id);
	}

	public function highscores($id){
		$this->model = $this->loadModel('game');

		$this->view->scorePhoto = $this->model->getPhoto($id);

		$this->view->userScore = $this->model->getYourScore($id, Session::get('user_id'));

		$this->view->game = $this->model->getScores($id);

		$this->view->render('game/score');	
	}
}

