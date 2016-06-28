<?php

/**
 * This function is used to generate password/hash salts.
 *
 * @param $length - Integer
 * 
 * @return String
 */
function get_new_salt($length=64) {
    $salt = '';
    $str = 'abcdefghijklmnopqrstuvwxyz{}<>$';
    for($i = 0; $i < $length; $i++) {
        $salt .= $str[rand(0, strlen($str)-1)];
    }

    return $salt;
}

/**
 * This function is used to get a user object by nickname.
 *
 * @param $nickname - String
 *
 * @return Object
 */
function get_user_by_nickname($nickname) {
    global $db;

    $q = $db->prepare('
        SELECT `id` FROM `users` WHERE `nickname`=?
    ');
    $q->execute([$nickname]);
    $row = $q->fetch();

    if (empty($row)) {
        return null;
    }

    $user = new User($row['id']);

    if ($user->id == null) {
        return null;
    }

    return $user;
}

/**
 * This function is used to register a new user.
 * Returns false if user with nickname already exists.
 *
 * @param $email - String
 * @param $nickname - String
 * @param $firstname - String
 * @param $lastname - String
 * @param $password - String
 *
 * @return Integer || Boolean
 */
function register_user($email, $nickname, $firstname, $lastname, $password) {
    if (!empty(get_user_by_nickname($nickname))) {
        return false;
    }

    $password_salt = get_new_salt();

    $user = new User();
    $user->email = $email;
    $user->nickname = $nickname;
    $user->firstname = $firstname;
    $user->lastname = $lastname;

    $options = [ 'cost' => 10, 'salt' => $password_salt];
    $time_start = microtime(true);
    $user->password = password_hash($password, PASSWORD_BCRYPT, $options);

    $user->password_salt = $password_salt;

    return $user->update();
}

/**
 * This function is used to login/validate a user using a password.
 *
 * @param $user - Object
 * @param $input_password - String
 *
 * @return Boolean
 */
function login($user, $input_password) {
    if (empty($user->id)) {
        return false;
    }

    if (
        password_verify(
            $input_password,
            $user->password
        )
    ) {
        $_SESSION['user_id'] = $user->id;
        return true;
    }

    return false;
}

/**
 * This function is used to logout.
 *
 * @return void
 */
function logout() {
    unset($_SESSION['user_id']);
}
