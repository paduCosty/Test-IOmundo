<?php

require_once '../config/Database.php';

class Registrations
{

    public function create_registration($data)
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
                'exception' =>$exception
            ];
        }
    }

}