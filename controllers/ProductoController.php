<?php
require_once __DIR__.'/../models/producto.php';
class productoController{
    public function index(){
        $producto = new Producto();
        $productos = $producto->getRandom(6);
        //var_dump($productos);

       //Renderizar vista para que sea la vista principal
       require_once __DIR__.'/../views/producto/destacados.php';
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            //Conseguir el id del producto
            $producto = new Producto();
            $producto->set_id($id);
            $pro = $producto->getById();
            // var_dump($id);
            // die();
        }
        require_once __DIR__.'/../views/producto/ver.php';
    }

    public function gestion(){
        Utils::isAdmin();

        $producto = new Producto();
        $productos = $producto->getAll();
        
        require_once __DIR__.'/../views/producto/gestion.php';
    }

    public function crear(){
        Utils::isAdmin();
        require_once __DIR__.'/../views/producto/crear.php';
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            if($nombre && $descripcion && $precio && $stock && $categoria){
                $producto = new Producto();
                $producto->set_nombre($nombre);
                $producto->set_desc($descripcion);
                $producto->set_precio($precio);
                $producto->set_stock($stock);
                $producto->set_categoriaId($categoria);

                //Guardar la imágen
                if(isset($_FILES['imagen'])){
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];
    
                    if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){
                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true);
                        }
    
                        move_uploaded_file($file['tmp_name'], "uploads/images/$filename");
                        $producto->set_imagen($filename);
                    } else {
                        $_SESSION['producto'] = "failed";
                    }
                }

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $producto->set_id($id);
                    $save = $producto->edit();
                } else {
                    $save = $producto->save();
                }
                if($save){
                    $_SESSION['producto'] = "complete";
                } else {
                    $_SESSION['producto'] = "failed";
                }
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "false";
        }
        header('Location:'.base_url.'producto/gestion');
    }

    public function edit(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $editar = true;
            $producto = new Producto();
            $producto->set_id($id);

            $pro = $producto->getById();
            require_once __DIR__.'/../views/producto/crear.php';
        } else {
            header("Location:".base_url.'producto/gestion');
        }
    }

    public function delete(){
        Utils::isAdmin();
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->set_id($id);
            $pro = $producto->getById();
            //Metodo para borrar la imágen del servidor del producto
            $imagen_path = "uploads/images/$pro->imagen";
            if(file_exists($imagen_path)){
                unlink($imagen_path);
            }

            $delete = $producto->delete();
            if($delete){
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }

        header('Location:'.base_url.'producto/gestion');
    }
}//Fin de la clase

?>