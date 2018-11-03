<?php

include_once 'core/init.php';
$errors[] = "";
    $required_fields = array('password','passwordA','name','email');
    foreach($required_fields as $field){
        if(!isset($_POST[$field]) || empty(trim($_POST[$field]))){
            switch($field){
                case 'password': $f = 'password'; break;
                case 'passwordA': $f = 'password again'; break;
                case 'name': $f = 'name'; break;
                case 'email': $f = 'E-mail'; break;
            }
            $errors[] = 'Polje <b>' . $f . '</b> mora biti upisano.';
            $hasErrors = true;
        }else{
            $field = trim($_POST[$field]);
        }
    }

$name = $_POST['name'];
$password = $_POST['password'];
$passwordA = $_POST['passwordA'];
$email = $_POST['email'];

    if(isset($name)){

        if(strlen($name) < 3) {
            $errors[] = 'Prezime mora imati najmanje 3 karaktera.';
            $hasErrors = true;
        }
        if(!ctype_alpha($name)) {
            $errors[] = 'Prezime mora sadržati samo slova.';
            $hasErrors = true;
        }
    }
if(isset($email)){
    if(User:: email_exists($email)){
        $errors[] = 'Već postoji korisnik sa ovom E-mail adresom.';
        $hasErrors = true;
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Unesite validnu E-mail adresu.';
        $hasErrors = true;
    }
}
    if(isset($password) && isset($passwordA)){
        if(strlen($password) < 3) {
            $errors[] = 'Lozinka mora imati najmanje 6 karaktera.';
            $hasErrors = true;
        }
        if($password !== $passwordA) {
            $errors[] = 'Lozinke se ne poklapaju';
            $hasErrors = true;
        }
    }

    
 //  if($errors){
        if(User::register_new_user($name, $email, $password)){

            header('Location: index.php');
        }else{
            $errors[] = 'Došlo je do greške prilikom registracije. Obratite se tehničkoj podršci.';
     //   }
    }
if($errors){
    ?>


    <ul><li><?php echo implode('</li><li>', $errors) ?></li></ul>


    <?php
}else{
    header('Location: index.php');
};
?>
<?php
