-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 12 nov 2014 om 10:46
-- Serverversie: 5.6.20
-- PHP-versie: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `eatit`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
`artikelnr` int(8) NOT NULL,
  `omschrijving` varchar(125) NOT NULL,
  `tv` int(8) NOT NULL,
  `ib` int(8) NOT NULL,
  `gr` int(8) NOT NULL,
  `bd` int(8) NOT NULL,
  `artikelprijs` float NOT NULL,
  `soort` varchar(125) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Gegevens worden geëxporteerd voor tabel `artikel`
--

INSERT INTO `artikel` (`artikelnr`, `omschrijving`, `tv`, `ib`, `gr`, `bd`, `artikelprijs`, `soort`) VALUES
(1, 'Patat', 18, 0, 0, 0, 0.5, 'Aardappels, groenten en fruit'),
(2, 'Frikandel', 20, 0, 0, 0, 0.2, 'Vlees'),
(3, 'Kibbeling', 18, 0, 0, 0, 0.5, 'Vis'),
(4, 'Schnitzel', 20, 0, 0, 0, 0.6, 'Vlees'),
(5, 'Hamburger', 20, 0, 0, 0, 0.3, 'Vlees'),
(6, 'Pasta (Macaroni)', 20, 0, 0, 0, 0.35, 'Buitenlands ingredienten'),
(7, 'Pasta saus', 20, 0, 0, 0, 0.5, 'Buitenlands ingredienten'),
(8, 'groenten mix', 20, 0, 0, 0, 0.45, 'Aardappels, groenten en fruit'),
(9, 'Pasta (Spaghetti)', 20, 0, 0, 0, 0.45, 'Buitenlands ingredienten'),
(10, 'Aardappels', 19, 0, 0, 0, 0.3, 'Aardappels, groenten en fruit'),
(11, 'Spruitjes', 20, 0, 0, 0, 0.75, 'Aardappels, groenten en fruit'),
(12, 'Gehaktbal', 19, 0, 0, 0, 1.2, 'Vlees'),
(13, 'Jus', 19, 0, 0, 0, 0.35, 'Vlees'),
(14, 'Boontjes', 20, 0, 0, 0, 0.5, 'Aardappels, groenten en fruit'),
(15, 'Spinazie', 19, 0, 0, 0, 0.45, 'Aardappels, groenten en fruit'),
(16, 'Wortels', 20, 0, 0, 0, 0.4, 'Aardappels, groenten en fruit'),
(17, 'Biefstuk', 20, 0, 0, 0, 1.5, 'Vlees'),
(18, 'Cola 1l', 20, 0, 0, 0, 1, 'Side order'),
(19, 'Sinas 1l', 20, 0, 0, 0, 1, 'Side order'),
(20, 'Sprite 1l', 20, 0, 0, 0, 1, 'Side order'),
(21, 'Rode wijn 1l', 20, 0, 0, 0, 1.2, 'Side order'),
(22, 'Witte wijn 1l', 20, 0, 0, 0, 1.2, 'Side order'),
(23, 'Wijn van het huis 1l', 20, 0, 0, 0, 4, 'Side order'),
(24, 'Hertog Jan sixpack', 20, 0, 0, 0, 1.2, 'Side order');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikelrecept`
--

CREATE TABLE IF NOT EXISTS `artikelrecept` (
  `artikelnr` int(8) NOT NULL,
  `receptnr` int(8) NOT NULL,
  `aantal` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `artikelrecept`
--

INSERT INTO `artikelrecept` (`artikelnr`, `receptnr`, `aantal`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(2, 1, 1),
(3, 2, 1),
(4, 3, 1),
(5, 4, 1),
(6, 5, 1),
(7, 5, 1),
(7, 6, 1),
(8, 5, 1),
(8, 6, 1),
(9, 6, 1),
(10, 7, 1),
(10, 8, 1),
(10, 9, 1),
(10, 10, 1),
(10, 11, 1),
(10, 12, 1),
(10, 13, 1),
(10, 14, 1),
(11, 7, 1),
(11, 11, 1),
(12, 7, 1),
(12, 8, 1),
(12, 9, 1),
(12, 10, 1),
(13, 7, 1),
(13, 8, 1),
(13, 9, 1),
(13, 10, 1),
(13, 11, 1),
(13, 12, 1),
(13, 13, 1),
(13, 14, 1),
(14, 8, 1),
(14, 12, 1),
(15, 9, 1),
(15, 13, 1),
(16, 10, 1),
(16, 14, 1),
(17, 11, 1),
(17, 12, 1),
(17, 13, 1),
(17, 14, 1),
(18, 15, 1),
(19, 16, 1),
(20, 17, 1),
(21, 18, 1),
(22, 19, 1),
(23, 20, 1),
(24, 21, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkooporder`
--

CREATE TABLE IF NOT EXISTS `inkooporder` (
`inkoopordernr` int(8) NOT NULL,
  `lev_nr` int(8) NOT NULL,
  `orderdatum` date NOT NULL,
  `leverdatum` date NOT NULL,
  `status` int(1) NOT NULL,
  `betaald` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkooporderregel`
--

CREATE TABLE IF NOT EXISTS `inkooporderregel` (
`inkooporderregelnr` int(8) NOT NULL,
  `inkoopordernr` int(8) NOT NULL,
  `artikelnr` int(8) NOT NULL,
  `aantal` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE IF NOT EXISTS `klant` (
`klantnr` int(8) NOT NULL,
  `voornaam` varchar(125) NOT NULL,
  `achternaam` varchar(125) NOT NULL,
  `adres` varchar(125) NOT NULL,
  `postcode` varchar(125) NOT NULL,
  `woonplaats` varchar(125) NOT NULL,
  `telefoonnr` varchar(10) NOT NULL,
  `email` varchar(125) NOT NULL,
  `wachtwoord` varchar(125) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`klantnr`, `voornaam`, `achternaam`, `adres`, `postcode`, `woonplaats`, `telefoonnr`, `email`, `wachtwoord`) VALUES
(1, 'Ronald', 'Scholten', 'Beumeesweg 180', '9712 GP', 'Groningen', '6502737515', 'ro.scholten@st.hanze.nl', 'student'),
(2, 'Mark-Jan', 'Gorter', 'Kambalahout 22', '9711 RR', 'Groningen', '6818393435', 'mark-jangorter1@hotmail.com', 'Sinterklaas'),
(3, 'Klaas', 'Janssen', 'A-straat 3', '9718 CP', 'Groningen', '6502737226', 'janssen@live.nl', 'klaasisbaas'),
(4, 'Frank', 'Targus', 'Toplicht 3', '9732 HL', 'Groningen', '650066751', 'frankie.t@gmail.com', 'badeend'),
(5, 'Harmen', 'Kiwi', 'Peperstraat 4', '9711 PC', 'Groningen', '654466758', 'kiwiislekkr@live.nl', 'aardbei');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leveranciers`
--

CREATE TABLE IF NOT EXISTS `leveranciers` (
`lev_nr` int(8) NOT NULL,
  `lev_naam` varchar(125) NOT NULL,
  `lev_adres` varchar(125) NOT NULL,
  `lev_postcode` varchar(125) NOT NULL,
  `lev_plaats` varchar(125) NOT NULL,
  `lev_telefoonnr` varchar(10) NOT NULL,
  `lev_rekeningnr` int(10) NOT NULL,
  `lev_soort` varchar(125) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden geëxporteerd voor tabel `leveranciers`
--

INSERT INTO `leveranciers` (`lev_nr`, `lev_naam`, `lev_adres`, `lev_postcode`, `lev_plaats`, `lev_telefoonnr`, `lev_rekeningnr`, `lev_soort`) VALUES
(1, 'Huuskes', 'Gronausestraat 425', '7503 GC', 'Enschede', 534808707, 0, 'Vlees'),
(2, 'Zainab', 'Keulsche Vaart 15D', '3621 MX', 'Breukelen', 346262933, 0, 'Aardappels, groenten en fruit'),
(3, 'Agrico', 'Puttensteinsveldweg 22', '8091 BS', 'Wezep', 436974521, 0, 'Buitenlands ingredienten'),
(4, 'Hanos', 'Hoofdweg 964B', '6498 HD', 'Groningen', 501364897, 0, 'Vis'),
(5, 'Gall en Gall', 'Hoofdweg 45', '9711 RB', 'Groningen', 501364563, 0, 'Side order');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerkers`
--

CREATE TABLE IF NOT EXISTS `medewerkers` (
`medewerkernr` int(8) NOT NULL,
  `voornaam` varchar(125) NOT NULL,
  `achternaam` varchar(125) NOT NULL,
  `telefoonnr` varchar(10) NOT NULL,
  `functie` varchar(125) NOT NULL,
  `wachtwoord` varchar(125) NOT NULL,
  `email` varchar(125) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Gegevens worden geëxporteerd voor tabel `medewerkers`
--

INSERT INTO `medewerkers` (`medewerkernr`, `voornaam`, `achternaam`, `telefoonnr`, `functie`, `wachtwoord`, `email`) VALUES
(1, 'Inge', 'Vis', '508465234', 'Chef de Cuisine', 'wachtwoord', 'ingevis@hotmail.com'),
(2, 'Tim', 'Vis', '50766845', 'Chef de Cuisine', 'wachtwoord', 'timvis@hotmail.com'),
(3, 'Fran', 'Boom', '558495534', 'Medewerker keuken', 'wachtwoord', 'franboom@hotmail.com'),
(4, 'Ienes', 'Klimp', '596354786', 'Medewerker keuken', 'wachtwoord', 'ienesklimp@gmail.com'),
(5, 'Hans', 'Schipper', '526144769', 'Medewerker keuken', 'wachtwoord', 'hansschipper@gmail.com'),
(6, 'Frank', 'Heinemann', '596354786', 'Magazijnmedewerker', 'wachtwoord', 'frankheinemann@gmail.com'),
(7, 'Anita', 'Fijn', '597423689', 'Magazijnmedewerker', 'wachtwoord', 'anitafijn@gmail.com'),
(8, 'Jeroen', 'de Vries', '503451698', 'Hoofd administratie', 'wachtwoord', 'jeroendevries@gmail.com'),
(9, 'Bert', 'Bartels', '503486398', 'Financiele administratie', 'wachtwoord', 'bertbartels@gmail.com'),
(10, 'Els', 'Zoon', '512469872', 'Personeelsadministratie', 'wachtwoord', 'elszoon@gmail.com'),
(11, 'Gerard', 'van Holten', '503456684', 'Hoofd expeditie', 'wachtwoord', 'gerardvanholten@gmail.com'),
(12, 'Jan', 'Anders', '505668423', 'Chauffeur', 'wachtwoord', 'jananders@gmail.com'),
(13, 'Tim', 'de Vries', '503451778', 'Chauffeur', 'wachtwoord', 'timdevries@gmail.com'),
(14, 'Kim', 'Meijer', '503444778', 'Chauffeur', 'wachtwoord', 'kimmeijer@gmail.com'),
(15, 'Sil', 'Menens', '503455487', 'Chauffeur', 'wachtwoord', 'silmenens@gmail.com'),
(16, 'Vincent', 'Achterhoek', '598426879', 'Chauffeur', 'wachtwoord', 'vincentachterhoek@gmail.com'),
(17, 'Mark', 'de Jong', '503477858', 'Chauffeur', 'wachtwoord', 'markdejong@gmail.com'),
(18, 'Hanneke', 'Scheepstra', '564889971', 'Hoofd commerciële afdeling', 'wachtwoord', 'hannekescheepstra@gmail.com'),
(19, 'Lars', 'Pieters', '504489652', 'Medewerker inkoop', 'wachtwoord', 'larspieters@gmail.com'),
(20, 'Hanneke', 'Jubel', '504455695', 'Medewerker verkoop', 'wachtwoord', 'hannekejubel@gmail.com'),
(21, 'Marik', 'Temp', '504444558', 'Medewerker verkoop', 'wachtwoord', 'mariktemp@gmail.com'),
(22, 'John', 'Veenstra', '594568974', 'Medewerker verkoop', 'wachtwoord', 'johnveenstra@home.nl');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`ordernr` int(8) NOT NULL,
  `klantnr` int(8) NOT NULL,
  `status` int(1) NOT NULL,
  `betaald` int(1) NOT NULL,
  `ordertijd` datetime NOT NULL,
  `routenr` int(8) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orderregel`
--

CREATE TABLE IF NOT EXISTS `orderregel` (
`orderregelnr` int(8) NOT NULL,
  `ordernr` int(8) NOT NULL,
  `receptnr` int(8) NOT NULL,
  `aantal` int(8) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recept`
--

CREATE TABLE IF NOT EXISTS `recept` (
`receptnr` int(8) NOT NULL,
  `omschrijving` varchar(125) NOT NULL,
  `verkoopprijs` float NOT NULL,
  `weeknr` varchar(125) NOT NULL,
  `categorie` varchar(125) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Gegevens worden geëxporteerd voor tabel `recept`
--

INSERT INTO `recept` (`receptnr`, `omschrijving`, `verkoopprijs`, `weeknr`, `categorie`) VALUES
(1, 'Patat met frikandel', 2.5, '45', 'Frituur'),
(2, 'Patat met kibbeling', 3, '47', 'Frituur'),
(3, 'Patat met schnitzel', 3.25, '46', 'Frituur'),
(4, 'Patat met hamburger', 3, '46', 'Frituur'),
(5, 'Macaroni', 4.5, '45', 'Italiaans'),
(6, 'Spaghetti', 4.5, '46', 'Italiaans'),
(7, 'Aardappels met spruitjes, gehaktbal en jus', 5.5, '45', 'Hollandse kost'),
(8, 'Aardappels met boontjes, gehaktbal en jus', 5.25, '47', 'Hollandse kost'),
(9, 'Aardappels met spinazie, gehaktbal en jus', 5.4, '47', 'Hollandse kost'),
(10, 'Aardappels met wortels, gehaktbal en jus', 5.25, '46', 'Hollandse kost'),
(11, 'Aardappels met spruitjes, biefstuk en jus', 5.6, '44', 'Hollandse kost'),
(12, 'Aardappels met boontjes, biefstuk en jus', 5.35, '44', 'Hollandse kost'),
(13, 'Aardappels met spinazie, biefstuk en jus', 5.5, '44', 'Hollandse kost'),
(14, 'Aardappels met wortels, biefstuk en jus', 5.35, '46', 'Hollandse kost'),
(15, 'Cola 1l', 4.5, null, 'Side order'),
(16, 'Sinas 1l', 4.5, null, 'Side order'),
(17, 'Sprite 1l', 4.5, null, 'Side order'),
(18, 'Rode wijn 1l', 5, null, 'Side order'),
(19, 'Witte wijn 1l', 5, null, 'Side order'),
(20, 'Wijn van het huis 1l', 7, null, 'Side order'),
(21, 'Hertog Jan sixpack', 4.5, null, 'Side order');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `routelijst`
--

CREATE TABLE IF NOT EXISTS `routelijst` (
`routenr` int(8) NOT NULL,
  `maximale_uitrijtijd` datetime NOT NULL,
  `postcodegebied` int(4) NOT NULL,
  `medewerkernr` int(8) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikel`
--
ALTER TABLE `artikel`
 ADD PRIMARY KEY (`artikelnr`);

--
-- Indexen voor tabel `artikelrecept`
--
ALTER TABLE `artikelrecept`
 ADD PRIMARY KEY (`artikelnr`,`receptnr`), ADD KEY `artikelnr` (`artikelnr`), ADD KEY `receptnr` (`receptnr`);

--
-- Indexen voor tabel `inkooporder`
--
ALTER TABLE `inkooporder`
 ADD PRIMARY KEY (`inkoopordernr`), ADD KEY `lev_nr` (`lev_nr`);

--
-- Indexen voor tabel `inkooporderregel`
--
ALTER TABLE `inkooporderregel`
 ADD PRIMARY KEY (`inkooporderregelnr`), ADD KEY `artikelnr` (`artikelnr`), ADD KEY `inkoopordernr` (`inkoopordernr`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
 ADD PRIMARY KEY (`klantnr`);

--
-- Indexen voor tabel `leveranciers`
--
ALTER TABLE `leveranciers`
 ADD PRIMARY KEY (`lev_nr`);

--
-- Indexen voor tabel `medewerkers`
--
ALTER TABLE `medewerkers`
 ADD PRIMARY KEY (`medewerkernr`);

--
-- Indexen voor tabel `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`ordernr`), ADD KEY `klantnr` (`klantnr`), ADD KEY `routenr` (`routenr`);

--
-- Indexen voor tabel `orderregel`
--
ALTER TABLE `orderregel`
 ADD PRIMARY KEY (`orderregelnr`), ADD KEY `ordernr` (`ordernr`,`receptnr`), ADD KEY `receptnr` (`receptnr`);

--
-- Indexen voor tabel `recept`
--
ALTER TABLE `recept`
 ADD PRIMARY KEY (`receptnr`);

--
-- Indexen voor tabel `routelijst`
--
ALTER TABLE `routelijst`
 ADD PRIMARY KEY (`routenr`), ADD KEY `medewerkernr` (`medewerkernr`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikel`
--
ALTER TABLE `artikel`
MODIFY `artikelnr` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT voor een tabel `inkooporder`
--
ALTER TABLE `inkooporder`
MODIFY `inkoopordernr` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `inkooporderregel`
--
ALTER TABLE `inkooporderregel`
MODIFY `inkooporderregelnr` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
MODIFY `klantnr` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `leveranciers`
--
ALTER TABLE `leveranciers`
MODIFY `lev_nr` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `medewerkers`
--
ALTER TABLE `medewerkers`
MODIFY `medewerkernr` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT voor een tabel `order`
--
ALTER TABLE `order`
MODIFY `ordernr` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT voor een tabel `orderregel`
--
ALTER TABLE `orderregel`
MODIFY `orderregelnr` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT voor een tabel `recept`
--
ALTER TABLE `recept`
MODIFY `receptnr` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT voor een tabel `routelijst`
--
ALTER TABLE `routelijst`
MODIFY `routenr` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `artikelrecept`
--
ALTER TABLE `artikelrecept`
ADD CONSTRAINT `arrec_ar` FOREIGN KEY (`artikelnr`) REFERENCES `artikel` (`artikelnr`),
ADD CONSTRAINT `arrec_re` FOREIGN KEY (`receptnr`) REFERENCES `recept` (`receptnr`);

--
-- Beperkingen voor tabel `inkooporder`
--
ALTER TABLE `inkooporder`
ADD CONSTRAINT `inko_lev` FOREIGN KEY (`lev_nr`) REFERENCES `leveranciers` (`lev_nr`);

--
-- Beperkingen voor tabel `inkooporderregel`
--
ALTER TABLE `inkooporderregel`
ADD CONSTRAINT `inkor_art` FOREIGN KEY (`artikelnr`) REFERENCES `artikel` (`artikelnr`),
ADD CONSTRAINT `inkor_inko` FOREIGN KEY (`inkoopordernr`) REFERENCES `inkooporder` (`inkoopordernr`);

--
-- Beperkingen voor tabel `order`
--
ALTER TABLE `order`
ADD CONSTRAINT `or_kl` FOREIGN KEY (`klantnr`) REFERENCES `klant` (`klantnr`),
ADD CONSTRAINT `or_rou` FOREIGN KEY (`routenr`) REFERENCES `routelijst` (`routenr`);

--
-- Beperkingen voor tabel `orderregel`
--
ALTER TABLE `orderregel`
ADD CONSTRAINT `or_o` FOREIGN KEY (`ordernr`) REFERENCES `order` (`ordernr`),
ADD CONSTRAINT `orr_rec` FOREIGN KEY (`receptnr`) REFERENCES `recept` (`receptnr`);

--
-- Beperkingen voor tabel `routelijst`
--
ALTER TABLE `routelijst`
ADD CONSTRAINT `rl_med` FOREIGN KEY (`medewerkernr`) REFERENCES `medewerkers` (`medewerkernr`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
