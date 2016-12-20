CREATE TABLE `usertbl` (
`id` int(11) NOT NULL auto_increment,
`full_name` varchar(32) collate utf8_unicode_ci NOT NULL default '',
`email` varchar(32) collate utf8_unicode_ci NOT NULL default '',
`username` varchar(20) collate utf8_unicode_ci NOT NULL default '',
`password` varchar(32) collate utf8_unicode_ci NOT NULL default '',
`avatar` varchar(64) collate utf8_unicode_ci NOT NULL default '',
`friend_list` varchar(128) collate utf8_unicode_ci NOT NULL default '',
`bio` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
`follower` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
`mosat_like` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
PRIMARY KEY  (`id`),
UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




