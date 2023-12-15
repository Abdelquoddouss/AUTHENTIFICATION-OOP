<?php
    include '../config/connection.php';
    include '../models/User.php';
    session_start();
    class AuthController
    {
        public function signup($name,$prenom,$age,$password){
            $objuser= new User($name,$prenom,$age,$password);
            $result = $objuser->create();
            header("location: ../views/login.php");
        }

        public function login($name,$password,){
            $obj= new User($name,null,null,$password);
            $data=$obj->getUserByUsername();
            if(empty($name)|| empty($password)){
                echo"von avez pas enregistrer le nom et prenom";
            }elseif (empty($data)) {
                echo"email not on data base";
            }else {
                if($data&&password_verify($password,$data['pasword'])){
                    $_SESSION['name'] = $name;
                    $_SESSION['prenom'] = $password;
                    header("location: ../views/index.php");
                }
            }
        }
    }

    if (isset($_POST['signup_submit'])) {
        $auth = new AuthController();
        $auth->signup($_POST["name"],$_POST["prenom"],$_POST["age"],$_POST["password"]);
    }
    

    if (isset($_POST['login_submit'])) {
        $auth = new AuthController();
        $res= $auth->login($_POST["name"],$_POST["password"]);
        // var_dump($res);
    }
?>