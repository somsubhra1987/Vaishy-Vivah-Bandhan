-- --------------------------------------------------------

--
-- Table structure for table `cms_block`
--

CREATE TABLE IF NOT EXISTS `cms_block` (
`blockID` bigint(20) NOT NULL,
  `blockCode` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cms_block_display`
--

CREATE TABLE IF NOT EXISTS `cms_block_display` (
`blockDisplayID` bigint(20) NOT NULL,
  `blockID` bigint(20) NOT NULL,
  `pageTypeID` int(11) NOT NULL,
  `pageID` bigint(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE IF NOT EXISTS `cms_page` (
`pageID` bigint(20) NOT NULL,
  `pageTypeID` int(11) NOT NULL,
  `templateDir` varchar(100) NOT NULL,
  `pageName` varchar(100) NOT NULL,
  `friendlyName` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `refTable` varchar(50) DEFAULT NULL,
  `refID` bigint(20) DEFAULT NULL,
  `seoTitle` varchar(255) NOT NULL,
  `seoDescription` text NOT NULL,
  `seoKeyword` text NOT NULL,
  `seoH1Headline` varchar(255) NOT NULL,
  `extraHeader` text NOT NULL,
  `altTag` varchar(100) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `lastSeoUpdateOn` datetime NOT NULL,
  `lastContentUpdateOn` datetime NOT NULL,
  `showInSitemap` tinyint(1) NOT NULL DEFAULT '1',
  `sitemapPriority` enum('0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0') NOT NULL DEFAULT '0.5',
  `sitemapChangeFreq` enum('hourly','daily','weekly','monthly','yearly','never') NOT NULL DEFAULT 'monthly',
  `listingOrder` decimal(10,2) NOT NULL DEFAULT '99.00',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms_page_type`
--

CREATE TABLE IF NOT EXISTS `cms_page_type` (
`pageTypeID` int(11) NOT NULL,
  `pageTypeCode` varchar(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `folderName` varchar(50) NOT NULL,
  `listingOrder` int(11) NOT NULL,
  `showInSitemap` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_block`
--
ALTER TABLE `cms_block`
 ADD PRIMARY KEY (`blockID`), ADD UNIQUE KEY `blockCode` (`blockCode`);

--
-- Indexes for table `cms_block_display`
--
ALTER TABLE `cms_block_display`
 ADD PRIMARY KEY (`blockDisplayID`), ADD UNIQUE KEY `blockID` (`blockID`,`pageTypeID`,`pageID`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
 ADD PRIMARY KEY (`pageID`), ADD UNIQUE KEY `pageName` (`pageName`,`pageTypeID`), ADD UNIQUE KEY `refID` (`refTable`,`refID`);

--
-- Indexes for table `cms_page_type`
--
ALTER TABLE `cms_page_type`
 ADD PRIMARY KEY (`pageTypeID`), ADD UNIQUE KEY `pageTypeCode` (`pageTypeCode`), ADD UNIQUE KEY `title` (`title`), ADD UNIQUE KEY `folderName` (`folderName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_block`
--
ALTER TABLE `cms_block`
MODIFY `blockID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cms_block_display`
--
ALTER TABLE `cms_block_display`
MODIFY `blockDisplayID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
MODIFY `pageID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cms_page_type`
--
ALTER TABLE `cms_page_type`
MODIFY `pageTypeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;