/*
SQLyog Ultimate v8.32 
MySQL - 5.1.33-community : Database - sando
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sando` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `sando`;

/*Table structure for table `jos_banner` */

DROP TABLE IF EXISTS `jos_banner`;

CREATE TABLE `jos_banner` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL DEFAULT 'banner',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `showBanner` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `custombannercode` text,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tags` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`bid`),
  KEY `viewbanner` (`showBanner`),
  KEY `idx_banner_catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_banner` */

/*Table structure for table `jos_bannerclient` */

DROP TABLE IF EXISTS `jos_bannerclient`;

CREATE TABLE `jos_bannerclient` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` time DEFAULT NULL,
  `editor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_bannerclient` */

/*Table structure for table `jos_bannertrack` */

DROP TABLE IF EXISTS `jos_bannertrack`;

CREATE TABLE `jos_bannertrack` (
  `track_date` date NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_bannertrack` */

/*Table structure for table `jos_categories` */

DROP TABLE IF EXISTS `jos_categories`;

CREATE TABLE `jos_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `section` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `jos_categories` */

insert  into `jos_categories`(`id`,`parent_id`,`title`,`name`,`alias`,`image`,`section`,`image_position`,`description`,`published`,`checked_out`,`checked_out_time`,`editor`,`ordering`,`access`,`count`,`params`) values (1,0,'Pumps','','pumps','','1','left','',1,0,'0000-00-00 00:00:00',NULL,1,0,0,'');

/*Table structure for table `jos_ckfields` */

DROP TABLE IF EXISTS `jos_ckfields`;

CREATE TABLE `jos_ckfields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) DEFAULT NULL,
  `name` text,
  `label` text,
  `typefield` text,
  `defaultvalue` text,
  `mandatory` tinyint(4) DEFAULT NULL,
  `test_validity` tinyint(4) DEFAULT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `custominfo` text,
  `customerror` text,
  `customvalidation` text,
  `readonly` tinyint(4) DEFAULT NULL,
  `labelCSSclass` text,
  `fieldCSSclass` text,
  `customtext` text,
  `customtextCSSclass` text,
  `frontdisplay` tinyint(4) DEFAULT NULL,
  `fillwith` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `jos_ckfields` */

insert  into `jos_ckfields`(`id`,`fid`,`name`,`label`,`typefield`,`defaultvalue`,`mandatory`,`test_validity`,`published`,`ordering`,`custominfo`,`customerror`,`customvalidation`,`readonly`,`labelCSSclass`,`fieldCSSclass`,`customtext`,`customtextCSSclass`,`frontdisplay`,`fillwith`) values (1,0,'Name','Name','text','t_initvalueT===[--]t_maxchar===[--]t_texttype===text[--]t_minchar===[--]d_format===0[--]d_daydate===',1,NULL,1,1,'','',NULL,0,'','','<p><br mce_bogus=\"1\" /></p>','',1,'inival'),(2,1,'Name','Name','text','t_initvalueT===[--]t_maxchar===[--]t_texttype===text[--]t_minchar===[--]d_format===0[--]d_daydate===',1,NULL,1,1,'','Please enter your name',NULL,0,'','','<p><br mce_bogus=\"1\" /></p>','',1,'inival'),(3,1,'Email','Email','text','t_initvalueT===[--]t_maxchar===[--]t_texttype===email[--]t_minchar===[--]d_format===0[--]d_daydate===',1,NULL,1,2,'','Please enter a valid email id.',NULL,0,'','','<p><br mce_bogus=\"1\" /></p>','',1,'inival'),(4,1,'Number','Number','text','t_initvalueT===[--]t_maxchar===[--]t_texttype===number[--]t_minchar===[--]d_format===0[--]d_daydate===',1,NULL,1,3,'','Please enter a valid contact number',NULL,0,'','','<p><br mce_bogus=\"1\" /></p>','',1,'inival'),(5,1,'Submit','Submit','button','t_typeBT===submit',0,NULL,1,4,'','',NULL,0,'','','<p><br mce_bogus=\"1\" /></p>','',1,'inival');

/*Table structure for table `jos_ckforms` */

DROP TABLE IF EXISTS `jos_ckforms`;

CREATE TABLE `jos_ckforms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `title` text,
  `description` longtext,
  `emailfrom` text,
  `emailto` text,
  `emailcc` text,
  `emailbcc` text,
  `subject` text,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `saveresult` tinyint(4) DEFAULT NULL,
  `emailresult` tinyint(4) DEFAULT NULL,
  `textresult` longtext,
  `redirecturl` text,
  `redirectdata` tinyint(4) DEFAULT NULL,
  `captcha` tinyint(4) DEFAULT NULL,
  `captchacustominfo` text,
  `captchacustomerror` text,
  `customjs` text,
  `uploadpath` text,
  `maxfilesize` int(11) DEFAULT NULL,
  `poweredby` tinyint(4) DEFAULT NULL,
  `emailreceipt` tinyint(4) DEFAULT NULL,
  `emailreceipttext` longtext,
  `emailreceiptsubject` text,
  `emailreceiptincfield` tinyint(4) DEFAULT NULL,
  `emailreceiptincfile` tinyint(4) DEFAULT NULL,
  `emailresultincfile` tinyint(4) DEFAULT NULL,
  `formCSSclass` text,
  `displayip` tinyint(4) DEFAULT NULL,
  `displaydetail` tinyint(4) DEFAULT NULL,
  `fronttitle` text,
  `frontdescription` longtext,
  `autopublish` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `jos_ckforms` */

insert  into `jos_ckforms`(`id`,`name`,`title`,`description`,`emailfrom`,`emailto`,`emailcc`,`emailbcc`,`subject`,`created`,`created_by`,`hits`,`published`,`saveresult`,`emailresult`,`textresult`,`redirecturl`,`redirectdata`,`captcha`,`captchacustominfo`,`captchacustomerror`,`customjs`,`uploadpath`,`maxfilesize`,`poweredby`,`emailreceipt`,`emailreceipttext`,`emailreceiptsubject`,`emailreceiptincfield`,`emailreceiptincfile`,`emailresultincfile`,`formCSSclass`,`displayip`,`displaydetail`,`fronttitle`,`frontdescription`,`autopublish`) values (1,'Contact','','<p><br mce_bogus=\"1\" /></p>','sandogroup@gmail.com','sandogroup@gmail.com, sandogroup@mtnl.net.in','','','Sando Website Leads','2013-04-23 04:03:34',62,182,1,1,1,'<p>Thank you for expressing interest with us. Our executives will get in touch with you shortly!<br mce_bogus=\"1\" /></p>','',0,1,'','Incorrect value entered!',NULL,'/opt/lamp/apache2/vhostdir/sando.realtyredefined.com/tmp/',0,0,0,'<p><br mce_bogus=\"1\" /></p>','',1,0,1,'',0,0,'','<p><br mce_bogus=\"1\" /></p>',1);

/*Table structure for table `jos_ckforms_1` */

DROP TABLE IF EXISTS `jos_ckforms_1`;

CREATE TABLE `jos_ckforms_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `published` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `F2` text,
  `F3` text,
  `F4` text,
  `ipaddress` text,
  `articleid` text,
  `F5` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `jos_ckforms_1` */

insert  into `jos_ckforms_1`(`id`,`published`,`created`,`F2`,`F3`,`F4`,`ipaddress`,`articleid`,`F5`) values (1,1,'2013-04-06 06:23:54','','','','182.72.43.70',NULL,NULL),(2,1,'2013-04-06 06:31:38','','sunny@vitruviantech.com','1212121212','182.72.43.70',NULL,NULL),(3,1,'2013-04-06 06:33:31','Name','','','182.72.43.70',NULL,NULL),(4,1,'2013-04-16 00:49:51','sunny','sunny@vitruviantech.com','1212121212','182.72.43.70',NULL,NULL),(5,1,'2013-04-16 00:51:22','sunny','sunny@vitruviantech.com','1212121212','182.72.43.70',NULL,NULL),(6,1,'2013-04-16 00:55:09','sunny','sunny@vitruviantech.com','1212121212','182.72.43.70',NULL,NULL),(7,1,'2013-04-17 03:43:46','sunny','sunny@vitruviantech.com','1212121212','182.72.43.70',NULL,NULL),(8,1,'2013-04-17 03:45:11','sunny','sunny@vitruviantech.com','1212121212','182.72.43.70',NULL,NULL),(9,1,'2013-04-17 03:50:45','sunny','sunny@vitruviantech.com','1212121212','182.72.43.70',NULL,NULL),(10,1,'2013-04-17 04:02:52','sunny','sunny@vitruviantech.com','1212121212','182.72.43.70',NULL,NULL),(11,1,'2013-04-17 04:06:32','zzzzzz','sunny@vitruviantech.com','1212121212','182.72.43.70',NULL,NULL),(12,1,'2013-04-17 04:09:30','sunny','sunny@vitruviantech.com','1212121212','182.72.43.70',NULL,NULL),(13,1,'2013-04-22 07:04:41','sunny','sunny@vitruviantech.com','1212121212','182.72.43.70',NULL,NULL),(14,1,'2013-04-29 04:34:07','testqwee','manasi1608@gmail.com','98521458595','182.72.43.70',NULL,NULL),(15,1,'2013-05-13 23:42:05','Tracy Wong','tracy@cugroup.com','8613917157597','222.72.133.226',NULL,NULL),(16,1,'2013-05-14 04:24:38','prakash chemicals pvt ltd','atul@prakashchemaicals.com','9825014491','180.211.114.203',NULL,NULL),(17,1,'2013-05-27 22:01:33','T.S.Ramachandran','tsr@dalalengineering.com','9833085345','59.181.108.204',NULL,NULL);

/*Table structure for table `jos_ckprofilefields` */

DROP TABLE IF EXISTS `jos_ckprofilefields`;

CREATE TABLE `jos_ckprofilefields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profileid` int(11) DEFAULT NULL,
  `fieldid` text,
  `customlabel` text,
  `defaultvalue` text,
  `published` tinyint(4) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_ckprofilefields` */

/*Table structure for table `jos_ckprofiles` */

DROP TABLE IF EXISTS `jos_ckprofiles`;

CREATE TABLE `jos_ckprofiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formid` int(11) DEFAULT NULL,
  `name` text,
  `title` text,
  `description` longtext,
  `published` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_ckprofiles` */

/*Table structure for table `jos_components` */

DROP TABLE IF EXISTS `jos_components`;

CREATE TABLE `jos_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) unsigned NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_menu_link` varchar(255) NOT NULL DEFAULT '',
  `admin_menu_alt` varchar(255) NOT NULL DEFAULT '',
  `option` varchar(50) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `admin_menu_img` varchar(255) NOT NULL DEFAULT '',
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent_option` (`parent`,`option`(32))
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `jos_components` */

insert  into `jos_components`(`id`,`name`,`link`,`menuid`,`parent`,`admin_menu_link`,`admin_menu_alt`,`option`,`ordering`,`admin_menu_img`,`iscore`,`params`,`enabled`) values (1,'Banners','',0,0,'','Banner Management','com_banners',0,'js/ThemeOffice/component.png',0,'track_impressions=0\ntrack_clicks=0\ntag_prefix=\n\n',1),(2,'Banners','',0,1,'option=com_banners','Active Banners','com_banners',1,'js/ThemeOffice/edit.png',0,'',1),(3,'Clients','',0,1,'option=com_banners&c=client','Manage Clients','com_banners',2,'js/ThemeOffice/categories.png',0,'',1),(4,'Web Links','option=com_weblinks',0,0,'','Manage Weblinks','com_weblinks',0,'js/ThemeOffice/component.png',0,'show_comp_description=1\ncomp_description=\nshow_link_hits=1\nshow_link_description=1\nshow_other_cats=1\nshow_headings=1\nshow_page_title=1\nlink_target=0\nlink_icons=\n\n',1),(5,'Links','',0,4,'option=com_weblinks','View existing weblinks','com_weblinks',1,'js/ThemeOffice/edit.png',0,'',1),(6,'Categories','',0,4,'option=com_categories&section=com_weblinks','Manage weblink categories','',2,'js/ThemeOffice/categories.png',0,'',1),(7,'Contacts','option=com_contact',0,0,'','Edit contact details','com_contact',0,'js/ThemeOffice/component.png',1,'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n',1),(8,'Contacts','',0,7,'option=com_contact','Edit contact details','com_contact',0,'js/ThemeOffice/edit.png',1,'',1),(9,'Categories','',0,7,'option=com_categories&section=com_contact_details','Manage contact categories','',2,'js/ThemeOffice/categories.png',1,'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n',1),(10,'Polls','option=com_poll',0,0,'option=com_poll','Manage Polls','com_poll',0,'js/ThemeOffice/component.png',0,'',1),(11,'News Feeds','option=com_newsfeeds',0,0,'','News Feeds Management','com_newsfeeds',0,'js/ThemeOffice/component.png',0,'',1),(12,'Feeds','',0,11,'option=com_newsfeeds','Manage News Feeds','com_newsfeeds',1,'js/ThemeOffice/edit.png',0,'show_headings=1\nshow_name=1\nshow_articles=1\nshow_link=1\nshow_cat_description=1\nshow_cat_items=1\nshow_feed_image=1\nshow_feed_description=1\nshow_item_description=1\nfeed_word_count=0\n\n',1),(13,'Categories','',0,11,'option=com_categories&section=com_newsfeeds','Manage Categories','',2,'js/ThemeOffice/categories.png',0,'',1),(14,'User','option=com_user',0,0,'','','com_user',0,'',1,'',1),(15,'Search','option=com_search',0,0,'option=com_search','Search Statistics','com_search',0,'js/ThemeOffice/component.png',1,'enabled=0\n\n',1),(16,'Categories','',0,1,'option=com_categories&section=com_banner','Categories','',3,'',1,'',1),(17,'Wrapper','option=com_wrapper',0,0,'','Wrapper','com_wrapper',0,'',1,'',1),(18,'Mail To','',0,0,'','','com_mailto',0,'',1,'',1),(19,'Media Manager','',0,0,'option=com_media','Media Manager','com_media',0,'',1,'upload_extensions=bmp,csv,doc,epg,gif,ico,jpg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,EPG,GIF,ICO,JPG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS\nupload_maxsize=10000000\nfile_path=images\nimage_path=images/stories\nrestrict_uploads=1\nallowed_media_usergroup=3\ncheck_mime=1\nimage_extensions=bmp,gif,jpg,png\nignore_extensions=\nupload_mime=image/jpeg,image/gif,image/png,image/bmp,application/x-shockwave-flash,application/msword,application/excel,application/pdf,application/powerpoint,text/plain,application/x-zip\nupload_mime_illegal=text/html\nenable_flash=0\n\n',1),(20,'Articles','option=com_content',0,0,'','','com_content',0,'',1,'show_noauth=0\nshow_title=0\nlink_titles=0\nshow_intro=0\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=0\nshow_create_date=0\nshow_modify_date=0\nshow_item_navigation=0\nshow_readmore=0\nshow_vote=0\nshow_icons=0\nshow_pdf_icon=0\nshow_print_icon=0\nshow_email_icon=0\nshow_hits=0\nfeed_summary=0\nfilter_tags=\nfilter_attritbutes=\n\n',1),(21,'Configuration Manager','',0,0,'','Configuration','com_config',0,'',1,'',1),(22,'Installation Manager','',0,0,'','Installer','com_installer',0,'',1,'',1),(23,'Language Manager','',0,0,'','Languages','com_languages',0,'',1,'',1),(24,'Mass mail','',0,0,'','Mass Mail','com_massmail',0,'',1,'mailSubjectPrefix=\nmailBodySuffix=\n\n',1),(25,'Menu Editor','',0,0,'','Menu Editor','com_menus',0,'',1,'',1),(27,'Messaging','',0,0,'','Messages','com_messages',0,'',1,'',1),(28,'Modules Manager','',0,0,'','Modules','com_modules',0,'',1,'',1),(29,'Plugin Manager','',0,0,'','Plugins','com_plugins',0,'',1,'',1),(30,'Template Manager','',0,0,'','Templates','com_templates',0,'',1,'',1),(31,'User Manager','',0,0,'','Users','com_users',0,'',1,'allowUserRegistration=1\nnew_usertype=Registered\nuseractivation=1\nfrontend_userparams=1\n\n',1),(32,'Cache Manager','',0,0,'','Cache','com_cache',0,'',1,'',1),(33,'Control Panel','',0,0,'','Control Panel','com_cpanel',0,'',1,'',1),(34,'CK Forms','option=com_ckforms',0,0,'option=com_ckforms','CK Forms','com_ckforms',0,'../administrator/components/com_ckforms/images/logo-menu.png',0,'',1),(35,'Leads','',0,0,'option=com_leads','Leads','com_leads',0,'',0,'',1);

/*Table structure for table `jos_contact_details` */

DROP TABLE IF EXISTS `jos_contact_details`;

CREATE TABLE `jos_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_contact_details` */

/*Table structure for table `jos_content` */

DROP TABLE IF EXISTS `jos_content`;

CREATE TABLE `jos_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `title_alias` varchar(255) NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(11) unsigned NOT NULL DEFAULT '0',
  `mask` int(11) unsigned NOT NULL DEFAULT '0',
  `catid` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `parentid` int(11) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `jos_content` */

insert  into `jos_content`(`id`,`title`,`alias`,`title_alias`,`introtext`,`fulltext`,`state`,`sectionid`,`mask`,`catid`,`created`,`created_by`,`created_by_alias`,`modified`,`modified_by`,`checked_out`,`checked_out_time`,`publish_up`,`publish_down`,`images`,`urls`,`attribs`,`version`,`parentid`,`ordering`,`metakey`,`metadesc`,`access`,`hits`,`metadata`) values (1,'Magnetic Drive Sealless Pumps - Centrifugal(API 685)','magnetic-drive-sealless-pumps-centrifugalapi-685','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">Magnetic Drive Sealless Pumps</p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\">Product Overview</p>\r\n<p class=\"bodycopy\">Due to process industry’s growing concern for environment, safety, GMP Standards, high ongoing cost of maintenance and handling of costly fluids with Zero Leakage, we at ‘SANDO’ have developed ‘ MAGNETICALLY COUPLED SEALLESS PUMPS’. These pumps use Permanent Magnetic Coupling which creates neither slippage nor induction current during rotation.</p>\r\n\r\n<p class=\"bodycopy\">These pumps are ideal for handling Toxic, Hazardous, Inflammable or Corrosive Fluids. These pumps use a pair of Magnetic Cups for transmitting the torque. <b>The magnets are of best quality Rare Earth Neodium &amp; Samarium Cobalt Magnets imported from Germany.</b> The magnets can withstand the pressure upto 400 Degree Celsius. Sando Magnetic Pumps are available in Metallic as well as Non – Metallic Material of Construction. </p>\r\n\r\n<p class=\"bodycopy\">The only manufacturer offering Magnetic Drive Sealless Pumps in API 685 and ANSI Standards.</p>\r\n</div>\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\" style=\"margin-top:10px;\" mce_style=\"margin-top:10px;\">Catalogues</p>\r\n<ul class=\"bodycopy\" style=\"padding-left: 30px; line-height: 22px;\" mce_style=\"padding-left: 30px; line-height: 22px;\">\r\n	<li><a target=\"_blank\" href=\"templates/vtpl_template/images/pdf/Magnetic_Drive_Sealless_Pump_ANSI_Series.pdf\" mce_href=\"templates/vtpl_template/images/pdf/Magnetic_Drive_Sealless_Pump_ANSI_Series.pdf\">Magnetic Drive Sealless Pump ANSI Series</a><br mce_bogus=\"1\"></li>\r\n	<li><a target=\"_blank\" href=\"templates/vtpl_template/images/pdf/Magnetic_Drive_Sealless_Pump_Catalogue.pdf\" mce_href=\"templates/vtpl_template/images/pdf/Magnetic_Drive_Sealless_Pump_Catalogue.pdf\">Magnetic Drive Sealless Pump Catalogue</a><br mce_bogus=\"1\"></li>\r\n	<li><a target=\"_blank\" href=\"templates/vtpl_template/images/pdf/Magnetic_Drive_Sealless_Pump_Non_Metallic_Series.pdf\" mce_href=\"templates/vtpl_template/images/pdf/Magnetic_Drive_Sealless_Pump_Non_Metallic_Series.pdf\">Magnetic Drive Sealless Pump Non - Metallic Series</a><br mce_bogus=\"1\"></li>\r\n       <li><a target=\"_blank\" href=\"templates/vtpl_template/images/pdf/Magnetic_Drive_Sealless_Pump_API_Series.pdf\" mce_href=\"templates/vtpl_template/images/pdf/Magnetic_Drive_Sealless_Pump_API_Series.pdf\">Magnetic Drive Sealless Pump API Series</a><br mce_bogus=\"1\"></li>\r\n\r\n</ul>\r\n</div>\r\n</div>\r\n\r\n<div id=\"contactus\" style=\"margin-left:10px;\" mce_style=\"margin-left:10px;\">\r\n<form name=\"right-cta\" id=\"right-cta\" onsubmit=\"return false;\">\r\n    <p class=\"blocktitle\" style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\">Request an Instant Callback!</p>\r\n    <input class=\"required name default-value\" value=\"Name\" name=\"Name\" type=\"text\">\r\n    <input class=\"required number default-value\" value=\"Mobile\" name=\"Mobile\" type=\"text\">\r\n    <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n    \r\n\r\n    <input class=\"bttnstyle\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" value=\"SUBMIT\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input name=\"view\" value=\"basic\" type=\"hidden\">\r\n    <input name=\"task\" value=\"callback\" type=\"hidden\">\r\n    <input name=\"option\" value=\"com_vprospectgen\" type=\"hidden\">\r\n    <input name=\"Itemid\" value=\"\" type=\"hidden\">\r\n    <input name=\"format\" value=\"raw\" type=\"hidden\">\r\n    <input name=\"tmpl\" value=\"component\" type=\"hidden\">\r\n</form>\r\n</div>','',1,1,0,1,'2013-04-02 05:16:41',62,'','2013-06-02 10:23:05',62,0,'0000-00-00 00:00:00','2013-04-02 05:16:41','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',39,0,5,'','',0,355,'robots=\nauthor='),(10,'PP PVDF Pumps','pp-pvdf-pumps','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">PP / PVDF Pumps</p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\">Product Overview</p>\r\n<p class=\"bodycopy\">PP / PVDF are engineering plastics with excellent chemicals resistance properties. We at ‘Sando’ has developed state of the art products out of this engineering plastics and use it for chemical industries which are handling Acids and Alkalies. <b>The use of these Pumps ultimately has saved lot of cost as exotic and special alloys are no more required to handle such liquids.</b> Virgine PP &amp; PVDF material is imported from Europe and injection moulded to create density and sturdiness so that it works as good as any metal.</p>\r\n\r\n</div>\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\" style=\"margin-top:10px;\" mce_style=\"margin-top:10px;\">Catalogues</p>\r\n\r\n<ul class=\"bodycopy\">\r\n	<li><a href=\"templates/vtpl_template/images/pdf/PP_Pump_Catalogue.pdf\" mce_href=\"templates/vtpl_template/pdf/PP_Pump_Catalogue.pdf\" target=\"_blank\">PP Pump Catalogue</a><br mce_bogus=\"1\"></li>\r\n	<li><a href=\"templates/vtpl_template/images/pdf/PVDF_Pump_Catalogue_with_C.S.Drg(N).pdf\" mce_href=\"templates/vtpl_template/images/pdf/PVDF_Pump_Catalogue_with_C.S.Drg(N).pdf\" target=\"_blank\">PVDF Pump Catalogue</a><br mce_bogus=\"1\"></li>\r\n	\r\n</ul>\r\n</div>\r\n</div>\r\n<div mce_style=\"margin-left:10px;\" style=\"margin-left:10px;\" id=\"contactus\">\r\n<form onsubmit=\"return false;\" id=\"right-cta\" name=\"right-cta\">\r\n    <p style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\" class=\"blocktitle\">Request an Instant Callback!</p>\r\n    <input name=\"Name\" value=\"Name\" class=\"required name default-value\" type=\"text\">\r\n    <input name=\"Mobile\" value=\"Mobile\" class=\"required number default-value\" type=\"text\">\r\n    <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n    \r\n\r\n    <input value=\"SUBMIT\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" class=\"bttnstyle\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input value=\"basic\" name=\"view\" type=\"hidden\">\r\n    <input value=\"callback\" name=\"task\" type=\"hidden\">\r\n    <input value=\"com_vprospectgen\" name=\"option\" type=\"hidden\">\r\n    <input value=\"\" name=\"Itemid\" type=\"hidden\">\r\n    <input value=\"raw\" name=\"format\" type=\"hidden\">\r\n    <input value=\"component\" name=\"tmpl\" type=\"hidden\">\r\n</form>\r\n</div>','',1,1,0,1,'2013-04-22 06:03:59',62,'','2013-06-02 10:25:30',62,0,'0000-00-00 00:00:00','2013-04-22 06:03:59','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',7,0,4,'','',0,97,'robots=\nauthor='),(11,'Ceramic Pumps','ceramic-pumps','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">Ceramic (Silica Epoxy) Pumps </p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\">Product Overview</p>\r\n<p class=\"bodycopy\">\r\nSando’s true invention of 21st century is Ceramic Pumps. These pumps are an outcome of development in consultation of CIBA of Switzerland. Using the resin and hardner of chemical grade from CIBA. Sando perfected the moulding technology of ceramic powder into the pump which has all the properties required to handle corrosive and abrasive chemicals. <b>These pumps are suitable for highly corrosive acids such as concentrated HCL, dilute and concentrated Sulphuric Acid, etc.</b> The beauty of this pump is the hardness of the pump parts which can be used as an advantage of slurries present in corrosive liquid.\r\n</p>\r\n</div>\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\" style=\"margin-top:10px;\" mce_style=\"margin-top:10px;\">Catalogues</p>\r\n\r\n<ul class=\"bodycopy\">\r\n	<li><a href=\"templates/vtpl_template/images/pdf/Ceramic_Pump_Catalogue.pdf\" mce_href=\"templates/vtpl_template/pdf/Ceramic_Pump_Catalogue.pdf\" target=\"_blank\">Ceramic Pump Catalogue</a><br mce_bogus=\"1\"></li>\r\n	\r\n</ul>\r\n</div>\r\n</div>\r\n<div mce_style=\"margin-left:10px;\" style=\"margin-left:10px;\" id=\"contactus\">\r\n<form onsubmit=\"return false;\" id=\"right-cta\" name=\"right-cta\">\r\n    <p style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\" class=\"blocktitle\">Request an Instant Callback!</p>\r\n    <input name=\"Name\" value=\"Name\" class=\"required name default-value\" type=\"text\">\r\n    <input name=\"Mobile\" value=\"Mobile\" class=\"required number default-value\" type=\"text\">\r\n    <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n    \r\n\r\n    <input value=\"SUBMIT\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" class=\"bttnstyle\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input value=\"basic\" name=\"view\" type=\"hidden\">\r\n    <input value=\"callback\" name=\"task\" type=\"hidden\">\r\n    <input value=\"com_vprospectgen\" name=\"option\" type=\"hidden\">\r\n    <input value=\"\" name=\"Itemid\" type=\"hidden\">\r\n    <input value=\"raw\" name=\"format\" type=\"hidden\">\r\n    <input value=\"component\" name=\"tmpl\" type=\"hidden\">\r\n</form>\r\n</div>','',1,1,0,1,'2013-04-22 06:13:55',62,'','2013-06-02 10:11:28',62,0,'0000-00-00 00:00:00','2013-04-22 06:13:55','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',6,0,3,'','',0,100,'robots=\nauthor='),(12,'Screw Pumps','screw-pumps','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">Screw Pumps </p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\">Product Overview</p>\r\n<p class=\"bodycopy\">\r\n‘Sando’ Progressive Cavity Positive Displacement Screw Pumps handle Semi Solid Liquids, Paste,  Grease which are hard to transfer. These pumps have very wide usage in Effluent Treatment Plants and Pharmaceuticals Industries. <b>The features are positive displacement, non – pulsating flow, self priming, high suction lift and high viscosity.</b> These pumps are virtually maintenance free.\r\n</p>\r\n</div>\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\" style=\"margin-top:10px;\" mce_style=\"margin-top:10px;\">Catalogues</p>\r\n\r\n<ul class=\"bodycopy\">\r\n	<li><a href=\"templates/vtpl_template/images/pdf/Screw_Pump_Catalogue.pdf\" mce_href=\"templates/vtpl_template/pdf/Screw_Pump_Catalogue.pdf\" target=\"_blank\">Screw Pump Catalogue</a><br mce_bogus=\"1\"></li>\r\n	\r\n</ul>\r\n</div>\r\n</div>\r\n<div mce_style=\"margin-left:10px;\" style=\"margin-left:10px;\" id=\"contactus\">\r\n<form onsubmit=\"return false;\" id=\"right-cta\" name=\"right-cta\">\r\n    <p style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\" class=\"blocktitle\">Request an Instant Callback!</p>\r\n    <input name=\"Name\" value=\"Name\" class=\"required name default-value\" type=\"text\">\r\n    <input name=\"Mobile\" value=\"Mobile\" class=\"required number default-value\" type=\"text\">\r\n        <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n\r\n    <input value=\"SUBMIT\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" class=\"bttnstyle\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input value=\"basic\" name=\"view\" type=\"hidden\">\r\n    <input value=\"callback\" name=\"task\" type=\"hidden\">\r\n    <input value=\"com_vprospectgen\" name=\"option\" type=\"hidden\">\r\n    <input value=\"\" name=\"Itemid\" type=\"hidden\">\r\n    <input value=\"raw\" name=\"format\" type=\"hidden\">\r\n    <input value=\"component\" name=\"tmpl\" type=\"hidden\">\r\n</form>\r\n</div>','',1,0,0,0,'2013-04-22 06:46:42',62,'','2013-06-02 10:28:21',62,0,'0000-00-00 00:00:00','2013-04-22 06:46:42','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',5,0,7,'','',0,82,'robots=\nauthor='),(13,'Drum / Barrel Pumps','drum-barrel-pumps','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">Drum / Barrel Pumps </p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\">Product Overview</p>\r\n<p class=\"bodycopy\">\r\n‘Sando’ has covered all type of industry requirement by offering Barrel / Drum Pumps for emptying 200 &amp; 60 Litre Drums. These pumps are designed for low viscosity liquids by using centrifugal impeller and high viscosity liquids using screw type impeller. Barrel / Drum Pumps comes in three variants Flameproof &amp; Non – Flameproof with Electric Motors and Air Motors are available. These pumps are manufacture in Polypropylene (PP), Teflon and Stainless Steel material of construction.\r\n</p>\r\n</div>\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\" style=\"margin-top:10px;\" mce_style=\"margin-top:10px;\">Catalogues</p>\r\n\r\n<ul class=\"bodycopy\">\r\n	<li><a href=\"templates/vtpl_template/images/pdf/Barrel_Pump.pdf\" mce_href=\"templates/vtpl_template/images/pdf/Barrel_Pump.pdf\" target=\"_blank\">Drum / Barrel Pump Catalogue</a><br mce_bogus=\"1\"></li>\r\n	\r\n</ul>\r\n</div>\r\n</div>\r\n<div mce_style=\"margin-left:10px;\" style=\"margin-left:10px;\" id=\"contactus\">\r\n<form onsubmit=\"return false;\" id=\"right-cta\" name=\"right-cta\">\r\n    <p style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\" class=\"blocktitle\">Request an Instant Callback!</p>\r\n    <input name=\"Name\" value=\"Name\" class=\"required name default-value\" type=\"text\">\r\n    <input name=\"Mobile\" value=\"Mobile\" class=\"required number default-value\" type=\"text\">\r\n    <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n    \r\n\r\n    <input value=\"SUBMIT\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" class=\"bttnstyle\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input value=\"basic\" name=\"view\" type=\"hidden\">\r\n    <input value=\"callback\" name=\"task\" type=\"hidden\">\r\n    <input value=\"com_vprospectgen\" name=\"option\" type=\"hidden\">\r\n    <input value=\"\" name=\"Itemid\" type=\"hidden\">\r\n    <input value=\"raw\" name=\"format\" type=\"hidden\">\r\n    <input value=\"component\" name=\"tmpl\" type=\"hidden\">\r\n</form>\r\n</div>','',1,1,0,1,'2013-04-22 06:51:31',62,'','2013-06-02 10:29:15',62,0,'0000-00-00 00:00:00','2013-04-22 06:51:31','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',7,0,2,'','',0,70,'robots=\nauthor='),(2,'About Us','about-us','','<p class=\"blocktitle\">About Us</p>\r\n<p class=\"bodycopy\"><b>Sando Rotary Equipments Pvt. Ltd.</b> has been promoted by&nbsp;<b>Two</b> young technocrats having more than Twenty years of&nbsp;experience&nbsp;in the field of&nbsp;<b>Rotary Equipments.</b></p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\"><b>\"Sando\"</b> started the&nbsp;manufacturing&nbsp;of&nbsp;Mechanical&nbsp;Seal in the year 1982 and have the ultra modern manufacturing facilities. All the manufacturing operations are carried out in house including machine carbide, ceramic, carbon etc. A well laid down lapping and testing facilities are in place. <b>“Sando”</b> ensures about total quality are tested under running trials at simulated operating conditions. Major international standards are followed such as&nbsp;<b>ISO, DIN, ANSI and API.</b></p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\"><b>“Sando\"</b> commands lot of respect among its&nbsp;Indian&nbsp;&amp; Foreign buyers for its quality and timely deliveries. All the critical seal face raw materials are imported from Europe and USA. <b>“Sando\"</b> is holding reasonable level of inventories of these raw materials to meet the emergency delivery schedules of its&nbsp;customers.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\">Apart from offering mechanical seals as&nbsp;propitiatory&nbsp;designs&nbsp;under the brand name of&nbsp;<b>\"Sando\"</b>,&nbsp;the company is capable of offering seals as per the design &amp; dimensions of international brands such as Durametallic, Crane, Burgmann, Sealol, etc so as to have complete interchangeability. We at <b>“Sando”</b> offer, excellent after sales service with installation services during project implementation stage and also impart training to&nbsp;maintenance&nbsp;staff.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\">Our&nbsp;<b>\"Design &amp; Application Engineering Cell\"</b>studies the customer requirements based on the inputs made available to us and the vast data base on&nbsp;behavior&nbsp;of the fluids to arrive at the right selection of design and seal face combination suitable for a particular application prior to the final recommendations.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\"><b>\"Sando\"</b>diversified its activities in 1990 and stared the manufacturing unit for&nbsp;<b>\"Silica Epoxy Corrosion Resistant\" </b>pumps and&nbsp;Investment Cast&nbsp;centrifugal&nbsp;pumps.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\"><b>\"Sando\"</b>Silica Epoxy / Graphite / Solid PTFE pumps are suitable for highly corrosive and hazardous fluid handling. These pumps are non - metallic but having the strength of metal. It can handle liquids containing slurry particles due to excellent abrasion resistance properties. These pumps can handle liquids upto 150° C.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\"><b>\"Sando\"</b>Investment Cast Pumps are offered in SS 316, 316L, Alloy - 20 &amp; Hastalloy material of construction. Due to investment casting with the help of wax moulds, the surface finish of Casing, Impeller and Back Plate is very smooth as if they are machined.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\"><b>\"Sando\"</b>is enjoying the pioneer status in manufacturing Magnetic Drive Sealless Pumps in PP, PVDF, Teflon Lined ductile iron amoured, SS 316 material of construction. The critical component of the pumps is magnet which is imported from Germany made from rare earth material which is capable of handling fluids upto 350°C without losing its magnetism. These pumps are regularly exported to various countries Southeast Asia &amp; Middle East.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\"><b>\"Sando\"</b>has extended this technology in manufacturing Magnetic Drive Sealless Agitator assemblies which are capable upto <b>400 Bar</b> reaction pressures.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\">Plastic product division of <b>\"Sando\"</b> is manufacturing versatile &amp; unique design of valves made from Alloy, PP, PVDF, Lined PP &amp; Solid PVDF Ball Valves, Diaphragm Valves, Butterfly Valves, Non Return Valves, Sight Glasses as well as pipes &amp; fittings. The raw materials for these products are imported from Basel, Switzerland.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\">In addition <b>\"Sando\"</b>has independent manufacturing facilities for Progressive Cavity Positive Displacement  Screw Pumps widely used for slurries, semi liquid / semi –solid fluids and hard to transfer liquids.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\"><b>\"Sando\"</b>is the second largest Gear Pump manufacturer in India offering Internal &amp; External Gear Designs, Jacketed Housing and Special Alloy material of constructions.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\"><b>\"Sando\"</b>has four manufacturing units located in the vicinity of Mumbai and having the branch offices at Hyderabad, Chennai, Bangalore, Kolkata, Baroda and Ahmedabad. The company’s Head Office is located at Mumbai.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\">The Metallic Pumps are manufactured in the state of Gujarat at Ahmedabad. The unit headed by Mr. Sagar Shukla is&nbsp;Mechanical&nbsp;Engineering graduate with more than 20 years of experience in design &amp; manufacturing of&nbsp;various types of chemical process pumps. The chemical process pumps in metallic construction&nbsp;include Horizontal,&nbsp;Vertical, and Boiler&nbsp;Feed&nbsp;Pumps.</p>\r\n<p><br /></p>\r\n<p class=\"bodycopy\">The Board of Directors&nbsp;Comprises of following&nbsp;Gentlemen:</p>\r\n<table class=\"mceItemTable\" style=\"margin-left:10px;font-weight:bold;font-size: 13px;\" mce_style=\"margin-left:10px;font-weight:bold;font-size: 13px;\" border=\"0\" cellspacing=\"5\">\r\n<tbody>\r\n<tr>\r\n<td>Mr. Kamlesh Shah</td>\r\n<td><br /></td>\r\n<td>B.E.(Hons.) Chemical Engg.</td>\r\n</tr>\r\n<tr>\r\n<td>Mr. Jitendra Doshi</td>\r\n<td><br /></td>\r\n<td>B.E.(Hons.) Chemical Engg.</td>\r\n</tr>\r\n<tr>\r\n<td>Mr. Sagar Shukla</td>\r\n<td><br /></td>\r\n<td>B.E.(Hons.) Mechanical Engg.</td>\r\n</tr>\r\n<tr>\r\n<td>Mr. Ramesh Parekh</td>\r\n<td><br /></td>\r\n<td>B.E.(Hons.) Chemical Engg.</td>\r\n</tr>\r\n<tr>\r\n<td>Mr. Abhay Doshi</td>\r\n<td><br /></td>\r\n<td>B.E.(Hons.) Production Engg.</td>\r\n</tr>\r\n<tr>\r\n<td>Mr. Haresh Kothari</td>\r\n<td><br /></td>\r\n<td>C. A. (Finance)</td>\r\n</tr>\r\n</tbody>\r\n</table>','',1,0,0,0,'2013-04-02 09:55:56',62,'','2013-06-02 10:49:28',62,0,'0000-00-00 00:00:00','2013-04-02 09:55:56','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',13,0,15,'','',0,212,'robots=\nauthor='),(3,'Download Profile','download-profile','','<p class=\"blocktitle\">Download our profile</p>\r\n<p class=\"bodycopy\">Having gained indepth experience in design, manufacturing and application engineering, “Sando Group” continuously innovates new products and services.</p>\r\n<p> </p>\r\n<p class=\"bodycopy\">With the humble beginning in the year 1982, “Sando Group” introduced state of the art product in collaboration with CIBA Switzerland by introducing CERAMIC and GRAPHITE Pumps, First time in India.</p>\r\n<p> </p>\r\n<p class=\"bodycopy\">In the year 1990, “Sando Group” introduced Magnetic Drive Sealless Pumps, Agitator Drives, Laboratory Autoclaves, Bottom Agitators, again First in India using Magnetic Drive Technology. These are unique equipments which has received overwhelming response because of Pollution Free Green Earth initiatives by Chemical Industries &amp; the Government World Over. Lately Since 2010, “Sando Group” started offering API 685 &amp; ANSI Standard Pumps for TOUGHEST application in Petroleum Refinery, Petrochemical Industries, and Oil &amp; Gas Sectors.</p>\r\n<p> </p>\r\n<p class=\"bodycopy\">“Sando Group” is well versed with engineering plastics technology &amp; hence it has started international quality PVDF, PFA and Teflon Lined Pumps &amp; Valves. These Pumps &amp; Valves have very wide applications in Chemical Process Pumps.</p>\r\n<p> </p>\r\n<p class=\"bodycopy\">At “Sando Group” we strive to develop products at our R &amp; D Centre for the good of the society and mankind and try to improve the quality of life for the generations to come. We believe that technology upgradation will uplift the society at large.</p>','',1,0,0,0,'2013-04-03 05:56:54',62,'','2013-04-03 05:58:35',62,0,'0000-00-00 00:00:00','2013-04-03 05:56:54','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',2,0,14,'','',0,12,'robots=\nauthor='),(4,'Case Study','case-study','','<p class=\"blocktitle\">Case Study</p>\r\n<p class=\"bodycopy\">It is known to all that there is no one single material of construction suitable for low concentration to high concentration of Sulphuric Acid. From 0 to 15% PP is suitable, 15% to 60% PVDF is suitable &amp; 98% Cast Iron or Cast Steel is suitable. As soon as “Sando” Ceramic Pumps (Silica Epoxy Pump) came into existence, industry sighed a relief from the variable concentration of Sulphuric Acid because of Sando Ceramic Pumps are most suitable for 0 to 98% concentration Sulphuric Acid and that too upto 130 Degree Celsius temperature. This has reduced the inventory of equipment &amp; spares and also reduced the production downtime.</p>','',1,0,0,0,'2013-04-03 06:52:16',62,'','2013-04-03 06:53:24',62,0,'0000-00-00 00:00:00','2013-04-03 06:52:16','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',2,0,13,'','',0,64,'robots=\nauthor='),(5,'Contact Us','contact-us','','<div align=\"left\">\r\n              <p class=\"blocktitle\">Contact Us</p>\r\n              <p class=\"bodycopy\">The Offices and Service Centres are located in each of the above region to provide prompt and efficient services to our customers The \r\n                Contact Details are as below: </p>\r\n              <p class=\"bodycopy\" align=\"center\"><b>HeadOffice: \r\n                </b>5 \r\n                &amp; 6, Radha Dalvi Nagar, CP Road, Kandivali(East), Mumbai-400101, \r\n                INDIA </p>\r\n              <p class=\"bodycopy\" align=\"center\"><b>Tel \r\n                Nos :</b>&nbsp;&nbsp; 0091-22-28875456, 0091-22-28841214<br />\r\n                <b>Fax :&nbsp;</b>0091-22-28870347<br />\r\n                <b>Email : </b><a href=\"mailto:sandogroup@mtnl.net.in\" mce_href=\"mailto:sandogroup@mtnl.net.in\">sandogroup@mtnl.net.in</a>, \r\n                <a href=\"mailto:sandogroup@gmail.com\" mce_href=\"mailto:sandogroup@gmail.com\">sandogroup@gmail.com<br />\r\n                </a><a href=\"mailto:sando@bom5.vsnl.net.in\" mce_href=\"mailto:sando@bom5.vsnl.net.in\">sando@bom5.vsnl.net.in</a><br mce_bogus=\"1\"></p>\r\n</div>','',1,0,0,0,'2013-04-05 07:05:08',62,'','2013-04-05 07:12:30',62,0,'0000-00-00 00:00:00','2013-04-05 07:05:08','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',3,0,12,'','',0,16,'robots=\nauthor='),(6,'Sando Group Customer Base','sando-group-customer-base','','<p class=\"blocktitle\">Sando Group Customer Base</p>\r\n<div style=\"float:left;width:500px;\" mce_style=\"float:left;\">\r\n<p class=\"bodycopy\">Sando Group has penetrated the world market steadily &amp; gradually since 1995 and has its presence in Latin America, Middle East, South East Asia, Pakistan, Bangladesh &amp; Sri Lanka.</p><p><br /></p>\r\n\r\n<p class=\"bodycopy\">The Offices and Service Centres are located in each of the above region to provide prompt and efficient services to our customers.</p>\r\n</div>\r\n<p style=\"float:left;\" mce_style=\"float:left;\">\r\n<img src=\"templates/vtpl_template/images/map-1.png\" mce_src=\"templates/vtpl_template/images/map.png\">\r\n</p>','',1,0,0,0,'2013-04-05 07:14:34',62,'','2013-04-23 09:53:28',62,0,'0000-00-00 00:00:00','2013-04-05 07:14:34','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',5,0,11,'','',0,164,'robots=\nauthor='),(7,'Sando Group Quality Concerns','sando-group-quality-concerns','','<div class=\"policy\"><p class=\"blocktitle\">Sando Group Quality Policy &amp; Its Objectives</p>\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\" style=\"padding:5px 0;text-align:center;font-size:16px;font-weight:bold;\" mce_style=\"textialign:center;\">: GROUP Quality Policy :</p>\r\n\r\n<p class=\"bodycopy\">Sando Group shall strive to achieve a reputation in the National &amp; International Market through Quality Supply &amp; After Sales Service, by virtue of:</p>\r\n  <ul class=\"bodycopy\" style=\"padding-left:30px;line-height:28px\" mce_style=\"padding-left:30px;\">\r\n    <li>Research &amp; Development of Product through proper understanding &amp; interpretation of the customer requirements &amp; the application of the product in due course of time in order to achieve ultimate customer satisfaction</li>\r\n    <li>Prompt response &amp; delivery actions</li>\r\n    <li>Ensuring strict monitoring of the manufacturing process and the inspection and test criteria,/\r\n    </li><li>Implementing and maintaining a continually improving quality management system complying with the requirements of ISO 9001:2000 INTERNATIONAL STANDARD</li>\r\n</ul>\r\n</div>\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\" style=\"padding:5px 0;font-size:16px;font-weight:bold;text-align:center;\" mce_style=\"font-size:13px;text-align:center;\">: GROUP Quality Objectives :</p>\r\n\r\n<p class=\"bodycopy\">This commitment shall be fulfilled through:</p>\r\n<ul class=\"bodycopy\" style=\"padding-left:30px;line-height:28px\" mce_style=\"padding-left:30px;\">\r\n    <li>Continually improving the product design &amp; through analysis of customer requirements and applications</li>\r\n    <li>Dispatching Pumps, Mechanical Seals and Valves in the minimum number of working days</li>\r\n    <li>Increasing the supplier performance level by 100%</li>\r\n    <li>Increasing the annual turnover by 10%</li>\r\n</ul>\r\n\r\n<p align=\"center\"><img src=\"/templates/vtpl_template/images/iso.jpg\" mce_src=\"templates/vtpl_template/images/iso.jpg\" border=\"0\"></p>\r\n</div>\r\n</div>','',1,0,0,0,'2013-04-05 07:20:34',62,'','2013-06-02 10:48:04',62,0,'0000-00-00 00:00:00','2013-04-05 07:20:34','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',12,0,10,'','',0,145,'robots=\nauthor='),(8,'Sando Group Core Competency','sando-group-core-competency','','<p class=\"blocktitle\"> Core Competency</p>\r\n\r\n<p class=\"bodycopy\"><b>SANDO GROUP\'s</b> vast experience &amp; wide exposure in the chemical Process industry in the world market for more than 20 years has created a niche knowledge base &amp; exhaustive database. \'SANDO GROUP\' has always come with new developments &amp; very good innovations. At SANDO, it is a way of life to accept challenges and get success when other manufacturers fumble</p><p><br /></p>\r\n\r\n<p class=\"bodycopy\">The database is readily available to tackle any fluids under various operating conditions. The detailed application engineering is carried out to arrive at optimal solutions. SANDO is a known entity for handling corrosive &amp; hazardous chemicals. Not only design solutions, but SANDO GROUP extends the Metallurgical solutions which are unique for longer life cycles</p><p><br /></p>\r\n\r\n<p class=\"bodycopy\">SANDO has imbibed environment friendly work culture in the minds of every member of our group</p><p><br /></p>\r\n\r\n<p class=\"bodycopy\">Our core competent products are:</p>\r\n<div style=\"float:left;padding-top:10px;\" mce_style=\"display:inline;\">\r\n<p style=\"float:left;margin-right:5px;\" mce_style=\"float:left;\"><img src=\"templates/vtpl_template/images/competency.jpg\" mce_src=\"templates/vtpl_template/images/competency.jpg\"></p>\r\n<ul style=\"line-height: 26px;font-size:13px;float:left;padding-left:30px;\" mce_style=\"padding-left:30px;\">\r\n    <li>Ceramic Pumps</li>\r\n    <li>Magnetic Drive Pumps</li>\r\n    <li>Metal Bellow Mechanical Seals</li>\r\n    <li>Valves</li>\r\n</ul>\r\n</div>','',1,0,0,0,'2013-04-05 08:45:56',62,'','2013-06-02 10:48:59',62,0,'0000-00-00 00:00:00','2013-04-05 08:45:56','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',5,0,9,'','',0,123,'robots=\nauthor='),(9,'Products','products','','<div id=\"products-section\">\r\n<p class=\"blocktitle\">Products</p>\r\n  <div class=\"products\">\r\n    <div class=\"product-section\">\r\n    <p class=\"grey-title\">Pumps</p>\r\n    <p class=\"bodycopy\">\r\n      The \r\n                basic use of a pump is to transport the fluid from one point to \r\n                its final destination \"SANDO\" has engendered the technology \r\n                of Pump Manufacturing for highly corrosive, hazardous and environmentally \r\n                dangerous fluids The types of Pumps developed by Sando are as \r\n                follows:\r\n    </p>\r\n\r\n    <ul class=\"bodycopy\" style=\"padding-left:30px;font-size:14px;\" mce_style=\"padding-left:30px;cursor:pointer;font-size:14px;\">\r\n     <li><a href=\"index.php?option=com_content&amp;view=article&amp;id=1&amp;Itemid=14\" mce_href=\"index.php?option=com_content&amp;view=article&amp;id=1&amp;Itemid=14\">Magnetic Drive Sealless Pumps</a><br mce_bogus=\"1\"></li>\r\n    <li><a href=\"index.php?option=com_content&amp;view=article&amp;id=10&amp;Itemid=15\" mce_href=\"index.php?option=com_content&amp;view=article&amp;id=10&amp;Itemid=15\">PP/PVDF pumps</a><br mce_bogus=\"1\"></li>\r\n\r\n    <li><a href=\"index.php?option=com_content&amp;view=article&amp;id=11&amp;Itemid=16\" mce_href=\"index.php?option=com_content&amp;view=article&amp;id=11&amp;Itemid=16\">Ceramic / Graphite pumps</a><br mce_bogus=\"1\"></li>\r\n\r\n    <li><a href=\"index.php?option=com_content&amp;view=article&amp;id=17&amp;Itemid=18\" mce_href=\"#\">Chemical Process Pumps</a><br mce_bogus=\"1\"></li>\r\n    <li><a href=\"index.php?option=com_content&amp;view=article&amp;id=12&amp;Itemid=19\" mce_href=\"index.php?option=com_content&amp;view=article&amp;id=12&amp;Itemid=19\">Screw Pumps</a><br mce_bogus=\"1\"></li>\r\n    <li><a target=\"_blank\" href=\"templates/vtpl_template/images/pdf/Sando_Gear_Pump_Catalogue_SS_Series.pdf\" mce_href=\"templates/vtpl_template/images/pdf/Sando_Gear_Pump_Catalogue_SS_Series.pdf\">Gear Pumps</a><br mce_bogus=\"1\"></li>\r\n    <li><a href=\"index.php?option=com_content&amp;view=article&amp;id=13&amp;Itemid=20\" mce_href=\"index.php?option=com_content&amp;view=article&amp;id=13&amp;Itemid=20\">Drum / Barrel Pumps</a><br mce_bogus=\"1\"></li>\r\n</ul>\r\n</div>\r\n  </div>\r\n  <div class=\"products\">\r\n<div class=\"product-section\">\r\n    <p class=\"grey-title\">\r\n      Mechanical \r\n                Seals</p>\r\n               <p class=\"bodycopy\">Mechanical \r\n                Seals afre the heart of rotationg Equipments such as pumps, compressors, \r\n                agitators &amp; Mixers as they have the basic function of sealing \r\n                the valuable fluids or gases which cannot be allowed to leak \r\n                The types of Magnetic Seals developed by Sando are as follows:\r\n    </p>\r\n    <ul class=\"bodycopy\">\r\n<!--<li><a href=\"#\" mce_href=\"#\">Pump &amp; Compressor Seals</a><br mce_bogus=\"1\"></li> -->\r\n<li><a href=\"index.php?option=com_content&amp;view=article&amp;id=14&amp;Itemid=22\" mce_href=\"index.php?option=com_content&amp;view=article&amp;id=14&amp;Itemid=22\">Agitator &amp; Mixer Seals</a><br mce_bogus=\"1\"></li>\r\n<li><a href=\"templates/vtpl_template/images/pdf/676_Vibration_Damping_Lugs.jpg\" mce_href=\"templates/vtpl_template/images/pdf/676_Vibration_Damping_Lugs.jpg\" target=\"_blank\">Metal Bellow Seals</a><br mce_bogus=\"1\"></li>\r\n<li><a target=\"_blank\" href=\"http://sandogroup.com/templates/vtpl_template/images/pdf/Seal_Support_Systems.pdf\" mce_href=\"#\">Seal Support Systems</a><br mce_bogus=\"1\"></li>\r\n</ul>\r\n</div>\r\n  </div>\r\n  <div class=\"products\">\r\n<div class=\"product-section\">\r\n    <p class=\"grey-title\">Valves</p>\r\n\r\n    <p class=\"bodycopy\">\r\n      Valves \r\n                control &amp; direct the flow of fluids Since valves too find \r\n                application in corrosive environment, these have to be made of \r\n                the material which can withstand corrosion as well as high temperatures \r\n                \"SANDO\" in this field too has developed special materials \r\n                for valves to take care of corrosive and hazardous fluids which \r\n                are difficult to control The types of Valves manufactured by \r\n                SANDO are as follows:\r\n    </p>\r\n    <div style=\"float:left;margin-right:25px;margin-top:8px;\" mce_style=\"float:left;\">\r\n      <p class=\"bodycopy\" style=\"font-weight:bold;\" mce_style=\"font-weight:bold;\">Non-Metallic Valves</p>\r\n     <ul class=\"bodycopy\">\r\n    <li><a href=\"index.php?option=com_content&amp;view=article&amp;id=18&amp;Itemid=25\" mce_href=\"\">Ball Valves</a><br mce_bogus=\"1\"></li>\r\n    <li><a target=\"_blank\" href=\"templates/vtpl_template/images/pdf/PFA_and_FEP_Lined_Diaphragm_Valve.pdf\" mce_href=\"#\">Diaphragm Valves</a><br mce_bogus=\"1\"></li>\r\n    <li><a href=\"index.php?option=com_content&amp;view=article&amp;id=19&amp;Itemid=27\" mce_href=\"#\">Butterfly Valves</a><br mce_bogus=\"1\"></li>\r\n    <li><a target=\"_blank\" href=\"index.php?option=com_content&amp;view=article&amp;id=20&amp;Itemid=28\" mce_href=\"#\">Non-return Valves</a><br mce_bogus=\"1\"></li>\r\n    <li><a href=\"#\" mce_href=\"#\">Foot Valves</a><br mce_bogus=\"1\"></li>\r\n    <li><a href=\"http://sandogroup.com/templates/vtpl_template/images/pdf/Sight_Glass_Details.jpg\" mce_href=\"#\">Sight Glass</a><br mce_bogus=\"1\"></li>\r\n    </ul>\r\n</div>\r\n    </div>\r\n\r\n    \r\n\r\n  </div>\r\n</div>','',1,0,0,0,'2013-04-06 05:39:44',62,'','2013-06-02 10:37:03',62,0,'0000-00-00 00:00:00','2013-04-06 05:39:44','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',36,0,8,'','',0,314,'robots=\nauthor='),(14,'Magnetic Drive Agitators and Mixers','magnetic-drive-agitators-and-mixers','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">Magnetic Drive Agitator and Mixers </p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\">Product Overview</p>\r\n<p class=\"bodycopy\">\r\n‘Sando’ has extended concept of Magnetic Drive to Pressure Vessels, Reactors and Auto Claves. Hydrogenation reaction which is very dangerous and explosive has been made very safe by introducing Magnetic Drive Agitators for such application. <b>Today about hundreds of hydrogenation reactors are equipped with ‘Sando’ Drives</b>. Complete pre-assembled laboratory reactors with control and instrumentation are available in 10, 20, 30, 40 and 50 Litre capacities. If only Drives are required then ‘Sando’ has supplied for 40,000 Litres capacity for fermentation reaction.</p>\r\n</div>\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\" style=\"margin-top:10px;\" mce_style=\"margin-top:10px;\">Catalogues</p>\r\n\r\n<ul class=\"bodycopy\">\r\n	<li><a href=\"templates/vtpl_template/images/pdf/Magnetic_Drive_Agitators_&amp;_Mixers.pdf\" mce_href=\"templates/vtpl_template/pdf/Magnetic_Drive_Agitators_&amp;_Mixers.pdf\" target=\"_blank\">Magnetic Drive Agitator and Mixers</a><br mce_bogus=\"1\"></li>\r\n	\r\n</ul>\r\n</div>\r\n</div>\r\n<div mce_style=\"margin-left:10px;\" style=\"margin-left:10px;\" id=\"contactus\">\r\n<form onsubmit=\"return false;\" id=\"right-cta\" name=\"right-cta\">\r\n    <p style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\" class=\"blocktitle\">Request an Instant Callback!</p>\r\n    <input name=\"Name\" value=\"Name\" class=\"required name default-value\" type=\"text\">\r\n    <input name=\"Mobile\" value=\"Mobile\" class=\"required number default-value\" type=\"text\">\r\n        <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n\r\n    <input value=\"SUBMIT\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" class=\"bttnstyle\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input value=\"basic\" name=\"view\" type=\"hidden\">\r\n    <input value=\"callback\" name=\"task\" type=\"hidden\">\r\n    <input value=\"com_vprospectgen\" name=\"option\" type=\"hidden\">\r\n    <input value=\"\" name=\"Itemid\" type=\"hidden\">\r\n    <input value=\"raw\" name=\"format\" type=\"hidden\">\r\n    <input value=\"component\" name=\"tmpl\" type=\"hidden\">\r\n</form>\r\n</div>','',1,0,0,0,'2013-04-22 06:55:04',62,'','2013-06-02 10:35:09',62,0,'0000-00-00 00:00:00','2013-04-22 06:55:04','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',6,0,6,'','',0,80,'robots=\nauthor='),(15,'PFA / FEP Lined Valves','pfa-fep-lined-valves','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">PFA / FEP Lined Valves</p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<p class=\"grey-title\">Product Overview</p>\r\n<p class=\"bodycopy\">\r\nPFA / FEP is an extended family of Teflon which is chemically inert for most of the Chemicals, Acids, Solvents and Alkalies. ‘Sando’ has put this material to better use by offering valves which are lined with PFA / FEP material. The unique features of this material is Non – Stick properties thus, it eliminates or minimizes the built up of deposits of the product which otherwise reduces the flow through the valves. PFA can be used upto 265 Degree Celsius and FEP upto 200 Degree Celsius on continuous service temperature basis.\r\n</p>\r\n\r\n<p class=\"grey-title\" style=\"margin-top:10px;\" mce_style=\"margin-top:10px;\">Catalogues</p>\r\n\r\n<ul class=\"bodycopy\">\r\n	<li><a href=\"templates/vtpl_template/images/pdf/PFA_&amp;_FEP_Lined_Valves.pdf\" mce_href=\"templates/vtpl_template/pdf/PFA_&amp;_FEP_Lined_Valves.pdf\" target=\"_blank\">PFA / FEP Lined Valves Catalogue</a><br mce_bogus=\"1\"></li>\r\n	\r\n</ul>\r\n\r\n</div>\r\n<div mce_style=\"margin-left:10px;\" style=\"margin-left:10px;\" id=\"contactus\">\r\n<form onsubmit=\"return false;\" id=\"right-cta\" name=\"right-cta\">\r\n    <p style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\" class=\"blocktitle\">Request an Instant Callback!</p>\r\n    <input name=\"Name\" value=\"Name\" class=\"required name default-value\" type=\"text\">\r\n    <input name=\"Mobile\" value=\"Mobile\" class=\"required number default-value\" type=\"text\">\r\n        <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n\r\n    <input value=\"SUBMIT\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" class=\"bttnstyle\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input value=\"basic\" name=\"view\" type=\"hidden\">\r\n    <input value=\"callback\" name=\"task\" type=\"hidden\">\r\n    <input value=\"com_vprospectgen\" name=\"option\" type=\"hidden\">\r\n    <input value=\"\" name=\"Itemid\" type=\"hidden\">\r\n    <input value=\"raw\" name=\"format\" type=\"hidden\">\r\n    <input value=\"component\" name=\"tmpl\" type=\"hidden\">\r\n</form>\r\n</div>','',1,0,0,0,'2013-04-22 07:07:01',62,'','2013-04-22 13:57:03',62,0,'0000-00-00 00:00:00','2013-04-22 07:07:01','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',3,0,5,'','',0,42,'robots=\nauthor='),(16,'PP / PVDF Valves','pp-pvdf-valves','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">PP / PVDF Valves</p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<p class=\"grey-title\">Product Overview</p>\r\n<p class=\"bodycopy\">\r\nThe first Indian company  which has been awarded the patent rights having unique design of PVDF lining over Polypropylene (PP) base material which has given the advantage of PVDF at the cost of PP. These valves have been replaced by costly solid PVDF valves not only in India but also worldwide. These valves have been well accepted in Europe, South East Asia and West Asia. Another feature of ‘Sando’ valves are metal insert injection moulding to avoid distortion / bending of valve flanges during pipeline tightening.\r\n</p>\r\n\r\n<p class=\"grey-title\" style=\"margin-top:10px;\" mce_style=\"margin-top:10px;\">Catalogues</p>\r\n\r\n<ul class=\"bodycopy\">\r\n	<li><a href=\"templates/vtpl_template/images/pdf/PP_PVDF_Valves_Catalogue.pdf\" mce_href=\"templates/vtpl_template/pdf/PP_PVDF_Valves_Catalogue.pdf\" target=\"_blank\">PP / PVDF Valves Valves Catalogue</a><br mce_bogus=\"1\"></li>\r\n	\r\n</ul>\r\n\r\n</div>\r\n<div mce_style=\"margin-left:10px;\" style=\"margin-left:10px;\" id=\"contactus\">\r\n<form onsubmit=\"return false;\" id=\"right-cta\" name=\"right-cta\">\r\n    <p style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\" class=\"blocktitle\">Request an Instant Callback!</p>\r\n    <input name=\"Name\" value=\"Name\" class=\"required name default-value\" type=\"text\">\r\n    <input name=\"Mobile\" value=\"Mobile\" class=\"required number default-value\" type=\"text\">\r\n        <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n\r\n    <input value=\"SUBMIT\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" class=\"bttnstyle\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input value=\"basic\" name=\"view\" type=\"hidden\">\r\n    <input value=\"callback\" name=\"task\" type=\"hidden\">\r\n    <input value=\"com_vprospectgen\" name=\"option\" type=\"hidden\">\r\n    <input value=\"\" name=\"Itemid\" type=\"hidden\">\r\n    <input value=\"raw\" name=\"format\" type=\"hidden\">\r\n    <input value=\"component\" name=\"tmpl\" type=\"hidden\">\r\n</form>\r\n</div>','',1,0,0,0,'2013-04-22 07:07:55',62,'','2013-04-22 13:57:17',62,0,'0000-00-00 00:00:00','2013-04-22 07:07:55','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',3,0,4,'','',0,56,'robots=\nauthor='),(17,'Chemical Process Pumps','chemical-process-pumps','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">Chemical Process Pump</p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\">Product Overview</p>\r\n<p class=\"bodycopy\">\r\nThese are Horizontal Centrifugal Back Pull-Out Designs as per ISO, DIN and API Standards. To complete the range of Metallic Pumps Sando is also manufacturing Vertical Submersible Pumps, Multi Stage Boiler feed water pumps. So far in India there is monopoly of few Multi National Companies offering high temperature Thermic fluid pumps which were fitted with Metal Bellow Seals which is prone to frequent failures. <b>Sando is the 1st Indian Company to manufacture in-house pumps for Thermic fluid upto 400 Degree Celsius without using Metal Bellow Seals.</b> These pumps are available Water Cooled as well as Air Cooled designs. These pumps are in direct replacement of German Pumps but at an Indian Price \r\n</p>\r\n</div>\r\n<div class=\"product-section\">\r\n<p class=\"grey-title\" style=\"margin-top:10px;\" mce_style=\"margin-top:10px;\">Catalogues</p>\r\n\r\n<ul class=\"bodycopy\">\r\n	<li><a href=\"templates/vtpl_template/images/pdf/Metallic_Pump_Catalogue.pdf\" mce_href=\"templates/vtpl_template/images/pdf/Metallic_Pump_Catalogue.pdf\" target=\"_blank\">Chemical Process Pump</a><br mce_bogus=\"1\"></li>\r\n	\r\n</ul>\r\n</div>\r\n</div>\r\n<div mce_style=\"margin-left:10px;\" style=\"margin-left:10px;\" id=\"contactus\">\r\n<form onsubmit=\"return false;\" id=\"right-cta\" name=\"right-cta\">\r\n    <p style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\" class=\"blocktitle\">Request an Instant Callback!</p>\r\n    <input name=\"Name\" value=\"Name\" class=\"required name default-value\" type=\"text\">\r\n    <input name=\"Mobile\" value=\"Mobile\" class=\"required number default-value\" type=\"text\">\r\n    <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n\r\n    <input value=\"SUBMIT\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" class=\"bttnstyle\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input value=\"basic\" name=\"view\" type=\"hidden\">\r\n    <input value=\"callback\" name=\"task\" type=\"hidden\">\r\n    <input value=\"com_vprospectgen\" name=\"option\" type=\"hidden\">\r\n    <input value=\"\" name=\"Itemid\" type=\"hidden\">\r\n    <input value=\"raw\" name=\"format\" type=\"hidden\">\r\n    <input value=\"component\" name=\"tmpl\" type=\"hidden\">\r\n</form>\r\n</div>','',1,1,0,1,'2013-04-22 09:49:23',62,'','2013-06-02 10:27:28',62,0,'0000-00-00 00:00:00','2013-04-22 09:49:23','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',6,0,1,'','',0,125,'robots=\nauthor='),(18,'Ball Valves','ball-valves','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">Ball Valves</p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<div class=\"product-section\">\r\n<p class=\"bodycopy\">\r\nBelow are two different type of Ball Valves produced by Sandro:\r\n</p>\r\n\r\n<ul class=\"bodycopy\">\r\n	<li><a href=\"templates/vtpl_template/images/pdf/PFA_&amp;_FEP_Lined_Ball_Valve.pdf\" mce_href=\"templates/vtpl_template/images/pdf/PFA_&amp;_FEP_Lined_Ball_Valve.pdf\" target=\"_blank\">PFA and FEP Lined Ball Valves</a><br mce_bogus=\"1\"></li>\r\n  <li><a href=\"templates/vtpl_template/images/pdf/PFA_and_FEP_Lined_Ball_Check_Valves .pdf\" mce_href=\"templates/vtpl_template/images/pdf/PFA_and_FEP_Lined_Ball_Check_Valves.pdf\" target=\"_blank\">PFA and FEP Lined Ball Check Valves</a><br mce_bogus=\"1\"></li>\r\n	\r\n</ul>\r\n</div>\r\n</div>\r\n<div mce_style=\"margin-left:10px;\" style=\"margin-left:10px;\" id=\"contactus\">\r\n<form onsubmit=\"return false;\" id=\"right-cta\" name=\"right-cta\">\r\n    <p style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\" class=\"blocktitle\">Request an Instant Callback!</p>\r\n    <input name=\"Name\" value=\"Name\" class=\"required name default-value\" type=\"text\">\r\n    <input name=\"Mobile\" value=\"Mobile\" class=\"required number default-value\" type=\"text\">\r\n        <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n\r\n    <input value=\"SUBMIT\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" class=\"bttnstyle\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input value=\"basic\" name=\"view\" type=\"hidden\">\r\n    <input value=\"callback\" name=\"task\" type=\"hidden\">\r\n    <input value=\"com_vprospectgen\" name=\"option\" type=\"hidden\">\r\n    <input value=\"\" name=\"Itemid\" type=\"hidden\">\r\n    <input value=\"raw\" name=\"format\" type=\"hidden\">\r\n    <input value=\"component\" name=\"tmpl\" type=\"hidden\">\r\n</form>\r\n</div>','',1,0,0,0,'2013-04-22 12:03:47',62,'','2013-06-02 10:33:04',62,0,'0000-00-00 00:00:00','2013-04-22 12:03:47','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',5,0,3,'','',0,106,'robots=\nauthor='),(19,'Butterfly Valve','butterfly-valve','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">Butterfly Valves</p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<div class=\"product-section\">\r\n<p class=\"bodycopy\">\r\nBelow are two different type of Butterfly Valves produced by Sandro:\r\n</p>\r\n\r\n<ul class=\"bodycopy\">\r\n	<li><a href=\"templates/vtpl_template/images/pdf/PFA_and_FEP_lined_Butterfly_Valve_Gear_Operated.pdf\" mce_href=\"templates/vtpl_template/images/pdf/PFA_and_FEP_lined_Butterfly_Valve_Gear_Operated.pdf\" target=\"_blank\">Gear Operated Butterfly Valve</a><br mce_bogus=\"1\"></li>\r\n  <li><a href=\"templates/vtpl_template/images/pdf/PFA_and_FEP_lined_Butterfly_Valve_Lever_Operated.pdf\" mce_href=\"templates/vtpl_template/images/pdf/PFA_and_FEP_lined_Butterfly_Valve_Lever_Operated.pdf\" target=\"_blank\">Lever Operated Butterfly Valve</a><br mce_bogus=\"1\"></li>\r\n	\r\n</ul>\r\n</div>\r\n</div>\r\n<div mce_style=\"margin-left:10px;\" style=\"margin-left:10px;\" id=\"contactus\">\r\n<form onsubmit=\"return false;\" id=\"right-cta\" name=\"right-cta\">\r\n    <p style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\" class=\"blocktitle\">Request an Instant Callback!</p>\r\n    <input name=\"Name\" value=\"Name\" class=\"required name default-value\" type=\"text\">\r\n    <input name=\"Mobile\" value=\"Mobile\" class=\"required number default-value\" type=\"text\">\r\n        <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n\r\n    <input value=\"SUBMIT\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" class=\"bttnstyle\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input value=\"basic\" name=\"view\" type=\"hidden\">\r\n    <input value=\"callback\" name=\"task\" type=\"hidden\">\r\n    <input value=\"com_vprospectgen\" name=\"option\" type=\"hidden\">\r\n    <input value=\"\" name=\"Itemid\" type=\"hidden\">\r\n    <input value=\"raw\" name=\"format\" type=\"hidden\">\r\n    <input value=\"component\" name=\"tmpl\" type=\"hidden\">\r\n</form>\r\n</div>','',1,0,0,0,'2013-04-22 12:33:00',62,'','2013-06-02 10:33:50',62,0,'0000-00-00 00:00:00','2013-04-22 12:33:00','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',3,0,2,'','',0,92,'robots=\nauthor='),(20,'Non-return Valves','non-return-valves','','<p class=\"blocktitle\" style=\"font-size:26px;\" mce_style=\"font-size:26px;\">Non-return Valves</p>\r\n\r\n<div class=\"article-content\" style=\"float:left;width:780px;margin-right:10px;\">\r\n<div class=\"product-section\">\r\n<p class=\"bodycopy\">\r\nBelow are two different type of Non-return Valves produced by Sando:\r\n</p>\r\n\r\n<ul class=\"bodycopy\">\r\n<li><a href=\"templates/vtpl_template/images/pdf/B_C_V_P_V_D_F.jpg\" mce_href=\"templates/vtpl_template/images/pdf/B_C_V_P_V_D_F.jpg\" target=\"_blank\">P.V.D.F. Non-return Valves</a><br mce_bogus=\"1\"></li>\r\n  <li><a href=\"templates/vtpl_template/images/pdf/B_C.jpg\" mce_href=\"templates/vtpl_template/images/pdf/B_C.jpg\" target=\"_blank\">Isotactic PP Non-return Valves</a><br mce_bogus=\"1\"></li>\r\n	\r\n</ul>\r\n</div>\r\n</div>\r\n<div mce_style=\"margin-left:10px;\" style=\"margin-left:10px;\" id=\"contactus\">\r\n<form onsubmit=\"return false;\" id=\"right-cta\" name=\"right-cta\">\r\n    <p style=\"left: 4px;position: relative; font-size:13px;font-weight:bold;\" class=\"blocktitle\">Request an Instant Callback!</p>\r\n    <input name=\"Name\" value=\"Name\" class=\"required name default-value\" type=\"text\">\r\n    <input name=\"Mobile\" value=\"Mobile\" class=\"required number default-value\" type=\"text\">\r\n        <input name=\"EmailID\" value=\"E-Mail\" class=\"email default-value\" type=\"text\">\r\n\r\n    <input value=\"SUBMIT\" onclick=\"javascript:formSubmit(\'right-cta\', \'response-text\');\" class=\"bttnstyle\" type=\"submit\">\r\n    <p id=\"response-text\"><br /></p>\r\n\r\n    \r\n    <input value=\"basic\" name=\"view\" type=\"hidden\">\r\n    <input value=\"callback\" name=\"task\" type=\"hidden\">\r\n    <input value=\"com_vprospectgen\" name=\"option\" type=\"hidden\">\r\n    <input value=\"\" name=\"Itemid\" type=\"hidden\">\r\n    <input value=\"raw\" name=\"format\" type=\"hidden\">\r\n    <input value=\"component\" name=\"tmpl\" type=\"hidden\">\r\n</form>\r\n</div>','',1,0,0,0,'2013-05-07 11:22:30',62,'','2013-06-02 10:34:28',62,0,'0000-00-00 00:00:00','2013-05-07 11:22:30','0000-00-00 00:00:00','','','show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=',2,0,1,'','',0,55,'robots=\nauthor=');

/*Table structure for table `jos_content_frontpage` */

DROP TABLE IF EXISTS `jos_content_frontpage`;

CREATE TABLE `jos_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_content_frontpage` */

/*Table structure for table `jos_content_rating` */

DROP TABLE IF EXISTS `jos_content_rating`;

CREATE TABLE `jos_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(11) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(11) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_content_rating` */

/*Table structure for table `jos_core_acl_aro` */

DROP TABLE IF EXISTS `jos_core_acl_aro`;

CREATE TABLE `jos_core_acl_aro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_value` varchar(240) NOT NULL DEFAULT '0',
  `value` varchar(240) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_section_value_value_aro` (`section_value`(100),`value`(100)),
  KEY `jos_gacl_hidden_aro` (`hidden`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `jos_core_acl_aro` */

insert  into `jos_core_acl_aro`(`id`,`section_value`,`value`,`order_value`,`name`,`hidden`) values (10,'users','62',0,'Administrator',0);

/*Table structure for table `jos_core_acl_aro_groups` */

DROP TABLE IF EXISTS `jos_core_acl_aro_groups`;

CREATE TABLE `jos_core_acl_aro_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `jos_gacl_parent_id_aro_groups` (`parent_id`),
  KEY `jos_gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `jos_core_acl_aro_groups` */

insert  into `jos_core_acl_aro_groups`(`id`,`parent_id`,`name`,`lft`,`rgt`,`value`) values (17,0,'ROOT',1,22,'ROOT'),(28,17,'USERS',2,21,'USERS'),(29,28,'Public Frontend',3,12,'Public Frontend'),(18,29,'Registered',4,11,'Registered'),(19,18,'Author',5,10,'Author'),(20,19,'Editor',6,9,'Editor'),(21,20,'Publisher',7,8,'Publisher'),(30,28,'Public Backend',13,20,'Public Backend'),(23,30,'Manager',14,19,'Manager'),(24,23,'Administrator',15,18,'Administrator'),(25,24,'Super Administrator',16,17,'Super Administrator');

/*Table structure for table `jos_core_acl_aro_map` */

DROP TABLE IF EXISTS `jos_core_acl_aro_map`;

CREATE TABLE `jos_core_acl_aro_map` (
  `acl_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(230) NOT NULL DEFAULT '0',
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_core_acl_aro_map` */

/*Table structure for table `jos_core_acl_aro_sections` */

DROP TABLE IF EXISTS `jos_core_acl_aro_sections`;

CREATE TABLE `jos_core_acl_aro_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(230) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(230) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `jos_gacl_value_aro_sections` (`value`),
  KEY `jos_gacl_hidden_aro_sections` (`hidden`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `jos_core_acl_aro_sections` */

insert  into `jos_core_acl_aro_sections`(`id`,`value`,`order_value`,`name`,`hidden`) values (10,'users',1,'Users',0);

/*Table structure for table `jos_core_acl_groups_aro_map` */

DROP TABLE IF EXISTS `jos_core_acl_groups_aro_map`;

CREATE TABLE `jos_core_acl_groups_aro_map` (
  `group_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(240) NOT NULL DEFAULT '',
  `aro_id` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `group_id_aro_id_groups_aro_map` (`group_id`,`section_value`,`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_core_acl_groups_aro_map` */

insert  into `jos_core_acl_groups_aro_map`(`group_id`,`section_value`,`aro_id`) values (25,'',10);

/*Table structure for table `jos_core_log_items` */

DROP TABLE IF EXISTS `jos_core_log_items`;

CREATE TABLE `jos_core_log_items` (
  `time_stamp` date NOT NULL DEFAULT '0000-00-00',
  `item_table` varchar(50) NOT NULL DEFAULT '',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_core_log_items` */

/*Table structure for table `jos_core_log_searches` */

DROP TABLE IF EXISTS `jos_core_log_searches`;

CREATE TABLE `jos_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_core_log_searches` */

/*Table structure for table `jos_groups` */

DROP TABLE IF EXISTS `jos_groups`;

CREATE TABLE `jos_groups` (
  `id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_groups` */

insert  into `jos_groups`(`id`,`name`) values (0,'Public'),(1,'Registered'),(2,'Special');

/*Table structure for table `jos_leads` */

DROP TABLE IF EXISTS `jos_leads`;

CREATE TABLE `jos_leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Mobile` varchar(100) DEFAULT NULL,
  `cdt` timestamp NULL DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `EmailID` varchar(100) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `leadpoint` varchar(100) DEFAULT NULL,
  `Campaign` varchar(50) DEFAULT NULL,
  `AdGroup` varchar(50) DEFAULT NULL,
  `Keyword` varchar(50) DEFAULT NULL,
  `MatchType` varchar(50) DEFAULT NULL,
  `Distribution` varchar(50) DEFAULT NULL,
  `AdID` varchar(50) DEFAULT NULL,
  `Placement` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `jos_leads` */

insert  into `jos_leads`(`id`,`Name`,`Mobile`,`cdt`,`url`,`EmailID`,`ip`,`leadpoint`,`Campaign`,`AdGroup`,`Keyword`,`MatchType`,`Distribution`,`AdID`,`Placement`) values (1,'Riken','9892495842','2013-05-15 14:47:25',NULL,'sandogroup@gmail.com','59.182.76.22','http://www.sandogroup.com/index.php?Name=Riken&Mobile=9892495842&EmailID=sandogroup%40gmail.com&view',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'test','1231231231','2013-05-15 14:50:38',NULL,'sunny@vitruviantech.com','182.72.43.70','http://www.sandogroup.com/index.php?Name=test&Mobile=1231231231&EmailID=sunny%40vitruviantech.com&vi',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'ppppp','1111011110','2013-05-15 14:54:28',NULL,'sunny@vitruviantech.com','182.72.43.70','http://www.sandogroup.com/index.php?Name=ppppp&Mobile=1111011110&EmailID=sunny%40vitruviantech.com&v',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'ppppp','1111011110','2013-05-15 14:55:06',NULL,'sunny@vitruviantech.com','182.72.43.70','http://www.sandogroup.com/index.php?Name=ppppp&Mobile=1111011110&EmailID=sunny%40vitruviantech.com&v',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'test003','1231231231','2013-05-15 15:44:15',NULL,'sunny@vitruviantech.com','182.72.43.70','http://www.sandogroup.com/index.php?Name=test003&Mobile=1231231231&EmailID=sunny%40vitruviantech.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'test56','1231231231','2013-06-02 07:28:05',NULL,'sunny@vitruviantech.com','127.0.0.1','http://localhost/joomla_development/sando/index.php?Name=test56&Mobile=1231231231&EmailID=sunny%40vi',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'testSun','1231231231','2013-06-02 09:16:26',NULL,'sunny@vitruviantech.com','127.0.0.1','http://localhost/joomla_development/sando/index.php?Name=testSun&Mobile=1231231231&EmailID=sunny%40v',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'tet','1231231231','2013-06-02 09:20:32',NULL,'Email','127.0.0.1','http://localhost/joomla_development/sando/index.php?Name=tet&Mobile=1231231231&EmailID=Email&option=',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `jos_menu` */

DROP TABLE IF EXISTS `jos_menu`;

CREATE TABLE `jos_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text,
  `type` varchar(50) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `componentid` int(11) unsigned NOT NULL DEFAULT '0',
  `sublevel` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL DEFAULT '0',
  `browserNav` tinyint(4) DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `utaccess` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `lft` int(11) unsigned NOT NULL DEFAULT '0',
  `rgt` int(11) unsigned NOT NULL DEFAULT '0',
  `home` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/*Data for the table `jos_menu` */

insert  into `jos_menu`(`id`,`menutype`,`name`,`alias`,`link`,`type`,`published`,`parent`,`componentid`,`sublevel`,`ordering`,`checked_out`,`checked_out_time`,`pollid`,`browserNav`,`access`,`utaccess`,`params`,`lft`,`rgt`,`home`) values (1,'mainmenu','Home','home','index.php?option=com_content&view=frontpage','component',1,0,20,0,1,0,'0000-00-00 00:00:00',0,0,0,3,'num_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=front\nmulti_column_order=1\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=Sando Rotary Equipments Pvt. Ltd.\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,1),(2,'mainmenu','About Us','about-us','index.php?option=com_content&view=article&id=2','component',1,0,20,0,2,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(3,'mainmenu','Products','products','index.php?option=com_content&view=article&id=9','component',1,0,20,0,3,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(4,'mainmenu','Core Competency','core-competency','index.php?option=com_content&view=article&id=8','component',1,0,20,0,4,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(5,'mainmenu','Quality Concerns','quality-concerns','index.php?option=com_content&view=article&id=7','component',1,0,20,0,5,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(6,'mainmenu','Customer Base','customer-base','index.php?option=com_content&view=article&id=6','component',1,0,20,0,6,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(7,'mainmenu','Contact Us','contact-us','index.php?option=com_ckforms&view=ckforms&id=1','component',1,0,34,0,7,0,'0000-00-00 00:00:00',0,0,0,0,'page_title=Contact Us\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(8,'Quicklinks','CERAMIC pumps','ceramic-pumps','#','url',0,0,0,0,7,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(9,'Quicklinks','GRAPHITE pumps','graphite-pumps','#','url',0,0,0,0,8,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(10,'Quicklinks','Teflon Pumps','teflon-pumps','#','url',0,0,0,0,3,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(11,'Quicklinks','PVCF pumps','pvcf-pumps','#','url',0,0,0,0,4,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(12,'Quicklinks','Magnetic Drive Sealless pumps','magnetic-drive-sealless-pumps','index.php?option=com_content&view=article&id=1','component',0,0,20,0,5,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(13,'Quicklinks','Chemical Process Pumps','chemical-process-pumps','#','url',0,0,0,0,6,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(14,'Footer-Pumps','Magnetic Drive Sealless Pumps','magnetic-drive-sealless-pumps','index.php?option=com_content&view=article&id=1','component',1,0,20,0,1,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(15,'Footer-Pumps','PP / PVDF Pumps','pp-pvdf-pumps','index.php?option=com_content&view=article&id=10','component',1,0,20,0,2,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(16,'Footer-Pumps','Ceramic / Graphite Pumps','ceramic-graphite-pumps','index.php?option=com_content&view=article&id=11','component',1,0,20,0,3,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(17,'Footer-Pumps','Teflon Pumps','teflon-pumps','#','url',0,0,0,0,4,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(18,'Footer-Pumps','Chemical Process Pumps','chemical-process-pumps','index.php?option=com_content&view=article&id=17','component',1,0,20,0,5,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(19,'Footer-Pumps','Screw Pumps','screw-pumps','index.php?option=com_content&view=article&id=12','component',1,0,20,0,6,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(20,'Footer-Pumps','Drum / Barrel Pumps','drum-barrel-pumps','index.php?option=com_content&view=article&id=13','component',1,0,20,0,8,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(21,'Footer-Seals','Pump & Compressor Seals','pump-a-compressor-seals','#','url',0,0,0,0,1,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(22,'Footer-Seals','Agitator & Mixer Seals','magnetic-drive-agitator-and-mixer-seals','index.php?option=com_content&view=article&id=14','component',1,0,20,0,2,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(23,'Footer-Seals','Metal Bellow Seals','metal-bellow-seals','http://sandogroup.com/templates/vtpl_template/images/pdf/676_Vibration_Damping_Lugs.jpg','url',1,0,0,0,3,0,'0000-00-00 00:00:00',0,1,0,0,'menu_image=-1\n\n',0,0,0),(24,'Footer-Seals','Seal Support Systems','seal-support-systems','http://sandogroup.com/templates/vtpl_template/images/pdf/Seal_Support_Systems.pdf','url',1,0,0,0,4,0,'0000-00-00 00:00:00',0,1,0,0,'menu_image=-1\n\n',0,0,0),(25,'Footer-Valves','Ball Valves','ball-valves','index.php?option=com_content&view=article&id=18','component',1,0,20,0,1,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(26,'Footer-Valves','Diaphragm Valves','diaphragm-valves','http://sandogroup.com/templates/vtpl_template/images/pdf/PFA_and_FEP_Lined_Diaphragm_Valve.pdf','url',1,0,0,0,2,0,'0000-00-00 00:00:00',0,1,0,0,'menu_image=-1\n\n',0,0,0),(27,'Footer-Valves','Butterfly Valves','butterfly-valves','index.php?option=com_content&view=article&id=19','component',1,0,20,0,3,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(28,'Footer-Valves','Non-return Valves','non-return-valves','index.php?option=com_content&view=article&id=20','component',1,0,20,0,4,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(29,'Footer-Valves','Foot Valves','foot-valves','#','url',1,0,0,0,5,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(30,'Footer-Other','Home','home','index.php','url',1,0,0,0,1,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(31,'Footer-Other','About Us','about-us','index.php?Itemid=2','menulink',1,0,0,0,2,0,'0000-00-00 00:00:00',0,0,0,0,'menu_item=2\n\n',0,0,0),(32,'Footer-Other','Products','products','index.php?Itemid=3','menulink',1,0,0,0,3,0,'0000-00-00 00:00:00',0,0,0,0,'menu_item=3\n\n',0,0,0),(33,'Footer-Other','Core Competency','core-competency','index.php?Itemid=4','menulink',1,0,0,0,4,0,'0000-00-00 00:00:00',0,0,0,0,'menu_item=4\n\n',0,0,0),(34,'Footer-Other','Quality Concerns','quality-concerns','index.php?Itemid=5','menulink',1,0,0,0,5,0,'0000-00-00 00:00:00',0,0,0,0,'menu_item=5\n\n',0,0,0),(35,'Footer-Other','Customer Base','customer-base','index.php?Itemid=6','menulink',1,0,0,0,6,0,'0000-00-00 00:00:00',0,0,0,0,'menu_item=6\n\n',0,0,0),(36,'Footer-Other','Contact Us','contact-us','index.php?Itemid=7','menulink',1,0,0,0,7,0,'0000-00-00 00:00:00',0,0,0,0,'menu_item=7\n\n',0,0,0),(37,'Footer-Valves','Non - Metallic Vavles','non-metallic-vavles','#','url',0,0,0,0,6,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(38,'Footer-Valves','Sight Glass','sight-glass','http://sandogroup.com/templates/vtpl_template/images/pdf/Sight_Glass_Details.jpg','url',1,0,0,0,7,0,'0000-00-00 00:00:00',0,1,0,0,'menu_image=-1\n\n',0,0,0),(39,'Quicklinks','Case Study','case-study','index.php?option=com_content&view=article&id=4','component',1,0,20,0,1,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(40,'Extras','Magnetic Drive Sealless pumps','magnetic-drive-sealless-pumps','index.php?option=com_content&view=article&id=1','component',-2,0,20,0,1,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(41,'Footer-Pumps','Gear Pumps','gear-pumps','http://sandogroup.com/templates/vtpl_template/images/pdf/Sando_Gear_Pump_Catalogue_SS_Series.pdf','url',1,0,0,0,7,0,'0000-00-00 00:00:00',0,1,0,0,'menu_image=-1\n\n',0,0,0),(42,'mainmenu','Magnetic Drive Sealless pumps','magnetic-drive-sealless-pumps','#','url',0,3,0,1,1,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(43,'mainmenu','PP / PVDF Pumps','pp-pvdf-pumps','#','url',0,3,0,1,2,0,'0000-00-00 00:00:00',0,0,0,0,'menu_image=-1\n\n',0,0,0),(44,'Extras','PP / PVDF Valves','pp-pvdf-valves','index.php?option=com_content&view=article&id=16','component',1,0,20,0,2,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(45,'Extras','PFA / FEP Lined Valves','pfa-fep-lined-valves','index.php?option=com_content&view=article&id=15','component',1,0,20,0,3,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0),(46,'Quicklinks','Our Products','products','index.php?option=com_content&view=article&id=9','component',1,0,20,0,2,0,'0000-00-00 00:00:00',0,0,0,0,'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n',0,0,0);

/*Table structure for table `jos_menu_types` */

DROP TABLE IF EXISTS `jos_menu_types`;

CREATE TABLE `jos_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `menutype` (`menutype`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `jos_menu_types` */

insert  into `jos_menu_types`(`id`,`menutype`,`title`,`description`) values (1,'mainmenu','Main Menu','The main menu for the site'),(2,'Quicklinks','Quicklinks','Quicklinks'),(3,'Footer-Pumps','Footer Pumps','Footer Pumps'),(4,'Footer-Seals','Footer Seals','Footer Seals'),(5,'Footer-Valves','Footer Valves','Footer Valves'),(6,'Footer-Other','Footer Other','Footer Other'),(7,'Extras','Extras','Extras');

/*Table structure for table `jos_messages` */

DROP TABLE IF EXISTS `jos_messages`;

CREATE TABLE `jos_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` int(11) NOT NULL DEFAULT '0',
  `priority` int(1) unsigned NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_messages` */

/*Table structure for table `jos_messages_cfg` */

DROP TABLE IF EXISTS `jos_messages_cfg`;

CREATE TABLE `jos_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_messages_cfg` */

/*Table structure for table `jos_migration_backlinks` */

DROP TABLE IF EXISTS `jos_migration_backlinks`;

CREATE TABLE `jos_migration_backlinks` (
  `itemid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `sefurl` text NOT NULL,
  `newurl` text NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_migration_backlinks` */

/*Table structure for table `jos_modules` */

DROP TABLE IF EXISTS `jos_modules`;

CREATE TABLE `jos_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) DEFAULT NULL,
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `numnews` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `control` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Data for the table `jos_modules` */

insert  into `jos_modules`(`id`,`title`,`content`,`ordering`,`position`,`checked_out`,`checked_out_time`,`published`,`module`,`numnews`,`access`,`showtitle`,`params`,`iscore`,`client_id`,`control`) values (1,'Main Menu','',0,'mainmenu',0,'0000-00-00 00:00:00',1,'mod_mainmenu',0,0,1,'menutype=mainmenu\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=1\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=_menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n',1,0,''),(2,'Login','',1,'login',0,'0000-00-00 00:00:00',1,'mod_login',0,0,1,'',1,1,''),(3,'Popular','',3,'cpanel',0,'0000-00-00 00:00:00',1,'mod_popular',0,2,1,'',0,1,''),(4,'Recent added Articles','',4,'cpanel',0,'0000-00-00 00:00:00',1,'mod_latest',0,2,1,'ordering=c_dsc\nuser_id=0\ncache=0\n\n',0,1,''),(5,'Menu Stats','',5,'cpanel',0,'0000-00-00 00:00:00',1,'mod_stats',0,2,1,'',0,1,''),(6,'Unread Messages','',1,'header',0,'0000-00-00 00:00:00',1,'mod_unread',0,2,1,'',1,1,''),(7,'Online Users','',2,'header',0,'0000-00-00 00:00:00',1,'mod_online',0,2,1,'',1,1,''),(8,'Toolbar','',1,'toolbar',0,'0000-00-00 00:00:00',1,'mod_toolbar',0,2,1,'',1,1,''),(9,'Quick Icons','',1,'icon',0,'0000-00-00 00:00:00',1,'mod_quickicon',0,2,1,'',1,1,''),(10,'Logged in Users','',2,'cpanel',0,'0000-00-00 00:00:00',1,'mod_logged',0,2,1,'',0,1,''),(11,'Footer','',0,'footer',0,'0000-00-00 00:00:00',1,'mod_footer',0,0,1,'',1,1,''),(12,'Admin Menu','',1,'menu',0,'0000-00-00 00:00:00',1,'mod_menu',0,2,1,'',0,1,''),(13,'Admin SubMenu','',1,'submenu',0,'0000-00-00 00:00:00',1,'mod_submenu',0,2,1,'',0,1,''),(14,'User Status','',1,'status',0,'0000-00-00 00:00:00',1,'mod_status',0,2,1,'',0,1,''),(15,'Title','',1,'title',0,'0000-00-00 00:00:00',1,'mod_title',0,2,1,'',0,1,''),(16,'Header Contact','<p style=\"background-image: url(templates/vtpl_template/images/phone.jpg); background-repeat: no-repeat; padding: 6px 0px 0px 30px; background-position: 2px 5px; height: 24px;\"><span>+91-22-28875456, +91-22-28870347</span></p>\r\n<p style=\"background-image: url(templates/vtpl_template/images/fax.jpg); background-repeat: no-repeat; padding: 6px 0px 0px 30px; background-position: 2px 6px; height: 24px;\"><span>+91-22-28841214</span></p>\r\n<p style=\"background-image: url(templates/vtpl_template/images/email.jpg); background-repeat: no-repeat; padding: 6px 0px 0px 30px; background-position: 2px 7px; height: 24px;\"><span>sandogroup@mtnl.net.in, sandogroup@gmail.com</span></p>',0,'headerrow1',0,'0000-00-00 00:00:00',1,'mod_custom',0,0,0,'moduleclass_sfx=\n\n',0,0,''),(17,'HeaderLogo','<div id=\"logo\">\r\n<p><a href=\"index.php\"><img src=\"templates/vtpl_template/images/logo.jpg\" border=\"0\" /></a></p>\r\n</div>',0,'logo',0,'0000-00-00 00:00:00',1,'mod_custom',0,0,0,'moduleclass_sfx=\n\n',0,0,''),(18,'Header ISO','<div id=\"iso-mark\">\r\n<p><img src=\"templates/vtpl_template/images/iso.jpg\" border=\"0\" /></p>\r\n</div>',0,'iso',0,'0000-00-00 00:00:00',1,'mod_custom',0,0,1,'moduleclass_sfx=\n\n',0,0,''),(19,'Header Social Media','<p><a><img src=\"templates/vtpl_template/images/in.jpg\" mce_src=\"templates/vtpl_template/images/in.jpg\" border=\"0\"></a><br mce_bogus=\"1\"></p>\r\n<p><a href=\"http://www.facebook.com/pages/Sando-Group/381009772008595\" mce_href=\"http://www.facebook.com/pages/Sando-Group/381009772008595\" target=\"_blank\"><img src=\"templates/vtpl_template/images/fb.jpg\" mce_src=\"templates/vtpl_template/images/fb.jpg\" border=\"0\"></a><br mce_bogus=\"1\"></p>',0,'socialmedialinks',0,'0000-00-00 00:00:00',1,'mod_custom',0,0,0,'moduleclass_sfx=\n\n',0,0,''),(20,'Featured Pumps','',0,'featuredpumps',0,'0000-00-00 00:00:00',1,'mod_featuredpumps',0,0,0,'',0,0,''),(21,'Homepage-AboutUs','<div id=\"aboutus-wrapper\">\r\n<div style=\"padding: 5px; float: left; width: 488px;\">\r\n<p class=\"blocktitle\">About us</p>\r\n<div id=\"aboutus-content\">\r\n<p class=\"aboutus-img\"><img src=\"templates/vtpl_template/images/about-us.png\" mce_src=\"templates/vtpl_template/images/about-us.png\" border=\"0\"></p>\r\n<p class=\"aboutus-desc\">Sando Rotary Equipments Pvt. Ltd. has been promoted by Two young technocrats having more than Twenty years of experience in the field of Rotary Equipments.\"Sando\" started the manufacturing of Mechanical Seal in the year 1982 and have the ultra modern manufacturing facilities. All the manufacturing operations are carried out in house including machine carbide, ceramic, carbon etc. A well laid down lapping and testing facilities are in place....</p>\r\n<br><a href=\"index.php?option=com_content&amp;view=article&amp;Itemid=2&amp;id=2\" mce_href=\"index.php?option=com_content&amp;view=article&amp;Itemid=2&amp;id=2\"><span>Read more</span> </a><br mce_bogus=\"1\"></div>\r\n</div>\r\n</div><!-- aboutus ends here -->',0,'homepageaboutus',0,'0000-00-00 00:00:00',1,'mod_custom',0,0,0,'moduleclass_sfx=\n\n',0,0,''),(22,'Quicklinks','',0,'quicklinks',0,'0000-00-00 00:00:00',1,'mod_mainmenu',0,0,0,'menutype=Quicklinks\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n',0,0,''),(23,'Testimonials','',0,'testimonials',0,'0000-00-00 00:00:00',1,'mod_testimonials',0,0,0,'',0,0,''),(24,'Download Profile','<div id=\"download\">\r\n<p><a target=\"_blank\" href=\"templates/vtpl_template/images/download_our_profile.pdf\" mce_href=\"templates/vtpl_template/images/download_our_profile.pdf\"><img src=\"templates/vtpl_template/images/download.jpg\" mce_src=\"templates/vtpl_template/images/download.jpg\" border=\"0\"></a><br mce_bogus=\"1\"></p>\r\n</div>',0,'downloadprofile',0,'0000-00-00 00:00:00',1,'mod_custom',0,0,0,'moduleclass_sfx=\n\n',0,0,''),(25,'Footer Pumps','',0,'footer1',0,'0000-00-00 00:00:00',1,'mod_mainmenu',0,0,0,'menutype=Footer-Pumps\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n',0,0,''),(26,'Footer Seals','',0,'footer2',0,'0000-00-00 00:00:00',1,'mod_mainmenu',0,0,0,'menutype=Footer-Seals\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n',0,0,''),(27,'Footer Valves','',0,'footer3',0,'0000-00-00 00:00:00',1,'mod_mainmenu',0,0,0,'menutype=Footer-Valves\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n',0,0,''),(28,'Footer Other','',0,'footer4',0,'0000-00-00 00:00:00',1,'mod_mainmenu',0,0,0,'menutype=Footer-Other\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n',0,0,''),(29,'SliderBanner','',0,'sliderbanner',0,'0000-00-00 00:00:00',1,'mod_sliderbanner',0,0,0,'',0,0,''),(30,'ContactUs-CTA','<div id=\"contactus\">\r\n<form id=\"contactus-cta\" name=\"contactus-cta\" onsubmit=\"return false;\">\r\n<p class=\"blocktitle\" style=\"left: 4px; position: relative;\">Contact Us</p>\r\n<input class=\"required name default-value\" name=\"Name\" value=\"Name\" type=\"text\"> <input class=\"required number default-value\" name=\"Mobile\" value=\"Mobile\" type=\"text\"> <input class=\"email default-value\" name=\"EmailID\" value=\"E-Mail\" type=\"text\"> <input onclick=\"javascript:formSubmit(\'contactus-cta\', \'response-text\');\" value=\"SUBMIT\" type=\"submit\">\r\n<p id=\"response-text\"><br></p>\r\n<input name=\"view\" value=\"basic\" type=\"hidden\"> <input name=\"task\" value=\"callback\" type=\"hidden\"> <input name=\"option\" value=\"com_vprospectgen\" type=\"hidden\"> <input name=\"Itemid\" type=\"hidden\"> <input name=\"format\" value=\"raw\" type=\"hidden\"> <input name=\"tmpl\" value=\"component\" type=\"hidden\"> </form></div>',0,'contactus',0,'0000-00-00 00:00:00',1,'mod_custom',0,0,0,'moduleclass_sfx=\n\n',0,0,''),(31,'Extras','',1,'left',0,'0000-00-00 00:00:00',0,'mod_mainmenu',0,0,1,'menutype=Extras',0,0,''),(32,'ClickToCall','',0,'clicktocall',0,'0000-00-00 00:00:00',1,'mod_clicktocall',0,0,0,'',0,0,''),(33,' CKforms Form Display','',2,'left',0,'0000-00-00 00:00:00',0,'mod_ckforms',0,0,1,'id=1\ndisplaytitle=1\nmoduleclass_sfx=\n\n',0,0,''),(34,'Contact Address','<div style=\"float: right;line-height: 28px;width: 480px;margin-left:10px;\">\r\n<p><img src=\"templates/vtpl_template/images/map-1.png\" mce_src=\"templates/vtpl_template/images/map.png\">\r\n              </p><p>The\r\n                Offices and Service Centres are located in each of the above region\r\n                to provide prompt and efficient services to our customers The\r\n                Contact Details are as below:</p>\r\n              <p><b>Head Office :</b> 5 &amp; 6, Radha Dalvi Nagar, CP Road, Kandivali(East), Mumbai-400101,\r\n                INDIA </p>\r\n              <p><b>Tel\r\n                Nos :</b>&nbsp;&nbsp; 0091-22-28875456, 0091-22-28870347<br>\r\n                <b>Fax :&nbsp;</b>0091-22-28841214<br>\r\n                <b>Email : </b><a href=\"mailto:sandogroup@mtnl.net.in\" mce_href=\"mailto:sandogroup@mtnl.net.in\">sandogroup@mtnl.net.in</a>,\r\n                <a href=\"mailto:sandogroup@gmail.com\" mce_href=\"mailto:sandogroup@gmail.com\">sandogroup@gmail.com<br>\r\n                </a><br mce_bogus=\"1\"></p>\r\n\r\n</div>',0,'contactaddress',0,'0000-00-00 00:00:00',1,'mod_custom',0,0,0,'moduleclass_sfx=\n\n',0,0,'');

/*Table structure for table `jos_modules_menu` */

DROP TABLE IF EXISTS `jos_modules_menu`;

CREATE TABLE `jos_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_modules_menu` */

insert  into `jos_modules_menu`(`moduleid`,`menuid`) values (1,0),(16,0),(17,0),(18,0),(19,0),(20,1),(21,1),(22,1),(23,1),(24,1),(25,0),(26,0),(27,0),(28,0),(29,1),(30,1),(30,30),(31,0),(32,0),(33,0),(34,0);

/*Table structure for table `jos_newsfeeds` */

DROP TABLE IF EXISTS `jos_newsfeeds`;

CREATE TABLE `jos_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text NOT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(11) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(11) unsigned NOT NULL DEFAULT '3600',
  `checked_out` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `published` (`published`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_newsfeeds` */

/*Table structure for table `jos_plugins` */

DROP TABLE IF EXISTS `jos_plugins`;

CREATE TABLE `jos_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `element` varchar(100) NOT NULL DEFAULT '',
  `folder` varchar(100) NOT NULL DEFAULT '',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(3) NOT NULL DEFAULT '0',
  `client_id` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `jos_plugins` */

insert  into `jos_plugins`(`id`,`name`,`element`,`folder`,`access`,`ordering`,`published`,`iscore`,`client_id`,`checked_out`,`checked_out_time`,`params`) values (1,'Authentication - Joomla','joomla','authentication',0,1,1,1,0,0,'0000-00-00 00:00:00',''),(2,'Authentication - LDAP','ldap','authentication',0,2,0,1,0,0,'0000-00-00 00:00:00','host=\nport=389\nuse_ldapV3=0\nnegotiate_tls=0\nno_referrals=0\nauth_method=bind\nbase_dn=\nsearch_string=\nusers_dn=\nusername=\npassword=\nldap_fullname=fullName\nldap_email=mail\nldap_uid=uid\n\n'),(3,'Authentication - GMail','gmail','authentication',0,4,0,0,0,0,'0000-00-00 00:00:00',''),(4,'Authentication - OpenID','openid','authentication',0,3,0,0,0,0,'0000-00-00 00:00:00',''),(5,'User - Joomla!','joomla','user',0,0,1,0,0,0,'0000-00-00 00:00:00','autoregister=1\n\n'),(6,'Search - Content','content','search',0,1,1,1,0,0,'0000-00-00 00:00:00','search_limit=50\nsearch_content=1\nsearch_uncategorised=1\nsearch_archived=1\n\n'),(7,'Search - Contacts','contacts','search',0,3,1,1,0,0,'0000-00-00 00:00:00','search_limit=50\n\n'),(8,'Search - Categories','categories','search',0,4,1,0,0,0,'0000-00-00 00:00:00','search_limit=50\n\n'),(9,'Search - Sections','sections','search',0,5,1,0,0,0,'0000-00-00 00:00:00','search_limit=50\n\n'),(10,'Search - Newsfeeds','newsfeeds','search',0,6,1,0,0,0,'0000-00-00 00:00:00','search_limit=50\n\n'),(11,'Search - Weblinks','weblinks','search',0,2,1,1,0,0,'0000-00-00 00:00:00','search_limit=50\n\n'),(12,'Content - Pagebreak','pagebreak','content',0,10000,1,1,0,0,'0000-00-00 00:00:00','enabled=1\ntitle=1\nmultipage_toc=1\nshowall=1\n\n'),(13,'Content - Rating','vote','content',0,4,1,1,0,0,'0000-00-00 00:00:00',''),(14,'Content - Email Cloaking','emailcloak','content',0,5,1,0,0,0,'0000-00-00 00:00:00','mode=1\n\n'),(15,'Content - Code Hightlighter (GeSHi)','geshi','content',0,5,0,0,0,0,'0000-00-00 00:00:00',''),(16,'Content - Load Module','loadmodule','content',0,6,1,0,0,0,'0000-00-00 00:00:00','enabled=1\nstyle=0\n\n'),(17,'Content - Page Navigation','pagenavigation','content',0,2,1,1,0,0,'0000-00-00 00:00:00','position=1\n\n'),(18,'Editor - No Editor','none','editors',0,0,1,1,0,0,'0000-00-00 00:00:00',''),(19,'Editor - TinyMCE','tinymce','editors',0,0,1,1,0,0,'0000-00-00 00:00:00','mode=advanced\nskin=0\ncompressed=0\ncleanup_startup=0\ncleanup_save=0\nentity_encoding=raw\nlang_mode=0\nlang_code=en\ntext_direction=ltr\ncontent_css=1\ncontent_css_custom=\nrelative_urls=1\nnewlines=0\ninvalid_elements=applet\nextended_elements=\ntoolbar=top\ntoolbar_align=left\nhtml_height=550\nhtml_width=750\nelement_path=1\nfonts=1\npaste=1\nsearchreplace=1\ninsertdate=1\nformat_date=%Y-%m-%d\ninserttime=1\nformat_time=%H:%M:%S\ncolors=1\ntable=1\nsmilies=1\nmedia=1\nhr=1\ndirectionality=1\nfullscreen=1\nstyle=1\nlayer=1\nxhtmlxtras=1\nvisualchars=1\nnonbreaking=1\nblockquote=1\ntemplate=0\nadvimage=1\nadvlink=1\nautosave=1\ncontextmenu=1\ninlinepopups=1\nsafari=1\ncustom_plugin=\ncustom_button=\n\n'),(20,'Editor - XStandard Lite 2.0','xstandard','editors',0,0,0,1,0,0,'0000-00-00 00:00:00',''),(21,'Editor Button - Image','image','editors-xtd',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(22,'Editor Button - Pagebreak','pagebreak','editors-xtd',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(23,'Editor Button - Readmore','readmore','editors-xtd',0,0,1,0,0,0,'0000-00-00 00:00:00',''),(24,'XML-RPC - Joomla','joomla','xmlrpc',0,7,0,1,0,0,'0000-00-00 00:00:00',''),(25,'XML-RPC - Blogger API','blogger','xmlrpc',0,7,0,1,0,0,'0000-00-00 00:00:00','catid=1\nsectionid=0\n\n'),(27,'System - SEF','sef','system',0,1,1,0,0,0,'0000-00-00 00:00:00',''),(28,'System - Debug','debug','system',0,2,1,0,0,0,'0000-00-00 00:00:00','queries=1\nmemory=1\nlangauge=1\n\n'),(29,'System - Legacy','legacy','system',0,3,0,1,0,0,'0000-00-00 00:00:00','route=0\n\n'),(30,'System - Cache','cache','system',0,4,0,1,0,0,'0000-00-00 00:00:00','browsercache=0\ncachetime=15\n\n'),(31,'System - Log','log','system',0,5,0,1,0,0,'0000-00-00 00:00:00',''),(32,'System - Remember Me','remember','system',0,6,1,1,0,0,'0000-00-00 00:00:00',''),(33,'System - Backlink','backlink','system',0,7,0,1,0,0,'0000-00-00 00:00:00',''),(34,'System - Mootools Upgrade','mtupgrade','system',0,8,0,1,0,0,'0000-00-00 00:00:00',''),(35,'System - SC jQuery','scjquery','system',0,0,1,0,0,0,'0000-00-00 00:00:00','enable_site=1\nenable_admin=0\nenable_ui=0\ntheme_ui=ui-lightness\ncode=\nexclude_menuitems=\nversion_jq=1.7.2\nversion_ui=1.8.1\n\n');

/*Table structure for table `jos_poll_data` */

DROP TABLE IF EXISTS `jos_poll_data`;

CREATE TABLE `jos_poll_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pollid` (`pollid`,`text`(1))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_poll_data` */

/*Table structure for table `jos_poll_date` */

DROP TABLE IF EXISTS `jos_poll_date`;

CREATE TABLE `jos_poll_date` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vote_id` int(11) NOT NULL DEFAULT '0',
  `poll_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_poll_date` */

/*Table structure for table `jos_poll_menu` */

DROP TABLE IF EXISTS `jos_poll_menu`;

CREATE TABLE `jos_poll_menu` (
  `pollid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pollid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_poll_menu` */

/*Table structure for table `jos_polls` */

DROP TABLE IF EXISTS `jos_polls`;

CREATE TABLE `jos_polls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `voters` int(9) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '0',
  `lag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_polls` */

/*Table structure for table `jos_sections` */

DROP TABLE IF EXISTS `jos_sections`;

CREATE TABLE `jos_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` text NOT NULL,
  `scope` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `jos_sections` */

insert  into `jos_sections`(`id`,`title`,`name`,`alias`,`image`,`scope`,`image_position`,`description`,`published`,`checked_out`,`checked_out_time`,`ordering`,`access`,`count`,`params`) values (1,'Pumps','','pumps','','content','left','',1,0,'0000-00-00 00:00:00',1,0,1,'');

/*Table structure for table `jos_session` */

DROP TABLE IF EXISTS `jos_session`;

CREATE TABLE `jos_session` (
  `username` varchar(150) DEFAULT '',
  `time` varchar(14) DEFAULT '',
  `session_id` varchar(200) NOT NULL DEFAULT '0',
  `guest` tinyint(4) DEFAULT '1',
  `userid` int(11) DEFAULT '0',
  `usertype` varchar(50) DEFAULT '',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `data` longtext,
  PRIMARY KEY (`session_id`(64)),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_session` */

insert  into `jos_session`(`username`,`time`,`session_id`,`guest`,`userid`,`usertype`,`gid`,`client_id`,`data`) values ('','1370172743','e7589f75b18cd96e4ce50ab266678654',1,0,'',0,0,'__default|a:7:{s:15:\"session.counter\";i:110;s:19:\"session.timer.start\";i:1370163162;s:18:\"session.timer.last\";i:1370172482;s:17:\"session.timer.now\";i:1370172743;s:22:\"session.client.browser\";s:65:\"Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0\";s:8:\"registry\";O:9:\"JRegistry\":3:{s:17:\"_defaultNameSpace\";s:7:\"session\";s:9:\"_registry\";a:1:{s:7:\"session\";a:1:{s:4:\"data\";O:8:\"stdClass\":0:{}}}s:7:\"_errors\";a:0:{}}s:4:\"user\";O:5:\"JUser\":19:{s:2:\"id\";i:0;s:4:\"name\";N;s:8:\"username\";N;s:5:\"email\";N;s:8:\"password\";N;s:14:\"password_clear\";s:0:\"\";s:8:\"usertype\";N;s:5:\"block\";N;s:9:\"sendEmail\";i:0;s:3:\"gid\";i:0;s:12:\"registerDate\";N;s:13:\"lastvisitDate\";N;s:10:\"activation\";N;s:6:\"params\";N;s:3:\"aid\";i:0;s:5:\"guest\";i:1;s:7:\"_params\";O:10:\"JParameter\":7:{s:4:\"_raw\";s:0:\"\";s:4:\"_xml\";N;s:9:\"_elements\";a:0:{}s:12:\"_elementPath\";a:1:{i:0;s:80:\"C:\\xampp\\htdocs\\joomla_development\\sando\\libraries\\joomla\\html\\parameter\\element\";}s:17:\"_defaultNameSpace\";s:8:\"_default\";s:9:\"_registry\";a:1:{s:8:\"_default\";a:1:{s:4:\"data\";O:8:\"stdClass\":0:{}}}s:7:\"_errors\";a:0:{}}s:9:\"_errorMsg\";N;s:7:\"_errors\";a:0:{}}}ck_send_once1|s:1:\"1\";ck_cache_page_1|s:32:\"2cbe6201647d19161d95e9eec95c7dcf\";securimage_code_value|s:4:\"t9zw\";'),('','1370169807','bad7adaf6c895b11f5c8421468be3f48',1,0,'',0,0,'__default|a:7:{s:15:\"session.counter\";i:6;s:19:\"session.timer.start\";i:1370169556;s:18:\"session.timer.last\";i:1370169799;s:17:\"session.timer.now\";i:1370169807;s:22:\"session.client.browser\";s:101:\"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.94 Safari/537.36\";s:8:\"registry\";O:9:\"JRegistry\":3:{s:17:\"_defaultNameSpace\";s:7:\"session\";s:9:\"_registry\";a:1:{s:7:\"session\";a:1:{s:4:\"data\";O:8:\"stdClass\":0:{}}}s:7:\"_errors\";a:0:{}}s:4:\"user\";O:5:\"JUser\":19:{s:2:\"id\";i:0;s:4:\"name\";N;s:8:\"username\";N;s:5:\"email\";N;s:8:\"password\";N;s:14:\"password_clear\";s:0:\"\";s:8:\"usertype\";N;s:5:\"block\";N;s:9:\"sendEmail\";i:0;s:3:\"gid\";i:0;s:12:\"registerDate\";N;s:13:\"lastvisitDate\";N;s:10:\"activation\";N;s:6:\"params\";N;s:3:\"aid\";i:0;s:5:\"guest\";i:1;s:7:\"_params\";O:10:\"JParameter\":7:{s:4:\"_raw\";s:0:\"\";s:4:\"_xml\";N;s:9:\"_elements\";a:0:{}s:12:\"_elementPath\";a:1:{i:0;s:80:\"C:\\xampp\\htdocs\\joomla_development\\sando\\libraries\\joomla\\html\\parameter\\element\";}s:17:\"_defaultNameSpace\";s:8:\"_default\";s:9:\"_registry\";a:1:{s:8:\"_default\";a:1:{s:4:\"data\";O:8:\"stdClass\":0:{}}}s:7:\"_errors\";a:0:{}}s:9:\"_errorMsg\";N;s:7:\"_errors\";a:0:{}}}'),('admin','1370170169','ed926cfc202024fcb72e4894a6b5392c',0,62,'Super Administrator',25,1,'__default|a:8:{s:15:\"session.counter\";i:74;s:19:\"session.timer.start\";i:1370163174;s:18:\"session.timer.last\";i:1370170167;s:17:\"session.timer.now\";i:1370170169;s:22:\"session.client.browser\";s:65:\"Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0\";s:13:\"session.token\";s:32:\"898a8f237a910c72bbd56b486e42375e\";s:8:\"registry\";O:9:\"JRegistry\":3:{s:17:\"_defaultNameSpace\";s:7:\"session\";s:9:\"_registry\";a:4:{s:7:\"session\";a:1:{s:4:\"data\";O:8:\"stdClass\":0:{}}s:11:\"application\";a:1:{s:4:\"data\";O:8:\"stdClass\":1:{s:4:\"lang\";s:0:\"\";}}s:10:\"com_cpanel\";a:1:{s:4:\"data\";O:8:\"stdClass\":1:{s:9:\"mtupgrade\";O:8:\"stdClass\":1:{s:7:\"checked\";b:1;}}}s:9:\"com_menus\";a:1:{s:4:\"data\";O:8:\"stdClass\":1:{s:8:\"menutype\";s:10:\"Quicklinks\";}}}s:7:\"_errors\";a:0:{}}s:4:\"user\";O:5:\"JUser\":19:{s:2:\"id\";s:2:\"62\";s:4:\"name\";s:13:\"Administrator\";s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:23:\"sunny@vitruviantech.com\";s:8:\"password\";s:65:\"dbee0be9319da24add10669d2e5fffe0:kaEvcHWPaZZPRhZ46KJM4m7sbuqPD7v2\";s:14:\"password_clear\";s:0:\"\";s:8:\"usertype\";s:19:\"Super Administrator\";s:5:\"block\";s:1:\"0\";s:9:\"sendEmail\";s:1:\"1\";s:3:\"gid\";s:2:\"25\";s:12:\"registerDate\";s:19:\"2013-04-01 10:47:23\";s:13:\"lastvisitDate\";s:19:\"2013-06-02 06:54:25\";s:10:\"activation\";s:0:\"\";s:6:\"params\";s:0:\"\";s:3:\"aid\";i:2;s:5:\"guest\";i:0;s:7:\"_params\";O:10:\"JParameter\":7:{s:4:\"_raw\";s:0:\"\";s:4:\"_xml\";N;s:9:\"_elements\";a:0:{}s:12:\"_elementPath\";a:1:{i:0;s:80:\"C:\\xampp\\htdocs\\joomla_development\\sando\\libraries\\joomla\\html\\parameter\\element\";}s:17:\"_defaultNameSpace\";s:8:\"_default\";s:9:\"_registry\";a:1:{s:8:\"_default\";a:1:{s:4:\"data\";O:8:\"stdClass\":0:{}}}s:7:\"_errors\";a:0:{}}s:9:\"_errorMsg\";N;s:7:\"_errors\";a:0:{}}}');

/*Table structure for table `jos_stats_agents` */

DROP TABLE IF EXISTS `jos_stats_agents`;

CREATE TABLE `jos_stats_agents` (
  `agent` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_stats_agents` */

/*Table structure for table `jos_templates_menu` */

DROP TABLE IF EXISTS `jos_templates_menu`;

CREATE TABLE `jos_templates_menu` (
  `template` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menuid`,`client_id`,`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_templates_menu` */

insert  into `jos_templates_menu`(`template`,`menuid`,`client_id`) values ('vtpl_template',0,0),('khepri',0,1);

/*Table structure for table `jos_users` */

DROP TABLE IF EXISTS `jos_users`;

CREATE TABLE `jos_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `gid_block` (`gid`,`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

/*Data for the table `jos_users` */

insert  into `jos_users`(`id`,`name`,`username`,`email`,`password`,`usertype`,`block`,`sendEmail`,`gid`,`registerDate`,`lastvisitDate`,`activation`,`params`) values (62,'Administrator','admin','sunny@vitruviantech.com','dbee0be9319da24add10669d2e5fffe0:kaEvcHWPaZZPRhZ46KJM4m7sbuqPD7v2','Super Administrator',0,1,25,'2013-04-01 10:47:23','2013-06-02 09:41:11','','');

/*Table structure for table `jos_weblinks` */

DROP TABLE IF EXISTS `jos_weblinks`;

CREATE TABLE `jos_weblinks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`published`,`archived`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `jos_weblinks` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
