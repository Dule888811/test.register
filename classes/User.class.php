<?php
require_once 'core/init.php';

class User
{
    private static $_pdo;

    public static function init()
    {
        self::$_pdo = Connect::getInstance();
    }

    public static function email_exists($email)
    {
        $query = self::$_pdo->prepare('SELECT user_id FROM search.users WHERE email = :email');
        $query->bindParam(':email', $email);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function search($criteria)
    {
        if (isset($_SESSION['name'])) {
            if (isset($criteria)) {
                if (!empty($criteria)) {
                    $criteria = trim($criteria);
                    $result = self::$_pdo->prepare("SELECT * FROM search.users WHERE name LIKE ? OR email LIKE ?");
                    $result->bindValue(1, "%$criteria%");
                    $result->bindValue(2, "%$criteria%");
                    $result->execute();
                    if ($result->rowCount() > 0) {
                     $users = $result->fetchAll(PDO::FETCH_ASSOC);
                       return $users;
                    } else {
                        echo 'No results.';
                    }
                } else {
                    echo 'Criteria is empty';
                }
            }
        }else{
            echo "Please log in";
            include_once 'loginW.php';
        }
    }



    public static function register_new_user($name, $email, $password)
    {
        $query = self::$_pdo->prepare('INSERT INTO search.users(name, email , password) VALUES (?, ?, ?)');
        $query->bindParam(1, $name);
        $query->bindParam(2, $email);
        $query->bindParam(3, $password);
        $query->execute();
        return true;
    }
}

User::init();

?>