CREATE DATABASE `zeeslag`;

USE `zeeslag`;

CREATE TABLE `users` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
    `email` VARCHAR(100),
    `username` VARCHAR(50),
    `password` VARCHAR(255)
);

CREATE TABLE `friends` (
	`user_1` int,
	`user_2` int,
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

CREATE TABLE `score` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `points` int DEFAULT NULL,
  `win` int NOT NULL,
  `lose` int NOT NULL,
  `totaal` int NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);


/*
 * INSERTING EXAMPLE DATA
 */

INSERT INTO `users` VALUES
(1, 'jairo@email.com', 'Jairo', '$2y$10$r8aXWBqYgDCmOAfMS/Ll3OEUsvnm4QsUD6HJMb29eCpg4/GfyJImq'),
(2, 'aboker@email.com', 'Aboker', '$2y$10$r8aXWBqYgDCmOAfMS/Ll3OEUsvnm4QsUD6HJMb29eCpg4/GfyJImq'),
(3, 'jaibreyon@email.com', 'Jaibreyon', '$2y$10$r8aXWBqYgDCmOAfMS/Ll3OEUsvnm4QsUD6HJMb29eCpg4/GfyJImq'),
(4, 'batin@email.com', 'Batin', '$2y$10$r8aXWBqYgDCmOAfMS/Ll3OEUsvnm4QsUD6HJMb29eCpg4/GfyJImq');

INSERT INTO `friends` VALUES
(1, 2),
(1, 3),
(3, 4);
 
INSERT INTO `score` VALUES
(1, 1, 400, 3, 1, 4),
(2, 2, 300, 2, 1, 3),
(3, 3, 100, 1, 2, 3),
(4, 4, 500, 0, 3, 3);
 