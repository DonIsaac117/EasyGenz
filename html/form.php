<?php
require_once('../cmv/controllers/clienteControllers.php');
$ClienteController = new ClienteController();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombres = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $tipo_documento = $_POST['tipo_doc'];
    $numero_documento = $_POST['num_doc'];
    $rh = $_POST['tipo_sangre'];
    $contrasena = $_POST['contrasena'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $eps = $_POST['eps'];
    $contacto_emergencia = $_POST['contacto_emer'];
    $enfermedades = $_POST['enfermedades'];
    $alergias = $_POST['alergias'];

    $ClienteController->registrar($nombres, $apellidos, $tipo_documento, $numero_documento, $telefono, $email, $contrasena, $rh, $eps, $contacto_emergencia, $enfermedades, $alergias);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="../css/Form.css">
</head>
<body>
    <h1>Registro</h1>
    <form id="myForm" action="form.php" method="POST" class="columna">

        <div class="col">
            <label for="nombre">Nombre(s)</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellidos">Apellidos(s)</label>
            <input type="text" id="apellidos" name="apellidos" required>

            <label for="tipo-doc">Tipo de documento</label>
            <select required name="tipo_doc" id="tipo-doc">
                <option value="seleccione">Seleccione..</option>
                <option value="ti">Targeta de identidad</option>
                <option value="cc">Cédula de ciudadania</option>
                <option value="ce">Cédula de extranjeria</option>
                <option value="ppt">Permiso Por Protección Temporal</option>
                <option value="pep">PEP</option>
            </select>

            <label for="num-doc">Numero de documento</label>
            <input type="number" id="num-doc" name="num_doc" required>

            <label for="tipo-sangre">Tipo de sangre</label>
            <select required name="tipo_sangre" id="tipo-sangre">
                <option value="seleccione">Seleccione..</option>
                <option value="a+">A+</option>
                <option value="o+">O+</option>
                <option value="b+">B+</option>
                <option value="ab+">AB+</option>
                <option value="a-">A-</option>
                <option value="o-">O-</option>
                <option value="b-">B-</option>
                <option value="ab-">AB-</option>
            </select>
        </div>

        <div class="col">
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="telefono">Teléfono</label>
            <input type="number" id="telefono" name="telefono" pattern="[0-9]*" maxlength="10" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="col">
            <label for="eps">EPS</label>
            <input type="text" id="eps" name="eps" required>

            <label for="contacto-emer">Contacto de emergencia</label>
            <input type="number" id="contacto_emer" name="contacto_emer" required>

            <label for="enfermedades">¿Enfermedades?</label>
            <textarea name="enfermedades" id="enfermedades" cols="30" rows="10"></textarea>

            <label for="alergias">¿Alergias?</label>
            <textarea name="alergias" id="alergias" cols="30" rows="10"></textarea>
        </div>

        <div class="btn">
            <button type="submit" id="redireccionar" class="button">Enviar</button>
        </div>
    </form>
    <div id="myModal" class="modal">
    <div class="modal-content">
        <span id="mensaje-modal"></span><br>
        <a href="../index.php">Ir al login</a>
    </div>
</div>

<script>
document.getElementById('redireccionar').addEventListener('click', function() {
    const nombre = document.getElementById('nombre').value.trim();
    const apellidos = document.getElementById('apellidos').value.trim();
    const tipo_doc = document.getElementById('tipo-doc').value.trim();
    const num_doc = document.getElementById('num-doc').value.trim();
    const tipo_sangre = document.getElementById('tipo-sangre').value.trim();
    const contrasena = document.getElementById('contrasena').value.trim();
    const telefono = document.getElementById('telefono').value.trim();
    const email = document.getElementById('email').value.trim();
    const eps = document.getElementById('eps').value.trim();
    const contacto_emer = document.getElementById('contacto_emer').value.trim();
    // Aquí incluir el resto de campos

    if (nombre !== '' && apellidos !== '' && tipo_doc !== '' && num_doc !== '' && tipo_sangre !== '' && contrasena !== '' && telefono !== '' && email !== '' && eps !== '' && contacto_emer !== '') {
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';

        setTimeout(function() {
            modal.style.display = 'none';
            window.location.href = "../index.php"; // Redirigir aquí
        }, 3000); // 3000 milisegundos (3 segundos)
    } else {
        alert('Por favor, completa todos los campos.');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('myModal');
    var mensajeModal = document.getElementById('mensaje-modal');


    // PHP para mostrar mensaje en el modal
    <?php if (isset($_GET['error'])): ?>
        <?php $error = $_GET['error']; ?>
        <?php if ($error == 'usuario_registrado'): ?>
            mensajeModal.textContent = 'Se ha registrado correctamente';
        <?php else: ?>
            mensajeModal.textContent = 'Error desconocido';
        <?php endif; ?>
        modal.style.display = 'block'; // Mostrar el modal
    <?php endif; ?>
});
</script>
</body>
</html>
