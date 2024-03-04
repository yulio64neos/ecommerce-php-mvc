<?php

class Pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    
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
    
    public function get_usuario_id(){
        return $this->usuario_id;
    }

    public function set_usuario_id($id_usuario){
        $this->usuario_id = $id_usuario;
    }

    public function get_provincia(){
        return $this->provincia;
    }

    public function set_provincia($provincia){
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    public function get_localidad(){
        return $this->localidad;
    }

    public function set_localidad($localidad){
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    public function get_direccion(){
        return $this->direccion;
    }

    public function set_direccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function get_coste(){
        return $this->coste;
    }

    public function set_coste($coste){
        $this->coste = $coste;
    }

    public function get_estado(){
        return $this->estado;
    }

    public function set_estado($estado){
        $this->estado = $estado;
    }

    public function get_fecha(){
        return $this->fecha;
    }

    public function set_fecha($fecha){
        $this->fecha = $fecha;
    }

    public function get_hora(){
        return $this->hora;
    }

    public function set_hora($hora){
        $this->hora = $hora;
    }

    public function getAll(){
        $pedidos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $pedidos;
    }

    public function getOne(){
        $pedidos = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->get_id()}");
        return $pedidos->fetch_object();
    }

    public function getOneByUser(){
        $sql = "SELECT p.id, p.coste FROM pedidos p "
                //."INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
               ."WHERE p.usuario_id = {$this->get_usuario_id()} ORDER BY id DESC LIMIT 1;";
        $pedidos = $this->db->query($sql);
        return $pedidos->fetch_object();
    }

    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p "
               ."WHERE p.usuario_id = {$this->get_usuario_id()} ORDER BY id DESC;";
        $pedidos = $this->db->query($sql);
        return $pedidos;
    }

    public function getProductsByPedido($id){
        // $sql = "SELECT * FROM productos WHERE id IN "
        // ."(SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id});";

        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
              ."INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
              ."WHERE lp.pedido_id = {$id}";


        $productos = $this->db->query($sql);
        return $productos;
    }

    public function save(){
        $sql = "INSERT INTO pedidos VALUES(NULL, {$this->get_usuario_id()}, '{$this->get_provincia()}', '{$this->get_localidad()}', '{$this->get_direccion()}', {$this->get_coste()}, 'confirm', CURDATE(), CURTIME());";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido'";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach($_SESSION['carrito'] as $elemento){
            $producto = $elemento['producto'];

            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id}, {$elemento['unidades']});";
            $save = $this->db->query($insert);
        }

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function edit(){
        $sql = "UPDATE pedidos SET estado = '{$this->get_estado()}' ";
        $sql .= "WHERE id = '{$this->get_id()}';";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }
}
?>