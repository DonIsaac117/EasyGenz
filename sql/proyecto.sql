-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2024 a las 21:43:41
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `aprendiz_ficha` ()   BEGIN
SELECT
	usuarios.nombres as nombre_aprendiz,
    usuarios.apellidos as apellido_aprendiz,
    usuarios.numero_documento,
    numero_ficha.codigo as codigo_ficha,
    numero_ficha.nombre as nombre_ficha,
    numero_ficha.jornada,
    programa.nombre as nombre_programa,
    tipo_programa.tipo=programa.id_tipo_programa
FROM usuarios
INNER JOIN aprendiz on aprendiz.id_usuario=usuarios.id
INNER JOIN numero_ficha on numero_ficha.codigo=aprendiz.codigo_numeroficha
INNER JOIN programa on programa.id=numero_ficha.id_programa
INNER JOIN tipo_programa on tipo_programa.id=programa.id_tipo_programa;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `aprendiz_ingreso_salida` ()   BEGIN
SELECT usuarios.nombres as nombre_aprendiz,
		usuarios.apellidos as apellido_aprendiz,
        usuarios.numero_documento,
numero_ficha.codigo as codigo_ficha,
ingresosalida_ficha.fecha,
ingresosalida_ficha.hora_entrada,
ingresosalida_ficha.hora_salida,
ingresosalida_ficha.estado,
numero_ficha.jornada,
ingresosalida_ficha.id_usuario 
from usuarios
inner join usuario_perfil on usuario_perfil.id_usuario = usuarios.id
inner join ingresosalida_ficha on usuario_perfil.id_usuario =ingresosalida_ficha.id_usuario
inner join numero_ficha on numero_ficha.codigo=ingresosalida_ficha.codigo_numeroficha
WHERE usuario_perfil.id_perfil=1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fichas` ()   BEGIN
SELECT
numero_ficha.codigo as codigo_ficha,
    numero_ficha.nombre as nombre_ficha,
    numero_ficha.jornada,
    numero_ficha.descripcion,
    programa.nombre as nombre_programa,
    tipo_programa.tipo
    
FROM numero_ficha
INNER JOIN programa on programa.id=numero_ficha.id_programa
INNER JOIN tipo_programa on tipo_programa.id=programa.id_tipo_programa;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `funcionarios` ()   BEGIN
SELECT
	usuarios.nombres,
    usuarios.apellidos,
    usuarios.numero_documento,
    funcion.nombre,
    funcion.descripcion
FROM usuarios
INNER JOIN funcionario on funcionario.id_usuario=usuarios.id
INNER JOIN funcion on funcion.id=funcionario.id_funcion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `instructor_ficha` ()   BEGIN
SELECT
	usuarios.nombres as nombre_instructor,
    usuarios.apellidos as apellido_instructor,
    usuarios.numero_documento,
    numero_ficha.codigo as codigo_ficha,
    numero_ficha.nombre as nombre_ficha,
    numero_ficha.jornada,
    programa.nombre as nombre_programa,
    tipo_programa.tipo
FROM usuarios
INNER JOIN instructor on instructor.id_usuario=usuarios.id
INNER JOIN numero_ficha on numero_ficha.codigo=instructor.codigo_numeroficha
INNER JOIN programa on programa.id=numero_ficha.id_programa
INNER JOIN tipo_programa on tipo_programa.id=programa.id_tipo_programa;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `instructor_ingreso_salida` ()   BEGIN
SELECT usuarios.nombres as nombre_aprendiz,
		usuarios.apellidos as apellido_aprendiz,
        usuarios.numero_documento,
numero_ficha.codigo as codigo_ficha,
ingresosalida_ficha.fecha,
ingresosalida_ficha.hora_entrada,
ingresosalida_ficha.hora_salida,
ingresosalida_ficha.estado,
numero_ficha.jornada,
ingresosalida_ficha.id_usuario 
from usuarios
inner join usuario_perfil on usuario_perfil.id_usuario = usuarios.id
inner join ingresosalida_ficha on usuario_perfil.id_usuario =ingresosalida_ficha.id_usuario
inner join numero_ficha on numero_ficha.codigo=ingresosalida_ficha.codigo_numeroficha
WHERE usuario_perfil.id_perfil=2;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `perfiles` ()   BEGIN
SELECT
	usuarios.nombres,
    usuarios.apellidos,
    usuarios.numero_documento,
    perfil.perfil
FROM usuarios
INNER JOIN usuario_perfil on usuario_perfil.id_usuario=usuarios.id
INNER JOIN perfil on perfil.id=usuario_perfil.id_perfil;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usuarios_ficha` ()   BEGIN
SELECT
	usuarios.nombres as nombre,
    usuarios.apellidos as apellido,
    usuarios.numero_documento,
    numero_ficha.codigo as codigo_ficha,
    numero_ficha.nombre as nombre_ficha,
    numero_ficha.jornada,
    programa.nombre as nombre_programa,
    tipo_programa.tipo
FROM usuarios
LEFT JOIN aprendiz on aprendiz.id_usuario=usuarios.id
LEFT JOIN instructor on instructor.id_usuario=usuarios.id
INNER JOIN numero_ficha on numero_ficha.codigo=aprendiz.codigo_numeroficha or numero_ficha.codigo=instructor.codigo_numeroficha
INNER JOIN programa on programa.id=numero_ficha.id_programa
INNER JOIN tipo_programa on tipo_programa.id=programa.id_tipo_programa;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usuario_controlfuncionario` ()   BEGIN
SELECT usuarios.nombres AS nombre_funcionario,
		 usuarios.apellidos as apellido_funcionario,
    usuarios.numero_documento,
controlfuncionarios.fecha,
controlfuncionarios.hora_entrada,
controlfuncionarios.hora_salida,
controlfuncionarios.estado,
controlfuncionarios.id_usuario
from usuarios
inner join usuario_perfil on usuario_perfil.id_usuario = usuarios.id
inner join controlfuncionarios on controlfuncionarios.id_usuario =usuario_perfil.id_usuario;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usuario_ingreso_salida` ()   BEGIN
SELECT usuarios.nombres,
		usuarios.apellidos,
        usuarios.numero_documento,
numero_ficha.codigo as codigo_ficha,
ingresosalida_ficha.fecha,
ingresosalida_ficha.hora_entrada,
ingresosalida_ficha.hora_salida,
ingresosalida_ficha.estado,
numero_ficha.jornada,
ingresosalida_ficha.id_usuario 
from usuarios
inner join usuario_perfil on usuario_perfil.id_usuario = usuarios.id
inner join ingresosalida_ficha on usuario_perfil.id_usuario =ingresosalida_ficha.id_usuario
inner join numero_ficha on numero_ficha.codigo=ingresosalida_ficha.codigo_numeroficha;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendiz`
--

CREATE TABLE `aprendiz` (
  `id_usuario` int(11) DEFAULT NULL,
  `codigo_numeroficha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aprendiz`
--

INSERT INTO `aprendiz` (`id_usuario`, `codigo_numeroficha`) VALUES
(1, 2620031),
(2, 2620031),
(3, 42049482),
(4, 7842958),
(5, 7842958);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(20) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL,
  `evento` varchar(20) NOT NULL,
  `nombre_nuevo` varchar(100) NOT NULL,
  `nombre_viejo` varchar(100) DEFAULT NULL,
  `apellido_nuevo` varchar(100) NOT NULL,
  `apellido_viejo` varchar(100) DEFAULT NULL,
  `tipo_documento_nuevo` enum('TI','CC','PP') NOT NULL,
  `tipo_documento_viejo` enum('TI','CC','PP') DEFAULT NULL,
  `numero_documento_nuevo` varchar(20) NOT NULL,
  `numero_documento_viejo` varchar(20) DEFAULT NULL,
  `telefono_nuevo` bigint(20) NOT NULL,
  `telefono_viejo` bigint(20) DEFAULT NULL,
  `email_nuevo` varchar(100) NOT NULL,
  `email_viejo` varchar(100) DEFAULT NULL,
  `contrasena_nuevo` varchar(100) NOT NULL,
  `contrasena_viejo` varchar(100) DEFAULT NULL,
  `huella_nuevo` varbinary(50) DEFAULT NULL,
  `huella_viejo` varbinary(50) DEFAULT NULL,
  `codigo_nuevo` int(50) DEFAULT NULL,
  `codigo_viejo` int(50) DEFAULT NULL,
  `eps_nuevo` varchar(50) NOT NULL,
  `eps_viejo` varchar(50) DEFAULT NULL,
  `rh_nuevo` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `rh_viejo` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `contacto_emergencia_nuevo` int(20) NOT NULL,
  `contacto_emergencia_viejo` int(20) DEFAULT NULL,
  `enfermedades_nuevo` varchar(100) NOT NULL,
  `enfermedades_viejo` varchar(100) DEFAULT NULL,
  `alergias_nuevo` varchar(100) NOT NULL,
  `alergias_viejo` varchar(100) DEFAULT NULL,
  `observaciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `usuario`, `fecha`, `evento`, `nombre_nuevo`, `nombre_viejo`, `apellido_nuevo`, `apellido_viejo`, `tipo_documento_nuevo`, `tipo_documento_viejo`, `numero_documento_nuevo`, `numero_documento_viejo`, `telefono_nuevo`, `telefono_viejo`, `email_nuevo`, `email_viejo`, `contrasena_nuevo`, `contrasena_viejo`, `huella_nuevo`, `huella_viejo`, `codigo_nuevo`, `codigo_viejo`, `eps_nuevo`, `eps_viejo`, `rh_nuevo`, `rh_viejo`, `contacto_emergencia_nuevo`, `contacto_emergencia_viejo`, `enfermedades_nuevo`, `enfermedades_viejo`, `alergias_nuevo`, `alergias_viejo`, `observaciones`) VALUES
(1, 'root@localhost', '2024-04-24 16:49:32', 'INSERT', 'CHAMO', NULL, 'MOISES', NULL, 'CC', NULL, '1077889910', NULL, 3133143151, NULL, 'CHAMOLOCO@VENECO.COM', NULL, 'JETSHO', NULL, 0x3939393939393939, NULL, 1100220, NULL, 'CEMENTERIO', NULL, 'AB+', NULL, 987654321, NULL, 'exceso de amvre', NULL, 'a la comida', NULL, 'Se ha ingresado un nuevo usuario por parte de :root@localhost'),
(2, 'root@localhost', '2024-05-14 14:41:30', 'DELETE', '', 'Ana', '', 'López', 'TI', 'CC', '', '56789012', 0, 5678901234, '', 'ana@example.com', '', 'passpass', '', NULL, 0, 0, '', 'famisanar', 'A+', 'A-', 0, 2147483647, '', 'Ninguna', '', 'Gluten', 'Se ha Eliminado un usuario por parte de :root@localhost');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controlfuncionarios`
--

CREATE TABLE `controlfuncionarios` (
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `observacion` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `controlfuncionarios`
--

INSERT INTO `controlfuncionarios` (`id_usuario`, `fecha`, `hora_entrada`, `hora_salida`, `observacion`, `estado`) VALUES
(4, '2024-04-16', '12:16:12', '20:16:12', 'ingresa nrmal', 'activo'),
(5, '2024-04-16', '16:16:12', '24:16:12', 'nada', 'en descanso'),
(6, '2024-04-30', '16:16:12', '24:16:12', 'en su casa', 'durmiendo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcion`
--

CREATE TABLE `funcion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `funcion`
--

INSERT INTO `funcion` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Coordinador de programas', 'Coordinar la implementación de programas de formación y capacitación.'),
(2, 'Asesor en orientación laboral', 'Brindar asesoramiento y orientación a los estudiantes y graduados sobre opciones de carrera y oportunidades laborales.'),
(3, 'Gestor de proyectos', 'Planificar, coordinar y supervisar la ejecución de proyectos relacionados con la formación y el desarrollo profesional.'),
(4, 'Analista de recursos humanos', 'Administrar procesos de reclutamiento y selección de personal para vacantes internas y externas.'),
(5, 'Coordinador de prácticas empresariales', 'Establecer y mantener relaciones con empresas y organizaciones para facilitar oportunidades de prácticas laborales para los estudiantes.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE `funcionario` (
  `id_usuario` int(11) DEFAULT NULL,
  `id_funcion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `funcionario`
--

INSERT INTO `funcionario` (`id_usuario`, `id_funcion`) VALUES
(9, 1),
(9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresosalida_ficha`
--

CREATE TABLE `ingresosalida_ficha` (
  `id_usuario` int(11) DEFAULT NULL,
  `codigo_numeroficha` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `observacion` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingresosalida_ficha`
--

INSERT INTO `ingresosalida_ficha` (`id_usuario`, `codigo_numeroficha`, `fecha`, `hora_entrada`, `hora_salida`, `observacion`, `estado`) VALUES
(1, 42049482, '2024-04-01', '20:08:18', '35:08:18', 'ninguna', 'en curso'),
(2, 2620031, '2024-04-01', '06:19:18', '30:08:18', 'n/n', 'aprobado'),
(3, 7842958, '2024-04-17', '12:19:18', '20:08:18', 'fulvo fulvo', 'cancelado'),
(6, 42049482, '2024-07-27', '13:49:58', '21:09:28', 'cosas', 'aprovado'),
(7, 7842958, '2024-10-14', '09:49:38', '22:03:48', 'salio', 'en curso'),
(8, 2620031, '2024-07-11', '16:39:28', '23:05:28', 'hola adios', 'cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `id_usuario` int(11) DEFAULT NULL,
  `codigo_numeroficha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`id_usuario`, `codigo_numeroficha`) VALUES
(6, 2620031),
(7, 42049482),
(8, 7842958);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numero_ficha`
--

CREATE TABLE `numero_ficha` (
  `codigo` int(11) NOT NULL,
  `jornada` varchar(10) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `id_programa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `numero_ficha`
--

INSERT INTO `numero_ficha` (`codigo`, `jornada`, `nombre`, `descripcion`, `id_programa`) VALUES
(2620031, 'tarde', 'tgo Adso', 'no se no estudio ahi', 398244),
(7842958, 'mañana', 'tgo fulvo', '', 3862842),
(42049482, 'noche', 'tecnico Sistemas', 'no se tampoco estudio ahi', 9753573);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `perfil` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `perfil`) VALUES
(1, 'Aprendiz'),
(2, 'Instructor'),
(3, 'Funcionario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `id_tipo_programa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id`, `nombre`, `id_tipo_programa`) VALUES
(398244, 'ADSO ', 1),
(3862842, 'Sistemas', 2),
(9753573, 'exel con Andres', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_programa`
--

CREATE TABLE `tipo_programa` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_programa`
--

INSERT INTO `tipo_programa` (`id`, `tipo`, `descripcion`) VALUES
(1, 'Tecnologo', 'Duración de la ficha 4 semestres con un semestre de practicas y 3 de lectiva'),
(2, 'Tecnico', 'un año con 6 meses de lectiva y 6 de practica'),
(3, 'curso corto', 'Oscila entre las 40 y 80 horas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `tipo_documento` enum('TI','CC','PP') NOT NULL,
  `numero_documento` varchar(20) NOT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contrasena` varchar(50) NOT NULL,
  `huella` varbinary(50) DEFAULT NULL,
  `codigo` int(50) DEFAULT NULL,
  `eps` varchar(50) DEFAULT NULL,
  `rh` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `contacto_emergencia` int(20) DEFAULT NULL,
  `enfermedades` varchar(100) DEFAULT NULL,
  `alergias` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `tipo_documento`, `numero_documento`, `telefono`, `email`, `contrasena`, `huella`, `codigo`, `eps`, `rh`, `contacto_emergencia`, `enfermedades`, `alergias`) VALUES
(1, 'yo merito', ':v', 'CC', '1077967033', 3114829214, 'fluvot@carelibro', '123456', NULL, 123456789, 'Sanitas', 'AB+', 27184783, 'exceso de facha', 'a los 🧒🏿'),
(2, 'chiki fulvo', 'messi:v', 'TI', '1016000066', 666, 'fifa2585@fulvo.com', '123456789', NULL, 12345678, 'corvesalud', 'A-', 1122334455, 'solo cuando no hay fulvo', 'a juancho'),
(3, 'Patroclo Isaac', 'Newton de la Vega', 'CC', '3139749347824', 28426489248, 'nose@gmail', '3628468242', NULL, 2147483647, 'no aplico', 'O+', 457, 'estornudadera', 'al mani'),
(4, 'juandavicho', 'facilito', 'CC', '37824629840', 31127264284, 'izilito@gmail', 'la menos segura', NULL, 2147483647, 'corvesalu', 'AB+', 2147483647, 'patear el valon peor que un burro', 'todas'),
(5, 'julian', 'martines', 'CC', '3247468274', 39247294, 'juliaaan@gmail', 'error 404', NULL, 7, 'que disque famisanar', 'A-', 1234567, 'patas de palo', 'la caña de azucar'),
(6, 'María', 'Rodríguez', 'CC', '12345678', 1234567890, 'maria@example.com', 'password123', '', 0, 'Sanitas', 'A+', 2147483647, 'Diabetes', 'Ninguna'),
(7, 'Juan', 'Pérez', 'CC', '23456789', 2345678901, ' juan@example.com', 'securepass321', NULL, 0, 'famisanar', 'O+', 2147483647, 'Hipertensión', 'Penicilina'),
(8, 'Laura', 'Gómez', 'CC', '34567890', 3456789012, 'laura@example.com', 'mypass123', NULL, 0, 'famisanar', 'B-', 2147483647, 'Asma', 'Nueces'),
(9, 'Carlos', 'Martínez', 'CC', '45678901', 4567890123, 'carlos@example.com', '123456abc', NULL, 0, 'sanitas', 'A-', 2147483647, 'Artritis', 'Mariscos'),
(13, 'CHAMO', 'MOISES', 'CC', '1077889910', 3133143151, 'CHAMOLOCO@VENECO.COM', 'JETSHO', 0x3939393939393939, 1100220, 'CEMENTERIO', 'AB+', 987654321, 'exceso de amvre', 'a la comida');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `actualizar_usuario` AFTER UPDATE ON `usuarios` FOR EACH ROW begin
INSERT into auditoria (
    usuario,
    fecha,
    evento,
    nombre_nuevo,
    nombre_viejo,
    apellido_nuevo,
    apellido_viejo,
    tipo_documento_nuevo,
    tipo_documento_viejo,
    numero_documento_nuevo,
    numero_documento_viejo,
    telefono_nuevo,
    telefono_viejo,
    email_nuevo,
    email_viejo,
    contrasena_nuevo,
    contrasena_viejo,
    huella_nuevo,
    huella_viejo,
    codigo_nuevo,
    codigo_viejo,
    eps_nuevo,
    eps_viejo,
    rh_nuevo,
    rh_viejo,
    contacto_emergencia_nuevo,
    contacto_emergencia_viejo,
    enfermedades_nuevo,
    enfermedades_viejo,
    alergias_nuevo,
    alergias_viejo,
    observaciones
) values (
    user(),
    now(),
    "UPDATE",
    new.nombres,
    old.nombres,
    new.apellidos,
    old.apellidos,
    new.tipo_documento,
    old.tipo_documento,
    new.numero_documento,
    old.numero_documento,
    new.telefono,
    old.telefono,
    new.email,
    old.email,
    new.contrasena,
    old.contrasena,
    new.huella,
    old.huella,
    new.codigo,
    old.codigo,
    new.eps,
    old.eps,
    new.rh,
    old.rh,
    new.contacto_emergencia,
    old.contacto_emergencia,
    new.enfermedades,
    old.enfermedades,
    new.alergias,
    old.alergias,
    concat("Se ha modificado un usuario por parte de :", user()) );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminar_usuario` AFTER DELETE ON `usuarios` FOR EACH ROW begin
INSERT into auditoria (
    usuario,
    fecha,
    evento,
    nombre_nuevo,
    nombre_viejo,
    apellido_nuevo,
    apellido_viejo,
    tipo_documento_nuevo,
    tipo_documento_viejo,
    numero_documento_nuevo,
    numero_documento_viejo,
    telefono_nuevo,
    telefono_viejo,
    email_nuevo,
    email_viejo,
    contrasena_nuevo,
    contrasena_viejo,
    huella_nuevo,
    huella_viejo,
    codigo_nuevo,
    codigo_viejo,
    eps_nuevo,
    eps_viejo,
    rh_nuevo,
    rh_viejo,
    contacto_emergencia_nuevo,
    contacto_emergencia_viejo,
    enfermedades_nuevo,
    enfermedades_viejo,
    alergias_nuevo,
    alergias_viejo,
    observaciones
) values (
    user(),
    now(),
    "DELETE",
    DEFAULT,
    old.nombres,
    DEFAULT,
    old.apellidos,
    DEFAULT,
    old.tipo_documento,
    DEFAULT,
    old.numero_documento,
    DEFAULT,
    old.telefono,
    DEFAULT,
    old.email,
    DEFAULT,
    old.contrasena,
    DEFAULT,
    old.huella,
    DEFAULT,
    old.codigo,
    DEFAULT,
    old.eps,
    DEFAULT,
    old.rh,
    DEFAULT,
    old.contacto_emergencia,
    DEFAULT,
    old.enfermedades,
    DEFAULT,
    old.alergias,
    concat("Se ha Eliminado un usuario por parte de :", user()) );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminar_usuario_total` BEFORE DELETE ON `usuarios` FOR EACH ROW BEGIN
  	
    -- Eliminar registros relacionados en la tabla 'ingresosalida_ficha'
    DELETE FROM ingresosalida_ficha WHERE id_usuario = OLD.id;

-- Eliminar registros relacionados en la tabla 'controlfuncionarios'
    DELETE FROM controlfuncionarios WHERE id_usuario = OLD.id;

   -- Eliminar registros relacionados en la tabla 'usuario_perfil'
    DELETE FROM usuario_perfil WHERE id_usuario = OLD.id;

-- Eliminar registros relacionados en la tabla 'aprendiz'
    DELETE FROM aprendiz WHERE id_usuario = OLD.id;
    
    -- Eliminar registros relacionados en la tabla 'instructor'
    DELETE FROM instructor WHERE id_usuario = OLD.id;

    -- Eliminar registros relacionados en la tabla 'funcionario'
     
     DELETE FROM funcionario WHERE id_usuario = OLD.id;
    
    
 END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ingreso_nuevo_usuario` AFTER INSERT ON `usuarios` FOR EACH ROW begin
INSERT into auditoria (
    usuario,
    fecha,
    evento,
    nombre_nuevo,
    apellido_nuevo,
    tipo_documento_nuevo,
    numero_documento_nuevo,
    telefono_nuevo,
    email_nuevo,
    contrasena_nuevo,
    huella_nuevo,
    codigo_nuevo,
    eps_nuevo,
    rh_nuevo,
    contacto_emergencia_nuevo,
    enfermedades_nuevo,
    alergias_nuevo,
    observaciones
) values (
    user(),
    now(),
    "INSERT",
    new.nombres,
    new.apellidos,
    new.tipo_documento,
    new.numero_documento,
    new.telefono,
    new.email,
    new.contrasena,
    new.huella,
    new.codigo,
    new.eps,
    new.rh,
    new.contacto_emergencia,
    new.enfermedades,
    new.alergias,
    concat("Se ha ingresado un nuevo usuario por parte de :", user()) );
END
$$
DELIMITER ;

DELIMITER $$

CREATE TRIGGER after_insert_usuario
AFTER INSERT ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO usuario_perfil (id_usuario, id_perfil)
    VALUES (NEW.id,1);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_perfil`
--

CREATE TABLE `usuario_perfil` (
  `id_usuario` int(11) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_perfil`
--

INSERT INTO `usuario_perfil` (`id_usuario`, `id_perfil`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 2),
(7, 2),
(8, 2),
(9, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD KEY `fk_id_usuario_aprendiz` (`id_usuario`),
  ADD KEY `fk_codigo_numeroficha_aprendiz` (`codigo_numeroficha`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `controlfuncionarios`
--
ALTER TABLE `controlfuncionarios`
  ADD KEY `fk_controlfuncionario_usuarioperf` (`id_usuario`);

--
-- Indices de la tabla `funcion`
--
ALTER TABLE `funcion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD KEY `fk_id_usuario_funcion` (`id_usuario`),
  ADD KEY `fk_id_funcion_usuario` (`id_funcion`);

--
-- Indices de la tabla `ingresosalida_ficha`
--
ALTER TABLE `ingresosalida_ficha`
  ADD KEY `fk_id_usuario_ingresosalida` (`id_usuario`),
  ADD KEY `fk_codigo_numeroficha_ingresosalida` (`codigo_numeroficha`);

--
-- Indices de la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD KEY `fk__id_usuario_instructor` (`id_usuario`),
  ADD KEY `fk_codigo_numeroficha_instructor` (`codigo_numeroficha`);

--
-- Indices de la tabla `numero_ficha`
--
ALTER TABLE `numero_ficha`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_id_programa` (`id_programa`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_tipo_programa` (`id_tipo_programa`);

--
-- Indices de la tabla `tipo_programa`
--
ALTER TABLE `tipo_programa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  ADD KEY `fk_id_usuario_perfil` (`id_usuario`),
  ADD KEY `fk_id_perfil_usuario` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `funcion`
--
ALTER TABLE `funcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9753574;

--
-- AUTO_INCREMENT de la tabla `tipo_programa`
--
ALTER TABLE `tipo_programa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD CONSTRAINT `fk_codigo_numeroficha_aprendiz` FOREIGN KEY (`codigo_numeroficha`) REFERENCES `numero_ficha` (`codigo`),
  ADD CONSTRAINT `fk_id_usuario_aprendiz` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `controlfuncionarios`
--
ALTER TABLE `controlfuncionarios`
  ADD CONSTRAINT `fk_controlfuncionario_usuarioperf` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_perfil` (`id_usuario`);

--
-- Filtros para la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_id_funcion_usuario` FOREIGN KEY (`id_funcion`) REFERENCES `funcion` (`id`),
  ADD CONSTRAINT `fk_id_usuario_funcion` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `ingresosalida_ficha`
--
ALTER TABLE `ingresosalida_ficha`
  ADD CONSTRAINT `fk_codigo_numeroficha_ingresosalida` FOREIGN KEY (`codigo_numeroficha`) REFERENCES `numero_ficha` (`codigo`),
  ADD CONSTRAINT `fk_id_usuario_ingresosalida` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_perfil` (`id_usuario`);

--
-- Filtros para la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `fk__id_usuario_instructor` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `fk_codigo_numeroficha_instructor` FOREIGN KEY (`codigo_numeroficha`) REFERENCES `numero_ficha` (`codigo`);

--
-- Filtros para la tabla `numero_ficha`
--
ALTER TABLE `numero_ficha`
  ADD CONSTRAINT `fk_id_programa` FOREIGN KEY (`id_programa`) REFERENCES `programa` (`id`);

--
-- Filtros para la tabla `programa`
--
ALTER TABLE `programa`
  ADD CONSTRAINT `fk_id_tipo_programa` FOREIGN KEY (`id_tipo_programa`) REFERENCES `tipo_programa` (`id`);

--
-- Filtros para la tabla `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  ADD CONSTRAINT `fk_id_perfil_usuario` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`),
  ADD CONSTRAINT `fk_id_usuario_perfil` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;