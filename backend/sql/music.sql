CREATE TABLE `music` (
`id` int(11) NOT NULL auto_increment,
`user_id` int(11) collate utf8_unicode_ci NOT NULL,
`title` varchar(32) collate utf8_unicode_ci NOT NULL default '',
`path` varchar(128) collate utf8_unicode_ci NOT NULL default '',
`start` int(11) collate utf8_unicode_ci NOT NULL,
`end` int(11) collate utf8_unicode_ci NOT NULL,
`thumb` VARCHAR (64) collate utf8_unicode_ci NOT NULL default '',
`author` VARCHAR (32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
`like_count` INT (128) COLLATE utf8_unicode_ci NOT NULL DEFAULT 0,
PRIMARY KEY  (`id`),
UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



