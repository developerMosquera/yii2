-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-02-2018 a las 15:41:51
-- Versión del servidor: 5.7.18-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `baseYii`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1519251352),
('m130524_201442_init', 1519251357);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `idOperacion` int(11) NOT NULL,
  `nomOperacion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`idOperacion`, `nomOperacion`) VALUES
(1, 'access-access-index'),
(2, 'roles-roles-index'),
(3, 'roles-roles-create'),
(4, 'roles-roles-update'),
(5, 'roles-roles-view'),
(6, 'roles-roles-delete'),
(7, 'operaciones-operaciones-index'),
(8, 'operaciones-operaciones-create'),
(9, 'operaciones-operaciones-update'),
(10, 'operaciones-operaciones-view'),
(11, 'operaciones-operaciones-delete'),
(12, 'users-users-index'),
(13, 'users-users-create'),
(14, 'users-users-update'),
(15, 'users-users-view'),
(16, 'users-users-delete');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nomRol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nomRol`) VALUES
(1, 'superAdmin'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolesOperaciones`
--

CREATE TABLE `rolesOperaciones` (
  `idRoleOperacion` int(11) NOT NULL,
  `idRol` int(11) NOT NULL,
  `idOperacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rolesOperaciones`
--

INSERT INTO `rolesOperaciones` (`idRoleOperacion`, `idRol`, `idOperacion`) VALUES
(17, 1, 1),
(18, 1, 2),
(19, 1, 3),
(20, 1, 4),
(21, 1, 5),
(22, 1, 6),
(23, 1, 7),
(24, 1, 8),
(25, 1, 9),
(26, 1, 10),
(27, 1, 11),
(28, 1, 12),
(29, 1, 13),
(30, 1, 14),
(31, 1, 15),
(32, 1, 16),
(33, 2, 1),
(34, 2, 2),
(35, 2, 7),
(36, 2, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `idRol` int(11) NOT NULL DEFAULT '3',
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `idRol`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'superAdmin', '2A6XQw4W9hI-TMSmQEa5j6OAs3Frl_wS', '$2y$13$sIMn0Xupol9Y2yxuYJudUOhrvWdW9F8g7P5/dzOelEMTw6q95H1V2', NULL, 'amosquera@skinatech.com', 10, 1519403168, 1519764081),
(2, 2, 'Admin', 'LEGCBynNsUCTVl5ZueT1AoXgyzblHsf1', '$2y$13$kcrysaU4lH2ygVtepqh7IOIvEri7Q0mkLY96wCVEmzg3So.gxkgm.', NULL, 'invitado@skinatech.com', 10, 1519764502, 1519764503);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`idOperacion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `rolesOperaciones`
--
ALTER TABLE `rolesOperaciones`
  ADD PRIMARY KEY (`idRoleOperacion`),
  ADD KEY `idRol` (`idRol`),
  ADD KEY `idOperacion` (`idOperacion`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `idOperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `rolesOperaciones`
--
ALTER TABLE `rolesOperaciones`
  MODIFY `idRoleOperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rolesOperaciones`
--
ALTER TABLE `rolesOperaciones`
  ADD CONSTRAINT `idRol` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rolesOperaciones_ibfk_1` FOREIGN KEY (`idOperacion`) REFERENCES `operaciones` (`idOperacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
