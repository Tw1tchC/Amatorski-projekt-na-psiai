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

CREATE TABLE `dane_uzytkownikow` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `adres` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `wiek` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE `menu` (
  `nr_restauracji` int(11) NOT NULL AUTO_INCREMENT,
  `dania_glowne` varchar(20) NOT NULL,
  `przystawki` varchar(20) NOT NULL,
  `zupy` varchar(20) NOT NULL,
  `napoje` varchar(20) NOT NULL,
  `cena` float NOT NULL,
  PRIMARY KEY (`nr_restauracji`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restauracje`
--

CREATE TABLE `restaurants` (
  `nr_restauracji` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa_restauracji` varchar(20) NOT NULL,
  `rodzaj_kuchni` varchar(20) NOT NULL,
  `dostepny_sposob_dostawy` varchar(20) NOT NULL,
  PRIMARY KEY (`nr_restauracji`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `złożone zamówienia`
--

CREATE TABLE `zlozone_zamowienia` (
  `nr_zamowienia` int(11) NOT NULL AUTO_INCREMENT,
  `restauracja` varchar(20) NOT NULL,
  `zamowione_produkty` varchar(50) NOT NULL,
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(20) NOT NULL,
  `adres` varchar(20) NOT NULL,
  `telefon` int(11) NOT NULL,
  `sposob_dostawy` varchar(20) NOT NULL,
  `cena` float NOT NULL,
  PRIMARY KEY (`nr_zamowienia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dane użytkowników`
--
ALTER TABLE `dane_uzytkownikow`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Indeksy dla tabeli `menu`
--
ALTER TABLE `menu`
  MODIFY `nr_restauracji` int(11) NOT NULL AUTO_INCREMENT;

--
-- Indeksy dla tabeli `restauracje`
--
ALTER TABLE `restaurants`
  MODIFY `nr_restauracji` int(11) NOT NULL AUTO_INCREMENT;

--
-- Indeksy dla tabeli `złożone zamówienia`
--
ALTER TABLE `zlozone_zamowienia`
  MODIFY `nr_zamowienia` int(11) NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
