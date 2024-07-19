<?php

$ingresoSalidaController = new IngresoSalidaController();
$listadoIngresoSalida = $ingresoSalidaController->listar();

?>
<br><br>


<form action="index.php?vista=ingresoSalida/eliminar" method="POST">
    <label for="eliminar">Ponga el id que quiere al que se lo borren</label>
    <input type="number" name="eliminar" id="eliminar" required>
    <label for="eliminarh">Ponga la hora de entrada</label>
    <input type="text" name="eliminarh" id="eliminarh" required>
    <button type="submit">Eliminar</button>
</form>
<br><br>

<h3 style="display:flex;justify-content: center;" >Registrar Ingreso/Salida</h3>
<form action="index.php?vista=ingresoSalida/registrar" method="post" style="display: flex; flex-direction: column; align-items: center;">
        <label for="id_usuario ">ID del Usuario</label>
        <input type="number" name="id_usuario" id="id_usuario " required>
        <label for="codigo_numeroficha">codigo_numeroficha</label>
        <input type="number" name="codigo_numeroficha" id="codigo_numeroficha" required>
        <label for="fecha">fecha</label>
        <input type="date" name="fecha" id="fecha" required>
        <label for="hora_entrada">hora_entradaa</label>
        <input type="datetime" name="hora_entrada" id="hora_entrada" required>
        <label for="hora_salida">hora_salida</label>
        <input type="datetime" name="hora_salida" id="hora_salida" required>
        <label for="observacion">observacion</label>
        <input type="text" name="observacion" id="observacion" required>
        <label for="estado">estado</label>
        <input type="text" name="estado" id="estado" required>
        
        <button type="submit">Registrar</button>
    </form>

<br><br>
<h3 style="display:flex;justify-content: center;" >Actualizar Ingreso/Salida</h3>
<form action="index.php?vista=ingresoSalida/actualizar" method="post" style="display: flex; flex-direction: column; align-items: center;">
        <label for="id_usuario ">ID del Usuario</label>
        <input type="number" name="id_usuario" id="id_usuario " required>
        <label for="hora_entradaa">hora_entradaa del usuario</label>
        <input type="datetime" name="hora_entradaa" id="hora_entradaa" required>

        <label for="codigo_numeroficha">codigo_numeroficha</label>
        <input type="number" name="codigo_numeroficha" id="codigo_numeroficha" required>
        <label for="fecha">fecha</label>
        <input type="date" name="fecha" id="fecha" required>
        <label for="hora_entrada">hora_entrada</label>
        <input type="datetime" name="hora_entrada" id="hora_entrada" required>
        <label for="hora_salida">hora_salida</label>
        <input type="datetime" name="hora_salida" id="hora_salida" required>
        <label for="observacion">observacion</label>
        <input type="text" name="observacion" id="observacion" required>
        <label for="estado">estado</label>
        <input type="text" name="estado" id="estado" required>
        
        <button type="submit">actualizar</button>
    </form>

<h3>Listado de Tabla Ingreso/Salida</h3>
<table border="1">
    <thead>
        <tr>
            <th>id_usuario </th>
            <th>codigo_numeroficha </th>
            <th>fecha</th>
            <th>hora_entrada</th>
            <th>hora_salida</th>
            <th>observacion</th>
            <th>estado</th>
        </tr>
    </thead>
    
    <tbody>
        <?php for($i = 0; $i < count($listadoIngresoSalida); $i++): ?>
        <tr>
            <?php for($j = 0; $j < count($listadoIngresoSalida[$i]); $j++): ?>
            <td><?php echo $listadoIngresoSalida[$i][$j]; ?></td>
            <?php endfor; ?>
        </tr>
        <?php endfor; ?>
    </tbody>
</table>