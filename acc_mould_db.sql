-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-01-12 15:59:26
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
  `attr_pms` tinyint(1) NOT NULL DEFAULT '7',
  `attr_type` varchar(10) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `attr_unit` varchar(10) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category_attr_tbl`
--

INSERT INTO `category_attr_tbl` (`category_attr_id`, `category`, `category_attr_name`, `attr_pms`, `attr_type`, `value`, `attr_unit`, `remark`) VALUES
(1, 8, '外形尺寸', 1, 'text', '', 'cm', NULL),
(2, 8, '夹头直径', 1, 'text', '', 'mm', NULL),
(3, 8, '钻头最大直径', 1, 'text', '', 'mm', NULL),
(4, 8, '加工定制', 1, 'text', '是', '', NULL),
(5, 8, '电压范围', 1, 'text', '', '', NULL),
(6, 8, '是否出口专用', 1, 'text', '', '', NULL),
(7, 8, '电源电压', 1, 'text', '', '', NULL),
(8, 8, '电源类型', 1, 'text', '', '', NULL),
(9, 8, '额定输出功率', 1, 'text', '', 'w', NULL),
(10, 8, '空转转速', 1, 'text', '', 'rpm', NULL),
(11, 8, '类型', 1, 'text', '', '', NULL),
(12, 8, '冷却方式', 1, 'text', '', '', NULL),
(13, 8, '适用范围', 1, 'text', '', '', NULL),
(14, 11, '密度', 2, 'number', '0.00000785', '', NULL),
(15, 11, '长', 4, 'number', '', 'mm', NULL),
(16, 11, '宽', 4, 'number', '', 'mm', NULL),
(17, 11, '高', 4, 'number', '', 'mm', NULL),
(18, 11, '价格', 5, 'number', '', '元/kg', NULL),
(19, 12, '密度', 2, 'number', '0.00000785', '', NULL),
(20, 12, '直径', 4, 'number', '', 'mm', NULL),
(21, 12, '长', 4, 'number', '', 'mm', NULL),
(22, 12, '价格', 1, 'number', '', '元/kg', NULL),
(23, 12, '公式', 2, 'func', 'function(l,s,p){return (l/2)*(l/2)*3.1415926*s*p}', '', NULL),
(25, 17, '密度', 2, 'number', '0.00000785', '', NULL),
(26, 17, '长', 4, 'number', '', 'mm', NULL),
(27, 17, '宽', 4, 'number', '', 'mm', NULL),
(28, 17, '高', 4, 'number', '', 'mm', NULL),
(29, 17, '价格', 1, 'number', '', '元/kg', NULL),
(30, 18, '密度', 2, 'number', '0.00000895', '', NULL),
(31, 18, '直径', 4, 'number', '', 'mm', NULL),
(32, 18, '长', 4, 'number', '', 'mm', NULL),
(33, 18, '价格', 1, 'number', '', '元/kg', NULL),
(34, 18, '公式', 2, 'func', 'function(l,s,p){return (l/2)*(l/2)*3.1415926*s*p}', '', NULL),
(35, 15, '图纸', 4, 'file', '', '', NULL),
(36, 15, '价格', 1, 'number', '', '元', NULL),
(37, 14, '图纸', 4, 'file', '', '', NULL),
(38, 14, '价格', 1, 'number', '', '元', NULL),
(39, 19, '价格', 1, 'number', '', '元/kg', NULL),
(40, 9, '图纸', 4, 'file', '', '', NULL),
(41, 9, '价格', 1, 'number', '', '员', NULL),
(42, 10, '图纸', 4, 'file', '', '', NULL),
(43, 10, '价格', 1, 'number', '', '元', NULL),
(44, 6, '图纸', 4, 'file', '', '', NULL),
(45, 6, '价格', 1, 'number', '', '元', NULL),
(46, 2, '图纸', 4, 'file', '', '', NULL),
(47, 2, '价格', 1, 'number', '', '元', NULL),
(48, 3, '图纸', 4, 'file', '', '', NULL),
(49, 3, '价格', 1, 'number', '', '元', NULL),
(50, 4, '图纸', 4, 'file', '', '', NULL),
(51, 4, '价格', 1, 'number', '', '元', NULL),
(52, 5, '长', 4, 'number', '', '', NULL),
(53, 5, '宽', 4, 'number', '', '', NULL),
(54, 5, '高', 4, 'number', '', '', NULL),
(55, 5, '价格', 7, 'text', '', '元', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `category_tbl`
--

CREATE TABLE `category_tbl` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(15) NOT NULL,
  `p_category` int(11) NOT NULL DEFAULT '0',
  `unit_name` varchar(8) DEFAULT NULL COMMENT '单位名称',
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category_tbl`
--

INSERT INTO `category_tbl` (`category_id`, `category_name`, `p_category`, `unit_name`, `img`) VALUES
(1, '模具钢', 0, 'kg', 'files/ae70798d261c3be973c7939f6927c772.jpg'),
(2, '模架', 0, '副', '../files/c86e4b577d5ff606497758a8137cbb39.jpg'),
(3, '热流道', 0, '套', '../files/bab4044c230ac949fe01657b2eaf2454.jpg'),
(4, '标准件', 0, '件', '?img=files/feb161ea09181b1124ddf8a134df455c.jpg'),
(5, '电极（石墨）', 0, 'kg', '../files/ba053e4671470c246099c4d3e5b3d8c8.jpg'),
(6, '模具油缸', 0, '件', '../files/311955598e0e008f375fd202351d87a3.jpg'),
(7, '刀具', 0, NULL, '?img=files/ba053e4671470c246099c4d3e5b3d8c8.jpg'),
(8, '模具加工设备', 0, '台', NULL),
(9, '刀片', 7, '片', '../files/ae70798d261c3be973c7939f6927c772.jpg'),
(10, '刀柄/刀头', 7, '把', NULL),
(11, '方钢', 1, 'kg', NULL),
(12, '圆钢', 1, 'kg', NULL),
(14, '模具加工', 0, '件', NULL),
(15, '零件加工', 0, '件', NULL),
(16, '紫铜', 0, 'kg', NULL),
(17, '方铜', 16, 'kg', NULL),
(18, '圆铜', 16, 'kg', NULL),
(19, '材料', 0, 'kg', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `company_category_tbl`
--

CREATE TABLE `company_category_tbl` (
  `company_category_id` int(11) NOT NULL,
  `company` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `company_category_tbl`
--

INSERT INTO `company_category_tbl` (`company_category_id`, `company`, `category`) VALUES
(29, 3, 3),
(30, 5, 4),
(31, 6, 4),
(32, 7, 4),
(33, 8, 4),
(34, 9, 4),
(35, 10, 4),
(36, 11, 4),
(37, 12, 4),
(38, 13, 5),
(39, 14, 5),
(40, 15, 5),
(41, 16, 5),
(42, 17, 5),
(43, 18, 5),
(51, 19, 3),
(52, 20, 3),
(44, 22, 5),
(45, 23, 5),
(46, 24, 5),
(47, 25, 5),
(48, 26, 3),
(49, 27, 3),
(50, 28, 3),
(55, 30, 3),
(56, 31, 3),
(59, 32, 8),
(60, 33, 8),
(61, 34, 8),
(62, 35, 6),
(63, 36, 6),
(64, 37, 6),
(65, 38, 6),
(66, 39, 6),
(67, 40, 6),
(71, 41, 6),
(70, 42, 6),
(69, 43, 6),
(72, 44, 4),
(73, 45, 4),
(74, 46, 4),
(75, 47, 4),
(76, 48, 4),
(79, 49, 2),
(78, 50, 2),
(80, 51, 2),
(81, 52, 2),
(82, 53, 2),
(83, 54, 3),
(84, 55, 3),
(85, 56, 3),
(86, 57, 3),
(87, 58, 3),
(88, 59, 5),
(89, 60, 5),
(90, 61, 5),
(91, 62, 5),
(92, 63, 5),
(93, 64, 6),
(94, 65, 6),
(95, 66, 6),
(96, 67, 6),
(97, 68, 6);

-- --------------------------------------------------------

--
-- 替换视图以便查看 `company_category_view`
--
CREATE TABLE `company_category_view` (
`company_category_id` int(11)
,`company` int(11)
,`category` int(11)
,`company_id` int(11)
,`user` int(11)
,`company_name` varchar(30)
,`company_address` varchar(50)
,`company_province` varchar(10)
,`company_city` varchar(15)
,`company_area` varchar(15)
,`company_tel` varchar(14)
,`company_employee_count` int(11)
,`company_legal_rep` varchar(10)
,`registered_capital` varchar(15)
,`major_business` varchar(50)
,`business_model` varchar(20)
,`area_size` varchar(10)
,`introduction` text
,`img` text
);

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
(3, 0, '柳道万和（苏州）热流道系统有限公司', '柳道万和（苏州）热流道系统有限公司苏州市吴中区甪直镇凌港路29号', '', '', '', '51265048882', 0, '', '', '热流道', '', '', '公司简介', '{"logo":"?img=files\\/c25c3b9b6e1664896505e3ed903ca233.jpg"}'),
(5, 0, '东莞市持创模具配件有限公司', '东莞市长安镇锦厦社区第四工业区（河西）锦富路17号A座一楼', '', '', '', '13794825740', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":""}'),
(6, 0, '成都玖龙紧固件有限公司', '四川省成都市金府路金府五金机电城45幢1号', '', '', '', '13699415070', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":""}'),
(7, 0, '东莞长安速利达模具五金配件店', '东莞市长安镇沙头靖海西路17号', '', '', '', '15217135763', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":""}'),
(8, 0, '嘉兴盘石轴承有限公司', '嘉兴市南湖区大桥镇嘉兴工业园', '', '', '', '180 0573 7222', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":""}'),
(9, 0, '昆山柯亿友五金机械有限公司', '昆山市张浦镇欣达路88号', '', '', '', '0512-5019 3448', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":""}'),
(10, 0, '米思米（中国）精密机械贸易有限公司', '上海市福州路666号金陵海欣大厦16楼200001', '', '', '', '13922243772', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":""}'),
(11, 0, '盘起工业（大连）有限公司', '成都市清江中路65号香格里拉花园2栋3单元701#', '', '', '', '138 8005 2472', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":""}'),
(12, 0, '祁阳县白水大通精密模具五金配送中心', '湖南祁阳县白水镇书菀路68号', '', '', '', '136 5623 1083', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":""}'),
(13, 0, '四川曙光电碳制品有限公司', '简阳市工业园贾家中小企业园', '', '', '', '13558609907', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(14, 0, '北京晶龙特碳科技有限公司', '北京市通州区经济开发区东区靓丽三街9号-541', '', '', '', '86-186-1158200', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(15, 0, '成都阿泰克特种石墨有限公司', '成都市崇州经开区华业路', '', '', '', '028-82602689', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(16, 0, '成都市龙泉曙光电碳厂', '四川省成都市龙泉驿区西河镇', '', '', '', '139 0803 5828', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(17, 0, '成都西瀚机电技术有限公司', '成都市武侯区机投镇万寿村2组', '', '', '', '13808003345', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(18, 0, '成都源动数控机械有限公司', '成都市武侯区二环路西一段04号', '', '', '', '028-85029413', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(19, 0, '台州市黄岩潘特模具热流道有限公司', '浙江省台州市黄岩区西城街道新堂村黄长路489号', '', '', '', '13157655122', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":""}'),
(20, 0, '厦门博诺热流道科技有限公司', '厦门市海沧区海沧街道中沧路6号（生产综合楼）一层B区', '', '', '', '', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":""}'),
(21, 0, '圣万提注塑工艺（苏州）有限公司', '苏州工业园区港田工业坊12B', '', '', '', '18680852309', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":"?img=files\\/3f02f4be1013ef41f9bbf286c985494c.jpg"}'),
(22, 0, '邯郸市聚兴碳素有限公司', '河北省邯郸市成安县工商行政管理局', '', '', '', '86 0310 748651', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(23, 0, '邯郸市奇峰碳素有限公司', '临漳县临漳镇小平营村', '', '', '', '13832035530', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(24, 0, '康冠石墨', '成都市大邑县沙渠镇勤政街东', '', '', '', '134 3887 2291', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(25, 0, '台州市黄岩陶银模具厂', '台州市黄岩区西城街道罗家汇村', '', '', '', '133 2603 0779', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(26, 0, '东菀市东邦热流道科技有限公司', '东菀市横沥镇新城工业区兴泰路商业街', '', '', '', '18688675046', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":""}'),
(27, 0, '东菀市诺金热流道科技有限公司', '东菀市长安镇沙头社区西旺街10号五楼502', '', '', '', '13450098973', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":"?img=files\\/425b80c605200c30ce6725a9372f400c.jpg"}'),
(28, 0, '宁波好塑热流道科技有限公司', '宁波高新区江南路1558号7楼7088-131', '', '', '', '15062342859', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":""}'),
(29, 0, '苏州好特斯模具有限公司', '苏州市吴中区甪直镇海藏路2869号', '', '', '', '13812892109', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":"?img=files\\/48dccb8fc410246b91391bac272dbea1.jpg"}'),
(30, 0, '英格斯模具制造（中国）有限公司', '杭州经济技术开发区18号大街385号', '', '', '', '18858110893', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":""}'),
(31, 0, '英柯欧模具（上海）有限公司', '上海市浦东新区南汇工业园宣中路399号16栋', '', '', '', '13808207101', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":""}'),
(32, 0, '苏州好特斯模具有限公司', '苏州市吴中区甪直镇海藏西路2869号', '', '', '', '15995646746', 0, '', '', ',模具加工设备', '', '', '公司简介', '{"logo":"?img=files\\/48dccb8fc410246b91391bac272dbea1.jpg"}'),
(33, 0, '资阳市汤杰精密机械有限公司', '四川省资阳市乐至县劳动镇', '', '', '', '028-23131168', 0, '', '', ',模具加工设备', '', '', '公司简介', '{"logo":""}'),
(34, 0, '四川精锐机电有限公司', '成都市西安中路8-40号豪瑞新界A-701', '', '', '', '028- 83933971', 0, '', '', ',模具加工设备', '', '', '公司简介', '{"logo":""}'),
(35, 0, '无锡尚诚机械自动化设备有限公司', '无锡市新区长江路7号科技创业园4区417', '', '', '', '86-0510-819504', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":""}'),
(36, 0, '惠普斯液压缸制造（深圳）有限公司', '无锡（太湖）国际科技园兴业楼A栋101号（菱湖路97号）214028', '', '', '', '189 7101 8816', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":""}'),
(37, 0, '广州市吉禾自动化设备有限公司（君凡）', '广州市天河区广园东路2193号802房', '', '', '', '020-87629650', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":""}'),
(38, 0, '大连通宝液压油缸有限公司', '大连市太平中小企业工业区', '', '', '', '0411-83162005', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":""}'),
(39, 0, '宁波市镇海丰邦液压油缸制造有限公司', '镇海区骆驼街道尚志村329国道北28号', '', '', '', '13857846986', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":""}'),
(40, 0, '沂水广聚油缸制造有限公司', '山东省临沂市沂水县崔家峪镇上泉庄村东南520米处', '', '', '', '13341285726', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":""}'),
(41, 0, '天津市四方油缸有限公司', '天津市北辰区铁东路园中园工业区26号', '', '', '', '13802169750', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":""}'),
(42, 0, '东莞市聚玖油缸有限公司', '东莞市横沥镇新城工业区兴泰路1-11号商铺后面', '', '', '', '0769-82806667', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":""}'),
(43, 0, '常州市丰淳液压油缸厂', '武进区雪堰镇阖闾城村', '', '', '', '0519-8616 2362', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":""}'),
(44, NULL, '南京福之佑标准件有限公司', '南京市栖霞区靖安街道飞花村工业园', NULL, NULL, NULL, '13770728589', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":"?img=files\\/6164fe8430475e3035fc7abf10d9dcf3.jpg"}'),
(45, NULL, '宁波宁力高强度紧固件有限公司', '宁波市镇海区九龙湖镇西河路25号', NULL, NULL, NULL, '0086-574-86531', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":"?img=files\\/257929d47b3e07c971558f573e0ecec5.jpg"}'),
(46, NULL, '温州鑫鹏紧固件有限公司', '温州市龙湾区蒲州街道上江新江路 310 号', NULL, NULL, NULL, '0577-86557775', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":"?img=files\\/6a62533d3f62fd9b34145e0bf20bf167.jpg"}'),
(47, NULL, '浙江丰华标准件制造有限公司', '浙江省瑞安市海安镇海阳工业区42号', NULL, NULL, NULL, '86-577-6527308', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":""}'),
(48, NULL, '浙江舟山市正源标准件有限公司', '浙江舟山市普陀区沈家门海洋生物工业园区正源路65号', NULL, NULL, NULL, '13506806555', 0, '', '', ',标准件', '', '', '公司简介', '{"logo":""}'),
(49, 0, '惠州市昌晖金属制品有限公司', '广东省惠州惠阳沙田镇长龙岗工业区', '', '', '', '0752-3751188', 0, '', '', ',模架', '', '', '公司简介', '{"logo":"?img=files\\/78050a898476809843737290925c707e.jpg"}'),
(50, NULL, '昆山市颖明机械有限公司', '昆山市张浦古城南路326号', NULL, NULL, NULL, '13375186550', 0, '', '', ',模架', '', '', '公司简介', '{"logo":"?img=files\\/35572475389bc4fa0d4ac5267ceba8d2.jpg"}'),
(51, NULL, '帅钢模架（苏州）有限公司（总公司）', '江苏省昆山市古城南路欧洲工业城J3', NULL, NULL, NULL, '0512-57122851', 0, '', '', ',模架', '', '', '公司简介', '{"logo":"?img=files\\/6f09964b6f171536a235f5079443f2ff.jpg"}'),
(52, NULL, '苏州鼎坚精密模具有限公司', '苏州市吴中区甪直镇联谊路98-12号', NULL, NULL, NULL, '13771751773', 0, '', '', ',模架', '', '', '公司简介', '{"logo":"?img=files\\/795d474942ced9689ead15519e61a128.jpg"}'),
(53, NULL, '苏州新东昌圣精密模架有限公司', '昆山市张浦镇南港民营开发区建林路258号', NULL, NULL, NULL, '18862166661', 0, '', '', ',模架', '', '', '公司简介', '{"logo":"?img=files\\/5d2f93d495aa4e7e0e3a13bbdeadeb4a.jpg"}'),
(54, NULL, '东莞市宝诚热流道有限公司', '东莞市横沥镇横沥村裕宁工业区维实三街10号一楼', NULL, NULL, NULL, '0769-33326081', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":"?img=files\\/2c84bae29cf40770b2984720eb6376a7.jpg"}'),
(55, NULL, '东莞市热恒注塑科技有限公司', '东莞市虎门镇北栅仁中岗工业区凤宁路17号', NULL, NULL, NULL, '13509016530', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":"?img=files\\/c6727104ddb23c4850c48ec2e0df10c0.jpg"}'),
(56, NULL, '赫斯特电热科技有限公司', '东莞市塘厦镇田心丰达工业园3栋', NULL, NULL, NULL, '13332661362', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":"?img=files\\/df977a91e42ec6312ee4132cf154364d.jpg"}'),
(57, NULL, '深圳市盘森热流道科技有限公司', '深圳市宝安区沙井街道大王山工业一路8号2楼', NULL, NULL, NULL, '13728870702', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":"?img=files\\/5e8e4acb64734539fce68d6af9d9f485.jpg"}'),
(58, NULL, '浙江思纳克热流道科技有限公司', '浙江省上虞市东关街道城南工业功能区', NULL, NULL, NULL, '15325212158', 0, '', '', ',热流道', '', '', '公司简介', '{"logo":""}'),
(59, NULL, '方大炭素新材料科技股份有限公司', '甘肃省兰州市红古区海石湾炭素路277号', NULL, NULL, NULL, '18009490513', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(60, NULL, '鸿泰石墨电极股份有限公司', '河北省邯郸市临漳县郝辛庄开发区碳素大道8号', NULL, NULL, NULL, '13964443835', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":"?img=files\\/d59776af6c909ce15549fdaacd79acc3.jpg"}'),
(61, NULL, '江龙炭素制品有限公司', '江苏省沛县龙固工业区', NULL, NULL, NULL, '13905205098', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":""}'),
(62, NULL, '临漳县恒强碳素有限公司', '河北省邯郸市临漳县工业园区', NULL, NULL, NULL, '13930089458', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":"?img=files\\/ccbb652641f7452f648ccd0e0c9c31f4.jpg"}'),
(63, NULL, '四川广汉士达炭素股份有限公司', '四川省成都市高新区永丰路47号丰尚-玉林商务港10楼', NULL, NULL, NULL, '15680818937', 0, '', '', ',电极（石墨）', '', '', '公司简介', '{"logo":"?img=files\\/c4a832d74bee10c10bfa79d9b78ad00a.jpg"}'),
(64, NULL, '东莞市金庄液压技术有限公司', '东莞市万江区新村社区旧宁基1号', NULL, NULL, NULL, '13544897199', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":"?img=files\\/98f1e739535d59d3edb892882fbb5b72.jpg"}'),
(65, NULL, '上海固浦自动化科技有限公司', '上海市松江区佘山镇强业路189号6号楼', NULL, NULL, NULL, '15618698482', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":""}'),
(66, NULL, '深圳市云锋科技有限公司 ', '广东省深圳市宝安区松岗街道楼岗南12巷8号', NULL, NULL, NULL, '13434737618', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":""}'),
(67, NULL, '无锡宁越机械有限公司', '无锡市前洲镇龙潭路11号', NULL, NULL, NULL, '15206191650  ', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":"?img=files\\/28bb8c8bae0d7638b1bd194f2f63c4d9.jpg"}'),
(68, NULL, '无锡市华良液压气动有限公司', '江苏省无锡市胡埭镇鸿翔规划路8号', NULL, NULL, NULL, '13915336839', 0, '', '', ',模具油缸', '', '', '公司简介', '{"logo":"?img=files\\/7cacbb5600fb0ecec03716b9abbb7311.jpg"}');

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
(98, 'f46b0003b02f878abbb1973f43b47e9d', '.jpg', 114204, '5_120331151835_1.jpg', 'files/f46b0003b02f878abbb1973f43b47e9d.jpg', '2018-01-09 08:22:28'),
(116, 'c25c3b9b6e1664896505e3ed903ca233', '.jpg', 20539, '公司LOGO.jpg', 'files/c25c3b9b6e1664896505e3ed903ca233.jpg', '2018-01-10 02:57:12'),
(118, '425b80c605200c30ce6725a9372f400c', '.jpg', 66511, '诺金.jpg', 'files/425b80c605200c30ce6725a9372f400c.jpg', '2018-01-12 02:30:36'),
(119, '3f02f4be1013ef41f9bbf286c985494c', '.jpg', 77405, '圣-1.jpg', 'files/3f02f4be1013ef41f9bbf286c985494c.jpg', '2018-01-12 02:37:49'),
(120, '48dccb8fc410246b91391bac272dbea1', '.jpg', 78286, '好斯特.jpg', 'files/48dccb8fc410246b91391bac272dbea1.jpg', '2018-01-12 02:45:46'),
(122, '6164fe8430475e3035fc7abf10d9dcf3', '.jpg', 55774, '未标题-1.jpg', 'files/6164fe8430475e3035fc7abf10d9dcf3.jpg', '2018-01-12 07:11:00'),
(123, '257929d47b3e07c971558f573e0ecec5', '.jpg', 51498, '未标题-1.jpg', 'files/257929d47b3e07c971558f573e0ecec5.jpg', '2018-01-12 07:12:16'),
(124, '6a62533d3f62fd9b34145e0bf20bf167', '.jpg', 67397, '未标题-1.jpg', 'files/6a62533d3f62fd9b34145e0bf20bf167.jpg', '2018-01-12 07:13:12'),
(125, '78050a898476809843737290925c707e', '.jpg', 50904, '未标题-1.jpg', 'files/78050a898476809843737290925c707e.jpg', '2018-01-12 07:21:11'),
(126, '35572475389bc4fa0d4ac5267ceba8d2', '.jpg', 84928, '未标题-1.jpg', 'files/35572475389bc4fa0d4ac5267ceba8d2.jpg', '2018-01-12 07:25:50'),
(127, '6f09964b6f171536a235f5079443f2ff', '.jpg', 57463, '未标题-1.jpg', 'files/6f09964b6f171536a235f5079443f2ff.jpg', '2018-01-12 07:29:43'),
(128, '795d474942ced9689ead15519e61a128', '.jpg', 64306, '未标题-1.jpg', 'files/795d474942ced9689ead15519e61a128.jpg', '2018-01-12 07:33:07'),
(129, '5d2f93d495aa4e7e0e3a13bbdeadeb4a', '.jpg', 58415, '未标题-1.jpg', 'files/5d2f93d495aa4e7e0e3a13bbdeadeb4a.jpg', '2018-01-12 07:34:16'),
(130, '2c84bae29cf40770b2984720eb6376a7', '.jpg', 68048, '未标题-1.jpg', 'files/2c84bae29cf40770b2984720eb6376a7.jpg', '2018-01-12 07:36:04'),
(131, 'c6727104ddb23c4850c48ec2e0df10c0', '.jpg', 46177, '未标题-1.jpg', 'files/c6727104ddb23c4850c48ec2e0df10c0.jpg', '2018-01-12 07:37:04'),
(132, 'df977a91e42ec6312ee4132cf154364d', '.jpg', 48235, '未标题-1.jpg', 'files/df977a91e42ec6312ee4132cf154364d.jpg', '2018-01-12 07:38:13'),
(133, '5e8e4acb64734539fce68d6af9d9f485', '.jpg', 57336, '未标题-1.jpg', 'files/5e8e4acb64734539fce68d6af9d9f485.jpg', '2018-01-12 07:39:24'),
(134, 'd59776af6c909ce15549fdaacd79acc3', '.jpg', 36311, '未标题-1.jpg', 'files/d59776af6c909ce15549fdaacd79acc3.jpg', '2018-01-12 07:44:47'),
(135, 'ccbb652641f7452f648ccd0e0c9c31f4', '.jpg', 40912, '未标题-1.jpg', 'files/ccbb652641f7452f648ccd0e0c9c31f4.jpg', '2018-01-12 07:47:17'),
(136, 'c4a832d74bee10c10bfa79d9b78ad00a', '.jpg', 81158, '未标题-1.jpg', 'files/c4a832d74bee10c10bfa79d9b78ad00a.jpg', '2018-01-12 07:48:39'),
(137, '98f1e739535d59d3edb892882fbb5b72', '.jpg', 56602, '未标题-1.jpg', 'files/98f1e739535d59d3edb892882fbb5b72.jpg', '2018-01-12 07:49:38'),
(138, '28bb8c8bae0d7638b1bd194f2f63c4d9', '.jpg', 59771, '未标题-1.jpg', 'files/28bb8c8bae0d7638b1bd194f2f63c4d9.jpg', '2018-01-12 07:51:41'),
(139, '7cacbb5600fb0ecec03716b9abbb7311', '.jpg', 48910, '未标题-1.jpg', 'files/7cacbb5600fb0ecec03716b9abbb7311.jpg', '2018-01-12 07:52:13');

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
(116, 'tTFPcoqXLD', '供应商管理', NULL),
(117, 'hCeSCpNQCb', '商品管理', NULL);

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
-- 替换视图以便查看 `product_company_view`
--
CREATE TABLE `product_company_view` (
`product_id` int(11)
,`product_name` varchar(40)
,`category` int(11)
,`product_pms_type` tinyint(1)
,`img` text
,`product_price` varchar(200)
,`product_detail` text
,`product_attr` text
,`size_detail` text
,`user` int(11)
,`company` int(11)
,`shipping_instr` varchar(30)
,`delivery_time` varchar(20)
,`shipping_place` varchar(20)
,`status` tinyint(4)
,`start_time` timestamp
,`end_time` datetime
,`remark` text
,`company_name` varchar(30)
);

-- --------------------------------------------------------

--
-- 表的结构 `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(40) NOT NULL,
  `category` int(11) NOT NULL,
  `product_pms_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '发布1/求购4',
  `img` text,
  `product_price` varchar(200) DEFAULT NULL COMMENT '价格梯度',
  `product_detail` text,
  `product_attr` text COMMENT '属性值',
  `size_detail` text,
  `user` int(11) DEFAULT NULL COMMENT '发布者',
  `company` int(11) DEFAULT NULL,
  `shipping_instr` varchar(30) DEFAULT NULL COMMENT '运费说明',
  `delivery_time` varchar(20) DEFAULT NULL COMMENT '发货期',
  `shipping_place` varchar(20) DEFAULT NULL COMMENT '发货地',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1正常，0下架',
  `start_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` datetime DEFAULT NULL,
  `remark` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `product_name`, `category`, `product_pms_type`, `img`, `product_price`, `product_detail`, `product_attr`, `size_detail`, `user`, `company`, `shipping_instr`, `delivery_time`, `shipping_place`, `status`, `start_time`, `end_time`, `remark`) VALUES
(4, 'abc', 8, 1, '{"product-img":["?img=files\\/29d5f5566968ba07da6464e78cffedfc.jpg"]}', '', 'abcddasdfasdf<p><img src="?img=files/c86e4b577d5ff606497758a8137cbb39.jpg" style="max-width:100%;"><br></p>', '', '', 0, 0, NULL, NULL, NULL, 1, '2018-01-12 01:12:17', '0000-00-00 00:00:00', ''),
(6, '测试商品1', 0, 1, '{"product-img":["?img=files\\/fa8c8f11cb98ead01eab9b3ec5d4137e.png"]}', '', '<p>速度发顺丰的</p>', '{"1":{"category_attr_id":"1","category":"8","category_attr_name":"\\u5916\\u5f62\\u5c3a\\u5bf8","attr_pms":"1","attr_type":"text","value":"\\u963f\\u4e09\\u5730\\u65b9","attr_unit":"cm","remark":""},"2":{"category_attr_id":"2","category":"8","category_attr_name":"\\u5939\\u5934\\u76f4\\u5f84","attr_pms":"1","attr_type":"text","value":"\\u4e09\\u4e2a\\u5bb6\\u4f19","attr_unit":"mm","remark":""},"3":{"category_attr_id":"3","category":"8","category_attr_name":"\\u94bb\\u5934\\u6700\\u5927\\u76f4\\u5f84","attr_pms":"1","attr_type":"text","value":"\\u53d1\\u4e2a ","attr_unit":"mm","remark":""},"4":{"category_attr_id":"4","category":"8","category_attr_name":"\\u52a0\\u5de5\\u5b9a\\u5236","attr_pms":"1","attr_type":"text","value":"\\u662f","attr_unit":"","remark":""},"5":{"category_attr_id":"5","category":"8","category_attr_name":"\\u7535\\u538b\\u8303\\u56f4","attr_pms":"1","attr_type":"text","value":"\\u53d1\\u7684","attr_unit":"","remark":""},"6":{"category_attr_id":"6","category":"8","category_attr_name":"\\u662f\\u5426\\u51fa\\u53e3\\u4e13\\u7528","attr_pms":"1","attr_type":"text","value":"\\u7535\\u996d\\u9505","attr_unit":"","remark":""},"7":{"category_attr_id":"7","category":"8","category_attr_name":"\\u7535\\u6e90\\u7535\\u538b","attr_pms":"1","attr_type":"text","value":"\\u7535\\u996d\\u9505","attr_unit":"","remark":""},"8":{"category_attr_id":"8","category":"8","category_attr_name":"\\u7535\\u6e90\\u7c7b\\u578b","attr_pms":"1","attr_type":"text","value":"\\u7684\\u98ce\\u683c\\u548c","attr_unit":"","remark":""},"9":{"category_attr_id":"9","category":"8","category_attr_name":"\\u989d\\u5b9a\\u8f93\\u51fa\\u529f\\u7387","attr_pms":"1","attr_type":"text","value":"\\u5730\\u65b9","attr_unit":"w","remark":""},"10":{"category_attr_id":"10","category":"8","category_attr_name":"\\u7a7a\\u8f6c\\u8f6c\\u901f","attr_pms":"1","attr_type":"text","value":"\\u5730\\u65b9","attr_unit":"rpm","remark":""},"11":{"category_attr_id":"11","category":"8","category_attr_name":"\\u7c7b\\u578b","attr_pms":"1","attr_type":"text","value":"\\u5730\\u65b9","attr_unit":"","remark":""},"12":{"category_attr_id":"12","category":"8","category_attr_name":"\\u51b7\\u5374\\u65b9\\u5f0f","attr_pms":"1","attr_type":"text","value":"\\u5730","attr_unit":"","remark":""},"13":{"category_attr_id":"13","category":"8","category_attr_name":"\\u9002\\u7528\\u8303\\u56f4","attr_pms":"1","attr_type":"text","value":"\\u5676\\u5730\\u65b9\\u560e\\u560e\\u554a","attr_unit":"","remark":""}}', '', 0, 0, '', '', '', 1, '2018-01-12 06:56:14', '0000-00-00 00:00:00', '');

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
(28, 116, 'company_list', '供应商列表'),
(29, 117, 'product_edit', '商品编辑'),
(30, 117, 'product_list', '商品列表');

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
-- 视图结构 `company_category_view`
--
DROP TABLE IF EXISTS `company_category_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `company_category_view`  AS  select `a`.`company_category_id` AS `company_category_id`,`a`.`company` AS `company`,`a`.`category` AS `category`,`b`.`company_id` AS `company_id`,`b`.`user` AS `user`,`b`.`company_name` AS `company_name`,`b`.`company_address` AS `company_address`,`b`.`company_province` AS `company_province`,`b`.`company_city` AS `company_city`,`b`.`company_area` AS `company_area`,`b`.`company_tel` AS `company_tel`,`b`.`company_employee_count` AS `company_employee_count`,`b`.`company_legal_rep` AS `company_legal_rep`,`b`.`registered_capital` AS `registered_capital`,`b`.`major_business` AS `major_business`,`b`.`business_model` AS `business_model`,`b`.`area_size` AS `area_size`,`b`.`introduction` AS `introduction`,`b`.`img` AS `img` from (`company_category_tbl` `a` left join `company_tbl` `b` on((`a`.`company` = `b`.`company_id`))) ;

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
-- 视图结构 `product_company_view`
--
DROP TABLE IF EXISTS `product_company_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_company_view`  AS  select `a`.`product_id` AS `product_id`,`a`.`product_name` AS `product_name`,`a`.`category` AS `category`,`a`.`product_pms_type` AS `product_pms_type`,`a`.`img` AS `img`,`a`.`product_price` AS `product_price`,`a`.`product_detail` AS `product_detail`,`a`.`product_attr` AS `product_attr`,`a`.`size_detail` AS `size_detail`,`a`.`user` AS `user`,`a`.`company` AS `company`,`a`.`shipping_instr` AS `shipping_instr`,`a`.`delivery_time` AS `delivery_time`,`a`.`shipping_place` AS `shipping_place`,`a`.`status` AS `status`,`a`.`start_time` AS `start_time`,`a`.`end_time` AS `end_time`,`a`.`remark` AS `remark`,`b`.`company_name` AS `company_name` from (`product_tbl` `a` left join `company_tbl` `b` on((`a`.`company` = `b`.`company_id`))) ;

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
-- Indexes for table `company_category_tbl`
--
ALTER TABLE `company_category_tbl`
  ADD PRIMARY KEY (`company_category_id`),
  ADD UNIQUE KEY `company` (`company`,`category`);

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
  MODIFY `category_attr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- 使用表AUTO_INCREMENT `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `company_category_tbl`
--
ALTER TABLE `company_category_tbl`
  MODIFY `company_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- 使用表AUTO_INCREMENT `company_tbl`
--
ALTER TABLE `company_tbl`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- 使用表AUTO_INCREMENT `file_tbl`
--
ALTER TABLE `file_tbl`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
--
-- 使用表AUTO_INCREMENT `operator_tbl`
--
ALTER TABLE `operator_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `pms_tbl`
--
ALTER TABLE `pms_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
--
-- 使用表AUTO_INCREMENT `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `sub_menu_tbl`
--
ALTER TABLE `sub_menu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
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
