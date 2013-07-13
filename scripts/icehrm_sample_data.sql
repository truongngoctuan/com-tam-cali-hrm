/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;


INSERT INTO `Certifications` (`id`, `name`, `description`) VALUES
(1, 'Red Hat Certified Architect (RHCA)', 'Red Hat Certified Architect (RHCA)'),
(2, 'GIAC Secure Software Programmer -Java', 'GIAC Secure Software Programmer -Java'),
(3, 'Risk Management Professional (PMI)', 'Risk Management Professional (PMI)'),
(4, 'IT Infrastructure Library (ITIL) Expert Certification', 'IT Infrastructure Library (ITIL) Expert Certification'),
(5, 'Microsoft Certified Architect', 'Microsoft Certified Architect'),
(6, 'Oracle Exadata 11g Certified Implementation Specialist', 'Oracle Exadata 11g Certified Implementation Specialist'),
(7, 'Cisco Certified Design Professional (CCDP)', 'Cisco Certified Design Professional (CCDP)'),
(8, 'Cisco Certified Internetwork Expert (CCIE)', 'Cisco Certified Internetwork Expert (CCIE)'),
(9, 'Cisco Certified Network Associate', 'Cisco Certified Network Associate'),
(10, 'HP/Master Accredited Solutions Expert (MASE)', 'HP/Master Accredited Solutions Expert (MASE)'),
(11, 'HP/Master Accredited Systems Engineer (Master ASE)', 'HP/Master Accredited Systems Engineer (Master ASE)'),
(12, 'Certified Information Security Manager (CISM)', 'Certified Information Security Manager (CISM)'),
(13, 'Certified Information Systems Auditor (CISA)', 'Certified Information Systems Auditor (CISA)'),
(14, 'CyberSecurity Forensic Analyst (CSFA)', 'CyberSecurity Forensic Analyst (CSFA)'),
(15, 'Open Group Certified Architect (OpenCA)', 'Open Group Certified Architect (OpenCA)'),
(16, 'Oracle DBA Administrator Certified Master OCM', 'Oracle DBA Administrator Certified Master OCM'),
(17, 'Project Management Professional', 'Project Management Professional'),
(18, 'Apple Certified Support Professional', 'Apple Certified Support Professional'),
(19, 'Certified Public Accountant (CPA)', 'Certified Public Accountant (CPA)'),
(20, 'Chartered Financial Analyst', 'Chartered Financial Analyst'),
(21, 'Professional in Human Resources (PHR)', 'Professional in Human Resources (PHR)');



INSERT INTO `Clients` (`id`, `name`, `details`, `first_contact_date`, `created`, `address`, `contact_number`, `contact_email`, `company_url`, `status`) VALUES
(1, 'Guppen', NULL, '2012-01-04', '2013-01-03 05:47:33', '4627, Mount Olive Road,\nAtlanta, USA', '678-894-1047', 'icehrm+guppen@web-stalk.c', 'http://guppen.com', 'Active'),
(2, 'Reamerpint', NULL, '2011-07-12', '2013-01-03 05:49:03', '3739 Skips Lane,\nPhoenix', '928-466-9252', 'icehrm+Reamerpint@web-sta', 'icehrm+Reamerpint@web-stalk.com', 'Active'),
(3, 'SG Mart', NULL, '2012-11-14', '2013-01-03 05:51:26', '124 Jurong East Street 13\nSingapore 600124', '257-538-009', 'icehrm+sgm@web-stalk.com', '', 'Active');


INSERT INTO `CompanyLoans` (`id`, `name`, `details`) VALUES
(1, 'Personal loan', 'Personal loans'),
(2, 'Educational loan', 'Educational loan');


INSERT INTO `CompanyStructures` (`id`, `title`, `description`, `address`, `type`, `country`, `parent`) VALUES
(1, 'Real Company', 'Web Stalk is a company specialized in developing social media applications and integrating web sites with major social Networks', '', 'Company', 'US', NULL),
(2, 'Head Office', 'US Head office', 'PO Box 86605\nLos Angeles, CA 90086', 'Head Office', 'US', 1),
(3, 'Marketing Department', 'Marketing Department', 'PO Box 86602\nLos Angeles, CA 90085', 'Department', 'US', 2),
(4, 'Development Center', 'Singapore Development Center', 'Anderson Rd,\nTanjong Pagar,\n341234', 'Regional Office', 'SG', 1),
(5, 'Engineering Department', 'Engineering Department', 'Anderson Rd, \nTanjong Pagar,  341234', 'Department', 'SG', 4),
(6, 'Development Team', 'Development Team', '', 'Unit', 'SG', 5),
(7, 'QA Team', 'QA Team', '', 'Unit', 'SG', 5),
(8, 'Server Administration', 'Server Administration', '', 'Unit', 'SG', 5),
(9, 'Administration & HR', 'Administration and Human Resource', '', 'Department', 'SG', 4);


INSERT INTO `Documents` (`id`, `name`, `details`) VALUES
(1, 'Birth Cert', 'Birth Cert'),
(2, 'Document 1', 'Document 1');


INSERT INTO `Educations` (`id`, `name`, `description`) VALUES
(1, 'Bachelors Degree', 'Bachelors Degree'),
(2, 'Diploma', 'Diploma'),
(3, 'Masters Degree', 'Masters Degree'),
(4, 'Doctorate', 'Doctorate');

INSERT INTO `HoliDays` (`id`, `name`, `dateh`, `status`) VALUES
(1, 'New Year''s Day', '2013-01-01', 'Full Day'),
(2, 'Chinese New Year', '2013-02-10', 'Full Day'),
(3, 'Chinese New Year', '2013-02-11', 'Full Day'),
(4, 'Good Friday', '2013-03-29', 'Full Day'),
(5, 'Labour Day', '2013-05-01', 'Full Day'),
(6, 'Vesak Day', '2013-05-24', 'Full Day'),
(7, 'Hari Raya', '2013-08-08', 'Full Day'),
(8, 'Singapore National Day', '2013-08-09', 'Full Day'),
(9, 'Hari Raya Haji', '2013-10-15', 'Full Day'),
(10, 'Deepavali', '2013-11-04', 'Full Day'),
(11, 'Christmas Day', '2013-12-25', 'Full Day');


INSERT INTO `JobTitles` (`id`, `code`, `name`, `description`, `specification`) VALUES
(1, 'SE', 'Software Engineer', 'The work of a software engineer typically includes designing and programming system-level software: operating systems, database systems, embedded systems and so on. They understand how both software a', 'Software Engineer'),
(2, 'ASE', 'Assistant Software Engineer', 'Assistant Software Engineer', 'Assistant Software Engineer'),
(3, 'PM', 'Project Manager', 'Project Manager', 'Project Manager'),
(4, 'QAE', 'QA Engineer', 'Quality Assurance Engineer ', 'Quality Assurance Engineer '),
(5, 'PRM', 'Product Manager', 'Product Manager', 'Product Manager'),
(6, 'AQAE', 'Assistant QA Engineer ', 'Assistant QA Engineer ', 'Assistant QA Engineer '),
(7, 'TPM', 'Technical Project Manager', 'Technical Project Manager', 'Technical Project Manager'),
(8, 'PRS', 'Pre-Sales Executive', 'Pre-Sales Executive', 'Pre-Sales Executive'),
(9, 'ME', 'Marketing Executive', 'Marketing Executive', 'Marketing Executive'),
(10, 'DH', 'Department Head', 'Department Head', 'Department Head'),
(11, 'CEO', 'Chief Executive Officer', 'Chief Executive Officer', 'Chief Executive Officer'),
(12, 'DBE', 'Database Engineer', 'Database Engineer', 'Database Engineer'),
(13, 'SA', 'Server Admin', 'Server Admin', 'Server Admin');


INSERT INTO `Languages` (`id`, `name`, `description`) VALUES
(1, 'English', 'English'),
(2, 'French', 'French'),
(3, 'German', 'German'),
(4, 'Chinese', 'Chinese');


INSERT INTO `LeavePeriods` (`id`, `name`, `date_start`, `date_end`, `status`) VALUES
(1, 'Year 2013', '2013-01-01', '2013-12-31', 'Active'),
(2, 'Year 2012', '2012-01-01', '2012-01-01', 'Inactive');

INSERT INTO `LeaveTypes` (`id`, `name`, `supervisor_leave_assign`, `employee_can_apply`, `apply_beyond_current`, `leave_accrue`, `carried_forward`, `default_per_year`) VALUES
(1, 'Annual leave', 'No', 'Yes', 'No', 'No', 'No', 14),
(2, 'Casual leave', 'Yes', 'Yes', 'No', 'No', 'No', 7),
(3, 'Medical leave', 'Yes', 'Yes', 'Yes', 'No', 'No', 7);

INSERT INTO `PayGrades` (`id`, `name`, `currency`, `min_salary`, `max_salary`) VALUES
(1, 'Manager', 'SGD', '5000.00', '15000.00'),
(2, 'Executive', 'SGD', '3500.00', '7000.00'),
(3, 'Assistant ', 'SGD', '2000.00', '4000.00'),
(4, 'Administrator', 'SGD', '2000.00', '6000.00');

INSERT INTO `Projects` (`id`, `name`, `client`, `details`, `created`, `status`) VALUES
(1, 'Car diagnosis system', 3, NULL, '2013-01-03 05:53:38', 'Active'),
(2, 'Car In', 3, NULL, '2013-01-03 05:54:22', 'Active'),
(3, 'Remo Me', 1, NULL, '2013-01-03 05:55:02', 'Active'),
(4, 'My Sec', 2, NULL, '2013-01-03 05:56:16', 'Active');

INSERT INTO `Skills` (`id`, `name`, `description`) VALUES
(1, 'Programming and Application Development', 'Programming and Application Development'),
(2, 'Project Management', 'Project Management'),
(3, 'Help Desk/Technical Support', 'Help Desk/Technical Support'),
(4, 'Networking', 'Networking'),
(5, 'Databases', 'Databases'),
(6, 'Business Intelligence', 'Business Intelligence'),
(7, 'Cloud Computing', 'Cloud Computing'),
(8, 'Information Security', 'Information Security'),
(9, 'HTML Skills', 'HTML Skills'),
(10, 'Graphic Designing', 'Graphic Designing');

INSERT INTO `EmploymentStatus` (`id`, `name`, `description`) VALUES
(1, 'Full Time Contract', 'Full Time Contract'),
(2, 'Full Time Internship', 'Full Time Internship'),
(3, 'Full Time Permanent', 'Full Time Permanent'),
(4, 'Part Time Contract', 'Part Time Contract'),
(5, 'Part Time Internship', 'Part Time Internship'),
(6, 'Part Time Permanent', 'Part Time Permanent');


INSERT INTO `Employees` (`id`, `employee_id`, `first_name`, `middle_name`, `last_name`, `nationality`, `birthday`, `gender`, `marital_status`, `ssn_num`, `nic_num`, `other_id`, `driving_license`, `driving_license_exp_date`, `employment_status`, `job_title`, `pay_grade`, `work_station_id`, `address1`, `address2`, `city`, `country`, `province`, `postal_code`, `home_phone`, `mobile_phone`, `work_phone`, `work_email`, `private_email`, `joined_date`, `confirmation_date`, `supervisor`, `department`, `custom1`, `custom2`, `custom3`, `custom4`, `custom5`, `custom6`, `custom7`, `custom8`, `custom9`, `custom10`) VALUES
(3, 'EMP003', 'Bailey', '', 'Newman', 35, '1976-03-17 18:30:00', 'Male', 'Married', '', '294-38-3535', '294-38-3535', '', NULL, 3, 11, NULL, '', '2772 Flynn Street', 'Willoughby', 'Willoughby', 'US', 41, '44094', '440-953-4578', '440-953-4578', '440-953-4578', 'icehrm+3@web-stalk.com', 'icehrm+3@web-stalk.com', '2005-08-03 18:00:00', '0000-00-00 00:00:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'EMP001', 'Lala', 'Nadila ', 'Lamees', 175, '1984-03-12 18:30:00', 'Female', 'Single', '', '4594567WE3', '4595567WE3', '349-066-YUO', '2012-03-01', 1, 8, 2, 'W001', 'Green War Rd, 00123', '', 'Istanbul', 'TR', NULL, '909066', '+960112345', '+960112345', '+960112345', 'icehrm+1@web-stalk.com', 'icehrm+1@web-stalk.com', '2011-03-07 18:30:00', '2012-02-14 18:30:00', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'EMP002', 'Sofia', '', 'O''Sullivan', 4, '1975-08-28 18:30:00', 'Female', 'Married', '', '768-20-4394', '768-20-4394', '', NULL, 3, 10, NULL, '', '2792 Trails End Road', 'Fort Lauderdale', 'Fort Lauderdale', 'US', 12, '33308', '954-388-3340', '954-388-3340', '954-388-3340', 'icehrm+2@web-stalk.com', 'icehrm+2@web-stalk.com', '2010-02-08 18:30:00', '0000-00-00 00:00:00', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'EMP004', 'Taylor', '', 'Holmes', 10, '1979-07-15 18:30:00', 'Male', 'Single', '158-06-2292', '158-06-2292', '', '', NULL, 1, 5, NULL, '', '1164', 'Walnut Avenue', 'Rochelle Park', 'US', 35, '7662', '201-474-8048', '201-474-8048', '201-474-8048', 'icehrm+4@web-stalk.com', 'icehrm+4@web-stalk.com', '2006-07-12 18:30:00', '0000-00-00 00:00:00', 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);



INSERT INTO `EmergencyContacts` (`id`, `employee`, `name`, `relationship`, `home_phone`, `work_phone`, `mobile_phone`) VALUES
(1, 1, 'Emma Owns', 'Mother', '+874463422', '+874463422', '+874463422'),
(2, 2, 'Casey Watson', 'Sister', '231-453-876', '231-453-876', '231-453-876');


INSERT INTO `EmployeeCertifications` (`id`, `certification_id`, `employee`, `institute`, `date_start`, `date_end`) VALUES
(1, 21, 1, 'PHR', '2012-06-04', '2016-06-13'),
(2, 19, 1, 'CPA', '2010-02-16', '2019-02-28'),
(3, 17, 2, 'PMP', '2011-06-14', '2019-10-20'),
(4, 3, 2, 'PMI', '2004-06-08', '2017-09-14');

INSERT INTO `EmployeeCompanyLoans` (`id`, `employee`, `loan`, `start_date`, `last_installment_date`, `period_months`, `amount`, `monthly_installment`, `status`, `details`) VALUES
(1, 2, 2, '2013-02-05', '0000-00-00', 12, '12000.00', '1059.45', 'Approved', '');

INSERT INTO `EmployeeDependents` (`id`, `employee`, `name`, `relationship`, `dob`, `id_number`) VALUES
(1, 1, 'Emma Owns', 'Parent', '1940-06-11', '475209UHB'),
(2, 1, 'Mica Singroo', 'Other', '2000-06-13', '');


INSERT INTO `EmployeeDocuments` (`id`, `employee`, `document`, `date_added`, `valid_until`, `status`, `details`) VALUES
(1, 2, 2, '2013-01-08', '0000-00-00', 'Active', 'zxczx');


INSERT INTO `EmployeeEducations` (`id`, `education_id`, `employee`, `institute`, `date_start`, `date_end`) VALUES
(1, 1, 1, 'National University of Turky', '2004-02-03', '2006-06-13'),
(2, 1, 2, 'MIT', '1995-02-21', '1999-10-12');

INSERT INTO `EmployeeImmigrations` (`id`, `employee`, `document`, `doc_number`, `issued`, `expiry`, `status`, `details`) VALUES
(1, 1, 'Passport', '784642SW', '2010-06-22', '2019-07-15', '', ''),
(2, 1, 'Visa', '53608231D', '2010-07-08', '2016-12-07', 'Singapore Employment', 'P2'),
(3, 2, 'Visa', '543-8TR', '1994-02-15', '2045-07-26', 'PR', '');

INSERT INTO `EmployeeLanguages` (`id`, `language_id`, `employee`, `reading`, `speaking`, `writing`, `understanding`) VALUES
(1, 1, 1, 'Full Professional Proficiency', 'Full Professional Proficiency', 'Full Professional Proficiency', 'Native or Bilingual Proficiency'),
(2, 1, 2, 'Native or Bilingual Proficiency', 'Native or Bilingual Proficiency', 'Native or Bilingual Proficiency', 'Native or Bilingual Proficiency'),
(3, 2, 2, 'Limited Working Proficiency', 'Professional Working Proficiency', 'Limited Working Proficiency', 'Professional Working Proficiency');


INSERT INTO `EmployeeProjects` (`id`, `employee`, `project`, `date_start`, `date_end`, `status`, `details`) VALUES
(1, 2, 1, '2010-03-18', '2014-03-06', 'Inactive', ''),
(3, 2, 2, '2013-02-05', '2013-02-11', 'Current', ''),
(5, 2, 3, '2013-02-24', '0000-00-00', 'Current', '');



INSERT INTO `EmployeeSalary` (`id`, `employee`, `component`, `pay_frequency`, `currency`, `amount`, `details`) VALUES
(1, 1, 'Basic', 'Monthly', 131, '2700.00', ''),
(2, 2, 'Basic Salary', 'Monthly', 151, '12000.00', ''),
(3, 2, 'Travelling Allowance', 'Monthly', 131, '5000.00', '');


INSERT INTO `EmployeeSkills` (`id`, `skill_id`, `employee`, `details`) VALUES
(1, 9, 1, 'Creating web sites'),
(2, 6, 2, 'Certified Business Intelligence Professional');




INSERT INTO `LeaveRules` (`id`, `leave_type`, `job_title`, `employment_status`, `employee`, `supervisor_leave_assign`, `employee_can_apply`, `apply_beyond_current`, `leave_accrue`, `carried_forward`, `default_per_year`) VALUES
(1, 1, 11, NULL, NULL, 'No', 'Yes', 'Yes', 'No', 'No', 25),
(2, 2, NULL, NULL, 2, 'No', 'Yes', 'Yes', 'No', 'No', 10);



INSERT INTO `Users` (`id`, `username`, `email`, `password`, `employee`, `user_level`, `last_login`, `last_update`, `created`) VALUES
(2, 'user1', 'icehrm+1@web-stalk.com', '4048bb914a704a0728549a26b92d8550', 1, 'Employee', '2012-12-31 07:42:25', '2012-12-31 07:42:25', '2012-12-31 07:42:25'),
(3, 'user2', 'icehrm+2@web-stalk.com', '4048bb914a704a0728549a26b92d8550', 2, 'Employee', '2013-01-03 02:47:37', '2013-01-03 02:47:37', '2013-01-03 02:47:37'),
(4, 'user3', 'icehrm+3@web-stalk.com', '4048bb914a704a0728549a26b92d8550', 3, 'Employee', '2013-01-03 02:48:32', '2013-01-03 02:48:32', '2013-01-03 02:48:32'),
(5, 'user4', 'icehrm+4@web-stalk.com', '4048bb914a704a0728549a26b92d8550', 4, 'Employee', '2013-01-03 02:58:55', '2013-01-03 02:58:55', '2013-01-03 02:58:55');


/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;














