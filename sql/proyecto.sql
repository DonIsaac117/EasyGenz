-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-07-2024 a las 20:58:24
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `easygenz`
--

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
  `eps` enum('ESS024','EPS037','ESS207','EPS001','EPS002','EPS005','EPS010','EPS017','EPS018','EPS046','EPS012','EPS008','EAS016','EAS027','CCF055','EPS025','CCF102','CCF050','CCF033','ESS062','ESS118','EPSS34','EPSS40','EPSI01','EPSI03','EPSI04','EPSI05','EPSI06','EPS047') DEFAULT NULL,
  `rh` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `contacto_emergencia` int(20) DEFAULT NULL,
  `enfermedades` varchar(100) DEFAULT NULL,
  `alergias` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `tipo_documento`, `numero_documento`, `telefono`, `email`, `contrasena`, `huella`, `codigo`, `eps`, `rh`, `contacto_emergencia`, `enfermedades`, `alergias`) VALUES
(1, 'yo merito', ':v', 'CC', '1077967033', 3114829214, 'johand0620@gmail.com', '12', 0x76585657, 123456789, '', 'AB+', 27184783, 'exceso de facha', 'a los 🧒🏿'),
(2, 'chiki fulvo', 'messi:v', 'TI', '1016000066', 666, 'fifa2585@fulvo.com', '123456789', NULL, 12345678, '', 'A-', 1122334455, 'solo cuando no hay fulvo', 'a juancho'),
(3, 'Patroclo Isaac', 'Newton de la Vega', 'CC', '3139749347824', 28426489248, 'nose@gmail', '3628468242', NULL, 2147483647, '', 'O+', 457, 'estornudadera', 'al mani'),
(4, 'juandavicho', 'facilito', 'CC', '37824629840', 31127264284, 'izilito@gmail', 'la menos segura', NULL, 2147483647, '', 'AB+', 2147483647, 'patear el valon peor que un burro', 'todas'),
(5, 'julian', 'martines', 'CC', '3247468274', 39247294, 'juliaaan@gmail', 'error 404', NULL, 7, '', 'A-', 1234567, 'patas de palo', 'la caña de azucar'),
(6, 'María', 'Rodríguez', 'CC', '12345678', 1234567890, 'maria@example.com', 'password123', '', 0, '', 'A+', 2147483647, 'Diabetes', 'Ninguna'),
(7, 'Juan', 'Pérez', 'CC', '23456789', 2345678901, ' juan@example.com', 'securepass321', NULL, 0, '', 'O+', 2147483647, 'Hipertensión', 'Penicilina'),
(8, 'Laura', 'Gómez', 'CC', '34567890', 3456789012, 'laura@example.com', 'mypass123', NULL, 0, '', 'B-', 2147483647, 'Asma', 'Nueces'),
(9, 'Carlos', 'Martínez', 'CC', '45678901', 4567890123, 'carlos@example.com', '123456abc', NULL, 0, '', 'A-', 2147483647, 'Artritis', 'Mariscos'),
(13, 'CHAMO', 'MOISES', 'CC', '1077889910', 3133143151, 'CHAMOLOCO@VENECO.COM', 'JETSHO', 0x3939393939393939, 1100220, '', 'AB+', 987654321, 'exceso de amvre', 'a la comida'),
(25, 'julian', 'ramirez', 'CC', '432543', 4354325, 'julian@gmail.com', '4325', NULL, NULL, '', 'A-', 2345, 'erter', 'gfwer'),
(26, 'julian', 'ramirez', 'CC', '134124', 234324, 'julian@gmail.com', '1324321', NULL, NULL, '', 'AB+', 123413, 'sdfgs', 'qwe'),
(27, 'julian', 'ramirez', 'CC', '2344', 342543, 'j7u@gmail.com', '13243', NULL, NULL, '', 'AB+', 2435243, 'gfd', 'dgf'),
(49, 'johan', 'betancur', 'CC', '526632771', 456977425, 'johand0620@gmail.com', '123456', NULL, NULL, '', 'A+', 123456, 'GASTRITIS ', 'SI'),
(50, 'johan', 'betancur', 'TI', '1344312', 432432, 'gfhgfdhgfq@gmail.com', '3214214', NULL, NULL, '', 'AB+', 876585, 'tyytu', 'tyuity');

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
    -- Eliminar registros relacionados en la tabla 'aprendiz'
    DELETE FROM aprendiz WHERE id_usuario = OLD.id;
    
    -- Eliminar registros relacionados en la tabla 'instructor'
    DELETE FROM instructor WHERE id_usuario = OLD.id;
    
    -- Eliminar registros relacionados en la tabla 'usuario_perfil'
    DELETE FROM usuario_perfil WHERE id_usuario = OLD.id;
    
    -- Eliminar registros relacionados en la tabla 'controlfuncionarios'
    DELETE FROM controlfuncionarios WHERE id_usuario = OLD.id;
    
    -- Eliminar registros relacionados en la tabla 'funcionario'
     
     DELETE FROM funcionario WHERE id_usuario = OLD.id;
    
    
    -- Eliminar registros relacionados en la tabla 'ingresosalida_ficha'
    DELETE FROM ingresosalida_ficha WHERE id_usuario = OLD.id;
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
    new.eps,
    new.rh,
    new.contacto_emergencia,
    new.enfermedades,
    new.alergias,
    concat("Se ha ingresado un nuevo usuario por parte de :", user()) );
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
