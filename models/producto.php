<?php

class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;


    //Conexion a la base de datos
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function get_id(){
        return $this->id;
    }

    public function set_id($id){
        $this->id = $id;
    }

    public function get_categoriaId(){
        return $this->categoria_id;
    }

    public function set_categoriaId($categoria_id){
        $this->categoria_id = $categoria_id;
    }

    public function get_nombre(){
        return $this->nombre;
    }

    public function set_nombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function get_desc(){
        return $this->descripcion;
    }

    public function set_desc($desc){
        $this->descripcion = $this->db->real_escape_string($desc);
    }

    public function get_precio(){
        return $this->precio;
    }

    public function set_precio($precio){
        $this->precio = $this->db->real_escape_string($precio);
    }

    public function get_stock(){
        return $this->stock;
    }

    public function set_stock($stock){
        $this->stock = $this->db->real_escape_string($stock);
    }

    public function get_oferta(){
        return $this->oferta;
    }

    public function set_oferta($oferta){
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    public function get_fecha(){
        return $this->fecha;
    }

    public function set_fecha($fecha){
        $this->fecha = $fecha;
    }

    public function get_imagen(){
        return $this->imagen;
    }

    public function set_imagen($imagen){
        $this->imagen = $imagen;
    }

    public function getAll(){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $productos;
    }

    public function getAllCategory(){
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
              ."INNER JOIN categorias c ON c.id = p.categoria_id "
              ."WHERE p.categoria_id = {$this->get_categoriaId()} "
              ."ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getRandom($limit){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
        return $productos;
    }

    public function getById(){
        $producto = $this->db->query("SELECT * FROM productos WHERE id = '{$this->get_id()}'");
        return $producto->fetch_object();
    }

    public function save(){
        $sql = "INSERT INTO productos VALUES (NULL, '{$this->get_categoriaId()}', '{$this->get_nombre()}', '{$this->get_desc()}', '{$this->get_precio()}', '{$this->get_stock()}', NULL, CURDATE(), '{$this->get_imagen()}')";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function edit(){
        $sql = "UPDATE productos SET nombre = '{$this->get_nombre()}', descripcion = '{$this->get_desc()}', precio = '{$this->get_precio()}', stock = '{$this->get_stock()}', categoria_id = '{$this->get_categoriaId()}' ";
        if($this->get_imagen() != null){
            $sql .= ", imagen = '{$this->get_imagen()}' ";
        }
        $sql .= "WHERE id = '{$this->id}';";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM productos WHERE id = '{$this->id}'";
        $deleted = $this->db->query($sql);

        $result = false;
        if($deleted){
            $result = true;
        }
        return $result;
    }
}
?>