<?php

require_once '../models/Registrations.php';

class RegistrationsController
{
    public function show_registrations() {

    }
    public function create_registration($request)
    {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];

        //Check if the uploaded file is an image
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (in_array($file_ext, $valid_extensions)) {
            $img_name = $this->resize_and_upload_img($file_name, $file_tmp);
        } else {
            return ['status' => 'false', 'message' => 'Uploaded image is not valid!'];
        }

        if ($img_name && !isset($request['consent'])) {
            return ['status' => false, 'message' => "Bad request!"];
        }
        $data = [
            'email' => isset($request['email']) ? $request['email'] : '',
            'name' => isset($request['name']) ? $request['name'] : '',
            'consent' => isset($request['consent']) ? $request['consent'] : '',
            'image' => isset($img_name) ? $img_name : '',
        ];

        if ($data['email'] && $data['name']) {
            $registration = new Registrations();
            return $registration->create_registration($data);
        }

        return ['status' => false, 'message' => "Bad request!"];

    }

    /**
     *
     * Resizes and uploads an image to the specified target file.
     * @param string $target_file The path to the file where the image should be saved.
     * @param string $original_file The path to the original image file.
     * @return string The name of the saved file.
     * @throws Exception if the image type is unknown.
     */
    private function resize_and_upload_img($target_file, $original_file)
    {
        $info = getimagesize($original_file);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                break;

            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                break;

            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                break;

            default:
                throw new Exception('Unknown image type.');
        }

        $img = $image_create_func($original_file);
        list($width, $height) = getimagesize($original_file);

        $path_parts = pathinfo($target_file);
        $file_new_name = $path_parts['filename'] . '_' . time() . '.' . $path_parts['extension'];

        if ($width > 500 || $height > 500) {
            $new_height = ($height / $width) * 500;
            $tmp = imagecreatetruecolor(500, $new_height);
            imagecopyresampled($tmp, $img, 0, 0, 0, 0, 500, $new_height, $width, $height);

            // Generate a unique filename with a timestamp
            $path_parts = pathinfo($target_file);

            $target_file = __DIR__ . '/../public/photos/registrations' . $path_parts['dirname'] . '/' . $file_new_name;

            if (file_exists($file_new_name)) {
                unlink($file_new_name);
            }
            $image_save_func($tmp, $target_file);
            return $file_new_name;
        }
        // Check if the file already exists
        if (file_exists($file_new_name)) {
            unlink($file_new_name);
        }

        // Save the image with the unique filename
        print_r($original_file);
        move_uploaded_file($original_file, __DIR__ . '/../public/photos/registrations/' . $file_new_name);
        return $file_new_name;
    }
}
