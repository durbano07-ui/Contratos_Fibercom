/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.14-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: contratos_fibercom
-- ------------------------------------------------------
-- Server version	10.11.14-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anexo2`
--

DROP TABLE IF EXISTS `anexo2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `anexo2` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_contrato` bigint(20) unsigned NOT NULL,
  `equipos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`equipos`)),
  `compra_credito` tinyint(1) NOT NULL DEFAULT 0,
  `arrendamiento` tinyint(1) NOT NULL DEFAULT 0,
  `compra_contado` tinyint(1) NOT NULL DEFAULT 0,
  `valor_mensual_arrendamiento` decimal(8,2) DEFAULT NULL,
  `valor_mensual_compra_credito` decimal(8,2) DEFAULT NULL,
  `cantidad_meses` int(11) DEFAULT NULL,
  `firma_cliente` longtext DEFAULT NULL,
  `datos_anexo3` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_anexo3`)),
  `completado_en` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anexo2_id_contrato_foreign` (`id_contrato`),
  CONSTRAINT `anexo2_id_contrato_foreign` FOREIGN KEY (`id_contrato`) REFERENCES `contracts` (`id_contrato`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anexo2`
--

LOCK TABLES `anexo2` WRITE;
/*!40000 ALTER TABLE `anexo2` DISABLE KEYS */;
INSERT INTO `anexo2` VALUES
(3,3,'[{\"equipment_id\":null,\"nombre\":\"V-SOL\",\"categoria\":\"ONU\",\"marca\":\"V-SOL\",\"modelo\":\"\",\"cantidad\":1,\"precio_unitario\":0,\"serial\":null,\"estado_equipo\":\"Nuevo\"},{\"equipment_id\":null,\"nombre\":\"Ruijie AX 3000 Wifi 6\",\"categoria\":\"Router\",\"marca\":\"Ruijie AX 3000 Wifi 6\",\"modelo\":\"\",\"cantidad\":1,\"precio_unitario\":0,\"serial\":null,\"estado_equipo\":\"Nuevo\"}]',0,1,0,15.00,0.00,24,NULL,'{\"ip_asignada\":\"192.168.1.1\",\"verifico_ancho_banda\":\"1\",\"bloqueo_web\":null,\"bloqueo_servicios\":null,\"bloqueo_puertos\":null}','2026-09-23 22:08:49','2026-09-23 22:06:25','2026-09-23 22:08:49');
/*!40000 ALTER TABLE `anexo2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES
(1,1,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-18 07:08:19','2026-09-18 07:08:19'),
(2,1,'Equipo Actualizado','Inventario','\'Cable UTP Categoría 6 Ext\': stock 300 → 300 metro','2026-09-18 07:10:42','2026-09-18 07:10:42'),
(3,1,'Equipo Eliminado','Inventario','Equipo \'ONU GPON / ONT Óptica\' eliminado del inventario','2026-09-18 07:10:52','2026-09-18 07:10:52'),
(4,1,'Equipo Eliminado','Inventario','Equipo \'Regulador de Voltaje (1000VA / 8 Tomas)\' eliminado del inventario','2026-09-18 07:10:55','2026-09-18 07:10:55'),
(5,1,'Equipo Eliminado','Inventario','Equipo \'Cable UTP Categoría 6 Ext\' eliminado del inventario','2026-09-18 07:10:58','2026-09-18 07:10:58'),
(6,1,'Equipo Eliminado','Inventario','Equipo \'Router Wi-Fi Dual Band\' eliminado del inventario','2026-09-18 07:11:02','2026-09-18 07:11:02'),
(7,1,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-18 07:11:53','2026-09-18 07:11:53'),
(8,2,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-18 07:12:04','2026-09-18 07:12:04'),
(9,2,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-18 07:17:36','2026-09-18 07:17:36'),
(10,3,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-18 07:17:40','2026-09-18 07:17:40'),
(11,3,'Anexo 2 Completado','Técnico / Anexo 2','Contrato #ISP-2 — Anexo 2 completado por Jefe Técnico Fibercom','2026-09-18 07:30:11','2026-09-18 07:30:11'),
(12,3,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-18 07:36:49','2026-09-18 07:36:49'),
(13,3,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-18 07:36:53','2026-09-18 07:36:53'),
(14,3,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-18 07:37:14','2026-09-18 07:37:14'),
(15,2,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-18 07:37:18','2026-09-18 07:37:18'),
(16,2,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-18 08:11:18','2026-09-18 08:11:18'),
(17,27,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-18 08:12:45','2026-09-18 08:12:45'),
(18,14,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-23 21:28:29','2026-09-23 21:28:29'),
(19,14,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-23 22:06:59','2026-09-23 22:06:59'),
(20,19,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-23 22:07:01','2026-09-23 22:07:01'),
(21,19,'Anexo 2 Completado','Técnico / Anexo 2','Contrato #ISP-3 — Anexo 2 completado por PILCO SORIA DARWIN PATRICIO','2026-09-23 22:08:51','2026-09-23 22:08:51'),
(22,19,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-23 22:09:16','2026-09-23 22:09:16'),
(23,14,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-23 22:09:19','2026-09-23 22:09:19'),
(24,14,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-23 22:11:29','2026-09-23 22:11:29'),
(25,14,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-23 22:29:36','2026-09-23 22:29:36'),
(26,14,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-23 22:29:41','2026-09-23 22:29:41'),
(27,27,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-23 22:29:46','2026-09-23 22:29:46'),
(28,27,'Contrato Modificado','Contratos','Contrato #ISP-3: plan anterior \'FIBER PLAN DISCAPACIDAD\', fecha 2026-09-23, técnico: PILCO SORIA DARWIN PATRICIO → CHELA MILÁN ELVIS CRISTIAN','2026-09-23 22:37:19','2026-09-23 22:37:19'),
(29,27,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-23 22:37:28','2026-09-23 22:37:28'),
(30,14,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-23 22:37:33','2026-09-23 22:37:33'),
(31,14,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-23 22:46:41','2026-09-23 22:46:41'),
(32,14,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-23 22:46:45','2026-09-23 22:46:45'),
(33,14,'Cierre de Sesión','Sistema / Auth','Usuario cerró su sesión de forma segura','2026-09-23 22:46:58','2026-09-23 22:46:58'),
(34,27,'Inicio de Sesión','Sistema / Auth','Acceso correcto al panel administrativo mediante cédula','2026-09-23 22:47:09','2026-09-23 22:47:09');
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES
('laravel-cache-bc33ea4e26e5e1af1408321416956113a4658763','i:1;',1790186901),
('laravel-cache-bc33ea4e26e5e1af1408321416956113a4658763:timer','i:1790186901;',1790186901),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0','i:1;',1789697588),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer','i:1789697588;',1789697588),
('laravel-cache-fa35e192121eabf3dabf9f5ea6abdbcbc107ac3b','i:1;',1790185674),
('laravel-cache-fa35e192121eabf3dabf9f5ea6abdbcbc107ac3b:timer','i:1790185674;',1790185674);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id_cliente` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `canton` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `n_telefono` varchar(255) DEFAULT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'activo',
  `fecha_baja` timestamp NULL DEFAULT NULL,
  `motivo_baja` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `clients_cedula_unique` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES
(1,'Diego Jesus Urbano Borja','','0250180700','durbano065@gmail.com','Guanujo Vía a Las Cochas','Guaranda','Guaranda','Bolívar','0989135533','activo',NULL,NULL,'2026-09-18 07:14:00','2026-09-23 22:06:25');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `contracts` (
  `id_contrato` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `id_tecnico` bigint(20) unsigned DEFAULT NULL,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `id_plan` bigint(20) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `hora_creacion` time NOT NULL,
  `direccion_servicio` varchar(255) DEFAULT NULL,
  `metodo_pago` varchar(255) DEFAULT NULL,
  `datos_pago` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_pago`)),
  `equipos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`equipos`)),
  `duracion` varchar(255) NOT NULL DEFAULT '24',
  `beneficio_ley` tinyint(1) NOT NULL DEFAULT 0,
  `pdf_ruta` varchar(255) DEFAULT NULL,
  `estado_anexo2` enum('pendiente','completado') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_contrato`),
  KEY `contracts_id_usuario_foreign` (`id_usuario`),
  KEY `contracts_id_cliente_foreign` (`id_cliente`),
  KEY `contracts_id_plan_foreign` (`id_plan`),
  KEY `contracts_id_tecnico_foreign` (`id_tecnico`),
  CONSTRAINT `contracts_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clients` (`id_cliente`) ON DELETE CASCADE,
  CONSTRAINT `contracts_id_plan_foreign` FOREIGN KEY (`id_plan`) REFERENCES `internet_plans` (`id_plan`) ON DELETE CASCADE,
  CONSTRAINT `contracts_id_tecnico_foreign` FOREIGN KEY (`id_tecnico`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `contracts_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
INSERT INTO `contracts` VALUES
(3,14,11,1,1,'2026-09-23','17:06:25','Casa propia','direct',NULL,'[]','24',0,'contracts/contrato_3_1790183329.pdf','completado','2026-09-23 22:06:25','2026-09-23 22:37:19');
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `stock_minimo` int(11) NOT NULL DEFAULT 5,
  `unidad` varchar(255) NOT NULL DEFAULT 'unidad',
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `internet_plans`
--

DROP TABLE IF EXISTS `internet_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `internet_plans` (
  `id_plan` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tipo` bigint(20) unsigned NOT NULL,
  `nombre_plan` varchar(255) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `precio_regular` decimal(8,2) DEFAULT NULL,
  `es_promocional` tinyint(1) NOT NULL DEFAULT 0,
  `velocidad` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_plan`),
  KEY `internet_plans_id_tipo_foreign` (`id_tipo`),
  CONSTRAINT `internet_plans_id_tipo_foreign` FOREIGN KEY (`id_tipo`) REFERENCES `internet_types` (`id_tipo`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internet_plans`
--

LOCK TABLES `internet_plans` WRITE;
/*!40000 ALTER TABLE `internet_plans` DISABLE KEYS */;
INSERT INTO `internet_plans` VALUES
(1,1,'FIBER PLAN DISCAPACIDAD',15.00,NULL,0,'100 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(2,1,'FIBER PLAN TERCERA EDAD 550 MEGAS',15.00,30.00,1,'550 MEGAS','2026-09-18 07:07:38','2026-09-23 22:42:36'),
(3,1,'PLAN ESTUDIANTIL 400 MEGAS',20.00,NULL,0,'400 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(4,1,'PLAN FAMILIA 500 MEGAS',25.00,NULL,0,'500 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(5,1,'PLAN FULL 550 MEGAS',30.00,NULL,0,'550 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(6,1,'PLAN PYMES ULTRA',50.00,NULL,0,'150 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(7,2,'PYMES PLUS 30 MEGAS',51.75,NULL,0,'30 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(8,2,'PYMES FULL 40 MEGAS',80.50,NULL,0,'40 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(9,2,'PYMES EXTREME 50 MEGAS',103.50,NULL,0,'50 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(10,2,'HOME PLAN DISCAPACIDAD',15.00,NULL,0,'8 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(11,2,'HOME PLAN TERCERA EDAD',15.00,NULL,0,'8 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(12,2,'HOME ESTUDIANTIL',20.00,NULL,0,'12 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(13,2,'SIGNAL HOME PLUS',22.00,NULL,0,'15 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(14,2,'HOME FAMILIA',25.00,NULL,0,'20 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(15,2,'HOME FULL',30.00,NULL,0,'30 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(16,2,'HOME EXCLUSIVO',35.00,NULL,0,'35 MEGAS','2026-09-18 07:07:38','2026-09-18 07:07:38');
/*!40000 ALTER TABLE `internet_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `internet_types`
--

DROP TABLE IF EXISTS `internet_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `internet_types` (
  `id_tipo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internet_types`
--

LOCK TABLES `internet_types` WRITE;
/*!40000 ALTER TABLE `internet_types` DISABLE KEYS */;
INSERT INTO `internet_types` VALUES
(1,'Fibra Óptica','2026-09-18 07:07:38','2026-09-18 07:07:38'),
(2,'Radio Enlace','2026-09-18 07:07:38','2026-09-18 07:07:38');
/*!40000 ALTER TABLE `internet_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_03_24_220948_create_clients_table',1),
(5,'2026_03_24_220949_create_internet_types_table',1),
(6,'2026_03_24_220950_create_internet_plans_table',1),
(7,'2026_03_24_220951_create_contracts_table',1),
(8,'2026_03_26_184539_create_audit_logs_table',1),
(9,'2026_04_06_000002_create_equipment_table',1),
(10,'2026_04_06_000003_add_estado_to_clients_table',1),
(11,'2026_04_06_000004_add_tecnico_to_contracts_table',1),
(12,'2026_04_06_000005_create_anexo2_table',1),
(13,'2026_04_10_015941_add_missing_fields_to_contracts_table',1),
(14,'2026_04_23_013513_add_firma_cliente_to_anexo2_table',1),
(15,'2026_04_26_002002_add_datos_anexo3_to_anexo2_table',1),
(16,'2026_04_27_000001_add_datos_pago_to_contracts_table',1),
(17,'2026_04_27_000002_add_equipos_to_contracts_table',1),
(18,'2026_04_11_000001_add_promocion_fields_to_internet_plans_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('hoBjfk0HYnDxA0RtfRozysHNvhkQVlo1gWAowJq7',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:144.0) Gecko/20100101 Firefox/144.0','eyJfdG9rZW4iOiJMclZpUHJCQ3lhNWYyTlhZTWJxWHVEQ1RWNnF4MUNwSGJxb2pad0NkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790180751),
('sfgzTstn1I4xrhPvSiwBu7x7kIDgxhpylEXXyq13',27,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:144.0) Gecko/20100101 Firefox/144.0','eyJfdG9rZW4iOiJ4UzhHTUI1WTFLU1lNbmYyMElpSUFoMHBuaW5XbUhoMmY4Q3dGc0h4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hcGlcL3BsYW5zXC9ieS10eXBlXC8xIiwicm91dGUiOiJhcGkucGxhbnMuYnktdHlwZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyN30=',1790186841),
('xV8GqEb5nA1yGpImHrmBetYj2mO8TiHLgwOFLqNv',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:144.0) Gecko/20100101 Firefox/144.0','eyJfdG9rZW4iOiJQNzVWQ0NlUWxZZzJRVkk2bndlT0NVeGtCTnJsV25xRXNoRFdCVlZRIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790180751);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_cedula_unique` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(4,'ASERO TIPANLUISA MÓNICA CRISTINA','1717797896','administrativo',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(5,'BAYAS PATÍN CESAR VINICIO','0201920972','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(6,'BETANCOUR MAYER JOHN JAIRO','0804177806','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(7,'CACHIMUEL RAMOS JAIME ENRIQUE','1712611969','administrador',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(8,'CACHIMUEL URBANO LEONARDO DAVID','1750915587','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(9,'CACHIMUEL URBANO TAMIA BELEN','1750915611','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(10,'CAIZA PUNINA DUBAL LIZANDRO','0202472288','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(11,'CHELA MILÁN ELVIS CRISTIAN','0202135356','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(12,'CUELLO GUERRERO DAVID ISRAEL','0202188322','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(13,'GARCIA ZURITA PATRICIA MARISOL','1207234566','administrativo',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(14,'MANOBANDA MANOBANDA ÉRIKA MISHELL','0202349585','administrador',NULL,'2026-09-18 08:10:30','2026-09-23 22:48:40'),
(15,'MOPOSITA ROCHINA CRISTIAN DANILO','0202005286','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(16,'PAGUAY JUAN CARLOS','1717486532','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(17,'PARCO CARVAJAL DARWIN RODRIGO','0202320776','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(18,'PARCO CARVAJAL JOHANA MARIBEL','0250132610','administrativo',NULL,'2026-09-18 08:10:30','2026-09-23 22:48:25'),
(19,'PILCO SORIA DARWIN PATRICIO','1725692071','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(20,'PRADO MAYER LEONEL JOHAO','0803810522','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(21,'PUNINA PUNINA FREDDY GONZALO','0202358826','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(22,'QUIÑONEZ DIAZ JEAN CARLOS','0803810183','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(23,'RAMOS PURCACHI JHOMAYRA LILIBHET','0202101762','administrativo',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(24,'TANDAPILCO MUÑOZ MICHAEL EDUARDO','0250210796','tecnico',NULL,'2026-09-18 08:10:30','2026-09-23 22:49:27'),
(26,'TINITANA GAVILANES JORGE LUIS','0201708625','tecnico',NULL,'2026-09-18 08:10:30','2026-09-23 22:49:37'),
(27,'URBANO BORJA DIEGO JESÚS','0250180700','administrador',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(28,'URBANO URBANO LUCÍA','0201657897','administrativo',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(29,'VARGAS ROBERTO ALFREDO','0201355468','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30'),
(30,'YANZA YANZA EDWIN JOEL','0202404638','tecnico',NULL,'2026-09-18 08:10:30','2026-09-18 08:10:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'contratos_fibercom'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-27 16:58:09
