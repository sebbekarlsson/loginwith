<?php

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
    $user = new User();
    $user->email = $email;
    $user->nickname = $nickname;
    $user->firstname = $firstname;
    $user->lastname = $lastname;
    $user->password = crypt($password);

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
