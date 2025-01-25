-- Status Table
CREATE TABLE status (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  PRIMARY KEY (`status_id`)
);

-- Roles Table
CREATE TABLE roles (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
);

-- Users Table (Updated)
CREATE TABLE users (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) UNIQUE NOT NULL,
  `city` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiration` datetime DEFAULT NULL,
  `role_id` int NOT NULL,  -- Linked to roles table
  `status_id` int NOT NULL,  -- Linked to status table
  `gender` varchar(50) DEFAULT NULL,  -- Added gender field
  PRIMARY KEY (`user_id`),
  FOREIGN KEY (`role_id`) REFERENCES roles(`role_id`),
  FOREIGN KEY (`status_id`) REFERENCES status(`status_id`)
);


-- Populate Status Table
INSERT INTO status (`status_name`) VALUES ('active'), ('inactive'), ('on hold'), ('testing'), ('deleted');


-- Populate Roles Table
INSERT INTO roles (`role_name`, `status_id`) VALUES ('admin', 1), ('user', 1), ('manager', 1);

-- Tasks Table (Updated)
CREATE TABLE tasks (
  `task_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `assign_to` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL,
  `status_id` int NOT NULL,  -- Linked to status table
  `completed` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `due_date` timestamp NULL,
  PRIMARY KEY (`task_id`),
  FOREIGN KEY (`user_id`) REFERENCES users(`user_id`),
  FOREIGN KEY (`status_id`) REFERENCES status(`status_id`)
);

-- Additional Tasking-Related Tables

-- Categories Table (Example for Task Classification)
CREATE TABLE categories (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
);

-- Task to Category Mapping
CREATE TABLE task_categories (
  `task_id` int NOT NULL,
  `category_id` int NOT NULL,
  FOREIGN KEY (`task_id`) REFERENCES tasks(`task_id`),
  FOREIGN KEY (`category_id`) REFERENCES categories(`category_id`),
  PRIMARY KEY (`task_id`, `category_id`)
);

-- Labels Table (Similar to JIRA's Labels)
CREATE TABLE labels (
  `label_id` int NOT NULL AUTO_INCREMENT,
  `label_name` varchar(255) NOT NULL,
  PRIMARY KEY (`label_id`)
);

-- Task to Label Mapping
CREATE TABLE task_labels (
  `task_id` int NOT NULL,
  `label_id` int NOT NULL,
  FOREIGN KEY (`task_id`) REFERENCES tasks(`task_id`),
  FOREIGN KEY (`label_id`) REFERENCES labels(`label_id`),
  PRIMARY KEY (`task_id`, `label_id`)
);

-- Attachments Table (For file attachments in tasks)
CREATE TABLE attachments (
  `attachment_id` int NOT NULL AUTO_INCREMENT,
  `task_id` int NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`attachment_id`),
  FOREIGN KEY (`task_id`) REFERENCES tasks(`task_id`)
);
