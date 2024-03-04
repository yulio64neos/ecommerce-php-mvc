<?php

require_once __DIR__ .'/../models/pedido.php';

class pedidoController{
    public function hacer(){
        require_once __DIR__.'/../views/pedido/hacer.php';
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            //Se rescata el id del usuario
            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            //Comprobar si los datos dan TRUE
            if($provincia && $localidad && $direccion){
                //Guardar datos en la base de datos
                $pedido = new Pedido();
                $pedido->set_usuario_id($usuario_id);
                $pedido->set_provincia($provincia);
                $pedido->set_localidad($localidad);
                $pedido->set_direccion($direccion);
                $pedido->set_coste($coste);

                $save = $pedido->save();

                //Guardar linea pedido
                $save_linea = $pedido->save_linea();
                if($save && $save_linea){
                    $_SESSION['pedido'] = 'complete';
                } else {
                    $_SESSION['pedido'] = 'failed';
                }
            } else {
                $_SESSION['pedido'] = 'failed';
            }
        } else {
            //Redirigir al index
            header("Location:".base_url);
            
        }
        header("Location:".base_url.'pedido/confirmado');
    }

    public function confirmado(){

        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->set_usuario_id($identity->id);

            $pedido = $pedido->getOneByUser();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductsByPedido($pedido->id);
        }
        require_once __DIR__ .'/../views/pedido/confirmado.php';
    }

    public function mis_pedidos(){
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();

        //Sacar los pedidos del usuario
        $pedido->set_usuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();
        // var_dump($pedidos);
        // die();
        require_once __DIR__ .'/../views/pedido/mis_pedidos.php';
    }

    public function detalle(){
        Utils::isIdentity();

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //Sacar el pedido

            $pedido = new Pedido();
            $pedido->set_id($id);
            $pedido = $pedido->getOne();

            //Sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductsByPedido($id);


            require_once __DIR__ .'/../views/pedido/detalle.php';
        } else {
            header('Location:'.base_url.'pedido/mis_pedidos');
        }

    }

    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();

        require_once __DIR__ .'/../views/pedido/mis_pedidos.php';
    }

    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            //Recoger datos del formulario
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            //Update del pedido
            $pedido = new Pedido();
            $pedido->set_id($id);
            $pedido->set_estado($estado);
            $pedido->edit();
            header('Location:'.base_url.'pedido/detalle&id='.$id);
        } else {
            header('Location:'.base_url);
        }
    }
}//Fin de la clase
?>