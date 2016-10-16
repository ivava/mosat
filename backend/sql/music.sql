CREATE TABLE `music` (
`id` int(11) NOT NULL auto_increment,
`user_id` int(11) collate utf8_unicode_ci NOT NULL default '',
`title` varchar(32) collate utf8_unicode_ci NOT NULL default '',
`path` varchar(20) collate utf8_unicode_ci NOT NULL default '',
`start` int(11) collate utf8_unicode_ci NOT NULL default '',
`end` int(11) collate utf8_unicode_ci NOT NULL default '',
PRIMARY KEY  (`id`),
UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;