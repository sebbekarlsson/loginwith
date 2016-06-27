<?php

/* Currently not being used.
function get_new_salt($length=200) {
    $salt = '';
    $str = 'abcdefghijklmnopqrstuvwxyz{}<>$';
    for($i = 0; $i < $length; $i++) {
        $salt .= $str[rand(0, strlen($str)-1)];
    }

    return $salt;
}
 */

/**
 * This function is used to register a new user.
 *
 * @param $email - String
 * @param $nickname - String
 * @param $firstname - String
 * @param $lastname - String
 * @param $password - String
 */
function register_user($email, $nickname, $firstname, $lastname, $password) {
    //$password_salt = get_new_salt();

    $user = new User();
    $user->email = $email;
    $user->nickname = $nickname;
    $user->firstname = $firstname;
    $user->lastname = $lastname;
    $user->password = crypt($password);
    //$user->password_salt = $password_salt;

    return $user->update();
}

/**
 * This function is used to login a user using a provided password.
 *
 * @param $user - Object
 * @param $input_password - String
 */
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
