<?php

class Users extends Controller {

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Enter email';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_error'] = 'Email already registered';
            }

            // Validate name
            if (empty($data['name'])) {
                $data['name_error'] = 'Enter name';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'Enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password must have at least six characters';
            }

            // Validate confirm_password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Confirm password';
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_error'] = 'Passwords do not match';
            }

            // Make sure errors are empty
            if (empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                // Validated

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user
                if ($this->userModel->register($data)) {
                    redirect('users/login');
                } else {
                    die('Registration failed!');
                }

            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }

        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Load view
            $this->view('users/register', $data);

        }

    }

    public function login() {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Enter email';
            } 

            // Validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'Enter password';
            }

            // Make sure errors are empty
            if (empty($data['email_error']) && empty($data['password_error'])) {
                // Validated
                die('success');
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            } 


        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];

            // Load view
            $this->view('users/login', $data);

        }

    }

}






?>