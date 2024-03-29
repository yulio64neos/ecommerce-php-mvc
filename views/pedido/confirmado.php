<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
<h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con exito, 
        una vez que realices la transferencia bancaria a la cuenta 4252659863154 con el coste del pedido, será procesado y enviado...
    </p>
    <br>
    <?php if(isset($pedido)):?>
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
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'):?>
    <p>
        Tu pedido NO ha podido procesarse
    </p>
<?php endif; ?>