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
            header("Location:".base_url.'pedido/confirmado');
        }
    }

    public function confirmado(){
        require_once __DIR__ .'./../views/pedido/confirmado.php';
    }
}//Fin de la clase
?>