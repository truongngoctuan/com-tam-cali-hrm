create table `ChucVu` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`code` varchar(10) not null default '',
	`name` varchar(100) default null,
	primary key(`id`)
) engine=innodb default charset=utf8;

ALTER TABLE `employees`
  ADD `MaChucVu` bigint(20),
  CONSTRAINT `Fk_Employee_ChucVu` FOREIGN KEY (`MaChucVu`) REFERENCES `ChucVu` (`id`);

  
  
