CREATE TABLE IF NOT EXISTS `wp_game` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`token`  varchar(255) NOT NULL  COMMENT 'Token',
`cTime`  int(10) NOT NULL  COMMENT '创建时间',
`title`  varchar(255) NOT NULL  COMMENT '游戏名',
`desc`  text NOT NULL  COMMENT '游戏玩法',
`cover`  int(10) UNSIGNED NOT NULL  COMMENT '游戏封面',
`url`  varchar(255) NOT NULL  COMMENT '游戏地址',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_game` (`id`,`token`,`cTime`,`title`,`desc`,`cover`,`url`) VALUES ('1','gh_a16860f75a5c','1407672510','最强眼力','试试看你的眼力有多强','389','http://1.chinspro.sinaapp.com/%E6%9C%80%E5%BC%BA%E7%9C%BC%E5%8A%9B/index.html');
INSERT INTO `wp_game` (`id`,`token`,`cTime`,`title`,`desc`,`cover`,`url`) VALUES ('2','gh_a16860f75a5c','1407672835','危险游戏','','390','http://m.edianyou.com/h5game/Danger%20Ranger.html#rd');
INSERT INTO `wp_game` (`id`,`token`,`cTime`,`title`,`desc`,`cover`,`url`) VALUES ('3','gh_a16860f75a5c','1407673241','一个都不能死','','391','http://run.app100725914.twsapp.com/index.php?openid=1A5127D7691F6098331D7D0D8F9BBE2E&openkey=5B50BCB');
INSERT INTO `wp_game` (`id`,`token`,`cTime`,`title`,`desc`,`cover`,`url`) VALUES ('4','gh_a16860f75a5c','1407673709','围住神经猫','','392','http://u.ali213.net/games/shenjingcat/index.html?game_code=196&bs=wx');
INSERT INTO `wp_game` (`id`,`token`,`cTime`,`title`,`desc`,`cover`,`url`) VALUES ('5','gh_a16860f75a5c','1407674113','2048','','393','http://gabrielecirulli.github.io/2048/');
INSERT INTO `wp_game` (`id`,`token`,`cTime`,`title`,`desc`,`cover`,`url`) VALUES ('6','gh_a16860f75a5c','1407674457','八戒吃月饼','','394','http://www.hlo.cc/weixin/bajieyb/');
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) VALUES ('game','微信游戏表','0','','1','{"1":["title","desc","cover","url"]}','1:基础','','','','','title:游戏名称\r\ndesc:游戏玩法\r\nurl:游戏地址\r\ncTime|time_format:创建时间\r\nid:操作:[EDIT]&id=[id]|编辑,[DELETE]&id=[id]|删除','10','title','','1407671489','1407671877','1','MyISAM');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('token','Token','varchar(255) NOT NULL','string','','','0','','0','0','1','1407671573','1407671573','','3','','regex','get_token','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('cTime','创建时间','int(10) NOT NULL','datetime','','','0','','0','0','1','1407671619','1407671619','','3','','regex','time','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('title','游戏名','varchar(255) NOT NULL','string','','','1','','0','0','1','1407671644','1407671644','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('desc','游戏玩法','text NOT NULL','textarea','','','1','','0','0','1','1407671692','1407671692','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('cover','游戏封面','int(10) UNSIGNED NOT NULL','picture','','','1','','0','0','1','1407671721','1407671721','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('url','游戏地址','varchar(255) NOT NULL','string','','','1','','0','0','1','1407671744','1407671744','','3','','regex','','3','function');
UPDATE `wp_attribute` SET model_id= (SELECT MAX(id) FROM `wp_model`) WHERE model_id=0;