create table `CompanyStructures` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`title` tinytext not null,
	`description` text not null,
	`address` text default NULL,
	`type` enum('Company','Head Office','Regional Office','Department','Unit','Sub Unit','Other') default NULL,
	`country` varchar(2) not null default '0',
	`parent` bigint(20) NULL,
	CONSTRAINT `Fk_CompanyStructures_Own` FOREIGN KEY (`parent`) REFERENCES `CompanyStructures` (`id`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Country` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`code` char(2) not null default '',
	`namecap` varchar(80) not null default '',
	`name` varchar(80) not null default '',
	`iso3` char(3) default null,
	`numcode` smallint(6) default null,
	UNIQUE KEY `code` (`code`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Province` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(40) not null default '',
	`code` char(2) not null default '',
	`country` char(2) not null default 'US',
	CONSTRAINT `Fk_Province_Country` FOREIGN KEY (`country`) REFERENCES `Country` (`code`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `CurrencyTypes` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`code` varchar(3) not null default '',
	`name` varchar(70) not null default '',
	primary key  (`id`),
	UNIQUE KEY `CurrencyTypes_code` (`code`)
) engine=innodb default charset=utf8;

create table `PayGrades` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) default null,
	`currency` varchar(3) not null,
	`min_salary` decimal(12,2) DEFAULT 0.00,
	`max_salary` decimal(12,2) DEFAULT 0.00,
	CONSTRAINT `Fk_PayGrades_CurrencyTypes` FOREIGN KEY (`currency`) REFERENCES `CurrencyTypes` (`code`),
	primary key(`id`)
) engine=innodb default charset=utf8;

create table `JobTitles` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`code` varchar(10) not null default '',
	`name` varchar(100) default null,
	`description` varchar(200) default null,
	`specification` varchar(400) default null,
	primary key(`id`)
) engine=innodb default charset=utf8;

create table `EmploymentStatus` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) default null,
	`description` varchar(400) default null,
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Skills` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) default null,
	`description` varchar(400) default null,
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Educations` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) default null,
	`description` varchar(400) default null,
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Certifications` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) default null,
	`description` varchar(400) default null,
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Languages` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) default null,
	`description` varchar(400) default null,
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Nationality` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) default null,
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Employees` (
	 `id` bigint(20) NOT NULL AUTO_INCREMENT,
	 `employee_id` varchar(50) default null,
	 `first_name` varchar(100) default '' not null,
	 `middle_name` varchar(100) default '' not null,
	 `last_name` varchar(100) default '' not null,
	 `nationality` bigint(20) default null,
	 `birthday` timestamp default '0000-00-00 00:00:00',
	 `gender` enum('Male','Female') default NULL,
	 `marital_status` enum('Married','Single','Divorced','Widowed','Other') default NULL,
	 `ssn_num` varchar(100) default '',
	 `nic_num` varchar(100) default '',
	 `other_id` varchar(100) default '',
	 `driving_license` varchar(100) default '',
	 `driving_license_exp_date` date default '0000-00-00',
	 `employment_status` bigint(20) default null,
	 `job_title` bigint(20) default null,
	 `pay_grade` bigint(20) null,
	 `work_station_id` varchar(100) default '',
	 `address1` varchar(100) default '',
	 `address2` varchar(100) default '',
	 `city` varchar(150) default '',
	 `country` char(2) default null,
	 `province` bigint(20) default null,
	 `postal_code` varchar(20) default null,
	 `home_phone` varchar(50) default null,
	 `mobile_phone` varchar(50) default null,
	 `work_phone` varchar(50) default null,
	 `work_email` varchar(100) default null,
	 `private_email` varchar(100) default null,
	 `joined_date` timestamp default '0000-00-00 00:00:00',
	 `confirmation_date` timestamp default '0000-00-00 00:00:00',
	 `supervisor` bigint(20) default null,
	 `department` bigint(20) default null,
	 `custom1` varchar(250) default null,
	 `custom2` varchar(250) default null,
	 `custom3` varchar(250) default null,
	 `custom4` varchar(250) default null,
	 `custom5` varchar(250) default null,
	 `custom6` varchar(250) default null,
	 `custom7` varchar(250) default null,
	 `custom8` varchar(250) default null,
	 `custom9` varchar(250) default null,
	 `custom10` varchar(250) default null,
	 CONSTRAINT `Fk_Employee_Nationality` FOREIGN KEY (`nationality`) REFERENCES `Nationality` (`id`),
	 CONSTRAINT `Fk_Employee_JobTitle` FOREIGN KEY (`job_title`) REFERENCES `JobTitles` (`id`),
	 CONSTRAINT `Fk_Employee_EmploymentStatus` FOREIGN KEY (`employment_status`) REFERENCES `EmploymentStatus` (`id`),
	 CONSTRAINT `Fk_Employee_Country` FOREIGN KEY (`country`) REFERENCES `Country` (`code`),
	 CONSTRAINT `Fk_Employee_Province` FOREIGN KEY (`province`) REFERENCES `Province` (`id`),
	 CONSTRAINT `Fk_Employee_Supervisor` FOREIGN KEY (`supervisor`) REFERENCES `Employees` (`id`),
	 CONSTRAINT `Fk_Employee_CompanyStructures` FOREIGN KEY (`department`) REFERENCES `CompanyStructures` (`id`),
	 CONSTRAINT `Fk_Employee_PayGrades` FOREIGN KEY (`pay_grade`) REFERENCES `PayGrades` (`id`),
	 primary key  (`id`),
	 unique key `employee_id` (`employee_id`)
	 
) engine=innodb default charset=utf8;

create table `Users` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`username` varchar(100) default null,
	`email` varchar(100) default null,
	`password` varchar(100) default null,
	`employee` bigint(20) null,
	`user_level` enum('Admin','Employee') default NULL,
	`last_login` timestamp default '0000-00-00 00:00:00',
	`last_update` timestamp default '0000-00-00 00:00:00',
	`created` timestamp default '0000-00-00 00:00:00',
	CONSTRAINT `Fk_User_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	primary key  (`id`),
	unique key `username` (`username`)
) engine=innodb default charset=utf8;


create table `EmployeeSkills` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`skill_id` bigint(20) NULL,
	`employee` bigint(20) NOT NULL,
	`details` varchar(400) default null,
	CONSTRAINT `Fk_EmployeeSkills_Skills` FOREIGN KEY (`skill_id`) REFERENCES `Skills` (`id`),
	CONSTRAINT `Fk_EmployeeSkills_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	primary key  (`id`),
	unique key (`employee`,`skill_id`)
) engine=innodb default charset=utf8;

create table `EmployeeEducations` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`education_id` bigint(20) NULL,
	`employee` bigint(20) NOT NULL,
	`institute` varchar(400) default null,
	`date_start` date default '0000-00-00',
	`date_end` date default '0000-00-00',
	CONSTRAINT `Fk_EmployeeEducations_Educations` FOREIGN KEY (`education_id`) REFERENCES `Educations` (`id`),
	CONSTRAINT `Fk_EmployeeEducations_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	primary key  (`id`),
	unique key (`employee`,`education_id`)
) engine=innodb default charset=utf8;

create table `EmployeeCertifications` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`certification_id` bigint(20) NULL,
	`employee` bigint(20) NOT NULL,
	`institute` varchar(400) default null,
	`date_start` date default '0000-00-00',
	`date_end` date default '0000-00-00',
	CONSTRAINT `Fk_EmployeeCertifications_Certifications` FOREIGN KEY (`certification_id`) REFERENCES `Certifications` (`id`),
	CONSTRAINT `Fk_EmployeeCertifications_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	primary key  (`id`),
	unique key (`employee`,`certification_id`)
) engine=innodb default charset=utf8;


create table `EmployeeLanguages` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`language_id` bigint(20) NULL,
	`employee` bigint(20) NOT NULL,
	`reading` enum('Elementary Proficiency','Limited Working Proficiency','Professional Working Proficiency','Full Professional Proficiency','Native or Bilingual Proficiency') default NULL,
	`speaking` enum('Elementary Proficiency','Limited Working Proficiency','Professional Working Proficiency','Full Professional Proficiency','Native or Bilingual Proficiency') default NULL,
	`writing` enum('Elementary Proficiency','Limited Working Proficiency','Professional Working Proficiency','Full Professional Proficiency','Native or Bilingual Proficiency') default NULL,
	`understanding` enum('Elementary Proficiency','Limited Working Proficiency','Professional Working Proficiency','Full Professional Proficiency','Native or Bilingual Proficiency') default NULL,
	CONSTRAINT `Fk_EmployeeLanguages_Languages` FOREIGN KEY (`language_id`) REFERENCES `Languages` (`id`),
	CONSTRAINT `Fk_EmployeeLanguages_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	primary key  (`id`),
	unique key (`employee`,`language_id`)
) engine=innodb default charset=utf8;

create table `EmergencyContacts` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`employee` bigint(20) NOT NULL,
	`name` varchar(100) NOT NULL,
	`relationship` varchar(100) default null,
	`home_phone` varchar(15) default null,
	`work_phone` varchar(15) default null,
	`mobile_phone` varchar(15) default null,
	CONSTRAINT `Fk_EmergencyContacts_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `EmployeeDependents` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`employee` bigint(20) NOT NULL,
	`name` varchar(100) NOT NULL,
	`relationship` enum('Child','Spouse','Parent','Other') default NULL,
	`dob` date default '0000-00-00',
	`id_number` varchar(25) default null,
	CONSTRAINT `Fk_EmployeeDependents_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `EmployeeImmigrations` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`employee` bigint(20) NOT NULL,
	`document` enum('Passport','Visa') default NULL,
	`doc_number` varchar(100) NOT NULL,
	`issued` date default '0000-00-00',
	`expiry` date default '0000-00-00',
	`status` varchar(100) default null,
	`details` text default null,
	CONSTRAINT `Fk_EmployeeImmigrations_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `EmployeeSalary` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`employee` bigint(20) NOT NULL,
	`component` varchar(100) NOT NULL,
	`pay_frequency` enum('Hourly','Daily','Bi Weekly','Weekly','Semi Monthly','Monthly') default NULL,
	`currency` bigint(20) NOT NULL,
	`amount` decimal(10,2) NOT NULL,
	`details` text default null,
	CONSTRAINT `Fk_EmployeeSalary_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	CONSTRAINT `Fk_EmployeeSalary_Currency` FOREIGN KEY (`currency`) REFERENCES `CurrencyTypes` (`id`),
	primary key  (`id`)
) engine=innodb default charset=utf8;


create table `LeaveTypes` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`supervisor_leave_assign` enum('Yes','No') default 'Yes',
	`employee_can_apply` enum('Yes','No') default 'Yes',
	`apply_beyond_current` enum('Yes','No') default 'Yes',
	`leave_accrue` enum('No','Yes') default 'No',
	`carried_forward` enum('No','Yes') default 'No',
	`default_per_year` bigint(20) NOT NULL,
	primary key  (`id`),
	unique key (`name`)
) engine=innodb default charset=utf8;

create table `LeaveRules` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`leave_type` bigint(20) NOT NULL,
	`job_title` bigint(20) NULL,
	`employment_status` bigint(20) NULL,
	`employee` bigint(20) NULL,
	`supervisor_leave_assign` enum('Yes','No') default 'Yes',
	`employee_can_apply` enum('Yes','No') default 'Yes',
	`apply_beyond_current` enum('Yes','No') default 'Yes',
	`leave_accrue` enum('No','Yes') default 'No',
	`carried_forward` enum('No','Yes') default 'No',
	`default_per_year` bigint(20) NOT NULL,
	CONSTRAINT `Fk_LeaveRules_LeaveTypes` FOREIGN KEY (`leave_type`) REFERENCES `LeaveTypes` (`id`),
	CONSTRAINT `Fk_LeaveRules_JobTitles` FOREIGN KEY (`job_title`) REFERENCES `JobTitles` (`id`),
	CONSTRAINT `Fk_LeaveRules_EmploymentStatus` FOREIGN KEY (`employment_status`) REFERENCES `EmploymentStatus` (`id`),
	CONSTRAINT `Fk_LeaveRules_Employees` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `LeavePeriods` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`date_start` date default '0000-00-00',
	`date_end` date default '0000-00-00',
	`status` enum('Active','Inactive') default 'Inactive',
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `WorkDays` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`status` enum('Full Day','Half Day','Non-working Day') default 'Full Day',
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `HoliDays` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`dateh` date default '0000-00-00',
	`status` enum('Full Day','Half Day') default 'Full Day',
	primary key  (`id`),
	unique key `holidays_dateh` (`dateh`)
) engine=innodb default charset=utf8;

create table `EmployeeLeaves` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`employee` bigint(20) NOT NULL,
	`leave_type` bigint(20) NOT NULL,
	`leave_period` bigint(20) NOT NULL,
	`date_start` date default '0000-00-00',
	`date_end` date default '0000-00-00',
	`details` text default null,
	`status` enum('Approved','Pending','Rejected') default 'Pending',
	CONSTRAINT `Fk_EmployeeLeaves_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	CONSTRAINT `Fk_EmployeeLeaves_LeaveTypes` FOREIGN KEY (`leave_type`) REFERENCES `LeaveTypes` (`id`),
	CONSTRAINT `Fk_EmployeeLeaves_LeavePeriods` FOREIGN KEY (`leave_period`) REFERENCES `LeavePeriods` (`id`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `EmployeeLeaveDays` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`employee_leave` bigint(20) NOT NULL,
	`leave_date` date default '0000-00-00',
	`leave_type` enum('Full Day','Half Day - Morning','Half Day - Afternoon') NOT NULL,
	CONSTRAINT `Fk_EmployeeLeaveDays_EmployeeLeaves` FOREIGN KEY (`employee_leave`) REFERENCES `EmployeeLeaves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Files` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`filename` varchar(100) NOT NULL,
	`employee` bigint(20) NULL,
	`file_group` varchar(100) NOT NULL,
	CONSTRAINT `Fk_Files_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	primary key  (`id`),
	unique key `filename` (`filename`)
) engine=innodb default charset=utf8;

create table `Clients` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`details` text default null,
	`first_contact_date` date default '0000-00-00',
	`created` timestamp default '0000-00-00 00:00:00',
	`address` text default null,
	`contact_number` varchar(25) NULL,
	`contact_email` varchar(25) NULL,
	`company_url` varchar(500) NULL,
	`status` enum('Active','Inactive') default 'Active',
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Projects` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`client` bigint(20) NULL,
	`details` text default null,
	`created` timestamp default '0000-00-00 00:00:00',
	`status` enum('Active','Inactive') default 'Active',
	CONSTRAINT `Fk_Projects_Client` FOREIGN KEY (`client`) REFERENCES `Clients` (`id`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `EmployeeTimeSheets` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`employee` bigint(20) NOT NULL,
	`date_start` date NOT NULL,
	`date_end` date NOT NULL,
	`status` enum('Approved','Pending','Rejected','Submitted') default 'Pending',
	CONSTRAINT `Fk_EmployeeTimeSheets_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	UNIQUE KEY `EmployeeTimeSheetsKey` (`employee`,`date_start`,`date_end`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `EmployeeProjects` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`employee` bigint(20) NOT NULL,
	`project` bigint(20) NULL,
	`date_start` date NOT NULL,
	`date_end` date NOT NULL,
	`status` enum('Current','Inactive','Completed') default 'Current',
	`details` text default null,
	CONSTRAINT `Fk_EmployeeProjects_Projects` FOREIGN KEY (`project`) REFERENCES `Projects` (`id`),
	CONSTRAINT `Fk_EmployeeProjects_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	UNIQUE KEY `EmployeeProjectsKey` (`employee`,`project`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `EmployeeTimeEntry` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`project` bigint(20) NULL,
	`employee` bigint(20) NOT NULL,
	`timesheet` bigint(20) NOT NULL,
	`details` text default null,
	`created` timestamp default '0000-00-00 00:00:00',
	`date_start` timestamp default '0000-00-00 00:00:00',
	`time_start` varchar(10) NOT NULL,
	`date_end` timestamp default '0000-00-00 00:00:00',
	`time_end` varchar(10) NOT NULL,
	`status` enum('Active','Inactive') default 'Active',
	CONSTRAINT `Fk_EmployeeTimeEntry_Projects` FOREIGN KEY (`project`) REFERENCES `Projects` (`id`),
	CONSTRAINT `Fk_EmployeeTimeEntry_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	CONSTRAINT `Fk_EmployeeTimeEntry_EmployeeTimeSheets` FOREIGN KEY (`timesheet`) REFERENCES `EmployeeTimeSheets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Documents` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`details` text default null,
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `EmployeeDocuments` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`employee` bigint(20) NOT NULL,
	`document` bigint(20) NULL,
	`date_added` date NOT NULL,
	`valid_until` date NOT NULL,
	`status` enum('Active','Inactive','Draft') default 'Active',
	`details` text default null,
	CONSTRAINT `Fk_EmployeeDocuments_Documents` FOREIGN KEY (`document`) REFERENCES `Documents` (`id`),
	CONSTRAINT `Fk_EmployeeDocuments_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `CompanyLoans` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`details` text default null,
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `EmployeeCompanyLoans` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`employee` bigint(20) NOT NULL,
	`loan` bigint(20) NULL,
	`start_date` date NOT NULL,
	`last_installment_date` date NOT NULL,
	`period_months` bigint(20) NULL,
	`amount` decimal(10,2) NOT NULL,
	`monthly_installment` decimal(10,2) NOT NULL,
	`status` enum('Approved','Repayment','Paid','Suspended') default 'Approved',
	`details` text default null,
	CONSTRAINT `Fk_EmployeeCompanyLoans_CompanyLoans` FOREIGN KEY (`loan`) REFERENCES `CompanyLoans` (`id`),
	CONSTRAINT `Fk_EmployeeCompanyLoans_Employee` FOREIGN KEY (`employee`) REFERENCES `Employees` (`id`),
	primary key  (`id`)
) engine=innodb default charset=utf8;

create table `Settings` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`value` text default null,
	`description` text default null,
	primary key  (`id`),
	key(`name`)
) engine=innodb default charset=utf8;





