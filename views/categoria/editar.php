<h1>Editar Categoria</h1>

<p>Selecciona la categoría por editar</p>

<form action="<?=base_url?>categoria/editCat" method="POST">
    <select name="catEdit">
        <?php while($cat = $categorias->fetch_object()):?>
            <option value="<?=$cat->id?>"><?=$cat->nombre;?></option>
        <?php endwhile;?>
    </select>
    <input type="text" name="nomEdit" value="" required>
    <input type="submit" value="Editar categoria">
</form>