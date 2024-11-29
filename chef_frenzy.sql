-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2024 a las 18:57:00
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
-- Base de datos: `chef_frenzy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `player`
--

CREATE TABLE `player` (
  `Player_Id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Game_Name` varchar(255) NOT NULL,
  `Date_Creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `player`
--

INSERT INTO `player` (`Player_Id`, `Username`, `Password`, `Game_Name`, `Date_Creation`) VALUES
(1, 'dario', '$2y$10$QyEZ3OnpOap9/TwQqrvMzezPtCJE.7Bk0w3lFALAwDDJDUckwfSEi', 'dariooo', '2024-11-28 15:17:51'),
(2, 'Maton', '$2y$10$/tcpxPabF1vnh.4O.LcZJe27CSf/GoZte5HuYGiQ1Q8yKr72RHgvC', 'MatonZ', '2024-11-28 16:21:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `player_games`
--

CREATE TABLE `player_games` (
  `Game_Id` int(11) NOT NULL,
  `Winner_Id` int(11) DEFAULT NULL,
  `Player_Id_1` int(11) DEFAULT NULL,
  `Player_Id_2` int(11) DEFAULT NULL,
  `Player_Id_3` int(11) DEFAULT NULL,
  `Orders_Fulfilled` int(11) DEFAULT 0,
  `Ingredients_Generated` int(11) DEFAULT 0,
  `Plates_Cooked` int(11) DEFAULT 0,
  `Plates_Stolen` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`Player_Id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indices de la tabla `player_games`
--
ALTER TABLE `player_games`
  ADD PRIMARY KEY (`Game_Id`),
  ADD KEY `FK_Winner_Id` (`Winner_Id`),
  ADD KEY `FK_Player_Id_1` (`Player_Id_1`),
  ADD KEY `FK_Player_Id_2` (`Player_Id_2`),
  ADD KEY `FK_Player_Id_3` (`Player_Id_3`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `player`
--
ALTER TABLE `player`
  MODIFY `Player_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `player_games`
--
ALTER TABLE `player_games`
  MODIFY `Game_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `player_games`
--
ALTER TABLE `player_games`
  ADD CONSTRAINT `FK_Player_Id_1` FOREIGN KEY (`Player_Id_1`) REFERENCES `player` (`Player_Id`),
  ADD CONSTRAINT `FK_Player_Id_2` FOREIGN KEY (`Player_Id_2`) REFERENCES `player` (`Player_Id`),
  ADD CONSTRAINT `FK_Player_Id_3` FOREIGN KEY (`Player_Id_3`) REFERENCES `player` (`Player_Id`),
  ADD CONSTRAINT `FK_Winner_Id` FOREIGN KEY (`Winner_Id`) REFERENCES `player` (`Player_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
