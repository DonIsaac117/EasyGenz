<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" type="text/css" href="./css/form.css?v=<?php echo time(); ?>">

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
                <option value="PP">Pasaporte</option>
                <option value="ppt">Permiso Por Protección Temporal</option>
                <option value="pep">Permiso Especial De Permanencia</option>
            </select>

            <label for="num-doc">Numero de documento</label>
            <input type="number" id="num-doc" name="num_doc" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>

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
            <input type="number" id="telefono" name="telefono" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="contacto-emer">Teléfono de emergencia</label>
            <input type="number" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="contacto-emer" name="contacto-emer" required>
        </div>

        <div class="btn">
            <button type="submit">Enviar</button>
        </div>

        <div class="col">
            <label for="eps">EPS</label>
            <select required name="eps" id="eps">
                <option value="seleccione">Seleccione..</option>
                <option value="COOSALUD EPS-S"> COOSALUD EPS-S</option>
                <option value="NUEVA EPS"> NUEVA EPS</option>
                <option value="MUTUAL SER"> MUTUAL SER</option>
                <option value="ALIANSALUD EPS">ALIANSALUD EPS</option>
                <option value="SALUD TOTAL EPS S.A">SALUD TOTAL EPS S.A</option>
                <option value="EPS SANITAS"> EPS SANITAS</option>
                <option value="EPS SURA"> EPS SURA</option>
                <option value="FAMISANAR"> FAMISANAR</option>
                <option value="SERVICIO OCCIDENTAL DE SALUD EPS SOS"> SERVICIO OCCIDENTAL DE SALUD EPS SOS</option>
                <option value="SALUD MIA"> SALUD MIA</option>
                <option value="COMFENALCO VALLE">COMFENALCO VALLE</option>
                <option value="COMPENSAR EPS"> COMPENSAR EPS</option>
                <option value="EPM - EMPRESAS PUBLICAS DE MEDELLIN">EPM - EMPRESAS PUBLICAS DE MEDELLIN</option>
                <option value="FONDO DE PASIVO SOCIAL DE FERROCARRILES NACIONALES DE COLOMBIA">FONDO DE PASIVO SOCIAL DE FERROCARRILES NACIONALES DE COLOMBIA</option>
                <option value="CAJACOPI ATLANTICO">CAJACOPI ATLANTICO</option>
                <option value="CAPRESOCA"> CAPRESOCA</option>
                <option value="COMFACHOCO"> COMFACHOCO</option>
                <option value="COMFAORIENTE">COMFAORIENTE</option>
                <option value="EPS FAMILIAR DE COLOMBIA">EPS FAMILIAR DE COLOMBIA</option>
                <option value="ASMET SALUD">ASMET SALUD</option>
                <option value="EMSSANAR E.S.S."> EMSSANAR E.S.S.</option>
                <option value="CAPITAL SALUD EPS-S"> CAPITAL SALUD EPS-S </option>
                <option value="SAVIA SALUD EPS">SAVIA SALUD EPS</option>
                <option value="DUSAKAWI EPSI"> DUSAKAWI EPSI</option>
                <option value="ASOCIACION INDIGENA DEL CAUCA EPSI">ASOCIACION INDIGENA DEL CAUCA EPSI</option>
                <option value="ANAS WAYUU EPSI"> ANAS WAYUU EPSI</option>
                <option value="MALLAMAS EPSI"> MALLAMAS EPSI </option>
                <option value="PIJAOS SALUD EPSI"> PIJAOS SALUD EPSI</option>
                <option value="SALUD BÓLIVAR EPS SAS">SALUD BÓLIVAR EPS SAS</option>
            </select>

            <div class="radio">
                <legend>¿Tienes alergias?</legend>
                <div class="labelr">
                    <label>
                        <input type="radio" name="alergiasr" class="alergiasr" value="si"> Sí
                    </label>
                    <label>
                        <input type="radio" name="alergiasr" class="alergiasr" value="no"> No
                    </label>
                </div>
            
                <label for="alergias">Alergias</label>
                <textarea name="alergias" id="alergias" cols="30" rows="10" disabled></textarea> 
            </div>

            <div class="radio">
                <legend>¿Tienes Enfermedades?</legend>
                <div class="labelr">
                    <label>
                        <input type="radio" name="enfermedadesr" class="enfermedadesr" value="si"> Sí
                    </label>
                    <label>
                        <input type="radio" name="enfermedadesr" class="enfermedadesr" value="no"> No
                    </label>
                </div>


                <label for="enfermedades">Enfermedades</label>
                <textarea name="enfermedades" id="enfermedades" cols="30" rows="10" disabled></textarea>
            </div>
        </div>

        <div class="terminos">
            <label for="condiciones">Aceptar <a href="index.php?vista=usuario/TYC"> terminos y condiciones</a></label>
            <input type="checkbox" id="condiciones" required>
        </div>
    </form>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="mensaje-modal"></span><br>
            <a href="../index.php">Ir al login</a>
        </div>
    </div>


    <script>
        // Obtener los elementos del DOM para alergias
        const radioAlergiasSi = document.querySelector('input[name="alergiasr"][value="si"]');
        const radioAlergiasNo = document.querySelector('input[name="alergiasr"][value="no"]');
        const textareaAlergias = document.getElementById('alergias');
    
        // Obtener los elementos del DOM para enfermedades
        const radioEnfermedadesSi = document.querySelector('input[name="enfermedadesr"][value="si"]');
        const radioEnfermedadesNo = document.querySelector('input[name="enfermedadesr"][value="no"]');
        const textareaEnfermedades = document.getElementById('enfermedades');
    
        // Función para habilitar o deshabilitar la textarea según el estado del radio button de alergias
        function toggleAlergiasTextarea() {
            textareaAlergias.disabled = !radioAlergiasSi.checked;
            if (!radioAlergiasSi.checked) {
                textareaAlergias.value = '';
            }
        }
    
        // Función para habilitar o deshabilitar la textarea según el estado del radio button de enfermedades
        function toggleEnfermedadesTextarea() {
            textareaEnfermedades.disabled = !radioEnfermedadesSi.checked;
            if (!radioEnfermedadesSi.checked) {
                textareaEnfermedades.value = '';
            }
        }
    
        // Inicialmente deshabilitar las textareas y escuchar los cambios en los radio buttons
        textareaAlergias.disabled = true;
        textareaEnfermedades.disabled = true;
    
        radioAlergiasSi.addEventListener('change', toggleAlergiasTextarea);
        radioAlergiasNo.addEventListener('change', toggleAlergiasTextarea);
        radioEnfermedadesSi.addEventListener('change', toggleEnfermedadesTextarea);
        radioEnfermedadesNo.addEventListener('change', toggleEnfermedadesTextarea);




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
