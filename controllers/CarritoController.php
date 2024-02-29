<?php
require_once __DIR__.'/../models/producto.php';
class carritoController{
    public function index(){
        
        if(isset($_SESSION['carrito'])){
            $carrito = $_SESSION['carrito'];
        } else {
            echo "<h2>El carrito está vacio, elija un producto...</h2>";
        }
        require_once __DIR__ .'/../views/carrito/index.php';
    }

    public function add(){
        if(isset($_GET['id'])){
            $producto_id = $_GET['id'];
        } else {
            header("Location:".base_url);
        }
        if(isset($_SESSION['carrito'])){
            $counter = 0;
            foreach($_SESSION['carrito'] as $indice => $elemento){
                if($elemento['id_producto'] == $producto_id){
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter++;
                }
            }
        }
        if(!isset($counter) || $counter == 0){
            //conseguir producto
            $producto = new Producto();
            $producto->set_Id($producto_id);
            $producto = $producto->getById();
    
            //Esta es la forma de añadir el carrito sin iniciar sesión
            //Se va a comprar si el producto es objeto
            if(is_object($producto)){
                //Vamos a agregar al carrito un elemento
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }
        header("Location:".base_url.'carrito/index');
    }

    public function remove(){

    }

    public function delete(){

    }

    public function delete_all(){
        unset($_SESSION['carrito']);
        header("Location:".base_url."carrito/index");
    }

}//Fin de la clase
?>