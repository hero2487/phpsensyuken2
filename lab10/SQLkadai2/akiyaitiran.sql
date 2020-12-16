-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2020 年 11 月 25 日 02:45
-- サーバのバージョン： 5.7.30
-- PHP のバージョン: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `akiya_bukken`
--

CREATE TABLE `akiya_bukken` (
  `id` int(11) DEFAULT NULL,
  `postal_code1` int(3) DEFAULT NULL,
  `postal_code2` int(4) DEFAULT NULL,
  `adress` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_type` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rent` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Year_of_construction` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gas` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parking` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cycle_parking` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `joutai` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `breadth` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bas_toilet` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `garden` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `No_guarantor` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `can_live` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `room_share` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `memo` text COLLATE utf8_unicode_ci,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `yet2` int(11) DEFAULT NULL,
  `yet3` int(11) DEFAULT NULL,
  `indate` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `akiya_bukken`
--

INSERT INTO `akiya_bukken` (`id`, `postal_code1`, `postal_code2`, `adress`, `email`, `home_type`, `rent`, `Year_of_construction`, `picture`, `gas`, `parking`, `cycle_parking`, `joutai`, `breadth`, `bas_toilet`, `garden`, `No_guarantor`, `can_live`, `room_share`, `memo`, `latitude`, `longitude`, `yet2`, `yet3`, `indate`) VALUES
(NULL, 150, 47, '東京都渋谷区神山町１６−４ ヴィラメトロポリス 1A', NULL, 'マンション', '5万円', '〜５年', '', '都市ガス', '無し', '有り', NULL, '２０平米未満', 'ユニットバス', '有り', '必要', '', '可能', 'demo', 35.6633, 139.694, NULL, NULL, '2020-11-22 11:17:46.000000'),
(NULL, 150, 42, '東京都渋谷区宇田川町４−９ くれたけビル 2F', NULL, '戸建', '１〜３万円', '〜５年', '', '都市ガス', '有り', '有り', NULL, '２０平米未満', 'バス・トイレ別', '有り', '必要', '', '可能', 'demo', 35.6625, 139.698, NULL, NULL, '2020-11-22 11:18:27.000000'),
(NULL, 150, 42, '東京都渋谷区宇田川町３０−２ ゲゼットハウス', NULL, '戸建', '７万円', '〜５年', '', 'プロパン', '無し', '有り', NULL, '50平米未満', 'バス・トイレ別', '有り', '必要', '', '可能', 'demo', 35.6607, 139.698, NULL, NULL, '2020-11-22 11:19:05.000000'),
(NULL, 150, 42, '東京都渋谷区宇田川町１１−１ 柳光ビル別館 3階', NULL, '戸建', '2万円', '〜30年', '', '都市ガス', '有り', '有り', NULL, '30平米未満', 'ユニットバス', '有り', '必要', '', '可能', 'demo', 35.6626, 139.697, NULL, NULL, '2020-11-22 11:19:35.000000'),
(NULL, 150, 43, '東京都渋谷区道玄坂１丁目２−３ 渋谷フクラス内 東急プラザ渋谷 6階', NULL, 'マンション', '15万円', '15年', '', '都市ガス', '有り', '有り', NULL, '30平米未満', 'バス・トイレ別', '有り', '必要', '2', '可能', 'demo', 35.6577, 139.7, NULL, NULL, '2020-11-22 11:20:27.000000'),
(NULL, 150, 31, '東京都渋谷区桜丘町２４', NULL, 'マンション', '12万円', '28年', '', '都市ガス', '有り', '有り', NULL, '40平米未満', 'バス・トイレ別', '有り', '必要', '7', '可能', 'demo', 35.656, 139.7, NULL, NULL, '2020-11-22 11:23:20.000000'),
(NULL, 150, 2, '東京都渋谷区渋谷１丁目７−５ 青山セブンハイツ 1階', NULL, '戸建', '１〜３万円', '〜５年', '', '都市ガス', '有り', '有り', NULL, '２０平米未満', 'バス・トイレ別', '有り', '必要', '', '可能', 'demo', 35.6608, 139.706, NULL, NULL, '2020-11-22 11:23:53.000000'),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-23 23:42:07.000000'),
(NULL, 0, 0, '〒176-0012 東京都練馬区豊玉北５丁目２２−７', NULL, '戸建', '１〜３万円', '〜５年', '', '都市ガス', '有り', '有り', NULL, '２０平米未満', 'バス・トイレ別', '有り', '必要', '', '可能', '', 35.7364, 139.654, NULL, NULL, '2020-11-24 00:38:26.000000'),
(NULL, NULL, NULL, '東京都練馬区豊玉北５丁目２２−７', NULL, '集合', '〜７万円', '〜５年', '', '都市ガス', '有り', '有り', NULL, '２０平米未満', 'バス・トイレ別', '有り', '必要', '', '可能', '', 35.7364, 139.654, NULL, NULL, '2020-11-24 02:17:11.000000'),
(NULL, NULL, NULL, '〒177-0033 東京都練馬区高野台３丁目１０−３', NULL, '戸建', '１〜３万円', '〜５年', '', '都市ガス', '有り', '有り', NULL, '２０平米未満', 'バス・トイレ別', '有り', '必要', '', '可能', '', 35.7437, 139.615, NULL, NULL, '2020-11-24 03:06:22.000000'),
(NULL, NULL, NULL, '渋谷', NULL, '戸建', '１〜３万円', '〜５年', '', '都市ガス', '有り', '有り', NULL, '２０平米未満', 'バス・トイレ別', '有り', '必要', '', '可能', '', 35.6618, 139.704, NULL, NULL, '2020-11-24 14:29:25.000000'),
(NULL, NULL, NULL, '渋谷', NULL, '戸建', '１〜３万円', '〜５年', '', 'プロパン', '無し', '有り', NULL, '５０平米未満', 'バス・トイレ別', '有り', '必要', '', '可能', '', 35.6618, 139.704, NULL, NULL, '2020-11-24 14:37:43.000000');
