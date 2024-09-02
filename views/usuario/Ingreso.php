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
    </form>

    <button id="volver" onclick="volverIndex()">Volver</button>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if ($error == 'sesion_funcionario_activa') {
                    echo 'Éxito, funcionario Ingresado.';
                } elseif ($error == 'sesion_instructor_activa') {
                    echo 'Éxito, Instructor Ingresado.';
                } elseif ($error == 'sesion_aprendiz_activa') {
                    echo 'Éxito, Aprendiz Ingresado.';
                }  elseif ($error == 'sesion_funcionario_cerrada') {
                    echo 'Salida del funcionario exitosa.';
                }  elseif ($error == 'sesion_instructor_cerrada') {
                    echo 'Salida del instructor exitosa.';
                }  elseif ($error == 'sesion_aprendiz_cerrada') {
                    echo 'Salida del aprendiz exitosa';
                }   elseif ($error == 'contrasena_incorrecta') {
                    echo 'Contraseña incorrecta.';
                } else {
                    echo 'Error desconocido';
                }
            }
            ?>
            <span class="close">&times;</span>
        </div>
    </div>

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

        document.addEventListener('DOMContentLoaded', function() {
           var modal = document.getElementById('myModal');

           <?php
           if (isset($_GET['error'])) {
               echo "modal.style.display = 'block';";
           }
           ?>

            var closeBtn = document.querySelector('.close');
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>