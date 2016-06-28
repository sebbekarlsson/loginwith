# LoginWith
> Sample Login System using PHP

### Why?
> I just felt like I needed some more PHP code on this account.

### Config
> To use this, you need a config.json file next to the load.php file.
> Below is an example of a config.json file:

        {
            "mysql_host": "localhost",
            "mysql_dbname": "loginwith",
            "mysql_username": "johndoe",
            "mysql_password": "strongpassyo"
        }

### Example
        
        /* Including the required files */
        require_once 'LoginWith/load.php';

        /* If successful, it will return the id of the new user. */
        $register = register_user(
            "john.doe@doedoe.com", //email
            "johndoe", //nickname
            "john", //firstname
            "doe", //lastname
            "strongpassword123" //password
        );

        /* Returns true on success and false on failure. */
        $login = login(get_user_by_nickname('johndoe'), 'strongpassword123');

        /* Forgot something in the fridge, logging out... brb */
        logout();
