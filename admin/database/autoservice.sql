-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 28 2025 г., 18:46
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `autoservice`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auto`
--

CREATE TABLE `auto` (
  `idauto` int(11) NOT NULL,
  `number` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `VIN` varchar(17) COLLATE utf8_bin DEFAULT NULL,
  `model` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `mileage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `auto`
--

INSERT INTO `auto` (`idauto`, `number`, `VIN`, `model`, `year`, `mileage`) VALUES
(1, 'О343ВА59', '11111111111111111', 'Lada Kalina', 2009, 140000),
(2, 'Р738АП59', '22222222222222222', 'Kia Rio', 2017, 40000),
(5, 'А333АА59', '33333334333333333', 'BMW X5M', 2021, 100000),
(6, 'М755РХ777', 'UN2MV733022970745', 'Hyundai Elantra', 2002, 132569),
(8, 'О003ОС48', 'XA5SV344566052722', 'Focus Active', 2018, 48102),
(9, 'У947ВТ24', 'TE7MY595850116000', 'Chery Tiggo 4', 2017, 59372),
(10, 'У696СЕ57', 'PS4RB871150822798', 'Geely Coolray', 2019, 25099),
(11, 'К101ВЕ80', 'FU6ZW042695046832', 'Audi A5', 2016, 69217),
(12, 'Н394УР65', 'EL0GP083265370894', 'Infiniti EX', 2008, 361933),
(13, 'Т088АВ84', 'YY3AF354355461403', 'Ford C-Max', 2015, 51879),
(14, 'Н777НН92', 'DV6YF619531095164', 'Chevrolet Corvette', 2017, 60099),
(15, 'Е555ЕЕ59', 'ME0NU284670648530', 'BMW X7', 2022, 33796),
(16, 'М893ОО50', 'ED9ND677415385743', 'BMW M5', 2000, 89881),
(17, 'Н370ВС79', 'WA9SY216020085991', 'Volvo XC40', 2020, 23733),
(18, 'Т300СЕ70', 'UY1VT408546006512', 'Ford Focus', 2000, 374137),
(19, 'Х187ХХ46', 'GU7TL003570655021', 'BMW X4', 2017, 98674),
(20, 'М441ММ92', 'ED1TP858161998659', 'Honda Civic', 2019, 36826);

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `idclient` int(11) NOT NULL,
  `client` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`idclient`, `client`, `phone`) VALUES
(1, 'Сергеев Игнатий Вячеславович', '+79054643874'),
(2, 'Петров Вячеслав Артемович', '3344112'),
(7, 'Пончиков Герасим Семенович', '+79729838694'),
(8, 'Дементьев Павел Кириллович', '+79834701370'),
(9, 'Пшеничников Давид Захарович', '+79838781822'),
(10, 'Бичурин Яков Серафимович', '+79844419122'),
(11, 'Авдошкин Василий Степанович', '+79511451375'),
(12, 'Жданов Филипп Макарович', '+79354468224'),
(13, 'Корсаков Илья Никандрович', '+79416723690'),
(14, 'Андреев Аркадий Тимофеевич', '+79642595112'),
(15, 'Янков Яков Константинович', '+79381464324'),
(16, 'Свиридов Кузьма Егорович', '+79547965319'),
(17, 'Козаков Николай Германович', '+79798698629'),
(18, 'Энгельгардт Максим Витальевич', '+79198726041'),
(19, 'Качаев Михаил Савванович', '+79743316392'),
(20, 'Кобяков Петр Тимофеевич', '+79293594343'),
(21, 'Выгузов Иван Давидович', '+79198866999'),
(22, 'Мирнов Василий Романович', '+79634486864'),
(23, 'Увакин Тарас Александрович', '+79484396872'),
(24, 'Коломийцев Петр Аркадинович', '+79582465817'),
(25, 'Захаров Арсений Никитович', '+79306386477'),
(26, 'Акакий Петров Иванович', '+79999999999');

-- --------------------------------------------------------

--
-- Структура таблицы `detail`
--

CREATE TABLE `detail` (
  `iddetail` int(11) NOT NULL,
  `detail` varchar(130) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iddetailtype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `detail`
--

INSERT INTO `detail` (`iddetail`, `detail`, `iddetailtype`) VALUES
(1, 'Комплект сцепления', 1),
(2, 'МКПП в сборе', 1),
(3, 'Подвес МКПП', 1),
(4, 'Комплект прокладок МКПП', 1),
(5, 'Трансмиссионное масло', 1),
(6, 'Сальник МКПП', 1),
(7, 'Ручка КПП', 1),
(8, 'Трос КПП', 1),
(9, 'ШРУС наружный', 1),
(10, 'ШРУС внутренний', 1),
(11, 'Масло Haldex', 1),
(12, 'Масло для заднего редуктора', 1),
(13, 'Масло для переднего редуктора', 1),
(14, 'Масло для раздаточной коробки', 1),
(15, 'Масло CVT', 1),
(16, 'ATF жидкость', 1),
(17, 'АКПП / CVT в сборе', 1),
(18, 'Ремкомплект АКПП', 1),
(19, 'Рулевой механизм', 2),
(20, 'Рулевая тяга', 2),
(21, 'Гидравлическая жидкость', 2),
(22, 'Ремкомплект рулевой рейки', 2),
(23, 'Рулевая рейка', 2),
(24, 'Насос ГУР', 2),
(25, 'Ремкомплект насоса ГУР', 2),
(26, 'Ремкомплект подвески', 3),
(27, 'Диагностическое оборудование', 3),
(28, 'Амортизатор задний', 3),
(29, 'Амортизатор передний', 3),
(30, 'Ступица', 3),
(31, 'Шаровая опора', 3),
(32, 'Стойка стабилизатора', 3),
(33, 'Сайлентблок', 3),
(34, 'Полуось', 3),
(35, 'Смазка ходовой части', 3),
(36, 'Масло раздатки', 3),
(37, 'Крестовина кардана', 3),
(38, 'Карданный вал', 3),
(39, 'Ремкомплект тормозной системы', 4),
(40, 'Передние тормозные колодки', 4),
(41, 'Задние тормозные колодки', 4),
(42, 'Передние тормозные диски', 4),
(43, 'Задние тормозные диски', 4),
(44, 'Тормозная жидкость', 4),
(45, 'Суппорт', 4),
(46, 'Бензонасос', 5),
(47, 'Диагностический сканер', 5),
(48, 'Тест стенд для форсунок', 5),
(49, 'Жидкость для промывки инжекторов', 5),
(50, 'Уплотнитель форсунки', 5),
(51, 'Компрессор кондиционера', 6),
(52, 'Диагностический модуль A/C', 6),
(53, 'Антибактериальный спрей', 6),
(54, 'Промывочная жидкость', 6),
(55, 'Хладагент', 6),
(56, 'Фильтр салона', 6),
(57, 'Ремкомплект двигателя', 7),
(58, 'Диагностический сканер', 7),
(59, 'Катушка зажигания', 7),
(60, 'Моторное масло', 7),
(61, 'Воздушный фильтр', 7),
(62, 'Свечи зажигания', 7),
(63, 'Турбина в сборе', 7),
(64, 'Ремкомплект турбины', 7),
(65, 'Охладитель радиатора', 7),
(66, 'Моющее средство для двигателя', 7),
(67, 'Глушитель', 8),
(68, 'Катализатор', 8),
(69, 'Ремонтный комплект катализатора', 8),
(70, 'Диагностический модуль выхлопа', 8),
(71, 'Прокладки выхлопной системы', 8),
(72, 'Антифриз', 9),
(73, 'Радиатор', 11),
(74, 'Термостат', 12),
(75, 'Диагностическое реле вентилятора', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `detailorder`
--

CREATE TABLE `detailorder` (
  `iddetailorder` int(11) NOT NULL,
  `idorderclient` int(11) NOT NULL,
  `iddetail` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price_at_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `detailorder`
--

INSERT INTO `detailorder` (`iddetailorder`, `idorderclient`, `iddetail`, `count`, `price_at_order`) VALUES
(4, 7, 29, 2, 3700),
(7, 5, 33, 1, 950),
(14, 2, 30, 1, 4200),
(60, 1, 6, 2, 700),
(61, 1, 7, 1, 900),
(62, 1, 8, 1, 2500),
(63, 1, 55, 1, 1200),
(64, 3, 60, 1, 2200),
(67, 21, 2, 1, 48000),
(68, 21, 3, 1, 3500),
(70, 37, 1, 1, 13000),
(71, 37, 61, 1, 600),
(72, 32, 47, 1, 1800),
(73, 25, 20, 1, 1900),
(74, 25, 21, 1, 850),
(77, 40, 1, 1, 14000),
(79, 42, 1, 1, 14000),
(80, 42, 3, 1, 3500),
(81, 42, 4, 1, 2200),
(82, 42, 5, 1, 1800),
(83, 42, 6, 2, 700),
(84, 42, 8, 1, 2500),
(85, 42, 68, 1, 14800),
(86, 41, 46, 1, 5200),
(87, 41, 57, 1, 12500),
(88, 41, 58, 1, 1800),
(89, 41, 59, 2, 2500),
(90, 41, 60, 1, 2200);

-- --------------------------------------------------------

--
-- Структура таблицы `detailtype`
--

CREATE TABLE `detailtype` (
  `id_type` int(11) NOT NULL,
  `type` varchar(130) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `detailtype`
--

INSERT INTO `detailtype` (`id_type`, `type`) VALUES
(1, 'Ремонт трансмиссии'),
(2, 'Ремонт рулевого управления'),
(3, 'Ремонт подвески'),
(4, 'Ремонт тормозной системы'),
(5, 'Ремонт топливной системы'),
(6, 'Ремонт авто кондиционеров'),
(7, 'Ремонт двигателей'),
(8, 'Ремонт выхлопной системы'),
(9, 'Замена антифриза'),
(10, 'Опрессовка системы охлаждения'),
(11, 'Замена радиатора охлаждения'),
(12, 'Замена термостата двигателя'),
(13, 'Диагностика вентилятора охлаждения двигателя'),
(14, 'Ремонт системы охлаждения');

-- --------------------------------------------------------

--
-- Структура таблицы `detail_price_list`
--

CREATE TABLE `detail_price_list` (
  `iddetail_price_list` int(11) NOT NULL,
  `iddetail` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `start_data` date NOT NULL,
  `end_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `detail_price_list`
--

INSERT INTO `detail_price_list` (`iddetail_price_list`, `iddetail`, `price`, `start_data`, `end_data`) VALUES
(1, 1, 12500, '2021-01-01', '2021-01-05'),
(2, 2, 48000, '2021-01-01', NULL),
(3, 3, 3500, '2021-01-01', NULL),
(4, 4, 2200, '2021-01-01', NULL),
(5, 5, 1800, '2021-01-01', NULL),
(6, 6, 700, '2021-01-01', NULL),
(7, 7, 900, '2021-01-01', NULL),
(8, 8, 2500, '2021-01-01', NULL),
(9, 9, 3200, '2021-01-01', NULL),
(10, 10, 3400, '2021-01-01', NULL),
(11, 11, 2600, '2021-01-01', NULL),
(12, 12, 2200, '2021-01-01', NULL),
(13, 13, 2200, '2021-01-01', NULL),
(14, 14, 2400, '2021-01-01', NULL),
(15, 15, 2700, '2021-01-01', NULL),
(16, 16, 2800, '2021-01-01', NULL),
(17, 17, 52000, '2021-01-01', NULL),
(18, 18, 4800, '2021-01-01', NULL),
(19, 19, 11500, '2021-01-01', NULL),
(20, 20, 1900, '2021-01-01', NULL),
(21, 21, 850, '2021-01-01', NULL),
(22, 22, 3300, '2021-01-01', NULL),
(23, 23, 9800, '2021-01-01', NULL),
(24, 24, 6400, '2021-01-01', NULL),
(25, 25, 2100, '2021-01-01', NULL),
(26, 26, 8900, '2021-01-01', NULL),
(27, 27, 1500, '2021-01-01', NULL),
(28, 28, 3400, '2021-01-01', NULL),
(29, 29, 3700, '2021-01-01', NULL),
(30, 30, 4200, '2021-01-01', NULL),
(31, 31, 1800, '2021-01-01', NULL),
(32, 32, 1200, '2021-01-01', NULL),
(33, 33, 950, '2021-01-01', NULL),
(34, 34, 4500, '2021-01-01', NULL),
(35, 35, 400, '2021-01-01', NULL),
(36, 36, 2400, '2021-01-01', NULL),
(37, 37, 1600, '2021-01-01', NULL),
(38, 38, 7200, '2021-01-01', NULL),
(39, 39, 2500, '2021-01-01', NULL),
(40, 40, 1800, '2021-01-01', NULL),
(41, 41, 1700, '2021-01-01', NULL),
(42, 42, 4200, '2021-01-01', NULL),
(43, 43, 3900, '2021-01-01', NULL),
(44, 44, 600, '2021-01-01', NULL),
(45, 45, 3600, '2021-01-01', NULL),
(46, 46, 5200, '2021-01-01', NULL),
(47, 47, 1800, '2021-01-01', NULL),
(48, 48, 0, '2021-01-01', NULL),
(49, 49, 400, '2021-01-01', NULL),
(50, 50, 250, '2021-01-01', NULL),
(51, 51, 8700, '2021-01-01', NULL),
(52, 52, 1500, '2021-01-01', NULL),
(53, 53, 650, '2021-01-01', NULL),
(54, 54, 400, '2021-01-01', NULL),
(55, 55, 1200, '2021-01-01', NULL),
(56, 56, 900, '2021-01-01', NULL),
(57, 57, 12500, '2021-01-01', NULL),
(58, 58, 1800, '2021-01-01', NULL),
(59, 59, 2500, '2021-01-01', NULL),
(60, 60, 2200, '2021-01-01', NULL),
(61, 61, 600, '2021-01-01', NULL),
(62, 62, 1600, '2021-01-01', NULL),
(63, 63, 27000, '2021-01-01', NULL),
(64, 64, 3800, '2021-01-01', NULL),
(65, 65, 1900, '2021-01-01', NULL),
(66, 66, 450, '2021-01-01', NULL),
(67, 67, 6800, '2021-01-01', NULL),
(68, 68, 14800, '2021-01-01', NULL),
(69, 69, 2500, '2021-01-01', NULL),
(70, 70, 1600, '2021-01-01', NULL),
(71, 71, 700, '2021-01-01', NULL),
(72, 72, 850, '2021-01-01', NULL),
(73, 73, 4500, '2021-01-01', NULL),
(74, 74, 2100, '2021-01-01', NULL),
(75, 75, 950, '2021-01-01', NULL),
(80, 1, 14000, '2022-01-01', '2025-05-29');

-- --------------------------------------------------------

--
-- Структура таблицы `login_users`
--

CREATE TABLE `login_users` (
  `id_l` int(11) NOT NULL,
  `login` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `job_pos` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `login_users`
--

INSERT INTO `login_users` (`id_l`, `login`, `password`, `job_pos`) VALUES
(1, 'admin1', 'admin', 'Администратор'),
(2, 'user1', 'user1', 'Механик');

-- --------------------------------------------------------

--
-- Структура таблицы `orderclient`
--

CREATE TABLE `orderclient` (
  `idorderclient` int(11) NOT NULL,
  `dateorder` date DEFAULT NULL,
  `idstatus` int(11) NOT NULL,
  `termorder` date DEFAULT NULL,
  `idworker` int(11) NOT NULL,
  `idauto` int(11) NOT NULL,
  `idclient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `orderclient`
--

INSERT INTO `orderclient` (`idorderclient`, `dateorder`, `idstatus`, `termorder`, `idworker`, `idauto`, `idclient`) VALUES
(1, '2024-10-22', 3, '2024-11-06', 2, 5, 2),
(2, '2024-01-10', 3, '2024-01-15', 1, 5, 1),
(3, '2024-02-12', 3, '2024-09-15', 6, 2, 7),
(4, '2024-04-24', 3, '2024-06-08', 5, 1, 2),
(5, '2024-02-12', 3, '2024-02-12', 2, 5, 1),
(6, '2024-02-15', 3, '2024-02-12', 1, 1, 7),
(7, '2024-02-15', 2, '2024-04-10', 1, 2, 1),
(18, '2024-02-12', 3, '2024-02-10', 5, 1, 2),
(19, '2024-02-01', 3, '2024-02-03', 6, 6, 7),
(20, '2024-05-20', 3, '2024-05-21', 6, 6, 7),
(21, '2024-01-15', 2, '2024-02-15', 6, 9, 10),
(22, '2024-02-05', 3, '2024-03-05', 2, 8, 7),
(23, '2024-03-10', 3, '2024-04-10', 5, 10, 9),
(24, '2024-04-20', 1, '2024-05-20', 6, 9, 2),
(25, '2025-05-12', 3, '2025-06-12', 5, 10, 8),
(26, '2024-06-25', 3, '2024-07-25', 2, 6, 25),
(27, '2024-07-08', 3, '2024-08-08', 6, 9, 10),
(28, '2024-08-19', 1, '2024-09-19', 5, 6, 9),
(29, '2024-09-30', 2, '2024-10-30', 2, 9, 8),
(30, '2024-10-14', 3, '2024-11-14', 6, 8, 10),
(31, '2024-11-23', 4, '2024-12-23', 2, 9, 7),
(32, '2025-05-07', 3, '2025-05-09', 5, 10, 8),
(33, '2025-01-17', 2, '2025-02-17', 6, 8, 9),
(34, '2025-02-28', 3, '2025-03-28', 5, 9, 10),
(35, '2025-03-12', 4, '2025-04-12', 2, 10, 7),
(36, '2025-04-25', 1, '2025-05-25', 6, 8, 25),
(37, '2025-05-06', 3, '2025-05-09', 5, 9, 10),
(38, '2024-06-19', 3, '2024-07-19', 2, 10, 8),
(39, '2024-06-29', 4, '2024-07-29', 6, 8, 9),
(40, '2024-01-01', 3, '2024-01-03', 5, 10, 7),
(41, '2025-06-09', 3, '2025-06-13', 6, 11, 26),
(42, '2025-05-27', 3, '2025-05-28', 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `idservice` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `service` varchar(500) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`idservice`, `id_type`, `service`) VALUES
(1, 1, 'Замена сцепления МКПП'),
(2, 1, 'Замена МКПП'),
(4, 1, 'Снятие/установка МКПП '),
(5, 1, 'Капитальный ремонт МКПП'),
(6, 1, 'Замена масла МКПП'),
(7, 1, 'Замена сальника МКПП'),
(8, 1, 'Замена ручки МКПП'),
(9, 1, 'Замена тросов МКПП'),
(10, 1, 'Замена ШРУС наружный'),
(11, 1, 'Замена ШРУС внутренний'),
(12, 1, 'Замена масла в муфте Халдекс'),
(13, 1, 'Замена масла в редукторе заднего моста'),
(14, 1, 'Замена масла в редукторе переднего моста'),
(15, 1, 'Замена масла в раздаточной коробке передач'),
(16, 1, 'Замена масла в КПП/CTV вариаторного типа'),
(17, 1, 'Замена масла в АКПП'),
(18, 1, 'Замена АКПП /CTV'),
(19, 1, 'Ремонт АКПП'),
(20, 2, 'Ремонт рулевого управления'),
(21, 2, 'Замена рулевой тяги'),
(22, 2, 'Замена жидкости ГУР'),
(23, 2, 'Ремонт рулевой рейки'),
(24, 2, 'Замена рулевой рейки'),
(25, 2, 'Замена насоса ГУР'),
(26, 2, 'Ремонт насоса ГУР'),
(27, 3, 'Ремонт подвески'),
(28, 3, 'Диагностика подвески'),
(29, 3, 'Замена заднего амортизатора'),
(30, 3, 'Замена переднего амортизатора'),
(31, 3, 'Замена ступицы'),
(32, 3, 'Замена шаровой'),
(33, 3, 'Замена стоек стабилизатора'),
(34, 3, 'Замена сайлентблоков'),
(35, 3, 'Замена полуоси'),
(36, 3, 'Шприцевание точек смазки ходовой части и карданного вала'),
(37, 3, 'Замена масла в раздаточной коробке передач'),
(38, 3, 'Замена крестовины карданного вала'),
(39, 3, 'Замена карданного вала'),
(40, 4, 'Ремонт тормозной системы'),
(41, 4, 'Замена передних колодок'),
(42, 4, 'Замена задних колодок'),
(43, 4, 'Замена передних дисков'),
(44, 4, 'Замена задних дисков'),
(45, 4, 'Прокачка тормозной системы'),
(46, 4, 'Замена тормозной жидкости'),
(47, 4, 'Ремонт и обслуживание суппортов'),
(48, 5, 'Замена бензонасоса'),
(49, 5, 'Проверка топливной системы'),
(50, 5, 'Проверка топливных форсунок на стенде'),
(51, 5, 'Промывка инжекторов без с/у форсунок'),
(52, 5, 'Замена уплотнителя топливной форсунки'),
(53, 6, 'Ремонт автокондиционера'),
(54, 6, 'Диагностика автокондиционера'),
(55, 6, 'Антибактериальная обработка системы кондиционирования'),
(56, 6, 'Промывка системы А/С'),
(57, 6, 'Заправка автокондиционера'),
(58, 6, 'Замена фильтра системы вентиляции салона'),
(59, 7, 'Ремонт двигателя'),
(60, 7, 'Компьютерная диагностика ДВС'),
(61, 7, 'Проверка системы зажигания'),
(62, 7, 'Замена масла в ДВС'),
(63, 7, 'Замена воздушного фильтра ДВС'),
(64, 7, 'Замена свечей зажигания'),
(65, 7, 'Замена турбины в сборе'),
(66, 7, 'Ремонт турбины'),
(67, 7, 'Мойка радиаторов со снятием с автомобиля'),
(68, 7, 'Мойка двигателя'),
(69, 8, 'Ремонт выхлопной системы'),
(70, 8, 'Замена катализатора'),
(71, 8, 'Ремонт катализатора'),
(72, 8, 'Ремонт глушителя'),
(73, 8, 'Диагностика системы'),
(74, 8, 'Замена прокладок'),
(75, 9, 'Замена антифриза'),
(76, 11, 'Замена радиатора'),
(77, 12, 'Замена термостата двигателя'),
(78, 13, 'Диагностика вентилятора охлаждения двигателя');

-- --------------------------------------------------------

--
-- Структура таблицы `serviceorder`
--

CREATE TABLE `serviceorder` (
  `idserviceorder` int(11) NOT NULL,
  `idorderclient` int(11) NOT NULL,
  `idservice` int(11) NOT NULL,
  `price_at_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `serviceorder`
--

INSERT INTO `serviceorder` (`idserviceorder`, `idorderclient`, `idservice`, `price_at_order`) VALUES
(3, 4, 9, 1000),
(16, 4, 25, 1000),
(17, 4, 4, 4000),
(19, 19, 10, 1600),
(21, 7, 35, 1000),
(22, 19, 53, 1000),
(23, 19, 42, 1100),
(24, 19, 68, 2000),
(25, 19, 76, 2000),
(30, 19, 2, 3500),
(31, 19, 37, 800),
(32, 19, 62, 600),
(33, 19, 65, 6000),
(34, 19, 74, 700),
(35, 19, 39, 1200),
(36, 19, 53, 1000),
(37, 7, 5, 8000),
(38, 6, 6, 800),
(41, 7, 6, 800),
(42, 7, 78, 1000),
(43, 7, 60, 800),
(44, 7, 35, 1000),
(45, 7, 23, 5000),
(46, 7, 72, 2000),
(47, 7, 66, 3000),
(48, 18, 4, 4000),
(49, 18, 34, 1000),
(50, 18, 31, 1000),
(51, 18, 70, 2000),
(52, 18, 32, 1000),
(53, 18, 11, 2500),
(54, 18, 25, 1000),
(55, 18, 59, 35000),
(56, 7, 2, 3500),
(57, 7, 27, 500),
(58, 7, 45, 1000),
(59, 7, 71, 2000),
(60, 7, 74, 700),
(61, 7, 66, 3000),
(62, 20, 1, 3500),
(63, 20, 2, 3500),
(64, 20, 4, 4000),
(65, 20, 6, 800),
(66, 20, 20, 2000),
(67, 20, 41, 1100),
(68, 20, 42, 1100),
(69, 20, 46, 1000),
(70, 20, 45, 1000),
(71, 20, 65, 6000),
(72, 7, 54, 1000),
(73, 7, 32, 1000),
(74, 7, 62, 600),
(75, 7, 14, 800),
(76, 7, 71, 2000),
(77, 7, 25, 1000),
(78, 7, 46, 1000),
(79, 7, 39, 1200),
(80, 7, 58, 450),
(81, 7, 67, 7000),
(122, 6, 40, 1000),
(123, 7, 54, 1000),
(124, 7, 32, 1000),
(125, 7, 62, 600),
(126, 7, 14, 800),
(127, 7, 71, 2000),
(128, 7, 25, 1000),
(129, 7, 46, 1000),
(130, 7, 39, 1200),
(131, 7, 58, 450),
(132, 7, 67, 7000),
(143, 29, 44, 1200),
(144, 29, 23, 5000),
(145, 29, 53, 1000),
(146, 29, 6, 800),
(147, 29, 37, 800),
(148, 29, 48, 1500),
(149, 29, 59, 35000),
(150, 29, 75, 1000),
(152, 29, 12, 1500),
(173, 6, 40, 1000),
(174, 7, 54, 1000),
(175, 7, 32, 1000),
(176, 7, 62, 600),
(177, 7, 14, 800),
(178, 7, 71, 2000),
(182, 39, 58, 450),
(183, 39, 67, 7000),
(184, 38, 17, 1800),
(186, 36, 36, 800),
(187, 35, 41, 1100),
(188, 34, 74, 700),
(191, 31, 51, 1800),
(193, 28, 78, 1000),
(194, 28, 44, 1200),
(195, 28, 23, 5000),
(196, 27, 53, 1000),
(197, 27, 6, 800),
(198, 27, 37, 800),
(199, 29, 48, 1500),
(200, 29, 59, 35000),
(201, 29, 75, 1000),
(203, 29, 12, 1500),
(204, 26, 29, 1200),
(205, 26, 72, 2000),
(206, 26, 16, 1800),
(207, 26, 57, 950),
(211, 24, 76, 2000),
(212, 24, 11, 2500),
(213, 24, 70, 2000),
(214, 24, 13, 800),
(215, 23, 66, 3000),
(216, 23, 35, 1000),
(217, 23, 56, 4500),
(218, 22, 20, 2000),
(219, 22, 42, 1100),
(220, 22, 68, 2000),
(223, 20, 19, 8000),
(224, 6, 40, 1000),
(225, 6, 26, 1000),
(226, 6, 18, 9000),
(227, 6, 60, 800),
(228, 6, 73, 500),
(229, 6, 24, 3000),
(230, 6, 47, 800),
(231, 6, 10, 1600),
(232, 6, 69, 1000),
(233, 6, 15, 800),
(234, 4, 33, 600),
(235, 4, 64, 800),
(236, 4, 22, 500),
(237, 4, 50, 2500),
(238, 4, 9, 1000),
(240, 4, 55, 1200),
(242, 4, 43, 1200),
(264, 18, 13, 800),
(265, 19, 66, 3000),
(266, 18, 35, 1000),
(267, 18, 56, 4500),
(268, 18, 20, 2000),
(269, 18, 42, 1100),
(270, 19, 68, 2000),
(271, 19, 77, 1200),
(272, 19, 30, 1200),
(273, 19, 19, 8000),
(342, 30, 65, 6000),
(343, 5, 17, 1800),
(344, 5, 63, 300),
(345, 5, 28, 500),
(346, 5, 51, 1800),
(347, 5, 65, 6000),
(348, 5, 78, 1000),
(349, 5, 17, 1800),
(350, 5, 63, 300),
(351, 5, 36, 800),
(352, 5, 41, 1100),
(353, 5, 74, 700),
(354, 5, 28, 500),
(355, 5, 49, 600),
(356, 5, 78, 1000),
(364, 33, 28, 500),
(365, 33, 1, 3500),
(371, 2, 39, 1200),
(372, 2, 49, 600),
(373, 2, 59, 35000),
(374, 2, 21, 1000),
(375, 2, 11, 2500),
(376, 2, 48, 1500),
(407, 1, 56, 4500),
(408, 1, 5, 8000),
(409, 1, 39, 1200),
(410, 1, 6, 800),
(411, 3, 23, 5000),
(412, 3, 53, 1000),
(413, 3, 6, 800),
(414, 3, 37, 800),
(415, 3, 59, 35000),
(439, 21, 77, 1200),
(440, 21, 19, 8000),
(441, 21, 10, 1600),
(442, 21, 5, 8000),
(443, 21, 5, 8000),
(445, 37, 63, 300),
(446, 37, 2, 3500),
(447, 32, 49, 600),
(448, 25, 21, 1000),
(449, 25, 38, 800),
(450, 25, 45, 1000),
(467, 40, 1, 3500),
(475, 42, 1, 3500),
(476, 42, 5, 8000),
(477, 42, 70, 2000),
(479, 41, 59, 35000),
(480, 41, 48, 1500);

-- --------------------------------------------------------

--
-- Структура таблицы `servicerequest`
--

CREATE TABLE `servicerequest` (
  `idservicerequest` int(11) NOT NULL,
  `name` varchar(130) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auto` varchar(130) COLLATE utf8mb4_unicode_ci NOT NULL,
  `problem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `servicerequest`
--

INSERT INTO `servicerequest` (`idservicerequest`, `name`, `phone`, `auto`, `problem`, `date`) VALUES
(7, 'Тупицын Вячеслав Васильевич', '89194992211', 'Nissan Almera', 'Пропуски зажигания', '2025-05-26 10:00:00'),
(8, 'Тупицын Антон Вячеславович', '89194994329', 'Lada Vesta', 'Пропуски зажигания', '2025-05-26 11:00:00'),
(9, 'Бабин Артем', '77777777777', 'Lada Priora', 'Замена масла', '2025-05-27 09:30:00');

-- --------------------------------------------------------

--
-- Структура таблицы `servicetype`
--

CREATE TABLE `servicetype` (
  `id_type` int(11) NOT NULL,
  `type` varchar(130) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `servicetype`
--

INSERT INTO `servicetype` (`id_type`, `type`) VALUES
(1, 'Ремонт трансмиссии'),
(2, 'Ремонт рулевого управления'),
(3, 'Ремонт подвески'),
(4, 'Ремонт тормозной системы'),
(5, 'Ремонт топливной системы'),
(6, 'Ремонт авто кондиционеров'),
(7, 'Ремонт двигателей'),
(8, 'Ремонт выхлопной системы'),
(9, 'Замена антифриза'),
(10, 'Опрессовка системы охлаждения'),
(11, 'Замена радиатора охлаждения'),
(12, 'Замена термостата двигателя'),
(13, 'Диагностика вентилятора охлаждения двигателя'),
(14, 'Ремонт системы охлаждения');

-- --------------------------------------------------------

--
-- Структура таблицы `service_price_list`
--

CREATE TABLE `service_price_list` (
  `idservice_price_list` int(11) NOT NULL,
  `idservice` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `start_data` date NOT NULL,
  `end_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `service_price_list`
--

INSERT INTO `service_price_list` (`idservice_price_list`, `idservice`, `price`, `start_data`, `end_data`) VALUES
(1, 1, 3500, '2021-01-01', NULL),
(2, 2, 3500, '2021-01-01', NULL),
(3, 4, 4000, '2021-01-01', NULL),
(4, 5, 8000, '2021-01-01', NULL),
(5, 6, 800, '2021-01-01', NULL),
(6, 7, 5000, '2021-01-01', NULL),
(7, 8, 2000, '2021-01-01', NULL),
(8, 9, 1000, '2021-01-01', NULL),
(9, 10, 1600, '2021-01-01', NULL),
(10, 11, 2500, '2021-01-01', NULL),
(11, 12, 1500, '2021-01-01', NULL),
(12, 13, 800, '2021-01-01', NULL),
(13, 14, 800, '2021-01-01', NULL),
(14, 15, 800, '2021-01-01', NULL),
(15, 16, 1800, '2021-01-01', NULL),
(16, 17, 1800, '2021-01-01', NULL),
(17, 18, 9000, '2021-01-01', NULL),
(18, 19, 8000, '2021-01-01', NULL),
(19, 20, 2000, '2021-01-01', NULL),
(20, 21, 1000, '2021-01-01', NULL),
(21, 22, 500, '2021-01-01', NULL),
(22, 23, 5000, '2021-01-01', NULL),
(23, 24, 3000, '2021-01-01', NULL),
(24, 25, 1000, '2021-01-01', NULL),
(25, 26, 1000, '2021-01-01', NULL),
(26, 27, 500, '2021-01-01', NULL),
(27, 28, 500, '2021-01-01', NULL),
(28, 29, 1200, '2021-01-01', NULL),
(29, 30, 1200, '2021-01-01', NULL),
(30, 31, 1000, '2021-01-01', NULL),
(31, 32, 1000, '2021-01-01', NULL),
(32, 33, 600, '2021-01-01', NULL),
(33, 34, 1000, '2021-01-01', NULL),
(34, 35, 1000, '2021-01-01', NULL),
(35, 36, 800, '2021-01-01', NULL),
(36, 37, 800, '2021-01-01', NULL),
(37, 38, 800, '2021-01-01', NULL),
(38, 39, 1200, '2021-01-01', NULL),
(39, 40, 1000, '2021-01-01', NULL),
(40, 41, 1100, '2021-01-01', NULL),
(41, 42, 1100, '2021-01-01', NULL),
(42, 43, 1200, '2021-01-01', NULL),
(43, 44, 1200, '2021-01-01', NULL),
(44, 45, 1000, '2021-01-01', NULL),
(45, 46, 1000, '2021-01-01', NULL),
(46, 47, 800, '2021-01-01', NULL),
(47, 48, 1500, '2021-01-01', NULL),
(48, 49, 600, '2021-01-01', NULL),
(49, 50, 2500, '2021-01-01', NULL),
(50, 51, 1800, '2021-01-01', NULL),
(51, 52, 2500, '2021-01-01', NULL),
(52, 53, 1000, '2021-01-01', NULL),
(53, 54, 1000, '2021-01-01', NULL),
(54, 55, 1200, '2021-01-01', NULL),
(55, 56, 4500, '2021-01-01', NULL),
(56, 57, 950, '2021-01-01', NULL),
(57, 58, 450, '2021-01-01', NULL),
(58, 59, 35000, '2021-01-01', NULL),
(59, 60, 800, '2021-01-01', NULL),
(60, 61, 800, '2021-01-01', NULL),
(61, 62, 600, '2021-01-01', NULL),
(62, 63, 300, '2021-01-01', NULL),
(63, 64, 800, '2021-01-01', NULL),
(64, 65, 6000, '2021-01-01', NULL),
(65, 66, 3000, '2021-01-01', NULL),
(66, 67, 7000, '2021-01-01', NULL),
(67, 68, 2000, '2021-01-01', NULL),
(68, 69, 1000, '2021-01-01', NULL),
(69, 70, 2000, '2021-01-01', NULL),
(70, 71, 2000, '2021-01-01', NULL),
(71, 72, 2000, '2021-01-01', NULL),
(72, 73, 500, '2021-01-01', NULL),
(73, 74, 700, '2021-01-01', NULL),
(74, 75, 1000, '2021-01-01', NULL),
(75, 76, 2000, '2021-01-01', NULL),
(76, 77, 1200, '2021-01-01', NULL),
(77, 78, 1000, '2021-01-01', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `idstatus` int(11) NOT NULL,
  `status` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`idstatus`, `status`) VALUES
(1, 'Новый'),
(2, 'В работе'),
(3, 'Завершен'),
(4, 'Отменен');

-- --------------------------------------------------------

--
-- Структура таблицы `worker`
--

CREATE TABLE `worker` (
  `idworker` int(11) NOT NULL,
  `worker` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `worker`
--

INSERT INTO `worker` (`idworker`, `worker`, `phone`) VALUES
(1, 'Макаров ВА', '334411'),
(2, 'Селезнев ВА', '341123'),
(5, 'Шмагин Е.А.', '+79816639150'),
(6, 'Дуванов В.В.', '+79427027014');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`idauto`);

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idclient`);

--
-- Индексы таблицы `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`iddetail`),
  ADD KEY `detail_ibfk_1` (`iddetailtype`);

--
-- Индексы таблицы `detailorder`
--
ALTER TABLE `detailorder`
  ADD PRIMARY KEY (`iddetailorder`),
  ADD KEY `detailorder_ibfk_1` (`iddetail`),
  ADD KEY `detailorder_ibfk_2` (`idorderclient`);

--
-- Индексы таблицы `detailtype`
--
ALTER TABLE `detailtype`
  ADD PRIMARY KEY (`id_type`);

--
-- Индексы таблицы `detail_price_list`
--
ALTER TABLE `detail_price_list`
  ADD PRIMARY KEY (`iddetail_price_list`),
  ADD KEY `detail_ibfk_2` (`iddetail`);

--
-- Индексы таблицы `login_users`
--
ALTER TABLE `login_users`
  ADD PRIMARY KEY (`id_l`);

--
-- Индексы таблицы `orderclient`
--
ALTER TABLE `orderclient`
  ADD PRIMARY KEY (`idorderclient`),
  ADD KEY `idstatus` (`idstatus`),
  ADD KEY `idworker` (`idworker`),
  ADD KEY `idauto` (`idauto`),
  ADD KEY `idclient` (`idclient`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`idservice`),
  ADD KEY `id_type` (`id_type`);

--
-- Индексы таблицы `serviceorder`
--
ALTER TABLE `serviceorder`
  ADD PRIMARY KEY (`idserviceorder`),
  ADD KEY `idorderclient` (`idorderclient`),
  ADD KEY `idservice` (`idservice`);

--
-- Индексы таблицы `servicerequest`
--
ALTER TABLE `servicerequest`
  ADD PRIMARY KEY (`idservicerequest`);

--
-- Индексы таблицы `servicetype`
--
ALTER TABLE `servicetype`
  ADD PRIMARY KEY (`id_type`);

--
-- Индексы таблицы `service_price_list`
--
ALTER TABLE `service_price_list`
  ADD PRIMARY KEY (`idservice_price_list`),
  ADD KEY `service_ibfk_2` (`idservice`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idstatus`);

--
-- Индексы таблицы `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`idworker`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auto`
--
ALTER TABLE `auto`
  MODIFY `idauto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `idclient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `detail`
--
ALTER TABLE `detail`
  MODIFY `iddetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT для таблицы `detailorder`
--
ALTER TABLE `detailorder`
  MODIFY `iddetailorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT для таблицы `detailtype`
--
ALTER TABLE `detailtype`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `detail_price_list`
--
ALTER TABLE `detail_price_list`
  MODIFY `iddetail_price_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT для таблицы `login_users`
--
ALTER TABLE `login_users`
  MODIFY `id_l` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `orderclient`
--
ALTER TABLE `orderclient`
  MODIFY `idorderclient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `idservice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT для таблицы `serviceorder`
--
ALTER TABLE `serviceorder`
  MODIFY `idserviceorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT для таблицы `servicerequest`
--
ALTER TABLE `servicerequest`
  MODIFY `idservicerequest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `servicetype`
--
ALTER TABLE `servicetype`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `service_price_list`
--
ALTER TABLE `service_price_list`
  MODIFY `idservice_price_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `worker`
--
ALTER TABLE `worker`
  MODIFY `idworker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`iddetailtype`) REFERENCES `detailtype` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `detailorder`
--
ALTER TABLE `detailorder`
  ADD CONSTRAINT `detailorder_ibfk_1` FOREIGN KEY (`iddetail`) REFERENCES `detail` (`iddetail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailorder_ibfk_2` FOREIGN KEY (`idorderclient`) REFERENCES `orderclient` (`idorderclient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `detail_price_list`
--
ALTER TABLE `detail_price_list`
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`iddetail`) REFERENCES `detail` (`iddetail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orderclient`
--
ALTER TABLE `orderclient`
  ADD CONSTRAINT `orderclient_ibfk_1` FOREIGN KEY (`idstatus`) REFERENCES `status` (`idstatus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderclient_ibfk_2` FOREIGN KEY (`idworker`) REFERENCES `worker` (`idworker`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderclient_ibfk_3` FOREIGN KEY (`idauto`) REFERENCES `auto` (`idauto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderclient_ibfk_4` FOREIGN KEY (`idclient`) REFERENCES `client` (`idclient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `servicetype` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `serviceorder`
--
ALTER TABLE `serviceorder`
  ADD CONSTRAINT `serviceorder_ibfk_1` FOREIGN KEY (`idorderclient`) REFERENCES `orderclient` (`idorderclient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `serviceorder_ibfk_2` FOREIGN KEY (`idservice`) REFERENCES `service` (`idservice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `service_price_list`
--
ALTER TABLE `service_price_list`
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`idservice`) REFERENCES `service` (`idservice`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
