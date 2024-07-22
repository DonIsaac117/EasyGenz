<?php
$funcionController = new FuncionController();
$listaControlFuncion = $funcionController->listar();
?>  

<h3>Registros de Funcionarios</h3>
<table border =1>
    <thead>
        <tr>
            <th>id_usuario</th>
            <th>fecha</th>
            <th>hora_entrada</th>
            <th>hora_salida</th>
            <th>observacion</th>
            <th>estado</th>

            <a href="?views=funcion/crear"></a>
        </tr>
    </thead>
</table>