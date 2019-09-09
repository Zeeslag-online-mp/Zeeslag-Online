CREATE DATABASE `zeeslag`;

USE `zeeslag`;

CREATE TABLE `users` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
    `email` VARCHAR(100),
    `username` VARCHAR(50),
    `password` VARCHAR(255)
);

CREATE TABLE `friends` (
	`user_1` int(11),
	`user_2` int(11),
	KEY `user_1` (`user_1`),
	KEY `user_2` (`user_2`),
	CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_1`) REFERENCES `users` (`id`),
	CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`user_2`) REFERENCES `users` (`id`)
);

CREATE TABLE `game_request` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
	`send_from` INT,
    `send_to` INT,
    FOREIGN KEY (`send_from`) REFERENCES `users`(`id`),
    FOREIGN KEY (`send_to`) REFERENCES `users`(`id`)
);

CREATE TABLE `games` (
	`id` int PRIMARY KEY AUTO_INCREMENT,
    `player_1_id` int,
    `player_2_id` int,
    `gamefase` tinyint,
    FOREIGN KEY (`player_1_id`) REFERENCES `users`(`id`),
    FOREIGN KEY (`player_2_id`) REFERENCES `users`(`id`)
);