<?php

$NumeroFichaController = new NumeroFichaController();
$listadoNumeroFicha = $NumeroFichaController->listar();

?>
<br><br>

<form action="index.php?vista=numeroFicha/eliminar" method="POST">
    <label for="eliminar ">Ponga el codigo al que quiere que se lo borren</label>
    <input type="number" name="eliminar" id="eliminar" required>
    <button type="submit">Eliminar</button>
</form>
<br><br>

<h3 style="display:flex;justify-content: center;" >Registrar Ficha</h3>
    <form action="index.php?vista=numeroFicha/registrar" method="post" style="display: flex; flex-direction: column; align-items: center;">
        <label for="codigo">Codigo de la ficha</label>
        <input type="number" name="codigo" id="codigo" required>
        
        <label for="jornada">Jornada</label>
        <input type="text" name="jornada" id="jornada">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="descripcion">descripcion</label>
        <input type="text" name="descripcion" id="descripcion">

        <label for="id_programa">id_programa </label>
        <input type="number" name="id_programa" id="id_programa">
        <button type="submit">Registrar</button>
    </form>

<br><br>
<h3 style="display:flex;justify-content: center;" >Actualizar Ficha</h3>
    <form action="index.php?vista=numeroFicha/actualizar" method="post" style="display: flex; flex-direction: column; align-items: center;">
    <label for="codigo">Codigo de la ficha</label>
        <input type="number" name="codigo" id="codigo" required>
        
        <label for="jornada">Jornada</label>
        <input type="text" name="jornada" id="jornada">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="descripcion">descripcion</label>
        <input type="text" name="descripcion" id="descripcion">

        <label for="id_programa">id_programa </label>
        <input type="number" name="id_programa" id="id_programa">
        <button type="submit">Actualizar</button>
    </form>

<h3>Listado de Fichas</h3>
<table border="1">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Jornada</th>
            <th>Nombre</th>
            <th>descripcion</th>
            <th>id_programa</th>
        </tr>
    </thead>
    
    <tbody>
        <?php for($i = 0; $i < count($listadoNumeroFicha); $i++): ?>
        <tr>
            <?php for($j = 0; $j < count($listadoNumeroFicha[$i]); $j++): ?>
            <td><?php echo $listadoNumeroFicha[$i][$j]; ?></td>
            <?php endfor; ?>
        </tr>
        <?php endfor; ?>
    </tbody>
</table>