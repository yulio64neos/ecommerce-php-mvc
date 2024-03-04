<?php
require_once __DIR__.'/../models/producto.php';
class carritoController{
    public function index(){
        
        if(isset($_SESSION['carrito'])){
            $carrito = $_SESSION['carrito'];
        } else {
            $carrito = array();
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

    public function delete(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header("Location:".base_url."carrito/index");
    }

    public function up(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        header("Location:".base_url."carrito/index");
    }

    public function down(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            if($_SESSION['carrito'][$index]['unidades'] <= 0){
                unset($_SESSION['carrito'][$index]);
            }
        }
        header("Location:".base_url."carrito/index");
    }

    public function delete_all(){
        unset($_SESSION['carrito']);
        header("Location:".base_url."carrito/index");
    }

}//Fin de la clase
?>