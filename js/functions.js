function registro_exitoso(){
    Swal.fire({
        icon: 'success',
        title: 'Registro completado correctamente',
        showConfirmButton: false,
        timer: 1500
    });
}

function registro_fallido(){
    Swal.fire({
        icon: 'error',
        title: 'Ya existe ese correo en la base de datos',
        showConfirmButton: false,
        timer: 1500
    });
}

function alerta_categoria(){
    Swal.fire({
        icon: 'success',
        title: 'Categoria guardada correctamente',
        showConfirmButton: false,
    });
}

function registro_producto_exitoso(){
    Swal.fire({
        icon: 'success',
        title: 'Registro del producto completado correctamente',
        showConfirmButton: false,
        timer: 1500
    });
}

function registro_producto_fallido(){
    Swal.fire({
        icon: 'error',
        title: 'Registro del producto erroneo',
        showConfirmButton: false,
        timer: 1500
    });
}

function producto_borrado(){
    Swal.fire({
        icon: 'success',
        title: 'Producto borrado correctamente',
        showConfirmButton: false,
        timer: 1500
    });
}

function producto_borrado_negativo(){
    Swal.fire({
        icon: 'error',
        title: 'El producto no se pudo borrar',
        showConfirmButton: false,
        timer: 1500
    });
}