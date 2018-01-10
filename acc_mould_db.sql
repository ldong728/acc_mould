-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-01-10 08:43:12
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `acc_mould_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `category_attr_tbl`
--

CREATE TABLE `category_attr_tbl` (
  `category_attr_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `category_attr_name` varchar(20) NOT NULL,
  `alt_pms` tinyint(1) NOT NULL DEFAULT '7',
  `attr_type` varchar(10) DEFAULT NULL,
  `default_value` varchar(100) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category_attr_tbl`
--

INSERT INTO `category_attr_tbl` (`category_attr_id`, `category`, `category_attr_name`, `alt_pms`, `attr_type`, `default_value`, `remark`) VALUES
(1, 11, '密度', 2, 'number', '0.00000785', NULL),
(2, 11, '长', 6, 'number', '', NULL),
(3, 11, '宽', 6, 'number', '', NULL),
(4, 11, '高', 6, 'number', '', NULL),
(5, 11, '单价', 3, 'number', '', NULL),
(6, 12, '密度', 2, 'number', '0.00000785', NULL),
(7, 12, '长', 7, 'number', '', NULL),
(8, 12, '截面积', 7, 'number', '', NULL),
(9, 12, '价格', 7, 'number', '', NULL),
(10, 2, '图纸', 7, 'file', '', NULL),
(11, 6, '图纸', 7, 'file', '', NULL),
(12, 3, '图纸', 7, 'file', '', NULL),
(13, 4, '图纸', 7, 'file', '', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `category_tbl`
--

CREATE TABLE `category_tbl` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(15) NOT NULL,
  `p_category` int(11) NOT NULL DEFAULT '0',
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category_tbl`
--

INSERT INTO `category_tbl` (`category_id`, `category_name`, `p_category`, `img`) VALUES
(1, '模具钢', 0, 'files/ae70798d261c3be973c7939f6927c772.jpg'),
(2, '模架', 0, '../files/c86e4b577d5ff606497758a8137cbb39.jpg'),
(3, '热流道', 0, '../files/bab4044c230ac949fe01657b2eaf2454.jpg'),
(4, '标准件', 0, '../files/c86e4b577d5ff606497758a8137cbb39.jpg'),
(5, '电极（石墨）', 0, '../files/ba053e4671470c246099c4d3e5b3d8c8.jpg'),
(6, '模具油缸', 0, '../files/311955598e0e008f375fd202351d87a3.jpg'),
(7, '刀具', 0, NULL),
(8, '模具加工设备', 0, NULL),
(9, '刀片', 7, '../files/ae70798d261c3be973c7939f6927c772.jpg'),
(10, '刀柄/刀头', 7, NULL),
(11, '方钢', 1, NULL),
(12, '圆钢', 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `company_category_tbl`
--

CREATE TABLE `company_category_tbl` (
  `company_category_id` int(11) NOT NULL,
  `company` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `company_tbl`
--

CREATE TABLE `company_tbl` (
  `company_id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `company_name` varchar(30) DEFAULT NULL,
  `company_address` varchar(50) DEFAULT NULL COMMENT '注册地址',
  `company_province` varchar(10) DEFAULT NULL,
  `company_city` varchar(15) DEFAULT NULL,
  `company_area` varchar(15) DEFAULT NULL,
  `company_tel` varchar(14) DEFAULT NULL,
  `company_employee_count` int(11) DEFAULT NULL COMMENT '员工人数',
  `company_legal_rep` varchar(10) DEFAULT NULL COMMENT '法人代表',
  `registered_capital` varchar(15) DEFAULT NULL COMMENT '注册资金',
  `major_business` varchar(50) DEFAULT NULL COMMENT '主营行业',
  `business_model` varchar(20) DEFAULT NULL COMMENT '经营模式',
  `area_size` varchar(10) DEFAULT NULL COMMENT '厂房面积',
  `introduction` text COMMENT '企业介绍',
  `img` text COMMENT '图片集'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `company_tbl`
--

INSERT INTO `company_tbl` (`company_id`, `user`, `company_name`, `company_address`, `company_province`, `company_city`, `company_area`, `company_tel`, `company_employee_count`, `company_legal_rep`, `registered_capital`, `major_business`, `business_model`, `area_size`, `introduction`, `img`) VALUES
(1, 0, '广州飞机制造厂', '测试地址', '', '', '', '12345678909', 1234, '测试姓名', '233', '模式A，模式B', '测试数据', '12312', '测试"" ad '''' ', '{"logo":"?img=files\\/f6f5e316dfa881394c6e6bb078800246.jpg","company-img":["?img=files\\/f6f5e316dfa881394c6e6bb078800246.jpg","?img=files\\/29d5f5566968ba07da6464e78cffedfc.jpg"]}');

-- --------------------------------------------------------

--
-- 表的结构 `file_tbl`
--

CREATE TABLE `file_tbl` (
  `file_id` int(11) NOT NULL,
  `file_md5` char(32) NOT NULL,
  `file_type` varchar(6) NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_original_name` varchar(40) NOT NULL,
  `file_url` varchar(60) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `file_tbl`
--

INSERT INTO `file_tbl` (`file_id`, `file_md5`, `file_type`, `file_size`, `file_original_name`, `file_url`, `create_time`) VALUES
(23, 'c86e4b577d5ff606497758a8137cbb39', '.jpg', 123555, 'res08_attpic_brief.jpg', 'files/c86e4b577d5ff606497758a8137cbb39.jpg', '2018-01-08 10:23:42'),
(26, 'de06059f2355fec3b2962e8b40373863', '.jpg', 36148, '06144050kreo.jpg', 'files/de06059f2355fec3b2962e8b40373863.jpg', '2018-01-09 02:22:09'),
(27, 'feb161ea09181b1124ddf8a134df455c', '.jpg', 141975, 'tooopen_11105006.jpg', 'files/feb161ea09181b1124ddf8a134df455c.jpg', '2018-01-09 02:33:50'),
(28, 'd5afa9c35e3f07d665f881ddc6cc9b35', '.jpg', 165596, '20121129034338664.jpg', 'files/d5afa9c35e3f07d665f881ddc6cc9b35.jpg', '2018-01-09 02:38:32'),
(29, 'ba053e4671470c246099c4d3e5b3d8c8', '.jpg', 108670, 'candle_3006.jpg', 'files/ba053e4671470c246099c4d3e5b3d8c8.jpg', '2018-01-09 02:38:36'),
(30, 'ae70798d261c3be973c7939f6927c772', '.jpg', 79063, 'tooopen_10055061.jpg', 'files/ae70798d261c3be973c7939f6927c772.jpg', '2018-01-09 02:39:32'),
(31, '311955598e0e008f375fd202351d87a3', '.jpg', 68644, 'sy_80219211654.jpg', 'files/311955598e0e008f375fd202351d87a3.jpg', '2018-01-09 02:40:22'),
(32, 'f6f5e316dfa881394c6e6bb078800246', '.jpg', 47664, '670_2016041595911687.jpg', 'files/f6f5e316dfa881394c6e6bb078800246.jpg', '2018-01-09 02:41:00'),
(36, '29d5f5566968ba07da6464e78cffedfc', '.jpg', 447007, 'palmitasmural_zh-cn10215774743_1920x1080', 'files/29d5f5566968ba07da6464e78cffedfc.jpg', '2018-01-09 02:51:17'),
(43, 'bab4044c230ac949fe01657b2eaf2454', '.jpg', 436391, 'shenandoahnp_zh-cn9981989975_1920x1080.j', 'files/bab4044c230ac949fe01657b2eaf2454.jpg', '2018-01-09 02:53:21'),
(54, '91a1509f0e2b05fb8cac9b888874335d', '.jpg', 83740, 'tooopen_11102476.jpg', 'files/91a1509f0e2b05fb8cac9b888874335d.jpg', '2018-01-09 03:24:45'),
(98, 'f46b0003b02f878abbb1973f43b47e9d', '.jpg', 114204, '5_120331151835_1.jpg', 'files/f46b0003b02f878abbb1973f43b47e9d.jpg', '2018-01-09 08:22:28');

-- --------------------------------------------------------

--
-- 表的结构 `operator_tbl`
--

CREATE TABLE `operator_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `nick_name` varchar(14) DEFAULT NULL,
  `pwd` varchar(40) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creator` varchar(20) NOT NULL DEFAULT 'admin',
  `md5` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `operator_tbl`
--

INSERT INTO `operator_tbl` (`id`, `name`, `nick_name`, `pwd`, `create_time`, `creator`, `md5`) VALUES
(2, 'user1', NULL, '123456', '2018-01-09 08:39:50', '-1', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- 表的结构 `op_pms_tbl`
--

CREATE TABLE `op_pms_tbl` (
  `o_id` int(11) NOT NULL,
  `pms_id` varchar(20) NOT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `remark2` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 替换视图以便查看 `op_pms_view`
--
CREATE TABLE `op_pms_view` (
`pms_id` varchar(20)
,`id` int(11)
,`name` varchar(20)
,`pwd` varchar(40)
,`create_time` timestamp
,`creator` varchar(20)
,`md5` varchar(40)
);

-- --------------------------------------------------------

--
-- 表的结构 `pms_tbl`
--

CREATE TABLE `pms_tbl` (
  `id` int(11) NOT NULL,
  `key_word` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `remark` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pms_tbl`
--

INSERT INTO `pms_tbl` (`id`, `key_word`, `name`, `remark`) VALUES
(108, 'pms1234', '权限管理', NULL),
(115, 'hqggdnrAHi', '测试权限', NULL),
(116, 'tTFPcoqXLD', '供应商管理', NULL);

-- --------------------------------------------------------

--
-- 替换视图以便查看 `pms_view`
--
CREATE TABLE `pms_view` (
`f_id` int(11)
,`f_key` varchar(20)
,`f_name` varchar(20)
,`s_id` int(11)
,`s_key` varchar(30)
,`s_name` varchar(30)
);

-- --------------------------------------------------------

--
-- 表的结构 `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(40) NOT NULL,
  `category` int(11) NOT NULL,
  `product_type` tinyint(1) NOT NULL DEFAULT '1',
  `img` text,
  `price_strategy` varchar(100) NOT NULL,
  `product_detail` text,
  `product_attr` text,
  `size_detail` text,
  `user` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sub_menu_tbl`
--

CREATE TABLE `sub_menu_tbl` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '-1',
  `key_word` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sub_menu_tbl`
--

INSERT INTO `sub_menu_tbl` (`id`, `parent_id`, `key_word`, `name`) VALUES
(7, 108, 'operator', '管理员'),
(8, 108, 'options', '控制选项'),
(26, 115, 'category_edit', '分类管理'),
(27, 116, 'company_edit', '新建供应商'),
(28, 116, 'company_list', '供应商列表');

-- --------------------------------------------------------

--
-- 替换视图以便查看 `sub_menu_view`
--
CREATE TABLE `sub_menu_view` (
`f_id` int(11)
,`f_key` varchar(20)
,`f_name` varchar(20)
,`s_id` int(11)
,`s_key` varchar(30)
,`s_name` varchar(30)
);

-- --------------------------------------------------------

--
-- 表的结构 `user_code_tbl`
--

CREATE TABLE `user_code_tbl` (
  `user_code_id` int(11) NOT NULL,
  `tel` char(11) NOT NULL,
  `code` char(6) NOT NULL,
  `create_time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_level_tbl`
--

CREATE TABLE `user_level_tbl` (
  `user_level_id` int(11) NOT NULL,
  `user_level_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_level_tbl`
--

INSERT INTO `user_level_tbl` (`user_level_id`, `user_level_name`) VALUES
(1, '普通会员'),
(2, 'VIP会员');

-- --------------------------------------------------------

--
-- 表的结构 `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `user_tel` char(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_level` int(11) NOT NULL,
  `user_unit` varchar(25) DEFAULT NULL,
  `user_password` char(40) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_type_tbl`
--

CREATE TABLE `user_type_tbl` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_type_tbl`
--

INSERT INTO `user_type_tbl` (`user_type_id`, `user_type_name`) VALUES
(1, '模具厂'),
(2, '模件厂'),
(3, '零件加工厂'),
(4, '钢材供应商'),
(5, '供应商'),
(6, '主机厂'),
(7, '一级零部件供应商');

-- --------------------------------------------------------

--
-- 视图结构 `op_pms_view`
--
DROP TABLE IF EXISTS `op_pms_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `op_pms_view`  AS  select `a`.`pms_id` AS `pms_id`,`b`.`id` AS `id`,`b`.`name` AS `name`,`b`.`pwd` AS `pwd`,`b`.`create_time` AS `create_time`,`b`.`creator` AS `creator`,`b`.`md5` AS `md5` from (`operator_tbl` `b` left join `op_pms_tbl` `a` on((`a`.`o_id` = `b`.`id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `pms_view`
--
DROP TABLE IF EXISTS `pms_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pms_view`  AS  select `f`.`id` AS `f_id`,`f`.`key_word` AS `f_key`,`f`.`name` AS `f_name`,`s`.`id` AS `s_id`,`s`.`key_word` AS `s_key`,`s`.`name` AS `s_name` from (`pms_tbl` `f` left join `sub_menu_tbl` `s` on((`s`.`parent_id` = `f`.`id`))) ;

-- --------------------------------------------------------

--
-- 视图结构 `sub_menu_view`
--
DROP TABLE IF EXISTS `sub_menu_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sub_menu_view`  AS  select `f`.`id` AS `f_id`,`f`.`key_word` AS `f_key`,`f`.`name` AS `f_name`,`s`.`id` AS `s_id`,`s`.`key_word` AS `s_key`,`s`.`name` AS `s_name` from (`sub_menu_tbl` `s` left join `pms_tbl` `f` on((`s`.`parent_id` = `f`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_attr_tbl`
--
ALTER TABLE `category_attr_tbl`
  ADD PRIMARY KEY (`category_attr_id`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`,`p_category`);

--
-- Indexes for table `company_tbl`
--
ALTER TABLE `company_tbl`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `file_tbl`
--
ALTER TABLE `file_tbl`
  ADD PRIMARY KEY (`file_id`),
  ADD UNIQUE KEY `file_md5` (`file_md5`);

--
-- Indexes for table `operator_tbl`
--
ALTER TABLE `operator_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `op_pms_tbl`
--
ALTER TABLE `op_pms_tbl`
  ADD PRIMARY KEY (`o_id`,`pms_id`);

--
-- Indexes for table `pms_tbl`
--
ALTER TABLE `pms_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sub_menu_tbl`
--
ALTER TABLE `sub_menu_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_code_tbl`
--
ALTER TABLE `user_code_tbl`
  ADD PRIMARY KEY (`user_code_id`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- Indexes for table `user_level_tbl`
--
ALTER TABLE `user_level_tbl`
  ADD PRIMARY KEY (`user_level_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_tel` (`user_tel`);

--
-- Indexes for table `user_type_tbl`
--
ALTER TABLE `user_type_tbl`
  ADD PRIMARY KEY (`user_type_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `category_attr_tbl`
--
ALTER TABLE `category_attr_tbl`
  MODIFY `category_attr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `company_tbl`
--
ALTER TABLE `company_tbl`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `file_tbl`
--
ALTER TABLE `file_tbl`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- 使用表AUTO_INCREMENT `operator_tbl`
--
ALTER TABLE `operator_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `pms_tbl`
--
ALTER TABLE `pms_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- 使用表AUTO_INCREMENT `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `sub_menu_tbl`
--
ALTER TABLE `sub_menu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- 使用表AUTO_INCREMENT `user_code_tbl`
--
ALTER TABLE `user_code_tbl`
  MODIFY `user_code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `user_level_tbl`
--
ALTER TABLE `user_level_tbl`
  MODIFY `user_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `user_type_tbl`
--
ALTER TABLE `user_type_tbl`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
