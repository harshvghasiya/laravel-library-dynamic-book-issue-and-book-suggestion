-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 21, 2021 at 10:13 PM
-- Server version: 5.7.33-0ubuntu0.16.04.1
-- PHP Version: 7.2.34-8+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE `acl` (
  `id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl`
--

INSERT INTO `acl` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(59, 'Acl', 1, '2020-05-17 07:12:54', '2020-05-17 07:12:54'),
(60, 'Banner', 1, '2020-05-17 07:13:03', '2020-05-17 07:13:03'),
(61, 'Email Template', 1, '2020-05-17 11:09:20', '2020-05-17 11:09:20'),
(62, 'Social Media', 1, '2020-05-17 11:09:28', '2020-05-17 11:09:28'),
(63, 'Contact Us', 1, '2020-05-17 11:09:39', '2020-05-17 11:09:39'),
(64, 'NewsLetter', 1, '2020-05-17 11:09:48', '2020-05-17 11:09:48'),
(65, 'Category', 1, '2020-05-17 11:10:13', '2020-05-17 11:10:13'),
(66, 'Blog', 1, '2020-05-17 11:10:25', '2020-05-17 11:10:25'),
(67, 'CMS', 1, '2020-05-17 11:10:35', '2020-05-17 11:10:35'),
(68, 'CMS Module', 1, '2020-05-17 11:10:42', '2020-05-17 11:10:42'),
(69, 'Setting', 1, '2020-05-17 11:10:56', '2020-05-17 11:10:56'),
(70, 'Right', 1, '2020-05-18 12:25:28', '2020-05-18 12:25:28'),
(71, 'Admin User', 1, '2020-05-18 12:25:38', '2020-05-18 12:25:47'),
(72, 'Sub Category', 1, '2021-03-18 16:31:44', '2021-03-18 16:31:44'),
(73, 'Product', 1, '2021-03-18 17:29:32', '2021-03-18 17:29:32'),
(74, 'Country', 1, '2021-03-22 18:02:28', '2021-03-22 18:02:28'),
(75, 'Brand', 1, '2021-03-22 18:02:37', '2021-03-22 18:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cms_id` int(11) DEFAULT NULL,
  `image` text,
  `url` text,
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `last_updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `cms_id`, `image`, `url`, `status`, `created_at`, `updated_at`, `created_by`, `last_updated_by`) VALUES
(1, 'SEO', NULL, '1616868490.Corning Cell counter from FirstSource-915x420.png', 'http://abc.com', 1, '2021-03-27 18:08:10', '2021-03-27 12:38:10', NULL, NULL),
(2, 'Aboust Us', NULL, '1616868613.Screenshot from 2021-02-12 14-27-54.png', 'https://www.firstsourcels.com/', 1, '2021-03-27 12:40:13', '2021-03-27 12:40:13', NULL, NULL),
(3, 'dsda', NULL, 'Slider_1_1617080764.jpg', NULL, 1, '2021-03-30 05:06:04', '2021-03-29 23:36:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `slug` text,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` longtext,
  `short_description` longtext,
  `long_description` longtext,
  `display_on_header` int(11) NOT NULL DEFAULT '0' COMMENT '1:Yes;0:No',
  `total_visitor` int(255) NOT NULL DEFAULT '0',
  `seo_title` text CHARACTER SET utf8,
  `seo_keyword` text CHARACTER SET utf8,
  `seo_description` text CHARACTER SET utf8,
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `is_demo` int(3) DEFAULT '0',
  `demo_url` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` longtext,
  `description` longtext,
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'apple', NULL, 1, '2021-03-23 23:29:02', '2021-03-25 04:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `slug` longtext CHARACTER SET utf8,
  `name` longtext CHARACTER SET utf8,
  `bg_color` varchar(255) DEFAULT NULL,
  `image` longtext CHARACTER SET utf8,
  `description` longtext CHARACTER SET utf8,
  `parent_id` int(11) DEFAULT NULL,
  `display_on_header` int(11) DEFAULT '0' COMMENT '1:Yes;0:No',
  `display_on_footer` int(11) DEFAULT '0' COMMENT '1:Yes;0:No',
  `status` int(3) NOT NULL COMMENT '1 active and 0 inactive',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `module_id` int(10) DEFAULT NULL,
  `name` text CHARACTER SET utf8,
  `image` text CHARACTER SET utf8,
  `short_description` text CHARACTER SET utf8,
  `long_description` text CHARACTER SET utf8,
  `seo_title` text CHARACTER SET utf8,
  `seo_keyword` text CHARACTER SET utf16,
  `seo_description` text CHARACTER SET utf8,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `secondary_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `display_on_header` tinyint(3) DEFAULT NULL COMMENT '1=yes,0=no',
  `display_on_footer` tinyint(3) DEFAULT NULL COMMENT '1=yes,0=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `last_updated_by` int(10) DEFAULT NULL,
  `redirect_url` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `parent_id`, `slug`, `module_id`, `name`, `image`, `short_description`, `long_description`, `seo_title`, `seo_keyword`, `seo_description`, `status`, `secondary_title`, `display_on_header`, `display_on_footer`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `redirect_url`) VALUES
(1, NULL, 'aboust-us', NULL, 'Aboust Us', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, '2021-03-25 13:03:32', '2021-04-09 03:48:12', 1, 1, NULL),
(2, NULL, 'sitemap', NULL, 'SiteMap', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, '2021-03-25 13:05:23', '2021-03-25 13:05:23', 1, NULL, NULL),
(3, NULL, 'e-catalogue', NULL, 'E-Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, '2021-04-09 04:40:51', '2021-04-09 06:48:47', 1, 1, 'https://softtechover.com/ecommercedemo/'),
(4, NULL, 'request-catalogue', NULL, 'Request Catalogue', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, '2021-04-09 04:41:08', '2021-04-09 04:41:08', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8,
  `email` text CHARACTER SET utf8,
  `message` text CHARACTER SET utf8,
  `phone` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `message`, `phone`, `company_name`, `created_at`, `updated_at`) VALUES
(1, 'Chirag', 'gcb1196@gmail.com', '414A,VIJAYRAJNAGAT,BHAVNAGAR', '9825326562', 'Softtechover', '2021-04-09 05:51:11', '2021-04-09 05:51:11'),
(2, 'Chirag', 'sdjsds@yopmail.com', 'kjJKJ', '898989898', 'KJKJK', '2021-04-11 01:06:44', '2021-04-11 01:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(5, 'India', 1, '2021-03-22 13:02:17', '2021-03-22 13:02:17'),
(6, 'USA', 1, '2021-03-22 13:02:23', '2021-03-22 13:02:23');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT ' 1=active,0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `subject`, `from`, `description`, `status`, `created_at`, `updated_at`) VALUES
(813, 'verify_front_news_letter', 'Verify your subscription', 'info@softtechover.com', '&lt;div style=&quot;color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; line-height: 1.2; padding: 10px 40px 10px 40px;&quot;&gt;\r\n&lt;div style=&quot;line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;&quot;&gt;\r\n&lt;p style=&quot;font-size: 30px; line-height: 1.2; text-align: center; word-break: break-word; mso-line-height-alt: 36px; margin: 0;&quot;&gt;&lt;span style=&quot;color: #2b303a;&quot;&gt;&lt;strong&gt;Dear Subscriber&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div style=&quot;color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; line-height: 1.5; padding: 10px 40px 10px 40px;&quot;&gt;\r\n&lt;div style=&quot;line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;&quot;&gt;\r\n&lt;p style=&quot;font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: inherit; mso-line-height-alt: 23px; margin: 0;&quot;&gt;&lt;span style=&quot;color: #808389; font-size: 15px;&quot;&gt;Thank you for subscribed via &lt;a style=&quot;color: #17bbc1;&quot; href=&quot;###SITE_URL###&quot;&gt;###SITE_NAME###&lt;/a&gt; To get latest news and update verify your account by clicking below button.&lt;/span&gt;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;button-container&quot; style=&quot;padding: 15px 10px 0px 10px;&quot; align=&quot;center&quot;&gt;\r\n&lt;div style=&quot;text-decoration: none; display: inline-block; color: #ffffff; background-color: #1aa19c; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; width: auto; ;border-top: 1px solid #1aa19c; border-right: 1px solid #1aa19c; border-bottom: 1px solid #1aa19c; border-left: 1px solid #1aa19c; padding-top: 15px; padding-bottom: 15px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;&quot;&gt;&lt;a style=&quot;padding-left: 30px; padding-right: 30px; font-size: 16px; display: inline-block; text-decoration: none; color: white;&quot; href=&quot;###LINK###&quot; target=&quot;_blank&quot; rel=&quot;noopener&quot;&gt;&lt;strong&gt;Verify Email&lt;/strong&gt;&lt;/a&gt;&lt;/div&gt;\r\n&lt;/div&gt;', 1, '2019-09-07 04:25:52', '2020-06-17 14:08:59'),
(814, 'sample', 'sample_email', 'info@softtechover.com', '&lt;div style=&quot;background-color: transparent;&quot;&gt;\r\n&lt;div class=&quot;block-grid&quot; style=&quot;margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #ffffff;&quot;&gt;\r\n&lt;div style=&quot;border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;&quot;&gt;\r\n&lt;div class=&quot;col num12&quot; style=&quot;min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;&quot;&gt;\r\n&lt;div style=&quot;width: 100% !important;&quot;&gt;\r\n&lt;div style=&quot;border: 0px solid transparent; padding: 0px;&quot;&gt;\r\n&lt;div style=&quot;color: #555555; font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; line-height: 1.2; padding: 20px 40px 10px 40px;&quot;&gt;\r\n&lt;div style=&quot;line-height: 1.2; font-size: 12px; color: #555555; font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;&quot;&gt;\r\n&lt;p style=&quot;font-size: 46px; line-height: 1.2; text-align: center; word-break: break-word; mso-line-height-alt: 55px; margin: 0;&quot;&gt;&lt;span style=&quot;font-size: 46px; color: #003188;&quot;&gt;&lt;strong&gt;Got a minute? &lt;/strong&gt; &lt;/span&gt;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div style=&quot;color: #555555; font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; line-height: 1.5; padding: 10px 40px 10px 40px;&quot;&gt;\r\n&lt;div style=&quot;line-height: 1.5; font-size: 12px; font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;&quot;&gt;\r\n&lt;p style=&quot;text-align: center; line-height: 1.5; word-break: break-word; font-family: inherit; font-size: 16px; mso-line-height-alt: 24px; margin: 0;&quot;&gt;&lt;span style=&quot;font-size: 16px; color: #6d89bc;&quot;&gt;Thanks for being a &quot;YourBrand&quot; newsletter subscriber! &lt;/span&gt;&lt;br /&gt;&lt;span style=&quot;font-size: 16px; color: #6d89bc;&quot;&gt;We\'d appreciate if you take just a few minutes of your time to share your thoughts, so we can improve our contents and services. &lt;/span&gt; &lt;span style=&quot;font-size: 16px; color: #6d89bc;&quot;&gt; Thank you for taking our quick survey! &lt;/span&gt;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;', 1, '2020-05-19 06:34:19', '2020-06-17 14:24:49'),
(815, 'forgot_password_admin_user', 'Reset your passwod', 'info@softtechover.com', '&lt;div style=&quot;background-color: transparent;&quot;&gt;\r\n&lt;div class=&quot;block-grid&quot; style=&quot;margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #ffffff;&quot;&gt;\r\n&lt;div style=&quot;border-collapse: collapse; display: table; width: 100%; background-color: #ffffff;&quot;&gt;\r\n&lt;div class=&quot;col num12&quot; style=&quot;min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;&quot;&gt;\r\n&lt;div style=&quot;width: 100% !important;&quot;&gt;\r\n&lt;div style=&quot;border: 0px solid transparent; padding: 0px;&quot;&gt;\r\n&lt;div style=&quot;color: #555555; font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; line-height: 1.2; padding: 20px 40px 10px 40px;&quot;&gt;\r\n&lt;div style=&quot;line-height: 1.2; font-size: 12px; color: #555555; font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;&quot;&gt;\r\n&lt;p style=&quot;font-size: 46px; line-height: 1.2; text-align: center; word-break: break-word; mso-line-height-alt: 55px; margin: 0;&quot;&gt;&lt;span style=&quot;font-size: 46px; color: #003188;&quot;&gt;&lt;strong&gt;&lt;a href=&quot;###LINK####&quot;&gt;Click here to reset you password&lt;/a&gt;&amp;nbsp;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div style=&quot;color: #555555; font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; line-height: 1.5; padding: 10px 40px 10px 40px;&quot;&gt;\r\n&lt;div style=&quot;line-height: 1.5; font-size: 12px; font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;&quot;&gt;\r\n&lt;p style=&quot;text-align: center; line-height: 1.5; word-break: break-word; font-family: inherit; font-size: 16px; mso-line-height-alt: 24px; margin: 0;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;', 1, '2020-05-19 08:09:34', '2020-06-17 14:25:04'),
(816, 'send_mail_to_user_for_request', 'Thank you for Request Catalogue', 'info@softtechover.com', '&lt;div style=&quot;color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; line-height: 1.2; padding: 10px 40px 10px 40px;&quot;&gt;\r\n&lt;div style=&quot;line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;&quot;&gt;\r\n&lt;p style=&quot;font-size: 30px; line-height: 1.2; text-align: center; word-break: break-word; mso-line-height-alt: 36px; margin: 0;&quot;&gt;&lt;span style=&quot;color: #2b303a;&quot;&gt;&lt;strong&gt;Dear ###NAME###&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div style=&quot;color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; line-height: 1.5; padding: 10px 40px 10px 40px;&quot;&gt;\r\n&lt;div style=&quot;line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;&quot;&gt;\r\n&lt;p style=&quot;font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: inherit; mso-line-height-alt: 23px; margin: 0;&quot;&gt;&lt;span style=&quot;color: #808389; font-size: 15px;&quot;&gt;Thank you for &lt;strong&gt;Request Catalogue&lt;/strong&gt; us via &lt;a style=&quot;color: #17bbc1;&quot; href=&quot;###SITE_URL###&quot;&gt;###SITE_NAME###&lt;/a&gt; .Our team will contact you soon.&lt;/span&gt;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;', 1, '2020-06-17 16:15:48', '2021-04-09 05:42:19'),
(817, 'send_mail_to_admin_for_request', 'Request Catalogue Inquiry', 'info@softtechover.com', '&lt;div style=&quot;color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; line-height: 1.2; padding: 10px 40px 10px 40px;&quot;&gt;\r\n&lt;div style=&quot;line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;&quot;&gt;\r\n&lt;p style=&quot;font-size: 30px; line-height: 1.2; text-align: center; word-break: break-word; mso-line-height-alt: 36px; margin: 0;&quot;&gt;&lt;span style=&quot;color: #2b303a;&quot;&gt;&lt;strong&gt;Dear Admin&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;div style=&quot;color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; line-height: 1.5; padding: 10px 40px 10px 40px;&quot;&gt;\r\n&lt;div style=&quot;line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;&quot;&gt;\r\n&lt;p style=&quot;font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: inherit; mso-line-height-alt: 23px; margin: 0;&quot;&gt;&lt;span style=&quot;color: #808389;&quot;&gt;Please check below user Request inquiry details.&lt;/span&gt;&lt;/p&gt;\r\n&lt;p style=&quot;font-size: 15px; line-height: 1.5; text-align: center; word-break: break-word; font-family: inherit; mso-line-height-alt: 23px; margin: 0;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;table style=&quot;border-collapse: collapse; width: 100%;&quot; border=&quot;1&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 100%; text-align: center;&quot;&gt;&lt;span style=&quot;font-size: 18pt; color: #3598db;&quot;&gt;&lt;strong&gt;User Request Inquiery Details&lt;/strong&gt;&lt;/span&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;table style=&quot;color: #555555; border-collapse: collapse; width: 99.8826%; height: 68px;&quot; border=&quot;1&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr style=&quot;height: 17px;&quot;&gt;\r\n&lt;td style=&quot;width: 50%; height: 17px;&quot;&gt;&amp;nbsp;Name&lt;/td&gt;\r\n&lt;td style=&quot;width: 50%; height: 17px;&quot;&gt;&lt;strong&gt;&amp;nbsp;###NAME###&lt;/strong&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 17px;&quot;&gt;\r\n&lt;td style=&quot;width: 50%; height: 17px;&quot;&gt;&amp;nbsp;Email&lt;/td&gt;\r\n&lt;td style=&quot;width: 50%; height: 17px;&quot;&gt;&lt;strong&gt;&amp;nbsp;###EMAIL###&lt;/strong&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 17px;&quot;&gt;\r\n&lt;td style=&quot;width: 50%; height: 17px;&quot;&gt;&amp;nbsp;Company Name&lt;/td&gt;\r\n&lt;td style=&quot;width: 50%; height: 17px;&quot;&gt;&lt;strong&gt;&amp;nbsp;###COMPANY_NAME###&lt;/strong&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 50%;&quot;&gt;Phone&lt;/td&gt;\r\n&lt;td style=&quot;width: 50%;&quot;&gt;&lt;strong&gt;&amp;nbsp;###PHONE###&lt;/strong&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 17px;&quot;&gt;\r\n&lt;td style=&quot;width: 50%; height: 17px;&quot;&gt;&amp;nbsp;Message&lt;/td&gt;\r\n&lt;td style=&quot;width: 50%; height: 17px;&quot;&gt;&lt;strong&gt;&amp;nbsp;###MESSAGE###&lt;/strong&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;', 1, '2020-06-17 16:17:54', '2021-04-09 05:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sort_name` varchar(10) DEFAULT NULL,
  `image` text,
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `last_updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `sort_name`, `image`, `status`, `created_at`, `updated_at`, `created_by`, `last_updated_by`) VALUES
(1, 'English', 'en', '1542446244.english.png', 1, '2018-11-17 09:17:24', '2018-11-17 03:47:24', NULL, NULL),
(2, 'Arebic', 'ar', '1542446257.arabic.png', 1, '2018-11-25 09:18:56', '2018-11-25 03:48:56', NULL, NULL),
(3, 'Turkey', 'tr', '1543127506.tr.png', 1, '2018-11-25 10:11:37', '2018-11-25 04:41:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2018_04_04_124842_create_email_templates_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `last_updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `status`, `created_at`, `updated_at`, `created_by`, `last_updated_by`) VALUES
(1, 'Footer Information', 1, '2021-03-25 12:32:52', '2021-03-25 12:36:58', 1, 1),
(2, 'Footer Extras', 1, '2021-03-25 12:33:05', '2021-03-25 12:37:07', 1, 1),
(3, 'Display on Header', 1, '2021-04-09 03:58:47', '2021-04-09 03:58:47', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `multiple_category`
--

CREATE TABLE `multiple_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `multiple_cms_module`
--

CREATE TABLE `multiple_cms_module` (
  `id` int(11) NOT NULL,
  `cms_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multiple_cms_module`
--

INSERT INTO `multiple_cms_module` (`id`, `cms_id`, `module_id`, `created_at`, `updated_at`) VALUES
(2, 2, 2, '2021-03-25 13:05:23', '2021-03-25 13:05:23'),
(8, 4, 3, '2021-04-09 04:41:08', '2021-04-09 04:41:08'),
(13, 3, 2, '2021-04-09 07:03:29', '2021-04-09 07:03:29'),
(14, 3, 3, '2021-04-09 07:03:29', '2021-04-09 07:03:29'),
(15, 1, 3, '2021-04-09 07:03:36', '2021-04-09 07:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `email` text CHARACTER SET utf8,
  `token` longtext,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hihi@gmail.com', '1616698819kyvy3b1616698819', 0, '2021-03-25 13:30:19', '2021-03-25 13:30:19'),
(2, 'asdfasdas@gmail.com', '1616698934bglqy11616698934', 0, '2021-03-25 13:32:14', '2021-03-25 13:32:14'),
(3, 'xdfsdfs@gmail.com', '1616699072j05aut1616699072', 0, '2021-03-25 13:34:32', '2021-03-25 13:34:32'),
(4, 'sddfgsdfssfdgsd@gmail.com', '1616699141l6jbcl1616699141', 0, '2021-03-25 13:35:41', '2021-03-25 13:35:41'),
(5, 'gcd@gmail.com', '1616699165wexw161616699165', 0, '2021-03-25 13:36:05', '2021-03-25 13:36:05'),
(6, 'asdfasd2@gmail.com', '16166992353l3wyd1616699235', 0, '2021-03-25 13:37:15', '2021-03-25 13:37:15'),
(7, 'sdffsdfsd@gmail.com', '1616770379zutv7p1616770379', 0, '2021-03-26 09:22:59', '2021-03-26 09:22:59'),
(8, 'gcb1196@gmail.com', '1616926120i08bzu1616926120', 0, '2021-03-28 04:38:40', '2021-03-28 04:38:40'),
(9, 'dfsdfs@gmail.com', '16169493220svqzo1616949322', 0, '2021-03-28 11:05:22', '2021-03-28 11:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `slug` longtext,
  `name` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `hsn_code` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_code` varchar(255) DEFAULT NULL,
  `speak_to_expert` varchar(255) DEFAULT NULL,
  `description` longtext,
  `technical_description` longtext,
  `short_description` longtext,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_keyword` varchar(255) DEFAULT NULL,
  `seo_description` longtext,
  `video_link` longtext,
  `contact_url` longtext,
  `attachment` longtext,
  `availability` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `is_featured` int(11) DEFAULT '2' COMMENT '1:Featured;2:Not'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_features`
--

CREATE TABLE `product_features` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED DEFAULT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `f_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE `rights` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT '0' COMMENT '0=inactive, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `rights`
--

INSERT INTO `rights` (`id`, `name`, `status`, `created_at`, `updated_at`, `created_by`, `last_updated_by`) VALUES
(1, 'Admin', 1, NULL, '2020-05-17 06:20:16', 0, 2),
(6, 'SEO', 1, '2020-05-17 07:23:37', '2020-05-18 09:35:40', NULL, NULL),
(7, 'Guest', 1, '2020-05-26 09:22:00', '2020-05-26 09:22:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `right_modules`
--

CREATE TABLE `right_modules` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `right_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `send_inquiry`
--

CREATE TABLE `send_inquiry` (
  `id` int(11) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `pieces` int(11) NOT NULL,
  `extra_request` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `send_inquiry`
--

INSERT INTO `send_inquiry` (`id`, `from_email`, `product_id`, `subject`, `quantity`, `pieces`, `extra_request`, `content`) VALUES
(1, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(2, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(3, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(4, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(5, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(6, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(7, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(8, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(9, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(11, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(12, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(13, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(14, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(15, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(16, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(17, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(18, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(19, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(20, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(21, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(22, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(23, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(24, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(25, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(26, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(27, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(28, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd'),
(29, 'akhielsh@gmial.com', 3, 'submect', 3, 33, ' asfskfas', 'dsfasfsd');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_url` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `second_email` varchar(100) DEFAULT NULL,
  `address` text,
  `second_address` text,
  `mobile` varchar(255) DEFAULT NULL,
  `second_mobile` varchar(255) DEFAULT NULL,
  `logo_image` text,
  `author_image` longtext CHARACTER SET utf8,
  `email_image` text,
  `favicon_image` text,
  `home_page_banner_image` text,
  `author_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `author_description_one` text CHARACTER SET utf8,
  `author_description_two` text CHARACTER SET utf8,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_url`, `email`, `second_email`, `address`, `second_address`, `mobile`, `second_mobile`, `logo_image`, `author_image`, `email_image`, `favicon_image`, `home_page_banner_image`, `author_name`, `author_description_one`, `author_description_two`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'https://test.dev', 'info@softtechover.com', 'info@softtechover.com', '<p><span style="font-size: 14px;">413A ,3A2 , Ahmedabad,</span></p>\r\n<p><span style="font-size: 14px;">IN 3640015, India</span></p>\r\n<p><span style="font-size: 14px;"><strong>Phone</strong>: <a href="tel:9825326562">9825326562</a><br /><strong>Email</strong>: <a href="mailto:gcb1196@gmail.com">gcb1196@gmail.com</a></span></p>', '413A ,3A2 , Ahmedabad,\r\n\r\nIN 3640015, India\r\n\r\nPhone: 9825326562\r\nEmail: gcb1196@gmail.com', '9825326562', '9825326562', '1616694734.1.png', NULL, '1616939443.1.png', '1617085973.1597837666.favicon.ico', '1616939443.1.png', 'Ecommerce', '', '', NULL, '2018-07-11 18:30:00', '2021-04-09 05:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `social_medias`
--

CREATE TABLE `social_medias` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `font_awesome` text CHARACTER SET utf8,
  `url` text,
  `image` longtext CHARACTER SET utf8,
  `status` tinyint(3) DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_medias`
--

INSERT INTO `social_medias` (`id`, `title`, `font_awesome`, `url`, `image`, `status`, `created_at`, `updated_at`) VALUES
(9, 'facebook', 'fa fa-facebook', 'https://www.facebook.com/GCB1196', 'image_4a87af99d62318fcff728df2a0807a2d.png', 1, '2018-11-04 03:15:50', '2021-03-24 11:30:37'),
(10, 'twitter', 'fa fa-twitter', 'https://skype.com', 'image_c37f32ab16ecd8db58dd95bd7a96da8c.png', 1, '2018-11-04 03:19:55', '2021-03-24 11:29:42'),
(12, 'instagram', 'fa fa-instagram', 'https://www.instagram.com/chirag_patel1105/', '1589973090.image_6dfd3411e5a65b0f70ab654447589537.png', 1, '2018-11-04 03:20:54', '2021-03-24 11:30:52'),
(13, 'linkedin', 'fa fa-linkedin-square', 'https://in.linkedin.com/in/chirag-ghevariya-12271395', NULL, 1, '2019-08-19 11:59:40', '2021-03-24 11:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` longtext CHARACTER SET utf8,
  `name` longtext CHARACTER SET utf8,
  `image` longtext CHARACTER SET utf8,
  `description` longtext CHARACTER SET utf8,
  `status` int(3) NOT NULL COMMENT '1 active and 2 inactive',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `right_id` int(3) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `image` text COLLATE utf8mb4_unicode_ci,
  `forgot_password_token` text COLLATE utf8mb4_unicode_ci,
  `resetlink_send` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `right_id`, `name`, `email`, `password`, `status`, `image`, `forgot_password_token`, `resetlink_send`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'SuperAdmin', 'admin@gmail.com', '$2y$10$BxWqr2.BmqV.HE3zVuGQ8eQrFtDnFSDaBFBCqmoqGvA1LHcbR78mm', 1, '1589984747.20197818.jpeg', NULL, 0, 'r2XYpTB35afGoQC8BUHjtIVOr1lV6YIDQw1nAb6ilm6ERA8glYZuBISuso3v', '2018-03-20 16:14:14', '2021-03-17 09:02:51'),
(54, 6, 'Haresh', 'adminseo@gmail.com', '$2y$10$3CfuDuCpZ7aD/p5PBIPOUOmz0ghpkX1dG71erigaadW8P9htajAgu', 1, '1589984452.20197818.jpeg', NULL, 0, NULL, '2020-05-18 04:40:52', '2020-05-20 08:50:52'),
(55, 6, 'Chirag Patel', 'gcb1196@gmail.com', '$2y$10$uAXGjttqgNxb2GH0bWcJAeMwGYpe2EJ8aYN2MKIv072DC9kWEFngi', 1, '1589986718.profille-image-not-foune.png', NULL, 0, NULL, '2020-05-18 05:53:30', '2020-05-20 09:28:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl`
--
ALTER TABLE `acl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `k_category` (`category_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multiple_category`
--
ALTER TABLE `multiple_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `multiple_cms_module`
--
ALTER TABLE `multiple_cms_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `cms_id` (`cms_id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_features`
--
ALTER TABLE `product_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `right_modules`
--
ALTER TABLE `right_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_inquiry`
--
ALTER TABLE `send_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_medias`
--
ALTER TABLE `social_medias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `right_id` (`right_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acl`
--
ALTER TABLE `acl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=818;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `multiple_category`
--
ALTER TABLE `multiple_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `multiple_cms_module`
--
ALTER TABLE `multiple_cms_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_features`
--
ALTER TABLE `product_features`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rights`
--
ALTER TABLE `rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `right_modules`
--
ALTER TABLE `right_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `send_inquiry`
--
ALTER TABLE `send_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `social_medias`
--
ALTER TABLE `social_medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `k_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `multiple_category`
--
ALTER TABLE `multiple_category`
  ADD CONSTRAINT `blog_id_foreigin_key` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `category_id_foreigin_key` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `multiple_cms_module`
--
ALTER TABLE `multiple_cms_module`
  ADD CONSTRAINT `cms_id_foreigin_key_cons` FOREIGN KEY (`cms_id`) REFERENCES `cms` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `module_foren_key` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `right_foren_key_constraint` FOREIGN KEY (`right_id`) REFERENCES `rights` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
