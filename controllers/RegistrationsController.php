<?php

require_once '../models/Registrations.php';

class RegistrationsController
{
    public function create_registration($request)
    {
        if($request['image'] && !isset($request['consent'])) {
            return ['status'=> false, 'message'=> "Bad request!"];
        }

        if(isset($request['email']) && $request['email'] && isset($request['name']) && $request['name']) {
            $registration = new Registrations();
            return $registration->create_registration($request);
        }

        return ['status'=> false, 'message'=> "Bad request!"];

    }

}
