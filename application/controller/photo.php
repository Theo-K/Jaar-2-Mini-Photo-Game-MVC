<?php

    class Photo extends Controller
    {
        /**
         * PAGE: index
         * This method handles what happens when you move to http://yourproject/songs/index
         */
        public function index()
        {
            // create a songs model to perform the methods.
            $this->model = $this->loadModel('photo');

            $this->view->photo = $this->model->getAllPhotos();

            // getting all blog entries
            $this->view->render('photo/index');
        }

        public function upload(){
            $this->model = $this->loadModel('photo');
            $this->view->render('photo/upload');
        }

        public function upload_action(){
            $this->model = $this->loadModel('photo');

            if (isset($_POST["submit"])) {
                $this->model->upload();
            }

            header('location: ' . URL . 'photo/upload');
        }
    }

?>