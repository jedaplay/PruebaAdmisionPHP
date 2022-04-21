-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-04-2022 a las 07:40:33
-- Versión del servidor: 5.7.37
-- Versión de PHP: 7.4.28

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ipscdo_atestbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` smallint(1) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 CHECKSUM=1 COLLATE=utf8mb4_spanish_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`) VALUES(1, 'HUILA');
INSERT INTO `departamentos` (`id`, `nombre`) VALUES(2, 'META');
INSERT INTO `departamentos` (`id`, `nombre`) VALUES(3, 'TOLIMA');
INSERT INTO `departamentos` (`id`, `nombre`) VALUES(4, 'CAUCA');
INSERT INTO `departamentos` (`id`, `nombre`) VALUES(5, 'CAQUETA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id` smallint(1) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 CHECKSUM=1 COLLATE=utf8mb4_spanish_ci DELAY_KEY_WRITE=1 ROW_FORMAT=COMPRESSED;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `nombre`) VALUES(1, 'MASCULINO');
INSERT INTO `genero` (`id`, `nombre`) VALUES(2, 'FEMENINO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` smallint(1) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `departamento_id` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 CHECKSUM=1 COLLATE=utf8mb4_spanish_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`) VALUES(1, 'NEIVA', 1);
INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`) VALUES(2, 'PALERMO', 1);
INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`) VALUES(3, 'VILLAVICENCIO', 2);
INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`) VALUES(4, 'EL DORADO', 2);
INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`) VALUES(5, 'IBAGUÉ', 3);
INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`) VALUES(6, 'ESPINAL', 3);
INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`) VALUES(7, 'POPAYÁN', 4);
INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`) VALUES(8, 'CORINTO', 4);
INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`) VALUES(9, 'FLORENCIA', 5);
INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`) VALUES(10, 'EL DONCELLO', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(1) NOT NULL,
  `tipo_documento` smallint(1) DEFAULT NULL,
  `numero_documento` int(1) DEFAULT NULL,
  `nombre1` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nombre2` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `apellido1` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `apellido2` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `genero_id` smallint(1) DEFAULT NULL,
  `departamento_id` smallint(1) DEFAULT NULL,
  `municipio_id` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 CHECKSUM=1 COLLATE=utf8mb4_spanish_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `tipo_documento`, `numero_documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `genero_id`, `departamento_id`, `municipio_id`) VALUES(1, 1, 7726544, 'JESUS', 'DAVID', 'CASTAÑEDA', 'QUINTERO', 1, 1, 2);
INSERT INTO `paciente` (`id`, `tipo_documento`, `numero_documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `genero_id`, `departamento_id`, `municipio_id`) VALUES(2, 1, 8930222, 'KAREN', 'YULIETH', 'SOLANO', 'ROJAS', 2, NULL, 7);
INSERT INTO `paciente` (`id`, `tipo_documento`, `numero_documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `genero_id`, `departamento_id`, `municipio_id`) VALUES(3, 1, 26533436, 'JUAN', 'CAMILO', 'ROJAS', 'CABRERA', 1, NULL, 1);
INSERT INTO `paciente` (`id`, `tipo_documento`, `numero_documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `genero_id`, `departamento_id`, `municipio_id`) VALUES(4, 1, 8990334, 'SEBASTIAN', NULL, 'LAGUNA', 'QUINTERO', 1, NULL, 4);
INSERT INTO `paciente` (`id`, `tipo_documento`, `numero_documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `genero_id`, `departamento_id`, `municipio_id`) VALUES(5, 1, 18992254, 'MARIA', 'CAMILA', 'VARGAS', 'MORALES', 2, NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id` int(11) NOT NULL,
  `Id_fabricante` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Id_producto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Descripcion` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio` int(1) DEFAULT NULL,
  `existencia` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 CHECKSUM=1 COLLATE=utf8mb4_spanish_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id`, `Id_fabricante`, `Id_producto`, `Descripcion`, `precio`, `existencia`) VALUES(1, 'Aci', '41001', 'Aguja', 58, 227);
INSERT INTO `productos` (`Id`, `Id_fabricante`, `Id_producto`, `Descripcion`, `precio`, `existencia`) VALUES(2, 'Aci', '41002', 'Micropore', 80, 150);
INSERT INTO `productos` (`Id`, `Id_fabricante`, `Id_producto`, `Descripcion`, `precio`, `existencia`) VALUES(3, 'Aci', '41003', 'Gasa', 112, 80);
INSERT INTO `productos` (`Id`, `Id_fabricante`, `Id_producto`, `Descripcion`, `precio`, `existencia`) VALUES(4, 'Aci', '41004', 'Equipo macrogoteo', 110, 50);
INSERT INTO `productos` (`Id`, `Id_fabricante`, `Id_producto`, `Descripcion`, `precio`, `existencia`) VALUES(5, 'Bic', '41003', 'Curas', 120, 20);
INSERT INTO `productos` (`Id`, `Id_fabricante`, `Id_producto`, `Descripcion`, `precio`, `existencia`) VALUES(6, 'Inc', '41089', 'Canaleta', 500, 30);
INSERT INTO `productos` (`Id`, `Id_fabricante`, `Id_producto`, `Descripcion`, `precio`, `existencia`) VALUES(7, 'Osa', 'Xk47', 'Compresa', 150, 200);
INSERT INTO `productos` (`Id`, `Id_fabricante`, `Id_producto`, `Descripcion`, `precio`, `existencia`) VALUES(8, 'Bic', 'Xk47', 'Compresa', 200, 200);
INSERT INTO `productos` (`Id`, `Id_fabricante`, `Id_producto`, `Descripcion`, `precio`, `existencia`) VALUES(9, 'Bic', '41003', 'Curas', 120, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documento`
--

CREATE TABLE `tipos_documento` (
  `id` smallint(6) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 CHECKSUM=1 COLLATE=utf8mb4_spanish_ci DELAY_KEY_WRITE=1 ROW_FORMAT=COMPRESSED;

--
-- Volcado de datos para la tabla `tipos_documento`
--

INSERT INTO `tipos_documento` (`id`, `nombre`) VALUES(1, 'Cédula de ciudadanía');
INSERT INTO `tipos_documento` (`id`, `nombre`) VALUES(2, 'Cédula extrajera');
INSERT INTO `tipos_documento` (`id`, `nombre`) VALUES(3, 'Tarjeta de identidad');
INSERT INTO `tipos_documento` (`id`, `nombre`) VALUES(4, 'Número único de identificación');
INSERT INTO `tipos_documento` (`id`, `nombre`) VALUES(5, 'Pasaporte');
INSERT INTO `tipos_documento` (`id`, `nombre`) VALUES(6, 'Permiso especial');
INSERT INTO `tipos_documento` (`id`, `nombre`) VALUES(7, 'Registro civil');
INSERT INTO `tipos_documento` (`id`, `nombre`) VALUES(9, 'Menor sin identificación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usu`
--

CREATE TABLE `usu` (
  `Codigo` smallint(1) NOT NULL,
  `Perfil` bigint(4) DEFAULT NULL,
  `Tipo` smallint(1) DEFAULT NULL,
  `Activo` tinyint(1) DEFAULT NULL,
  `Nick` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Clave` varchar(40) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Documento` varchar(15) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Nombre` varchar(150) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Cargo` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Intento` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `Tintento` int(10) DEFAULT '0',
  `FIngreso` datetime DEFAULT NULL,
  `FCreacion` date DEFAULT NULL,
  `Foto` varchar(150) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Firma` varchar(150) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Direccion` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Barrio` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Telefono` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Celular` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `FechaNac` date DEFAULT NULL,
  `Genero` smallint(1) DEFAULT NULL,
  `Titulo` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Universidad` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `TarjProfNo` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `TarjProfFecha` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Verificacion` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `LicenciaOcupNo` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Sede` smallint(1) DEFAULT NULL,
  `UsuC0` smallint(1) DEFAULT NULL,
  `FechaC0` datetime DEFAULT NULL,
  `UsuU0` smallint(1) DEFAULT NULL,
  `FechaU0` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 CHECKSUM=1 COLLATE=utf8mb4_spanish_ci DELAY_KEY_WRITE=1 ROW_FORMAT=COMPRESSED;

--
-- Volcado de datos para la tabla `usu`
--

INSERT INTO `usu` (`Codigo`, `Perfil`, `Tipo`, `Activo`, `Nick`, `Clave`, `Documento`, `Nombre`, `Cargo`, `Intento`, `Tintento`, `FIngreso`, `FCreacion`, `Foto`, `Firma`, `Direccion`, `Barrio`, `Telefono`, `Celular`, `Email`, `FechaNac`, `Genero`, `Titulo`, `Universidad`, `TarjProfNo`, `TarjProfFecha`, `Verificacion`, `LicenciaOcupNo`, `Sede`, `UsuC0`, `FechaC0`, `UsuU0`, `FechaU0`) VALUES(701, 1, 1, 1, 'administrador', 'e807f1fcf82d132f9bb018ca6738a19f', '7726544', 'JESUS DAVID CASTAÑEDA QUINTERO', 'PROGRAMADOR', '0', 0, '2022-04-21 07:35:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_municipios` (`departamento_id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_paciente` (`genero_id`),
  ADD KEY `FK_paciente2` (`departamento_id`),
  ADD KEY `FK_paciente4` (`municipio_id`),
  ADD KEY `FK_paciente3` (`tipo_documento`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tipos_documento`
--
ALTER TABLE `tipos_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usu`
--
ALTER TABLE `usu`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `FK_usu` (`Perfil`),
  ADD KEY `FK_usu2` (`Tipo`),
  ADD KEY `FK_usu3` (`Activo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipos_documento`
--
ALTER TABLE `tipos_documento`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `FK_municipios` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `FK_paciente` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_paciente2` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_paciente3` FOREIGN KEY (`tipo_documento`) REFERENCES `tipos_documento` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_paciente4` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usu`
--
ALTER TABLE `usu`
  ADD CONSTRAINT `FK_usu` FOREIGN KEY (`Perfil`) REFERENCES `ipscdo_atest`.`usu_perfil` (`Codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_usu2` FOREIGN KEY (`Tipo`) REFERENCES `ipscdo_atest`.`usu_tipo` (`Codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_usu3` FOREIGN KEY (`Activo`) REFERENCES `ipscdo_atest`.`sino` (`Codigo`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
