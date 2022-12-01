DROP TABLE IF EXISTS `totem_users`;
CREATE TABLE `totem_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `cellphone` varchar(11) NOT NULL,
  `aauth_user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`aauth_user_id`) REFERENCES aauth_users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
