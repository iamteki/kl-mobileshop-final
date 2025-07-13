-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for kl_mobile_events
CREATE DATABASE IF NOT EXISTS `kl_mobile_events` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kl_mobile_events`;

-- Dumping structure for table kl_mobile_events.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `event_date` date NOT NULL,
  `event_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `venue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_pax` int NOT NULL,
  `installation_time` time NOT NULL,
  `event_start_time` time NOT NULL,
  `dismantle_time` time NOT NULL,
  `rental_start_date` date NOT NULL,
  `rental_end_date` date NOT NULL,
  `rental_days` int NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(12,2) NOT NULL,
  `payment_status` enum('pending','paid','partial','refunded','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` enum('stripe','bank_transfer','cash') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_payment_intent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `booking_status` enum('pending','confirmed','in_progress','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `delivery_address` text COLLATE utf8mb4_unicode_ci,
  `delivery_instructions` text COLLATE utf8mb4_unicode_ci,
  `delivery_status` enum('pending','scheduled','delivered','picked_up') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `special_requests` text COLLATE utf8mb4_unicode_ci,
  `internal_notes` text COLLATE utf8mb4_unicode_ci,
  `insurance_opted` tinyint(1) NOT NULL DEFAULT '0',
  `insurance_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookings_booking_number_unique` (`booking_number`),
  KEY `bookings_booking_number_index` (`booking_number`),
  KEY `bookings_customer_id_index` (`customer_id`),
  KEY `bookings_event_date_index` (`event_date`),
  KEY `bookings_booking_status_index` (`booking_status`),
  KEY `bookings_payment_status_index` (`payment_status`),
  CONSTRAINT `bookings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.bookings: ~8 rows (approximately)
INSERT INTO `bookings` (`id`, `booking_number`, `customer_id`, `event_date`, `event_type`, `venue`, `number_of_pax`, `installation_time`, `event_start_time`, `dismantle_time`, `rental_start_date`, `rental_end_date`, `rental_days`, `subtotal`, `discount_amount`, `coupon_code`, `tax_amount`, `delivery_charge`, `total`, `payment_status`, `payment_method`, `stripe_payment_intent_id`, `paid_at`, `booking_status`, `delivery_address`, `delivery_instructions`, `delivery_status`, `special_requests`, `internal_notes`, `insurance_opted`, `insurance_amount`, `customer_name`, `customer_email`, `customer_phone`, `customer_company`, `created_at`, `updated_at`) VALUES
	(1, 'KLM-2025-DCUXPQ', 4, '2025-07-05', 'wedding', 'asadsdasdasd', 10, '06:54:00', '07:55:00', '19:55:00', '2025-07-05', '2025-07-05', 1, 20000.00, 0.00, NULL, 0.00, 500.00, 20500.00, 'paid', 'stripe', 'pi_3Rh0072EUp12UM8d0IVhX1SV', '2025-07-03 21:39:58', 'completed', 'asdasdasd', NULL, 'picked_up', 'asdasdasd', NULL, 0, 0.00, 'A.G.T. Kaushalya Wickramasinghe', 'tekiyagaming@gmail.com', '+94701614804', 'tekiYa', '2025-07-03 21:39:58', '2025-07-04 21:10:57'),
	(2, 'KLM-2025-TDX1BT', 4, '2025-07-05', 'birthday', 'zzZXZX', 20, '08:56:00', '10:58:00', '13:01:00', '2025-07-05', '2025-07-05', 1, 15000.00, 0.00, NULL, 0.00, 500.00, 15500.00, 'paid', 'stripe', 'pi_3Rh0HP2EUp12UM8d1k53jS0f', '2025-07-03 21:57:44', 'confirmed', 'asdasdasd', NULL, 'pending', 'asdasdasd', NULL, 0, 0.00, 'A.G.T. Kaushalya Wickramasinghe', 'tekiyagaming@gmail.com', '+94701614804', 'tekiYa', '2025-07-03 21:57:44', '2025-07-03 21:57:44'),
	(3, 'KLM-2025-VCNLHM', 4, '2025-07-05', 'corporate', 'asdasdasd', 20, '09:04:00', '10:05:00', '11:05:00', '2025-07-05', '2025-07-05', 1, 15000.00, 0.00, NULL, 0.00, 500.00, 15500.00, 'paid', 'stripe', 'pi_3Rh0OK2EUp12UM8d1lFtKGbZ', '2025-07-03 22:04:41', 'confirmed', 'asdasdasd', NULL, 'pending', 'asdasd', NULL, 0, 0.00, 'A.G.T. Kaushalya Wickramasinghe', 'tekiyagaming@gmail.com', '+94701614804', 'tekiYa', '2025-07-03 22:04:41', '2025-07-03 22:04:41'),
	(4, 'KLM-2025-J0WE7E', 4, '2025-07-05', 'birthday', 'asdasd', 10, '09:09:00', '10:09:00', '11:09:00', '2025-07-05', '2025-07-05', 1, 8000.00, 0.00, NULL, 0.00, 500.00, 8500.00, 'paid', 'stripe', 'pi_3Rh0Tn2EUp12UM8d140sbgQg', '2025-07-03 22:10:18', 'confirmed', 'asdasdasd', NULL, 'pending', 'asdasd', NULL, 0, 0.00, 'A.G.T. Kaushalya Wickramasinghe', 'tekiyagaming@gmail.com', '+94701614804', 'tekiYa', '2025-07-03 22:10:18', '2025-07-03 22:10:18'),
	(5, 'KLM-2025-NJWZYZ', 4, '2025-07-05', 'birthday', 'asdasd', 10, '09:14:00', '10:14:00', '11:14:00', '2025-07-05', '2025-07-05', 1, 15000.00, 0.00, NULL, 0.00, 500.00, 15500.00, 'paid', 'stripe', 'pi_3Rh0Xu2EUp12UM8d0NCxKT3c', '2025-07-03 22:14:34', 'confirmed', 'asdasdasd', NULL, 'pending', 'asdasd', NULL, 0, 0.00, 'A.G.T. Kaushalya Wickramasinghe', 'tekiyagaming@gmail.com', '+94701614804', 'tekiYa', '2025-07-03 22:14:34', '2025-07-03 22:14:34'),
	(6, 'KLM-2025-AFKQEI', 4, '2025-07-05', 'corporate', 'asdasdad', 20, '09:38:00', '10:38:00', '11:38:00', '2025-07-05', '2025-07-05', 1, 85000.00, 0.00, NULL, 0.00, 500.00, 85500.00, 'paid', 'stripe', 'pi_3Rh0vY2EUp12UM8d115Ohkuw', '2025-07-03 22:39:00', 'confirmed', 'No 76 Kanda', NULL, 'pending', 'asdasd', NULL, 0, 0.00, 'A.G.T. Kaushalya Wickramasinghe', 'tekiyagaming@gmail.com', '+94701614804', 'tekiYa', '2025-07-03 22:39:00', '2025-07-03 22:39:00'),
	(7, 'KLM-2025-VDXEPT', 4, '2025-07-05', 'birthday', 'asdasd', 20, '09:41:00', '10:41:00', '11:41:00', '2025-07-05', '2025-07-05', 1, 20000.00, 0.00, NULL, 0.00, 500.00, 20500.00, 'paid', 'stripe', 'pi_3Rh0yg2EUp12UM8d0wvPGT61', '2025-07-03 22:42:15', 'confirmed', 'No 76 Kanda', NULL, 'pending', 'asasd', NULL, 0, 0.00, 'A.G.T. Kaushalya Wickramasinghe', 'tekiyagaming@gmail.com', '+94701614804', 'tekiYa', '2025-07-03 22:42:15', '2025-07-03 22:42:15'),
	(8, 'KLM-2025-GTBLWD', 4, '2025-07-05', 'wedding', 'asdasd', 10, '09:47:00', '10:47:00', '11:47:00', '2025-07-05', '2025-07-05', 1, 15000.00, 0.00, NULL, 0.00, 500.00, 15500.00, 'paid', 'stripe', 'pi_3Rh14P2EUp12UM8d0t4uJHKc', '2025-07-03 22:48:11', 'completed', 'No 76 Kanda', NULL, 'delivered', 'asdasd', NULL, 0, 0.00, 'A.G.T. Kaushalya Wickramasinghe', 'tekiyagaming@gmail.com', '+94701614804', 'tekiYa', '2025-07-03 22:48:11', '2025-07-04 21:12:30');

-- Dumping structure for table kl_mobile_events.booking_items
CREATE TABLE IF NOT EXISTS `booking_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `item_type` enum('product','service','service_provider','package') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product',
  `item_id` bigint unsigned NOT NULL,
  `service_provider_id` bigint unsigned DEFAULT NULL,
  `service_provider_pricing_id` bigint unsigned DEFAULT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variation_id` bigint unsigned DEFAULT NULL,
  `variation_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `rental_days` int NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `selected_addons` json DEFAULT NULL,
  `addons_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','confirmed','delivered','returned','damaged','lost') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `delivered_at` timestamp NULL DEFAULT NULL,
  `returned_at` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_items_product_variation_id_foreign` (`product_variation_id`),
  KEY `booking_items_booking_id_index` (`booking_id`),
  KEY `booking_items_item_type_item_id_index` (`item_type`,`item_id`),
  KEY `booking_items_status_index` (`status`),
  KEY `booking_items_service_provider_id_index` (`service_provider_id`),
  KEY `booking_items_service_provider_pricing_id_index` (`service_provider_pricing_id`),
  CONSTRAINT `booking_items_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_items_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.booking_items: ~8 rows (approximately)
INSERT INTO `booking_items` (`id`, `booking_id`, `item_type`, `item_id`, `service_provider_id`, `service_provider_pricing_id`, `item_name`, `item_sku`, `product_variation_id`, `variation_name`, `quantity`, `unit_price`, `total_price`, `rental_days`, `start_time`, `end_time`, `selected_addons`, `addons_price`, `status`, `delivered_at`, `returned_at`, `notes`, `created_at`, `updated_at`) VALUES
	(1, 1, 'service_provider', 5, NULL, NULL, 'David Fernando - Standard', NULL, NULL, NULL, 1, 20000.00, 20000.00, 1, NULL, NULL, '"{\\"pricing_tier_id\\":\\"13\\",\\"duration\\":4,\\"start_time\\":\\"06:50\\"}"', 0.00, 'returned', '2025-07-04 21:04:46', '2025-07-04 21:10:57', NULL, '2025-07-03 21:39:58', '2025-07-04 21:10:57'),
	(2, 2, 'product', 1, NULL, NULL, 'JBL Professional PA System', NULL, NULL, NULL, 1, 15000.00, 15000.00, 1, NULL, NULL, NULL, 0.00, 'pending', NULL, NULL, NULL, '2025-07-03 21:57:44', '2025-07-03 21:57:44'),
	(3, 3, 'product', 1, NULL, NULL, 'JBL Professional PA System', NULL, NULL, NULL, 1, 15000.00, 15000.00, 1, NULL, NULL, NULL, 0.00, 'pending', NULL, NULL, NULL, '2025-07-03 22:04:41', '2025-07-03 22:04:41'),
	(4, 4, 'product', 4, NULL, NULL, 'LED Par Light Set (12 Units)', NULL, NULL, NULL, 1, 8000.00, 8000.00, 1, NULL, NULL, NULL, 0.00, 'pending', NULL, NULL, NULL, '2025-07-03 22:10:18', '2025-07-03 22:10:18'),
	(5, 5, 'product', 1, NULL, NULL, 'JBL Professional PA System', NULL, NULL, NULL, 1, 15000.00, 15000.00, 1, NULL, NULL, NULL, 0.00, 'pending', NULL, NULL, NULL, '2025-07-03 22:14:34', '2025-07-03 22:14:34'),
	(6, 6, 'package', 2, NULL, NULL, 'Professional Package', NULL, NULL, NULL, 1, 85000.00, 85000.00, 1, NULL, NULL, NULL, 0.00, 'pending', NULL, NULL, NULL, '2025-07-03 22:39:00', '2025-07-03 22:39:00'),
	(7, 7, 'service_provider', 12, NULL, NULL, 'Emma Thompson - Standard', NULL, NULL, NULL, 1, 20000.00, 20000.00, 1, NULL, NULL, '"{\\"pricing_tier_id\\":\\"26\\",\\"duration\\":4,\\"start_time\\":\\"09:41\\"}"', 0.00, 'pending', NULL, NULL, NULL, '2025-07-03 22:42:15', '2025-07-03 22:42:15'),
	(8, 8, 'product', 1, NULL, NULL, 'JBL Professional PA System', NULL, NULL, NULL, 1, 15000.00, 15000.00, 1, NULL, NULL, NULL, 0.00, 'delivered', '2025-07-04 21:12:30', NULL, NULL, '2025-07-03 22:48:11', '2025-07-04 21:12:30');

-- Dumping structure for table kl_mobile_events.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.cache: ~2 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('kl_mobile_dj_events_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1751688452),
	('kl_mobile_dj_events_cache_livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1751688452;', 1751688452);

-- Dumping structure for table kl_mobile_events.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.cache_locks: ~0 rows (approximately)

-- Dumping structure for table kl_mobile_events.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `show_on_homepage` tinyint(1) NOT NULL DEFAULT '1',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_slug_index` (`slug`),
  KEY `categories_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.categories: ~8 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `icon`, `image`, `sort_order`, `show_on_homepage`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'Sound Equipment', 'sound-equipment', 'Professional PA systems, speakers, mixers, and audio equipment for events of all sizes', 'fas fa-volume-up', NULL, 0, 1, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(4, 'Lighting Equipment', 'lighting', 'LED lights, spotlights, moving heads, and stage lighting solutions', 'fas fa-lightbulb', NULL, 1, 1, 'active', '2025-07-01 07:37:06', '2025-07-04 18:09:23'),
	(5, 'LED Screens', 'led-screens', 'Indoor and outdoor LED display screens for presentations and visuals', 'fas fa-tv', NULL, 2, 1, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(6, 'DJ Equipment', 'dj-equipment', 'Professional DJ controllers, turntables, and mixing equipment', 'fas fa-headphones', NULL, 3, 1, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(7, 'Backdrops', 'backdrops', 'Event backdrops, pipe and drape systems for all occasions', 'fas fa-image', NULL, 4, 1, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(8, 'Tables & Chairs', 'tables-chairs', 'Event furniture including banquet tables, chairs, and cocktail tables', 'fas fa-chair', NULL, 5, 1, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(9, 'Tents & Canopy', 'tents-canopy', 'Outdoor event tents, marquees, and weather protection', 'fas fa-campground', NULL, 6, 1, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(10, 'Photo Boothsss', 'photo-booths', 'Interactive photo booths with instant printing and digital sharing', 'fas fa-camera', NULL, 7, 1, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06');

-- Dumping structure for table kl_mobile_events.coupons
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `minimum_amount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int DEFAULT NULL,
  `used_count` int NOT NULL DEFAULT '0',
  `usage_limit_per_customer` int DEFAULT NULL,
  `applicable_categories` json DEFAULT NULL,
  `applicable_products` json DEFAULT NULL,
  `valid_from` date NOT NULL,
  `valid_until` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`),
  KEY `coupons_code_index` (`code`),
  KEY `coupons_is_active_index` (`is_active`),
  KEY `coupons_valid_from_valid_until_index` (`valid_from`,`valid_until`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.coupons: ~0 rows (approximately)

-- Dumping structure for table kl_mobile_events.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_registration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_type` enum('individual','corporate') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'individual',
  `total_bookings` int NOT NULL DEFAULT '0',
  `total_spent` decimal(12,2) NOT NULL DEFAULT '0.00',
  `last_booking_date` date DEFAULT NULL,
  `preferences` json DEFAULT NULL,
  `newsletter_subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `sms_notifications` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_user_id_unique` (`user_id`),
  KEY `customers_user_id_index` (`user_id`),
  KEY `customers_customer_type_index` (`customer_type`),
  KEY `customers_company_index` (`company`),
  CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.customers: ~2 rows (approximately)
INSERT INTO `customers` (`id`, `user_id`, `phone`, `address`, `company`, `company_registration`, `tax_id`, `customer_type`, `total_bookings`, `total_spent`, `last_booking_date`, `preferences`, `newsletter_subscribed`, `sms_notifications`, `created_at`, `updated_at`) VALUES
	(3, 8, '+60123456789', '123 Main Street, Kuala Lumpur', 'Test Company Sdn Bhd', NULL, NULL, 'corporate', 0, 0.00, NULL, NULL, 0, 0, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(4, 9, '+94701614804', 'No 76 Kanda', 'tekiYa', NULL, NULL, 'individual', 8, 197000.00, '2025-07-04', NULL, 0, 1, '2025-07-03 18:23:31', '2025-07-03 22:48:11');

-- Dumping structure for table kl_mobile_events.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table kl_mobile_events.inventory
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `product_variation_id` bigint unsigned DEFAULT NULL,
  `total_quantity` int NOT NULL,
  `available_quantity` int NOT NULL,
  `reserved_quantity` int NOT NULL DEFAULT '0',
  `maintenance_quantity` int NOT NULL DEFAULT '0',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_maintenance_date` date DEFAULT NULL,
  `next_maintenance_date` date DEFAULT NULL,
  `status` enum('active','low_stock','out_of_stock','discontinued') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inventory_product_id_product_variation_id_unique` (`product_id`,`product_variation_id`),
  KEY `inventory_product_variation_id_foreign` (`product_variation_id`),
  KEY `inventory_status_index` (`status`),
  KEY `inventory_available_quantity_index` (`available_quantity`),
  CONSTRAINT `inventory_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inventory_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.inventory: ~21 rows (approximately)
INSERT INTO `inventory` (`id`, `product_id`, `product_variation_id`, `total_quantity`, `available_quantity`, `reserved_quantity`, `maintenance_quantity`, `location`, `warehouse_section`, `last_maintenance_date`, `next_maintenance_date`, `status`, `notes`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, 19, 19, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(2, 1, 1, 6, 6, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(3, 1, 2, 9, 9, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(4, 1, 3, 7, 7, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(5, 2, NULL, 17, 17, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(6, 3, NULL, 16, 16, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(7, 4, NULL, 9, 9, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(8, 5, NULL, 13, 13, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(9, 6, NULL, 12, 12, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(10, 7, NULL, 13, 13, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(11, 8, NULL, 14, 14, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(12, 9, NULL, 6, 6, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(13, 10, NULL, 7, 7, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(14, 11, NULL, 13, 13, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(15, 11, 4, 7, 7, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(16, 11, 5, 6, 6, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(17, 11, 6, 4, 4, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(18, 12, NULL, 17, 17, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(19, 12, 7, 8, 8, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(20, 12, 8, 10, 10, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(21, 12, 9, 8, 8, 0, 0, 'Warehouse A', NULL, NULL, NULL, 'active', NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06');

-- Dumping structure for table kl_mobile_events.inventory_transactions
CREATE TABLE IF NOT EXISTS `inventory_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `inventory_id` bigint unsigned NOT NULL,
  `booking_id` bigint unsigned DEFAULT NULL,
  `type` enum('in','out','reserved','maintenance','damaged','lost') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `balance_after` int NOT NULL,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventory_transactions_user_id_foreign` (`user_id`),
  KEY `inventory_transactions_inventory_id_index` (`inventory_id`),
  KEY `inventory_transactions_booking_id_index` (`booking_id`),
  KEY `inventory_transactions_type_index` (`type`),
  KEY `inventory_transactions_created_at_index` (`created_at`),
  CONSTRAINT `inventory_transactions_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL,
  CONSTRAINT `inventory_transactions_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inventory_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.inventory_transactions: ~0 rows (approximately)

-- Dumping structure for table kl_mobile_events.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.jobs: ~0 rows (approximately)

-- Dumping structure for table kl_mobile_events.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.job_batches: ~0 rows (approximately)

-- Dumping structure for table kl_mobile_events.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.media: ~0 rows (approximately)

-- Dumping structure for table kl_mobile_events.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.migrations: ~28 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_01_01_000001_create_categories_table', 1),
	(5, '2024_01_01_000002_create_products_table', 1),
	(6, '2024_01_01_000003_create_product_variations_table', 1),
	(7, '2024_01_01_000004_create_services_table', 1),
	(8, '2024_01_01_000005_create_packages_table', 1),
	(9, '2024_01_01_000006_create_customers_table', 1),
	(10, '2024_01_01_000007_create_bookings_table', 1),
	(11, '2024_01_01_000008_create_booking_items_table', 1),
	(12, '2024_01_01_000009_create_media_table', 1),
	(13, '2024_01_01_000010_create_inventory_table', 1),
	(14, '2024_01_01_000011_create_inventory_transactions_table', 1),
	(15, '2024_01_01_000012_create_product_attributes_table', 1),
	(16, '2024_01_01_000013_create_coupons_table', 1),
	(17, '2025_07_02_230544_create_service_categories_table', 2),
	(18, '2025_07_02_230553_create_service_providers_table', 2),
	(19, '2025_07_02_230559_create_service_provider_media_table', 2),
	(20, '2025_07_02_230606_create_service_provider_pricing_table', 2),
	(21, '2025_07_02_230613_create_service_provider_reviews_table', 2),
	(22, '2025_07_02_230620_update_booking_items_for_service_providers', 2),
	(23, '2025_07_02_234551_drop_old_services_table', 3),
	(24, '2025_07_03_235206_add_last_login_at_to_user_table', 4),
	(25, '2025_07_04_222024_add_is_admin_to_users_table', 5),
	(26, '2025_07_04_230531_add_is_admin_to_users_table', 6),
	(27, '2025_07_04_235800_fix_products_included_items_json', 7),
	(28, '2025_07_05_031539_fix_packages_json_encoding', 8);

-- Dumping structure for table kl_mobile_events.packages
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `suitable_for` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features` json DEFAULT NULL,
  `items` json DEFAULT NULL,
  `service_duration` int NOT NULL DEFAULT '8',
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `packages_slug_unique` (`slug`),
  KEY `packages_slug_index` (`slug`),
  KEY `packages_category_index` (`category`),
  KEY `packages_status_index` (`status`),
  KEY `packages_featured_index` (`featured`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.packages: ~3 rows (approximately)
INSERT INTO `packages` (`id`, `name`, `slug`, `description`, `category`, `price`, `suitable_for`, `features`, `items`, `service_duration`, `badge`, `image`, `sort_order`, `featured`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Basic Package', 'basic-package', 'Perfect for small events :)', 'Basic', 45000.00, '50-100 pax', '["Basic Sound System", "8 LED Par Lights", "1 Wireless Microphone", "Basic DJ Setup", "4 Hours Service", "1 Technician"]', '[]', 4, NULL, NULL, 0, 0, 'active', '2025-07-01 07:37:06', '2025-07-04 21:50:02'),
	(2, 'Professional Package', 'professional-package', 'Ideal for corporate events', 'Professional', 85000.00, '100-300 pax', '["Professional PA System", "Stage Lighting Setup", "2 Wireless Microphones", "Professional DJ", "LED Screen (2x1m)", "8 Hours Service", "2 Technicians"]', NULL, 8, 'Most Popular', NULL, 0, 1, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(3, 'Premium Package', 'premium-package', 'For large-scale events', 'Premium', 150000.00, '300+ pax', '["Line Array Sound System", "Full Stage Lighting", "4 Wireless Microphones", "Professional DJ & Emcee", "LED Wall (4x3m)", "Special Effects", "Full Day Service", "Full Technical Team"]', NULL, 12, NULL, NULL, 0, 0, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06');

-- Dumping structure for table kl_mobile_events.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table kl_mobile_events.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `detailed_description` text COLLATE utf8mb4_unicode_ci,
  `base_price` decimal(10,2) NOT NULL,
  `price_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'day',
  `min_quantity` int NOT NULL DEFAULT '1',
  `max_quantity` int NOT NULL DEFAULT '10',
  `available_quantity` int NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `included_items` json DEFAULT NULL,
  `addons` json DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  KEY `products_slug_index` (`slug`),
  KEY `products_sku_index` (`sku`),
  KEY `products_category_id_index` (`category_id`),
  KEY `products_status_index` (`status`),
  KEY `products_featured_index` (`featured`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.products: ~12 rows (approximately)
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `sku`, `brand`, `subcategory`, `short_description`, `detailed_description`, `base_price`, `price_unit`, `min_quantity`, `max_quantity`, `available_quantity`, `sort_order`, `featured`, `included_items`, `addons`, `meta_title`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 3, 'JBL Professional PA System', 'jbl-professional-pa-system', 'SOU-001', 'JBL', 'PA Systems', 'Professional-grade PA system perfect for corporate events, weddings, and conferences. Features crystal-clear audio output with 1000W RMS power.', NULL, 15000.00, 'day', 1, 10, 19, 0, 1, '["2x Professional Speakers", "2x Speaker Stands", "Mixing Console", "All Necessary Cables", "Power Distribution", "Setup & Testing"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(2, 3, 'Yamaha MG16XU 16-Channel Mixer', 'yamaha-mg16xu-16-channel-mixer', 'SOU-002', 'Yamaha', 'Mixers', '16-channel mixing console with built-in effects and USB audio interface.', NULL, 8000.00, 'day', 1, 10, 17, 0, 0, '["2x Professional Speakers", "2x Speaker Stands", "Mixing Console", "All Necessary Cables", "Power Distribution", "Setup & Testing"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(3, 3, 'Shure BLX Wireless Microphone Set', 'shure-blx-wireless-microphone-set', 'SOU-003', 'Shure', 'Microphones', 'Professional wireless microphone system with reliable UHF performance.', NULL, 5000.00, 'day', 1, 10, 16, 0, 0, '["2x Professional Speakers", "2x Speaker Stands", "Mixing Console", "All Necessary Cables", "Power Distribution", "Setup & Testing"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(4, 4, 'LED Par Light Set (12 Units)', 'led-par-light-set-12-units', 'LIG-001', 'Chauvet', 'LED Lights', 'RGB LED par lights with DMX control for vibrant stage lighting.', NULL, 8000.00, 'day', 1, 10, 9, 0, 1, '["Complete Light Set", "DMX Controller", "Lighting Stands/Trusses", "Power & DMX Cables", "Safety Equipment", "Programming Service"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(5, 4, 'Moving Head Spot Light', 'moving-head-spot-light', 'LIG-002', 'Martin', 'Moving Heads', 'Professional moving head with gobo patterns and color wheels.', NULL, 12000.00, 'day', 1, 10, 13, 0, 0, '["Complete Light Set", "DMX Controller", "Lighting Stands/Trusses", "Power & DMX Cables", "Safety Equipment", "Programming Service"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(6, 4, 'LED Uplighting Package', 'led-uplighting-package', 'LIG-003', 'ADJ', 'Uplighting', 'Wireless LED uplights for ambient venue lighting.', NULL, 6000.00, 'day', 1, 10, 12, 0, 0, '["Complete Light Set", "DMX Controller", "Lighting Stands/Trusses", "Power & DMX Cables", "Safety Equipment", "Programming Service"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(7, 5, 'P3.91 Indoor LED Wall (3x2m)', 'p391-indoor-led-wall-3x2m', 'LED-001', 'Absen', NULL, 'High-resolution indoor LED video wall perfect for presentations.', NULL, 25000.00, 'day', 1, 10, 13, 0, 1, '["LED Panel Modules", "Processing Unit", "Mounting Structure", "Power Distribution", "Content Management", "Technical Support"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(8, 5, 'P4.81 Outdoor LED Screen', 'p481-outdoor-led-screen', 'LED-002', 'Novastar', NULL, 'Weather-resistant outdoor LED display for large events.', NULL, 30000.00, 'day', 1, 10, 14, 0, 0, '["LED Panel Modules", "Processing Unit", "Mounting Structure", "Power Distribution", "Content Management", "Technical Support"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(9, 6, 'Pioneer DDJ-FLX6 Controller', 'pioneer-ddj-flx6-controller', 'DJ--001', 'Pioneer', NULL, '4-channel DJ controller with Serato DJ Pro compatibility.', NULL, 12000.00, 'day', 1, 10, 6, 0, 1, '["DJ Controller/Turntables", "DJ Mixer", "Headphones", "All Cables", "Laptop Stand", "Basic Lighting"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(10, 6, 'Technics SL-1200 Turntables (Pair)', 'technics-sl-1200-turntables-pair', 'DJ--002', 'Technics', NULL, 'Industry-standard direct drive turntables for professional DJs.', NULL, 18000.00, 'day', 1, 10, 7, 0, 0, '["DJ Controller/Turntables", "DJ Mixer", "Headphones", "All Cables", "Laptop Stand", "Basic Lighting"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(11, 8, 'Round Banquet Table (10 pax)', 'round-banquet-table-10-pax', 'TAB-001', 'Generic', NULL, 'Standard round banquet table with white tablecloth.', NULL, 500.00, 'day', 1, 10, 13, 0, 0, '["Equipment as described", "Basic accessories", "Setup guide"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(12, 8, 'Chiavari Chairs', 'chiavari-chairs', 'TAB-002', 'Generic', NULL, 'Elegant Chiavari chairs available in gold, silver, or white.', NULL, 150.00, 'day', 1, 10, 17, 0, 0, '["Equipment as described", "Basic accessories", "Setup guide"]', NULL, NULL, NULL, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06');

-- Dumping structure for table kl_mobile_events.product_attributes
CREATE TABLE IF NOT EXISTS `product_attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `attribute_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attributes_product_id_attribute_key_index` (`product_id`,`attribute_key`),
  CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.product_attributes: ~0 rows (approximately)

-- Dumping structure for table kl_mobile_events.product_variations
CREATE TABLE IF NOT EXISTS `product_variations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `available_quantity` int NOT NULL DEFAULT '0',
  `attributes` json DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_variations_sku_unique` (`sku`),
  KEY `product_variations_product_id_index` (`product_id`),
  KEY `product_variations_sku_index` (`sku`),
  KEY `product_variations_status_index` (`status`),
  CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.product_variations: ~9 rows (approximately)
INSERT INTO `product_variations` (`id`, `product_id`, `name`, `sku`, `price`, `available_quantity`, `attributes`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, '500W System', 'SOU-001-V1', 10000.00, 6, NULL, 0, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(2, 1, '1000W System', 'SOU-001-V2', 15000.00, 9, NULL, 0, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(3, 1, '1500W System', 'SOU-001-V3', 20000.00, 7, NULL, 0, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(4, 11, '6 pax table', 'TAB-001-V1', 400.00, 7, NULL, 0, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(5, 11, '8 pax table', 'TAB-001-V2', 450.00, 6, NULL, 0, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(6, 11, '10 pax table', 'TAB-001-V3', 500.00, 4, NULL, 0, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(7, 12, 'Gold', 'TAB-002-V1', 150.00, 8, NULL, 0, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(8, 12, 'Silver', 'TAB-002-V2', 150.00, 10, NULL, 0, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(9, 12, 'White', 'TAB-002-V3', 150.00, 8, NULL, 0, 'active', '2025-07-01 07:37:06', '2025-07-01 07:37:06');

-- Dumping structure for table kl_mobile_events.service_categories
CREATE TABLE IF NOT EXISTS `service_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `show_on_homepage` tinyint(1) NOT NULL DEFAULT '1',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_categories_slug_unique` (`slug`),
  KEY `service_categories_slug_index` (`slug`),
  KEY `service_categories_status_index` (`status`),
  KEY `service_categories_parent_category_index` (`parent_category`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.service_categories: ~9 rows (approximately)
INSERT INTO `service_categories` (`id`, `name`, `slug`, `description`, `icon`, `image`, `parent_category`, `sort_order`, `show_on_homepage`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'Professional DJs', 'professional-djs', 'Experienced DJs for all types of events', 'fas fa-headphones', NULL, 'entertainment', 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(4, 'Event Emcees', 'event-emcees', 'Professional MCs for all occasions', 'fas fa-microphone', NULL, 'entertainment', 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(5, 'Live Bands', 'live-bands', 'Professional bands for live performances', 'fas fa-guitar', NULL, 'entertainment', 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(6, 'Sound Engineers', 'sound-engineers', 'Professional audio engineers for events', 'fas fa-sliders-h', NULL, 'technical-crew', 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(7, 'Lighting Technicians', 'lighting-technicians', 'Expert lighting designers and operators', 'fas fa-lightbulb', NULL, 'technical-crew', 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(8, 'Photographers', 'photographers', 'Professional event photographers', 'fas fa-camera', NULL, 'media-production', 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(9, 'Videographers', 'videographers', 'Professional video coverage for events', 'fas fa-video', NULL, 'media-production', 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(10, 'Event Coordinators', 'event-coordinators', 'Professional event planning and coordination', 'fas fa-clipboard-list', NULL, 'event-staff', 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(11, 'Event Ushers', 'event-ushers', 'Professional ushers for guest management', 'fas fa-user-tie', NULL, 'event-staff', 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56');

-- Dumping structure for table kl_mobile_events.service_providers
CREATE TABLE IF NOT EXISTS `service_providers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stage_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `base_price` decimal(10,2) NOT NULL,
  `price_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'event',
  `features` json DEFAULT NULL,
  `experience_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `years_experience` int NOT NULL DEFAULT '0',
  `languages` json DEFAULT NULL,
  `specialties` json DEFAULT NULL,
  `equipment_owned` json DEFAULT NULL,
  `equipment_provided` tinyint(1) NOT NULL DEFAULT '0',
  `min_booking_hours` int NOT NULL DEFAULT '1',
  `max_booking_hours` int DEFAULT NULL,
  `availability` json DEFAULT NULL,
  `portfolio_links` json DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `total_reviews` int NOT NULL DEFAULT '0',
  `total_bookings` int NOT NULL DEFAULT '0',
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badge_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('active','inactive','on_leave') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_providers_slug_unique` (`slug`),
  KEY `service_providers_service_category_id_index` (`service_category_id`),
  KEY `service_providers_slug_index` (`slug`),
  KEY `service_providers_status_index` (`status`),
  KEY `service_providers_featured_index` (`featured`),
  KEY `service_providers_experience_level_index` (`experience_level`),
  KEY `service_providers_rating_index` (`rating`),
  CONSTRAINT `service_providers_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.service_providers: ~12 rows (approximately)
INSERT INTO `service_providers` (`id`, `service_category_id`, `name`, `slug`, `stage_name`, `bio`, `short_description`, `base_price`, `price_unit`, `features`, `experience_level`, `years_experience`, `languages`, `specialties`, `equipment_owned`, `equipment_provided`, `min_booking_hours`, `max_booking_hours`, `availability`, `portfolio_links`, `rating`, `total_reviews`, `total_bookings`, `badge`, `badge_class`, `sort_order`, `featured`, `status`, `created_at`, `updated_at`) VALUES
	(2, 3, 'Mike Johnson', 'dj-mike', 'DJ Mike', 'Professional DJ with 10+ years experience in clubs and events', 'Professional DJ with 10+ years experience in clubs and events', 25000.00, 'event', '["Professional DJ equipment", "Music library with latest hits", "Light coordination", "MC services", "Setup and breakdown"]', 'Professional', 10, '["English", "Sinhala"]', '["House", "Hip Hop", "Commercial", "Retro"]', NULL, 0, 4, NULL, NULL, NULL, 4.80, 45, 150, 'Top Rated', NULL, 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(3, 3, 'Sarah Williams', 'dj-sara', 'DJ Sara', 'Specializing in weddings and corporate events', 'Specializing in weddings and corporate events', 30000.00, 'event', '["Professional DJ equipment", "Music library with latest hits", "Light coordination", "MC services", "Setup and breakdown"]', 'Premium', 8, '["English", "Tamil"]', '["Wedding", "Corporate", "Lounge", "Bollywood"]', NULL, 0, 4, NULL, NULL, NULL, 4.90, 14, 120, NULL, NULL, 0, 0, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(4, 3, 'Alex Chen', 'dj-fusion', 'DJ Fusion', 'Electronic music specialist', 'Electronic music specialist', 20000.00, 'event', '["Professional DJ equipment", "Music library with latest hits", "Light coordination", "MC services", "Setup and breakdown"]', 'Professional', 5, '["English"]', '["EDM", "Techno", "Progressive", "Trance"]', NULL, 0, 4, NULL, NULL, NULL, 4.50, 28, 80, NULL, NULL, 0, 0, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(5, 4, 'David Fernando', 'david-fernando', NULL, 'Bilingual MC with charismatic personality', 'Bilingual MC with charismatic personality', 20000.00, 'event', '["Professional service", "Experienced provider", "Quality guaranteed"]', 'Professional', 12, '["English", "Sinhala", "Tamil"]', '["Weddings", "Corporate Events", "Award Shows"]', NULL, 0, 2, NULL, NULL, NULL, 4.90, 39, 0, 'Most Popular', NULL, 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(6, 5, 'The Groove Masters', 'the-groove-masters', NULL, '6-piece band specializing in contemporary and classic hits', '6-piece band specializing in contemporary and classic hits', 50000.00, 'event', '["Professional service", "Experienced provider", "Quality guaranteed"]', 'Premium', 15, '["English", "Sinhala"]', '["Pop", "Rock", "Jazz", "Soul"]', NULL, 1, 3, NULL, NULL, NULL, 4.70, 46, 0, NULL, NULL, 0, 0, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(7, 6, 'James Wilson', 'james-wilson', NULL, 'Certified sound engineer with expertise in live events', 'Certified sound engineer with expertise in live events', 15000.00, 'day', '["Professional service", "Experienced provider", "Quality guaranteed"]', 'Professional', 8, '["English"]', '["Live Mixing", "System Setup", "Recording"]', NULL, 0, 4, NULL, NULL, NULL, 4.60, 39, 0, NULL, NULL, 0, 0, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(8, 7, 'Kumar Perera', 'kumar-perera', NULL, 'Creative lighting designer for events and shows', 'Creative lighting designer for events and shows', 12000.00, 'day', '["Professional service", "Experienced provider", "Quality guaranteed"]', 'Professional', 6, '["English", "Sinhala"]', '["Stage Lighting", "Architectural Lighting", "Effects"]', NULL, 0, 4, NULL, NULL, NULL, 4.50, 16, 0, NULL, NULL, 0, 0, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(9, 8, 'Lisa Anderson', 'lisa-anderson', NULL, 'Award-winning photographer specializing in events', 'Award-winning photographer specializing in events', 35000.00, 'event', '["High-resolution images", "Post-production editing", "Online gallery", "Print-ready files", "Quick turnaround"]', 'Premium', 10, '["English"]', '["Weddings", "Corporate", "Fashion", "Product"]', '["Canon 5D Mark IV", "Professional Lenses", "Studio Lights"]', 0, 4, NULL, NULL, NULL, 5.00, 46, 0, 'Award Winner', NULL, 0, 1, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(10, 8, 'Raj Kumar', 'raj-kumar', NULL, 'Creative photographer with unique perspective', 'Creative photographer with unique perspective', 25000.00, 'event', '["High-resolution images", "Post-production editing", "Online gallery", "Print-ready files", "Quick turnaround"]', 'Professional', 7, '["English", "Tamil"]', '["Events", "Portraits", "Documentary"]', NULL, 0, 4, NULL, NULL, NULL, 4.70, 30, 0, NULL, NULL, 0, 0, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(11, 9, 'Chris Martin', 'chris-martin', NULL, '4K videography specialist with cinematic style', '4K videography specialist with cinematic style', 40000.00, 'event', '["4K video quality", "Professional editing", "Highlight reel", "Full event coverage", "Digital delivery"]', 'Premium', 9, '["English"]', '["Weddings", "Corporate Videos", "Music Videos"]', '["RED Camera", "Drone", "Gimbal", "Professional Audio"]', 0, 4, NULL, NULL, NULL, 4.90, 38, 0, '4K Specialist', NULL, 0, 0, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(12, 10, 'Emma Thompson', 'emma-thompson', NULL, 'Certified event planner with attention to detail', 'Certified event planner with attention to detail', 20000.00, 'day', '["Professional service", "Experienced provider", "Quality guaranteed"]', 'Professional', 8, '["English", "Sinhala"]', '["Wedding Planning", "Corporate Events", "Private Parties"]', NULL, 0, 8, NULL, NULL, NULL, 4.80, 35, 0, NULL, NULL, 0, 0, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(13, 11, 'Professional Ushering Services', 'professional-ushering-services', NULL, 'Team of trained ushers for all events', 'Team of trained ushers for all events', 5000.00, 'person/day', '["Professional service", "Experienced provider", "Quality guaranteed"]', 'Entry', 3, '["English", "Sinhala", "Tamil"]', '["Guest Management", "Crowd Control", "VIP Services"]', NULL, 0, 8, NULL, NULL, NULL, 4.40, 20, 0, NULL, NULL, 0, 0, 'active', '2025-07-02 18:19:56', '2025-07-02 18:19:56');

-- Dumping structure for table kl_mobile_events.service_provider_media
CREATE TABLE IF NOT EXISTS `service_provider_media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_provider_id` bigint unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_provider_media_service_provider_id_index` (`service_provider_id`),
  KEY `service_provider_media_type_index` (`type`),
  CONSTRAINT `service_provider_media_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.service_provider_media: ~23 rows (approximately)
INSERT INTO `service_provider_media` (`id`, `service_provider_id`, `type`, `url`, `thumbnail_url`, `title`, `description`, `sort_order`, `is_featured`, `created_at`, `updated_at`) VALUES
	(1, 2, 'photo', 'https://images.unsplash.com/photo-1571266028243-e4733b0f0bb0?w=800', 'https://images.unsplash.com/photo-1571266028243-e4733b0f0bb0?w=800', 'DJ Setup', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(2, 2, 'photo', 'https://images.unsplash.com/photo-1493676304819-0d7a8d026dcf?w=800', 'https://images.unsplash.com/photo-1493676304819-0d7a8d026dcf?w=800', 'Live Performance', NULL, 1, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(3, 2, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'https://via.placeholder.com/400x300', 'Performance Highlights', NULL, 2, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(4, 3, 'photo', 'https://images.unsplash.com/photo-1571266028243-e4733b0f0bb0?w=800', 'https://images.unsplash.com/photo-1571266028243-e4733b0f0bb0?w=800', 'DJ Setup', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(5, 3, 'photo', 'https://images.unsplash.com/photo-1493676304819-0d7a8d026dcf?w=800', 'https://images.unsplash.com/photo-1493676304819-0d7a8d026dcf?w=800', 'Live Performance', NULL, 1, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(6, 3, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'https://via.placeholder.com/400x300', 'Performance Highlights', NULL, 2, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(7, 4, 'photo', 'https://images.unsplash.com/photo-1571266028243-e4733b0f0bb0?w=800', 'https://images.unsplash.com/photo-1571266028243-e4733b0f0bb0?w=800', 'DJ Setup', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(8, 4, 'photo', 'https://images.unsplash.com/photo-1493676304819-0d7a8d026dcf?w=800', 'https://images.unsplash.com/photo-1493676304819-0d7a8d026dcf?w=800', 'Live Performance', NULL, 1, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(9, 4, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'https://via.placeholder.com/400x300', 'Performance Highlights', NULL, 2, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(10, 5, 'photo', 'https://via.placeholder.com/800x600', 'https://via.placeholder.com/800x600', 'Portfolio Image', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(11, 6, 'photo', 'https://via.placeholder.com/800x600', 'https://via.placeholder.com/800x600', 'Portfolio Image', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(12, 7, 'photo', 'https://via.placeholder.com/800x600', 'https://via.placeholder.com/800x600', 'Portfolio Image', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(13, 8, 'photo', 'https://via.placeholder.com/800x600', 'https://via.placeholder.com/800x600', 'Portfolio Image', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(14, 9, 'photo', 'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=800', 'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=800', 'Wedding Photography', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(15, 9, 'photo', 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800', 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800', 'Event Coverage', NULL, 1, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(16, 9, 'photo', 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800', 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800', 'Portrait Work', NULL, 2, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(17, 10, 'photo', 'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=800', 'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=800', 'Wedding Photography', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(18, 10, 'photo', 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800', 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800', 'Event Coverage', NULL, 1, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(19, 10, 'photo', 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800', 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800', 'Portrait Work', NULL, 2, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(20, 11, 'photo', 'https://images.unsplash.com/photo-1579632652768-6cb9dcf85912?w=800', 'https://images.unsplash.com/photo-1579632652768-6cb9dcf85912?w=800', 'Video Production', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(21, 11, 'video', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'https://via.placeholder.com/400x300', 'Wedding Highlights', NULL, 1, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(22, 12, 'photo', 'https://via.placeholder.com/800x600', 'https://via.placeholder.com/800x600', 'Portfolio Image', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(23, 13, 'photo', 'https://via.placeholder.com/800x600', 'https://via.placeholder.com/800x600', 'Portfolio Image', NULL, 0, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56');

-- Dumping structure for table kl_mobile_events.service_provider_pricing
CREATE TABLE IF NOT EXISTS `service_provider_pricing` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_provider_id` bigint unsigned NOT NULL,
  `tier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `included_features` json DEFAULT NULL,
  `additional_costs` json DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_provider_pricing_service_provider_id_index` (`service_provider_id`),
  CONSTRAINT `service_provider_pricing_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.service_provider_pricing: ~24 rows (approximately)
INSERT INTO `service_provider_pricing` (`id`, `service_provider_id`, `tier_name`, `price`, `duration`, `included_features`, `additional_costs`, `sort_order`, `is_popular`, `created_at`, `updated_at`) VALUES
	(4, 2, 'Basic (4 hours)', 25000.00, '4 hours', '["Basic sound system", "DJ performance", "Basic lighting"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(5, 2, 'Standard (6 hours)', 35000.00, '6 hours', '["Professional sound system", "DJ performance", "Light show", "MC services"]', NULL, 1, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(6, 2, 'Premium (8 hours)', 45000.00, '8 hours', '["Premium sound system", "DJ performance", "Full light show", "MC services", "Special effects"]', NULL, 2, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(7, 3, 'Basic (4 hours)', 30000.00, '4 hours', '["Basic sound system", "DJ performance", "Basic lighting"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(8, 3, 'Standard (6 hours)', 42000.00, '6 hours', '["Professional sound system", "DJ performance", "Light show", "MC services"]', NULL, 1, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(9, 3, 'Premium (8 hours)', 54000.00, '8 hours', '["Premium sound system", "DJ performance", "Full light show", "MC services", "Special effects"]', NULL, 2, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(10, 4, 'Basic (4 hours)', 20000.00, '4 hours', '["Basic sound system", "DJ performance", "Basic lighting"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(11, 4, 'Standard (6 hours)', 28000.00, '6 hours', '["Professional sound system", "DJ performance", "Light show", "MC services"]', NULL, 1, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(12, 4, 'Premium (8 hours)', 36000.00, '8 hours', '["Premium sound system", "DJ performance", "Full light show", "MC services", "Special effects"]', NULL, 2, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(13, 5, 'Standard', 20000.00, '4 hours', '["Professional service", "Quality guaranteed"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(14, 6, 'Standard', 50000.00, '4 hours', '["Professional service", "Quality guaranteed"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(15, 7, 'Standard', 15000.00, '4 hours', '["Professional service", "Quality guaranteed"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(16, 8, 'Standard', 12000.00, '4 hours', '["Professional service", "Quality guaranteed"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(17, 9, 'Half Day', 35000.00, '4 hours', '["Professional service", "Quality guaranteed"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(18, 9, 'Full Day', 63000.00, '8 hours', '["Professional service", "Quality guaranteed"]', NULL, 1, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(19, 9, 'Full Day + Album', 77000.00, '8 hours', '["Professional service", "Quality guaranteed"]', NULL, 2, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(20, 10, 'Half Day', 25000.00, '4 hours', '["Professional service", "Quality guaranteed"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(21, 10, 'Full Day', 45000.00, '8 hours', '["Professional service", "Quality guaranteed"]', NULL, 1, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(22, 10, 'Full Day + Album', 55000.00, '8 hours', '["Professional service", "Quality guaranteed"]', NULL, 2, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(23, 11, 'Highlights Only', 28000.00, '4 hours', '["Professional service", "Quality guaranteed"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(24, 11, 'Full Coverage', 40000.00, '8 hours', '["Professional service", "Quality guaranteed"]', NULL, 1, 1, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(25, 11, 'Cinematic Package', 60000.00, '8 hours', '["Professional service", "Quality guaranteed"]', NULL, 2, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(26, 12, 'Standard', 20000.00, '4 hours', '["Professional service", "Quality guaranteed"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56'),
	(27, 13, 'Standard', 5000.00, '4 hours', '["Professional service", "Quality guaranteed"]', NULL, 0, 0, '2025-07-02 18:19:56', '2025-07-02 18:19:56');

-- Dumping structure for table kl_mobile_events.service_provider_reviews
CREATE TABLE IF NOT EXISTS `service_provider_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_provider_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `booking_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `ratings_breakdown` json DEFAULT NULL,
  `verified_booking` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_provider_reviews_booking_id_foreign` (`booking_id`),
  KEY `service_provider_reviews_service_provider_id_index` (`service_provider_id`),
  KEY `service_provider_reviews_customer_id_index` (`customer_id`),
  KEY `service_provider_reviews_status_index` (`status`),
  KEY `service_provider_reviews_rating_index` (`rating`),
  CONSTRAINT `service_provider_reviews_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_provider_reviews_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_provider_reviews_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.service_provider_reviews: ~0 rows (approximately)

-- Dumping structure for table kl_mobile_events.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.sessions: ~27 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('21TPrxQJGCqcmumahJWzM7dYLDBHz8pYeeu4xSnE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoielJrYklHRUtCRWNuQ3FKeHNTSkttYlBNc08wQ3JRQWxWeDhiZDV2byI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbWFnZXMvbG9nby5wbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751680529),
	('2pR46KymnvPQsphPcORba9efbvspUmJb8LYAygyc', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiWUE4NXNCUVNhczRMWWk1eXEwRkszckxRblUwaUFGUU5xdWN5QXptOCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvaW1hZ2VzL2xvZ28ucG5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRKUDVLWml0aUU1RUNGQUdiSVRtNkZPekFOdElhc3A3ZFdWSkJkWHF2NGQ0Q1dmSVdMSDlvbSI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1751681450),
	('4eHrm9Zs36GRaidrCeK8mewOhim1x2dtFaQr7fHN', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiR0pQRVlZNFBzT0tsS3FFT0llTTE4Zm51aDlEUmNSZFJTQ0N6dVc4NyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvaW1hZ2VzL2xvZ28ucG5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRKUDVLWml0aUU1RUNGQUdiSVRtNkZPekFOdElhc3A3ZFdWSkJkWHF2NGQ0Q1dmSVdMSDlvbSI7fQ==', 1751680522),
	('4W4fyYVP6NYXhYHrtrabnaFB9XyalwnXV7Te8wcz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieHRTVzdEWVBSQ1FCMEhkWk9Db2k5UU43V3Bic0ZYRUxwVVR4OU9GaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751705911),
	('7YYv9NbJPhzB1ZmNdS2H1x0L8yExFcMMSQttk159', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ2l2eGJMamtDb3k4NTFGWVN4T29xaTRZMjJMaEFhcmx0TEpaZm5JRiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL2Jvb2tpbmdzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9ib29raW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751681726),
	('BRRIqMZOJWttj2OEkuHzTLaccIekirrEapO4xcZb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzZuaUlGeWdrRmp5a2s5c0w5NG9rRkg4aFE2RVZTMEV1bG5abDNNRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbWFnZXMvbG9nby5wbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751682331),
	('CG2J9GShvp0xxmnk4CxyT0fu2rvViElgYqswLR9K', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDJCV0ZDQXhNa3BFWmdTZ2IwcEp0cVlqN01JREdxQk5uSmtVcjl3TyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbWFnZXMvbG9nby5wbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751681730),
	('CwyCuTE9faN9HYrQmCVBOCURcHK9ZisLfJCWHeE0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDdkZzZ3NFNFanRlS2F2VjEyWHdiQjZ5OHlvb21KVFRCOFFISjFKTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751681727),
	('CYYLec3fS5Qjch2EKnMZ1Mb4xX4VaLHh1qAXyUnv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ1ZBYkRLNDd1Q2xjaFk4TWM3Q1plNDM0Nnd5MTJjN2lPYVRuU28wcSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL2Jvb2tpbmdzLzgvZWRpdCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQzOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vYm9va2luZ3MvOC9lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1751681426),
	('ejdumWFxRqx9ItEepUdRiVnVRp62bWl2eX2RE6ro', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSmRrU2NTUTFKejFSQlNsQnpXYk92NGNKUkc0Q3RrTm5PcWZKZExuQyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vYm9va2luZ3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJEpQNUtaaXRpRTVFQ0ZBR2JJVG02Rk96QU50SWFzcDdkV1ZKQmRYcXY0ZDRDV2ZJV0xIOW9tIjt9', 1751680098),
	('f0CAmhV7FAwShI8lTa92hhJURlJati7RyrLnq7Mn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGEyNnJYUGJOOEJBSGFGV01oVElNMFI1aGthaXoxVEV4QkNlQjd6WSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751682327),
	('fds3g67uw9pRBfHHCUHlvqS7jemNeUctJKdobBme', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoia00wWUdDVVljbzJGM3Axd1RRcWpVUXMzeVdNYW9IZ0Q4cHdqNVlUTCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaW1hZ2VzL2xvZ28ucG5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRKUDVLWml0aUU1RUNGQUdiSVRtNkZPekFOdElhc3A3ZFdWSkJkWHF2NGQ0Q1dmSVdMSDlvbSI7fQ==', 1751688573),
	('FKyReZfLciCHmlAAxY3MWtV7AX9NZ8V5QtjhfrPk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3Zhdk5KMDI2ZWZuSGMyb3RUS2hJcHRqaG9EUlg2czRUdHRJaHBaSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751688744),
	('HjXW9pcXtc48SRoKY5AtBZrkegzvJdzgkXCEX4wK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia25FbmNrNEJoaUw5Y0VzS0VtWFZuY0xkWkx0RFpzVGI1RENaY3dUbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751681427),
	('iPVZA9AT7juikg8XBluQieZseuyXDFAm4IeKoEVc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoienRXdjFjT1FYWkljdkNlQ1ltemt6Vk43YjVJd2NTeDFiWkt2WXUxYSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751680526),
	('NT6ZaWsGkr9ijtd6a0H9dUwDWJe2wnhIa0Efs1jb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVEU5RXhubUphWkFlSHFmZUI1Q0J4T2dlbXBZVHBkQktTSE9nNkpXZSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL2Jvb2tpbmdzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9ib29raW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751683227),
	('oeoHKuNW0LWjFFQ0wiIzjtFKGyzlhEMRzPzXAj7w', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUU5lSTlWcUxSbXdzTVFja21RbnNQRVRnb0tJUFhBMWVsVFdKWEdhQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751683229),
	('P0IcVQ8RXA0DnaTsPet0PATCfIox4BY9xphN1N9p', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiYWRhYWp0RHg4ajJvVGxVdUpxMmZHb0hJQjE1eDFxTUNtVHdTVmlCTCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQzOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vcGFja2FnZXMvMS9lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRKUDVLWml0aUU1RUNGQUdiSVRtNkZPekFOdElhc3A3ZFdWSkJkWHF2NGQ0Q1dmSVdMSDlvbSI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1751685264),
	('pXsGRWc2to4PHDsair9K4KFjR0xmAZgUknsz3xQZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOE1TQnluUVh0ZGphSlJweDFYeGJXR0ZjNVZFRVgyTVVHRXd0RmNhRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lcXVpcG1lbnQiO31zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4iO31zOjQ6ImNhcnQiO2E6MDp7fX0=', 1751689559),
	('QZX6h2BOwxFWJQ5Aj3v9e0DTsPYjxsjl4OFEjWdi', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiOWpDNEk2TlFvQmlMSkJXNGdNR3pqVFBWeTRnV1M1YjNpaTBGNUNIMiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvaW1hZ2VzL2xvZ28ucG5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRKUDVLWml0aUU1RUNGQUdiSVRtNkZPekFOdElhc3A3ZFdWSkJkWHF2NGQ0Q1dmSVdMSDlvbSI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1751680955),
	('ruc5Q7bQHt2QmZC1PfWOQYZB4OMEvkV432oNEFzC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic2VJRFZLN0V4YzZ3dkNOUTZaRWs2OFRwOXZ3ZGNJYjJnNjN6SDd4bCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL2Jvb2tpbmdzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9ib29raW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751682326),
	('vWSOfKh7jBN1kR7OurpJh3lAmXtwE6rxqHvBBEDH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRkRYUDZSaXc1MW91VnBPNUVZU2VSNktuVlh6eFRmSWlaV1cxd1pLeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbWFnZXMvbG9nby5wbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751688746),
	('w1Psa4ayxecFqQlpdtNBN0E1tTDCPbK73vqcc0VA', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoibUV0RVExOGowM3J5MWxRaEZVd0dobUlhQXZEQVZMYXhTbEMyNjlxSiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvaW1hZ2VzL2xvZ28ucG5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRKUDVLWml0aUU1RUNGQUdiSVRtNkZPekFOdElhc3A3ZFdWSkJkWHF2NGQ0Q1dmSVdMSDlvbSI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1751682640),
	('WL1aUGgYnGhSzIsRio6HaC1rOBnDfQgGwAfpiURH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOERYbEtoV05tSWl1UkdHdXJUaG5PODU0T3pvekliWkc5WnFUS05kNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751680527),
	('xiX1SEFDcVi4UuouQ74FSSxcMTOO1t8bNocRJ3LT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkd3M29kU2VmSWl0YmhQeng1bEthbnNzWXVQZkhNOUJtNEcwcEpFayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbWFnZXMvbG9nby5wbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751681429),
	('YdBSPIqDO1ihrOSPpl1HDhhnxFcuCfKvTRojw9Hh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUNhV1hhZTM0bGJESmVKZ3JFNkRUTzlpRTQ3RVIwc0d3Yk9xSEloOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbWFnZXMvbG9nby5wbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751683230),
	('zJr0mI2kqCAg3kulZtDAVcTPpvs1y6OKitqSWCIa', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiY0d0UDMzeHFadFdGMTNqeDhRdG93Z3FCaVdrNzNRSTVFdFVnMUdCaiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvaW1hZ2VzL2xvZ28ucG5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRKUDVLWml0aUU1RUNGQUdiSVRtNkZPekFOdElhc3A3ZFdWSkJkWHF2NGQ0Q1dmSVdMSDlvbSI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1751687852);

-- Dumping structure for table kl_mobile_events.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kl_mobile_events.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `email_verified_at`, `password`, `remember_token`, `last_login_at`, `created_at`, `updated_at`) VALUES
	(8, 'John Doe', 'customer@test.com', 0, '2025-07-01 07:37:06', '$2y$12$Pfflzjmbu3vDR1jyUFcC6OTJSqEx1qFX6w0S4QT8BfRDO7ERykKdW', NULL, NULL, '2025-07-01 07:37:06', '2025-07-01 07:37:06'),
	(9, 'A.G.T. Kaushalya Wickramasinghe', 'tekiyagaming@gmail.com', 0, NULL, '$2y$12$pRw4xMOTdgG1N2dsSZ4MJ.3iMdX8r9CCZXKJyLuzuLAH79mShpUQm', NULL, '2025-07-04 17:23:40', '2025-07-03 18:23:30', '2025-07-04 17:23:40'),
	(11, 'admin', 'admin@gmail.com', 1, NULL, '$2y$12$JP5KZitiE5ECFAGbITm6FOzANtIasp7dWVJBdXqv4d4CWfIWLH9om', 'Z0fdHHRFZXf2ruX4PurW6Vp6usiQEXWCh37YpENOlGSeaUBrhPlhH1gzfCmd', NULL, '2025-07-04 17:37:12', '2025-07-04 17:37:12');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
