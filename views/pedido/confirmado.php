<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
<h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con exito, 
        una vez que realices la transferencia bancaria con el coste del pedido, será procesado y enviado...
    </p>
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'):?>
    <p>
        Tu pedido NO ha podido procesarse
    </p>
<?php endif; ?>