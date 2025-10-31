-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: database:3306
-- Время создания: Окт 31 2025 г., 03:55
-- Версия сервера: 5.7.44
-- Версия PHP: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `docker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `parent_category` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_category`, `slug`) VALUES
(1, 'Строительное оборудование', NULL, 'stroitelynoe-oborudovanie'),
(2, 'Лестницы', 1, 'lestnicy'),
(3, 'Станки', 1, 'stanki'),
(4, 'Отрезные станки', 3, 'otreznye-stanki'),
(5, 'Электроинструменты', NULL, 'elektroinstrumenty'),
(6, 'Оборудование для бетонных работ', NULL, 'oborudovanie-dlya-betonnyh-rabot'),
(7, 'Климатическое оборудование', NULL, 'klimaticheskoe-oborudovanie'),
(8, 'Генераторы (электростанции)', NULL, 'generatory-elektrostancii-'),
(9, 'Сварочное оборудование', NULL, 'svarochnoe-oborudovanie'),
(10, 'Компрессоры и насосы', NULL, 'kompressory-i-nasosy'),
(11, 'Клининговое оборудование', NULL, 'kliningovoe-oborudovanie'),
(12, 'Садовая техника', NULL, 'sadovaya-tehnika'),
(14, 'Гвоздезабивные пистолеты', 5, 'gvozdezabivnye-pistolety'),
(15, 'Перфораторы', 5, 'perforatory'),
(16, 'Рубанки', 5, 'rubanki');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `description`, `img`, `category_id`, `price`) VALUES
(1, 'Абразивный отрезной станок Stalex COM/Cut-Off Machine/-400М/3 J3GA-400 220В в аренду', 'Вес, кг\r\n70\r\nМощность, Вт\r\n3000\r\nНапряжение, В\r\n220\r\nУгол реза, град\r\n45\r\nШирина диска, мм\r\n3.2\r\nМаятниковый механизм\r\nнет\r\nТиски (прижим)\r\nгоризонтальный\r\nКруглая труба: Мах диаметр, мм\r\n135\r\nПруток: Мах диаметр, мм\r\n50\r\nПрямоугольный профиль: Мах размер, мм\r\n126х53\r\nУголок: Мах размер, мм\r\n100х10', '', 4, 800),
(2, 'Абразивно-отрезной станок по металлу АПВ ОСА-П-5.5 4687201721239', 'Вес, кг\r\n95\r\nМощность, Вт\r\n5500\r\nНапряжение, В\r\n380\r\nУгол реза, град\r\n45\r\nШирина диска, мм\r\n3.5\r\nМаятниковый механизм\r\nнет\r\nТиски (прижим)\r\nгоризонтальный\r\nКруглая труба: Мах диаметр, мм\r\n100\r\nПрямоугольный профиль: Мах размер, мм\r\n100х100\r\nУголок: Мах размер, мм\r\n100х100', '', 4, NULL),
(3, 'товар', '', NULL, 5, 1222);

-- --------------------------------------------------------

--
-- Структура таблицы `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `properties_good`
--

CREATE TABLE `properties_good` (
  `id` int(11) NOT NULL,
  `properties_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `parent_category` (`parent_category`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `properties_good`
--
ALTER TABLE `properties_good`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_id` (`goods_id`),
  ADD KEY `properties_id` (`properties_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `properties_good`
--
ALTER TABLE `properties_good`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_category`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `properties_good`
--
ALTER TABLE `properties_good`
  ADD CONSTRAINT `properties_good_ibfk_1` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_good_ibfk_2` FOREIGN KEY (`properties_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
