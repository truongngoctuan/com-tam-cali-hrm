<?php
/*
This file is part of iCE Hrm.

iCE Hrm is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

iCE Hrm is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with iCE Hrm. If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------

Original work Copyright (c) 2012 [Gamonoid Media Pvt. Ltd]  
Developer: Thilina Hasantha (thilina.hasantha[at]gmail.com / facebook.com/thilinah)
 */

class CompanyStructure extends ADOdb_Active_Record {
	var $_table = 'CompanyStructures';
}

class Country extends ADOdb_Active_Record {
	var $_table = 'Country';
}

class Province extends ADOdb_Active_Record {
	var $_table = 'Province';
}

class CurrencyType extends ADOdb_Active_Record {
	var $_table = 'CurrencyTypes';
}

class JobTitle extends ADOdb_Active_Record {
	var $_table = 'JobTitles';
}

class PayGrade extends ADOdb_Active_Record {
	var $_table = 'PayGrades';
}

class EmploymentStatus extends ADOdb_Active_Record {
	var $_table = 'EmploymentStatus';
}

class Skill extends ADOdb_Active_Record {
	var $_table = 'Skills';
}

class Education extends ADOdb_Active_Record {
	var $_table = 'Educations';
}

class Certification extends ADOdb_Active_Record {
	var $_table = 'Certifications';
}

class Language extends ADOdb_Active_Record {
	var $_table = 'Languages';
}

class Nationality extends ADOdb_Active_Record {
	var $_table = 'Nationality';
}

class Employee extends ADOdb_Active_Record {
	var $_table = 'Employees';
}

class User extends ADOdb_Active_Record {
	var $_table = 'Users';
}

class EmployeeSkill extends ADOdb_Active_Record {
	var $_table = 'EmployeeSkills';
}

class EmployeeEducation extends ADOdb_Active_Record {
	var $_table = 'EmployeeEducations';
}

class EmployeeCertification extends ADOdb_Active_Record {
	var $_table = 'EmployeeCertifications';
}

class EmployeeLanguage extends ADOdb_Active_Record {
	var $_table = 'EmployeeLanguages';
}

class EmergencyContact extends ADOdb_Active_Record {
	var $_table = 'EmergencyContacts';
}

class EmployeeDependent extends ADOdb_Active_Record {
	var $_table = 'EmployeeDependents';
}

class EmployeeImmigration extends ADOdb_Active_Record {
	var $_table = 'EmployeeImmigrations';
}

class EmployeeSalary extends ADOdb_Active_Record {
	var $_table = 'EmployeeSalary';
}

class LeaveType extends ADOdb_Active_Record {
	var $_table = 'LeaveTypes';
}

class LeavePeriod extends ADOdb_Active_Record {
	var $_table = 'LeavePeriods';
}

class WorkDay extends ADOdb_Active_Record {
	var $_table = 'WorkDays';
}

class HoliDay extends ADOdb_Active_Record {
	var $_table = 'HoliDays';
}

class LeaveRule extends ADOdb_Active_Record {
	var $_table = 'LeaveRules';
}

class EmployeeLeave extends ADOdb_Active_Record {
	var $_table = 'EmployeeLeaves';
}

class EmployeeLeaveDay extends ADOdb_Active_Record {
	var $_table = 'EmployeeLeaveDays';
}

class File extends ADOdb_Active_Record {
	var $_table = 'Files';
}

class Client extends ADOdb_Active_Record {
	var $_table = 'Clients';
}

class Project extends ADOdb_Active_Record {
	var $_table = 'Projects';
}

class EmployeeTimeSheet extends ADOdb_Active_Record {
	var $_table = 'EmployeeTimeSheets';
}

class EmployeeTimeEntry extends ADOdb_Active_Record {
	var $_table = 'EmployeeTimeEntry';
}

class EmployeeProject extends ADOdb_Active_Record {
	var $_table = 'EmployeeProjects';
}

class Document extends ADOdb_Active_Record {
	var $_table = 'Documents';
}

class EmployeeDocument extends ADOdb_Active_Record {
	var $_table = 'EmployeeDocuments';
}

class CompanyLoan extends ADOdb_Active_Record {
	var $_table = 'CompanyLoans';
}

class EmployeeCompanyLoan extends ADOdb_Active_Record {
	var $_table = 'EmployeeCompanyLoans';
}

class Setting extends ADOdb_Active_Record {
	var $_table = 'Settings';
}


