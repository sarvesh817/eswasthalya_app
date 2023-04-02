<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    $route['default_controller'] = 'login';
    $route['404_override'] = 'login/pageNotFound';
    $route['no_data_found_override'] = 'login/NoDataFound';
    $route['translate_uri_dashes'] = FALSE;
    
//Login Module

    $route['home'] = 'home';
    $route['dashboard'] = 'home/dashboard';
    $route['loginvalidate'] = 'login/loginvalidate';
    $route['loginNow'] = 'Login/loginNow';
    $route['home/checkCurrSession'] = 'home/checkCurrSession';
    $route['changepassword'] = 'changepassword';
    $route['changePasswordForm'] = 'changepassword/changePasswordForm';


// user Module start

    $route['user-register'] = 'User/addDoctorView';
    $route['user-submitForm'] = 'User/submitForm';
    $route['emailVerify'] = 'User/emailVerify';
    $route['mobileVerify'] = 'User/mobileVerify';
    
    
// Super Admin Module Start

    $route['superadmin'] = 'Masterlogin';
    $route['superadmin/dashboard'] = 'home';
    $route['superadmin/doctor-list'] = 'SuperadminDoctor/index';
    $route['superadmin/doctor-profile/(:num)'] = 'SuperadminDoctor/doctorProfileView/$1';
    
    $route['superadmin/eclinic-list'] = 'SuperadminEclinic/index';
    $route['superadmin/eclinic-profile/(:num)'] = 'SuperadminEclinic/eclinicProfileView/$1';
    
    $route['superadmin/patient-list'] = 'SuperadminPatient/index';
    $route['superadmin/single-patient/(:num)'] = 'SuperadminPatient/single_patient/$1';
    
    $route['masterloginNow'] = 'Masterlogin/loginNow';
    $route['superadminLogout'] = 'Masterlogin/logout';
 
// Doctor Module start

    $route['doctors/dashboard'] = 'DoctorsPanel/index';
    $route['doctors/consultation-history'] = 'DoctorsPanel/consultation_history';
    $route['doctors/add-feedback'] = 'Feedback/add_feedback';
    $route['doctors/all-feedback'] = 'Feedback/all_feedback';
    $route['doctors/schedule-working-hours'] = 'DoctorsPanel/schedule_working_hours';
    $route['doctors/update-sw/(:num)'] = 'DoctorsPanel/update_sw/$1';
    $route['doctors/delete-sw/(:num)'] = 'DoctorsPanel/delete_sw/$1'; 
    $route['doctors/update-sm/(:num)/:any'] = 'DoctorsPanel/update_sm/$1';
    $route['doctors/update-sm/(:num)'] = 'DoctorsPanel/update_sm/$1';  
    $route['doctors/delete-sm/(:num)'] = 'DoctorsPanel/delete_sm/$1'; 
    $route['doctors/deleteall-slot'] = 'DoctorsPanel/delete_all_appointments';    
    $route['doctors/slot-management'] = 'DoctorsPanel/slot_management';
    $route['doctors/wallet'] = 'DoctorsPanel/wallet';
    $route['doctors/profile'] = 'DoctorsPanel/profile';
    $route['doctors/edit-profile'] = 'DoctorsPanel/edit_profile';
    $route['doctors/setting'] = 'DoctorsPanel/setting';
    $route['doctors/support-ticket'] = 'DoctorsPanel/support_ticket';

    $route['doctors/profile-update'] = 'DoctorsPanel/profile_update';
    
    $route['doctors/update-column-profile/(:num)'] = 'DoctorsPanel/update_column_profile/$1'; 

    $route['doctors/fetch-dependent-datewise-data'] = 'DoctorsPanel/fetch_dependent_datewise_data';
    
    $route['doctors/single-patient/(:num)'] = 'DoctorsPanel/single_patient/$1';
    $route['doctors/write-prescription/(:num)'] = 'DoctorsPanel/write_prescription/$1';

// E-clinic Module start

	$route['eclinic/dashboard'] = 'EclinicPanel/index';
	$route['eclinic/profile'] = 'EclinicPanel/profile';
	$route['eclinic/edit-profile'] = 'EclinicPanel/edit_profile';
	$route['eclinic/update-profile'] = 'EclinicPanel/profile_update';
	$route['eclinic/update-column-profile/(:num)'] = 'EclinicPanel/update_column_profile/$1';
	
	// E-clinic Patient Module start
	
	$route['eclinic/patient-list'] = 'Patient/index';
	$route['eclinic/patient-register'] = 'Patient/patient_register';
	
	$route['eclinic/consultation-history'] = 'EclinicPanel/consultation_history';
	$route['eclinic/single-patient/(:num)'] = 'EclinicPanel/single_patient/$1';
	
	$route['eclinic/patient-medical-history-details/(:num)'] = 'EclinicPanel/patient_medical_history_details/$1';
	//$route['eclinic/patient-medical-history-details'] = 'EclinicPanel/patient_medical_history_details';
	
	$route['eclinic/appointments'] = 'EclinicPanel/appointments';
    $route['eclinic/book-new-appointment'] = 'EclinicPanel/book_new_appointment';
	$route['eclinic/fetch-dependent-doctors'] = 'EclinicPanel/fetch_dependent_doctors';
	$route['eclinic/fetch-dependent-appointment'] = 'EclinicPanel/fetch_dependent_appointment';
	$route['eclinic/fetch-dependent-patient'] = 'EclinicPanel/fetch_dependent_patient';
	
	$route['eclinic/wallet'] = 'EclinicWallet/index';
	
	$route['eclinic/referral'] = 'EclinicPanel/referral';
	$route['eclinic/add-new-referral'] = 'EclinicPanel/add_new_referral';
	
	$route['eclinic/accounting'] = 'EclinicPanel/accounting';
	$route['eclinic/medicine'] = 'EclinicPanel/medicine';
	
	$route['eclinic/add-feedback'] = 'EclinicFeedback/add_feedback';
    $route['eclinic/all-feedback'] = 'EclinicFeedback/all_feedback';
    
    $route['eclinic/setting'] = 'EclinicPanel/setting';
	
	


// Patient Module start



