

CREATE DATABASE IF NOT EXISTS `db`;
USE `db`;

CREATE TABLE IF NOT EXISTS `plane` (
    `plane_id` int(11) NOT NULL AUTO_INCREMENT,
    `Img` text DEFAULT NULL,
    `name` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`plane_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO `Plane` (`plane_id`, `Img`, `name`) VALUES
                                                    (1, 'square', 'azeaze'),
                                                    (2, 'aze', 'dart'),
                                                    (3, 'eza', 'darezt'),
                                                    (4, 'easy/1/square', 'azeaze'),
                                                    (5, 'eza', 'darezt'),
                                                    (6, 'eza', 'darezt'),
                                                    (7, 'eza', 'darezt');

CREATE TABLE IF NOT EXISTS `steps` (
    `steps_id` int(11) NOT NULL AUTO_INCREMENT,
    `img` varchar(50) DEFAULT NULL,
    `content` varchar(50) DEFAULT NULL,
    `tutorial_id` int(11) NOT NULL,
    PRIMARY KEY (`steps_id`),
    KEY `tutorial_id` (`tutorial_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `steps` (`steps_id`, `img`, `content`, `tutorial_id`) VALUES
                                                                      (1, '1_s', 'lalalalalalalalal', 1),
                                                                      (2, '2_s', 'lalalalalalalalal', 1),
                                                                      (3, '3_s', 'lalalalalalalalal', 1),
                                                                      (4, '1_s', 'lalalalalalalalal', 2);

CREATE TABLE IF NOT EXISTS `tutorial` (
    `tutorial_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) DEFAULT NULL,
    `plane_id` int(11) NOT NULL,
    PRIMARY KEY (`tutorial_id`),
    UNIQUE KEY `plane_id` (`plane_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tutorial` (`tutorial_id`, `name`, `plane_id`) VALUES
                                                               (1, 'dart tutorial', 1),
                                                               (2, 'dart not toto', 2);


ALTER TABLE `steps`
    ADD CONSTRAINT `steps_ibfk_1` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorial` (`tutorial_id`);

ALTER TABLE `tutorial`
    ADD CONSTRAINT `tutorial_ibfk_1` FOREIGN KEY (`plane_id`) REFERENCES `Plane` (`plane_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
