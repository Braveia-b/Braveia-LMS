-- Braveia LMS: user_enrollments + dashboard indexes
-- Jalankan sekali di phpMyAdmin atau: mysql -u root braveia_db < database/migrations/001_user_enrollments_and_indexes.sql

CREATE TABLE IF NOT EXISTS `user_enrollments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `training_id` int NOT NULL,
  `enrolled_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_training_unique` (`user_id`,`training_id`),
  KEY `idx_enrolled_at` (`enrolled_at`),
  KEY `idx_training_id` (`training_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Payments (jika tabel sudah ada, index akan diabaikan jika duplikat — hapus manual jika error)
ALTER TABLE `payments` ADD INDEX `idx_payments_status_created` (`status`, `created_at`);
ALTER TABLE `payments` ADD INDEX `idx_payments_created` (`created_at`);

ALTER TABLE `users` ADD INDEX `idx_users_role_active` (`role_id`, `is_active`);

ALTER TABLE `trainings` ADD INDEX `idx_trainings_published` (`is_published`);
