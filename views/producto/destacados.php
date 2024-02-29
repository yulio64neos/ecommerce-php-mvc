<h1>Algunos de nuestros productos</h1>

<?php while($prod = $productos->fetch_object()):?>
    <div class="product">
        <a href="<?=base_url?>producto/ver&id=<?=$prod->id?>">
        <?php if($prod->imagen != null):?>
            <img src="<?=base_url?>uploads/images/<?=$prod->imagen?>">
        <?php else:?>
            <img src="<?=imagen_default?>">
        <?php endif; ?>
        <h2><?=$prod->nombre?></h2>
        </a>
        <p><?=$prod->precio?></p>
        <a href="<?=base_url?>carrito/add&id=<?=$prod->id?>" class="button">Comprar</a>
    </div>
<?php endwhile; ?>
</div>