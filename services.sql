/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `areas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `children` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `family_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `education_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `children_parent_id_foreign` (`family_id`),
  KEY `children_education_id_foreign` (`education_id`),
  CONSTRAINT `children_education_id_foreign` FOREIGN KEY (`education_id`) REFERENCES `education` (`id`) ON DELETE CASCADE,
  CONSTRAINT `children_parent_id_foreign` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `churches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `districts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `education` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `families` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_id` bigint unsigned NOT NULL,
  `church_id` bigint unsigned NOT NULL,
  `district_id` bigint unsigned NOT NULL,
  `street_id` bigint unsigned NOT NULL,
  `address_id` bigint unsigned NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `first_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `father_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `families_area_id_foreign` (`area_id`),
  KEY `families_church_id_foreign` (`church_id`),
  KEY `families_district_id_foreign` (`district_id`),
  KEY `families_street_id_foreign` (`street_id`),
  KEY `families_address_id_foreign` (`address_id`),
  CONSTRAINT `families_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `families_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `families_church_id_foreign` FOREIGN KEY (`church_id`) REFERENCES `churches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `families_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `families_street_id_foreign` FOREIGN KEY (`street_id`) REFERENCES `streets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `streets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `addresses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ايجار ', '2023-10-17 19:47:29', '2023-10-17 19:47:29');
INSERT INTO `addresses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'تمليك', '2023-10-17 19:47:37', '2023-10-17 19:47:37');


INSERT INTO `areas` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'مؤسسة الزكاة', '2023-10-17 19:44:25', '2023-10-17 19:44:25');
INSERT INTO `areas` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'كمال رمزى', '2023-10-18 20:13:57', '2023-10-18 20:13:57');


INSERT INTO `children` (`id`, `family_id`, `name`, `education_id`, `created_at`, `updated_at`) VALUES
(2, 1, 'بيشوى عادل', 3, '2023-10-17 19:59:05', '2023-10-17 19:59:05');
INSERT INTO `children` (`id`, `family_id`, `name`, `education_id`, `created_at`, `updated_at`) VALUES
(3, 1, 'مينا ', 10, '2023-10-17 21:22:33', '2023-10-17 21:22:33');
INSERT INTO `children` (`id`, `family_id`, `name`, `education_id`, `created_at`, `updated_at`) VALUES
(5, 1, 'كيرلس ', 11, '2023-10-20 06:20:46', '2023-10-20 06:20:46');
INSERT INTO `children` (`id`, `family_id`, `name`, `education_id`, `created_at`, `updated_at`) VALUES
(6, 6, 'كيرلس ', 11, '2023-10-20 07:35:06', '2023-10-20 07:35:06');

INSERT INTO `churches` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'العذراء والانبا صمؤيل', '2023-10-17 19:45:45', '2023-10-17 19:45:45');
INSERT INTO `churches` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'العذراء والملاك ميخائيل ', '2023-10-18 20:12:10', '2023-10-18 20:12:10');
INSERT INTO `churches` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'الانبا كاراس', '2023-10-20 07:32:33', '2023-10-20 07:32:33');

INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'الحوض الطويل', '2023-10-17 19:44:39', '2023-10-17 19:45:10');
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'حوش عيسى', '2023-10-18 20:13:27', '2023-10-18 20:13:27');


INSERT INTO `education` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'حضانة', '2023-10-17 19:46:01', '2023-10-17 19:46:01');
INSERT INTO `education` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'الصف الاول الابتدائى', '2023-10-17 19:46:27', '2023-10-17 19:46:27');
INSERT INTO `education` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'الصف الثانى الابتدئى', '2023-10-17 19:46:55', '2023-10-17 19:46:55');
INSERT INTO `education` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'الصف الثالث الابتدئى', '2023-10-17 20:27:10', '2023-10-17 20:27:10'),
(5, 'الصف الرابع الابتدئى', '2023-10-17 20:27:26', '2023-10-17 20:27:26'),
(6, 'الصف الخامس الابتدئى', '2023-10-17 20:27:54', '2023-10-17 20:27:54'),
(7, 'الصف السادس الابتدئى', '2023-10-17 20:28:10', '2023-10-17 20:28:10'),
(8, 'الصف الاول الاعدادى', '2023-10-17 20:28:31', '2023-10-17 20:28:31'),
(9, 'الصف الثانى الاعدادى', '2023-10-17 20:28:44', '2023-10-17 20:28:44'),
(10, 'الصف الثالت الاعدادى', '2023-10-17 20:29:08', '2023-10-17 20:29:08'),
(11, 'الصف الاول الثانوى', '2023-10-17 20:29:47', '2023-10-17 20:29:47'),
(12, 'الصف الثانى الثانوى', '2023-10-17 20:30:00', '2023-10-17 20:30:00'),
(13, 'الصف الثالث الثانوى', '2023-10-17 20:30:17', '2023-10-17 20:30:17'),
(14, 'طالب جامعى ', '2023-10-17 20:30:30', '2023-10-17 20:30:30'),
(15, 'خريج', '2023-10-17 20:30:38', '2023-10-17 20:30:38'),
(16, 'سنة واحدة ', '2023-10-20 08:08:38', '2023-10-20 08:08:38'),
(17, 'سنتين', '2023-10-20 08:08:46', '2023-10-20 08:08:46'),
(18, 'ثلاث سنوات ', '2023-10-20 08:11:17', '2023-10-20 08:11:17');



INSERT INTO `families` (`id`, `name`, `mother_name`, `area_id`, `church_id`, `district_id`, `street_id`, `address_id`, `address`, `first_phone`, `second_phone`, `created_at`, `updated_at`, `status`, `father_image`, `mother_image`) VALUES
(1, 'عادل سلامة', 'سامية عياد', 1, 1, 1, 1, 2, 'شارع مسجد الهدى', '01226764759', '01226764759', '2023-10-17 19:48:45', '2023-10-18 02:00:37', 0, NULL, NULL);
INSERT INTO `families` (`id`, `name`, `mother_name`, `area_id`, `church_id`, `district_id`, `street_id`, `address_id`, `address`, `first_phone`, `second_phone`, `created_at`, `updated_at`, `status`, `father_image`, `mother_image`) VALUES
(5, 'Melvin ', 'Melvin Hood', 1, 1, 1, 1, 1, 'dfsadfs', '01226764759', '01226764759', '2023-10-18 02:39:12', '2023-10-18 02:39:12', 0, NULL, NULL);
INSERT INTO `families` (`id`, `name`, `mother_name`, `area_id`, `church_id`, `district_id`, `street_id`, `address_id`, `address`, `first_phone`, `second_phone`, `created_at`, `updated_at`, `status`, `father_image`, `mother_image`) VALUES
(6, 'هاني', 'مريم', 1, 2, 1, 2, 1, 'عنوان تفصيلي', '01226764759', '01226764759', '2023-10-20 07:33:58', '2023-10-21 23:17:20', 0, 'ABfaMP46jwffkVTZwO9ojwU0nln2x6-metaQnJhaW4yLmpwZWc=-.jpg', NULL);
INSERT INTO `families` (`id`, `name`, `mother_name`, `area_id`, `church_id`, `district_id`, `street_id`, `address_id`, `address`, `first_phone`, `second_phone`, `created_at`, `updated_at`, `status`, `father_image`, `mother_image`) VALUES
(9, 'مايكل وحيد فكرى ', 'مريم يوسف شحاتة', 2, 3, 2, 3, 2, 'وصف المكان مع وضع رابط link', '01226764759', '01226764759', '2023-10-21 22:34:10', '2023-10-21 23:17:43', 1, '1bvr3oWtA0JAfUKOQpcBnh7Wkkv564-metaQnJhaW4yLmpwZWc=-.jpg', 'hgXmGxGgPjqFy8VIbCueN6QFvavNbS-metad2hhdHNhcHAucG5n-.png');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_15_195133_create_areas_table', 1),
(6, '2023_10_15_195205_create_streets_table', 1),
(7, '2023_10_15_195237_create_districts_table', 1),
(8, '2023_10_15_195324_create_churches_table', 1),
(9, '2023_10_15_195345_create_addresses_table', 1),
(10, '2023_10_15_200430_create_families_table', 1),
(11, '2023_10_15_220357_create_education_table', 1),
(12, '2023_10_15_220451_create_children_table', 1),
(13, '2023_10_20_082518_add_status_to_families', 2),
(14, '2023_10_21_220830_add_images_to_families', 3);





INSERT INTO `streets` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'شارع البطل', '2023-10-17 19:44:51', '2023-10-17 19:44:51');
INSERT INTO `streets` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'شارع الفراعنة', '2023-10-18 20:12:54', '2023-10-18 20:12:54');
INSERT INTO `streets` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'حارة الطيبين', '2023-10-20 07:46:11', '2023-10-20 07:46:11');

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$JNSCQjf3yQ4tUvplZKPUku8XD.CyJ4eKl6sUzHJhuyNOHOJM2LUZK', 1, 'vA5T8A9XWQptxOUs6FT6NjXba7Pt989itWuoLSefMJz5exOUx5YkNYzwXiEs', '2023-10-17 19:43:12', '2023-10-17 19:43:12');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;