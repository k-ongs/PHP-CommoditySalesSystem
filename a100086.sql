-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2020-01-07 23:37:13
-- 服务器版本： 5.5.62-log
-- PHP 版本： 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `A100086`
--

-- --------------------------------------------------------

--
-- 表的结构 `tb_comment`
--

CREATE TABLE `tb_comment` (
  `oId` int(8) UNSIGNED ZEROFILL NOT NULL COMMENT '订单ID',
  `uId` int(8) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000000' COMMENT '评论用户ID',
  `cId` int(8) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000000' COMMENT '评论商品ID',
  `content` varchar(100) NOT NULL COMMENT '评论内容',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '评论时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表，存储商品评论信息';

--
-- 转存表中的数据 `tb_comment`
--

INSERT INTO `tb_comment` (`oId`, `uId`, `cId`, `content`, `date`) VALUES
(00000002, 00000001, 00000002, '正版 PHP7内核剖析正版 PHP7内核剖析', '2020-01-07 01:52:22'),
(00000003, 00000002, 00000002, '正版 PHP7内核剖析，太喜欢啦！', '2020-01-07 01:32:27');

-- --------------------------------------------------------

--
-- 表的结构 `tb_commodity`
--

CREATE TABLE `tb_commodity` (
  `cId` int(8) UNSIGNED ZEROFILL NOT NULL COMMENT '商品ID',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '商品名',
  `details` varchar(255) DEFAULT NULL COMMENT '商品详情',
  `figure` varchar(100) DEFAULT '' COMMENT '首图地址',
  `price` float(12,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `sales` int(10) NOT NULL DEFAULT '0' COMMENT '销量',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `ucId` int(8) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表，存储商品信息';

--
-- 转存表中的数据 `tb_commodity`
--

INSERT INTO `tb_commodity` (`cId`, `name`, `details`, `figure`, `price`, `sales`, `stock`, `ucId`) VALUES
(00000001, 'php从入门到精通第5版', 'php从入门到精通第5版', 'img/upload/3727d31471b9526fee3bb8fb277d03c4.jpg', 88.00, 2, 98, 00000001),
(00000002, '正版 PHP7内核剖析', '正版 PHP7内核剖析', 'img/upload/956d3f94ce594ee2edea8aa9e1ce44ab.png', 90.00, 4, 116, 00000001),
(00000003, '正版 PHP从入门到项目实践', '正版 PHP从入门到项目实践', 'img/upload/75e20c05f796f7ac794940713c7099ef.jpg', 50.00, 2, 198, 00000001),
(00000004, 'PHP安全之道 项目安全的架构、技术与实践', 'PHP安全之道 项目安全的架构、技术与实践', 'img/upload/22de24bd735e8bb524a26a13b0ff3e08.jpg', 70.00, 1, 59, 00000001),
(00000005, 'Java从入门到精通(第5五版)', 'Java从入门到精通(第5五版)', 'img/upload/5dbb903a8ec5f27086b4e2008e67e7ea.jpg', 30.00, 1, 499, 00000002),
(00000006, '正版现货 Java程序设计', '正版现货 Java程序设计', 'img/upload/0239d1521c66de0dd2c72f0625ed9b81.jpg', 20.00, 3, 97, 00000002),
(00000007, '算法 第4版', '算法 第4版', 'img/upload/e1ca77c4ca0eddb7c3684500b306016b.jpg', 60.00, 1, 59, 00000002),
(00000008, 'Java核心技术卷1', 'Java核心技术卷1', 'img/upload/2957b201f37c03d0db27d1296fccd02f.jpg', 40.00, 0, 300, 00000002),
(00000009, '深入理解Java虚拟机', '深入理解Java虚拟机', 'img/upload/db87e4d9494b5d8c7f349305f4f823da.jpg', 33.00, 0, 200, 00000002),
(00000010, 'Spring Boot+Vue全栈开发实战', 'Spring Boot+Vue全栈开发实战', 'img/upload/74afe02faf103b5398f6f28e1c779ebb.jpg', 100.00, 0, 300, 00000002),
(00000011, 'C++从入门到精通项目案例版', 'C++从入门到精通项目案例版', 'img/upload/8d1d9c6052c9cf103d075aaa6242761c.jpg', 40.00, 0, 120, 00000003),
(00000012, 'c++ primer plus 第6版中文版', 'c++ primer plus 第6版中文版', 'img/upload/ae95fed22270d022a5b575313b312f91.jpg', 30.00, 0, 120, 00000003),
(00000013, 'Visual C++从入门到精通', 'Visual C++从入门到精通', 'img/upload/392d4e803cd3e4b5ad637f6632531294.jpg', 20.00, 0, 300, 00000003),
(00000014, '正版现货 C/C++常用算法手册 第4版', '正版现货 C/C++常用算法手册 第4版', 'img/upload/fa1be95ab4fcb2ece5835dfee640e469.jpg', 10.00, 0, 100, 00000003),
(00000015, 'Python学习手册', 'Python学习手册', 'img/upload/be07e2c4d8e840ea7e4f173bbced8511.jpg', 34.00, 0, 100, 00000004);

-- --------------------------------------------------------

--
-- 表的结构 `tb_commodit_class`
--

CREATE TABLE `tb_commodit_class` (
  `ucId` int(8) UNSIGNED ZEROFILL NOT NULL COMMENT '商品分类Id',
  `ccName` varchar(10) NOT NULL DEFAULT '' COMMENT '类别名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品分类表，储存商品分类信息';

--
-- 转存表中的数据 `tb_commodit_class`
--

INSERT INTO `tb_commodit_class` (`ucId`, `ccName`) VALUES
(00000001, 'PHP书籍'),
(00000002, 'JAVA书籍'),
(00000003, 'C++书籍'),
(00000004, 'Python书籍');

-- --------------------------------------------------------

--
-- 表的结构 `tb_commodit_imgs`
--

CREATE TABLE `tb_commodit_imgs` (
  `iId` int(8) UNSIGNED ZEROFILL NOT NULL COMMENT '图片Id',
  `cId` int(8) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000000' COMMENT '商品ID',
  `iAddress` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品图片表，存储商品详情图片';

--
-- 转存表中的数据 `tb_commodit_imgs`
--

INSERT INTO `tb_commodit_imgs` (`iId`, `cId`, `iAddress`) VALUES
(00000001, 00000001, 'img/upload/dad274e018526837172e1ac704c973bb.jpg'),
(00000002, 00000001, 'img/upload/1f4d38443080d4430b94b59d38cb3245.png'),
(00000003, 00000001, 'img/upload/6597da6b198d6baec1d74f4ade86d515.png'),
(00000004, 00000003, 'img/upload/b1c98212720d0c5cb15cf26932dc9531.jpg'),
(00000005, 00000003, 'img/upload/fa8d6c1d39982ebfdafd4ae228cbbad9.jpg'),
(00000006, 00000003, 'img/upload/2af4c592f6887acc495d32ed382a5365.jpg'),
(00000007, 00000004, 'img/upload/8d2cb317ccae3ea6a934aa6cb9c441f6.jpg'),
(00000008, 00000004, 'img/upload/50f07b672e4edf9e8abbe8e2769860e8.jpg'),
(00000009, 00000004, 'img/upload/b5b9f9a7b5e2245865f42b0fa5a5f5c9.jpg'),
(00000010, 00000005, 'img/upload/3dd739964617f371460dc02ddbb1862c.jpg'),
(00000011, 00000005, 'img/upload/b13836f2bacec395dafef1e97be85d1d.jpg'),
(00000012, 00000006, 'img/upload/8a2124e77d3d446aa16cae559f786dbb.jpg'),
(00000013, 00000006, 'img/upload/936d2c06cd317bc436752de1e1938a3f.jpg'),
(00000014, 00000007, 'img/upload/5391134dbd0501784611820d6291cb75.jpg'),
(00000015, 00000007, 'img/upload/e796890625ea5aa52543e40180820f95.jpg'),
(00000016, 00000007, 'img/upload/b55fe91440e40171453a0ec04f4d157c.jpg'),
(00000017, 00000008, 'img/upload/7920e81a47415a63e46f735cbe5593e3.jpg'),
(00000018, 00000008, 'img/upload/12bbb281c6ba7ddf24727d3266972950.jpg'),
(00000019, 00000008, 'img/upload/5dfbf90507a48c2090f61ab1757452b8.jpg'),
(00000020, 00000009, 'img/upload/4d574d5beaec19c4a651fd10e322d360.jpg'),
(00000021, 00000009, 'img/upload/0bc4a23db6aa1aa7779fd4edb137b96c.jpg'),
(00000022, 00000009, 'img/upload/f2695e445806521c8d58322014dc2dc5.jpg'),
(00000023, 00000010, 'img/upload/38266eee9fbe80d35ae74f5c544ea0f6.jpg'),
(00000024, 00000010, 'img/upload/81ee42b9b614bde65e9377fcbde6fe1e.jpg'),
(00000025, 00000010, 'img/upload/10439826b8e112c67f204d71a784675b.jpg'),
(00000026, 00000011, 'img/upload/acaca4395e14257874fb7b3ce5a7aad8.jpg'),
(00000027, 00000011, 'img/upload/f10676c55e74beac177f3f9f5ae2301b.jpg'),
(00000028, 00000011, 'img/upload/dad3208a118fb779a0cd83b5758da6bd.jpg'),
(00000029, 00000012, 'img/upload/ab52d0bb4cc1396c551636f92415d6b8.jpg'),
(00000030, 00000012, 'img/upload/58cf6fcb3312ef3460c8e9b13cb994bb.jpg'),
(00000031, 00000013, 'img/upload/d9b570111344893b871ce8d04d23eb39.jpg'),
(00000032, 00000013, 'img/upload/ed759c7073f6e9a713386750b52aa3aa.jpg'),
(00000033, 00000014, 'img/upload/8dea71cd7a2bde3ca2afed977ae81305.jpg'),
(00000034, 00000015, 'img/upload/edd18739d0db65c098f2b783c6676859.jpg'),
(00000035, 00000015, 'img/upload/b5006b4d0db8139745b6585331f8bf72.jpg'),
(00000036, 00000015, 'img/upload/259656f85066bfda1ea88172fbea3814.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `tb_seckill`
--

CREATE TABLE `tb_seckill` (
  `sId` int(8) UNSIGNED ZEROFILL NOT NULL COMMENT '秒杀Id',
  `cId` int(8) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000000' COMMENT '商品Id',
  `nums` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '数量',
  `num` int(10) NOT NULL DEFAULT '0',
  `recommends` float(4,2) NOT NULL DEFAULT '0.00' COMMENT '折扣率',
  `startDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '发布日期',
  `endDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '截止日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='秒杀活动表，存储秒杀活动信息';

--
-- 转存表中的数据 `tb_seckill`
--

INSERT INTO `tb_seckill` (`sId`, `cId`, `nums`, `num`, `recommends`, `startDate`, `endDate`) VALUES
(00000001, 00000001, 30, 2, 70.00, '2020-01-07 01:00:01', '2025-02-07 02:00:02'),
(00000002, 00000002, 30, 3, 90.00, '2020-01-07 01:00:01', '2025-02-07 02:00:02'),
(00000003, 00000003, 100, 2, 90.00, '2020-01-07 01:00:01', '2025-02-07 02:00:02'),
(00000004, 00000004, 30, 0, 75.00, '2020-01-07 01:00:01', '2025-02-07 02:00:02'),
(00000005, 00000005, 30, 0, 80.00, '2020-01-07 01:00:01', '2025-02-07 02:00:02'),
(00000006, 00000006, 30, 0, 90.00, '2020-01-07 01:00:01', '2025-02-07 02:00:02'),
(00000007, 00000015, 100, 0, 50.00, '2020-01-07 01:00:01', '2025-02-07 02:00:02'),
(00000008, 00000009, 100, 0, 90.00, '2020-01-07 01:00:01', '2025-02-07 02:00:02'),
(00000009, 00000007, 30, 0, 90.00, '2020-01-07 01:00:01', '2025-02-07 02:00:02'),
(00000010, 00000008, 100, 0, 80.00, '2020-01-07 01:00:01', '2026-02-07 02:00:02'),
(00000011, 00000012, 100, 0, 90.00, '2020-01-07 01:00:01', '2025-02-07 02:00:02');

-- --------------------------------------------------------

--
-- 表的结构 `tb_s_user`
--

CREATE TABLE `tb_s_user` (
  `uId` int(8) UNSIGNED ZEROFILL NOT NULL COMMENT '用户Id',
  `userName` varchar(16) NOT NULL DEFAULT '' COMMENT '用户名',
  `userPass` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `sex` enum('男','女') NOT NULL DEFAULT '男' COMMENT '性别',
  `level` int(2) NOT NULL DEFAULT '1' COMMENT '等级',
  `balance` float(12,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `address` varchar(100) DEFAULT NULL COMMENT '送货地址',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表，存储用户信息';

--
-- 转存表中的数据 `tb_s_user`
--

INSERT INTO `tb_s_user` (`uId`, `userName`, `userPass`, `sex`, `level`, `balance`, `address`, `time`) VALUES
(00000001, 'test', '123456', '男', 1, 9734.00, NULL, '2020-01-07 01:10:02'),
(00000002, 'test1', '123456', '女', 1, 4410.00, '重庆师范大学', '2020-01-07 01:38:23');

-- --------------------------------------------------------

--
-- 表的结构 `tb_user_order`
--

CREATE TABLE `tb_user_order` (
  `oId` int(8) UNSIGNED ZEROFILL NOT NULL,
  `uId` int(8) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000000',
  `cId` int(8) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000000' COMMENT '商品ID',
  `num` int(11) NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1为正常商品，2为秒杀商品',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '订单状态',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '完成时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户订单表，存储用户订单信息';

--
-- 转存表中的数据 `tb_user_order`
--

INSERT INTO `tb_user_order` (`oId`, `uId`, `cId`, `num`, `type`, `status`, `date`) VALUES
(00000001, 00000001, 00000001, 2, 2, 1, '2020-01-07 01:29:17'),
(00000002, 00000001, 00000002, 1, 1, 4, '2020-01-07 01:27:22'),
(00000003, 00000002, 00000002, 3, 2, 4, '2020-01-07 01:32:24'),
(00000004, 00000002, 00000004, 1, 1, 2, '2020-01-07 01:41:24'),
(00000005, 00000002, 00000006, 3, 1, 1, '2020-01-07 01:48:24'),
(00000006, 00000002, 00000007, 1, 1, 1, '2020-01-07 01:56:24'),
(00000007, 00000002, 00000005, 1, 1, 1, '2020-01-07 01:03:25'),
(00000008, 00000002, 00000003, 2, 2, 2, '2020-01-07 01:15:25');

-- --------------------------------------------------------

--
-- 表的结构 `tb_user_shop`
--

CREATE TABLE `tb_user_shop` (
  `uId` int(8) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000000' COMMENT '用户Id',
  `cId` int(8) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000000' COMMENT '商品Id',
  `nums` int(10) NOT NULL DEFAULT '0' COMMENT '购买数量',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '商品类型'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户购物车表，存储章用户购物车信息';

--
-- 转存表中的数据 `tb_user_shop`
--

INSERT INTO `tb_user_shop` (`uId`, `cId`, `nums`, `type`) VALUES
(00000001, 00000001, 1, 1),
(00000002, 00000001, 3, 1),
(00000002, 00000002, 1, 1),
(00000002, 00000006, 1, 1);

--
-- 转储表的索引
--

--
-- 表的索引 `tb_comment`
--
ALTER TABLE `tb_comment`
  ADD KEY `uId` (`uId`),
  ADD KEY `cId` (`cId`),
  ADD KEY `oId` (`oId`);

--
-- 表的索引 `tb_commodity`
--
ALTER TABLE `tb_commodity`
  ADD PRIMARY KEY (`cId`),
  ADD KEY `ucId` (`ucId`);

--
-- 表的索引 `tb_commodit_class`
--
ALTER TABLE `tb_commodit_class`
  ADD PRIMARY KEY (`ucId`);

--
-- 表的索引 `tb_commodit_imgs`
--
ALTER TABLE `tb_commodit_imgs`
  ADD PRIMARY KEY (`iId`),
  ADD KEY `cId` (`cId`);

--
-- 表的索引 `tb_seckill`
--
ALTER TABLE `tb_seckill`
  ADD PRIMARY KEY (`sId`),
  ADD KEY `cId` (`cId`);

--
-- 表的索引 `tb_s_user`
--
ALTER TABLE `tb_s_user`
  ADD PRIMARY KEY (`uId`);

--
-- 表的索引 `tb_user_order`
--
ALTER TABLE `tb_user_order`
  ADD PRIMARY KEY (`oId`),
  ADD KEY `uId` (`uId`),
  ADD KEY `cId` (`cId`);

--
-- 表的索引 `tb_user_shop`
--
ALTER TABLE `tb_user_shop`
  ADD KEY `uId` (`uId`),
  ADD KEY `cId` (`cId`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tb_commodity`
--
ALTER TABLE `tb_commodity`
  MODIFY `cId` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '商品ID', AUTO_INCREMENT=17;

--
-- 使用表AUTO_INCREMENT `tb_commodit_class`
--
ALTER TABLE `tb_commodit_class`
  MODIFY `ucId` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '商品分类Id', AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `tb_commodit_imgs`
--
ALTER TABLE `tb_commodit_imgs`
  MODIFY `iId` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '图片Id', AUTO_INCREMENT=37;

--
-- 使用表AUTO_INCREMENT `tb_seckill`
--
ALTER TABLE `tb_seckill`
  MODIFY `sId` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '秒杀Id', AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `tb_s_user`
--
ALTER TABLE `tb_s_user`
  MODIFY `uId` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '用户Id', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `tb_user_order`
--
ALTER TABLE `tb_user_order`
  MODIFY `oId` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 限制导出的表
--

--
-- 限制表 `tb_comment`
--
ALTER TABLE `tb_comment`
  ADD CONSTRAINT `tb_comment_ibfk_1` FOREIGN KEY (`uId`) REFERENCES `tb_s_user` (`uId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_comment_ibfk_2` FOREIGN KEY (`cId`) REFERENCES `tb_commodity` (`cId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_comment_ibfk_3` FOREIGN KEY (`oId`) REFERENCES `tb_user_order` (`oId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tb_commodity`
--
ALTER TABLE `tb_commodity`
  ADD CONSTRAINT `tb_commodity_ibfk_1` FOREIGN KEY (`ucId`) REFERENCES `tb_commodit_class` (`ucId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tb_commodit_imgs`
--
ALTER TABLE `tb_commodit_imgs`
  ADD CONSTRAINT `tb_commodit_imgs_ibfk_1` FOREIGN KEY (`cId`) REFERENCES `tb_commodity` (`cId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tb_seckill`
--
ALTER TABLE `tb_seckill`
  ADD CONSTRAINT `tb_seckill_ibfk_1` FOREIGN KEY (`cId`) REFERENCES `tb_commodity` (`cId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tb_user_order`
--
ALTER TABLE `tb_user_order`
  ADD CONSTRAINT `tb_user_order_ibfk_2` FOREIGN KEY (`cId`) REFERENCES `tb_commodity` (`cId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_user_order_ibfk_1` FOREIGN KEY (`uId`) REFERENCES `tb_s_user` (`uId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tb_user_shop`
--
ALTER TABLE `tb_user_shop`
  ADD CONSTRAINT `tb_user_shop_ibfk_2` FOREIGN KEY (`cId`) REFERENCES `tb_commodity` (`cId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_user_shop_ibfk_1` FOREIGN KEY (`uId`) REFERENCES `tb_s_user` (`uId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
