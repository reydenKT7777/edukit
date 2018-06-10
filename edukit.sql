-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-04-2018 a las 20:59:48
-- Versión del servidor: 5.7.21-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `edukit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion`
--

CREATE TABLE `administracion` (
  `id` int(15) NOT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `persona_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administracion`
--

INSERT INTO `administracion` (`id`, `cargo`, `persona_id`) VALUES
(1, 'Administrador', 1),
(2, 'coordinador primaria', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_docente`
--

CREATE TABLE `asistencia_docente` (
  `id` int(15) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora_ingreso` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `tipo_asistencia` varchar(15) DEFAULT NULL,
  `observacion` varchar(150) DEFAULT NULL,
  `profesor_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_estudiante`
--

CREATE TABLE `asistencia_estudiante` (
  `id` int(15) NOT NULL,
  `fecha` date DEFAULT NULL,
  `tipo_asistencia` varchar(12) DEFAULT NULL,
  `observacion` varchar(150) DEFAULT NULL,
  `estudiante_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque_notas`
--

CREATE TABLE `bloque_notas` (
  `id` int(15) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `fondo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id` int(15) NOT NULL,
  `nota` float DEFAULT NULL,
  `etapa` int(1) DEFAULT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `bloque_notas_id` int(15) NOT NULL,
  `inscripcion_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(15) NOT NULL,
  `grado` int(1) DEFAULT NULL,
  `nivel` varchar(45) DEFAULT NULL,
  `paralelo` char(1) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `grado`, `nivel`, `paralelo`, `estado`) VALUES
(1, 1, 'secundario', 'A', 1),
(2, 2, 'secundario', 'B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disciplina_docente`
--

CREATE TABLE `disciplina_docente` (
  `id` int(15) NOT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `profesor_id` int(15) NOT NULL,
  `administracion_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disciplina_estudiante`
--

CREATE TABLE `disciplina_estudiante` (
  `id` int(15) NOT NULL,
  `fecha` date DEFAULT NULL,
  `nivel` int(5) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `ref_receptor` varchar(15) DEFAULT NULL,
  `estudiante_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id` int(15) NOT NULL,
  `persona_id` int(15) NOT NULL,
  `tutor_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id`, `persona_id`, `tutor_id`) VALUES
(1, 5, 1),
(2, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id` int(15) NOT NULL,
  `gestion` date DEFAULT NULL,
  `curso_id` int(15) NOT NULL,
  `estudiante_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id`, `gestion`, `curso_id`, `estudiante_id`) VALUES
(1, '2018-04-17', 1, 1),
(2, '2018-04-17', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id` int(15) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `curso_id` int(15) NOT NULL,
  `profesor_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(15) NOT NULL,
  `ref_receptor` int(15) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `contenido` text,
  `archivo_adj` datetime DEFAULT NULL,
  `visto` tinyint(4) DEFAULT NULL,
  `tipo_mensaje` int(1) DEFAULT NULL,
  `persona_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensualidad`
--

CREATE TABLE `mensualidad` (
  `id` int(15) NOT NULL,
  `importe` double DEFAULT NULL,
  `mes` char(2) DEFAULT NULL,
  `gestion` char(4) DEFAULT NULL,
  `estado_pago` varchar(50) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `estudiante_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(15) NOT NULL,
  `contenido` text,
  `fecha` datetime DEFAULT NULL,
  `archivo_adj` varchar(255) DEFAULT NULL,
  `ref_visualizacion` int(15) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `persona_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(15) NOT NULL,
  `a_paterno` varchar(30) DEFAULT NULL,
  `a_materno` varchar(45) DEFAULT NULL,
  `nombres` varchar(60) DEFAULT NULL,
  `ci` varchar(10) DEFAULT NULL,
  `exp` char(5) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `telf` varchar(8) DEFAULT NULL,
  `telf_opc` varchar(8) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `f_nacimiento` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `usuario_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `a_paterno`, `a_materno`, `nombres`, `ci`, `exp`, `sexo`, `telf`, `telf_opc`, `direccion`, `f_nacimiento`, `estado`, `usuario_id`) VALUES
(1, 'castro', 'lopez', 'jose pablo', '1111111', 'LP', 'm', '76543210', '', 'carretera viacha', '2018-04-01', 1, 1),
(2, 'arce', 'perez', 'isaac', '1111112', 'LP', 'F', '76543210', '', 'urb.leoncio', '2018-04-01', 1, 2),
(3, 'almorin', 'torrejon', 'elder', '1111113', 'LP', 'm', '76543210', '', 'carretera viacha', '2018-04-01', 1, 3),
(4, 'alvarez', 'romero', 'segundo oscar', '1111114', 'LP', 'm', '76543210', '', 'urb.leoncio', '2018-04-01', 1, 4),
(5, 'aguilar', 'mamani', 'steffi hortencia', '1111115', 'LP', 'F', '76543210', '', 'carretera viacha', '2018-04-01', 1, 5),
(6, 'alvarez', 'huaqui', 'maria kaila', '1111116', 'LP', 'F', '76543210', '', 'urb.leoncio', '2018-04-01', 1, 6),
(7, 'laura', 'landivar', 'manuel', '1111117', 'LP', 'm', '76543210', '', 'carretera viacha', '2018-04-01', 1, 7),
(8, 'huamanchumo', 'leyton', 'maria cristina', '1111118', 'LP', 'F', '76543210', '', 'urb.leoncio', '2018-04-01', 1, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id` int(15) NOT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `persona_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `especialidad`, `persona_id`) VALUES
(1, 'matematica', 3),
(2, 'literatura', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE `tutor` (
  `id` int(15) NOT NULL,
  `parentesco` varchar(45) DEFAULT NULL,
  `persona_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id`, `parentesco`, `persona_id`) VALUES
(1, 'padre', 7),
(2, 'madre', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(15) NOT NULL,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `contrasena` varchar(150) DEFAULT NULL,
  `sesion` tinyint(4) DEFAULT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `f_modificacion` timestamp NULL DEFAULT NULL,
  `activacion_cuenta` tinyint(4) DEFAULT NULL,
  `foto_perfil` varchar(45) DEFAULT NULL,
  `rol` int(1) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre_usuario`, `contrasena`, `sesion`, `correo_electronico`, `f_modificacion`, `activacion_cuenta`, `foto_perfil`, `rol`, `estado`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, 'admin@admin.com', '2018-04-17 08:00:00', 1, 'assets/images/avatar/20180417admin.jpg', 1, 1),
(2, 'cordi', '6771d0d87b7c4de871a88f938498e7578f06277c', 0, 'cordi@cordi.com', '2018-04-17 08:00:00', 1, 'assets/images/avatar/20180417admin.jpg', 1, 1),
(3, 'elder', 'd9f02d46be016f1b301f7c02a4b9c4ebe0dde7ef', 0, 'admin@admin.com', '2018-04-17 08:00:00', 1, 'assets/images/avatar/20180417admin.jpg', 2, 1),
(4, 'oscar', 'd9f02d46be016f1b301f7c02a4b9c4ebe0dde7ef', 0, 'cordi@cordi.com', '2018-04-17 08:00:00', 1, 'assets/images/avatar/20180417admin.jpg', 2, 1),
(5, 'steffi', '96281f7d23fb17a5b844b114de9f1a708ea3d9df', 0, 'admin@admin.com', '2018-04-17 08:00:00', 1, 'assets/images/avatar/20180417admin.jpg', 3, 1),
(6, 'maria', '96281f7d23fb17a5b844b114de9f1a708ea3d9df', 0, 'cordi@cordi.com', '2018-04-17 08:00:00', 1, 'assets/images/avatar/20180417admin.jpg', 3, 1),
(7, 'manuel', 'a9bd7a5b583cbe082e2c850595c71a6818626f10', 0, 'admin@admin.com', '2018-04-17 08:00:00', 1, 'assets/images/avatar/20180417admin.jpg', 4, 1),
(8, 'cristina', 'a9bd7a5b583cbe082e2c850595c71a6818626f10', 0, 'cordi@cordi.com', '2018-04-17 08:00:00', 1, 'assets/images/avatar/20180417admin.jpg', 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_administracion_persona1_idx` (`persona_id`);

--
-- Indices de la tabla `asistencia_docente`
--
ALTER TABLE `asistencia_docente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asistencia_docente_profesor1_idx` (`profesor_id`);

--
-- Indices de la tabla `asistencia_estudiante`
--
ALTER TABLE `asistencia_estudiante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asistencia_estudiante_estudiante1_idx` (`estudiante_id`);

--
-- Indices de la tabla `bloque_notas`
--
ALTER TABLE `bloque_notas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_calificacion_bloque_notas1_idx` (`bloque_notas_id`),
  ADD KEY `fk_calificacion_inscripcion1_idx` (`inscripcion_id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `disciplina_docente`
--
ALTER TABLE `disciplina_docente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_disciplina_docente_profesor1_idx` (`profesor_id`),
  ADD KEY `fk_disciplina_docente_administracion1_idx` (`administracion_id`);

--
-- Indices de la tabla `disciplina_estudiante`
--
ALTER TABLE `disciplina_estudiante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_disciplina_estudiante_estudiante1_idx` (`estudiante_id`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estudiante_persona1_idx` (`persona_id`),
  ADD KEY `fk_estudiante_tutor1_idx` (`tutor_id`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inscripcion_curso1_idx` (`curso_id`),
  ADD KEY `fk_inscripcion_estudiante1_idx` (`estudiante_id`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_materia_curso1_idx` (`curso_id`),
  ADD KEY `fk_materia_profesor1_idx` (`profesor_id`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mensaje_persona1_idx` (`persona_id`);

--
-- Indices de la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mensualidad_estudiante1_idx` (`estudiante_id`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_noticia_persona1_idx` (`persona_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_persona_usuario_idx` (`usuario_id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_profesor_persona1_idx` (`persona_id`);

--
-- Indices de la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tutor_persona1_idx` (`persona_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administracion`
--
ALTER TABLE `administracion`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `asistencia_docente`
--
ALTER TABLE `asistencia_docente`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `asistencia_estudiante`
--
ALTER TABLE `asistencia_estudiante`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `bloque_notas`
--
ALTER TABLE `bloque_notas`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `disciplina_docente`
--
ALTER TABLE `disciplina_docente`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `disciplina_estudiante`
--
ALTER TABLE `disciplina_estudiante`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD CONSTRAINT `fk_administracion_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia_docente`
--
ALTER TABLE `asistencia_docente`
  ADD CONSTRAINT `fk_asistencia_docente_profesor1` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia_estudiante`
--
ALTER TABLE `asistencia_estudiante`
  ADD CONSTRAINT `fk_asistencia_estudiante_estudiante1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `fk_calificacion_bloque_notas1` FOREIGN KEY (`bloque_notas_id`) REFERENCES `bloque_notas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_calificacion_inscripcion1` FOREIGN KEY (`inscripcion_id`) REFERENCES `inscripcion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `disciplina_docente`
--
ALTER TABLE `disciplina_docente`
  ADD CONSTRAINT `fk_disciplina_docente_administracion1` FOREIGN KEY (`administracion_id`) REFERENCES `administracion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_disciplina_docente_profesor1` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `disciplina_estudiante`
--
ALTER TABLE `disciplina_estudiante`
  ADD CONSTRAINT `fk_disciplina_estudiante_estudiante1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_estudiante_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estudiante_tutor1` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `fk_inscripcion_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscripcion_estudiante1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `fk_materia_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materia_profesor1` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_mensaje_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
  ADD CONSTRAINT `fk_mensualidad_estudiante1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `fk_noticia_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_persona_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `fk_profesor_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `fk_tutor_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
