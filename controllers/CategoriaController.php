<?php

require_once __DIR__.'/../models/categoria.php';
require_once __DIR__.'/../models/producto.php';

class categoriaController{
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        require_once __DIR__.'/../views/categoria/index.php';
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //Conseguir categoria
            $categoria = new Categoria();
            $categoria->set_id($id);
            $categoria = $categoria->getOne();

            //Conseguir productos;
            $producto = new Producto();
            $producto->set_categoriaId($id);
            $productos = $producto->getAllCategory();
        }
        require_once __DIR__.'/../views/categoria/ver.php';
    }

    public function crear(){
        Utils::isAdmin();
        require_once __DIR__.'/../views/categoria/crear.php';
    }

    public function save(){
        Utils::isAdmin();

        if(isset($_POST) && isset($_POST['nombre'])){
            $cat = new Categoria();
            $cat->set_nombre($_POST['nombre']);
            $cat->save();
        }
        

        //Guardar la categoria en la base de datos
        header("Location:".base_url."categoria/index");
    }

    public function editar(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAllFor();
        require_once __DIR__.'/../views/categoria/editar.php';
    }

    public function editCat(){
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['nomEdit'])){
            $cat = new Categoria();
            $cat->set_nombre($_POST['nomEdit']);
            $cat->set_id($_POST['catEdit']);
            $cat->editCat();
        }
        header("Location:".base_url."categoria/index");
    }

    public function delete(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAllFor();
        require_once __DIR__.'/../views/categoria/borrar.php';
    }

    public function deleteCat(){
        Utils::isAdmin();

        if(isset($_POST) && isset($_POST['catDelete'])){
            // var_dump($_POST['catDelete']);
            // die();
            $cat = new Categoria();
            $cat->set_id($_POST['catDelete']);
            $cat->deleteCat();
        }
        header("Location:".base_url."categoria/index");
    }
}// Fin de la clase
?>