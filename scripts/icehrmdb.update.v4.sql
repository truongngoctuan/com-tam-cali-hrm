create table `Settings` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`value` text default null,
	`description` text default null,
	primary key  (`id`),
	key(`name`)
) engine=innodb default charset=utf8;