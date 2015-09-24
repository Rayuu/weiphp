DELETE from wp_keyword where addon='Dg' and keyword='点歌';


INSERT INTO `wp_keyword` (`keyword`, `token`, `addon`, `aim_id`, `cTime`, `keyword_length`, `keyword_type`, `extra_text`, `extra_int`, `request_count`) VALUES ( '点歌', '0', 'Dg', '', '1406330808', '6', '1', '', '0', '0');

UPDATE `wp_keyword` SET aim_id= (SELECT MAX(id) FROM `wp_dg`) where addon='Dg' and keyword='点歌';
