-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2023 a las 21:11:39
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
-- Base de datos: `hospital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro`
--

CREATE TABLE `centro` (
  `idCentro` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Direccion` varchar(150) NOT NULL,
  `Telefono` varchar(45) NOT NULL,
  `idCiudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `centro`
--

INSERT INTO `centro` (`idCentro`, `Nombre`, `Direccion`, `Telefono`, `idCiudad`) VALUES
(2, 'Salud Esparanza', 'C/ Lope de Vega, 63', '953112407', 11),
(3, 'Salud Real', 'C/Real, 42', '952774411', 10),
(4, 'Salud Vida', 'C/Principal,70', '975556314', 9),
(5, 'Salud Mar adentro', 'C/nueva,17', '952223344', 2),
(6, 'Salud', 'C/Traviata,20', '952336644', 1),
(7, 'Bienestar', 'C/Federico,17', '954987741', 3),
(8, 'Salud Oliva', 'C/Carretería,30', '95554308', 5),
(9, 'Salud bienestar', 'C/Conde San Isidro, 56', '952554680', 4),
(10, 'Salud Al-Andalus', 'C/San Rafael,127', '955758040', 8),
(11, 'Salud Sevilla ', 'C/ Alfarería, 35', '956778899', 7),
(12, 'Salud Almansa', 'C/Pascuala,80', '957809010', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_departamento`
--

CREATE TABLE `centro_departamento` (
  `idCentro` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `centro_departamento`
--

INSERT INTO `centro_departamento` (`idCentro`, `idDepartamento`) VALUES
(2, 16),
(2, 17),
(3, 12),
(4, 15),
(5, 6),
(5, 7),
(6, 4),
(6, 5),
(6, 8),
(6, 13),
(7, 3),
(8, 1),
(8, 9),
(8, 18),
(9, 7),
(9, 10),
(10, 4),
(11, 4),
(11, 5),
(11, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idCita` int(11) NOT NULL,
  `Hora` datetime NOT NULL,
  `idPersonal` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTipoCita` int(11) NOT NULL,
  `informe` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`idCita`, `Hora`, `idPersonal`, `idUsuario`, `idTipoCita`, `informe`) VALUES
(9, '2023-05-30 14:26:00', 15, 16, 1, 'La paciente nota mejoría.                                '),
(11, '2023-05-31 00:00:00', 1, 6, 1, NULL),
(18, '2023-06-02 18:51:00', 31, 29, 4, NULL),
(20, '2023-06-01 20:09:00', 27, 40, 2, NULL),
(21, '2023-06-02 00:00:00', 28, 2, 3, NULL),
(22, '2023-06-08 17:20:00', 22, 26, 4, NULL),
(23, '2023-06-01 17:24:00', 19, 2, 4, NULL),
(24, '2023-06-08 17:26:00', 18, 6, 4, NULL),
(25, '2023-06-08 22:30:00', 19, 2, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `idCiudad` int(11) NOT NULL,
  `Nombre` varchar(150) DEFAULT NULL,
  `idProvincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`idCiudad`, `Nombre`, `idProvincia`) VALUES
(1, 'Malaga', 1),
(2, 'Torremolinos', 1),
(3, 'Marbella', 1),
(4, 'Huelva', 7),
(5, 'Martos', 4),
(6, 'Almansa', 9),
(7, 'Sevilla', 8),
(8, 'Córdoba', 3),
(9, 'Cádiz', 6),
(10, 'Almería', 5),
(11, 'Granada', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Descripcion` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `Nombre`, `Descripcion`) VALUES
(1, 'Dermatología', 'Piel'),
(3, 'Traumatología', 'Esqueleto humano'),
(4, 'Médico de familiar', 'Consultas primarias'),
(5, 'Oftalmología', 'ocular'),
(6, 'Podología', 'Pies'),
(7, 'Urología', 'Problemas renales'),
(8, 'Ginecología', 'Aparato reproductor femenino '),
(9, 'Dentista', 'Dientes'),
(10, 'Areología ', 'Alergias'),
(11, 'Oncología ', 'Cáncer'),
(12, 'Endocrinología ', 'Aparato digestivo'),
(13, 'Dietista ', 'Alimentación'),
(14, 'Psiquiatría', 'Problemas mentales'),
(15, 'Neurología ', 'Problemas celebrare '),
(16, 'Cardiología', 'Problemas cardiacos '),
(17, 'Hematología ', 'Sangre'),
(18, 'Psiquiatría', 'Problemas mentales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento_personal`
--

CREATE TABLE `departamento_personal` (
  `idDepartamento` int(11) NOT NULL,
  `idPersonal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `departamento_personal`
--

INSERT INTO `departamento_personal` (`idDepartamento`, `idPersonal`) VALUES
(1, 21),
(3, 12),
(4, 23),
(4, 26),
(4, 33),
(5, 15),
(5, 32),
(6, 31),
(7, 28),
(7, 30),
(9, 27),
(10, 25),
(11, 24),
(12, 22),
(13, 20),
(15, 18),
(16, 17),
(17, 16),
(18, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento_tipocita`
--

CREATE TABLE `departamento_tipocita` (
  `idDepartamento` int(11) NOT NULL,
  `idTipoCita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `departamento_tipocita`
--

INSERT INTO `departamento_tipocita` (`idDepartamento`, `idTipoCita`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiar`
--

CREATE TABLE `familiar` (
  `idFamiliar` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(150) NOT NULL,
  `Telefono` varchar(45) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `idPersonal` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Apellido` varchar(150) NOT NULL,
  `Telefono` varchar(45) NOT NULL,
  `dni` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`idPersonal`, `Nombre`, `Apellido`, `Telefono`, `dni`) VALUES
(1, 'José ', 'Sánchez Ramírez', '666333987', '77123122T'),
(11, 'Amelia', 'Ruiz Rodriguez', '954556874', '44125160V'),
(12, 'Concha ', 'López Cueto', '654111236', '51194631G'),
(15, 'Eustaquio', 'Sánchez Ramírez', '124444012', '33251452E'),
(16, 'Pablo ', 'Ruiz Sánchez', '954785212', '41023695A'),
(17, 'Rosana ', 'Villanueva Martínez', '954552136', '77447148H'),
(18, 'Víctor ', 'Cruz López', '658888521', '45712014P'),
(19, 'Estefanía ', 'Aguilera Monzón', '542444120', '51254963V'),
(20, 'José ', 'González Armenteros', '987455201', '99632522T'),
(21, 'María Luisa ', 'Contreras Carrillo', '954447120', '50789654K'),
(22, 'Antonio', 'Cuevas Alpino ', '195222036', '55114411P'),
(23, 'Ana', 'Pérez Cuéllar', '956666321', '11242475Z'),
(24, 'Carmelo ', 'Aranda Aranda', '954555841', '88845474A'),
(25, 'Matilde', 'Sanz Alcaraz', '956666284', '77545512T'),
(26, 'Alejandro ', 'García Paez', '958555456', '55415214Y'),
(27, 'María Teresa ', 'Landinez Carpio', '632222023', '96325633E'),
(28, 'Francisco ', 'Gutiérrez Sánchez', '956663225', '99665421D'),
(29, 'María Trinidad', 'Santos Vega', '985555236', '88545421P'),
(30, 'Isabel ', 'Montes Alpes', '653555698', '77854569J'),
(31, 'Manuel ', 'Ramírez López', '652222014', '22355245H'),
(32, 'Almudena', 'Espejo Conde', '666343333', '88457123L'),
(33, 'Alberto ', 'Núñez Ramírez ', '258444125', '41145215F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `idProvincia` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idProvincia`, `Nombre`) VALUES
(1, 'Málaga'),
(2, 'Granada'),
(3, 'Córdoba'),
(4, 'Jaén'),
(5, 'Almería'),
(6, 'Cadiz'),
(7, 'Huelva'),
(8, 'Sevilla'),
(9, 'Albacete');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocita`
--

CREATE TABLE `tipocita` (
  `idTipoCita` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Duracion` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipocita`
--

INSERT INTO `tipocita` (`idTipoCita`, `Nombre`, `Duracion`) VALUES
(1, 'Consultas rutinarias', 10),
(2, 'Primera consulta', 15),
(3, 'Revisión', 5),
(4, 'Urgencias', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(150) NOT NULL,
  `Telefono` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `contrasenia` varchar(2000) DEFAULT NULL,
  `Rol` varchar(45) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Dni` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Nombre`, `Apellido`, `Telefono`, `Email`, `contrasenia`, `Rol`, `FechaNacimiento`, `Dni`) VALUES
(2, 'Ana', 'Cuellar Maestro ', '123444444', 'ana@ana.com', '$2y$10$9okRkrbS4VPt.pq209IhC.FaDfBIwi1j4lF7mFGrUbGUR989t6qBO', 'Administrador', '1987-10-26', '77350560L'),
(6, 'Francisco ', 'Ruiz Rodriguez', '670000000', 'f@f.com', '$2y$10$oq5vcS4d9SSmwJqCvLzeYO0zhRMKS9ZPGJWU0W', 'Usuario', '2022-11-29', '96325633E'),
(14, 'Amelia', 'Ruiz Rodriguez', '954556874', 'Amelia@gmail.com', '$2y$10$V04vfnwkakRsP63kz2z53edpbcYrxyXV/sKirDHXjeSvy0Y6vYJKK', 'Usuario_autorizado', '1980-11-12', '44125160V'),
(15, 'Concha ', 'López Cueto', '654111236', 'Concha@gmail.com', '$2y$10$KwquUphe2pDVh242oh39RucG6OidhMU9xWKxBYhCxujFkEEKjVCWW', 'Especialista', '1998-12-24', '51194631G'),
(16, 'Ana ', 'Martínez Guerra', '140000123', 'Ana@gmail.com', '$2y$10$7TbTZigEdVHS0bJZQtxJfO1n5kH02phCBhtmsdib6D7VqPZkRZ346', 'Usuario', '1996-10-30', '77514420L'),
(17, 'Adela ', 'Rodríguez Milla', '957884212', 'Adela@gmail.com', '$2y$10$R8PjL/CQuF2zNaHN.ODNzOU98tJ4pDURouUCPR5109tJJ6HOiLUv.', 'Usuario', '1996-10-07', '99556688G'),
(18, 'Pedro', 'Torres Albin', '555441202', 'Pedro@gmail.com', '$2y$10$cReuW7HayNtUgKZ82KBBB.M3uHyP4c9.jFAPNTE9uvNCaBpsCIGwq', 'Usuario', '2000-06-13', '88545210G'),
(21, 'Eustaquio', 'Sánchez Ramírez', '124444012', 'Eustaquio@gmail.com', '$2y$10$X1j0bSNzEV3FZbDWPm7g9elOvfg9n4EES01qQBb0Y/22EzWZKRU3y', 'Especialista', '1970-10-26', '33251452E'),
(22, 'Pablo ', 'Ruiz Sánchez', '954785212', 'Pablo@gmail.com', '$2y$10$97ue0M0UwThRTCu0JNjj6uTo1RYilq7IUF5zKOvdR83COazHSllYu', 'Especialista', '1990-11-10', '41023695A'),
(23, 'Rosana ', 'Villanueva Martínez', '954552136', 'Rosana@gmail.com', '$2y$10$SnBsY0.E3etTjOVVyaLT6.n857.UMD84o3s7min6XbHURqXWb3ElC', 'Especialista', '2000-06-05', '77447148H'),
(24, 'Víctor ', 'Cruz López', '658888521', 'Victor@gmail.com', '$2y$10$Uavny5bZyR9NFIA0OgoJ2e3.0wxs8vGgfbN9ghblNkveRk3BrBn0u', 'Especialista', '1985-11-12', '45712014P'),
(25, 'Estefanía ', 'Aguilera Monzón', '542444120', 'Estefania@gmail.com', '$2y$10$3.3djcF1WrVdYIDTUxbrzeI5mfmJnC8KHSFZVblgUs358WhkOuIXi', 'Especialista', '1991-06-30', '51254963V'),
(26, 'José ', 'González Armenteros', '987455201', 'Jose@gmail.com', '$2y$10$Jp0AKednVwzmI5Hg6c3tvuAAeN1XWB5MYBf9.9x00PgQmJxRTkgI.', 'Especialista', '1993-08-13', '99632522T'),
(27, 'María Luisa ', 'Contreras Carrillo', '954447120', 'MariaLuisa@gmail.com', '$2y$10$FTWdqFyTQhiv5mLO4HWVGeSRIR8ADWyMQQt.tTBKceDpR6cq2R0hW', 'Especialista', '1988-06-20', '50789654K'),
(28, 'Antonio', 'Cuevas Alpino ', '195222036', 'AntonioCuevas@gmail.com', '$2y$10$OPuuKF6b6v3llRrlSA415.eAgbInQw3uSH03Th8w9NoLoeScXEIyW', 'Especialista', '1986-02-02', '55114411P'),
(29, 'Ana', 'Pérez Cuéllar', '956666321', 'Ana@gmail.com', '$2y$10$y2eoHRpjBOP7xSh3p.QAh.qhPut3w.LCJXMR.FQKgnHvyecQ2m.LS', 'Especialista', '1960-11-14', '11242475Z'),
(30, 'Carmelo ', 'Aranda Aranda', '954555841', 'Carmelo@gmail.com', '$2y$10$dC.piG3/ObzJf.a1S8IzhOllrReECqDKb46qa4QB9iMUpW9nDzCPC', 'Especialista', '1975-03-21', '88845474A'),
(31, 'Matilde', 'Sanz Alcaraz', '956666284', 'Matilde@gmail.com', '$2y$10$zTwdmJqifuX83tEI0x1jUeuDXbzGt2qJxW2vp9gpKNLqbAjj/TlJu', 'Especialista', '1965-09-24', '77545512T'),
(32, 'Alejandro ', 'García Paez', '958555456', 'Alejandro@gmail.com', '$2y$10$Zdmfh4ShtW7hkj1N3IPcDu2016vcENjDfEBAA.d264mBrNvUmtF5S', 'Especialista', '1985-03-14', '55415214Y'),
(33, 'María Teresa ', 'Landinez Carpio', '632222023', 'MariaTeresa@gmail.com', '$2y$10$z05VhdzIgHxmswZahwU9Ru.IaLZDVHqFcspAtcdAtHOeVdJrCU73a', 'Especialista', '1998-07-14', '96325633E'),
(34, 'Francisco ', 'Gutiérrez Sánchez', '956663225', 'Francisco@gmail.com', '$2y$10$l8uZG5iD3tR7U5uGNjf5Ou/zVRHkdsncm6IfWcfg6hjLsTU3lni3W', 'Especialista', '1957-08-24', '99665421D'),
(35, 'María Trinidad', 'Santos Vega', '985555236', 'MariaTrinidad@gmail.com', '$2y$10$IGUcVfr1hJCqvSZzrFgQpuO7c5B/Hnhyncifa0E1eQW9q7HmWB1UC', 'Especialista', '1988-04-25', '88545421P'),
(36, 'Isabel ', 'Montes Alpes', '653555698', 'Isabel@gmail.com', '$2y$10$H6sYWUO7yogfoQYlJnebxu2yoiqyrSRrBK5CuevonQEop08Np/CAK', 'Especialista', '1996-02-25', '77854569J'),
(37, 'Manuel ', 'Ramírez López', '652222014', 'Manuel@gmail.com', '$2y$10$Gg/HjeP7i444xLr63p4Jy.UEPl/xWRE9zymtBXj1lpErRB/zOdz3C', 'Especialista', '1987-10-26', '22355245H'),
(38, 'Almudena', 'Espejo Conde', '666343333', 'Almudena@gmail.con', '$2y$10$SYZD0LX7LrCIquWOvGAmfuTq7TydkbkUUi4L8/xBRHiwiUrAB6qty', 'Especialista', '1981-03-17', '88457123L'),
(39, 'Alberto ', 'Núñez Ramírez ', '258444125', 'Alberto@gmail.com', '$2y$10$NLa2pF66y97MIAQG.5f09OAhrve5LVfo89VDK156dts3GI547f21m', 'Especialista', '1984-06-25', '41145215F'),
(40, 'Alejandra', 'Canto Ruiz', '262333698', 'Alejandra@gmail.com', '$2y$10$F9YSUbP0uhOzKW8U7CTzc.AhBKtefP2XqjI03Q89PomC5nr9azcGC', 'Usuario', '1970-01-01', '55121460L');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `centro`
--
ALTER TABLE `centro`
  ADD PRIMARY KEY (`idCentro`,`idCiudad`),
  ADD KEY `fk_Centro_Ciudad1` (`idCiudad`);

--
-- Indices de la tabla `centro_departamento`
--
ALTER TABLE `centro_departamento`
  ADD PRIMARY KEY (`idCentro`,`idDepartamento`),
  ADD KEY `fk_Centro_has_Departamento_Departamento1` (`idDepartamento`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idCita`,`idPersonal`,`idUsuario`,`idTipoCita`),
  ADD KEY `fk_Cita_Personal1` (`idPersonal`),
  ADD KEY `fk_Cita_Paciente1` (`idUsuario`),
  ADD KEY `fk_Cita_Tipo_citas1` (`idTipoCita`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`idCiudad`,`idProvincia`),
  ADD KEY `fk_Ciudad_Provincia1` (`idProvincia`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `departamento_personal`
--
ALTER TABLE `departamento_personal`
  ADD PRIMARY KEY (`idDepartamento`,`idPersonal`),
  ADD KEY `fk_Departamento_has_Personal_Personal1` (`idPersonal`);

--
-- Indices de la tabla `departamento_tipocita`
--
ALTER TABLE `departamento_tipocita`
  ADD PRIMARY KEY (`idDepartamento`,`idTipoCita`),
  ADD KEY `fk_Departamento_has_Tipo_cita_Tipo_cita1` (`idTipoCita`);

--
-- Indices de la tabla `familiar`
--
ALTER TABLE `familiar`
  ADD PRIMARY KEY (`idFamiliar`),
  ADD KEY `fk_Familiar_Usuario1` (`idUsuario`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`idPersonal`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`idProvincia`);

--
-- Indices de la tabla `tipocita`
--
ALTER TABLE `tipocita`
  ADD PRIMARY KEY (`idTipoCita`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`,`Dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `centro`
--
ALTER TABLE `centro`
  MODIFY `idCentro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `idCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `familiar`
--
ALTER TABLE `familiar`
  MODIFY `idFamiliar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `idPersonal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `idProvincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipocita`
--
ALTER TABLE `tipocita`
  MODIFY `idTipoCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `centro`
--
ALTER TABLE `centro`
  ADD CONSTRAINT `fk_Centro_Ciudad1` FOREIGN KEY (`idCiudad`) REFERENCES `ciudad` (`idCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `centro_departamento`
--
ALTER TABLE `centro_departamento`
  ADD CONSTRAINT `fk_Centro_has_Departamento_Centro` FOREIGN KEY (`idCentro`) REFERENCES `centro` (`idCentro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Centro_has_Departamento_Departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_Cita_Paciente1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cita_Personal1` FOREIGN KEY (`idPersonal`) REFERENCES `personal` (`idPersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cita_Tipo_citas1` FOREIGN KEY (`idTipoCita`) REFERENCES `tipocita` (`idTipoCita`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_Ciudad_Provincia1` FOREIGN KEY (`idProvincia`) REFERENCES `provincia` (`idProvincia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `departamento_personal`
--
ALTER TABLE `departamento_personal`
  ADD CONSTRAINT `fk_Departamento_has_Personal_Departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Departamento_has_Personal_Personal1` FOREIGN KEY (`idPersonal`) REFERENCES `personal` (`idPersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `departamento_tipocita`
--
ALTER TABLE `departamento_tipocita`
  ADD CONSTRAINT `fk_Departamento_has_Tipo_cita_Departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Departamento_has_Tipo_cita_Tipo_cita1` FOREIGN KEY (`idTipoCita`) REFERENCES `tipocita` (`idTipoCita`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `familiar`
--
ALTER TABLE `familiar`
  ADD CONSTRAINT `fk_Familiar_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
