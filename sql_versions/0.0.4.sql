DROP TABLE IF EXISTS `totem_events_categories`;
CREATE TABLE `totem_events_categories` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `hash` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `totem_events`;
CREATE TABLE `totem_events` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `events_category_id` int(11) UNSIGNED NOT NULL,
    `background_path` varchar(500) NOT NULL,
    `active` char(1) NOT NULL,
    `hash` varchar(100) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`events_category_id`) REFERENCES `totem_events_categories`(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `totem_events_clients`;
CREATE TABLE `totem_events_clients` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `event_id` int(11) UNSIGNED NOT NULL,
    `client_id` int(11) UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`event_id`) REFERENCES `totem_events`(id),
    FOREIGN KEY (`client_id`) REFERENCES `totem_clients`(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
