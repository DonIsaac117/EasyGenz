<?php

$programaController = new ProgramaController();
$listadoProgramas = $programaController->listar();

?>
<br><br>


<form action="index.php?vista=programa/eliminar" method="POST">
    <label for="eliminar ">Ponga el id que quiere al que se lo borren</label>
    <input type="number" name="eliminarp" id="eliminar" required>
    <button type="submit">Eliminar</button>
</form>
<br><br>

<h3 style="display:flex;justify-content: center;" >Registrar Programa</h3>
    <form action="index.php?vista=programa/registrar" method="post" style="display: flex; flex-direction: column; align-items: center;">
        <label for="id">ID del Programa</label>
        <input type="number" name="idp" id="id" required>
        
        <label for="nombre">Nombre(s)</label>
        <input type="text" name="nombre" id="nombre">

        <label for="tipo_doc">Tipo de programa</label>
        <select name="tipo" id="tipo" required>
            <option value="3">Curso Corto</option>
            <option value="1">Tecnologo</option>
            <option value="2">Tecnico</option>
        </select>
        <button type="submit">Registrar</button>
    </form>

<br><br>
<h3 style="display:flex;justify-content: center;" >Actualizar Programa</h3>
    <form action="index.php?vista=programa/actualizar" method="post" style="display: flex; flex-direction: column; align-items: center;">
        <label for="id">ID del Programa</label>
        <input type="number" name="id" id="id" required>
        
        <label for="nombre">Nombre(s)</label>
        <input type="text" name="nombre" id="nombre">

        <label for="tipo_doc">Tipo de programa</label>
        <select name="tipo" id="tipo" required>
            <option value="3">Curso Corto</option>
            <option value="1">Tecnologo</option>
            <option value="2">Tecnico</option>
        </select>
        <button type="submit">Actualizar</button>
    </form>

<h3>Listado de Programas</h3>
<table border="1">
    <thead>
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Id tipo programa</th>
        </tr>
    </thead>
    
    <tbody>
        <?php for($i = 0; $i < count($listadoProgramas); $i++): ?>
        <tr>
            <?php for($j = 0; $j < count($listadoProgramas[$i]); $j++): ?>
            <td><?php echo $listadoProgramas[$i][$j]; ?></td>
            <?php endfor; ?>
        </tr>
        <?php endfor; ?>
    </tbody>
</table>