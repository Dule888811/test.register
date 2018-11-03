<?php
include_once 'core/init.php';
if(isset($_POST['email'], $_POST['password'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if(!empty($email) && !empty($password)){
        $pdo = Connect::getInstance();
        $stmtUserCheck = $pdo->prepare("SELECT * FROM search.users WHERE email=? AND password=?");
        $stmtUserCheck->bindValue(1,$email);
        $stmtUserCheck->bindValue(2,$password);
        $stmtUserCheck->execute();
        if($stmtUserCheck->rowCount() == 0){
            echo "Nepoznat korisnik";
        }else {
            $user = $stmtUserCheck->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $user[0]['user_id'];
            $_SESSION['name'] = $user[0]['name'];
            $_SESSION['email'] = $user[0]['email'];
            $_SESSION['email'] = $user[0]['email'];
            header ('Location: index.php');
        }
    }else {
        echo "Morate uneti potrebne podatke";
    }
}
