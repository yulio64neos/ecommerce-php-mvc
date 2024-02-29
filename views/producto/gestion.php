<h1>Gestion de Productos</h1>
<div class="button-group">
    <a class="button btn-small" href="<?=base_url?>producto/crear">
        Crear productos
    </a>
</div>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'):?>
    <script type="text/javascript">
        registro_producto_exitoso()
    </script>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'):?>
    <script type="text/javascript">
        registro_producto_fallido()
    </script>
<?php endif;?>
<?php Utils::deleteSession('producto');?>


<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'):?>
    <script type="text/javascript">
        producto_borrado()
    </script>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'):?>
    <script type="text/javascript">
        producto_borrado_negativo()
    </script>
<?php endif;?>
<?php Utils::deleteSession('delete');?>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>
    <?php while($producto = $productos->fetch_object()):?>
        <tr>
            <td><?=$producto->id;?></td>
            <td><?=$producto->nombre;?></td>
            <td><?=$producto->precio;?></td>
            <td><?=$producto->stock;?></td>
            <td>
                <div class="button-group">
                    <a href="<?=base_url?>producto/edit&id=<?=$producto->id?>" class="button-editar btn-small">Editar</a>
                    <a href="<?=base_url?>producto/delete&id=<?=$producto->id?>" class="button-delete btn-small">Eliminar</a>
                </div>
            </td>
        </tr>
    <?php endwhile; ?>
</table>