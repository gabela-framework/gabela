-- Active: 1709556407866@@127.0.0.1@3306@ekomi
CREATE TABLE users (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) UNIQUE NOT NULL,
  `city` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiration` datetime DEFAULT NULL,
  `role` varchar(255) DEFAULT 'user',
  PRIMARY KEY (`id`)
);


-- Create Tasks Table
CREATE TABLE tasks (
  `id` int NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `description` text,
  `assign_to` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL,
  `completed` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `due_date` timestamp NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);