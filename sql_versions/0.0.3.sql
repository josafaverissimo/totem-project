DROP TABLE IF EXISTS `totem_clients`;
CREATE TABLE `totem_clients` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `cpf` varchar(11) NOT NULL,
    `cellphone` varchar(11) NOT NULL,
    `cep` varchar(100) NOT NULL,
    `state` varchar(2) NOT NULL,
    `city` varchar(100) NOT NULL,
    `address` varchar(100) NOT NULL,
    `neighborhood` varchar(100) NOT NULL,
    `number` varchar(10) NOT NULL,
    `hash` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
