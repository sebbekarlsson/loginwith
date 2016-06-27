CREATE TABLE `users` {
    `id` INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(256) NOT NULL,
    `nickname` VARCHAR(256) NOT NULL,
    `firstname` VARCHAR(256) NOT NULL,
    `lastname` VARCHAR(256) NOT NULL,
    `password` VARCHAR(256) NOT NULL,
    `time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
};
