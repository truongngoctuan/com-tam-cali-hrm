﻿SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `comtamcali_hrm` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `comtamcali_hrm` ;

-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`BO_PHAN`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`BO_PHAN` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`BO_PHAN` (
  `MA` BIGINT NOT NULL AUTO_INCREMENT ,
  `TEN` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`MA`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`CA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`CA` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`CA` (
  `MA` BIGINT NOT NULL AUTO_INCREMENT ,
  `TEN` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`MA`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`LOAI_NGAY`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`LOAI_NGAY` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`LOAI_NGAY` (
  `MA` BIGINT NOT NULL AUTO_INCREMENT ,
  `TEN` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`MA`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`NGUON`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`NGUON` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`NGUON` (
  `MA` BIGINT NOT NULL AUTO_INCREMENT ,
  `TEN` VARCHAR(150) NOT NULL ,
  `DIEN_GIAI` VARCHAR(150) NULL ,
  PRIMARY KEY (`MA`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`CHI_NHANH`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`CHI_NHANH` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`CHI_NHANH` (
  `MA` BIGINT NOT NULL AUTO_INCREMENT ,
  `TEN_NGAN` VARCHAR(45) NOT NULL ,
  `TEN_DAI` VARCHAR(150) NOT NULL ,
  `DIA_CHI` VARCHAR(150) NULL ,
  `DIEN_THOAI` VARCHAR(150) NULL ,
  PRIMARY KEY (`MA`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`NV_STATE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`NV_STATE` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`NV_STATE` (
  `MA` BIGINT NOT NULL AUTO_INCREMENT ,
  `TEN` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`MA`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`NHAN_VIEN`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`NHAN_VIEN` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`NHAN_VIEN` (
  `MA` BIGINT NOT NULL AUTO_INCREMENT ,
  `MA_BP` BIGINT NOT NULL ,
  `MA_NGUON` BIGINT NOT NULL ,
  `MA_CN` BIGINT NOT NULL ,
  `MA_NV_STATE` BIGINT NOT NULL ,
  `NGAY_PHONG_VAN` TIMESTAMP NULL ,
  `NGAY_VAO_LAM` TIMESTAMP NULL ,
  `LY_DO_KHONG_NHAN` VARCHAR(150) NULL ,
  `B_KINH_NGHIEM` TINYINT(1) NULL ,
  `GHI_CHU_NHAN_NV` VARCHAR(150) NULL ,
  `MA_NV_CHINH_THUC` VARCHAR(45) NULL ,
  `NGAY_SINH` TIMESTAMP NULL ,
  `DIA_CHI_HIEN_TAI` VARCHAR(150) NULL ,
  `HO_KHAU` VARCHAR(150) NULL ,
  `SDT` VARCHAR(45) NULL ,
  `CMND` VARCHAR(45) NULL ,
  `NGAY_CAP` TIMESTAMP NULL ,
  `NOI_CAP` VARCHAR(45) NULL ,
  `HO_SO` VARCHAR(45) NULL ,
  `GHI_CHU` VARCHAR(150) NULL ,
  PRIMARY KEY (`MA`) ,
  INDEX `MA_BP_idx` (`MA_BP` ASC) ,
  INDEX `FK_NV_NGUON_idx` (`MA_NGUON` ASC) ,
  INDEX `FK_NV_CN_idx` (`MA_CN` ASC) ,
  INDEX `FK_NV_STATE_idx` (`MA_NV_STATE` ASC) ,
  CONSTRAINT `FK_NV_BP`
    FOREIGN KEY (`MA_BP` )
    REFERENCES `comtamcali_hrm`.`BO_PHAN` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_NV_NGUON`
    FOREIGN KEY (`MA_NGUON` )
    REFERENCES `comtamcali_hrm`.`NGUON` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_NV_CN`
    FOREIGN KEY (`MA_CN` )
    REFERENCES `comtamcali_hrm`.`CHI_NHANH` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_NV_STATE`
    FOREIGN KEY (`MA_NV_STATE` )
    REFERENCES `comtamcali_hrm`.`NV_STATE` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`NHU_CAU_TUYEN_DUNG`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`NHU_CAU_TUYEN_DUNG` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`NHU_CAU_TUYEN_DUNG` (
  `LOAI_NGAY` BIGINT NOT NULL ,
  `MA_CA` BIGINT NOT NULL ,
  `TU_NGAY` TIMESTAMP NOT NULL ,
  `MA_BP` BIGINT NOT NULL ,
  `MA_CN` BIGINT NOT NULL ,
  `SO_LUONG` INT NULL ,
  PRIMARY KEY (`LOAI_NGAY`, `MA_CA`, `TU_NGAY`, `MA_BP`, `MA_CN`) ,
  INDEX `FK_NCTD_LOAINGAY_idx` (`LOAI_NGAY` ASC) ,
  INDEX `FK_NCTD_CA_idx` (`MA_CA` ASC) ,
  INDEX `FK_NCTD_BP_idx` (`MA_BP` ASC) ,
  INDEX `FK_NCTD_CN_idx` (`MA_CN` ASC) ,
  CONSTRAINT `FK_NCTD_LOAINGAY`
    FOREIGN KEY (`LOAI_NGAY` )
    REFERENCES `comtamcali_hrm`.`LOAI_NGAY` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_NCTD_CA`
    FOREIGN KEY (`MA_CA` )
    REFERENCES `comtamcali_hrm`.`CA` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_NCTD_BP`
    FOREIGN KEY (`MA_BP` )
    REFERENCES `comtamcali_hrm`.`BO_PHAN` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_NCTD_CN`
    FOREIGN KEY (`MA_CN` )
    REFERENCES `comtamcali_hrm`.`CHI_NHANH` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`PHAN_CONG`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`PHAN_CONG` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`PHAN_CONG` (
  `MA_NV` BIGINT NOT NULL ,
  `MA_CA` BIGINT NOT NULL ,
  `TU_NGAY` TIMESTAMP NOT NULL ,
  `THU` VARCHAR(45) NOT NULL ,
  `MA_CN` BIGINT NOT NULL ,
  `MA_BP` BIGINT NOT NULL ,
  `THOI_GIAN` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`MA_NV`, `MA_CA`, `TU_NGAY`, `THU`, `MA_CN`, `MA_BP`, `THOI_GIAN`) ,
  INDEX `FK_PHANCONG_NV_idx` (`MA_NV` ASC) ,
  INDEX `FK_PHANCONG_CA_idx` (`MA_CA` ASC) ,
  INDEX `FK_PHANCONG_CN_idx` (`MA_CN` ASC) ,
  INDEX `FK_PHANCONG_BP_idx` (`MA_BP` ASC) ,
  CONSTRAINT `FK_PHANCONG_NV`
    FOREIGN KEY (`MA_NV` )
    REFERENCES `comtamcali_hrm`.`NHAN_VIEN` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PHANCONG_CA`
    FOREIGN KEY (`MA_CA` )
    REFERENCES `comtamcali_hrm`.`CA` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PHANCONG_CN`
    FOREIGN KEY (`MA_CN` )
    REFERENCES `comtamcali_hrm`.`CHI_NHANH` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_PHANCONG_BP`
    FOREIGN KEY (`MA_BP` )
    REFERENCES `comtamcali_hrm`.`BO_PHAN` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`SO_LUONG_NHAN_VIEN`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`SO_LUONG_NHAN_VIEN` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`SO_LUONG_NHAN_VIEN` (
  `MA_CA` BIGINT NOT NULL ,
  `THU` VARCHAR(45) NOT NULL ,
  `TU_NGAY` TIMESTAMP NOT NULL ,
  `MA_BP` BIGINT NOT NULL ,
  `MA_CN` BIGINT NOT NULL ,
  `SO_LUONG` INT NULL ,
  PRIMARY KEY (`MA_CA`, `THU`, `TU_NGAY`, `MA_BP`, `MA_CN`) ,
  INDEX `FK_SLNV_CA_idx` (`MA_CA` ASC) ,
  INDEX `FK_SLNV_BP_idx` (`MA_BP` ASC) ,
  INDEX `FK_SLNV_CN_idx` (`MA_CN` ASC) ,
  CONSTRAINT `FK_SLNV_CA`
    FOREIGN KEY (`MA_CA` )
    REFERENCES `comtamcali_hrm`.`CA` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_SLNV_BP`
    FOREIGN KEY (`MA_BP` )
    REFERENCES `comtamcali_hrm`.`BO_PHAN` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_SLNV_CN`
    FOREIGN KEY (`MA_CN` )
    REFERENCES `comtamcali_hrm`.`CHI_NHANH` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`CHI_TIET_NHAN_VIEN`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`CHI_TIET_NHAN_VIEN` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`CHI_TIET_NHAN_VIEN` (
  `MA_NV` BIGINT NOT NULL ,
  `TU_NGAY` TIMESTAMP NOT NULL ,
  `MUC_LUONG` BIGINT NULL ,
  `PHU_CAP` BIGINT NULL ,
  `THUONG_QUY` BIGINT NULL ,
  PRIMARY KEY (`MA_NV`, `TU_NGAY`) ,
  INDEX `FK_CTNV_NV_idx` (`MA_NV` ASC) ,
  CONSTRAINT `FK_CTNV_NV`
    FOREIGN KEY (`MA_NV` )
    REFERENCES `comtamcali_hrm`.`NHAN_VIEN` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`NGHI_PHEP`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`NGHI_PHEP` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`NGHI_PHEP` (
  `MA_NV` BIGINT NOT NULL ,
  `LY_DO` VARCHAR(150) NULL ,
  `NGUOI_DUYET` VARCHAR(45) NULL ,
  `TU_NGAY` TIMESTAMP NOT NULL ,
  `GHI_CHU` VARCHAR(150) NULL ,
  `DEN_NGAY` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`MA_NV`, `TU_NGAY`, `DEN_NGAY`) ,
  INDEX `FK_NGHIPHEP_MANV_idx` (`MA_NV` ASC) ,
  CONSTRAINT `FK_NGHIPHEP_NV`
    FOREIGN KEY (`MA_NV` )
    REFERENCES `comtamcali_hrm`.`NHAN_VIEN` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comtamcali_hrm`.`NGHI_VIEC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comtamcali_hrm`.`NGHI_VIEC` ;

CREATE  TABLE IF NOT EXISTS `comtamcali_hrm`.`NGHI_VIEC` (
  `MA_NV` BIGINT NOT NULL ,
  `NGAY_NOP_DON` TIMESTAMP NULL ,
  `NGAY_DUYET_DON` TIMESTAMP NULL ,
  `NGAY_BAT_DAU_NGHI` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  `GHI_CHU` VARCHAR(150) NULL ,
  PRIMARY KEY (`MA_NV`, `NGAY_BAT_DAU_NGHI`) ,
  INDEX `FK_NGHIVIEC_NV_idx` (`MA_NV` ASC) ,
  CONSTRAINT `FK_NGHIVIEC_NV`
    FOREIGN KEY (`MA_NV` )
    REFERENCES `comtamcali_hrm`.`NHAN_VIEN` (`MA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `comtamcali_hrm` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `comtamcali_hrm`.`CA`
-- -----------------------------------------------------
START TRANSACTION;
USE `comtamcali_hrm`;
INSERT INTO `comtamcali_hrm`.`CA` (`MA`, `TEN`) VALUES (1, 'Sáng');
INSERT INTO `comtamcali_hrm`.`CA` (`MA`, `TEN`) VALUES (2, 'Chiều');

COMMIT;

-- -----------------------------------------------------
-- Data for table `comtamcali_hrm`.`NV_STATE`
-- -----------------------------------------------------
START TRANSACTION;
USE `comtamcali_hrm`;
INSERT INTO `comtamcali_hrm`.`NV_STATE` (`MA`, `TEN`) VALUES (1, 'Nộp đơn');
INSERT INTO `comtamcali_hrm`.`NV_STATE` (`MA`, `TEN`) VALUES (2, 'Phỏng vấn');
INSERT INTO `comtamcali_hrm`.`NV_STATE` (`MA`, `TEN`) VALUES (3, 'Được nhận');
INSERT INTO `comtamcali_hrm`.`NV_STATE` (`MA`, `TEN`) VALUES (4, 'Không nhận');
INSERT INTO `comtamcali_hrm`.`NV_STATE` (`MA`, `TEN`) VALUES (5, 'Nghỉ việc sau khi nhận');
INSERT INTO `comtamcali_hrm`.`NV_STATE` (`MA`, `TEN`) VALUES (6, 'Không phỏng vấn');
INSERT INTO `comtamcali_hrm`.`NV_STATE` (`MA`, `TEN`) VALUES (7, 'Nghỉ việc');
INSERT INTO `comtamcali_hrm`.`NV_STATE` (`MA`, `TEN`) VALUES (8, 'Nghỉ phép');

COMMIT;
