<?php
//Inicio de php
require_once __DIR__ .'/../models/usuario.php';

class UsuarioController{
    public function Index(){
        echo "Controlador Usuarios, Accion index";
    }

    public function register(){
        require_once __DIR__.'/../views/usuario/registro.php';
    }

    public function save(){
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;;
            $email = isset($_POST['email']) ? $_POST['email'] : false;;
            $password = isset($_POST['password']) ? $_POST['password'] : false;;
            if($nombre && $apellidos && $email && $password){
                //Se crea la instancia de la clase Usuario
                $usuario = new Usuario();
                //Validación del email duplicado
                $maildup = $usuario->verifay_email_duplicate($email);
                if($maildup == $email){
                    $_SESSION['register'] = "failed";
                } else {
                    $usuario->set_nombre($nombre);
                    $usuario->set_apellidos($apellidos);
                    $usuario->set_email($email);
                    $usuario->set_password($password);
                    $save = $usuario->save();
                    if($save){
                        $_SESSION['register'] = "completed";
                    } else{
                        $_SESSION['register'] = "failed";
                    }
                }

            } else {
                $_SESSION['register'] = "failed";
            }
        } else {
            $_SESSION['register'] = "failed";
        }
        header("Location:".base_url.'usuario/register');
    }

    public function login(){
        if(isset($_POST)){
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if($email && $password){
                $usuario = new Usuario();
                $usuario->set_email($_POST['email']);
                $usuario->set_password($_POST['password']);
                $identity = $usuario->login();
    
                if($identity && is_object($identity)){
                    $_SESSION['identity'] = $identity;
    
                    if($identity->rol == 'admin'){
                        $_SESSION['admin'] = true;
                        if(isset($_SESSION['carrito'])){
                            unset($_SESSION['carrito']);
                        }
                    } else {
                        $_SESSION['error_login'] = 'Identificación Faillida !!';
                    }
                }
            } else {
                $_SESSION['error_login'] = "Identificación Faillida !!";
            }
        }
        header("Location:".base_url);
    }

    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }

        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }

        header("Location:".base_url);
    }
}//Fin de la clase

//Fin de php
?>