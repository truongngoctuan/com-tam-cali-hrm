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
 
class BaseData extends ADOdb_Active_Record {
	public function PrimaryKeyName(){
		return 'id';
	}
}

class CompanyStructure extends BaseData {
	var $_table = 'CompanyStructures';
}

class Country extends BaseData {
	var $_table = 'Country';
}

class Province extends BaseData {
	var $_table = 'Province';
}

class CurrencyType extends BaseData {
	var $_table = 'CurrencyTypes';
}

class JobTitle extends BaseData {
	var $_table = 'JobTitles';
}

class ChucVu extends BaseData {
	var $_table = 'chucvu';
}

class PayGrade extends BaseData {
	var $_table = 'PayGrades';
}

class EmploymentStatus extends BaseData {
	var $_table = 'EmploymentStatus';
}

class Skill extends BaseData {
	var $_table = 'Skills';
}

class Education extends BaseData {
	var $_table = 'Educations';
}

class Certification extends BaseData {
	var $_table = 'Certifications';
}

class Language extends BaseData {
	var $_table = 'Languages';
}

class Nationality extends BaseData {
	var $_table = 'Nationality';
}

class Employee extends BaseData {
	var $_table = 'Employees';
}

class User extends BaseData {
	var $_table = 'Users';
}

class EmployeeSkill extends BaseData {
	var $_table = 'EmployeeSkills';
}

class EmployeeEducation extends BaseData {
	var $_table = 'EmployeeEducations';
}

class EmployeeCertification extends BaseData {
	var $_table = 'EmployeeCertifications';
}

class EmployeeLanguage extends BaseData {
	var $_table = 'EmployeeLanguages';
}

class EmergencyContact extends BaseData {
	var $_table = 'EmergencyContacts';
}

class EmployeeDependent extends BaseData {
	var $_table = 'EmployeeDependents';
}

class EmployeeImmigration extends BaseData {
	var $_table = 'EmployeeImmigrations';
}

class EmployeeSalary extends BaseData {
	var $_table = 'EmployeeSalary';
}

class LeaveType extends BaseData {
	var $_table = 'LeaveTypes';
}

class LeavePeriod extends BaseData {
	var $_table = 'LeavePeriods';
}

class WorkDay extends BaseData {
	var $_table = 'WorkDays';
}

class HoliDay extends BaseData {
	var $_table = 'HoliDays';
}

class LeaveRule extends BaseData {
	var $_table = 'LeaveRules';
}

class EmployeeLeave extends BaseData {
	var $_table = 'EmployeeLeaves';
}

class EmployeeLeaveDay extends BaseData {
	var $_table = 'EmployeeLeaveDays';
}

class File extends BaseData {
	var $_table = 'Files';
}

class Client extends BaseData {
	var $_table = 'Clients';
}

class Project extends BaseData {
	var $_table = 'Projects';
}

class EmployeeTimeSheet extends BaseData {
	var $_table = 'EmployeeTimeSheets';
}

class EmployeeTimeEntry extends BaseData {
	var $_table = 'EmployeeTimeEntry';
}

class EmployeeProject extends BaseData {
	var $_table = 'EmployeeProjects';
}

class Document extends BaseData {
	var $_table = 'Documents';
}

class EmployeeDocument extends BaseData {
	var $_table = 'EmployeeDocuments';
}

class CompanyLoan extends BaseData {
	var $_table = 'CompanyLoans';
}

class EmployeeCompanyLoan extends BaseData {
	var $_table = 'EmployeeCompanyLoans';
}

class Setting extends BaseData {
	var $_table = 'Settings';
}

class BaseDateVN extends BaseData{
	public function PrimaryKeyName(){
		return 'MA';
	}
}
class ChiNhanh extends BaseDateVN {
	var $_table = 'CHI_NHANH';
}

class Ca extends BaseDateVN {
	var $_table = 'CA';
}

class BoPhan extends BaseDateVN {
	var $_table = 'BO_PHAN';
}

class Nguon extends BaseDateVN {
	var $_table = 'NGUON';
}

class LoaiNgay extends BaseDateVN {
	var $_table = 'LOAI_NGAY';
}

class NVState extends BaseDateVN {
	var $_table = 'NV_STATE';
}