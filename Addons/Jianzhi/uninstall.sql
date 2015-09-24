DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='jianzhi' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='jianzhi' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_jianzhi`;

DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='jianzhi_comment' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='jianzhi_comment' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_jianzhi_comment`;
