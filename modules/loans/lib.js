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

function EmployeeCompanyLoanAdapter(endPoint) {
	this.initAdapter(endPoint);
}

EmployeeCompanyLoanAdapter.inherits(AdapterBase);



EmployeeCompanyLoanAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "loan",
	        "start_date",
	        "period_months",
	        "amount",
	        "status"
	];
});

EmployeeCompanyLoanAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Project" },
			{ "sTitle": "Loan Start Date"},
			{ "sTitle": "Loan Period (Months)"},
			{ "sTitle": "Amount"},
			{ "sTitle": "Status"}
	];
});

EmployeeCompanyLoanAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "loan", {"label":"CompanyLoan","type":"select","remote-source":["CompanyLoan","id","name"]}],
	        [ "start_date", {"label":"Loan Start Date","type":"date","validation":""}],
	        [ "last_installment_date", {"label":"Last Installment Date","type":"date","validation":"none"}],
	        [ "period_months", {"label":"Loan Period (Months)","type":"text","validation":"number"}],
	        [ "amount", {"label":"Loan Amount","type":"text","validation":"float"}],
	        [ "monthly_installment", {"label":"Monthly Installment","type":"text","validation":"float"}],
	        [ "status", {"label":"Status","type":"select","source":[["Approved","Approved"],["Paid","Paid"],["Suspended","Suspended"]]}],
	        [ "details", {"label":"Details","type":"textarea","validation":"none"}]
	];
});
