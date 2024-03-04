<h1>Carrito de la compra</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1):?>
<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Eliminar</th>
    </tr>
    <?php 
        if(isset($carrito)):
        foreach($carrito as $indice => $elemento):
        $producto = $elemento['producto'];
    ?>
        <tr>
            <td>
                <?php if($producto->imagen != null):?>
                    <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>">
                <?php else:?>
                    <img src="<?=imagen_default?>">
                <?php endif; ?>
            </td>
            <td>
                <a href="<?=base_url?>producto/ver&id=<?=$producto->id?>">
                    <?=$producto->nombre?>
                </a>
            </td>
            <td>
                <p>
                    <?=$producto->precio?>
                </p>
            </td>
            <td>
                <?=$elemento['unidades'];?>
                <div class="updown-unidades">
                    <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="button">+</a>
                    <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="button">-</a>
                </div>
            </td>
            <td>
            <a href="<?=base_url?>carrito/delete&index=<?=$indice?>" class="button-carrito button-delete">Quitar producto</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
        <p>El carrito está vacio, por favor elija productos para llenar</p>
    <?php endif; ?>
</table>
<br>

<div class="delete-carrito">
    <a href="<?=base_url?>carrito/delete_all" class="button-pedido button-delete">Vaciar carrito</a>
</div>
<div class="total-carrito">
    <?php $stats = Utils::statsCarrito();?>
    <h3>Precio total: $<?=$stats['total']?>.00</h3>
    <a href="<?=base_url?>pedido/hacer" class="button-pedido">Hacer pedido</a>
</div>
<?php else: ?>
    <h1>El carrito está vacio, por favor elija productos para llenar</h1>
<?php endif; ?>