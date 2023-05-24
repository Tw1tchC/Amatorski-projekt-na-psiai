-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Maj 2023, 14:47
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `hungryhub`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane użytkowników`
--

CREATE TABLE `dane użytkowników` (
  `nr użytkownika` int(11) NOT NULL,
  `imię` varchar(20) NOT NULL,
  `nazwisko` varchar(20) NOT NULL,
  `adres` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `wiek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE `menu` (
  `nr restauracji` int(11) NOT NULL,
  `dania główne` varchar(20) NOT NULL,
  `przystawki` varchar(20) NOT NULL,
  `zupy` varchar(20) NOT NULL,
  `napoje` varchar(20) NOT NULL,
  `cena` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restauracje`
--

CREATE TABLE `restauracje` (
  `nr restauracji` int(11) NOT NULL,
  `nazwa restauracji` varchar(20) NOT NULL,
  `rodzaj kuchni` varchar(20) NOT NULL,
  `dostępny sposób dostawy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `złożone zamówienia`
--

CREATE TABLE `złożone zamówienia` (
  `nr zamówienia` int(11) NOT NULL,
  `restauracja` varchar(20) NOT NULL,
  `zamówione produkty` varchar(50) NOT NULL,
  `imię` varchar(20) NOT NULL,
  `nazwisko` varchar(20) NOT NULL,
  `adres` varchar(20) NOT NULL,
  `telefon` int(11) NOT NULL,
  `sposób dostawy` varchar(20) NOT NULL,
  `cena` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dane użytkowników`
--
ALTER TABLE `dane użytkowników`
  ADD PRIMARY KEY (`nr użytkownika`);

--
-- Indeksy dla tabeli `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`nr restauracji`),
  ADD KEY `nr restauracji` (`nr restauracji`);

--
-- Indeksy dla tabeli `restauracje`
--
ALTER TABLE `restauracje`
  ADD PRIMARY KEY (`nr restauracji`);

--
-- Indeksy dla tabeli `złożone zamówienia`
--
ALTER TABLE `złożone zamówienia`
  ADD PRIMARY KEY (`nr zamówienia`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `dane użytkowników`
--
ALTER TABLE `dane użytkowników`
  MODIFY `nr użytkownika` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `menu`
--
ALTER TABLE `menu`
  MODIFY `nr restauracji` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `restauracje`
--
ALTER TABLE `restauracje`
  MODIFY `nr restauracji` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `złożone zamówienia`
--
ALTER TABLE `złożone zamówienia`
  MODIFY `nr zamówienia` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
