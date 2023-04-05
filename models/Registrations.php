<?php

require_once '../config/Database.php';

class Registrations
{

    public function show_registrations($data)
    {

        $database = new Database();
        $conn = $database->getConnection();
        $email = isset($data['email']) ? $data['email'] : '';
        $name = isset($data['name']) ? $data['name'] : '';

        $query = "";
        if ($email && $name) {
            $query = " WHERE email LIKE '%$email%' AND name LIKE '%$name%'";
        } elseif ($email) {
            $query = " WHERE email LIKE '%$email%'";
        } elseif ($name) {
            $query = " WHERE name LIKE '%$name%'";
        }

        $stmt = $conn->prepare("SELECT * FROM registrations". $query);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create_registrations($data)
    {

        $database = new Database();
        $conn = $database->getConnection();

        try {
            $stmt = $conn->prepare("
                INSERT INTO registrations
                    (email, name, consent, image) 
                VALUES 
                    ('{$data['email']}', '{$data['name']}', '{$data['consent']}', '{$data['image']}')
              ");
            $stmt->execute();
            return [
                'status' => true,
                'message' => 'Data was created successfully!'
            ];
        } catch (Exception $exception) {
            return [
                'status' => false,
                'message' => 'Database error!',
                'exception' => $exception
            ];
        }
    }

}