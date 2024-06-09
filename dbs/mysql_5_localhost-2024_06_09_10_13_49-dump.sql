-- MySQL dump 10.13  Distrib 5.7.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: vision_trt_planner
-- ------------------------------------------------------
-- Server version	5.7.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bf_activities`
--

DROP TABLE IF EXISTS `bf_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_activities` (
  `activity_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `activity` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `deleted` tinyint(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_activities`
--

LOCK TABLES `bf_activities` WRITE;
/*!40000 ALTER TABLE `bf_activities` DISABLE KEYS */;
INSERT INTO `bf_activities` VALUES (1,1,'logged in from: ::1','users','2024-06-03 13:22:20',0),(2,1,'logged out from: ::1','users','2024-06-03 13:22:32',0),(3,1,'logged in from: ::1','users','2024-06-03 13:23:31',0),(4,1,'logged out from: ::1','users','2024-06-03 13:24:32',0),(5,1,'logged in from: ::1','users','2024-06-03 13:29:31',0),(6,1,'logged in from: ::1','users','2024-06-03 15:09:47',0),(7,1,'logged in from: ::1','users','2024-06-03 15:11:17',0),(8,1,'logged in from: ::1','users','2024-06-03 22:00:00',0),(9,1,'logged in from: ::1','users','2024-06-03 22:00:50',0),(10,1,'logged in from: ::1','users','2024-06-03 22:05:29',0),(11,1,'logged in from: ::1','users','2024-06-03 22:19:01',0),(12,1,'logged out from: ::1','users','2024-06-03 22:19:51',0),(13,1,'logged in from: ::1','users','2024-06-03 22:21:49',0),(14,1,'logged in from: ::1','users','2024-06-04 09:41:32',0),(15,1,'logged in from: ::1','users','2024-06-04 13:22:06',0),(16,1,'logged in from: ::1','users','2024-06-04 13:30:55',0),(17,1,'logged in from: ::1','users','2024-06-04 22:13:37',0),(18,1,'logged in from: ::1','users','2024-06-04 23:47:33',0),(19,1,'logged in from: ::1','users','2024-06-04 23:49:59',0),(20,1,'logged in from: ::1','users','2024-06-05 00:31:15',0),(21,1,'logged in from: ::1','users','2024-06-05 00:51:19',0),(22,1,'logged in from: ::1','users','2024-06-05 10:08:55',0),(23,1,'logged out from: ::1','users','2024-06-05 10:47:15',0),(24,1,'logged in from: ::1','users','2024-06-05 10:53:54',0),(25,1,'logged in from: ::1','users','2024-06-05 13:11:59',0),(26,1,'logged in from: ::1','users','2024-06-06 01:59:21',0),(27,1,'logged in from: ::1','users','2024-06-06 02:04:55',0),(28,1,'Migrate Type: user_accounts_ to Version: 1 from: ::1','migrations','2024-06-06 03:45:34',0),(29,1,'Migrate module: user_accounts Version: 1 from: ::1','migrations','2024-06-06 03:45:34',0),(30,1,'Created new user id:230, username: Manager','user_accounts','2024-06-06 04:34:03',0),(31,1,'Changed password user details for id: 230 User: Test Manager','user_accounts','2024-06-06 04:39:16',0),(32,1,'Migrate Type: mapping_ to Version: 1 from: ::1','migrations','2024-06-06 07:19:36',0),(33,1,'Migrate module: mapping Version: 1 from: ::1','migrations','2024-06-06 07:19:36',0),(34,1,'Created new job type Production (Bulk)','mappings','2024-06-06 07:23:19',0),(35,1,'Created new job type Manufacturing (Pack)','mappings','2024-06-06 07:24:02',0),(36,1,'Updated job type Manufacturing (Packs)','mappings','2024-06-06 07:24:35',0),(37,1,'Updated job type Manufacturing (Pack)','mappings','2024-06-06 07:24:44',0),(38,1,'Created new Job area Home Care (Area 1)','mappings','2024-06-06 07:34:00',0),(39,1,'Updated job area Home Cares (Area 1)','mappings','2024-06-06 07:36:29',0),(40,1,'Updated job area Home Care (Area 1)','mappings','2024-06-06 07:36:39',0),(41,1,'Created new Job area Home Care (Area 2)','mappings','2024-06-06 07:45:34',0),(42,1,'Created new Job area Aerosal (Area 1)','mappings','2024-06-06 07:45:56',0),(43,1,'Created new Job area Personal Care (Area 1)','mappings','2024-06-06 07:46:34',0),(44,1,'Created new Job area Personal Care (Area 2)','mappings','2024-06-06 07:47:00',0),(45,1,'Created new Job area Home Care (Area 1)','mappings','2024-06-06 07:48:50',0),(46,1,'Created new Job area Aerosal 2 (Area 4)','mappings','2024-06-06 07:49:36',0),(47,1,'Created new Job area Aerosal 1 (Area 3)','mappings','2024-06-06 07:50:00',0),(48,1,'Created new Job area Personal Care (Area 2)','mappings','2024-06-06 07:50:18',0),(49,1,'Created new Job area Personal Care (Area 1)','mappings','2024-06-06 07:51:05',0),(50,1,'Created new line ','mappings','2024-06-06 10:33:26',0),(51,1,'Created new line ','mappings','2024-06-06 10:37:37',0),(52,1,'Created new line B2','mappings','2024-06-06 10:40:49',0),(53,1,'Created new line H1','mappings','2024-06-06 10:41:15',0),(54,1,'Created new line H2','mappings','2024-06-06 10:41:26',0),(55,1,'Created new line H3','mappings','2024-06-06 10:41:39',0),(56,1,'Created new line H4','mappings','2024-06-06 10:41:49',0),(57,1,'Created new line L3','mappings','2024-06-06 10:42:38',0),(58,1,'Created new line L13','mappings','2024-06-06 10:42:58',0),(59,1,'Created new line L14','mappings','2024-06-06 10:43:29',0),(60,1,'Created new line TK4','mappings','2024-06-06 10:44:09',0),(61,1,'Created new line TK5','mappings','2024-06-06 10:44:36',0),(62,1,'Created new line TK6','mappings','2024-06-06 10:45:00',0),(63,1,'Created new line TK7','mappings','2024-06-06 10:45:27',0),(64,1,'Created new line TK8','mappings','2024-06-06 10:45:56',0),(65,1,'Created new line TK2B','mappings','2024-06-06 10:46:16',0),(66,1,'logged in from: ::1','users','2024-06-07 01:02:38',0),(67,1,'logged in from: ::1','users','2024-06-07 01:17:55',0),(68,1,'Migrate Type: planner_ to Version: 1 from: ::1','migrations','2024-06-07 02:15:39',0),(69,1,'Migrate module: planner Version: 1 from: ::1','migrations','2024-06-07 02:15:39',0),(70,1,'logged in from: ::1','users','2024-06-07 02:26:05',0),(71,1,'logged in from: ::1','users','2024-06-07 09:27:39',0),(72,1,'logged in from: ::1','users','2024-06-08 06:50:58',0),(73,1,'App settings saved from: ::1','core','2024-06-08 07:20:38',0),(74,1,'logged in from: ::1','users','2024-06-09 06:20:16',0);
/*!40000 ALTER TABLE `bf_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_countries`
--

DROP TABLE IF EXISTS `bf_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_countries` (
  `iso` char(2) NOT NULL DEFAULT 'US',
  `name` varchar(80) NOT NULL,
  `printable_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`iso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_countries`
--

LOCK TABLES `bf_countries` WRITE;
/*!40000 ALTER TABLE `bf_countries` DISABLE KEYS */;
INSERT INTO `bf_countries` VALUES ('AD','ANDORRA','Andorra','AND',20),('AE','UNITED ARAB EMIRATES','United Arab Emirates','ARE',784),('AF','AFGHANISTAN','Afghanistan','AFG',4),('AG','ANTIGUA AND BARBUDA','Antigua and Barbuda','ATG',28),('AI','ANGUILLA','Anguilla','AIA',660),('AL','ALBANIA','Albania','ALB',8),('AM','ARMENIA','Armenia','ARM',51),('AN','NETHERLANDS ANTILLES','Netherlands Antilles','ANT',530),('AO','ANGOLA','Angola','AGO',24),('AQ','ANTARCTICA','Antarctica',NULL,NULL),('AR','ARGENTINA','Argentina','ARG',32),('AS','AMERICAN SAMOA','American Samoa','ASM',16),('AT','AUSTRIA','Austria','AUT',40),('AU','AUSTRALIA','Australia','AUS',36),('AW','ARUBA','Aruba','ABW',533),('AZ','AZERBAIJAN','Azerbaijan','AZE',31),('BA','BOSNIA AND HERZEGOVINA','Bosnia and Herzegovina','BIH',70),('BB','BARBADOS','Barbados','BRB',52),('BD','BANGLADESH','Bangladesh','BGD',50),('BE','BELGIUM','Belgium','BEL',56),('BF','BURKINA FASO','Burkina Faso','BFA',854),('BG','BULGARIA','Bulgaria','BGR',100),('BH','BAHRAIN','Bahrain','BHR',48),('BI','BURUNDI','Burundi','BDI',108),('BJ','BENIN','Benin','BEN',204),('BM','BERMUDA','Bermuda','BMU',60),('BN','BRUNEI DARUSSALAM','Brunei Darussalam','BRN',96),('BO','BOLIVIA','Bolivia','BOL',68),('BR','BRAZIL','Brazil','BRA',76),('BS','BAHAMAS','Bahamas','BHS',44),('BT','BHUTAN','Bhutan','BTN',64),('BV','BOUVET ISLAND','Bouvet Island',NULL,NULL),('BW','BOTSWANA','Botswana','BWA',72),('BY','BELARUS','Belarus','BLR',112),('BZ','BELIZE','Belize','BLZ',84),('CA','CANADA','Canada','CAN',124),('CC','COCOS (KEELING) ISLANDS','Cocos (Keeling) Islands',NULL,NULL),('CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE','Congo, the Democratic Republic of the','COD',180),('CF','CENTRAL AFRICAN REPUBLIC','Central African Republic','CAF',140),('CG','CONGO','Congo','COG',178),('CH','SWITZERLAND','Switzerland','CHE',756),('CI','COTE D\'IVOIRE','Cote D\'Ivoire','CIV',384),('CK','COOK ISLANDS','Cook Islands','COK',184),('CL','CHILE','Chile','CHL',152),('CM','CAMEROON','Cameroon','CMR',120),('CN','CHINA','China','CHN',156),('CO','COLOMBIA','Colombia','COL',170),('CR','COSTA RICA','Costa Rica','CRI',188),('CS','SERBIA AND MONTENEGRO','Serbia and Montenegro',NULL,NULL),('CU','CUBA','Cuba','CUB',192),('CV','CAPE VERDE','Cape Verde','CPV',132),('CX','CHRISTMAS ISLAND','Christmas Island',NULL,NULL),('CY','CYPRUS','Cyprus','CYP',196),('CZ','CZECH REPUBLIC','Czech Republic','CZE',203),('DE','GERMANY','Germany','DEU',276),('DJ','DJIBOUTI','Djibouti','DJI',262),('DK','DENMARK','Denmark','DNK',208),('DM','DOMINICA','Dominica','DMA',212),('DO','DOMINICAN REPUBLIC','Dominican Republic','DOM',214),('DZ','ALGERIA','Algeria','DZA',12),('EC','ECUADOR','Ecuador','ECU',218),('EE','ESTONIA','Estonia','EST',233),('EG','EGYPT','Egypt','EGY',818),('EH','WESTERN SAHARA','Western Sahara','ESH',732),('ER','ERITREA','Eritrea','ERI',232),('ES','SPAIN','Spain','ESP',724),('ET','ETHIOPIA','Ethiopia','ETH',231),('FI','FINLAND','Finland','FIN',246),('FJ','FIJI','Fiji','FJI',242),('FK','FALKLAND ISLANDS (MALVINAS)','Falkland Islands (Malvinas)','FLK',238),('FM','MICRONESIA, FEDERATED STATES OF','Micronesia, Federated States of','FSM',583),('FO','FAROE ISLANDS','Faroe Islands','FRO',234),('FR','FRANCE','France','FRA',250),('GA','GABON','Gabon','GAB',266),('GB','UNITED KINGDOM','United Kingdom','GBR',826),('GD','GRENADA','Grenada','GRD',308),('GE','GEORGIA','Georgia','GEO',268),('GF','FRENCH GUIANA','French Guiana','GUF',254),('GH','GHANA','Ghana','GHA',288),('GI','GIBRALTAR','Gibraltar','GIB',292),('GL','GREENLAND','Greenland','GRL',304),('GM','GAMBIA','Gambia','GMB',270),('GN','GUINEA','Guinea','GIN',324),('GP','GUADELOUPE','Guadeloupe','GLP',312),('GQ','EQUATORIAL GUINEA','Equatorial Guinea','GNQ',226),('GR','GREECE','Greece','GRC',300),('GS','SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','South Georgia and the South Sandwich Islands',NULL,NULL),('GT','GUATEMALA','Guatemala','GTM',320),('GU','GUAM','Guam','GUM',316),('GW','GUINEA-BISSAU','Guinea-Bissau','GNB',624),('GY','GUYANA','Guyana','GUY',328),('HK','HONG KONG','Hong Kong','HKG',344),('HM','HEARD ISLAND AND MCDONALD ISLANDS','Heard Island and Mcdonald Islands',NULL,NULL),('HN','HONDURAS','Honduras','HND',340),('HR','CROATIA','Croatia','HRV',191),('HT','HAITI','Haiti','HTI',332),('HU','HUNGARY','Hungary','HUN',348),('ID','INDONESIA','Indonesia','IDN',360),('IE','IRELAND','Ireland','IRL',372),('IL','ISRAEL','Israel','ISR',376),('IN','INDIA','India','IND',356),('IO','BRITISH INDIAN OCEAN TERRITORY','British Indian Ocean Territory',NULL,NULL),('IQ','IRAQ','Iraq','IRQ',368),('IR','IRAN, ISLAMIC REPUBLIC OF','Iran, Islamic Republic of','IRN',364),('IS','ICELAND','Iceland','ISL',352),('IT','ITALY','Italy','ITA',380),('JM','JAMAICA','Jamaica','JAM',388),('JO','JORDAN','Jordan','JOR',400),('JP','JAPAN','Japan','JPN',392),('KE','KENYA','Kenya','KEN',404),('KG','KYRGYZSTAN','Kyrgyzstan','KGZ',417),('KH','CAMBODIA','Cambodia','KHM',116),('KI','KIRIBATI','Kiribati','KIR',296),('KM','COMOROS','Comoros','COM',174),('KN','SAINT KITTS AND NEVIS','Saint Kitts and Nevis','KNA',659),('KP','KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','Korea, Democratic People\'s Republic of','PRK',408),('KR','KOREA, REPUBLIC OF','Korea, Republic of','KOR',410),('KW','KUWAIT','Kuwait','KWT',414),('KY','CAYMAN ISLANDS','Cayman Islands','CYM',136),('KZ','KAZAKHSTAN','Kazakhstan','KAZ',398),('LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC','Lao People\'s Democratic Republic','LAO',418),('LB','LEBANON','Lebanon','LBN',422),('LC','SAINT LUCIA','Saint Lucia','LCA',662),('LI','LIECHTENSTEIN','Liechtenstein','LIE',438),('LK','SRI LANKA','Sri Lanka','LKA',144),('LR','LIBERIA','Liberia','LBR',430),('LS','LESOTHO','Lesotho','LSO',426),('LT','LITHUANIA','Lithuania','LTU',440),('LU','LUXEMBOURG','Luxembourg','LUX',442),('LV','LATVIA','Latvia','LVA',428),('LY','LIBYAN ARAB JAMAHIRIYA','Libyan Arab Jamahiriya','LBY',434),('MA','MOROCCO','Morocco','MAR',504),('MC','MONACO','Monaco','MCO',492),('MD','MOLDOVA, REPUBLIC OF','Moldova, Republic of','MDA',498),('MG','MADAGASCAR','Madagascar','MDG',450),('MH','MARSHALL ISLANDS','Marshall Islands','MHL',584),('MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','Macedonia, the Former Yugoslav Republic of','MKD',807),('ML','MALI','Mali','MLI',466),('MM','MYANMAR','Myanmar','MMR',104),('MN','MONGOLIA','Mongolia','MNG',496),('MO','MACAO','Macao','MAC',446),('MP','NORTHERN MARIANA ISLANDS','Northern Mariana Islands','MNP',580),('MQ','MARTINIQUE','Martinique','MTQ',474),('MR','MAURITANIA','Mauritania','MRT',478),('MS','MONTSERRAT','Montserrat','MSR',500),('MT','MALTA','Malta','MLT',470),('MU','MAURITIUS','Mauritius','MUS',480),('MV','MALDIVES','Maldives','MDV',462),('MW','MALAWI','Malawi','MWI',454),('MX','MEXICO','Mexico','MEX',484),('MY','MALAYSIA','Malaysia','MYS',458),('MZ','MOZAMBIQUE','Mozambique','MOZ',508),('NA','NAMIBIA','Namibia','NAM',516),('NC','NEW CALEDONIA','New Caledonia','NCL',540),('NE','NIGER','Niger','NER',562),('NF','NORFOLK ISLAND','Norfolk Island','NFK',574),('NG','NIGERIA','Nigeria','NGA',566),('NI','NICARAGUA','Nicaragua','NIC',558),('NL','NETHERLANDS','Netherlands','NLD',528),('NO','NORWAY','Norway','NOR',578),('NP','NEPAL','Nepal','NPL',524),('NR','NAURU','Nauru','NRU',520),('NU','NIUE','Niue','NIU',570),('NZ','NEW ZEALAND','New Zealand','NZL',554),('OM','OMAN','Oman','OMN',512),('PA','PANAMA','Panama','PAN',591),('PE','PERU','Peru','PER',604),('PF','FRENCH POLYNESIA','French Polynesia','PYF',258),('PG','PAPUA NEW GUINEA','Papua New Guinea','PNG',598),('PH','PHILIPPINES','Philippines','PHL',608),('PK','PAKISTAN','Pakistan','PAK',586),('PL','POLAND','Poland','POL',616),('PM','SAINT PIERRE AND MIQUELON','Saint Pierre and Miquelon','SPM',666),('PN','PITCAIRN','Pitcairn','PCN',612),('PR','PUERTO RICO','Puerto Rico','PRI',630),('PS','PALESTINIAN TERRITORY, OCCUPIED','Palestinian Territory, Occupied',NULL,NULL),('PT','PORTUGAL','Portugal','PRT',620),('PW','PALAU','Palau','PLW',585),('PY','PARAGUAY','Paraguay','PRY',600),('QA','QATAR','Qatar','QAT',634),('RE','REUNION','Reunion','REU',638),('RO','ROMANIA','Romania','ROM',642),('RU','RUSSIAN FEDERATION','Russian Federation','RUS',643),('RW','RWANDA','Rwanda','RWA',646),('SA','SAUDI ARABIA','Saudi Arabia','SAU',682),('SB','SOLOMON ISLANDS','Solomon Islands','SLB',90),('SC','SEYCHELLES','Seychelles','SYC',690),('SD','SUDAN','Sudan','SDN',736),('SE','SWEDEN','Sweden','SWE',752),('SG','SINGAPORE','Singapore','SGP',702),('SH','SAINT HELENA','Saint Helena','SHN',654),('SI','SLOVENIA','Slovenia','SVN',705),('SJ','SVALBARD AND JAN MAYEN','Svalbard and Jan Mayen','SJM',744),('SK','SLOVAKIA','Slovakia','SVK',703),('SL','SIERRA LEONE','Sierra Leone','SLE',694),('SM','SAN MARINO','San Marino','SMR',674),('SN','SENEGAL','Senegal','SEN',686),('SO','SOMALIA','Somalia','SOM',706),('SR','SURINAME','Suriname','SUR',740),('ST','SAO TOME AND PRINCIPE','Sao Tome and Principe','STP',678),('SV','EL SALVADOR','El Salvador','SLV',222),('SY','SYRIAN ARAB REPUBLIC','Syrian Arab Republic','SYR',760),('SZ','SWAZILAND','Swaziland','SWZ',748),('TC','TURKS AND CAICOS ISLANDS','Turks and Caicos Islands','TCA',796),('TD','CHAD','Chad','TCD',148),('TF','FRENCH SOUTHERN TERRITORIES','French Southern Territories',NULL,NULL),('TG','TOGO','Togo','TGO',768),('TH','THAILAND','Thailand','THA',764),('TJ','TAJIKISTAN','Tajikistan','TJK',762),('TK','TOKELAU','Tokelau','TKL',772),('TL','TIMOR-LESTE','Timor-Leste',NULL,NULL),('TM','TURKMENISTAN','Turkmenistan','TKM',795),('TN','TUNISIA','Tunisia','TUN',788),('TO','TONGA','Tonga','TON',776),('TR','TURKEY','Turkey','TUR',792),('TT','TRINIDAD AND TOBAGO','Trinidad and Tobago','TTO',780),('TV','TUVALU','Tuvalu','TUV',798),('TW','TAIWAN, PROVINCE OF CHINA','Taiwan, Province of China','TWN',158),('TZ','TANZANIA, UNITED REPUBLIC OF','Tanzania, United Republic of','TZA',834),('UA','UKRAINE','Ukraine','UKR',804),('UG','UGANDA','Uganda','UGA',800),('UM','UNITED STATES MINOR OUTLYING ISLANDS','United States Minor Outlying Islands',NULL,NULL),('US','UNITED STATES','United States','USA',840),('UY','URUGUAY','Uruguay','URY',858),('UZ','UZBEKISTAN','Uzbekistan','UZB',860),('VA','HOLY SEE (VATICAN CITY STATE)','Holy See (Vatican City State)','VAT',336),('VC','SAINT VINCENT AND THE GRENADINES','Saint Vincent and the Grenadines','VCT',670),('VE','VENEZUELA','Venezuela','VEN',862),('VG','VIRGIN ISLANDS, BRITISH','Virgin Islands, British','VGB',92),('VI','VIRGIN ISLANDS, U.S.','Virgin Islands, U.s.','VIR',850),('VN','VIET NAM','Viet Nam','VNM',704),('VU','VANUATU','Vanuatu','VUT',548),('WF','WALLIS AND FUTUNA','Wallis and Futuna','WLF',876),('WS','SAMOA','Samoa','WSM',882),('YE','YEMEN','Yemen','YEM',887),('YT','MAYOTTE','Mayotte',NULL,NULL),('ZA','SOUTH AFRICA','South Africa','ZAF',710),('ZM','ZAMBIA','Zambia','ZMB',894),('ZW','ZIMBABWE','Zimbabwe','ZWE',716);
/*!40000 ALTER TABLE `bf_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_email_queue`
--

DROP TABLE IF EXISTS `bf_email_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_email_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(128) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `alt_message` text,
  `max_attempts` int(11) NOT NULL DEFAULT '3',
  `attempts` int(11) NOT NULL DEFAULT '0',
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `date_published` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_email_queue`
--

LOCK TABLES `bf_email_queue` WRITE;
/*!40000 ALTER TABLE `bf_email_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `bf_email_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_login_attempts`
--

DROP TABLE IF EXISTS `bf_login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_login_attempts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `login` varchar(50) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_login_attempts`
--

LOCK TABLES `bf_login_attempts` WRITE;
/*!40000 ALTER TABLE `bf_login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bf_login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_permissions`
--

DROP TABLE IF EXISTS `bf_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_permissions`
--

LOCK TABLES `bf_permissions` WRITE;
/*!40000 ALTER TABLE `bf_permissions` DISABLE KEYS */;
INSERT INTO `bf_permissions` VALUES (2,'Site.Content.View','Allow users to view the Content Context','active'),(3,'Site.Reports.View','Allow users to view the Reports Context','active'),(4,'Site.Settings.View','Allow users to view the Settings Context','active'),(5,'Site.Developer.View','Allow users to view the Developer Context','active'),(6,'Bonfire.Roles.Manage','Allow users to manage the user Roles','active'),(7,'Bonfire.Users.Manage','Allow users to manage the site Users','active'),(8,'Bonfire.Users.View','Allow users access to the User Settings','active'),(9,'Bonfire.Users.Add','Allow users to add new Users','active'),(10,'Bonfire.Database.Manage','Allow users to manage the Database settings','active'),(11,'Bonfire.Emailer.Manage','Allow users to manage the Emailer settings','active'),(12,'Bonfire.Logs.View','Allow users access to the Log details','active'),(13,'Bonfire.Logs.Manage','Allow users to manage the Log files','active'),(14,'Bonfire.Emailer.View','Allow users access to the Emailer settings','active'),(15,'Site.Signin.Offline','Allow users to login to the site when the site is offline','active'),(16,'Bonfire.Permissions.View','Allow access to view the Permissions menu unders Settings Context','active'),(17,'Bonfire.Permissions.Manage','Allow access to manage the Permissions in the system','active'),(18,'Bonfire.Roles.Delete','Allow users to delete user Roles','active'),(19,'Bonfire.Modules.Add','Allow creation of modules with the builder.','active'),(20,'Bonfire.Modules.Delete','Allow deletion of modules.','active'),(21,'Permissions.Administrator.Manage','To manage the access control permissions for the Administrator role.','active'),(22,'Permissions.Editor.Manage','To manage the access control permissions for the Editor role.','active'),(24,'Permissions.User.Manage','To manage the access control permissions for the User role.','active'),(25,'Permissions.Developer.Manage','To manage the access control permissions for the Developer role.','active'),(27,'Activities.Own.View','To view the users own activity logs','active'),(28,'Activities.Own.Delete','To delete the users own activity logs','active'),(29,'Activities.User.View','To view the user activity logs','active'),(30,'Activities.User.Delete','To delete the user activity logs, except own','active'),(31,'Activities.Module.View','To view the module activity logs','active'),(32,'Activities.Module.Delete','To delete the module activity logs','active'),(33,'Activities.Date.View','To view the users own activity logs','active'),(34,'Activities.Date.Delete','To delete the dated activity logs','active'),(35,'Bonfire.UI.Manage','Manage the Bonfire UI settings','active'),(36,'Bonfire.Settings.View','To view the site settings page.','active'),(37,'Bonfire.Settings.Manage','To manage the site settings.','active'),(38,'Bonfire.Activities.View','To view the Activities menu.','active'),(39,'Bonfire.Database.View','To view the Database menu.','active'),(40,'Bonfire.Migrations.View','To view the Migrations menu.','active'),(41,'Bonfire.Builder.View','To view the Modulebuilder menu.','active'),(42,'Bonfire.Roles.View','To view the Roles menu.','active'),(43,'Bonfire.Sysinfo.View','To view the System Information page.','active'),(44,'Bonfire.Translate.Manage','To manage the Language Translation.','active'),(45,'Bonfire.Translate.View','To view the Language Translate menu.','active'),(46,'Bonfire.UI.View','To view the UI/Keyboard Shortcut menu.','active'),(49,'Bonfire.Profiler.View','To view the Console Profiler Bar.','active'),(50,'Bonfire.Roles.Add','To add New Roles','active'),(168,'Planner.User_accounts.View_users','Can the settings.','active'),(169,'Planner.User_accounts.Manage_users','Can view user settings front end.','active'),(170,'Planner.User_accounts.Create_users','Can create new user front end.','active'),(171,'Planner.User_accounts.Edit_users','Can edit user details front end.','active'),(172,'Planner.User_accounts.Deactivate_users','Can delete users and user settings front end.','active'),(173,'Permissions.Manager.Manage','To manage the access control permissions for the Manager role.','active'),(174,'Permissions.Planning_Coordinator.Manage','To manage the access control permissions for the Planning_Coordinator role.','active'),(175,'Planner.Mappings.View','Access to counties and sub-counties managmement page.','active'),(176,'Planner.Job_types.Edit','Editing and adding of Counties.','active'),(177,'Planner.Job_areas.Edit','Editing and adding of sub-counties.','active'),(178,'Planner.Job_lines.Edit','Editing and adding of sub-counties.','active'),(179,'Planner.Planner_calendar.View','View only rights to the calendar schedule.','active'),(180,'Planner.Planner_calendar.Create_schedule','Create a new calendar schedule.','active'),(181,'Planner.Planner_calendar.Update_schedule_status','Update status of a calendar schedule.','active'),(182,'Planner.Planner_calendar.Delete_schedule','Delete/remove existing calendar schedules .','active');
/*!40000 ALTER TABLE `bf_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_role_permissions`
--

DROP TABLE IF EXISTS `bf_role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_role_permissions`
--

LOCK TABLES `bf_role_permissions` WRITE;
/*!40000 ALTER TABLE `bf_role_permissions` DISABLE KEYS */;
INSERT INTO `bf_role_permissions` VALUES (1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,24),(1,25),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(1,45),(1,46),(1,49),(1,50),(1,168),(1,169),(1,170),(1,171),(1,172),(1,173),(1,174),(1,175),(1,176),(1,177),(1,178),(1,179),(1,180),(1,181),(1,182),(2,2),(2,3),(6,2),(6,3),(6,4),(6,5),(6,7),(6,8),(6,9),(6,10),(6,11),(6,12),(6,13),(6,14),(6,27),(6,29),(6,39),(6,42),(6,49),(6,50),(6,168),(6,169),(6,170),(6,171),(6,172),(12,168),(12,169),(12,170),(12,171),(12,172),(12,175),(12,176),(12,177),(12,178);
/*!40000 ALTER TABLE `bf_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_roles`
--

DROP TABLE IF EXISTS `bf_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(60) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1',
  `login_destination` varchar(255) NOT NULL DEFAULT '/',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `default_context` varchar(255) NOT NULL DEFAULT 'content',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_roles`
--

LOCK TABLES `bf_roles` WRITE;
/*!40000 ALTER TABLE `bf_roles` DISABLE KEYS */;
INSERT INTO `bf_roles` VALUES (1,'Administrator','Has full control over every aspect of the site.',0,0,'',0,'content'),(2,'Editor','Can handle day-to-day management, but does not have full power.',0,1,'',0,'content'),(4,'User','This is the default user with access to login.',1,0,'',0,'content'),(6,'Developer','Developers typically are the only ones that can access the developer tools. Otherwise identical to Administrators, at least until the site is handed off.',0,1,'',0,'content'),(12,'Manager','Plant Manager',0,1,'planner',0,'content'),(13,'Planning_Coordinator','Coordinates the planning and scheduling of production and manufacturing lines',0,1,'planner',0,'content');
/*!40000 ALTER TABLE `bf_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_routes`
--

DROP TABLE IF EXISTS `bf_routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_name` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_routes`
--

LOCK TABLES `bf_routes` WRITE;
/*!40000 ALTER TABLE `bf_routes` DISABLE KEYS */;
/*!40000 ALTER TABLE `bf_routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_schema_version`
--

DROP TABLE IF EXISTS `bf_schema_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_schema_version` (
  `type` varchar(40) NOT NULL,
  `version` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_schema_version`
--

LOCK TABLES `bf_schema_version` WRITE;
/*!40000 ALTER TABLE `bf_schema_version` DISABLE KEYS */;
INSERT INTO `bf_schema_version` VALUES ('accounts_',1),('core',37),('documentation_',1),('employee_fund_',1),('finance_',1),('maintenance_',1),('mapping_',1),('new_vehicle_',1),('planner_',1),('report_',1),('search_',1),('setting_',3),('transactions_',1),('user_accounts_',1);
/*!40000 ALTER TABLE `bf_schema_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_sessions`
--

DROP TABLE IF EXISTS `bf_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_sessions`
--

LOCK TABLES `bf_sessions` WRITE;
/*!40000 ALTER TABLE `bf_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `bf_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_settings`
--

DROP TABLE IF EXISTS `bf_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_settings` (
  `name` varchar(30) NOT NULL,
  `module` varchar(50) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_settings`
--

LOCK TABLES `bf_settings` WRITE;
/*!40000 ALTER TABLE `bf_settings` DISABLE KEYS */;
INSERT INTO `bf_settings` VALUES ('auth.allow_name_change','core','1'),('auth.allow_register','core','1'),('auth.allow_remember','core','0'),('auth.do_login_redirect','core','1'),('auth.login_type','core','both'),('auth.name_change_frequency','core','1'),('auth.name_change_limit','core','1'),('auth.password_force_mixed_case','core','0'),('auth.password_force_numbers','core','0'),('auth.password_force_symbols','core','0'),('auth.password_min_length','core','6'),('auth.password_show_labels','core','0'),('auth.remember_length','core','1209600'),('auth.user_activation_method','core','0'),('auth.use_extended_profile','core','0'),('auth.use_usernames','core','1'),('ext.country','core','KE'),('ext.state','core','CA'),('ext.street_name','core','Nairobi'),('ext.type','core','small'),('form_save','core.ui','ctrl+s/⌘+s'),('goto_content','core.ui','alt+c'),('mailpath','email','/usr/sbin/sendmail'),('mailtype','email','html'),('password_iterations','users','2'),('protocol','email','smtp'),('sender_email','email','info@microvision.co.ke'),('site.languages','core','a:1:{i:0;s:7:\"english\";}'),('site.list_limit','core','25'),('site.show_front_profiler','core','0'),('site.show_profiler','core','0'),('site.status','core','1'),('site.system_email','core','info@microvision.co.ke'),('site.title','core','TRT Manufacturing Planner'),('smtp_host','email','mail.microvision.co.ke'),('smtp_pass','email','P@ssw0rd@1234'),('smtp_port','email','587'),('smtp_timeout','email','60'),('smtp_user','email','info@microvision.co.ke'),('updates.bleeding_edge','core','0'),('updates.do_check','core','0');
/*!40000 ALTER TABLE `bf_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_states`
--

DROP TABLE IF EXISTS `bf_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `abbrev` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_states`
--

LOCK TABLES `bf_states` WRITE;
/*!40000 ALTER TABLE `bf_states` DISABLE KEYS */;
INSERT INTO `bf_states` VALUES (1,'Alaska','AK'),(2,'Alabama','AL'),(3,'American Samoa','AS'),(4,'Arizona','AZ'),(5,'Arkansas','AR'),(6,'California','CA'),(7,'Colorado','CO'),(8,'Connecticut','CT'),(9,'Delaware','DE'),(10,'District of Columbia','DC'),(11,'Florida','FL'),(12,'Georgia','GA'),(13,'Guam','GU'),(14,'Hawaii','HI'),(15,'Idaho','ID'),(16,'Illinois','IL'),(17,'Indiana','IN'),(18,'Iowa','IA'),(19,'Kansas','KS'),(20,'Kentucky','KY'),(21,'Louisiana','LA'),(22,'Maine','ME'),(23,'Marshall Islands','MH'),(24,'Maryland','MD'),(25,'Massachusetts','MA'),(26,'Michigan','MI'),(27,'Minnesota','MN'),(28,'Mississippi','MS'),(29,'Missouri','MO'),(30,'Montana','MT'),(31,'Nebraska','NE'),(32,'Nevada','NV'),(33,'New Hampshire','NH'),(34,'New Jersey','NJ'),(35,'New Mexico','NM'),(36,'New York','NY'),(37,'North Carolina','NC'),(38,'North Dakota','ND'),(39,'Northern Mariana Islands','MP'),(40,'Ohio','OH'),(41,'Oklahoma','OK'),(42,'Oregon','OR'),(43,'Palau','PW'),(44,'Pennsylvania','PA'),(45,'Puerto Rico','PR'),(46,'Rhode Island','RI'),(47,'South Carolina','SC'),(48,'South Dakota','SD'),(49,'Tennessee','TN'),(50,'Texas','TX'),(51,'Utah','UT'),(52,'Vermont','VT'),(53,'Virgin Islands','VI'),(54,'Virginia','VA'),(55,'Washington','WA'),(56,'West Virginia','WV'),(57,'Wisconsin','WI'),(58,'Wyoming','WY'),(59,'Armed Forces Africa','AE'),(60,'Armed Forces Canada','AE'),(61,'Armed Forces Europe','AE'),(62,'Armed Forces Middle East','AE'),(63,'Armed Forces Pacific','AP');
/*!40000 ALTER TABLE `bf_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_user_cookies`
--

DROP TABLE IF EXISTS `bf_user_cookies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_user_cookies` (
  `user_id` bigint(20) NOT NULL,
  `token` varchar(128) NOT NULL,
  `created_on` datetime NOT NULL,
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_user_cookies`
--

LOCK TABLES `bf_user_cookies` WRITE;
/*!40000 ALTER TABLE `bf_user_cookies` DISABLE KEYS */;
/*!40000 ALTER TABLE `bf_user_cookies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_user_meta`
--

DROP TABLE IF EXISTS `bf_user_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_user_meta` (
  `meta_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL DEFAULT '',
  `meta_value` text,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_user_meta`
--

LOCK TABLES `bf_user_meta` WRITE;
/*!40000 ALTER TABLE `bf_user_meta` DISABLE KEYS */;
INSERT INTO `bf_user_meta` VALUES (1,1,'street_name',''),(2,1,'state','SC'),(3,1,'country','US'),(4,1,'type','small'),(5,4,'street_name','Nanyuki'),(6,4,'state','SC'),(7,4,'country','KE'),(8,4,'type','small'),(9,6,'street_name','Nanyuki'),(10,6,'state','AK'),(11,6,'country','KE'),(12,102,'street_name','Nairobi'),(13,102,'state','SC'),(14,102,'country','KE'),(15,102,'type','small');
/*!40000 ALTER TABLE `bf_user_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_users`
--

DROP TABLE IF EXISTS `bf_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '4',
  `email` varchar(120) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `phone` varchar(30) DEFAULT NULL,
  `password_hash` char(60) NOT NULL,
  `reset_hash` varchar(40) DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(40) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `reset_by` int(10) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_message` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` char(4) NOT NULL DEFAULT 'UM6',
  `language` varchar(20) NOT NULL DEFAULT 'english',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `password_iterations` int(4) NOT NULL,
  `force_password_reset` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_users`
--

LOCK TABLES `bf_users` WRITE;
/*!40000 ALTER TABLE `bf_users` DISABLE KEYS */;
INSERT INTO `bf_users` VALUES (1,1,'info@microvision.co.ke','admin','0724858611','$2a$08$LRFJIzEtYGNA0Ry5zN6pT.jR5m/CZGBUeBptm/SR2a8PLuewhC75O',NULL,'2024-06-09 06:20:16','::1','2015-02-19 14:44:05',0,NULL,0,NULL,'System Administrator',NULL,'UP3','english',1,'',0,0),(230,12,'ombego@gmail.com','Manager','+254738055311','$2a$08$uFyDDHPjMQQeD7m.A8KLueijj6h5DwrsPQ/SM8rLu7xsXO5JsZ7ni',NULL,'0000-00-00 00:00:00','','0000-00-00 00:00:00',0,NULL,0,NULL,'Test Manager',NULL,'UP3','English',1,'',2,1);
/*!40000 ALTER TABLE `bf_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_vision_job_areas`
--

DROP TABLE IF EXISTS `bf_vision_job_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_vision_job_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_type_id` int(11) NOT NULL,
  `job_area_name` tinytext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bf_vision_job_area_bf_vision_job_types_id_fk` (`job_type_id`),
  CONSTRAINT `bf_vision_job_area_bf_vision_job_types_id_fk` FOREIGN KEY (`job_type_id`) REFERENCES `bf_vision_job_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_vision_job_areas`
--

LOCK TABLES `bf_vision_job_areas` WRITE;
/*!40000 ALTER TABLE `bf_vision_job_areas` DISABLE KEYS */;
INSERT INTO `bf_vision_job_areas` VALUES (1,2,'Home Care (Area 1)',1,1,'2024-06-06 07:34:00',1,'2024-06-06 07:36:39'),(2,2,'Home Care (Area 2)',1,1,'2024-06-06 07:45:34',NULL,NULL),(3,2,'Aerosal (Area 1)',1,1,'2024-06-06 07:45:56',NULL,NULL),(4,2,'Personal Care (Area 1)',1,1,'2024-06-06 07:46:34',NULL,NULL),(5,2,'Personal Care (Area 2)',1,1,'2024-06-06 07:47:00',NULL,NULL),(6,1,'Home Care (Area 1)',1,1,'2024-06-06 07:48:50',NULL,NULL),(7,1,'Aerosal 2 (Area 4)',1,1,'2024-06-06 07:49:36',NULL,NULL),(8,1,'Aerosal 1 (Area 3)',1,1,'2024-06-06 07:50:00',NULL,NULL),(9,1,'Personal Care (Area 2)',1,1,'2024-06-06 07:50:18',NULL,NULL),(10,1,'Personal Care (Area 1)',1,1,'2024-06-06 07:51:05',NULL,NULL);
/*!40000 ALTER TABLE `bf_vision_job_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_vision_job_lines`
--

DROP TABLE IF EXISTS `bf_vision_job_lines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_vision_job_lines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_area_id` int(11) NOT NULL,
  `line_name` tinytext NOT NULL,
  `capacity` varchar(255) DEFAULT NULL,
  `description` tinytext,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bf_vision_job_lines_bf_vision_job_area_id_fk` (`job_area_id`),
  CONSTRAINT `bf_vision_job_lines_bf_vision_job_area_id_fk` FOREIGN KEY (`job_area_id`) REFERENCES `bf_vision_job_areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_vision_job_lines`
--

LOCK TABLES `bf_vision_job_lines` WRITE;
/*!40000 ALTER TABLE `bf_vision_job_lines` DISABLE KEYS */;
INSERT INTO `bf_vision_job_lines` VALUES (1,2,'B1','',NULL,1,1,'2024-06-06 10:33:26',NULL,NULL),(2,6,'L2','3,000Kg',NULL,1,1,'2024-06-06 10:37:37',NULL,NULL),(3,2,'B2','',NULL,1,1,'2024-06-06 10:40:49',NULL,NULL),(4,1,'H1','',NULL,1,1,'2024-06-06 10:41:15',NULL,NULL),(5,1,'H2','',NULL,1,1,'2024-06-06 10:41:26',NULL,NULL),(6,1,'H3','',NULL,1,1,'2024-06-06 10:41:39',NULL,NULL),(7,1,'H4','',NULL,1,1,'2024-06-06 10:41:49',NULL,NULL),(8,6,'L3','3,000Kg',NULL,1,1,'2024-06-06 10:42:38',NULL,NULL),(9,6,'L13','6,000Kg',NULL,1,1,'2024-06-06 10:42:58',NULL,NULL),(10,6,'L14','6,000Kg',NULL,1,1,'2024-06-06 10:43:29',NULL,NULL),(11,7,'TK4','1,000Kg',NULL,1,1,'2024-06-06 10:44:09',NULL,NULL),(12,7,'TK5','2,500Kg',NULL,1,1,'2024-06-06 10:44:36',NULL,NULL),(13,7,'TK6','2,500Kg',NULL,1,1,'2024-06-06 10:45:00',NULL,NULL),(14,7,'TK7','10,000Kg',NULL,1,1,'2024-06-06 10:45:27',NULL,NULL),(15,7,'TK8','10,000Kg',NULL,1,1,'2024-06-06 10:45:56',NULL,NULL),(16,7,'TK2B','150Kg',NULL,1,1,'2024-06-06 10:46:16',NULL,NULL);
/*!40000 ALTER TABLE `bf_vision_job_lines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_vision_job_types`
--

DROP TABLE IF EXISTS `bf_vision_job_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_vision_job_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_type_name` tinytext NOT NULL,
  `symbol` tinytext,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_vision_job_types`
--

LOCK TABLES `bf_vision_job_types` WRITE;
/*!40000 ALTER TABLE `bf_vision_job_types` DISABLE KEYS */;
INSERT INTO `bf_vision_job_types` VALUES (1,'Production (Bulk)','Bulk',1,1,'2024-06-06 07:23:19',NULL,NULL),(2,'Manufacturing (Pack)','Pack',1,1,'2024-06-06 07:24:02',1,'2024-06-06 07:24:44');
/*!40000 ALTER TABLE `bf_vision_job_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_vision_schedule_jobs`
--

DROP TABLE IF EXISTS `bf_vision_schedule_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_vision_schedule_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_number` varchar(50) NOT NULL,
  `capacity` varchar(50) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_vision_schedule_jobs`
--

LOCK TABLES `bf_vision_schedule_jobs` WRITE;
/*!40000 ALTER TABLE `bf_vision_schedule_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bf_vision_schedule_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_vision_schedule_logs`
--

DROP TABLE IF EXISTS `bf_vision_schedule_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_vision_schedule_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_id` int(11) NOT NULL,
  `schedule_status` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bf_vision_schedule_logs_bf_vision_schedule_status_id_fk` (`schedule_status`),
  KEY `bf_vision_schedule_logs_bf_vision_schedules_id_fk` (`schedule_id`),
  CONSTRAINT `bf_vision_schedule_logs_bf_vision_schedule_status_id_fk` FOREIGN KEY (`schedule_status`) REFERENCES `bf_vision_schedule_status` (`id`),
  CONSTRAINT `bf_vision_schedule_logs_bf_vision_schedules_id_fk` FOREIGN KEY (`schedule_id`) REFERENCES `bf_vision_schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_vision_schedule_logs`
--

LOCK TABLES `bf_vision_schedule_logs` WRITE;
/*!40000 ALTER TABLE `bf_vision_schedule_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bf_vision_schedule_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_vision_schedule_status`
--

DROP TABLE IF EXISTS `bf_vision_schedule_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_vision_schedule_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_type_id` int(11) DEFAULT NULL,
  `schedule_status` tinytext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `bf_vision_schedule_status_bf_vision_job_types_id_fk` (`job_type_id`),
  CONSTRAINT `bf_vision_schedule_status_bf_vision_job_types_id_fk` FOREIGN KEY (`job_type_id`) REFERENCES `bf_vision_job_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_vision_schedule_status`
--

LOCK TABLES `bf_vision_schedule_status` WRITE;
/*!40000 ALTER TABLE `bf_vision_schedule_status` DISABLE KEYS */;
INSERT INTO `bf_vision_schedule_status` VALUES (1,1,'Dispensed',1),(2,1,'In Progress',1),(3,1,'Complete',1),(4,1,'On Hold',1),(5,2,'Picked',1),(6,2,'Online',1),(7,2,'Complete',1),(8,2,'On Hold',1);
/*!40000 ALTER TABLE `bf_vision_schedule_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_vision_schedules`
--

DROP TABLE IF EXISTS `bf_vision_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_vision_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_job_id` int(11) NOT NULL,
  `job_line_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `capacity` varchar(100) DEFAULT NULL,
  `comments` tinytext,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `deleated` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bf_vision_schedules_bf_vision_job_lines_id_fk` (`job_line_id`),
  KEY `bf_vision_schedules_bf_vision_shifts_id_fk` (`shift_id`),
  KEY `bf_vision_schedules_bf_vision_schedule_status_id_fk` (`status`),
  KEY `bf_vision_schedules_bf_vision_schedule_jobs_id_fk` (`schedule_job_id`),
  CONSTRAINT `bf_vision_schedules_bf_vision_job_lines_id_fk` FOREIGN KEY (`job_line_id`) REFERENCES `bf_vision_job_lines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bf_vision_schedules_bf_vision_schedule_jobs_id_fk` FOREIGN KEY (`schedule_job_id`) REFERENCES `bf_vision_schedule_jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bf_vision_schedules_bf_vision_schedule_status_id_fk` FOREIGN KEY (`status`) REFERENCES `bf_vision_schedule_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bf_vision_schedules_bf_vision_shifts_id_fk` FOREIGN KEY (`shift_id`) REFERENCES `bf_vision_shifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_vision_schedules`
--

LOCK TABLES `bf_vision_schedules` WRITE;
/*!40000 ALTER TABLE `bf_vision_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `bf_vision_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bf_vision_shifts`
--

DROP TABLE IF EXISTS `bf_vision_shifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bf_vision_shifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shift_name` tinytext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bf_vision_shifts`
--

LOCK TABLES `bf_vision_shifts` WRITE;
/*!40000 ALTER TABLE `bf_vision_shifts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bf_vision_shifts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-09 10:13:49
