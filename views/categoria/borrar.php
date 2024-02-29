<h1>Borrar Categoria</h1>

<div>
    <p>Seleccione la Categoría por borrar</p>
</div>

<form action="<?=base_url?>categoria/deleteCat" method="POST">
    <select name="catDelete">
        <?php while($cat = $categorias->fetch_object()):?>
            <option value="<?=$cat->id?>"><?=$cat->nombre;?></option>
        <?php endwhile;?>
    </select>
    <input type="submit" value="Borrar categoria">
</form>
