<?php

class User {

    public function getUserData($user_type)
    {
        return [
            'name' => $user_type.' Jefkins',
            'email' => $user_type.'@'.$user_type.'.com',
            'password' => password_hash($user_type, PASSWORD_DEFAULT),
            'account_type' => $user_type
        ];
    }

}