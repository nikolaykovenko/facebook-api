-- phpMyAdmin SQL Dump
-- version 4.3.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 08 2015 г., 10:15
-- Версия сервера: 5.5.34
-- Версия PHP: 5.4.25

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `facebook_api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(10) unsigned NOT NULL,
  `apiId` varchar(255) NOT NULL,
  `apiController` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `imageUrl` text,
  `token` text NOT NULL,
  `registerTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `apiId`, `apiController`, `name`, `email`, `imageUrl`, `token`, `registerTime`) VALUES
(2, '1030719803625273', 'facebook', 'Kolya Kovenko', 'nikolay.kovenko@gmail.com', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xap1/v/t1.0-1/c19.1.318.318/p320x320/1496634_797510523612870_595589738_n.jpg?oh=07492d83ab55981242ddf6d427a85b21&oe=558D0BAF&__gda__=1435001757_ca09978de4c389d7573ebe3d9cfa6f42', 'CAAI3Su7ZAejoBAP39MHoZBqyPcuZASdP0XXF2NYdZBYZBC5ZAZC6vptnkJwm6OpBe3yG0Nm6XbjjjZAd3FJjdXa5yybrXZAo3VjCfDPyiAkbxAKQcEZCGGPXyZBPCVWz94no2nzSVLLlls9y9Yh9mDC8IqzSinjO6tKo6w6fAp5yDdhZBZAkcnvqHT3itikZC5BwhKxo0IpBVtqki44E9o7n6m3PMe', '2015-03-07 11:37:11'),
(3, '647596072036932', 'facebook', 'Oleksandra Kosenkova', 'alex-xs@list.ru', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfa1/v/t1.0-1/c0.0.320.320/p320x320/1544975_439959569467251_283266902_n.jpg?oh=69f32929a989083fc787c5f1a714c233&oe=55939CC8&__gda__=1434950904_fe3243eb413d4348ded5790d26da3bf3', 'CAAI3Su7ZAejoBAMprYAP4li6F0cmPDAFVKnikv3y2618NZCrr56a65Qhx0mfwUelXuihhQZBgN9Pm9Gttd6mZCkTo3tWZCctTZAiwc5OC8mDI0pCmnYGVDam6JJlE4EYh0DeCXrSmAWnefcEbvhaICFK10QvVCM1dr1l4hHZA4FsZAASk37crqZAefAqf74Cub4YyNZCPRgYpA7SyTo5qdCOkv', '2015-03-07 16:46:42');

-- --------------------------------------------------------

--
-- Структура таблицы `user_post`
--

CREATE TABLE IF NOT EXISTS `user_post` (
`id` int(10) unsigned NOT NULL,
  `apiPostId` varchar(255) NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `imageUrl` text,
  `text` text NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `url` text
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_post`
--

INSERT INTO `user_post` (`id`, `apiPostId`, `userId`, `imageUrl`, `text`, `date`, `url`) VALUES
(1, '1030719803625273_1025171280846792', 2, 'https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xfp1/v/t1.0-9/s130x130/10414834_436873819796797_2357540839860042735_n.jpg?oh=960b875ee3b56abeb1783f88590a0ddb&oe=5584F928&__gda__=1438559000_2f986191037d18ecd6110c479a7db000', 'Продано.Ще один унікальний лот! Відстріляна РПГ- 18 з підписами хлопців з Протитанкової батареї 93 бригади. Привезена  волонтерами з АТО.\n\nСтарт - 3000 грн. Бліц - 10000 грн.\n\nВажливо:кошти підуть на купівлю генератора. Терміново!\n\nРепост поліпшує карму, підіймає настрій і наближує перемогу', '2015-02-24 16:51:46', 'https://www.facebook.com/auction.ua/photos/a.331763070307873.1073741828.331756376975209/436873819796797/?type=1'),
(2, '1030719803625273_1015858368444750', 2, 'https://fbcdn-sphotos-c-a.akamaihd.net/hphotos-ak-xfp1/v/t1.0-9/q85/s130x130/1978830_1015858345111419_8205027539281383489_n.jpg?oh=6d5c5758af27fe735e862f30b8a5daba&oe=55728C95&__gda__=1438391356_a9fd39ba614fb17f4890898a935aa996', 'Оооо, що мені принесли. Кульок справжнього укропського школяра =)', '2015-02-09 07:10:42', 'https://www.facebook.com/photo.php?fbid=1015858345111419&set=a.857964167567505.1073741828.100000617891628&type=1'),
(3, '1030719803625273_1014491131914807', 2, 'https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-xap1/v/t1.0-9/s130x130/10947318_1014491111914809_2967564257953327078_n.jpg?oh=db3f657ae8c4eeb603b00d52fb85c985&oe=558C1EB4&__gda__=1438482828_2c5de115db007549809f473af45671f3', 'Розсилка із підбіркою безпрограшних подарунків до дня святого валентина від цитруса =)', '2015-02-06 16:43:05', 'https://www.facebook.com/photo.php?fbid=1014491111914809&set=a.832783073418948.1073741827.100000617891628&type=1'),
(4, '1030719803625273_1010302875666966', 2, 'https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xfp1/v/t1.0-9/p130x130/10155478_1010302879000299_7658499525031725288_n.jpg?oh=38a3547b1387d219bee58c29271aaf63&oe=557F856F&__gda__=1435527614_a1555a638802448b47de7795ce57187c', 'Програмерський креатив', '2015-01-30 13:56:14', 'https://www.facebook.com/photo.php?fbid=1010302879000299&set=a.477519498945309.111651.100000617891628&type=1'),
(5, '1030719803625273_1008742755822978', 2, 'https://fbcdn-sphotos-a-a.akamaihd.net/hphotos-ak-xpf1/v/t1.0-9/p130x130/10952473_1008742759156311_776700819201610505_n.jpg?oh=6878ffde2249c803f56888fce89ef81a&oe=55711D48&__gda__=1434606325_5ca6e65b185ac50c6b0aa81bfb71ff91', 'Just received calendars with Anneke Beerten autographs. Anneke, thank you a lot, they''re great!', '2015-01-27 14:05:14', 'https://www.facebook.com/photo.php?fbid=1008742759156311&set=a.477519498945309.111651.100000617891628&type=1'),
(6, '1', 3, NULL, 'Тест', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_post_like`
--

CREATE TABLE IF NOT EXISTS `user_post_like` (
`id` int(10) unsigned NOT NULL,
  `post` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `likeType` enum('-1','1') NOT NULL DEFAULT '1',
  `addTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_post_like`
--

INSERT INTO `user_post_like` (`id`, `post`, `user`, `likeType`, `addTime`) VALUES
(1, 1, 2, '1', '2015-03-08 06:39:49'),
(2, 2, 2, '-1', '2015-03-08 06:41:40'),
(3, 1, 3, '1', '2015-03-08 06:42:43'),
(4, 3, 2, '-1', '2015-03-08 07:01:01'),
(5, 4, 2, '-1', '2015-03-08 07:01:09'),
(6, 5, 2, '-1', '2015-03-08 07:01:23');

-- --------------------------------------------------------

--
-- Структура таблицы `user_post_tag`
--

CREATE TABLE IF NOT EXISTS `user_post_tag` (
`id` int(10) unsigned NOT NULL,
  `post` int(10) unsigned NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_post_tag`
--

INSERT INTO `user_post_tag` (`id`, `post`, `tag`) VALUES
(8, 1, 'fa'),
(1, 1, 'ff'),
(3, 1, 'fff'),
(9, 1, 'fffff'),
(7, 1, 'аааа'),
(10, 1, 'Новий тег'),
(2, 1, 'Тег'),
(6, 1, 'Тест'),
(5, 2, 'fff'),
(4, 2, 'Новый тег'),
(11, 3, 'Тег');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `apiId` (`apiId`);

--
-- Индексы таблицы `user_post`
--
ALTER TABLE `user_post`
 ADD PRIMARY KEY (`id`), ADD KEY `userId` (`userId`), ADD KEY `apiPostId` (`apiPostId`);

--
-- Индексы таблицы `user_post_like`
--
ALTER TABLE `user_post_like`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `post_2` (`post`,`user`), ADD KEY `post` (`post`), ADD KEY `user` (`user`);

--
-- Индексы таблицы `user_post_tag`
--
ALTER TABLE `user_post_tag`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `post_2` (`post`,`tag`), ADD KEY `post` (`post`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `user_post`
--
ALTER TABLE `user_post`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `user_post_like`
--
ALTER TABLE `user_post_like`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `user_post_tag`
--
ALTER TABLE `user_post_tag`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_post`
--
ALTER TABLE `user_post`
ADD CONSTRAINT `user_post_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_post_like`
--
ALTER TABLE `user_post_like`
ADD CONSTRAINT `user_post_like_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_post_like_ibfk_1` FOREIGN KEY (`post`) REFERENCES `user_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_post_tag`
--
ALTER TABLE `user_post_tag`
ADD CONSTRAINT `user_post_tag_ibfk_1` FOREIGN KEY (`post`) REFERENCES `user_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
