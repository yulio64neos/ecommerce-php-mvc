<?php

class Categoria{
    //Propiedades de la clase
    private $id;
    private $nombre;

    //Conexion a la base de datos
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    //Setters and getters
    public function get_id(){
        return $this->id;
    }

    public function set_id($id){
        $this->id = $id;
    }

    public function get_nombre(){
        return $this->nombre;
    }

    public function set_nombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    //Methods
    public function getAll(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
        return $categorias;
    }

    public function getOne(){
        $categorias = $this->db->query("SELECT * FROM categorias WHERE id='{$this->get_id()}'");
        return $categorias->fetch_object();
    }

    public function getAllFor(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id ASC;");
        return $categorias;
    }

    public function save(){
        $sql = "INSERT INTO categorias VALUES(null, '{$this->nombre}')";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function editCat(){
        $sql = "UPDATE categorias SET nombre = '{$this->nombre}' WHERE id = '{$this->id}'";
        $edit = $this->db->query($sql);

        $result = false;
        if($edit){
            $result = true;
        }
        return $result;
    }

    public function deleteCat(){
        $sql = "DELETE FROM categorias WHERE id = {$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }
}
?>