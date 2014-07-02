<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$installer->getTable('advancedslider_sliders')};
CREATE TABLE IF NOT EXISTS {$installer->getTable('advancedslider_sliders')} (
    `slider_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL DEFAULT '',
    `width` smallint(4) unsigned NOT NULL DEFAULT '500',
    `height` smallint(4) unsigned NOT NULL DEFAULT '500',
    `style` varchar(255) NOT NULL DEFAULT 'standart',
    `style_options` text NOT NULL,
    `link_target` varchar(10) NOT NULL DEFAULT '',
    `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
    `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`slider_id`),
    KEY `status` (`status`),
    KEY `style` (`style`),
    KEY `name` (`name`),
    KEY `width` (`width`),
    KEY `height` (`height`),
    KEY `link_target` (`link_target`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- DROP TABLE IF EXISTS {$installer->getTable('advancedslider_slides')};
CREATE TABLE IF NOT EXISTS {$installer->getTable('advancedslider_slides')} (
    `slide_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `slider_id` int(10) unsigned NOT NULL,
    `sort_order` tinyint(4) NOT NULL DEFAULT '0',
    `title` varchar(255) NOT NULL DEFAULT '',
    `link` varchar(255) NOT NULL DEFAULT '',
    `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
    `image` varchar(255) NOT NULL DEFAULT '',
    `html` text NOT NULL,
    `style_options` text NOT NULL,
    `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
    `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`slide_id`),
    KEY `status` (`status`),
    KEY `slider_id` (`slider_id`),
    KEY `sort_order` (`sort_order`),
    KEY `title` (`title`),
    KEY `link` (`link`),
    KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


ALTER TABLE {$installer->getTable('advancedslider_slides')}
    ADD CONSTRAINT `advancedslider_slides_ibfk_1` FOREIGN KEY (`slider_id`) REFERENCES {$installer->getTable('advancedslider_sliders')} (`slider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

    ");

$installer->endSetup();
