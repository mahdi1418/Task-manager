<?php
function create_tables()
{
    $create_users = 'CREATE TABLE IF NOT EXISTS `users`(
      `user_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      `name` VARCHAR(50) NULL,
      `email` VARCHAR(100) NULL,
      `password` TEXT NULL,
      `file` VARCHAR(200) NOT NULL DEFAULT "file_1749260932.png",
      `create_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `sort` VARCHAR(50)  NOT NULL DEFAULT "`create_date` DESC"
    );';
    mysqli_query(db_conn(), $create_users);
    $create_tasks = 'CREATE TABLE IF NOT EXISTS `task` (
        `task_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `title` TEXT NULL,
        `status` BOOLEAN NOT NULL DEFAULT "0",
        `option` VARCHAR(30) NULL,
        `user_id` int UNSIGNED NULL,
        `create_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `due_datetime` DATETIME NULL
    );';
    mysqli_query(db_conn(), $create_tasks);
}
create_tables();
