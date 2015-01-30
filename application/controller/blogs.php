<?php

/**
 * Class Blogs
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Blogs extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function index()
    {
        // create a songs model to perform the methods.
        $this->model = $this->loadModel('blogs');

        // getting all blog entries
        $this->view->blogs = $this->model->getBlogs();
        $this->view->render('blogs/index');
    }

    public function addEntry()
    {
        // create a songs model to perform the methods.
        $this->model = $this->loadModel('blogs');
        
        // if we have POST data to create a new song entry
        if (isset($_POST["submit_blog_entry"])) {
            // do addSong() in model/model.php
            $this->model->addentry($_POST["title"], $_POST["content"]);
        }

        // where to go after song has been added
        header('location: ' . URL . 'blogs/index');
    }

    public function deleteEntry($blog_id)
    {
        // create a songs model to perform the methods.
        $this->model = $this->loadModel('blogs');

        // if we have an id of a song that should be deleted
        if (isset($blog_id)) {
            // do deleteSong() in model/model.php
            $this->model->deleteEntry($blog_id);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'blogs/index');
    }

    public function editEntry($blog_id)
    {
        // create a songs model to perform the methods.
        $this->model = $this->loadModel('blogs');

        // if we have an id of a song that should be edited
        if (isset($blog_id)) {
            // do getSong() in model/model.php
           $this->view->blogs = $this->model->getBlogEntry($blog_id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $song easily
            $this->view->render('blogs/edit');
        } else {
            // redirect user to songs index page (as we don't have a song_id)
            header('location: ' . URL . 'blogs/index');
        }
    }

    public function updateEntry()
    {
        // create a songs model to perform the methods.
        $this->model = $this->loadModel('blogs');

        // if we have POST data to create a new song entry
        if (isset($_POST["submit_update_blog"])) {
            // do updateSong() from model/model.php
            $this->model->updateEntry($_POST["title"], $_POST["content"], $_POST['blog_id']);
        }

        // where to go after song has been added
        header('location: ' . URL . 'blogs/index');
    }
}