<?php

require_once '../models/User.php';

class AdminController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function listUsers()
    {
        $users = $this->userModel->getAllUsers();
        // Load view and pass $users to it
    }

    public function viewUser($userId)
    {
        $user = $this->userModel->getUserById($userId);
        // Load view and pass $user to it
    }

    public function createUser($userData)
    {
        $result = $this->userModel->create($userData);
        // Check result and show appropriate message
    }

    public function updateUser($userId, $userData)
    {
        $result = $this->userModel->update($userId, $userData);
        // Check result and show appropriate message
    }

    public function deleteUser($userId)
    {
        $result = $this->userModel->delete($userId);
        // Check result and show appropriate message
    }
}