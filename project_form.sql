-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema project_form
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema project_form
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `project_form` DEFAULT CHARACTER SET utf8mb4 ;
USE `project_form` ;

-- -----------------------------------------------------
-- Table `project_form`.`department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`department` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `department` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 47
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`failed_jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`failed_jobs` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `failed_jobs_uuid_unique` (`uuid` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `project_form`.`gender`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`gender` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `gender` CHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`jenis_inventaris`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`jenis_inventaris` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `jenis_inventaris` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`inventaris`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`inventaris` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `jenis_inventaris_id` INT(11) NOT NULL,
  `nama` VARCHAR(100) NULL DEFAULT NULL,
  `no_inventaris` VARCHAR(45) NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `jenis_inventaris_id` (`jenis_inventaris_id` ASC) VISIBLE,
  CONSTRAINT `inventaris_ibfk_1`
    FOREIGN KEY (`jenis_inventaris_id`)
    REFERENCES `project_form`.`jenis_inventaris` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 28
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`jabatan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`jabatan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `jabatan` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`unit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`unit` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `department_id` INT(11) NULL DEFAULT NULL,
  `nama_unit` VARCHAR(100) NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `unit_ibfk_1` (`department_id` ASC) VISIBLE,
  CONSTRAINT `unit_ibfk_1`
    FOREIGN KEY (`department_id`)
    REFERENCES `project_form`.`department` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `nik` VARCHAR(50) NULL DEFAULT NULL,
  `username` VARCHAR(50) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `password` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `gender_id` INT(11) NOT NULL,
  `department_id` INT(11) NULL DEFAULT NULL,
  `unit_id` INT(11) NULL DEFAULT NULL,
  `status_id` INT(11) NOT NULL DEFAULT 1,
  `jabatan_id` INT(11) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `remember_token` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `users_ibfk_4` (`status_id` ASC) VISIBLE,
  INDEX `users_ibfk_1` (`gender_id` ASC) VISIBLE,
  INDEX `users_ibfk_2` (`jabatan_id` ASC) VISIBLE,
  INDEX `users_ibfk_3` (`department_id` ASC) VISIBLE,
  INDEX `user_unit` (`unit_id` ASC) VISIBLE,
  CONSTRAINT `user_unit`
    FOREIGN KEY (`unit_id`)
    REFERENCES `project_form`.`unit` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_1`
    FOREIGN KEY (`gender_id`)
    REFERENCES `project_form`.`gender` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_2`
    FOREIGN KEY (`jabatan_id`)
    REFERENCES `project_form`.`jabatan` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_3`
    FOREIGN KEY (`department_id`)
    REFERENCES `project_form`.`department` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 56
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`teknisi_umum`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`teknisi_umum` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_teknisi_umum` CHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`service`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`service` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `no_tiket` CHAR(20) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `inventaris_id` INT(11) NOT NULL,
  `status_id` INT(11) NOT NULL,
  `service` TEXT NULL DEFAULT NULL,
  `biaya_service` BIGINT(20) NULL DEFAULT NULL,
  `keterangan` TEXT NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  `teknisi_id` INT(11) NULL DEFAULT NULL,
  `tgl_teknisi` DATETIME NULL DEFAULT NULL,
  `type_permohonan` CHAR(1) NULL DEFAULT '0',
  `teknisi_umum_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `service_ibfk_3` (`status_id` ASC) VISIBLE,
  INDEX `inventaris_id` (`inventaris_id` ASC) VISIBLE,
  INDEX `teknisi_id` (`teknisi_id` ASC) VISIBLE,
  INDEX `service_ibfk_4` (`user_id` ASC) VISIBLE,
  INDEX `teknisi_umum_id` (`teknisi_umum_id` ASC) VISIBLE,
  CONSTRAINT `service_ibfk_3`
    FOREIGN KEY (`status_id`)
    REFERENCES `project_form`.`status` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `service_ibfk_4`
    FOREIGN KEY (`user_id`)
    REFERENCES `project_form`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `service_ibfk_5`
    FOREIGN KEY (`inventaris_id`)
    REFERENCES `project_form`.`inventaris` (`id`),
  CONSTRAINT `service_ibfk_7`
    FOREIGN KEY (`teknisi_umum_id`)
    REFERENCES `project_form`.`teknisi_umum` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 37
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`keterangan_service`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`keterangan_service` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `service_id` INT(11) NOT NULL,
  `keterangan` TEXT NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `keterangan_service_ibfk_1` (`service_id` ASC) VISIBLE,
  INDEX `keterangan_service_ibfk_2` (`user_id` ASC) VISIBLE,
  CONSTRAINT `keterangan_service_ibfk_1`
    FOREIGN KEY (`service_id`)
    REFERENCES `project_form`.`service` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `keterangan_service_ibfk_2`
    FOREIGN KEY (`user_id`)
    REFERENCES `project_form`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 44
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `project_form`.`obat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`obat` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_obat` VARCHAR(100) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`pasien`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`pasien` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `nama_pasien` VARCHAR(100) NOT NULL,
  `no_rm` INT(11) NOT NULL,
  `ruangan` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `user_id` (`user_id` ASC) VISIBLE,
  CONSTRAINT `pasien_ibfk_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `project_form`.`users` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `project_form`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`password_resets` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `project_form`.`personal_access_tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`personal_access_tokens` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` VARCHAR(255) NOT NULL,
  `tokenable_id` BIGINT(20) UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `token` VARCHAR(64) NOT NULL,
  `abilities` TEXT NULL DEFAULT NULL,
  `last_used_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `personal_access_tokens_token_unique` (`token` ASC) VISIBLE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type` ASC, `tokenable_id` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `project_form`.`retur_obat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_form`.`retur_obat` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` INT(11) NOT NULL,
  `obat_alkes` VARCHAR(45) NOT NULL,
  `jumlah` INT(11) NOT NULL,
  `satuan` VARCHAR(20) NOT NULL,
  `no_batch` VARCHAR(50) NULL DEFAULT NULL,
  `expired_date` DATE NOT NULL,
  `keterangan` TEXT NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `pasien_id` (`pasien_id` ASC) VISIBLE,
  CONSTRAINT `retur_obat_ibfk_1`
    FOREIGN KEY (`pasien_id`)
    REFERENCES `project_form`.`pasien` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
