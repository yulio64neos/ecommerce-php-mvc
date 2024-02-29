<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
    <script type="text/javascript" src="<?=base_url?>js/functions.js"></script>
</head>
<body>
    <div id="container">
        <!--Cabecera-->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="<?=base_url?>">
                    <h1>Tienda de Camisetas</h1>
                </a>
            </div>
        </header>
        <!--Menú-->
        <?php $categorias = Utils::showCategorias(); ?>
        <nav id="menu">
            <ul>
                <li>
                    <a href="<?=base_url?>">
                        Inicio
                    </a>
                </li>
                <?php while($cat = $categorias->fetch_object()): ?>
                    <li>
                        <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>">
                            <?=$cat->nombre?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </nav>
    
        <div id="content">