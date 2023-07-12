<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-02-20 15:18:13 --> Severity: Warning --> mysqli::real_connect(): (42000/1203): User saqfoiet_saq_root already has more than 'max_user_connections' active connections /home/saqfoiet/public_html/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2022-02-20 15:18:13 --> Unable to connect to the database
ERROR - 2022-02-20 15:59:28 --> Severity: Warning --> mysqli::real_connect(): (42000/1203): User saqfoiet_saq_root already has more than 'max_user_connections' active connections /home/saqfoiet/public_html/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2022-02-20 15:59:28 --> Unable to connect to the database
ERROR - 2022-02-20 17:29:24 --> Query error: Unknown column 'message' in 'field list' - Invalid query: INSERT INTO `saq_allusers` (`message`, `created_by`, `created_id`) VALUES ('Welcome home', 11, '1')
ERROR - 2022-02-20 17:35:50 --> Query error: Table 'saqfoiet_projectsaqfoietjoiehaiti.send_notification' doesn't exist - Invalid query: DESC send_notification
ERROR - 2022-02-20 17:37:34 --> Severity: error --> Exception: Object of class CI_DB_mysqli_result could not be converted to string /home/saqfoiet/public_html/foietjoie/models/Staff_model.php 322
ERROR - 2022-02-20 17:41:19 --> Query error: Unknown column 'saq_send_notification' in 'where clause' - Invalid query: SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = saq_send_notification
ERROR - 2022-02-20 17:42:02 --> Query error: Unknown column 'send_notification' in 'where clause' - Invalid query: SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = send_notification
ERROR - 2022-02-20 17:45:40 --> Query error: Unknown column 'created_id' in 'field list' - Invalid query: INSERT INTO `saq_allusers` (`created_id`) VALUES ('1')
ERROR - 2022-02-20 17:58:18 --> Query error: Unknown column 'created_id' in 'field list' - Invalid query: INSERT INTO `saq_allusers` (`created_id`) VALUES ('1')
ERROR - 2022-02-20 17:59:52 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '(11) NOT NULL,
                        `receiver` id(11) NOT NULL,
          ...' at line 4 - Invalid query: CREATE TABLE `saq_communication` (
                        `id` int(11) NOT NULL,
                        `message` text DEFAULT NULL,
                        `sender` id(11) NOT NULL,
                        `receiver` id(11) NOT NULL,
                        `status` enum ('read','unread','deleted') DEFAULT 'unread',
                        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                        CONSTRAINT PK_ID_COMM PRIMARY KEY (id),
                        FOREIGN KEY (sender) REFERENCES saq_allusers(id),
                        FOREIGN KEY (receiver) REFERENCES saq_allusers(id)

                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ERROR - 2022-02-20 18:02:18 --> Query error: Unknown column 'message' in 'field list' - Invalid query: INSERT INTO `saq_allusers` (`message`, `created_by`, `created_id`) VALUES ('Welcome home', 11, '1')
ERROR - 2022-02-20 18:04:07 --> Severity: error --> Exception: Call to undefined method Staff_model::addaddMessage() /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 357
ERROR - 2022-02-20 18:25:49 --> Severity: Notice --> Undefined index: create_at /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 370
ERROR - 2022-02-20 18:25:49 --> Severity: Notice --> Undefined index: create_at /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 371
ERROR - 2022-02-20 18:25:49 --> Severity: Notice --> Undefined index: create_at /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 370
ERROR - 2022-02-20 18:25:49 --> Severity: Notice --> Undefined index: create_at /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 371
ERROR - 2022-02-20 18:26:17 --> Severity: Notice --> Undefined index: create_at /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 370
ERROR - 2022-02-20 18:26:17 --> Severity: Notice --> Undefined index: create_at /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 371
ERROR - 2022-02-20 18:26:17 --> Severity: Notice --> Undefined index: create_at /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 370
ERROR - 2022-02-20 18:26:17 --> Severity: Notice --> Undefined index: create_at /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 371
ERROR - 2022-02-20 18:29:13 --> Severity: Notice --> Undefined index: timeoflastmessage /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 47
ERROR - 2022-02-20 18:29:13 --> Severity: Notice --> Undefined index: lastmessagesenttoyou /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 51
ERROR - 2022-02-20 18:43:58 --> Severity: Notice --> A non well formed numeric value encountered /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 390
ERROR - 2022-02-20 18:43:58 --> Severity: Notice --> A non well formed numeric value encountered /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 392
ERROR - 2022-02-20 18:43:58 --> Severity: Notice --> A non well formed numeric value encountered /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 392
ERROR - 2022-02-20 18:45:19 --> Severity: Notice --> A non well formed numeric value encountered /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 392
ERROR - 2022-02-20 18:45:19 --> Severity: Notice --> A non well formed numeric value encountered /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 392
ERROR - 2022-02-20 18:45:55 --> Severity: Notice --> A non well formed numeric value encountered /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 392
ERROR - 2022-02-20 18:46:33 --> Severity: Notice --> A non well formed numeric value encountered /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 392
ERROR - 2022-02-20 19:36:23 --> Severity: Notice --> Undefined variable: alluser /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 119
ERROR - 2022-02-20 19:36:23 --> Severity: Warning --> Invalid argument supplied for foreach() /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 119
ERROR - 2022-02-20 19:37:14 --> Severity: Notice --> Undefined variable: alluser /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 119
ERROR - 2022-02-20 19:37:14 --> Severity: Warning --> Invalid argument supplied for foreach() /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 119
ERROR - 2022-02-20 19:42:50 --> Severity: Notice --> Undefined variable: alluser /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 121
ERROR - 2022-02-20 19:42:50 --> Severity: Warning --> Invalid argument supplied for foreach() /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 121
ERROR - 2022-02-20 19:45:52 --> Severity: Notice --> Undefined variable: alluser /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 121
ERROR - 2022-02-20 19:45:52 --> Severity: Warning --> Invalid argument supplied for foreach() /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 121
ERROR - 2022-02-20 19:51:43 --> Severity: Notice --> Undefined variable: alluser /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 121
ERROR - 2022-02-20 19:51:43 --> Severity: Warning --> Invalid argument supplied for foreach() /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 121
ERROR - 2022-02-20 20:49:19 --> Severity: Notice --> Undefined index: department_id /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 229
ERROR - 2022-02-20 20:49:38 --> Severity: Notice --> Undefined index: department_id /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 229
ERROR - 2022-02-20 20:50:37 --> Severity: Notice --> Undefined index: department_id /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 229
ERROR - 2022-02-20 20:50:41 --> Severity: Notice --> Undefined index: department_id /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 229
ERROR - 2022-02-20 20:50:46 --> Severity: Notice --> Undefined index: department_id /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 229
ERROR - 2022-02-20 20:50:49 --> Severity: Notice --> Undefined index: department_id /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 229
ERROR - 2022-02-20 21:38:03 --> Query error: Unknown column 'user_type' in 'where clause' - Invalid query: SELECT *
FROM `saq_communication`
WHERE `user_type` != '{\"id\":\"1\",\"name\":\"Enseignant(e)\"}'
ERROR - 2022-02-20 21:41:02 --> Query error: Unknown column 'user_type' in 'where clause' - Invalid query: SELECT *
FROM `saq_allusers`
WHERE `user_type` != '{\"id\":\"1\",\"name\":\"Enseignant(e)\"}'
ERROR - 2022-02-20 21:41:07 --> Query error: Unknown column 'user_type' in 'where clause' - Invalid query: SELECT *
FROM `saq_allusers`
WHERE `user_type` != '{\"id\":\"1\",\"name\":\"Enseignant(e)\"}'
ERROR - 2022-02-20 21:46:26 --> Query error: Unknown column 'saq_staff_roles.user_type' in 'where clause' - Invalid query: SELECT `saq_allusers`.*
FROM `saq_allusers`
JOIN `saq_staff_roles` ON `saq_staff_roles`.`staff_id` = `saq_allusers`.`id`
WHERE `saq_staff_roles`.`user_type` != '{\"id\":\"1\",\"name\":\"Enseignant(e)\"}'
ERROR - 2022-02-20 21:49:46 --> Severity: Warning --> Invalid argument supplied for foreach() /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 29
ERROR - 2022-02-20 21:49:46 --> Severity: Warning --> Invalid argument supplied for foreach() /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 121
ERROR - 2022-02-20 21:51:03 --> Severity: Warning --> Invalid argument supplied for foreach() /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 29
ERROR - 2022-02-20 21:51:03 --> Severity: Warning --> Invalid argument supplied for foreach() /home/saqfoiet/public_html/foietjoie/views/admin/staff/sendmessage.php 121
ERROR - 2022-02-20 22:04:27 --> Query error: Duplicate entry '0' for key 'PRIMARY' - Invalid query: INSERT INTO `saq_communication` (`sender`, `message`, `receiver`) VALUES (10, 'Bienvenue au cours d\"introduction', 11)
ERROR - 2022-02-20 22:07:33 --> Query error: Multiple primary key defined - Invalid query: ALTER TABLE saq_communication MODIFY COLUMN id INT PRIMARY KEY AUTO_INCREMENT
ERROR - 2022-02-20 22:22:09 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_result::get() /home/saqfoiet/public_html/foietjoie/models/Staff_model.php 294
ERROR - 2022-02-20 22:26:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY created at ASC' at line 2 - Invalid query: SELECT * FROM saq_communication WHERE (sender = '11'AND receiver = '') OR  
            sender = ''AND receiver = '11'; ORDER BY created at ASC
ERROR - 2022-02-20 22:28:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY created at ASC' at line 1 - Invalid query: SELECT * FROM saq_communication WHERE sender = '11' OR receiver = '11'; ORDER BY created at ASC
ERROR - 2022-02-20 22:28:34 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY created at ASC' at line 1 - Invalid query: SELECT * FROM saq_communication WHERE sender = '11' OR receiver = '11'; ORDER BY created at ASC;
ERROR - 2022-02-20 22:28:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY created_at ASC' at line 1 - Invalid query: SELECT * FROM saq_communication WHERE sender = '11' OR receiver = '11'; ORDER BY created_at ASC;
ERROR - 2022-02-20 22:46:46 --> Severity: error --> Exception: syntax error, unexpected 'public' (T_PUBLIC) /home/saqfoiet/public_html/foietjoie/controllers/admin/Staff.php 544
ERROR - 2022-02-20 23:34:11 --> Query error: Unknown column 'reveiver' in 'field list' - Invalid query: UPDATE `saq_communication` SET `reveiver` = 10
WHERE `sender` = 1
