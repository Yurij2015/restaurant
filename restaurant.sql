-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 15 2019 г., 21:32
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `restaurant`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chek`
--

CREATE TABLE `chek` (
  `id_chek` int(11) NOT NULL,
  `summa_chek` double DEFAULT NULL,
  `date_chek` date DEFAULT NULL,
  `summa_nomer` double DEFAULT NULL,
  `summa_service` double DEFAULT NULL,
  `client_id_client` int(11) NOT NULL,
  `menu_id_item` int(11) NOT NULL,
  `order_idorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `second_name` varchar(100) NOT NULL,
  `date` date NOT NULL COMMENT 'Дата рождения',
  `pasport` varchar(100) NOT NULL,
  `email` char(15) NOT NULL,
  `telefon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id_item` int(11) NOT NULL,
  `del_title` varchar(100) DEFAULT NULL,
  `class_menu` varchar(100) DEFAULT NULL,
  `number_peace_menu` int(11) DEFAULT NULL,
  `restorans_id_restoran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `menu_season_price`
--

CREATE TABLE `menu_season_price` (
  `menu_id_item` int(11) NOT NULL,
  `price_id_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `idorder` int(11) NOT NULL,
  `order_numb` varchar(45) NOT NULL,
  `date_order` date NOT NULL,
  `client_id_client` int(11) NOT NULL,
  `menu_season_price` int(11) DEFAULT NULL,
  `price_menu` double DEFAULT NULL,
  `service` int(11) DEFAULT NULL,
  `price_service` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `price`
--

CREATE TABLE `price` (
  `id_price` int(11) NOT NULL,
  `price_summer` double NOT NULL,
  `price_fall` double NOT NULL,
  `price_winter` double NOT NULL,
  `price_spring` double NOT NULL,
  `menu_id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `restorans`
--

CREATE TABLE `restorans` (
  `id_restoran` int(11) NOT NULL,
  `number_phone_restoran` varchar(10) NOT NULL,
  `email` char(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `resto_title` varchar(145) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `season_price_service`
--

CREATE TABLE `season_price_service` (
  `id_price_service` int(11) NOT NULL,
  `price_summer` double NOT NULL,
  `price_fall` double NOT NULL,
  `price_winter` double NOT NULL,
  `price_spring` double NOT NULL,
  `service_id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `service_title` varchar(100) DEFAULT NULL,
  `servicedescription` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `service_client`
--

CREATE TABLE `service_client` (
  `id_service` int(11) NOT NULL,
  `number_service` varchar(45) DEFAULT NULL,
  `summa_service` double DEFAULT NULL,
  `client_id_client` int(11) NOT NULL,
  `season_price_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `service_season_price`
--

CREATE TABLE `service_season_price` (
  `service_id_service` int(11) NOT NULL,
  `season_price_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `chek_id_chek` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` char(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `userscol` tinyint(4) DEFAULT NULL,
  `client_id_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chek`
--
ALTER TABLE `chek`
  ADD PRIMARY KEY (`id_chek`),
  ADD KEY `fk_chek_client1_idx` (`client_id_client`),
  ADD KEY `fk_chek_menu1_idx` (`menu_id_item`),
  ADD KEY `fk_chek_order1_idx` (`order_idorder`);

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_menu_restorans_idx` (`restorans_id_restoran`);

--
-- Индексы таблицы `menu_season_price`
--
ALTER TABLE `menu_season_price`
  ADD PRIMARY KEY (`menu_id_item`,`price_id_price`),
  ADD KEY `fk_menu_has_price_price1_idx` (`price_id_price`),
  ADD KEY `fk_menu_has_price_menu1_idx` (`menu_id_item`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idorder`),
  ADD KEY `fk_order_client1_idx` (`client_id_client`),
  ADD KEY `fk_order_menu_season_price1_idx` (`menu_season_price`),
  ADD KEY `fk_order_service_season_price1_idx` (`service`);

--
-- Индексы таблицы `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id_price`),
  ADD KEY `fk_price_menu1_idx` (`menu_id_item`);

--
-- Индексы таблицы `restorans`
--
ALTER TABLE `restorans`
  ADD PRIMARY KEY (`id_restoran`);

--
-- Индексы таблицы `season_price_service`
--
ALTER TABLE `season_price_service`
  ADD PRIMARY KEY (`id_price_service`),
  ADD KEY `fk_season_price_service_service1_idx` (`service_id_service`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Индексы таблицы `service_client`
--
ALTER TABLE `service_client`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `fk_service_client1_idx` (`client_id_client`),
  ADD KEY `fk_service_client_season_price_service1_idx` (`season_price_service`);

--
-- Индексы таблицы `service_season_price`
--
ALTER TABLE `service_season_price`
  ADD PRIMARY KEY (`service_id_service`,`season_price_service`),
  ADD KEY `fk_service_has_season_price_service_season_price_service1_idx` (`season_price_service`),
  ADD KEY `fk_service_has_season_price_service_service1_idx` (`service_id_service`);

--
-- Индексы таблицы `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `fk_ticket_chek1_idx` (`chek_id_chek`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `fk_users_client1_idx` (`client_id_client`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chek`
--
ALTER TABLE `chek`
  MODIFY `id_chek` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `menu_season_price`
--
ALTER TABLE `menu_season_price`
  MODIFY `menu_id_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `price`
--
ALTER TABLE `price`
  MODIFY `id_price` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `restorans`
--
ALTER TABLE `restorans`
  MODIFY `id_restoran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `season_price_service`
--
ALTER TABLE `season_price_service`
  MODIFY `id_price_service` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `service_client`
--
ALTER TABLE `service_client`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `chek`
--
ALTER TABLE `chek`
  ADD CONSTRAINT `fk_chek_client1` FOREIGN KEY (`client_id_client`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chek_menu1` FOREIGN KEY (`menu_id_item`) REFERENCES `menu` (`id_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chek_order1` FOREIGN KEY (`order_idorder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_restorans` FOREIGN KEY (`restorans_id_restoran`) REFERENCES `restorans` (`id_restoran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `menu_season_price`
--
ALTER TABLE `menu_season_price`
  ADD CONSTRAINT `fk_menu_has_price_menu1` FOREIGN KEY (`menu_id_item`) REFERENCES `menu` (`id_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_menu_has_price_price1` FOREIGN KEY (`price_id_price`) REFERENCES `price` (`id_price`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_client1` FOREIGN KEY (`client_id_client`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_menu_season_price1` FOREIGN KEY (`menu_season_price`) REFERENCES `menu_season_price` (`price_id_price`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_service_season_price1` FOREIGN KEY (`service`) REFERENCES `service_season_price` (`service_id_service`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `fk_price_menu1` FOREIGN KEY (`menu_id_item`) REFERENCES `menu` (`id_item`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `season_price_service`
--
ALTER TABLE `season_price_service`
  ADD CONSTRAINT `fk_season_price_service_service1` FOREIGN KEY (`service_id_service`) REFERENCES `service` (`id_service`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `service_client`
--
ALTER TABLE `service_client`
  ADD CONSTRAINT `fk_service_client1` FOREIGN KEY (`client_id_client`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_service_client_season_price_service1` FOREIGN KEY (`season_price_service`) REFERENCES `season_price_service` (`id_price_service`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `service_season_price`
--
ALTER TABLE `service_season_price`
  ADD CONSTRAINT `fk_service_has_season_price_service_season_price_service1` FOREIGN KEY (`season_price_service`) REFERENCES `season_price_service` (`id_price_service`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_service_has_season_price_service_service1` FOREIGN KEY (`service_id_service`) REFERENCES `service` (`id_service`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_ticket_chek1` FOREIGN KEY (`chek_id_chek`) REFERENCES `chek` (`id_chek`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_client1` FOREIGN KEY (`client_id_client`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
