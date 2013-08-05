<?php
//include_once ("/usr/share/php/Mail.php");
include(APP_BASE_PATH.'lib/Mail.php');
include(APP_BASE_PATH.'adodb512/adodb.inc.php');
include(APP_BASE_PATH.'adodb512/adodb-active-record.inc.php');
$ADODB_ASSOC_CASE = 2;


$user = getSessionObject('user');

include (APP_BASE_PATH."classes/BaseService.php");
include (APP_BASE_PATH."classes/FileService.php");
include (APP_BASE_PATH."classes/SubActionManager.php");
include (APP_BASE_PATH."classes/AbstractInitialize.php");
include (APP_BASE_PATH."classes/SettingsManager.php");
include (APP_BASE_PATH."classes/EmailSender.php");
include (APP_BASE_PATH."mysql_error_list.php");
include (APP_BASE_PATH."model/models.inc.php");

$dbLocal = NewADOConnection(APP_CON_STR);

CompanyStructure::SetDatabaseAdapter($dbLocal);
Country::SetDatabaseAdapter($dbLocal);
Province::SetDatabaseAdapter($dbLocal);
CurrencyType::SetDatabaseAdapter($dbLocal);
JobTitle::SetDatabaseAdapter($dbLocal);
ChucVu::SetDatabaseAdapter($dbLocal);
PayGrade::SetDatabaseAdapter($dbLocal);
EmploymentStatus::SetDatabaseAdapter($dbLocal);
Skill::SetDatabaseAdapter($dbLocal);
Education::SetDatabaseAdapter($dbLocal);
Certification::SetDatabaseAdapter($dbLocal);
Language::SetDatabaseAdapter($dbLocal);
Nationality::SetDatabaseAdapter($dbLocal);
Employee::SetDatabaseAdapter($dbLocal);
User::SetDatabaseAdapter($dbLocal);
EmployeeSkill::SetDatabaseAdapter($dbLocal);
EmployeeEducation::SetDatabaseAdapter($dbLocal);
EmployeeCertification::SetDatabaseAdapter($dbLocal);
EmployeeLanguage::SetDatabaseAdapter($dbLocal);
EmergencyContact::SetDatabaseAdapter($dbLocal);
EmployeeDependent::SetDatabaseAdapter($dbLocal);
EmployeeImmigration::SetDatabaseAdapter($dbLocal);
EmployeeSalary::SetDatabaseAdapter($dbLocal);
LeaveType::SetDatabaseAdapter($dbLocal);
LeavePeriod::SetDatabaseAdapter($dbLocal);
WorkDay::SetDatabaseAdapter($dbLocal);
HoliDay::SetDatabaseAdapter($dbLocal);
LeaveRule::SetDatabaseAdapter($dbLocal);
EmployeeLeave::SetDatabaseAdapter($dbLocal);
EmployeeLeaveDay::SetDatabaseAdapter($dbLocal);
File::SetDatabaseAdapter($dbLocal);
Client::SetDatabaseAdapter($dbLocal);
Project::SetDatabaseAdapter($dbLocal);
EmployeeTimeSheet::SetDatabaseAdapter($dbLocal);
EmployeeTimeEntry::SetDatabaseAdapter($dbLocal);
EmployeeProject::SetDatabaseAdapter($dbLocal);
Document::SetDatabaseAdapter($dbLocal);
EmployeeDocument::SetDatabaseAdapter($dbLocal);
CompanyLoan::SetDatabaseAdapter($dbLocal);
EmployeeCompanyLoan::SetDatabaseAdapter($dbLocal);
Setting::SetDatabaseAdapter($dbLocal);

ChiNhanh::SetDatabaseAdapter($dbLocal);
Ca::SetDatabaseAdapter($dbLocal);
BoPhan::SetDatabaseAdapter($dbLocal);
Nguon::SetDatabaseAdapter($dbLocal);
LoaiNgay::SetDatabaseAdapter($dbLocal);
NVState::SetDatabaseAdapter($dbLocal);
NhanVien::SetDatabaseAdapter($dbLocal);
NhuCauTuyenDung::SetDatabaseAdapter($dbLocal);

$baseService = new BaseService();
$baseService->setNonDeletables("User", "id", 1);
$baseService->setCurrentUser($user);
$baseService->setDB($dbLocal);

$fileService = new FileService();
$settingsManager = new SettingsManager();
$emailEnabled = $settingsManager->getSetting("Email: Enable");
$emailMode = $settingsManager->getSetting("Email: Mode");
$emailSender = null;
if($emailEnabled == "1"){
	if($emailMode == "SMTP"){
		$emailSender = new SMTPEmailSender($settingsManager);	
	}else if($emailMode == "SNS"){
		$emailSender = new SNSEmailSender($settingsManager);	
	}	
}

$userTables = array(
"EmployeeSkill",
"EmployeeEducation",
"EmployeeCertification",
"EmployeeLanguage",
"EmergencyContact",
"EmployeeDependent",
"EmployeeImmigration",
"EmployeeSalary",
"EmployeeLeave",
"EmployeeTimeSheet",
"EmployeeTimeEntry",
"EmployeeProject",
"EmployeeDocument",
"EmployeeCompanyLoan"
);

$baseService->setUserTables($userTables);

$baseService->setSqlErrors($mysqlErrors);

?>
