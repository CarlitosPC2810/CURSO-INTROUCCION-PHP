-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2021 a las 20:29:43
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursophp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `months` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `description`, `image`, `visible`, `months`, `created_at`, `updated_at`) VALUES
(1, 'Titulo1', 'Desc1', '', 0, 0, '2021-01-02 17:54:27', '2021-01-02 17:54:27'),
(2, 'PHP Developer', '¡wooow! very good', '', 0, 0, '2021-01-02 18:05:21', '2021-01-02 18:05:21'),
(5, 'JAVA DEV', 'DESC3', '', 0, 0, '2021-01-05 05:09:24', '2021-01-05 05:09:24'),
(6, 'C DEV', 'DESC4', '', 0, 0, '2021-01-05 05:17:55', '2021-01-05 05:17:55'),
(7, 'C# DEV', 'DESC5', '', 0, 0, '2021-01-05 05:18:19', '2021-01-05 05:18:19'),
(8, 'GO DEV', 'DESC6', '', 0, 0, '2021-01-05 05:25:27', '2021-01-05 05:25:27'),
(14, 'Job XSS', '<script>alert(\'hello\');</script>', '', 0, 0, '2021-01-05 21:28:58', '2021-01-05 21:28:58'),
(15, 'Node.js', 'Nodeeeeee', '', 0, 0, '2021-01-06 01:45:10', '2021-01-06 01:45:10'),
(16, 'Profesor dePHP en Platzi', 'super emocionante', 'Captura de pantalla (10).png', 0, 0, '2021-01-08 00:08:31', '2021-01-08 00:08:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `months` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `image`, `visible`, `months`, `created_at`, `updated_at`) VALUES
(2, 'Project1', 'Desc1', '', 0, 0, '2021-01-02 18:31:22', '2021-01-02 18:31:22'),
(3, 'Project2', 'desc2', '', 0, 0, '2021-01-05 05:28:48', '2021-01-05 05:28:48'),
(4, 'Job XSS', 'Desc1', '', 0, 0, '2021-01-08 00:39:35', '2021-01-08 00:39:35'),
(5, 'Job XSS', 'Desc1', 'Captura de pantalla (15).png', 0, 0, '2021-01-08 00:40:02', '2021-01-08 00:40:02'),
(6, 'Job XSS', 'Desc1', 'Captura de pantalla (15).png', 0, 0, '2021-01-08 00:40:52', '2021-01-08 00:40:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `passwd` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `passwd`, `created_at`, `updated_at`) VALUES
(2, 'carlosmanuelperezcarrizal2810@gmail.com', '$2y$10$zjEP1GMloYjBQ4cogQ7M4u10QaQ4ETUsVwerERgTxJ6JVyR9EEZDC', '2021-01-08 01:24:02', '2021-01-08 01:24:02'),
(3, 'carlosmanuelperezcarrizal2810@gmail.com', '$2y$10$H8qDzcpGKpWdAlMgxZhE5eMv/apR2yT1b1TLVv6THW1E2FNwbCtlW', '2021-01-08 17:14:16', '2021-01-08 17:14:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
