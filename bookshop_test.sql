SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookshop_test`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `bookshop_book`
--

CREATE TABLE `bookshop_book` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `isbn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `bookshop_category`
--

CREATE TABLE `bookshop_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `bookshop_book`
--
ALTER TABLE `bookshop_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3D28167312469DE2` (`category_id`),
  ADD KEY `IDX_BOOKTITLE` (`title`),
  ADD KEY `IDX_BOOKAUTHOR` (`author`);

--
-- Indici per le tabelle `bookshop_category`
--
ALTER TABLE `bookshop_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CATEGORYNAME` (`name`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `bookshop_book`
--
ALTER TABLE `bookshop_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT per la tabella `bookshop_category`
--
ALTER TABLE `bookshop_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `bookshop_book`
--
ALTER TABLE `bookshop_book`
  ADD CONSTRAINT `FK_3D28167312469DE2` FOREIGN KEY (`category_id`) REFERENCES `bookshop_category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
