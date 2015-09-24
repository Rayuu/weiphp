DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='laf_things' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='laf_things' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_laf_things`;

DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='laf_user' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='laf_user' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_laf_user`;

DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='laf_things' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='laf_things' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_laf_things`;