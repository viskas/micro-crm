-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 21 2019 г., 21:01
-- Версия сервера: 5.7.19
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Администратор', '1', 1525161228),
('Менеджер', '2', 1602420624);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1525320643, 1525320643),
('/admin/*', 2, NULL, NULL, NULL, 1525317811, 1525317811),
('/clients/*', 2, NULL, NULL, NULL, 1525765253, 1525765253),
('/contact-us/*', 2, NULL, NULL, NULL, 1526293230, 1526293230),
('/department/*', 2, NULL, NULL, NULL, 1526296586, 1526296586),
('/gii/*', 2, NULL, NULL, NULL, 1525170953, 1525170953),
('/i18n/*', 2, NULL, NULL, NULL, 1526554247, 1526554247),
('/languages/*', 2, NULL, NULL, NULL, 1526554241, 1526554241),
('/managers/*', 2, NULL, NULL, NULL, 1525324237, 1525324237),
('/news/*', 2, NULL, NULL, NULL, 1525409620, 1525409620),
('/pages/manager/*', 2, NULL, NULL, NULL, 1525341423, 1525341423),
('/pay-method/*', 2, NULL, NULL, NULL, 1526897012, 1526897012),
('/profile/*', 2, NULL, NULL, NULL, 1525317549, 1525317549),
('/promo-code/*', 2, NULL, NULL, NULL, 1525317636, 1525317636),
('/request/*', 2, NULL, NULL, NULL, 1526354389, 1526354389),
('/settings/delete-news-size', 2, NULL, NULL, NULL, 1525403921, 1525403921),
('/settings/news', 2, NULL, NULL, NULL, 1525403921, 1525403921),
('/site/*', 2, NULL, NULL, NULL, 1526477285, 1526477285),
('/users/*', 2, NULL, NULL, NULL, 1525320569, 1525320569),
('/withdrawal/*', 2, NULL, NULL, NULL, 1526896999, 1526896999),
('Администратор', 1, NULL, NULL, NULL, 1525161007, 1574358116),
('Вывод средств', 2, NULL, NULL, NULL, 1526897063, 1526897063),
('Главная страница', 2, NULL, NULL, NULL, 1526477269, 1526477296),
('Менеджер', 1, NULL, NULL, NULL, 1525161044, 1526477335),
('Методы оплаты', 2, NULL, NULL, NULL, 1526897043, 1526897043),
('Настройки новостей', 2, NULL, NULL, NULL, 1525403896, 1526661916),
('Новости', 2, NULL, NULL, NULL, 1525409608, 1525668321),
('Обратная связь', 2, NULL, NULL, NULL, 1526292985, 1526293243),
('Обращения', 2, NULL, NULL, NULL, 1526354373, 1526354398),
('Общее распределение прав', 2, NULL, NULL, NULL, 1525317796, 1525317817),
('Отделы', 2, NULL, NULL, NULL, 1526294652, 1526296596),
('Перевод', 2, NULL, NULL, NULL, 1526554277, 1526554277),
('Промо-коды', 2, NULL, NULL, NULL, 1525317622, 1525317644),
('Редактирование профиля', 2, NULL, NULL, NULL, 1525317529, 1525317558),
('Управление клиентами', 2, NULL, NULL, NULL, 1525765240, 1525765264),
('Управление менеджерами', 2, NULL, NULL, NULL, 1525320536, 1525324242),
('Управление менеджерами и администраторами', 2, NULL, NULL, NULL, 1525320558, 1525320661),
('Управление статическими страницами', 2, NULL, NULL, NULL, 1525341407, 1525674877),
('Языки', 2, NULL, NULL, NULL, 1526554257, 1526554257);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Администратор', '/*'),
('Общее распределение прав', '/admin/*'),
('Управление клиентами', '/clients/*'),
('Обратная связь', '/contact-us/*'),
('Отделы', '/department/*'),
('Администратор', '/gii/*'),
('Перевод', '/i18n/*'),
('Языки', '/languages/*'),
('Управление менеджерами', '/managers/*'),
('Новости', '/news/*'),
('Управление статическими страницами', '/pages/manager/*'),
('Методы оплаты', '/pay-method/*'),
('Редактирование профиля', '/profile/*'),
('Промо-коды', '/promo-code/*'),
('Обращения', '/request/*'),
('Настройки новостей', '/settings/delete-news-size'),
('Настройки новостей', '/settings/news'),
('Главная страница', '/site/*'),
('Управление менеджерами и администраторами', '/users/*'),
('Вывод средств', '/withdrawal/*'),
('Менеджер', 'Главная страница'),
('Менеджер', 'Обратная связь'),
('Менеджер', 'Обращения'),
('Менеджер', 'Редактирование профиля'),
('Менеджер', 'Управление клиентами');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `eng_title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alpha2` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rus_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id`, `eng_title`, `alpha2`, `rus_title`) VALUES
(1, 'Afghanistan', 'AF', 'Афганистан'),
(2, 'Albania', 'AL', 'Албания'),
(3, 'Algeria', 'DZ', 'Алжир'),
(4, 'Andorra', 'AD', 'Андорра'),
(5, 'Angola', 'AO', 'Ангола'),
(6, 'Antigua and Barbuda', 'AG', 'Антигуа и Барбуда'),
(7, 'Argentina', 'AR', 'Аргентина'),
(8, 'Armenia', 'AM', 'Армения'),
(9, 'Australia', 'AU', 'Австралия'),
(10, 'Austria', 'AT', 'Австрия'),
(11, 'Azerbaijan', 'AZ', 'Азербайджан'),
(12, 'Bahamas The', 'BS', 'Багамы'),
(13, 'Bahrain', 'BH', 'Бахрейн'),
(14, 'Bangladesh', 'BD', 'Бангладеш'),
(15, 'Barbados', 'BB', 'Барбадос'),
(16, 'Belarus', 'BY', 'Беларусь'),
(17, 'Belgium', 'BE', 'Бельгия'),
(18, 'Belize', 'BZ', 'Белиз'),
(19, 'Benin', 'BJ', 'Бенин'),
(20, 'Bhutan', 'BT', 'Бутан'),
(21, 'Bolivia', 'BO', 'Боливия'),
(22, 'Bosnia and Herzegovina', 'BA', 'Босния и Герцеговина'),
(23, 'Botswana', 'BW', 'Ботсвана'),
(24, 'Brazil', 'BR', 'Бразилия'),
(25, 'Brunei', 'BN', 'Бруней-Даруссалам'),
(26, 'Bulgaria', 'BG', 'Болгария'),
(27, 'Burkina Faso', 'BF', 'Буркина-Фасо'),
(28, 'Burundi', 'BI', 'Бурунди'),
(29, 'Cambodia', 'KH', 'Камбоджа'),
(30, 'Cameroon', 'CM', 'Камерун'),
(31, 'Canada', 'CA', 'Канада'),
(32, 'Cape Verde', 'CV', 'Кабо-Верде'),
(33, 'Central African Republic', 'CF', 'Центрально-Африканская Республика'),
(34, 'Chad', 'TD', 'Чад'),
(35, 'Chile', 'CL', 'Чили'),
(36, 'China Peoples Republic of', 'CN', 'Китай'),
(37, 'Colombia', 'CO', 'Колумбия'),
(38, 'Comoros', 'KM', 'Коморы'),
(39, 'Congo Democratic Republic of the (Congo – Kinshasa)', 'CD', 'Конго, Демократическая Республика'),
(40, 'Congo Republic of the (Congo – Brazzaville)', 'CG', 'Конго'),
(41, 'Costa Rica', 'CR', 'Коста-Рика'),
(42, 'Cote d\'Ivoire (Ivory Coast)', 'CI', 'Кот д\'Ивуар'),
(43, 'Croatia', 'HR', 'Хорватия'),
(44, 'Cuba', 'CU', 'Куба'),
(45, 'Cyprus', 'CY', 'Кипр'),
(46, 'Czech Republic', 'CZ', 'Чешская Республика'),
(47, 'Denmark', 'DK', 'Дания'),
(48, 'Djibouti', 'DJ', 'Джибути'),
(49, 'Dominica', 'DM', 'Доминика'),
(50, 'Dominican Republic', 'DO', 'Доминиканская Республика'),
(51, 'Ecuador', 'EC', 'Эквадор'),
(52, 'Egypt', 'EG', 'Египет'),
(53, 'El Salvador', 'SV', 'Эль-Сальвадор'),
(54, 'Equatorial Guinea', 'GQ', 'Экваториальная Гвинея'),
(55, 'Eritrea', 'ER', 'Эритрея'),
(56, 'Estonia', 'EE', 'Эстония'),
(57, 'Ethiopia', 'ET', 'Эфиопия'),
(58, 'Fiji', 'FJ', 'Фиджи'),
(59, 'Finland', 'FI', 'Финляндия'),
(60, 'France', 'FR', 'Франция'),
(61, 'Gabon', 'GA', 'Габон'),
(62, 'Gambia The', 'GM', 'Гамбия'),
(63, 'Georgia', 'GE', 'Грузия'),
(64, 'Germany', 'DE', 'Германия'),
(65, 'Ghana', 'GH', 'Гана'),
(66, 'Greece', 'GR', 'Греция'),
(67, 'Grenada', 'GD', 'Гренада'),
(68, 'Guatemala', 'GT', 'Гватемала'),
(69, 'Guinea', 'GN', 'Гвинея'),
(70, 'Guinea-Bissau', 'GW', 'Гвинея-Бисау'),
(71, 'Guyana', 'GY', 'Гайана'),
(72, 'Haiti', 'HT', 'Гаити'),
(73, 'Honduras', 'HN', 'Гондурас'),
(74, 'Hungary', 'HU', 'Венгрия'),
(75, 'Iceland', 'IS', 'Исландия'),
(76, 'India', 'IN', 'Индия'),
(77, 'Indonesia', 'ID', 'Индонезия'),
(78, 'Iran', 'IR', 'Иран, Исламская Республика'),
(79, 'Iraq', 'IQ', 'Ирак'),
(80, 'Ireland', 'IE', 'Ирландия'),
(81, 'Israel', 'IL', 'Израиль'),
(82, 'Italy', 'IT', 'Италия'),
(83, 'Jamaica', 'JM', 'Ямайка'),
(84, 'Japan', 'JP', 'Япония'),
(85, 'Jordan', 'JO', 'Иордания'),
(86, 'Kazakhstan', 'KZ', 'Казахстан'),
(87, 'Kenya', 'KE', 'Кения'),
(88, 'Kiribati', 'KI', 'Кирибати'),
(89, 'Korea Democratic Peoples Republic of (North Korea)', 'KP', 'Северная Корея'),
(90, 'Korea, Republic of  (South Korea)', 'KR', 'Южная Корея'),
(91, 'Kuwait', 'KW', 'Кувейт'),
(92, 'Kyrgyzstan', 'KG', 'Киргизия'),
(93, 'Laos', 'LA', 'Лаос'),
(94, 'Latvia', 'LV', 'Латвия'),
(95, 'Lebanon', 'LB', 'Ливан'),
(96, 'Lesotho', 'LS', 'Лесото'),
(97, 'Liberia', 'LR', 'Либерия'),
(98, 'Libya', 'LY', 'Ливийская Арабская Джамахирия'),
(99, 'Liechtenstein', 'LI', 'Лихтенштейн'),
(100, 'Lithuania', 'LT', 'Литва'),
(101, 'Luxembourg', 'LU', 'Люксембург'),
(102, 'Macedonia', 'MK', 'Республика Македония'),
(103, 'Madagascar', 'MG', 'Мадагаскар'),
(104, 'Malawi', 'MW', 'Малави'),
(105, 'Malaysia', 'MY', 'Малайзия'),
(106, 'Maldives', 'MV', 'Мальдивы'),
(107, 'Mali', 'ML', 'Мали'),
(108, 'Malta', 'MT', 'Мальта'),
(109, 'Marshall Islands', 'MH', 'Маршалловы острова'),
(110, 'Mauritania', 'MR', 'Мавритания'),
(111, 'Mauritius', 'MU', 'Маврикий'),
(112, 'Mexico', 'MX', 'Мексика'),
(113, 'Micronesia', 'FM', 'Микронезия, Федеративные Штаты'),
(114, 'Moldova', 'MD', 'Молдова, Республика'),
(115, 'Monaco', 'MC', 'Монако'),
(116, 'Mongolia', 'MN', 'Монголия'),
(117, 'Montenegro', NULL, 'Черногория'),
(118, 'Morocco', 'MA', 'Марокко'),
(119, 'Mozambique', 'MZ', 'Мозамбик'),
(120, 'Myanmar (Burma)', 'MM', 'Мьянма'),
(121, 'Namibia', 'NA', 'Намибия'),
(122, 'Nauru', 'NR', 'Науру'),
(123, 'Nepal', 'NP', 'Непал'),
(124, 'Netherlands', 'NL', 'Нидерланды'),
(125, 'New Zealand', 'NZ', 'Новая Зеландия'),
(126, 'Nicaragua', 'NI', 'Никарагуа'),
(127, 'Niger', 'NE', 'Нигер'),
(128, 'Nigeria', 'NG', 'Нигерия'),
(129, 'Norway', 'NO', 'Норвегия'),
(130, 'Oman', 'OM', 'Оман'),
(131, 'Pakistan', 'PK', 'Пакистан'),
(132, 'Palau', 'PW', 'Палау'),
(133, 'Panama', 'PA', 'Панама'),
(134, 'Papua New Guinea', 'PG', 'Папуа-Новая Гвинея'),
(135, 'Paraguay', 'PY', 'Парагвай'),
(136, 'Peru', 'PE', 'Перу'),
(137, 'Philippines', 'PH', 'Филиппины'),
(138, 'Poland', 'PL', 'Польша'),
(139, 'Portugal', 'PT', 'Португалия'),
(140, 'Qatar', 'QA', 'Катар'),
(141, 'Romania', 'RO', 'Румыния'),
(142, 'Russia', 'RU', 'Россия'),
(143, 'Rwanda', 'RW', 'Руанда'),
(144, 'Saint Kitts and Nevis', 'KN', 'Сент-Китс и Невис'),
(145, 'Saint Lucia', 'LC', 'Сент-Люсия'),
(146, 'Saint Vincent and the Grenadines', 'VC', 'Сент-Винсент и Гренадины'),
(147, 'Samoa', 'WS', 'Самоа'),
(148, 'San Marino', 'SM', 'Сан-Марино'),
(149, 'Sao Tome and Principe', 'ST', 'Сан-Томе и Принсипи'),
(150, 'Saudi Arabia', 'SA', 'Саудовская Аравия'),
(151, 'Senegal', 'SN', 'Сенегал'),
(152, 'Serbia', NULL, 'Сербия'),
(153, 'Seychelles', 'SC', 'Сейшелы'),
(154, 'Sierra Leone', 'SL', 'Сьерра-Леоне'),
(155, 'Singapore', 'SG', 'Сингапур'),
(156, 'Slovakia', 'SK', 'Словакия'),
(157, 'Slovenia', 'SI', 'Словения'),
(158, 'Solomon Islands', 'SB', 'Соломоновы острова'),
(159, 'Somalia', 'SO', 'Сомали'),
(160, 'South Africa', 'ZA', 'Южная Африка'),
(161, 'Spain', 'ES', 'Испания'),
(162, 'Sri Lanka', 'LK', 'Шри-Ланка'),
(163, 'Sudan', 'SD', 'Судан'),
(164, 'Suriname', 'SR', 'Суринам'),
(165, 'Swaziland', 'SZ', 'Свазиленд'),
(166, 'Sweden', 'SE', 'Швеция'),
(167, 'Switzerland', 'CH', 'Швейцария'),
(168, 'Syria', 'SY', 'Сирийская Арабская Республика'),
(169, 'Tajikistan', 'TJ', 'Таджикистан'),
(170, 'Tanzania', 'TZ', 'Танзания, Объединенная Республика'),
(171, 'Thailand', 'TH', 'Таиланд'),
(172, 'Timor-Leste (East Timor)', 'TL', 'Тимор-Лесте'),
(173, 'Togo', 'TG', 'Того'),
(174, 'Tonga', 'TO', 'Тонга'),
(175, 'Trinidad and Tobago', 'TT', 'Тринидад и Тобаго'),
(176, 'Tunisia', 'TN', 'Тунис'),
(177, 'Turkey', 'TR', 'Турция'),
(178, 'Turkmenistan', 'TM', 'Туркмения'),
(179, 'Tuvalu', 'TV', 'Тувалу'),
(180, 'Uganda', 'UG', 'Уганда'),
(181, 'Ukraine', 'UA', 'Украина'),
(182, 'United Arab Emirates', 'AE', 'Объединенные Арабские Эмираты'),
(183, 'United Kingdom', 'GB', 'Соединенное Королевство'),
(184, 'United States', 'US', 'Соединенные Штаты'),
(185, 'Uruguay', 'UY', 'Уругвай'),
(186, 'Uzbekistan', 'UZ', 'Узбекистан'),
(187, 'Vanuatu', 'VU', 'Вануату'),
(188, 'Vatican City', 'VA', 'Папский Престол (Государство &mdash; город Ватикан)'),
(189, 'Venezuela', 'VE', 'Венесуэла'),
(190, 'Vietnam', 'VN', 'Вьетнам'),
(191, 'Yemen', 'YE', 'Йемен'),
(192, 'Zambia', 'ZM', 'Замбия'),
(193, 'Zimbabwe', 'ZW', 'Зимбабве'),
(247, 'South Georgia and the South Sandwich Islands', 'GS', 'Южная Джорджия и Южные Сандвичевы острова'),
(246, 'Åland Islands', 'AX', 'Эландские острова'),
(245, 'Svalbard and Jan Mayen', 'SJ', 'Шпицберген и Ян Майен'),
(244, 'French Southern Lands', 'TF', 'Французские Южные территории'),
(243, 'French Polynesia', 'PF', 'Французская Полинезия'),
(242, 'French Guiana', 'GF', 'Французская Гвиана'),
(241, 'Falkland Islands (Islas Malvinas)', 'FK', 'Фолклендские острова (Мальвинские)'),
(240, 'Faroe Islands', 'FO', 'Фарерские острова'),
(239, 'Wallis and Futuna', 'WF', 'Уоллис и Футуна'),
(238, 'Tokelau', 'TK', 'Токелау'),
(237, 'Taiwan', 'TW', 'Тайвань (Китай)'),
(236, 'Saint Pierre and Miquelon', 'PM', 'Сен-Пьер и Микелон'),
(235, 'Saint Barthélemy', 'BL', 'Сен-Бартельми'),
(234, 'Northern Mariana Islands', 'MP', 'Северные Марианские острова'),
(233, 'Saint Helena', 'SH', 'Святая Елена'),
(232, 'Reunion', 'RE', 'Реюньон'),
(231, 'Puerto Rico', 'PR', 'Пуэрто-Рико'),
(230, 'Pitcairn', 'PN', 'Питкерн'),
(229, 'Palestinian Territory, Occupied', 'PS', 'Палестинская территория, оккупированная'),
(228, 'Turks and Caicos Islands', 'TC', 'Острова Теркс и Кайкос'),
(227, 'Cook Islands', 'CK', 'Острова Кука'),
(226, 'Cayman Islands', 'KY', 'Острова Кайман'),
(225, 'Heard Island and McDonald Islands', 'HM', 'Остров Херд и острова Макдональд'),
(224, 'Saint Martin', 'MF', 'Остров Святого Мартина'),
(223, 'Christmas Island', 'CX', 'Остров Рождества'),
(222, 'Norfolk Island', 'NF', 'Остров Норфолк'),
(220, 'Bouvet Island', 'BV', 'Остров Буве'),
(219, 'New Caledonia', 'NC', 'Новая Каледония'),
(218, 'Niue', 'NU', 'Ниуэ'),
(217, 'Netherlands Antilles', 'AN', 'Нидерландские Антилы'),
(216, 'Montserrat', 'MS', 'Монтсеррат'),
(215, 'Martinique', 'MQ', 'Мартиника'),
(221, 'Isle of Man', 'IM', 'Остров Мэн'),
(212, 'Mayotte', 'YT', 'Майотта'),
(213, 'Macau', 'MO', 'Макао'),
(211, 'Kosovo', '', 'Косово'),
(210, 'Cocos (Keeling) Islands', 'CC', 'Кокосовые (Килинг) острова'),
(209, 'Western Sahara', 'EH', 'Западная Сахара'),
(207, 'Guam', 'GU', 'Гуам'),
(208, 'Jersey', 'JE', 'Джерси'),
(206, 'Greenland', 'GL', 'Гренландия'),
(205, 'Hong Kong', 'HK', 'Гонконг'),
(204, 'Gibraltar', 'GI', 'Гибралтар'),
(203, 'Guernsey', 'GG', 'Гернси'),
(202, 'Guadeloupe', 'GP', 'Гваделупа'),
(201, 'Virgin Islands', 'VI', 'Виргинские острова, США'),
(200, 'British Virgin Islands', 'VG', 'Виргинские острова, Британские'),
(199, 'British Indian Ocean Territory', 'IO', 'Британская территория в Индийском океане'),
(198, 'Bermuda', 'BM', 'Бермуды'),
(197, 'Aruba', 'AW', 'Аруба'),
(196, 'Antarctica', 'AQ', 'Антарктида'),
(195, 'Anguilla', 'AI', 'Ангилья'),
(194, 'American Samoa', 'AS', 'Американское Самоа');

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `main` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `language`, `code`, `main`, `status`, `created_at`) VALUES
(1, 'Русский', 'ru', 1, 1, '2018-05-17 10:07:38'),
(2, 'English', 'us', 0, 1, '2018-05-17 10:07:38');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL DEFAULT '0',
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `translation` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `language`, `hash`, `translation`) VALUES
(1, 'ru', '', NULL),
(1, 'us', '', NULL),
(2, 'ru', '', NULL),
(2, 'us', '', NULL),
(3, 'ru', '', NULL),
(3, 'us', '', NULL),
(4, 'ru', '', NULL),
(4, 'us', '', NULL),
(5, 'ru', '', NULL),
(5, 'us', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1525142021),
('m130524_201442_init', 1525142024),
('m140506_102106_rbac_init', 1525142603),
('m140618_045255_create_settings', 1534843651),
('m150109_093837_addI18nTables', 1526542896),
('m150429_155009_create_page_table', 1525339221),
('m151126_091910_add_unique_index', 1534843651),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1525142603);

-- --------------------------------------------------------

--
-- Структура таблицы `source_message`
--

CREATE TABLE `source_message` (
  `id` int(11) NOT NULL,
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `location` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `source_message`
--

INSERT INTO `source_message` (`id`, `hash`, `category`, `message`, `location`) VALUES
(1, '', 'app', 'Активный', NULL),
(2, '', 'app', 'Удален', NULL),
(3, '', 'app', 'First name', NULL),
(4, '', 'app', 'Last name', NULL),
(5, '', 'app', 'Email', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `secret_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_user` int(11) NOT NULL DEFAULT '0',
  `qr_status` int(11) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `auth_key`, `secret_key`, `password_hash`, `password_reset_token`, `email`, `is_user`, `qr_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Администратор', 'Администратор', NULL, 'DyoNBwr75MWepn7jWBzPFMELBogWV5LG', 'MSFWNI65KF7Z64JW', '$2y$13$y.Moj4WP8VtmJGUtuC02FOC6Om4qNdkkqw.vhxP99QE8diYZJgnDO', NULL, 'prybylov.v@gmail.com', 0, 0, 10, 1525159721, 1528427446),
(2, 'Василий', 'Петров', NULL, 'Xq2UbOBrre6uOuw3Fs9chCs_TVvNieyO', 'EDHEYQO7THCAU5SK', '$2y$13$BOp3CmzOGJSBZe1joWoKn.woYd6bXSmxpF6tD4QUtal8AEGReBEai', NULL, 'pew98905@bcaoo.com', 0, 0, 10, 1574358624, 1574358624);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `auth_assignment_user_id_idx` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alpha2` (`alpha2`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`,`language`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `source_message`
--
ALTER TABLE `source_message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `source_message`
--
ALTER TABLE `source_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_source_message_message` FOREIGN KEY (`id`) REFERENCES `source_message` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
