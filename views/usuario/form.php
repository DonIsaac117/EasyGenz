
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.css">
</head>
<body>
    <h1>Registro</h1>
    <form action="index.php?vista=usuario/registrar" method="POST" class="columna">

        <div class="col">
            <label for="nombre">Nombre(s)</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellidos">Apellidos(s)</label>
            <input type="text" id="apellidos" name="apellidos" required>

            <label for="tipo-doc">Tipo de documento</label>
            <select required name="tipo_doc" id="tipo-doc">
                <option value="seleccione">Seleccione..</option>
                <option value="ti">Tarjeta de identidad</option>
                <option value="cc">Cédula de ciudadania</option>
                <option value="ce">Cédula de extranjeria</option>
                <option value="ppt">Permiso Por Protección Temporal</option>
                <option value="pep">PEP</option>
            </select>

            <label for="num-doc">Numero de documento</label>
            <input type="number" id="num-doc" name="num_doc" required>

            <label for="tipo-sangre">Tipo de sangre</label>
            <select required name="tipo-sangre" id="tipo-sangre">
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

        <div class="btn">
            <button type="submit">Enviar</button>
        </div>

        <div class="col">
            <label for="eps">EPS</label>
            <input type="text" id="eps" name="eps" required>

            <label for="contacto-emer">Contacto de emergencia</label>
            <input type="number" id="contacto-emer" name="contacto-emer" required>

            <label for="enfermedades">¿Enfermedades?</label>
            <textarea name="enfermedades" id="enfermedades" cols="30" rows="10"></textarea>

            <label for="alergias">¿Alergias?</label>
            <textarea name="alergias" id="alergias" cols="30" rows="10"></textarea>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.js"></script>
</body>
</html>

