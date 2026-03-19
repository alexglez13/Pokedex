-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-03-2026 a las 18:13:22
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
(1, 'Bulbasaur', 1, 1, 'Bulbasaur es un Pokémon cuadrúpedo de color verde cubierto de manchas geométricas de tonos oscuros. Su cabeza representa cerca de un tercio de su cuerpo. En su frente, se ubican tres manchas cuya forma varía dependiendo del ejemplar.', 1, 6.90, 0.70, 0, 'Bulbasaur.webp'),
(2, 'Charmander', 2, 1, 'Charmander es un pequeño lagarto bípedo. Sus características de fuego son resaltadas por su color de piel anaranjado y su cola con la punta envuelta en llamas', 3, 8.50, 0.60, 0, 'Charmander.webp'),
(3, 'Squirtle', 3, 2, 'Squirtle es una de las especies más difíciles de encontrar. Habita tanto aguas dulces como marinas, preferiblemente zonas bastante profundas. Son pequeñas tortugas color celeste con caparazones color café, o rojas en algunos casos, con una cola enrollada que los distingue.', 2, 9.00, 0.50, 0, 'Squirtle.webp'),
(4, 'Cacnea', 1, 1, 'Cacnea vive en los desiertos y otros lugares áridos donde nunca llueve. La flor sólo le brota una vez al año, y mientras más árido y hostil sea su hábitat, más bonita y aromática será la flor de Cacnea. Puede sobrevivir 30 días sin beber agua, gracias a la que tiene almacenada en su cuerpo.', 4, 51.30, 0.40, 0, 'Cacnea.png'),
(5, 'Cyndaquil', 2, 2, 'Cyndaquil es un Pokémon tímido y pequeño que recuerda a un equidna. Su piel es azulada en la parte superior de su cuerpo, y de color crema en la parte inferior. De su lomo puede expulsar llamas a través de cuatro grandes orificios. Suele vérselo acurrucado en forma de bola, si se enfada o se asusta, lanzará las llamas por su lomo para poder protegerse, dicho fuego expulsado es infernal e intimidará a sus rivales. Sin embargo, si este Pokémon se encuentra cansado durante está situación, solo conseguirá echar unas chispas que no llegan a cuajar en una combustión completa', 3, 7.90, 0.50, 0, 'Cyndaquil.png'),
(6, 'Mudkip', 3, 1, 'Mudkip está basado en un pez del fango y en un ajolote. La aleta en la cabeza de Mudkip actúa como un radar altamente sensible. Esto le permite sentir los movimientos del agua y el aire, con lo que puede determinar qué es lo que ocurre a su alrededor sin necesidad de usar sus ojos. Esta aleta de la cabeza también le sirve para detectar las corrientes del agua y la proximidad de algún depredador o enemigo.', 2, 7.60, 0.40, 0, '258.png'),
(7, 'Tangela', 1, 1, 'Este Pokémon está cubierto de enredaderas azules gruesas parecidas a algas que ocultan su rostro, tanto que sólo sus ojos se pueden ver, estas enredaderas nunca le dejan de crecer. Las enredaderas le dan una forma redonda, aunque no se sabe cómo se ve sin ellas, ya que varios investigadores han intentado cortar todas sus enredaderas para averiguarlo, sin embargo, este se resiste haciendo que no logren su cometido. Tiene dos patas rojas en forma de botas.', 1, 35.00, 1.00, 0, 'Tangela.png'),
(8, 'Torchic', 2, 2, 'Torchic está cubierto por una suave capa de plumas con tonos anaranjados. Sus alas son inútiles para volar debido a su pequeño tamaño. Este Pokémon tiene un saco interno en su estómago en el que hay fuego ardiendo todo el tiempo, lo que le permite arrojar bolas de fuego en combate a una temperatura cercana a los 1000 °C. Esta bolsa calienta todo su cuerpo y, por ello, Torchic es caliente al tacto. En las noches cuando va a dormir coloca su cabeza entre el plumaje de su espalda.', 4, 2.50, 0.40, 0, 'Torchic.png'),
(9, 'Totodile', 3, 1, 'La apariencia de Totodile está basada en un reptil acuático, como la cría de un cocodrilo o un lagarto. Tiene un pequeño cuerpo de color azul con una banda amarilla que cruza su pecho. En su espalda y su cola tiene cuatro puntas rojas. Este Pokémon bípedo tiene una gran y prominente quijada, llena de dientes filosos. Es de un carácter violento. Sus fauces están muy desarrolladas, con las cuales es capaz de romper cualquier cosa. Además, gusta clavarlas en todo lo que se mueve a su alrededor, por lo que sus entrenadores deben de tener cuidado y no darle la espalda, ya que hasta ellos pueden ser su objetivo.', 6, 9.50, 0.60, 0, 'Totodile.png'),
(10, 'Chespin', 1, 1, 'Chespin está basado en un erizo y en una castaña. Tiene el cuerpo marrón y una robusta coraza de color verde con varios pinchos alrededor que le cubre la cabeza y la espalda, simulando la cápsula espinosa de las castañas, conocida como erizo. Posee grandes garras blancas y notorias en sus patas inferiores e incisivos prominentes. Su cola acaba en punta y es de color naranja, al igual que su nariz. Debido a su naturaleza curiosa, se mete en líos a menudo; sin embargo Chespin es un Pokémon optimista que no suele preocuparse por los problemas, lo que da muestra de su naturaleza amigable y gentil. Chespin puede acumular energía y usarla para convertir sus suaves púas en unas muy duras y afiladas, con las que puede atravesar rocas.', 5, 9.00, 0.40, 0, 'Chespin.png'),
(11, 'Ponyta', 2, 2, 'Al nacer es un poco débil y lento, pero a los pocos minutos se hacen tan fuertes que pueden cargar a una persona adulta sin mucho esfuerzo, además de ser lo suficientemente rápido para seguir a su padres. Tiene unas patas muy fuertes, que se desarrollan desde que nace. Sus pezuñas son diez veces más fuertes que el diamante, con las que puede destrozar un peñón de una patada. Pueden dar enormes saltos: se dice que pueden brincar la torre de Tokio de un solo salto, usando sus fuertes pezuñas para absorber el impacto cuando estos caen de nuevo al suelo.', 3, 30.00, 1.00, 0, 'Ponyta.png'),
(12, 'Oshawott', 3, 1, 'Oshawott está basado en una nutria. Tiene una cabeza grande, blanca y esférica, con orejas pequeñas en forma cónica de color azul oscuro. Los ojos de Oshawott son grandes, oscuros y de forma ovoide. Su nariz es de color marrón de forma ovalada. Oshawott también posee manchas a los lados de su cara, haciendo referencia a las barbas cortas que poseen las nutrias jóvenes. También posee un extraño collar alrededor de su cuello, que recuerda a pequeñas burbujas. El torso de Oshawott es de color azul claro y posee una especie de adhesivo que mantiene su vieira de color amarillo pálido pegada en el centro.', 2, 5.90, 0.50, 0, 'Oshawott.png'),
(13, 'Virizion', 1, 1, 'Virizion es un Pokémon legendario de tipo planta. Físicamente está basado en una gacela o antílope. Virizion es un Pokémon cuadrúpedo de color verde. Posee unos cuernos verdes terminados en extremos enrollados, aunque su cara, al igual que la parte inferior de su cuerpo es blanca. A ambos lados de su cuello presenta una hoja rosa. Sus patas parecen unas botas verdes terminadas en unas pezuñas negras. Cuenta la leyenda que Virizion confunde a sus rivales con rápidos movimientos para proteger a otros Pokémon.', 5, 200.00, 2.00, 1, 'Virizion.png'),
(14, 'Moltres', 2, 2, 'Moltres es un enorme pájaro de color amarillento, con una cresta llameante en la cabeza y unas patas de color marrón rojizo. Sus alas y su cola están envueltas en llamas asemejándose mucho a un Fénix. También conocido como el legendario pájaro de fuego. Al aletear sus flamígeras alas, crea brillantes llamas que pueden hacer que una noche oscura se torne roja, una visión que es digna de verse. Se dice que este Pokémon lleva la primavera a las tierras invernales por donde pasa.', 3, 60.00, 2.00, 1, 'Moltres.png'),
(15, 'Kyogre', 3, 1, 'Kyogre controla y domina todos los océanos y mares del mundo, pudiendo provocar potentes marejadas y maremotos con tan solo mover una aleta. Este Pokémon es casi imparable cuando se pone furioso ya que puede provocar un maremoto con olas tan altas como un edificio. Se cree que si lo quisiera, este Pokémon podría hacer que el planeta entero se inundara. Aún así, Kyogre es bastante pacífico, excepto cuando pelea con su gran enemigo, Groudon. Kyogre es capaz de crear potentes nubes cargadas de lluvia, cubrir el cielo y desatar lluvias torrenciales e inundaciones. Este Pokémon ha salvado de la sequía a mucha gente, gracias a su habilidad llovizna. También tiene la capacidad de levitar sobre lugares con agua abundante en las cercanías.', 2, 352.00, 4.50, 1, 'Kyogre.png'),
(26, 'Flareon', 2, 1, 'Es flareon', 3, 2.00, 0.50, 0, '136.png');

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
  MODIFY `id_poke` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
