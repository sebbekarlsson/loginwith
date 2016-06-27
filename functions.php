<?php

function get_new_salt($length=200) {
    $salt = '';
    $str = 'abcdefghijklmnopqrstuvwxyz{}<>$';
    for($i = 0; $i < $length; $i++) {
        $salt .= $str[rand(0, strlen($str)-1)];
    }

    return $salt;
}


function register_user($email, $nickname, $firstname, $lastname, $password) {
    $password_salt = get_new_salt();

    $user = new User();
    $user->email = $email;
    $user->nickname = $nickname;
    $user->firstname = $firstname;
    $user->lastname = $lastname;
    $user->password = crypt($password, $password_salt);
    $user->password_salt = $password_salt;

    return $user->update();
}

function login($user, $input_password) {
    if (empty($user->id)) {
        return false;
    }

    if (
        hash_equals(
            $user->password,
            crypt($input_password, $user->password)
        )
    ) {
        return true;
    }
}
