-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Feb 06. 20:46
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `autokolcsonzo`
--
CREATE DATABASE IF NOT EXISTS `autokolcsonzo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `autokolcsonzo`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ajanlatok`
--

CREATE TABLE `ajanlatok` (
  `id` int(11) NOT NULL,
  `ajanlat_tevo_id` int(11) NOT NULL,
  `auto_id` int(11) NOT NULL,
  `ar` int(11) NOT NULL,
  `elfogadva` tinyint(1) NOT NULL DEFAULT 0,
  `elutasitva` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `ajanlatok`
--

INSERT INTO `ajanlatok` (`id`, `ajanlat_tevo_id`, `auto_id`, `ar`, `elfogadva`, `elutasitva`) VALUES
(2, 2, 3, 1000000, 0, 0),
(3, 1, 5, 1100000, 0, 1),
(4, 1, 5, 1200000, 0, 1),
(5, 1, 5, 1200000, 0, 1),
(6, 1, 5, 1300000, 1, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `autok`
--

CREATE TABLE `autok` (
  `id` int(11) NOT NULL,
  `hirdeto_id` int(11) NOT NULL,
  `marka` varchar(40) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `modell` varchar(40) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `uzemanyag` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `gyartasi_ev` int(4) NOT NULL,
  `eladasi_ar` int(11) NOT NULL,
  `kep` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `leiras` text COLLATE utf8mb4_hungarian_ci NOT NULL,
  `elkelt` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `autok`
--

INSERT INTO `autok` (`id`, `hirdeto_id`, `marka`, `modell`, `uzemanyag`, `gyartasi_ev`, `eladasi_ar`, `kep`, `leiras`, `elkelt`) VALUES
(1, 1, 'Ford', 'Focus', 'benzin', 2013, 3000000, 'ford_focus_2022_01_28_18_56_26.jpg', '', 0),
(2, 1, 'Ford', 'Escort', 'benzin', 2015, 2500000, 'ford_escort_2022_01_28_19_07_22.jpg', 'Nagyon jó állapot', 0),
(3, 1, 'Opel', 'Astra', 'dízel', 2017, 1000000, 'opel_astra_2022_01_28_19_08_18.jpg', '', 0),
(5, 2, 'Opel', 'Octavia', 'dízel', 2013, 1200000, 'opel_octavia_2022_02_04_16_20_19.jpg', 'Teljesen megéri', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `auto_kepek`
--

CREATE TABLE `auto_kepek` (
  `id` int(11) NOT NULL,
  `auto_id` int(11) NOT NULL,
  `kep` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `auto_kepek`
--

INSERT INTO `auto_kepek` (`id`, `auto_id`, `kep`) VALUES
(1, 1, 'ford_focus_2022_01_28_18_56_26_1.jpg'),
(2, 1, 'ford_focus_2022_01_28_18_56_26_2.jpg'),
(3, 3, 'opel_astra_2022_01_28_19_08_18_1.jpg'),
(4, 3, 'opel_astra_2022_01_28_19_08_18_2.jpg'),
(9, 5, 'opel_octavia_2022_02_04_16_20_19_1.jpg'),
(10, 5, 'opel_octavia_2022_02_04_16_20_19_2.jpg'),
(11, 5, 'opel_octavia_2022_02_04_16_20_19_3.jpg'),
(12, 5, 'opel_octavia_2022_02_04_17_43_17_1.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jelszo` varchar(150) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `felhasznalonev`, `email`, `jelszo`, `tel`) VALUES
(1, 'elso_user', 'teszt@example.com', '$2y$10$MF8/3NG4ckG89OsfyFagVOd0XBAgLMZNraprBAL7rsIfTqgqN2SU6', '+36301234567'),
(2, 'masodik_user', 'valami@example.com', '$2y$10$W4IkcwydY/nXo7rGflzTMuJ8HpnUE6zvrI3GbjJ5En9q8FG2.3weW', '+36701234567');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `ajanlatok`
--
ALTER TABLE `ajanlatok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ajanlat_tevo_id` (`ajanlat_tevo_id`),
  ADD KEY `auto_id` (`auto_id`);

--
-- A tábla indexei `autok`
--
ALTER TABLE `autok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hirdeto_id` (`hirdeto_id`);

--
-- A tábla indexei `auto_kepek`
--
ALTER TABLE `auto_kepek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auto_id` (`auto_id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `felhasznalonev` (`felhasznalonev`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ajanlatok`
--
ALTER TABLE `ajanlatok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `autok`
--
ALTER TABLE `autok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `auto_kepek`
--
ALTER TABLE `auto_kepek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `ajanlatok`
--
ALTER TABLE `ajanlatok`
  ADD CONSTRAINT `ajanlatok_ibfk_1` FOREIGN KEY (`ajanlat_tevo_id`) REFERENCES `felhasznalok` (`id`),
  ADD CONSTRAINT `ajanlatok_ibfk_2` FOREIGN KEY (`auto_id`) REFERENCES `autok` (`id`);

--
-- Megkötések a táblához `autok`
--
ALTER TABLE `autok`
  ADD CONSTRAINT `autok_ibfk_1` FOREIGN KEY (`hirdeto_id`) REFERENCES `felhasznalok` (`id`);

--
-- Megkötések a táblához `auto_kepek`
--
ALTER TABLE `auto_kepek`
  ADD CONSTRAINT `auto_kepek_ibfk_1` FOREIGN KEY (`auto_id`) REFERENCES `autok` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
