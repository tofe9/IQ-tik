-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2020 a las 18:40:08
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_graphics`
--

CREATE TABLE `admin_graphics` (
  `graphicsID` int(11) NOT NULL,
  `look` date NOT NULL,
  `Visits` int(11) NOT NULL,
  `click` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `chat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comments` text CHARACTER SET utf8 NOT NULL,
  `response` text CHARACTER SET utf8 NOT NULL,
  `key_comments` varchar(250) CHARACTER SET utf8 NOT NULL,
  `first_name` text CHARACTER SET utf8 NOT NULL,
  `last_name` text CHARACTER SET utf8 NOT NULL,
  `email` varchar(120) CHARACTER SET utf8 NOT NULL,
  `time` varchar(20) NOT NULL,
  `ip_user` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'theme', 'default'),
(2, 'censored_words', ''),
(3, 'title', 'Videoit - Drive videos online'),
(4, 'name', 'Videoit'),
(5, 'image', 'png'),
(6, 'email_web', 'chuy@gmail.com'),
(7, 'description', 'Videoit Drive videos online  videos, Download  and save - Download videoit Script PHP'),
(8, 'validation', 'off'),
(9, 'recaptcha', 'off'),
(10, 'recaptcha_key', ''),
(11, 'language', 'english'),
(12, 'terms', '&lt;h3&gt;&lt;strong&gt;Terms of use&lt;/strong&gt;&lt;/h3&gt;&lt;p&gt;&amp;nbsp;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;1.&lt;/strong&gt; Terms By accessing SharePlus hereinafter referred to as a website, you agree to comply with these Terms and Conditions of Website Use, all applicable laws and regulations and agree that you are responsible for compliance with applicable local laws.&lt;/p&gt;&lt;p&gt;If you do not agree with any of these terms, it is prohibited to use or access this site.&lt;/p&gt;&lt;p&gt;The materials contained on this site are protected by the applicable laws of copyright and trademarks.&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;2.&lt;/strong&gt; Use License Permission is granted to temporarily download a copy of the materials (information or software) on the website for personal and non-commercial use.&lt;/p&gt;&lt;p&gt;This is the granting of a license, not a transfer of title, and under this license you can not:&lt;/p&gt;&lt;p&gt;modify or copy the material;&lt;/p&gt;&lt;p&gt;use the material for any commercial purpose, or to show to the public (commercial or non-commercial);&lt;/p&gt;&lt;p&gt;attempt to modify or reverse engineer the system included in the website;&lt;/p&gt;&lt;p&gt;remove any copyright information or notes from the owner on the materials;&lt;/p&gt;&lt;p&gt;or transfer the material to another person or &quot;copy&quot; the material to another server.&lt;/p&gt;&lt;p&gt;This license will terminate automatically if you violate any of these restrictions and may be terminated by the website at any time.&lt;/p&gt;&lt;p&gt;Upon completion of the viewing of these materials or upon completion of this license, you must destroy any downloaded material in your possession, either in electronic or printed format.&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;3.&lt;/strong&gt; Exemption from Liability A.The materials on the website are provided &quot;as is&quot;.&lt;/p&gt;&lt;p&gt;The website makes no warranties, express or implied, and hereby denies and denies all other warranties, including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, intellectual property infringement or other breach of rights.&lt;/p&gt;&lt;p&gt;In addition, the website does not guarantee or make any representation with respect to the accuracy, probable results or reliability of the use of the materials on its Internet website or otherwise related to such materials or any site linked to this site. . B.We do not exercise or promote the infringement of copyright.&lt;/p&gt;&lt;p&gt;All videos on YouTube are the copyright of their respective owners and any copyright infringement resulting from their transfer to other websites such as Facebook, will be the responsibility of the user who performs such action.&lt;/p&gt;&lt;p&gt;We also do not store videos or other material on our servers, the links are cached and after 3 hours they are destroyed, even if the users have not made the download.&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;4.&lt;/strong&gt; Limitations In no case shall the website or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profits, or due to business interruption) arising from the use or inability to use the materials, even if the Website or an authorized representative of the website has been notified orally or in writing of the possibility of such damage.&lt;/p&gt;&lt;p&gt;Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;5.&lt;/strong&gt; Reviews and Errata The materials that appear on the website may include technical, typographical or photographic errors.&lt;br&gt;The website does not guarantee that any of the materials on its website are accurate, complete or current.&lt;br&gt;The website may make changes to the materials contained on its website at any time without prior notice.&lt;br&gt;The website does not commit, however, to update the materials.&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;6.&lt;/strong&gt; Links The website has not reviewed all the sites linked to its Internet website and is not responsible for the contents of such linked sites.&lt;br&gt;The inclusion of any link does not imply endorsement by the website.&lt;br&gt;The use of any linked website is at the risk of the user.&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;7.&lt;/strong&gt; Modifications to the Conditions of use of the Site The website may revise these terms of use at any time without prior notice.&lt;/p&gt;&lt;p&gt;By using this website, you are agreeing to be bound by the current version of these Terms and Conditions of Use.&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;8.&lt;/strong&gt; Law that governs us Any claim related to the website will be governed by the laws of the Republic of India without regard to its conflict of laws provisions.&lt;/p&gt;&lt;p&gt;General terms and conditions applicable to the use of a website.&lt;/p&gt;'),
(13, 'privacy-policy', '&lt;h3 style=&quot;text-align: left;&quot; data-mce-style=&quot;text-align: left;&quot;&gt;Privacy Policy&lt;/h3&gt;&lt;p&gt;What information do we collect and store?&lt;/p&gt;&lt;p&gt;We do not ask or store any type of user information We use cookies?&lt;/p&gt;&lt;p&gt;We use cookies eventually but on SSL secure protocol.&lt;/p&gt;&lt;p&gt;Sell ​​or deliver information to third parties? We do not sell or negotiate or transfer your personal identification to third parties.&lt;/p&gt;&lt;p&gt;It does not include business partners that intervene in the operation of the website, or serve you, since these third parties have agreed to keep this information confidential.&lt;/p&gt;&lt;p&gt;We will release your information when we believe it is appropriate to abide by the law, strengthen our policies, or protect our and others rights, property, or safety. However, visitor information is never provided to third parties for marketing, advertising or other uses.&lt;/p&gt;&lt;p&gt;Privacy Policies only on the Internet These privacy policies apply only to the information collected on our website.&lt;/p&gt;&lt;p&gt;Your consent By browsing and using the services of our website, you adhere to our privacy policy.&lt;/p&gt;&lt;p&gt;Changes to our Privacy Policies If we make changes to our privacy policies, we will update those changes on this page.&lt;/p&gt;&lt;p&gt;Contact Us If you have any questions about this privacy policy, please inform us using this form.&lt;/p&gt;'),
(14, 'dmca', '&lt;h2&gt;&lt;span style=&quot;color: rgb(0, 0, 0);&quot; data-mce-style=&quot;color: #000000;&quot;&gt;Copyright (DMCA)&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;Videoit respects copyright of all works, and doesn’t allow users to use others’ videos for anything that is against the copyright protection terms and conditions. Any kind of copyright infringement is not allowed on Videoit.zhareiv.com, and we blacklist all the copyrighted contents from displaying in the search results.&lt;/p&gt;&lt;p&gt;Videoit complies with the Digital Millennium Copyright Act (DMCA) and promptly suspends Content from access when properly notified.&lt;/p&gt;&lt;p&gt;To file a copyright infringement notification with Videoit, you will need to send an email that includes substantially the information required by and stated in Section 512(c)(3) of the Digital Millennium Copyright Act.&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Required information:&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;1. Identify yourself as either: a) The owner of a copyrighted work(s), or b) A person &quot;authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.&quot; Include a physical or electronic signature.&lt;/p&gt;&lt;p&gt;2. Identify the copyrighted work claimed to have been infringed.&lt;/p&gt;&lt;p&gt;3. Identify the Content that is claimed to be infringing or to be the subject of the infringing activity and that is to be suspended or access to which is to be disabled, as well as information reasonably sufficient to permit Shareplus to locate the Content. Providing URLs are required to help us locate the Content.&lt;/p&gt;&lt;p&gt;4. Provide contact information that is reasonably sufficient to permit us to contact you, such as an address, telephone number, and a valid email address.&lt;/p&gt;&lt;p&gt;5. State that you have a good faith belief that use of the Content in the manner complained of is not authorized by the copyright owner, its agents, or the law.&lt;/p&gt;&lt;p&gt;6. State that the information in the notification is accurate and under penalty of perjury the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;Upon receipt of valid notification, as required by law, we will suspend access to Content from our website.&lt;/p&gt;&lt;p&gt;&lt;strong&gt;  &lt;/strong&gt;&lt;/p&gt;&lt;p&gt;If you have any questions, please contact us at&amp;nbsp;&lt;a href=&quot;mailto:videoit@zhareiv.com&quot; data-mce-href=&quot;mailto:videoit@zhareiv.com&quot;&gt;user@mail.com&lt;/a&gt;&lt;/p&gt;'),
(15, 'page', ''),
(16, 'facebook', ''),
(17, 'twitter', ''),
(18, 'blog', 'off'),
(19, 'seo_link', 'on'),
(20, 'contsct', 'on'),
(21, 'ads', 'off'),
(22, 'api', 'off'),
(23, 'Languages_panel', 'en'),
(24, 'email', 'user@mail.com'),
(25, 'password', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(26, 'smtp_host', ''),
(27, 'smtp_username', ''),
(28, 'smtp_password', ''),
(29, 'smtp_encryption', 'TLS'),
(30, 'smtp_port', ''),
(31, 'verfiti_login', 'd4OXtphkp'),
(32, 'note', ''),
(33, 'keyword', ''),
(34, 'ads_one', ''),
(35, 'ads_two', ''),
(36, 'ads_three', ''),
(37, 'add_tag_ad_1', ''),
(38, 'add_tag_ad_2', ''),
(39, 'add_tag_ad_3', ''),
(40, 'add_tag_ad_4', ''),
(41, 'add_tag_ad_5', ''),
(42, 'ads_four', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `download_list`
--

CREATE TABLE `download_list` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `video` varchar(255) CHARACTER SET utf8 NOT NULL,
  `audio` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type_file` varchar(255) NOT NULL,
  `time` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platform_media`
--

CREATE TABLE `platform_media` (
  `id` int(11) NOT NULL,
  `key_plugin` varchar(11) NOT NULL,
  `platform` varchar(255) CHARACTER SET utf8 NOT NULL,
  `url` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `title_content` varchar(300) CHARACTER SET utf8 NOT NULL,
  `description_content` varchar(300) CHARACTER SET utf8 NOT NULL,
  `keywords_content` varchar(300) CHARACTER SET utf8 NOT NULL,
  `platform_content` text CHARACTER SET utf8 NOT NULL,
  `visits` int(120) NOT NULL DEFAULT 0,
  `Data_Update` text CHARACTER SET utf8 NOT NULL,
  `version` varchar(255) NOT NULL,
  `Author` varchar(120) CHARACTER SET utf8 NOT NULL,
  `icon` text CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `url_line` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(200) NOT NULL,
  `tags` text NOT NULL,
  `views` varchar(120) NOT NULL,
  `time` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `report_link`
--

CREATE TABLE `report_link` (
  `id` int(11) NOT NULL,
  `report_link` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `platform` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  `ip_user` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `share_urls`
--

CREATE TABLE `share_urls` (
  `id` int(11) NOT NULL,
  `id_url` varchar(120) CHARACTER SET utf8 NOT NULL,
  `url` varchar(120) CHARACTER SET utf8 NOT NULL,
  `platform` varchar(11) NOT NULL,
  `ip_user` varchar(120) CHARACTER SET utf8 NOT NULL,
  `views` varchar(11) NOT NULL,
  `time` varchar(11) NOT NULL,
  `facebook` tinyint(255) NOT NULL,
  `twitter` tinyint(255) NOT NULL,
  `whatsapp` tinyint(255) NOT NULL,
  `vk` tinyint(255) NOT NULL,
  `telegram` tinyint(255) NOT NULL,
  `discord` tinyint(255) NOT NULL,
  `viber` tinyint(255) NOT NULL,
  `other` tinyint(255) NOT NULL,
  `downloads` tinyint(255) NOT NULL,
  `privacy` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin_graphics`
--
ALTER TABLE `admin_graphics`
  ADD PRIMARY KEY (`graphicsID`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `value` (`value`(255));

--
-- Indices de la tabla `download_list`
--
ALTER TABLE `download_list`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `platform_media`
--
ALTER TABLE `platform_media`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `report_link`
--
ALTER TABLE `report_link`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `share_urls`
--
ALTER TABLE `share_urls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin_graphics`
--
ALTER TABLE `admin_graphics`
  MODIFY `graphicsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `download_list`
--
ALTER TABLE `download_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `platform_media`
--
ALTER TABLE `platform_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `report_link`
--
ALTER TABLE `report_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `share_urls`
--
ALTER TABLE `share_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
