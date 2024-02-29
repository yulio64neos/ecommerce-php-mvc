<!--Barra Lateral-->
<aside id="lateral">
    <?php if(!isset($_SESSION['admin'])) :?>
    <div id="carrito" class="block_aside">
        <h3>Mi carrito</h3>
        <ul>
            <?php $stats = Utils::statsCarrito();?>
            <li>
                <a href="<?=base_url?>carrito/index">Productos: <?=$stats['count']?></a>
            </li>
            <li>
                <a href="<?=base_url?>carrito/index">Total: $<?=$stats['total']?>.00</a>
            </li>
            <li>
                <a href="<?=base_url?>carrito/index">Ver el carrito</a>
            </li>
        </ul>
    </div>
    <?php endif; ?>
    <div id="login" class="block_aside">
        <?php if(!isset($_SESSION['identity'])):?>
        <h3>Entrar a la Web</h3>
        <form action="<?=base_url?>usuario/login" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <input type="submit" value="Enviar">
        </form>
        <?php else: ?>
            <h3><?=$_SESSION['identity']->nombre?> - <?=$_SESSION['identity']->apellidos?></h3>
        <?php endif; ?>
        
        <ul>
            <?php if(isset($_SESSION['admin'])) :?>
                <li>
                    <a href="<?=base_url?>categoria/index">Gestionar categorias</a>
                </li>
                <li>
                    <a href="<?=base_url?>producto/gestion">Gestionar productos</a>
                </li>
                <li>
                    <a href="<?=base_url?>">Gestionar pedidos</a>
                </li>
            <?php endif; ?>
            <?php if(isset($_SESSION['identity'])):?>
                <li>
                    <a href="#">Mis pedidos</a>
                </li>
                <li>
                    <a href="<?=base_url?>usuario/logout">Cerrar Sesión</a>
                </li>
            <?php endif; ?>
            <?php if(!isset($_SESSION['identity'])):?>
                <li>
                    <a href="<?=base_url?>usuario/register">¿No tienes cuenta? Registrate es gratis!!</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</aside>
<!--Contenido Central-->
<div id="central">