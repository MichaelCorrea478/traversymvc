<?php 

/*
* Base Controller
* Loads the models and views
*/

class Controller {

    // Load Model
    public function model($model) {
        // Require Model file
        require_once('../app/models/' . $model . '.php');

        // Instantiate the model
        return new $model();

    }

    // Load View
    public function view($view, $data = []) {
        // Check for the view file
        if (file_exists('../app/views/' . $view . '.php')) {

            require_once('../app/views/includes/header.php');
            require_once('../app/views/includes/navbar.php');
            require_once('../app/views/' . $view . '.php');
            require_once('../app/views/includes/footer.php');

        } else {
            // View does not exist
            die('This view does not exist');

        }

    }

}










?>