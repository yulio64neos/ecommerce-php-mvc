<h1>Detalle del pedido</h1>

<?php if(isset($pedido)):?>
            <?php if(isset($_SESSION['admin'])):?>
            <h3>Cambiar el estado del pedido:</h3>
                <form action="<?=base_url?>pedido/estado" method="POST">
                <input type="hidden" value="<?=$pedido->id?>" name="pedido_id">
                    <select name="estado">
                        <option value="confirm" <?=$pedido->estado == "confirm" ? "selected" : ''?>>Pendiente</option>
                        <option value="preparation" <?=$pedido->estado == "preparation" ? "selected" : ''?>>En preparacion</option>
                        <option value="ready" <?=$pedido->estado == "ready" ? "selected" : ''?>>Preparado</option>
                        <option value="sended" <?=$pedido->estado == "sended" ? "selected" : ''?>>Enviado</option>
                    </select>
                    <input type="submit" value="Cambiar estado">
                </form>
            <?php endif; ?>


            <h3>Dirección de envio:</h3>
            Estado: <?=Utils::showStatus($pedido->estado)?> <br>
            Provincia: <?=$pedido->provincia?>
            Ciudad: <?=$pedido->localidad?>
            Dirección: <?=$pedido->direccion?>
            <br>

            <h3>Datos del pedido:</h3>
        
            Número del pedido: <?=$pedido->id?>
            Total a pagar: <?=$pedido->coste?>
            Productos:
            <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>
                <?php while($prod = $productos->fetch_object()): ?>
                    <tr>
                        <td>
                            <?php if($prod->imagen != null):?>
                                <img src="<?=base_url?>uploads/images/<?=$prod->imagen?>">
                            <?php else: ?>
                                <img src="<?=imagen_default?>">
                            <?php endif;?>
                        </td>
                        <td>
                            <a href="<?=base_url?>producto/ver&id=<?=$prod->id?>">
                                <?=$prod->nombre?>
                            </a>
                        </td>
                        <td>
                            <p>
                                <?=$prod->precio?>
                            </p>
                        </td>
                        <td>
                            <p>
                                x<?=$prod->unidades?>
                            </p>
                        </td>
                    </tr>
                    
                <?php endwhile; ?>
            </table>
        
    <?php endif;?>