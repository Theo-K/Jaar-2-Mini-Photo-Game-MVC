<?php
	
	class youtube extends Controller{
		public function index()
	    {
	    	$random_str = $this->model->getVideo();

	        // load views
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/youtube/youtube.php';
	        require APP . 'view/_templates/footer.php';
	    }
	}
?>