<?php

class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $img;

    //Conexión a la base de datos
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }


    public function set_id($id){
        $this->id = $id;
    }

    public function get_id(){
        return $this->id;
    }

    public function set_nombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function get_nombre(){
        return $this->nombre;
    }

    public function set_apellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    public function get_apellidos(){
        return $this->apellidos;
    }

    public function set_email($email){
        $this->email = $this->db->real_escape_string($email);
    }

    public function get_email(){
        return $this->email;
    }

    public function set_password($password){
        $this->password = $password;
    }

    public function get_password(){
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function set_rol($rol){
        $this->rol = $rol;
    }

    public function get_rol(){
        return $this->rol;
    }

    public function set_img($img){
        $this->img = $img;
    }

    public function get_img(){
        return $this->img;
    }

    public function save(){
        $sql = "INSERT INTO usuarios VALUES(null, '{$this->get_nombre()}', '{$this->get_apellidos()}', '{$this->get_email()}', '{$this->get_password()}', 'user', null);";
        $save = $this->db->query($sql);
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function verifay_email_duplicate($email){
        $sql = "SELECT email FROM usuarios WHERE email = '$email';";
        $verifay = $this->db->query($sql);
        return $verifay->num_rows > 0;
    }

    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;
        //Comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email';";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();

            //verificar la contraseña
            //Con el método password_verify se comprueba
            //la password del formulario sea la misma
            //password encriptada que está en la base de datos
            $verify = password_verify($password, $usuario->password);

            if($verify){
                $result = $usuario;
            }
        }

        return $result;
    }
}//Usuario
?>