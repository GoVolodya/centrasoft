<?php
/**
 * This migration creates a students table. Down method not implemented yet;
 */

use app\core\Application;

class m0003_add_students_table
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = "
            CREATE TABLE students (
                id INT AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                age INT NOT NULL,
                gender VARCHAR(255) NOT NULL,
                class VARCHAR(255) NOT NULL,
                faculty VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE INNODB;
        ";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE students;";
        $db->pdo->exec($SQL);
    }
}