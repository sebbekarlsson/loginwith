<?php

class User {
    var $id;
    var $email;
    var $nickname;
    var $password;
    var $firstname;
    var $lastname;

    function __construct($id=null) {
        global $db;

        $this->id = id;

        if ($id != null) {
            $q = $db->prepare('
                SELECT * FROM `users` WHERE `id`=? 
            ');
            $q->execute($id);
            $row = $q->fetch();

            $this->email = $row['email'];
            $this->nickname = $row['nickname'];
            $this->password = $row['password'];
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
        }
    }


    function update() {
        global $db;

        if ($this->id == null) {
            /* The current user-object does not exist, so we will
             * insert it / create a new one of it in the database.
             */

            $q = $db->prepare('
                INSERT INTO `users`
                (
                `email`,
                `nickname`,
                `password`,
                `firstname`,
                `lastname`
                )
                VALUES
                (?, ?, ? ,? ,?)
            ');
            $resp = $q->execute(
                [
                    $this->email,
                    $this->nickname,
                    $this->password,
                    $this->firstname,
                    $this->lastname
                ]
            );

            return $resp;
        } else {
            /* The current user-object already exists, so we will
             * only update it.
             */

            $q = $db->prepare('
                UPDATE `users`
                SET
                `email`=?,
                `nickname`=?,
                `password`=?,
                `firstname`=?,
                `lastname`=?
                WHERE `id`=?
            ');
            $resp = $q->execute(
                [
                    $this->email,
                    $this->nickname,
                    $this->password,
                    $this->firstname,
                    $this->lastname,
                    $this->id
                ]
            );

            return $resp; 
        }
    }
}
