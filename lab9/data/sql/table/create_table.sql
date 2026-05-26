CREATE TABLE `blog`.`user` (
  `id_user` int unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_surname` varchar(50) NOT NULL,
  `user_description` varchar(90) DEFAULT NULL,
  `user_image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) 


CREATE TABLE `blog`.`post` (
  `id_post` int unsigned NOT NULL AUTO_INCREMENT,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int unsigned NOT NULL,
  `post_image` varchar(100) NOT NULL,
  `post_description` varchar(100) DEFAULT NULL,
  `post_likes` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`),
  KEY `user_post_idx` (`id_user`),
  CONSTRAINT `post_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
)
