<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$id_usuario = $_SESSION['id_usuario'];
require_once './controllers/usuariosController.php';

$usuarioController = new UsuarioController();

// Obtener los datos del usuario
$datosUsuario = $usuarioController->obtenerPerfilUsuario($id_usuario);

// Separar nombres y apellidos
$nombres = explode(' ', $datosUsuario['nombres']);
$primerNombre = $nombres[0];
$segundoNombre = isset($nombres[1]) ? $nombres[1] : 'N/A';

$apellidos = explode(' ', $datosUsuario['apellidos']);
$primerApellido = $apellidos[0];
$segundoApellido = isset($apellidos[1]) ? $apellidos[1] : 'N/A';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Soporte</title>
    <link rel="stylesheet" href="./css/funcionario/soporte.css" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/027f6cc223.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="nav">
            <div class="sena">
                <img src="./imagenes/funcionario/logoSena.png" />Instructor
            </div>
            <div class="menu">
                <a href="?vista=instructor/inicio">
                    <div>
                        <span class="material-icons-sharp">home</span>
                        <p>Calendario</p>
                    </div>
                </a>

            </div>
            <div class="menu">
                <a href="?vista=instructor/ficha">
                    <div>
                        <span class="material-icons-sharp">description</span>
                        <p>Ficha</p>
                    </div>
            </div>
            </a>

            <div class="menu">
                <a href="?vista=instructor/soporte">
                    <div style="background: rgb(0, 0, 0, 0.32);">
                        <span class="material-icons-sharp">question_mark</span>
                        <p>Soporte</p>
                    </div>
                </a>
            </div>

        </nav>
    <div class="body">
        <header class="header">
            <div class="title">
                <p>Control de Registro</p>
            </div>
            <div class="perfil">
                <span class="material-icons-sharp" id="perfilIcon">account_circle</span>
                <div id="perfilMenu" class="perfilMenu">
                    <div class="perfilIcon">
                        <div>
                            <span class="material-icons-sharp">account_circle</span>
                            <button class="btnBlue">Cambiar foto</button>
                        </div>

                        <div class="nameUser">
                            <h2>
                                <?php echo $datosUsuario['nombres']; ?>
                            </h2>
                            <h5>
                                <?php echo $datosUsuario['email']; ?>
                            </h5>
                        </div>
                    </div>

                    <div class="userData">
                        <div>
                            <h4>Primer nombre</h4>
                            <h5>
                                <?php echo $primerNombre; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Segundo nombre</h4>
                            <h5>
                                <?php echo $segundoNombre; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Primer apellido</h4>
                            <h5>
                                <?php echo $primerApellido; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Segundo apellido</h4>
                            <h5>
                                <?php echo $segundoApellido; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>N°Documento</h4>
                            <h5>
                                <?php echo isset($datosUsuario['numero_documento']) ? $datosUsuario['numero_documento'] : 'N/A'; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Teléfono</h4>
                            <h5>
                                <?php echo isset($datosUsuario['telefono']) ? $datosUsuario['telefono'] : 'N/A'; ?>
                            </h5>
                        </div>
                    </div>
                    <h3 style="text-align: center;">Datos Médicos</h3>
                    <div class="userData">
                        <div>
                            <h4>EPS</h4>
                            <h5>
                                <?php echo isset($datosUsuario['eps']) ? $datosUsuario['eps'] : 'N/A'; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>RH</h4>
                            <h5>
                                <?php echo isset($datosUsuario['rh']) ? $datosUsuario['rh'] : 'N/A'; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Contacto de Emergencia</h4>
                            <h5>
                                <?php echo isset($datosUsuario['contacto_emergencia']) ? $datosUsuario['contacto_emergencia'] : 'N/A'; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Enfermedades</h4>
                            <h5>
                                <?php echo isset($datosUsuario['enfermedades']) ? $datosUsuario['enfermedades'] : 'N/A'; ?>
                            </h5>
                        </div>
                        <div>
                            <h4>Alergias</h4>
                            <h5>
                                <?php echo isset($datosUsuario['alergias']) ? $datosUsuario['alergias'] : 'N/A'; ?>
                            </h5>
                        </div>
                    </div>

                    <div class="userEnd">
                        <button class="btnRed">Cerrar sesión</button>
                    </div>
                </div>
            </div>
        </header>
        <main class="main">
            <div class="mainLayout">
                <div class="boxSupport">
                    <h3>Reclamos</h3>
                    <form action="index.php?vista=funcionario/soporte" method="post" id="pqrForm">
                    <select name="pqr" id="pqr" form="pqrForm">
                        <option value="sugerencia" selected>Sugerencias</option>
                        <option value="reclamos">Reclamos</option>
                        <option value="reporte de errores">Reporte de errores</option>
                    </select>

                        <textarea id="reclamo" name="reclamo" maxlength="750"></textarea>

                        <input type="hidden" name="userEmail" value="<?php echo htmlspecialchars($datosUsuario['email']); ?>" />

                        <button type="submit">Enviar</button>
                        <div class="char-limit-message" id="charLimitMsg">Has alcanzado el límite de caracteres.</div>

                    </form>
                </div>
                <div class="infoPdf">
                    <h3>Informacion</h3>
                    <div class="organized">
                        <h4><img src="./imagenes/funcionario/pdf.png" alt="pdf" title="Descargar pdf">Preguntas
                            frecuentes</h4>
                        <h4><img src="./imagenes/funcionario/pdf.png" alt="pdf" title="Descargar pdf">Manual de usuario
                        </h4>
                        <h4><img src="./imagenes/funcionario/pdf.png" alt="pdf" title="Descargar pdf">Sobre nosotros
                        </h4>
                    </div>
                </div>

                <div class="contacInfo">
                    <h3>Informacion de Contacto</h3>
                    <div class="organized">
                        <h4><i class="fa-solid fa-phone"></i>5978250 ext. 17374 </h4>
                        <h4><i class="fa-brands fa-whatsapp"></i>+57 316 8760255</h4>
                        <h4><i class="fa-solid fa-location-dot"></i>&nbsp;Cl. 2 #13 - 3, Villeta, Cundinamarca</h4>
                        <h4><i class="fa-solid fa-envelope"></i> cdaecomunica@misena.edu.co</h4>
                        <h4><a href="https://blogcentrofusagasuga.blogspot.com/" title="Ir al blog"><i class="fa-solid fa-globe"></i>Blogspot</a> </h4>
                    </div>
                </div>
                <div class="social">
                    <h3>Redes Sociales</h3>
                    <a href="https://www.facebook.com/SENAVilletaOficial/"><i class="fab fa-facebook" style="color: #3b5998;"></i></a>
                    <a href="https://twitter.com/SENACDAE"><i class="fab fa-x-twitter" style="color: black"></i></a> 
                    <a href="https://www.instagram.com/senacundinamarca/?hl=es-la"><i class="fab fa-instagram" style="
                      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
                      background-clip: text;
                      -webkit-text-fill-color: transparent;">
                    </i></a>
                </div>



            </div>
        </main>
    </div>

    <script src="./js/instructor/soporte.js"></script>
    <script>


    </script>
</body>

</html>