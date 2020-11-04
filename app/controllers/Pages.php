<?php

class Pages extends Controller {

    public function __construct() {

        $this->postModel = $this->model('Post');

    }

    public function index() {

        $data = [
            'title' => 'SharePosts',
            'description' => 'Simple Social Network built on the Traversy MVC PHP Framework'
        ];

        
        $this->view('pages/index', $data);

    }

    public function about($id) {

        $data = [
            'title' => 'About Page',
            'description' => 'App to share posts with other users'
        ];

        $this->view('pages/about', $data);

    }

}








?>