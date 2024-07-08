<?php

$usuarioController = new UsuarioController();
$listadoUsuarios = $usuarioController->listar();

?>

<br><br>
<button><a href="index.php?vista=usuario/registrar">formulario</a></button>
<br><br>
<button><a href="index.php?vista=usuario/login">login</a></button> 
<br><br>


<form action="index.php?vista=usuario/eliminar" method="POST">
    <label for="eliminar">Ponga el id que quiere al que se lo borren</label>
    <input type="number" name="eliminar" id="eliminar" required>
    <button type="submit">Eliminar</button>
</form>
<br>
<h3 style="display:flex;justify-content: center;" >Actualizar Usuario</h3>
    <form action="index.php?vista=usuario/actualizar" method="post" style="display: flex; flex-direction: column; align-items: center;">
        <label for="id">ID del Usuario</label>
        <input type="number" name="id" id="id" required>
        
        <label for="nombre">Nombre(s)</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="apellidos">Apellidos(s)</label>
        <input type="text" name="apellidos" id="apellidos" required>

        <label for="tipo_doc">Tipo de Documento</label>
        <select name="tipo_doc" id="tipo_doc" required>
            <option value="ti">Targeta de identidad</option>
            <option value="cc">Cédula de ciudadania</option>
            <option value="ce">Cédula de extranjeria</option>
            <option value="ppt">Permiso Por Protección Temporal</option>
            <option value="pep">PEP</option>
        </select>

        <label for="num_doc">Numero de Documento</label>
        <input type="number" name="num_doc" id="num_doc" required>

        <label for="tipo_sangre">Tipo de Sangre</label>
        <select name="tipo_sangre" id="tipo_sangre" required>
            <option value="a+">A+</option>
            <option value="o+">O+</option>
            <option value="b+">B+</option>
            <option value="ab+">AB+</option>
            <option value="a-">A-</option>
            <option value="o-">O-</option>
            <option value="b-">B-</option>
            <option value="ab-">AB-</option>
        </select>

        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena" required>

        <label for="telefono">Teléfono</label>
        <input type="number" name="telefono" id="telefono" required>

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required>

        <label for="eps">EPS</label>
        <input type="text" name="eps" id="eps" required>

        <label for="contacto_emer">Contacto de Emergencia</label>
        <input type="number" name="contacto_emer" id="contacto_emer" required>

        <label for="enfermedades">Enfermedades</label>
        <textarea name="enfermedades" id="enfermedades" cols="30" rows="10"></textarea>

        <label for="alergias">Alergias</label>
        <textarea name="alergias" id="alergias" cols="30" rows="10"></textarea>

        <button type="submit">Actualizar</button>
    </form>

<br>
<h3>Listado de Programas</h3>
<table border="1">
    <thead>
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Id tipo programa</th>
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
