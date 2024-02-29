<?php if(isset($pro)):?>
    <h1><?=$pro->nombre?></h1>
    <div id="detail-product">
        <div class="image">
            <?php if($pro->imagen != null):?>
                <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>">
            <?php else:?>
                <img src="<?=imagen_default?>">
            <?php endif; ?>
        </div>
        <div class="data">
            <h2 class="description"><?=$pro->descripcion?></h2>
            <p class="price">$<?=$pro->precio?></p>
            <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>
