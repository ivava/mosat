CREATE TABLE `comment` (
`id` int(11) NOT NULL auto_increment,
`author` varchar(32) collate utf8_unicode_ci NOT NULL default '',
`content` varchar(256) collate utf8_unicode_ci NOT NULL default '',
`music_id` INT collate utf8_unicode_ci NOT NULL,
PRIMARY KEY  (`id`),
UNIQUE KEY `author` (`author`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;