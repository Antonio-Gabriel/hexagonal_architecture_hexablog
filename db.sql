CREATE DATABASE `blog`
USE `blog`

CREATE TABLE
  `post` (
    `id` varchar(255) NOT NULL,
    `title` varchar(80) NOT NULL,
    `content` text DEFAULT NULL,
    `publishedAt` datetime NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8