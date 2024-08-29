<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Acceso</title>
    <link rel="stylesheet" href="./css/ingreso.css?v=<?php echo time(); ?>">
</head>
<body>
    <form action="index.php?vista=usuario/ingreso" method="post">
        <h1>Control de Ingreso y Salida</h1>
        <label for="contrasena">Ingrese su Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" required>

        <div class="radio">
            <legend>¿Tiene observaciones?</legend>
            <div class="labelr">
                <label>
                    <input type="radio" name="observacionn" class="observacionn" value="si"> Sí
                </label>
                <label>
                    <input type="radio" name="observacionn" class="observacionn" value="no"> No
                </label>
            </div>  
            
            <label for="observacion">Observaciones</label>
            <textarea name="observacion" id="observacion" cols="30" rows="10" disabled></textarea> 
        </div>
        
        <button type="submit">Enviar</button>
        <button id="volver" onclick="volverIndex()">Volver</button>
    </form>

    <script>

    function volverIndex() {
            window.location.href = "index.php";
        }
        // Obtener los elementos del DOM para observaciones
        const radioObservacionSi = document.querySelector('input[name="observacionn"][value="si"]');
        const radioObservacionNo = document.querySelector('input[name="observacionn"][value="no"]');
        const textareaObservacion = document.getElementById('observacion');

        // Función para habilitar o deshabilitar la textarea según el estado del radio button
        function toggleObservacionTextarea() {
            textareaObservacion.disabled = !radioObservacionSi.checked;
            if (!radioObservacionSi.checked) {
                textareaObservacion.value = '';
            }
        }

        // Inicialmente deshabilitar la textarea y escuchar los cambios en los radio buttons
        textareaObservacion.disabled = true;
        radioObservacionSi.addEventListener('change', toggleObservacionTextarea);
        radioObservacionNo.addEventListener('change', toggleObservacionTextarea);
    </script>
</body>
</html>