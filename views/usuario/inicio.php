<?php

$usuarioController = new UsuarioController();
$listadoUsuarios = $usuarioController->listar();

?>

<form action="index.php?vista=usuario/inicio" method="POST">
    <label for="eliminar">Ponga el id que quiere al que se lo borren</label>
    <input type="number" name="eliminar" id="eliminar" required>
    <button type="submit">Eliminar</button>
</form>
<br>
<h3>Listado de Usuarios</h3>
<table border="1">
    <thead>
        <tr>
            <th>id</th>
            <th>Nombres</th>
            <th>apellidos</th>
            <th>tipo_documento</th>
            <th>numero_documento</th>
            <th>telefono</th>
            <th>email</th>
            <th>contrasena</th>
            <th>huella</th>
            <th>codigo</th>
            <th>eps</th>
            <th>rh</th>
            <th>contacto_emergencia</th>
            <th>enfermedades</th>
            <th>alergias</th>
        </tr>
    </thead>
    
    <tbody>
        <?php for($i = 0; $i < count($listadoUsuarios); $i++): ?>
        <tr>
            <?php for($j = 0; $j < count($listadoUsuarios[$i]); $j++): ?>
            <td><?php echo $listadoUsuarios[$i][$j]; ?></td>
            <?php endfor; ?>
        </tr>
        <?php endfor; ?>
    </tbody>
</table>
