-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2026 a las 19:52:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pokedex`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidad`
--

CREATE TABLE `habilidad` (
  `id_habilidad` int(11) NOT NULL,
  `nhabilidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habilidad`
--

INSERT INTO `habilidad` (`id_habilidad`, `nhabilidad`) VALUES
(1, 'Lanzallamas'),
(2, 'Chorro de agua'),
(3, 'Latigo cepa'),
(4, 'Surf'),
(5, 'Erupcion'),
(6, 'Hojas navaja'),
(7, 'Cascada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemon`
--

CREATE TABLE `pokemon` (
  `id_poke` int(11) NOT NULL,
  `npoke` varchar(50) NOT NULL,
  `id_tpoke` int(11) NOT NULL,
  `id_sexo` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `id_region` int(11) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `altura` decimal(5,2) NOT NULL,
  `legendario` tinyint(1) NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemon`
--

INSERT INTO `pokemon` (`id_poke`, `npoke`, `id_tpoke`, `id_sexo`, `descripcion`, `id_region`, `peso`, `altura`, `legendario`, `imagen`) VALUES
(1, 'Bulbasaur', 1, 1, 'Bulbasaur es un Pokémon cuadrúpedo de color verde cubierto de manchas geométricas de tonos oscuros. Su cabeza representa cerca de un tercio de su cuerpo. En su frente, se ubican tres manchas cuya forma varía dependiendo del ejemplar.', 1, 6.90, 0.70, 0, ' bullbasor.webp'),
(2, 'Charmander', 2, 1, 'Charmander es un pequeño lagarto bípedo. Sus características de fuego son resaltadas por su color de piel anaranjado y su cola con la punta envuelta en llamas', 3, 8.50, 0.60, 0, 'https://static.wikia.nocookie.net/espokemon/images/5/56/Charmander.png/revision/latest?cb=20221210013209'),
(3, 'Squirtle', 3, 2, 'Squirtle es una de las especies más difíciles de encontrar. Habita tanto aguas dulces como marinas, preferiblemente zonas bastante profundas. Son pequeñas tortugas color celeste con caparazones color café, o rojas en algunos casos, con una cola enrollada que los distingue.', 2, 9.00, 0.50, 0, 'https://static.wikia.nocookie.net/espokemon/images/e/e3/Squirtle.png/revision/latest/scale-to-width-down/1000?cb=20160309230820');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `nregion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_region`, `nregion`) VALUES
(1, 'Bosque'),
(2, 'Playa'),
(3, 'Volcan'),
(4, 'Desierto'),
(5, 'Pradera'),
(6, 'Estanque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE `sexo` (
  `id_sexo` int(11) NOT NULL,
  `nsexo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`id_sexo`, `nsexo`) VALUES
(1, 'Macho'),
(2, 'Hembra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopoke`
--

CREATE TABLE `tipopoke` (
  `id_tpoke` int(11) NOT NULL,
  `ntpoke` varchar(50) NOT NULL,
  `id_habilidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipopoke`
--

INSERT INTO `tipopoke` (`id_tpoke`, `ntpoke`, `id_habilidad`) VALUES
(1, 'Planta', 3),
(2, 'Fuego', 1),
(3, 'Agua', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `habilidad`
--
ALTER TABLE `habilidad`
  ADD PRIMARY KEY (`id_habilidad`);

--
-- Indices de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id_poke`),
  ADD KEY `id_tpoke` (`id_tpoke`),
  ADD KEY `id_sexo` (`id_sexo`),
  ADD KEY `id_region` (`id_region`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`);

--
-- Indices de la tabla `sexo`
--
ALTER TABLE `sexo`
  ADD PRIMARY KEY (`id_sexo`);

--
-- Indices de la tabla `tipopoke`
--
ALTER TABLE `tipopoke`
  ADD PRIMARY KEY (`id_tpoke`),
  ADD KEY `id_habilidad` (`id_habilidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `habilidad`
--
ALTER TABLE `habilidad`
  MODIFY `id_habilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id_poke` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sexo`
--
ALTER TABLE `sexo`
  MODIFY `id_sexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipopoke`
--
ALTER TABLE `tipopoke`
  MODIFY `id_tpoke` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pokemon`
--
ALTER TABLE `pokemon`
  ADD CONSTRAINT `pokemon_ibfk_1` FOREIGN KEY (`id_tpoke`) REFERENCES `tipopoke` (`id_tpoke`),
  ADD CONSTRAINT `pokemon_ibfk_2` FOREIGN KEY (`id_sexo`) REFERENCES `sexo` (`id_sexo`),
  ADD CONSTRAINT `pokemon_ibfk_3` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`);

--
-- Filtros para la tabla `tipopoke`
--
ALTER TABLE `tipopoke`
  ADD CONSTRAINT `tipopoke_ibfk_1` FOREIGN KEY (`id_habilidad`) REFERENCES `habilidad` (`id_habilidad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
