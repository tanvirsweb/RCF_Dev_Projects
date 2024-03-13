// Sample PHP code for directory structure
/project-root
|-- index.php
|-- welcome.php
|-- logout.php

Install Dependencies:

1. Open current folder in terminal
2. TYpe command: composer require firebase/php-jwt

Create MySQL database:
dbName: php_jwt_login

CREATE TABLE `user` (
`user_id` int NOT NULL AUTO_INCREMENT,
`user_email` varchar(70) DEFAULT NULL,
`user_password` varchar(45) DEFAULT NULL,
`user_name` varchar(45) DEFAULT NULL,
PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user` VALUES (1,'alvi@gmail.com','password','Tanvir Anjom Siddique');
