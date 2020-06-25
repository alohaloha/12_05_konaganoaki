-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 6 月 25 日 03:34
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `test`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `entry_category`
--

CREATE TABLE `entry_category` (
  `entry_category_id` int(2) NOT NULL,
  `entry_category` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `entry_category`
--

INSERT INTO `entry_category` (`entry_category_id`, `entry_category`) VALUES
(1, 'MAX10'),
(2, 'ENJOY6'),
(3, 'エントリ無し');

-- --------------------------------------------------------

--
-- テーブルの構造 `M_prefectures`
--

CREATE TABLE `M_prefectures` (
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefecture` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kana` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roma` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_pw` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_regist` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `M_prefectures`
--

INSERT INTO `M_prefectures` (`code`, `prefecture`, `kana`, `roma`, `mail`, `initial_pw`, `is_regist`) VALUES
('01', '北海道', 'ほっかいどう', 'hokkaido', '01_hokkaido@jewfa.jp', '5WGJ3LWt', 0),
('02', '青森県', 'あおもり', 'aomori', '02_aomori@jewfa.jp', 'b9KhJ8fX', 0),
('03', '岩手県', 'いわて', 'iwate', '03_iwate@jewfa.jp', '7D6niOP2', 0),
('04', '宮城県', 'みやぎ', 'miyagi', '04_miyagi@jewfa.jp', 'Vd5YXl1b', 0),
('05', '秋田県', 'あきた', 'akita', '05_akita@jewfa.jp', 'FUGvnJ8m', 0),
('06', '山形県', 'やまがた', 'yamagata', '06_yamagata@jewfa.jp', 'Vn2Djxfs', 0),
('07', '福島県', 'ふくしま', 'fukushima', '07_fukushima@jewfa.jp', 'AUorwSmu', 0),
('08', '茨城県', 'いばらき', 'ibaraki', '08_ibaraki@jewfa.jp', 'fkB7IFJR', 0),
('09', '栃木県', 'とちぎ', 'tochigi', '09_tochigi@jewfa.jp', '6hX3TskN', 0),
('10', '群馬県', 'ぐんま', 'gumma', '10_gumma@jewfa.jp', 'iJjy6qRp', 0),
('11', '埼玉県', 'さいたま', 'saitama', '11_saitama@jewfa.jp', 'I4VmK54r', 0),
('12', '千葉県', 'ちば', 'chiba', '12_chiba@jewfa.jp', 'JtxNZEex', 0),
('13', '東京都', 'とうきょう', 'tokyo', '13_tokyo@jewfa.jp', 'uuprMIjK', 1),
('14', '神奈川県', 'かながわ', 'kanagawa', '14_kanagawa@jewfa.jp', 'hPiNsVqE', 0),
('15', '新潟県', 'にいがた', 'niigata', '15_niigata@jewfa.jp', 'B22GUDJ1', 0),
('16', '富山県', 'とやま', 'toyama', '16_toyama@jewfa.jp', 'zoiOAAfz', 0),
('17', '石川県', 'いしかわ', 'ishikawa', '17_ishikawa@jewfa.jp', 'fc6Nf9rc', 0),
('18', '福井県', 'ふくい', 'fukui', '18_fukui@jewfa.jp', '1IsxJKmY', 0),
('19', '山梨県', 'やまなし', 'yamanashi', '19_yamanashi@jewfa.jp', 'e4PssBSm', 0),
('20', '長野県', 'ながの', 'nagano', '20_nagano@jewfa.jp', 'Pa2xhXpQ', 1),
('21', '岐阜県', 'ぎふ', 'gifu', '21_gifu@jewfa.jp', 'xiOP6S1O', 0),
('22', '静岡県', 'しずおか', 'shizuoka', '22_shizuoka@jewfa.jp', 'Xuc8upRv', 0),
('23', '愛知県', 'あいち', 'aichi', '23_aichi@jewfa.jp', 'uwi4oprA', 0),
('24', '三重県', 'みえ', 'mie', '24_mie@jewfa.jp', 'RMjTLksu', 0),
('25', '滋賀県', 'しが', 'shiga', '25_shiga@jewfa.jp', 'skjB9Om5', 0),
('26', '京都府', 'きょうと', 'kyoto', '26_kyoto@jewfa.jp', 'AOA9AcDA', 0),
('27', '大阪府', 'おおさか', 'osaka', '27_osaka@jewfa.jp', 'T2DfGTiR', 0),
('28', '兵庫県', 'ひょうご', 'hyogo', '28_hyogo@jewfa.jp', 'bW26uS79', 0),
('29', '奈良県', 'なら', 'nara', '29_nara@jewfa.jp', 'qd2SQd00', 0),
('30', '和歌山県', 'わかやま', 'wakayama', '30_wakayama@jewfa.jp', '4ipYvL5g', 0),
('31', '鳥取県', 'とっとり', 'tottori', '31_tottori@jewfa.jp', '0Y3JtbIv', 0),
('32', '島根県', 'しまね', 'shimane', '32_shimane@jewfa.jp', 'uuFeIBxA', 0),
('33', '岡山県', 'おかやま', 'okayama', '33_okayama@jewfa.jp', 'Am8UYyzz', 0),
('34', '広島県', 'ひろしま', 'hiroshima', '34_hiroshima@jewfa.jp', 'cHRyz21n', 1),
('35', '山口県', 'やまぐち', 'yamaguchi', '35_yamaguchi@jewfa.jp', 'y2ePEIYs', 0),
('36', '徳島県', 'とくしま', 'tokushima', '36_tokushima@jewfa.jp', 'kmTnbX1F', 0),
('37', '香川県', 'かがわ', 'kagawa', '37_kagawa@jewfa.jp', '1wlf6PQZ', 0),
('38', '愛媛県', 'えひめ', 'ehime', '38_ehime@jewfa.jp', 'plKdByHn', 0),
('39', '高知県', 'こうち', 'kochi', '39_kochi@jewfa.jp', '4fF0z6ZC', 0),
('40', '福岡県', 'ふくおか', 'fukuoka', '40_fukuoka@jewfa.jp', '7vscm4mR', 0),
('41', '佐賀県', 'さが', 'saga', '41_saga@jewfa.jp', 'VrDNQI7Y', 1),
('42', '長崎県', 'ながさき', 'nagasaki', '42_nagasaki@jewfa.jp', 'nWJzthhq', 0),
('43', '熊本県', 'くまもと', 'kumamoto', '43_kumamoto@jewfa.jp', 'SCwMtQNF', 0),
('44', '大分県', 'おおいた', 'oita', '44_oita@jewfa.jp', 'UX558B4H', 0),
('45', '宮崎県', 'みやざき', 'miyazaki', '45_miyazaki@jewfa.jp', 'w9P6g98X', 0),
('46', '鹿児島県', 'かごしま', 'kagoshima', '46_kagoshima@jewfa.jp', 'NNKYB09e', 1),
('47', '沖縄県', 'おきなわ', 'okinawa', '47_okinawa@jewfa.jp', '65s1xjrX', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `PREF_managers`
--

CREATE TABLE `PREF_managers` (
  `id` int(8) NOT NULL,
  `pref_code` int(2) NOT NULL,
  `manager` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(20) NOT NULL,
  `yuubin` int(11) NOT NULL,
  `address` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `PREF_managers`
--

INSERT INTO `PREF_managers` (`id`, `pref_code`, `manager`, `tel`, `yuubin`, `address`, `mail`, `password`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 34, '代表者', '0', 0, '広島県広島市中央区', '34_hiroshima@jewfa.jp', 'hiroshima', 1, '2020-06-18 22:50:59', '2020-06-18 22:50:59'),
(2, 46, '住吉　一洋', '09876543210', 1234567, '鹿児島県霧島市', '46_kagoshima@jewfa.jp', '222222', 0, '2020-06-18 22:58:55', '2020-06-18 22:58:55'),
(3, 13, '代表者', '0300001111', 1111111, '東京都足立区', '13_tokyo@jewfa.jp', '1111111', 0, '2020-06-18 23:43:47', '2020-06-18 23:43:47'),
(4, 20, '竹山', '0000000000', 0, '長野県諏訪市', '20_nagano@jewfa.jp', 'nagano', 0, '2020-06-24 16:59:01', '2020-06-24 16:59:01'),
(5, 41, '吉田　慎', '00000000000', 1230000, '佐賀県佐賀市', '41_saga@jewfa.jp', 'yoshida', 0, '2020-06-25 01:48:52', '2020-06-25 02:08:54'),
(6, 14, '代表者', '3333333333', 3333333, '神奈川県平塚市', '14_kanagawa@jewfa.jp', '333333', 0, '2020-06-25 02:28:01', '2020-06-25 02:28:01'),
(7, 17, '城下　健一', '09099999999', 9999999, '石川県金沢市', '17_ishikawa@jewfa.jp', '999', 0, '2020-06-25 02:33:06', '2020-06-25 02:33:06');

-- --------------------------------------------------------

--
-- テーブルの構造 `team_category`
--

CREATE TABLE `team_category` (
  `team_category_id` int(2) NOT NULL,
  `team_category` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `team_category`
--

INSERT INTO `team_category` (`team_category_id`, `team_category`) VALUES
(1, '一種'),
(2, '二種');

-- --------------------------------------------------------

--
-- テーブルの構造 `team_table`
--

CREATE TABLE `team_table` (
  `team_id` int(20) NOT NULL,
  `pref_code` int(20) NOT NULL,
  `team_category` int(20) NOT NULL,
  `entry_category` int(20) DEFAULT NULL,
  `team_name` varchar(128) NOT NULL,
  `team_mail` varchar(128) NOT NULL,
  `team_yuubin` varchar(8) NOT NULL,
  `team_address` varchar(128) NOT NULL,
  `team_facility` varchar(128) NOT NULL,
  `team_pw` varchar(20) NOT NULL,
  `team_manager` varchar(20) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `team_table`
--

INSERT INTO `team_table` (`team_id`, `pref_code`, `team_category`, `entry_category`, `team_name`, `team_mail`, `team_yuubin`, `team_address`, `team_facility`, `team_pw`, `team_manager`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 46, 1, 1, 'Nanchester United 鹿児島', 'nanchester2003@outlook.com', '890-0000', '鹿児島県鹿児島市小野', 'ハートピア鹿児島', 'nanche', '塩入　新也', 0, '2020-06-21 12:26:00', '2020-06-25 01:08:08'),
(2, 41, 1, 2, 'Infinity侍', 'saga@example.com', '000-0000', '佐賀県佐賀市', '勤労体育センター', 'saga', '吉田　慎', 0, '2020-06-21 12:35:36', '2020-06-21 12:35:36'),
(3, 13, 1, 1, 'レインボーソルジャー', 'rainbow@example.com', '000-0000', '東京都足立区', '東京ドーム', 'rainbow', '小川', 0, '2020-06-21 13:31:31', '2020-06-21 13:31:31'),
(4, 14, 1, 1, 'Yokohama Crackers', 'crackers@example.com', '000-0000', '神奈川県横浜市', 'ラポール', 'crackers', '真島', 0, '2020-06-21 13:34:28', '2020-06-21 13:34:28'),
(5, 14, 2, 3, '湘南イーグルス', 'egles@example.com', '000-0000', '神奈川県平塚市', '平塚市立なぎさふれあいセンター体育館', 'eagles', '吉川　健一', 0, '2020-06-21 20:15:13', '2020-06-21 20:15:13'),
(6, 14, 1, 1, 'Yokohama Red Spilits', 'test@example.com', '000-0000', '神奈川県横浜市', '横浜ラポール', 'ewd', '代表者', 0, '2020-06-24 22:59:59', '2020-06-24 22:59:59'),
(7, 27, 1, 2, '大阪ローリングタートルズ', 'oosaka@example.com', '000-0000', '大阪府堺市', '通天閣', 'osaka', 'ぶに', 0, '2020-06-25 04:39:48', '2020-06-25 04:39:48');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `entry_category`
--
ALTER TABLE `entry_category`
  ADD PRIMARY KEY (`entry_category_id`);

--
-- テーブルのインデックス `M_prefectures`
--
ALTER TABLE `M_prefectures`
  ADD PRIMARY KEY (`code`);

--
-- テーブルのインデックス `PREF_managers`
--
ALTER TABLE `PREF_managers`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `team_category`
--
ALTER TABLE `team_category`
  ADD PRIMARY KEY (`team_category_id`);

--
-- テーブルのインデックス `team_table`
--
ALTER TABLE `team_table`
  ADD PRIMARY KEY (`team_id`),
  ADD UNIQUE KEY `team_name` (`team_name`),
  ADD UNIQUE KEY `team_mail` (`team_mail`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `entry_category`
--
ALTER TABLE `entry_category`
  MODIFY `entry_category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルのAUTO_INCREMENT `PREF_managers`
--
ALTER TABLE `PREF_managers`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルのAUTO_INCREMENT `team_category`
--
ALTER TABLE `team_category`
  MODIFY `team_category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルのAUTO_INCREMENT `team_table`
--
ALTER TABLE `team_table`
  MODIFY `team_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
