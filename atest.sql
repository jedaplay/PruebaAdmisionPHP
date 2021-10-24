/*
SQLyog Enterprise - MySQL GUI v6.15
MySQL - 5.7.11 : Database - atest
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `atest`;

USE `atest`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `departamentos` */

CREATE TABLE `departamentos` (
  `id` smallint(1) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `departamentos` */

insert  into `departamentos`(`id`,`nombre`) values (1,'HUILA'),(2,'META'),(3,'TOLIMA'),(4,'CAUCA'),(5,'CAQUETA');

/*Table structure for table `genero` */

CREATE TABLE `genero` (
  `id` smallint(1) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPRESSED;

/*Data for the table `genero` */

insert  into `genero`(`id`,`nombre`) values (1,'MASCULINO'),(2,'FEMENINO');

/*Table structure for table `municipios` */

CREATE TABLE `municipios` (
  `id` smallint(1) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `departamento_id` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_municipios` (`departamento_id`),
  CONSTRAINT `FK_municipios` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `municipios` */

insert  into `municipios`(`id`,`nombre`,`departamento_id`) values (1,'NEIVA',1),(2,'PALERMO',1),(3,'VILLAVICENCIO',2),(4,'EL DORADO',2),(5,'IBAGUÉ',3),(6,'ESPINAL',3),(7,'POPAYÁN',4),(8,'CORINTO',4),(9,'FLORENCIA',5),(10,'EL DONCELLO',5);

/*Table structure for table `paciente` */

CREATE TABLE `paciente` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `tipo_documento` smallint(1) DEFAULT NULL,
  `numero_documento` int(1) DEFAULT NULL,
  `nombre1` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido1` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `genero_id` smallint(1) DEFAULT NULL,
  `departamento_id` smallint(1) DEFAULT NULL,
  `municipio_id` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_paciente` (`genero_id`),
  KEY `FK_paciente2` (`departamento_id`),
  KEY `FK_paciente4` (`municipio_id`),
  KEY `FK_paciente3` (`tipo_documento`),
  CONSTRAINT `FK_paciente` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_paciente2` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_paciente3` FOREIGN KEY (`tipo_documento`) REFERENCES `tipos_documento` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_paciente4` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `paciente` */

insert  into `paciente`(`id`,`tipo_documento`,`numero_documento`,`nombre1`,`nombre2`,`apellido1`,`apellido2`,`genero_id`,`departamento_id`,`municipio_id`) values (1,1,7726544,'JESUS','DAVID','CASTAÑEDA','QUINTERO',1,1,2),(2,1,8930222,'KAREN','YULIETH','SOLANO','ROJAS',2,NULL,7);

/*Table structure for table `productos` */

CREATE TABLE `productos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_fabricante` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Id_producto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Descripcion` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio` int(1) DEFAULT NULL,
  `existencia` int(1) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `productos` */

insert  into `productos`(`Id`,`Id_fabricante`,`Id_producto`,`Descripcion`,`precio`,`existencia`) values (1,'Aci','41001','Aguja',58,227),(2,'Aci','41002','Micropore',80,150),(3,'Aci','41003','Gasa',112,80),(4,'Aci','41004','Equipo macrogoteo',110,50),(5,'Bic','41003','Curas',120,20),(6,'Inc','41089','Canaleta',500,30),(7,'Osa','Xk47','Compresa',150,200),(8,'Bic','Xk47','Compresa',200,200),(9,'Bic','41003','Curas',120,500);

/*Table structure for table `tipos_documento` */

CREATE TABLE `tipos_documento` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPRESSED;

/*Data for the table `tipos_documento` */

insert  into `tipos_documento`(`id`,`nombre`) values (1,'Cédula de ciudadanía'),(2,'Cédula extrajera'),(3,'Tarjeta de identidad'),(4,'Número único de identificación'),(5,'Pasaporte'),(6,'Permiso especial'),(7,'Registro civil'),(9,'Menor sin identificación');

/*Table structure for table `usu` */

CREATE TABLE `usu` (
  `Codigo` smallint(1) NOT NULL,
  `Perfil` bigint(4) DEFAULT NULL,
  `Tipo` smallint(1) DEFAULT NULL,
  `Activo` tinyint(1) DEFAULT NULL,
  `Nick` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Clave` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `Documento` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `Nombre` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Cargo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Intento` char(1) CHARACTER SET utf8 DEFAULT '1',
  `Tintento` int(10) DEFAULT '0',
  `FIngreso` datetime DEFAULT NULL,
  `FCreacion` date DEFAULT NULL,
  `Foto` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Firma` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Barrio` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Telefono` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Celular` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `FechaNac` date DEFAULT NULL,
  `Genero` smallint(1) DEFAULT NULL,
  `Titulo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Universidad` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `TarjProfNo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `TarjProfFecha` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Verificacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `LicenciaOcupNo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Sede` smallint(1) DEFAULT NULL,
  `UsuC0` smallint(1) DEFAULT NULL,
  `FechaC0` datetime DEFAULT NULL,
  `UsuU0` smallint(1) DEFAULT NULL,
  `FechaU0` datetime DEFAULT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `FK_usu` (`Perfil`),
  KEY `FK_usu2` (`Tipo`),
  KEY `FK_usu3` (`Activo`),
  CONSTRAINT `FK_usu` FOREIGN KEY (`Perfil`) REFERENCES `usu_perfil` (`Codigo`) ON UPDATE CASCADE,
  CONSTRAINT `FK_usu2` FOREIGN KEY (`Tipo`) REFERENCES `usu_tipo` (`Codigo`) ON UPDATE CASCADE,
  CONSTRAINT `FK_usu3` FOREIGN KEY (`Activo`) REFERENCES `sino` (`Codigo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPRESSED;

/*Data for the table `usu` */

insert  into `usu`(`Codigo`,`Perfil`,`Tipo`,`Activo`,`Nick`,`Clave`,`Documento`,`Nombre`,`Cargo`,`Intento`,`Tintento`,`FIngreso`,`FCreacion`,`Foto`,`Firma`,`Direccion`,`Barrio`,`Telefono`,`Celular`,`Email`,`FechaNac`,`Genero`,`Titulo`,`Universidad`,`TarjProfNo`,`TarjProfFecha`,`Verificacion`,`LicenciaOcupNo`,`Sede`,`UsuC0`,`FechaC0`,`UsuU0`,`FechaU0`) values (701,1,1,1,'ADMIN','e807f1fcf82d132f9bb018ca6738a19f','7726544','JESUS DAVID CASTAÑEDA QUINTERO','PROGRAMADOR','0',0,'2021-10-23 23:11:44',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
