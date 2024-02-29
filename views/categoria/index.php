<h1>Gestionar Categorías</h1>
<div class="button-group">
    <a class="button btn-small" href="<?=base_url?>categoria/crear">
        Crear categoria
    </a>

    <a class="button-delete btn-small" href="<?=base_url?>categoria/delete">
        Borrar categoria
    </a>

    <a class="button-editar btn-small" href="<?=base_url?>categoria/editar">
        Editar categoria
    </a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
    </tr>
    <?php while($cat = $categorias->fetch_object()):?>
        <tr>
            <td><?=$cat->id;?></td>
            <td><?=$cat->nombre;?></td>
        </tr>
    <?php endwhile;?>
</table>