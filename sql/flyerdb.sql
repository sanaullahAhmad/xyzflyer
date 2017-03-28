/*
Navicat MySQL Data Transfer

Source Server         : root
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : tim_old

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-06-08 15:59:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admi_coupons`
-- ----------------------------
DROP TABLE IF EXISTS `admi_coupons`;
CREATE TABLE `admi_coupons` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_title` varchar(255) DEFAULT NULL,
  `coupon_description` text,
  `coupon_start_date` datetime DEFAULT NULL,
  `coupone_end_date` datetime DEFAULT NULL,
  `coupon_type` int(5) DEFAULT NULL,
  `coupon_status` int(3) DEFAULT NULL,
  `coupon_value` float(11,0) DEFAULT NULL,
  `coupon_maximum_uses` int(5) DEFAULT NULL,
  `coupon_apply_once` tinyint(1) DEFAULT NULL,
  `coupon_new_signups` tinyint(1) DEFAULT NULL,
  `coupon_apply_on_existing_client_only` tinyint(1) DEFAULT NULL,
  `coupon_date` datetime NOT NULL,
  `coupon_modified_date` datetime DEFAULT NULL,
  `coupon_modified_admin` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admi_coupons
-- ----------------------------
INSERT INTO `admi_coupons` VALUES ('1', 'Summer Promo', 'Summer Promo', '2016-06-10 00:00:00', '2016-07-01 12:00:00', '0', null, '10', '10', '1', null, null, '2016-06-08 12:18:11', null, null, '6');

-- ----------------------------
-- Table structure for `admi_coupons_used`
-- ----------------------------
DROP TABLE IF EXISTS `admi_coupons_used`;
CREATE TABLE `admi_coupons_used` (
  `used_id` int(11) NOT NULL AUTO_INCREMENT,
  `used_date` datetime NOT NULL,
  `userId` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`used_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admi_coupons_used
-- ----------------------------

-- ----------------------------
-- Table structure for `admin_activity`
-- ----------------------------
DROP TABLE IF EXISTS `admin_activity`;
CREATE TABLE `admin_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `action_type` int(2) DEFAULT NULL,
  `activity_text` text,
  `activity_date` datetime NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin_activity
-- ----------------------------

-- ----------------------------
-- Table structure for `admin_fonts`
-- ----------------------------
DROP TABLE IF EXISTS `admin_fonts`;
CREATE TABLE `admin_fonts` (
  `fontId` int(11) NOT NULL AUTO_INCREMENT,
  `fontTitle` varchar(150) NOT NULL,
  `fontUrl` varchar(255) DEFAULT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `adminId` int(11) NOT NULL,
  PRIMARY KEY (`fontId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin_fonts
-- ----------------------------
INSERT INTO `admin_fonts` VALUES ('1', 'Serif', 'Serif', '2016-05-05 00:00:00', '2016-05-05 00:00:00', '2');

-- ----------------------------
-- Table structure for `admin_login_history`
-- ----------------------------
DROP TABLE IF EXISTS `admin_login_history`;
CREATE TABLE `admin_login_history` (
  `histoy_id` int(11) NOT NULL AUTO_INCREMENT,
  `history_ip` varchar(255) NOT NULL,
  `history_browser_info` text,
  `history_referer` tinytext,
  `history_date` datetime NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`histoy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin_login_history
-- ----------------------------
INSERT INTO `admin_login_history` VALUES ('1', '122.123.123.123', 'test', 'test', '2016-05-05 00:00:00', '6');

-- ----------------------------
-- Table structure for `admin_svgs`
-- ----------------------------
DROP TABLE IF EXISTS `admin_svgs`;
CREATE TABLE `admin_svgs` (
  `svgId` int(11) NOT NULL AUTO_INCREMENT,
  `svgTitle` varchar(100) NOT NULL,
  `svgFileUrl` varchar(255) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `adminId` int(11) NOT NULL,
  PRIMARY KEY (`svgId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin_svgs
-- ----------------------------
INSERT INTO `admin_svgs` VALUES ('1', 'test', 'square_21.svg', '2016-06-06 01:46:51', null, '6');

-- ----------------------------
-- Table structure for `admin_types`
-- ----------------------------
DROP TABLE IF EXISTS `admin_types`;
CREATE TABLE `admin_types` (
  `admin_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_type_title` varchar(150) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin_types
-- ----------------------------

-- ----------------------------
-- Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `last_activity_idx` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------
INSERT INTO `ci_sessions` VALUES ('5e307c12d75132d657f636e16d1b2f80', '::1', '0000-00-00 00:00:00', '');
INSERT INTO `ci_sessions` VALUES ('3dce4b26f6eb9167150d574bf78d05f3', '::1', '0000-00-00 00:00:00', 0x613A323A7B733A393A22757365725F64617461223B733A303A22223B733A31303A2261646D696E5F64617461223B613A333A7B733A353A2261646D696E223B693A313B733A383A22757365726E616D65223B733A353A2275736D616E223B733A31313A22706B5F61646D696E5F6964223B733A313A2232223B7D7D);
INSERT INTO `ci_sessions` VALUES ('f0d6226e3eaf05ac808d09d4f7295099', '::1', '0000-00-00 00:00:00', '');

-- ----------------------------
-- Table structure for `ci_sessions_copy`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions_copy`;
CREATE TABLE `ci_sessions_copy` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ci_sessions_copy
-- ----------------------------
INSERT INTO `ci_sessions_copy` VALUES ('5e307c12d75132d657f636e16d1b2f80', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', '1443727025', '');
INSERT INTO `ci_sessions_copy` VALUES ('3dce4b26f6eb9167150d574bf78d05f3', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', '1443714798', 'a:2:{s:9:\"user_data\";s:0:\"\";s:10:\"admin_data\";a:3:{s:5:\"admin\";i:1;s:8:\"username\";s:5:\"usman\";s:11:\"pk_admin_id\";s:1:\"2\";}}');
INSERT INTO `ci_sessions_copy` VALUES ('f0d6226e3eaf05ac808d09d4f7295099', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', '1443732677', '');

-- ----------------------------
-- Table structure for `tbl_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `admin_password` varchar(250) CHARACTER SET utf8 NOT NULL,
  `admin_email` varchar(250) NOT NULL,
  `admin_date` datetime DEFAULT NULL,
  `admin_type` int(10) DEFAULT '0',
  `admin_status` int(2) DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_admin
-- ----------------------------
INSERT INTO `tbl_admin` VALUES ('3', 'tim', 'd41d8cd98f00b204e9800998ecf8427e', 'talston01@gmail.com', '2016-06-05 19:18:35', '0', '1');
INSERT INTO `tbl_admin` VALUES ('6', 'peham', '46e530a7a0ee0994774fb852af0fd9fd', 'peham@pakipreneurs.com', '2016-06-05 20:04:01', '0', '1');
INSERT INTO `tbl_admin` VALUES ('7', 'admin', '82b887afe860e87d88c2d6af186ebc71', 'admin@admin.com', '2016-06-05 23:47:17', '0', '1');
INSERT INTO `tbl_admin` VALUES ('8', 'awais', '595f8d889c3ea3e410165919794a6320', 'awais@pakipreneurs.com', '2016-06-05 23:52:30', '1', '1');
INSERT INTO `tbl_admin` VALUES ('9', 'nousheen', 'abddff633edcfa9462d7dfd2e612c227', 'nousheen@pakipreneurs.com', '2016-06-06 00:11:47', '2', '1');

-- ----------------------------
-- Table structure for `tbl_button_tags`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_button_tags`;
CREATE TABLE `tbl_button_tags` (
  `pk_button_tags` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `button_tags_title` varchar(255) NOT NULL,
  `button_tags_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `button_tags_date` datetime NOT NULL,
  PRIMARY KEY (`pk_button_tags`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_button_tags
-- ----------------------------
INSERT INTO `tbl_button_tags` VALUES ('1', 'Open House Flyer', 'Active', '2016-01-07 00:00:00');
INSERT INTO `tbl_button_tags` VALUES ('2', 'Recruiting', 'Active', '2016-01-07 00:00:00');
INSERT INTO `tbl_button_tags` VALUES ('3', 'Newsletters', 'Active', '2016-01-07 00:00:00');
INSERT INTO `tbl_button_tags` VALUES ('4', 'Broker Tour Flyers', 'Active', '2016-01-07 00:00:00');
INSERT INTO `tbl_button_tags` VALUES ('5', 'Test 556', 'Active', '2016-03-15 04:51:21');

-- ----------------------------
-- Table structure for `tbl_clients`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_clients`;
CREATE TABLE `tbl_clients` (
  `pk_client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) DEFAULT NULL,
  `client_description` text,
  `client_logo` varchar(255) DEFAULT NULL,
  `client_status` tinyint(1) DEFAULT '1',
  `client_creation_date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`pk_client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_clients
-- ----------------------------
INSERT INTO `tbl_clients` VALUES ('1', 'Guess', null, 'Client_1.gif', '1', '2015-09-23 07:27:11');
INSERT INTO `tbl_clients` VALUES ('3', 'Banks', null, 'Client_3.gif', '1', '2015-09-23 07:33:34');
INSERT INTO `tbl_clients` VALUES ('4', 'Client frontier', null, 'Client_4.gif', '1', '2015-09-23 07:50:48');
INSERT INTO `tbl_clients` VALUES ('5', 'Client Nestle', null, 'Client_5.gif', '1', '2015-09-23 07:51:07');
INSERT INTO `tbl_clients` VALUES ('6', 'Nikon', null, 'Client_6.gif', '1', '2015-09-23 07:51:28');

-- ----------------------------
-- Table structure for `tbl_color_list`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_color_list`;
CREATE TABLE `tbl_color_list` (
  `pk_color_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `color_title` varchar(100) DEFAULT NULL,
  `color_hex_code` varchar(7) NOT NULL,
  `color_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`pk_color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_color_list
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_flyer_color_set`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_flyer_color_set`;
CREATE TABLE `tbl_flyer_color_set` (
  `pk_flyer_color_set` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `flyer_color_set_title` varchar(100) NOT NULL,
  `flyer_color_set_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `flyer_color_set_date` datetime NOT NULL,
  PRIMARY KEY (`pk_flyer_color_set`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_flyer_color_set
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_flyer_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_flyer_detail`;
CREATE TABLE `tbl_flyer_detail` (
  `pk_flyer_deatil_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `flyer_title` varchar(255) NOT NULL,
  `flyer_image` varchar(255) NOT NULL,
  `flyer_image_size` varchar(255) NOT NULL,
  `flyer_json_file` varchar(255) DEFAULT NULL,
  `flyer_creation_date` date NOT NULL,
  PRIMARY KEY (`pk_flyer_deatil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_flyer_detail
-- ----------------------------
INSERT INTO `tbl_flyer_detail` VALUES ('7', 'flyer_title', 'banner.png', '', null, '2016-01-07');
INSERT INTO `tbl_flyer_detail` VALUES ('8', 'flyer_title', 'ad', '1', null, '2016-01-30');
INSERT INTO `tbl_flyer_detail` VALUES ('9', 'flyer_title', '918f55197c11d33e94777e61c557567e.jpg', '1', null, '2016-01-30');
INSERT INTO `tbl_flyer_detail` VALUES ('10', 'flyer_title', '7d567afba26db0db88179edbf97af947.jpg', '1', null, '2016-01-31');
INSERT INTO `tbl_flyer_detail` VALUES ('11', 'flyer_title', 'e0659fab7268df2ef4eb9044f34c324c.jpg', '1', null, '2016-01-31');
INSERT INTO `tbl_flyer_detail` VALUES ('12', 'flyer_title', '0a2db3607a5f875df5ebead6ccc428aa.jpg', '1', null, '2016-01-31');
INSERT INTO `tbl_flyer_detail` VALUES ('13', 'flyer_title', 'c79c64f9b5c92d39be8b806bab476c76.jpg', '1', null, '2016-01-31');
INSERT INTO `tbl_flyer_detail` VALUES ('14', 'flyer_title', '1d0527bb967a1a0000ec42b372bed9f2.jpg', '1', null, '2016-01-31');
INSERT INTO `tbl_flyer_detail` VALUES ('15', 'flyer_title', 'fa18cc2c5137b21d826a213eee84865c.jpg', '1', null, '2016-01-31');
INSERT INTO `tbl_flyer_detail` VALUES ('16', 'flyer_title', 'ce56dd44670c74687e652d1ad89ec905.jpg', '1', null, '2016-01-31');
INSERT INTO `tbl_flyer_detail` VALUES ('17', 'flyer_title', '458c10ca20f47754fe8dbff824779e60.jpg', '1', null, '2016-01-31');
INSERT INTO `tbl_flyer_detail` VALUES ('18', 'flyer_title', 'da9885c355136b35d6dcfbd9834bc0f9.jpg', '1', null, '2016-01-31');
INSERT INTO `tbl_flyer_detail` VALUES ('19', 'flyer_title', 'b1d4a9b703215ff0df2b8552e4c3748e.jpg', '1', null, '2016-01-31');
INSERT INTO `tbl_flyer_detail` VALUES ('20', 'flyer_title', 'deb51e080906e5f0a9e763c644853a3b.jpg', '1', null, '2016-01-31');

-- ----------------------------
-- Table structure for `tbl_flyer_size`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_flyer_size`;
CREATE TABLE `tbl_flyer_size` (
  `pk_flyer_size_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `flyer_size_title` varchar(255) NOT NULL,
  `flyer_size_width` float NOT NULL,
  `flyer_size_height` float NOT NULL,
  `flyer_size_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `flyer_size_date` datetime NOT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `adminId` int(11) NOT NULL,
  PRIMARY KEY (`pk_flyer_size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_flyer_size
-- ----------------------------
INSERT INTO `tbl_flyer_size` VALUES ('1', 'Letter 8.5 x 11', '8.5', '11', 'Active', '2016-01-27 00:00:00', null, '0');

-- ----------------------------
-- Table structure for `tbl_flyer_status`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_flyer_status`;
CREATE TABLE `tbl_flyer_status` (
  `flyer_status_update_date` datetime NOT NULL,
  `fk_flyer_id` int(11) NOT NULL,
  `flyer_status` enum('Draft','Locked','Pending Review','Published') NOT NULL DEFAULT 'Draft',
  `fk_admin_id_flyer_lock` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_flyer_status
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_flyer_tags`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_flyer_tags`;
CREATE TABLE `tbl_flyer_tags` (
  `pk_flyer_tags` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `flyer_tags_title` varchar(255) NOT NULL,
  `flyer_tags_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `flyer_tags_date` datetime NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk_flyer_tags`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_flyer_tags
-- ----------------------------
INSERT INTO `tbl_flyer_tags` VALUES ('1', 'Open House Flyer', 'Active', '2016-01-07 00:00:00', null);
INSERT INTO `tbl_flyer_tags` VALUES ('2', 'Recruiting', 'Active', '2016-01-07 00:00:00', null);
INSERT INTO `tbl_flyer_tags` VALUES ('3', 'Newsletters', 'Active', '2016-01-07 00:00:00', null);
INSERT INTO `tbl_flyer_tags` VALUES ('4', 'Broker Tour Flyers', 'Active', '2016-01-07 00:00:00', null);
INSERT INTO `tbl_flyer_tags` VALUES ('5', 'hello', 'Active', '2016-03-09 04:47:02', null);
INSERT INTO `tbl_flyer_tags` VALUES ('6', 'Test 555', 'Active', '2016-03-15 04:51:02', null);

-- ----------------------------
-- Table structure for `tbl_font`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_font`;
CREATE TABLE `tbl_font` (
  `pk_font_id` int(10) unsigned NOT NULL,
  `font_title` varchar(100) NOT NULL,
  `font_name` varchar(100) DEFAULT NULL,
  `font_url` text,
  `font_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `font_create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_font
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_page`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_page`;
CREATE TABLE `tbl_page` (
  `pk_page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_delete_able` tinyint(1) DEFAULT '1',
  `page_title` varchar(250) NOT NULL,
  `page_alias` varchar(250) DEFAULT NULL,
  `page_description` longtext NOT NULL,
  `page_image` varchar(255) DEFAULT NULL,
  `page_status` tinyint(1) NOT NULL DEFAULT '1',
  `page_creation_date_time` datetime NOT NULL,
  `page_last_updated_date_time` datetime NOT NULL,
  PRIMARY KEY (`pk_page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_page
-- ----------------------------
INSERT INTO `tbl_page` VALUES ('1', '1', 'About us', 'aboutus', '&lt;p&gt;Major Properties was founded in 1964 by Arnold Luster and Fred Mills. In the family tradition, sons Jeff Luster and Brad Luster became owners of the business in 1992. As a leader in the Downtown Los Angeles real estate market for over 50 years, Major Properties has brokered over $4 billion in transactions and has served thousands of property sellers, buyers, lessors and lessees.&lt;/p&gt;n&lt;p&gt;We specialize in industrial, commercial and residential real estate located in Downtown Los Angeles, Central, South and East Los Angeles, Hollywood, West Hollywood, Koreatown and Mid-City areas.&lt;/p&gt;n&lt;p&gt;Our residential division serves the needs of individuals or corporations looking to purchase, sell or lease Downtown condos, lofts and apartments. Single family residences and multi-family income properties are also included in the mix.&lt;/p&gt;', 'photo_8.png', '1', '2014-03-05 07:47:06', '2014-03-05 09:47:13');
INSERT INTO `tbl_page` VALUES ('2', '1', 'Contact us', 'contactus', '<p>\r\n                        Major Properties <br />\r\n                        1200 W. Olympic Boulevard <br />\r\n                        Los Angeles, CA 90015\r\n                        </p>\r\n\r\n                        <p>\r\n                        213-747-4151 <br />\r\n                        info@majorproperties.com\r\n                        </p>', null, '0', '2014-03-06 05:34:58', '2015-03-16 20:59:24');
INSERT INTO `tbl_page` VALUES ('3', '1', 'Mission', 'mission', 'Our mission is to provide superior brokerage and management services, backed by the latest research, analytics and evaluation expertise. Our clients’ interests always come first, as our success depends on it. We are also owners of real estate, and treat every new listing like it is one of our own.\r\n\r\nMajor Properties is not bound by rigid policy guidelines like some national real estate firms headquartered in far-off cities. We provide a flexible marketing effort that rapidly adjusts to changing demands and fluctuating business conditions. We can provide you with up-to-the-minute sales and leasing information, as well as honest projections of future real estate value, based on our many years of experience.\r\n\r\nLos Angeles is truly multicultural, and the ability to communicate clearly is paramount in a city where people of all nationalities negotiate to sell, purchase and lease some of the choicest real estate in the world. Accordingly, our multi-lingual staff speaks English, Spanish, Korean, French, Farsi and Hebrew.', 'photo_11.png', '1', '2014-03-06 06:08:38', '2014-03-06 11:19:13');
INSERT INTO `tbl_page` VALUES ('4', '1', 'Leader ship', 'leadership', 'Major Properties was founded in 1964 by Arnold Luster and Fred Mills. In the family tradition, sons Jeff Luster and Brad Luster became owners of the business in 1992. As a leader in the Downtown Los Angeles real estate market for over 50 years, Major Properties has brokered over $4 billion in transactions and has served thousands of property sellers, buyers, lessors and lessees.', null, '1', '2014-03-06 06:38:35', '2014-03-06 08:18:04');
INSERT INTO `tbl_page` VALUES ('5', '1', 'Marketing', 'marketing', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur  pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit  amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante  ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;  In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam  convallis, arcu vel pellentesque sodales, nisi est varius diam, ac  ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec  scelerisque ligula mollis lobortis.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla  at nunc vehicula lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit  amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante  ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;  In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam  convallis, arcu vel pellentesque sodales, nisi est varius diam, ac  ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec  scelerisque ligula mollis lobortis.</p>', null, '0', '2014-03-06 06:56:15', '2015-03-16 20:50:33');
INSERT INTO `tbl_page` VALUES ('20', '1', 'Agents', 'agents', '<p>Coming from a diverse and vibrant background in mathematics, physical sciences, and the entertainment industry, Joe’s unique perspective and experiences gives him an edge not only in a technical sense but in the personal arena as well.</p>\r\n\r\n                        <p>Prior to joining the Major Properties team, Joe worked for William Morris Endeavor where he dealt with high-profile clients and worked alongside an international agent. This experience taught him the importance of correct client placement and the effectiveness of targeted marketing in order to ensure client success. In the commercial real estate sector, this knowledge has translated into a keen sense for value optimization through tenant placement as well as a strong marketing repertoire.</p>\r\n\r\n                        <p>Joe specializes in the leasing and sales of commercial, industrial, and multi-unit apartment properties. His energy and charisma has blessed him with a far-reaching network of people and friends, which he uses to his advantage in the marketing and disposition of property. Whether he represents owner/users, investors, or tenants, he is committed to the same principles of value maximization and client success.</p>\r\n\r\n                        <p>Joe is a graduate of USC where he obtained his B.A. in Economics. He is a licensed California Real Estate Agent and will be happy to provide references upon request. He may be reached by phone at (213) 747-0378 or by email joe@majorproperties.com.\r\n                        </p>', null, '1', '2015-09-21 06:33:44', '0000-00-00 00:00:00');
INSERT INTO `tbl_page` VALUES ('21', '1', 'Clients', 'clients', 'Over the years, Major Properties has served thousands of clients. From individuals to small and large businesses, multi-national corporations, investment groups and major developers, we have strived to maintain high ethical and performance standards.\r\n\r\nWe offer personal \"on-the-street\" experience. Major Properties has been in business for over 50 years and understands the complexities of the Los Angeles marketplace. We have helped our clients to purchase or rent the \"right\" property at the “right” price or to sell, lease or trade their real estate.', null, '1', '2015-09-23 07:35:40', '0000-00-00 00:00:00');
INSERT INTO `tbl_page` VALUES ('22', '0', 'Teams', 'teams', 'Coming from a diverse and vibrant background in mathematics, physical sciences, and the entertainment industry, Joe’s unique perspective and experiences gives him an edge not only in a technical sense but in the personal arena as well.\r\n\r\nPrior to joining the Major Properties team, Joe worked for William Morris Endeavor where he dealt with high-profile clients and worked alongside an international agent. This experience taught him the importance of correct client placement and the effectiveness of targeted marketing in order to ensure client success. In the commercial real estate sector, this knowledge has translated into a keen sense for value optimization through tenant placement as well as a strong marketing repertoire.\r\n\r\nJoe specializes in the leasing and sales of commercial, industrial, and multi-unit apartment properties. His energy and charisma has blessed him with a far-reaching network of people and friends, which he uses to his advantage in the marketing and disposition of property. Whether he represents owner/users, investors, or tenants, he is committed to the same principles of value maximization and client success.\r\n\r\nJoe is a graduate of USC where he obtained his B.A. in Economics. He is a licensed California Real Estate Agent and will be happy to provide references upon request. He may be reached by phone at (213) 747-0378 or by email joe@majorproperties.com.', null, '1', '2015-09-28 07:38:37', '0000-00-00 00:00:00');
INSERT INTO `tbl_page` VALUES ('23', '0', 'Histroy', 'histroy', '&lt;p&gt;Major Properties was founded in 1964 by Arnold Luster and Fred Mills. In the family tradition, sons Jeff Luster and Brad Luster became owners of the business in 1992. As a leader in the Downtown Los Angeles real estate market for over 50 years, Major Properties has brokered over $4 billion in transactions and has served thousands of property sellers, buyers, lessors and lessees.&lt;/p&gt;\\r\\n&lt;p&gt;We specialize in industrial, commercial and residential real estate located in Downtown Los Angeles, Central, South and East Los Angeles, Hollywood, West Hollywood, Koreatown and Mid-City areas.&lt;/p&gt;\\r\\n&lt;p&gt;Our residential division serves the needs of individuals or corporations looking to purchase, sell or lease Downtown condos, lofts and apartments. Single family residences and multi-family income properties are also included in the mix.&lt;/p&gt;', 'photo_23.png', '1', '2015-10-15 06:18:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_page` VALUES ('24', '0', 'Brokerage Service', 'brokerageservice', 'Major Properties was founded in 1964 by Arnold Luster and Fred Mills. In the family tradition, sons Jeff Luster and Brad Luster became owners of the business in 1992. As a leader in the Downtown Los Angeles real estate market for over 50 years, Major Properties has brokered over $4 billion in transactions and has served thousands of property sellers, buyers, lessors and lessees.\\r\\n\\r\\nWe specialize in industrial, commercial and residential real estate located in Downtown Los Angeles, Central, South and East Los Angeles, Hollywood, West Hollywood, Koreatown and Mid-City areas.\\r\\n\\r\\nOur residential division serves the needs of individuals or corporations looking to purchase, sell or lease Downtown condos, lofts and apartments. Single family residences and multi-family income properties are also included in the mix.', null, '1', '2015-10-15 07:53:28', '0000-00-00 00:00:00');
INSERT INTO `tbl_page` VALUES ('25', '0', 'Property Management', 'propertymanagement', 'Major Properties was founded in 1964 by Arnold Luster and Fred Mills. In the family tradition, sons Jeff Luster and Brad Luster became owners of the business in 1992. As a leader in the Downtown Los Angeles real estate market for over 50 years, Major Properties has brokered over $4 billion in transactions and has served thousands of property sellers, buyers, lessors and lessees.\\r\\n\\r\\nWe specialize in industrial, commercial and residential real estate located in Downtown Los Angeles, Central, South and East Los Angeles, Hollywood, West Hollywood, Koreatown and Mid-City areas.\\r\\n\\r\\nOur residential division serves the needs of individuals or corporations looking to purchase, sell or lease Downtown condos, lofts and apartments. Single family residences and multi-family income properties are also included in the mix.', null, '1', '2015-10-15 07:53:43', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `tbl_r_flyer_btn_tag`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_r_flyer_btn_tag`;
CREATE TABLE `tbl_r_flyer_btn_tag` (
  `fk_flyer_id` int(10) unsigned NOT NULL,
  `fk_btn_tag_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_r_flyer_btn_tag
-- ----------------------------
INSERT INTO `tbl_r_flyer_btn_tag` VALUES ('16', '2');
INSERT INTO `tbl_r_flyer_btn_tag` VALUES ('16', '3');
INSERT INTO `tbl_r_flyer_btn_tag` VALUES ('17', '2');
INSERT INTO `tbl_r_flyer_btn_tag` VALUES ('17', '3');
INSERT INTO `tbl_r_flyer_btn_tag` VALUES ('18', '2');
INSERT INTO `tbl_r_flyer_btn_tag` VALUES ('18', '3');
INSERT INTO `tbl_r_flyer_btn_tag` VALUES ('19', '2');
INSERT INTO `tbl_r_flyer_btn_tag` VALUES ('19', '3');
INSERT INTO `tbl_r_flyer_btn_tag` VALUES ('20', '2');
INSERT INTO `tbl_r_flyer_btn_tag` VALUES ('20', '3');

-- ----------------------------
-- Table structure for `tbl_r_flyer_flyer_tag`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_r_flyer_flyer_tag`;
CREATE TABLE `tbl_r_flyer_flyer_tag` (
  `fk_flyer_id` int(10) unsigned NOT NULL,
  `fk_flyer_tag_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_r_flyer_flyer_tag
-- ----------------------------
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('16', '1');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('16', '2');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('16', '4');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('17', '1');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('17', '2');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('17', '4');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('18', '1');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('18', '2');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('18', '4');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('19', '1');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('19', '2');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('19', '4');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('20', '1');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('20', '2');
INSERT INTO `tbl_r_flyer_flyer_tag` VALUES ('20', '4');

-- ----------------------------
-- Table structure for `tbl_r_flyer_set_to_color`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_r_flyer_set_to_color`;
CREATE TABLE `tbl_r_flyer_set_to_color` (
  `fk_flyer_set_color` int(10) unsigned NOT NULL,
  `fk_color` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_r_flyer_set_to_color
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_r_flyer_to_flyer_set`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_r_flyer_to_flyer_set`;
CREATE TABLE `tbl_r_flyer_to_flyer_set` (
  `fk_flyer_id` int(10) unsigned NOT NULL,
  `fk_flyer_set` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_r_flyer_to_flyer_set
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_r_flyer_to_font`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_r_flyer_to_font`;
CREATE TABLE `tbl_r_flyer_to_font` (
  `fk_flyer_id` int(10) unsigned NOT NULL,
  `fk_font_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_r_flyer_to_font
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_services`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_services`;
CREATE TABLE `tbl_services` (
  `pk_services_id` int(11) NOT NULL AUTO_INCREMENT,
  `services_title` varchar(250) DEFAULT NULL,
  `services_description` text NOT NULL,
  `services_images` varchar(255) DEFAULT NULL,
  `services_creation_date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`pk_services_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_services
-- ----------------------------
INSERT INTO `tbl_services` VALUES ('2', 'RESIDENTIAL REAL ESTATE BROKERAGE', '', 'photo_2.png', '2015-10-15 07:26:48');
INSERT INTO `tbl_services` VALUES ('3', 'COMMERCIAL REAL ESTATE BROKERAGE', '', 'photo_3.png', '2015-10-15 07:28:20');
INSERT INTO `tbl_services` VALUES ('4', 'INDUSTRAIALS REAL ESTATE BROKERAGE', '', 'photo_4.png', '2015-10-15 07:43:25');
INSERT INTO `tbl_services` VALUES ('5', 'SPECIAL PURPOSE REAL ESTATE BROKERAGE', '', 'photo_5.png', '2015-10-15 07:43:45');
INSERT INTO `tbl_services` VALUES ('6', 'EXPERT MARKET ANALYSIS', '', 'photo_6.jpg', '2015-10-15 07:44:00');

-- ----------------------------
-- Table structure for `user_flyers`
-- ----------------------------
DROP TABLE IF EXISTS `user_flyers`;
CREATE TABLE `user_flyers` (
  `uFlyerId` int(11) NOT NULL AUTO_INCREMENT,
  `uFlyerTitle` varchar(255) DEFAULT NULL,
  `uFlyerDate` datetime DEFAULT NULL,
  `propertyAddress` varchar(255) DEFAULT NULL,
  `propertyPrice` varchar(255) DEFAULT NULL,
  `propertyMainHeader` varchar(255) DEFAULT NULL,
  `propertyHeadline` varchar(255) DEFAULT NULL,
  `propertyBody1` varchar(255) DEFAULT NULL,
  `propertyBody2` varchar(255) DEFAULT NULL,
  `propertyBody3` varchar(255) DEFAULT NULL,
  `propertyCallToAction` varchar(255) DEFAULT NULL,
  `agent1ContactInfo` varchar(255) DEFAULT NULL,
  `agent1License` varchar(255) DEFAULT NULL,
  `agent2ContactInfo` varchar(255) DEFAULT NULL,
  `agent2License` varchar(255) DEFAULT NULL,
  `company1Info` varchar(255) DEFAULT NULL,
  `company1License` varchar(255) DEFAULT NULL,
  `company2Info` varchar(255) DEFAULT NULL,
  `company2License` varchar(255) DEFAULT NULL,
  `flyerId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`uFlyerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_flyers
-- ----------------------------

-- ----------------------------
-- Table structure for `user_notifications`
-- ----------------------------
DROP TABLE IF EXISTS `user_notifications`;
CREATE TABLE `user_notifications` (
  `notificationId` int(11) NOT NULL AUTO_INCREMENT,
  `notificationText` text CHARACTER SET utf8 COLLATE utf8_bin,
  `notificationDate` datetime DEFAULT NULL,
  `notificationStatus` int(1) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`notificationId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_notifications
-- ----------------------------
INSERT INTO `user_notifications` VALUES ('1', null, '2016-04-07 18:14:20', '1', '1');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `userFirstName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `userLastName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL,
  `userType` int(1) DEFAULT NULL,
  `userStatus` int(1) DEFAULT NULL,
  `userRegistrationDate` datetime DEFAULT NULL,
  `userDob` date DEFAULT NULL,
  `userAge` int(10) NOT NULL,
  `userGender` int(1) DEFAULT '0',
  `userIp` varchar(200) NOT NULL,
  `userVerificationCode` varchar(255) DEFAULT NULL,
  `userInfo` text CHARACTER SET utf8 COLLATE utf8_bin,
  `userSex` int(1) DEFAULT NULL,
  `userProfilePicture` text NOT NULL,
  `userCoverPicture` text NOT NULL,
  `userReferer` bigint(20) DEFAULT '0',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=397 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('396', 'pehamraza', 'Peham', 'Raza', 'peham@pakipreneurs.com', '83e5f6e6a1e857aa58a36a4cd96b65e9', '1', '1', null, null, '0', '1', '', null, null, '1', '', '', '0');

-- ----------------------------
-- Table structure for `users.old`
-- ----------------------------
DROP TABLE IF EXISTS `users.old`;
CREATE TABLE `users.old` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userFirstName` varchar(255) DEFAULT NULL,
  `userLastName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userRegistrationDate` datetime DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users.old
-- ----------------------------
INSERT INTO `users.old` VALUES ('1', 'Peham', 'Raza', 'pehamraza@gmail.com', '0192023a7bbd73250516f069df18b500', null);