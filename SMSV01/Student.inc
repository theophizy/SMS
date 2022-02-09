<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 IZY Brand Nig Ltd
 *
 *  All rights reserved
 *
 *  This script is part of the webleaves Portal project. The Webleaves Portal is
 *  COPYRIGHTED. The software may not be redistributed and/or modified
 *  without appropriate authorisation from Izy Brand ltd. The use of
 *  the software is subject to terms and conditons indicated
 *  in http://www.izybrand.com
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * Created on 10 October 2009
 **************************************************************
 *
 * Description of Student Class
 * This class stores the details of student and hanldles the student processes
 *
 * @author Zubair & Ibrahim
 *
 */


class Student 
{
    //details of a member

    var $title="";
    var $date_of_entry ="";
    var $matriculation_no="";
    
    var $firstname ="";
    var $surname ="";
    var $othernames ="";
    var $email="";

    var $student_id = 0; 
    var $postal_address ="";
    var $residential_address = "";
    var $phone_no = "";
    var $dob ="";
    var $place_of_birth ="";
    var $state_of_origin ="";
    
    var $lga = "";
    var $home_town="";
    var $marital_status ="";
    var $spouse_name = "";
    var $no_of_children = "";
    var $guardian_name = "";
    var $guardian_address = "";
    var $nationality ="";
    var $maiden_name = "";
    var $next_of_kin_name ="";
    var $next_of_kin_relationship ="";
    var $next_of_kin_address = "";
    var $next_of_kin_pob ="";
    var $next_of_kin_phone_no ="";
    var $father_name ="";
    var $father_occupation ="";
    var $father_address = "";
    var $father_phone_no = "";
    var $mother_name ="";
    var $mother_occupation ="";
    var $mother_address ="";
    var $mother_phone_no = "";
    var $program_applied_for="";
    var $ipaddress ="";
    var $application_timestamp ="";
    var $photo ="";
    var $declaration ="";
    var $birth_certificate="";	// filename of birth certificate
    var $credentials = "";		// Semi-colon delimited list of credential filenames
    var $department_id = 0;		// id of department, student belongs to.
    var $approving_admission_unit_id = 0;
	
    var $institutions;
    var $subject_combo="";
    var $faculty_id="";
    var $admission_year="";
    var $admission_type="";
    var $sex="";

    var $password="";
    var $password2="";

    
    var $approving_faculty_member_id= 0;

    var $approving_school_officer_id= 0;
    var $approving_student_affair_officer_id= 0;
    var $hod_course_approval_id= 0;
    var $dean_course_approval_id= 0;
    var $jb_student; // TODO: CAN U KINDLY REMOVE, WHOEVER OWNS? 
    
    var $approving_admission_unit_timestamp;
    var $approving_hod_timestamp;
    var $apply_faculty_approval_timestamp;
    var $major="";
    var $secondary_department_id="";
    var $level_id = 1; // current level that student is on
    var $course_registration_request = 0;   // request to register for courses.
	var $academic_session = '';
	var $semester = '';
	var $jamb_reg_no = '';
	var $clearance_lock = 0;
	var $clearance_lock_comment = 0;
	var $score_average;						// Average percentage for student
	var	$cumulative_grade_point;			// Cumulative Grade Point for student	
	var $total_credit_units;					// current total credit load for student
	var $total_subjects;					// current total credit load for student	
			
	var $jamb_no;
	var $jamb_score;
	var $jamb_centre;
	
	var $old_matriculation_no;	
	
	// sx
	var $class;
	var $house;
	
	
	

    //class constructor
    function Student(  $student_id=0, $firstname ="", $surname ="" , $othernames ="", $email="", $postal_address ="", $residential_address = "",
        $phone_no = "", $dob ="", $place_of_birth ="", $state_of_origin ="", $lga = "", $marital_status ="", $nationality ="", $maiden_name = "",
        $next_of_kin_name ="", $next_of_kin_relationship ="", $next_of_kin_address = "", $next_of_kin_pob ="",
        $next_of_kin_phone_no ="", $father_name ="", $father_occupation ="", $father_address = "", $father_phone_no = "", $mother_name ="",
        $mother_occupation ="", $mother_address ="", $mother_phone_no = "", $sponsor_name ="", $sponsor_email ="", $sponsor_occupation ="",
        $sponsor_address ="", $sponsor_phone_no = "", $program_applied_for="", $ipaddress ="",
        $application_timestamp ="", $photo ="", $declaration="Reject", $department_id=0, $birth_certificate="", $credentials="", 
        $password="", $password2="", $subject_combo="", $exam = array(), $institutions = array(),
        $title="", $date_of_entry ="", $matriculation_no="", $sex="",
        $home_town ="", $spouse_name ="",
        $no_of_children ="", $guardian_name ="", $guardian_address ="", $admission_year ="", $admission_type ="", $faculty_id ="", 
        $approving_admission_unit_id=0, $approving_faculty_member_id= 0, $approving_school_officer_id= 0,
        $approving_student_affair_officer_id= 0, $hod_course_approval_id= 0, $dean_course_approval_id= 0,
        $approving_hod_id = 0, $apply_faculty_approval_id = 0, $approving_admission_unit_timestamp=0,
        $approving_hod_timestamp = 0, $apply_faculty_approval_timestamp = 0, $major="", $secondary_department_id="" )
    {

       $this->student_id = $student_id;
       $this->firstname = $firstname;
       $this->surname = $surname;
       $this->othernames = $othernames;
       $this->email = $email;
       $this->postal_address = $postal_address;
       $this->residential_address = $residential_address;
       $this->phone_no = $phone_no;
       $this->dob = $dob;
       $this->place_of_birth = $place_of_birth;
       $this->state_of_origin = $state_of_origin;
       $this->lga =  $lga;
       $this->marital_status = $marital_status;
       $this->nationality = $nationality;
       $this->maiden_name =  $maiden_name;
       $this->next_of_kin_name = $next_of_kin_name;
       $this->next_of_kin_relationship = $next_of_kin_relationship;
       $this->next_of_kin_address =  $next_of_kin_address;
       $this->next_of_kin_pob = $next_of_kin_pob;
       $this->next_of_kin_phone_no = $next_of_kin_phone_no;
       $this->father_name = $father_name;
       $this->father_occupation = $father_occupation;
       $this->father_address =  $father_address;
       $this->father_phone_no =  $father_phone_no;
       $this->mother_name = $mother_name;
       $this->mother_occupation = $mother_occupation;
       $this->mother_address = $mother_address;
       $this->mother_phone_no =  $mother_phone_no;

       $this->sponsor_name = $sponsor_name;
       $this->sponsor_email = $sponsor_email;
       $this->sponsor_occupation = $sponsor_occupation;
       $this->sponsor_address = $sponsor_address;
       $this->sponsor_phone_no = $sponsor_phone_no;

       $this->program_applied_for = $program_applied_for;
       $this->ipaddress = $ipaddress;
       $this->application_timestamp = $application_timestamp;
       $this->photo = $photo;
       $this->declaration = $declaration;
       $this->birth_certificate = $birth_certificate;
       $this->credentials = $credentials ;
       $this->department_id = $department_id;
        
        if( !empty( $exam ) )
            $this->exams = $exam;

        if( !empty( $institutions ) )
            $this->institutions = $institutions;


        $this->subject_combo = $subject_combo;
        $this->password = $password;
        $this->password2 = $password2;
        $this->home_town = $home_town;
        $this->spouse_name = $spouse_name;
        $this->no_of_children = $no_of_children;
        $this->guardian_name = $guardian_name;
        $this->guardian_address = $guardian_address;
        $this->admission_type = $admission_type;
        $this->admission_year = $admission_year;
        $this->faculty_id = $faculty_id;
        $this->sex = $sex;
       
        $this->approving_admission_unit_id =  $approving_admission_unit_id;
        $this->approving_faculty_member_id = $approving_faculty_member_id;

        $this->approving_school_officer_id = $approving_school_officer_id;
        $this->approving_student_affair_officer_id = $approving_student_affair_officer_id;
        $this->hod_course_approval_id = $hod_course_approval_id;
        $this->dean_course_approval_id = $dean_course_approval_id;

        $this->approving_hod_id =  $approving_hod_id;
        $this->apply_faculty_approval_id = $apply_faculty_approval_id;

        $this->approving_admission_unit_timestamp =  $approving_admission_unit_timestamp;
        $this->approving_hod_timestamp = $approving_hod_timestamp;
        $this->apply_faculty_approval_timestamp = $apply_faculty_approval_timestamp ;
        $this->major=$major;
        $this->secondary_department_id = $secondary_department_id;

        $this->title = $title;
        $this->date_of_entry = $date_of_entry;
        $this->matriculation_no = $matriculation_no;
        
    }

    
    function StudentHTMLFormFix()
    {
       //$this->student_id = HTMLFormFix( $this->student_id ) ;
       $this->firstname = HTMLFormFix( $this->firstname );
       $this->surname = HTMLFormFix( $this->surname );
       $this->othernames = HTMLFormFix( $this->othernames );
       $this->email = HTMLFormFix( $this->email );
  
       $this->postal_address = HTMLFormFix( $this->postal_address );
       $this->residential_address = HTMLFormFix( $this->residential_address );
       $this->phone_no = HTMLFormFix( $this->phone_no );
       $this->dob = HTMLFormFix( $this->dob );
       $this->place_of_birth = HTMLFormFix( $this->place_of_birth );
       $this->state_of_origin = HTMLFormFix( $this->state_of_origin );
       $this->lga =  HTMLFormFix( $this->lga );
       $this->marital_status = HTMLFormFix( $this->marital_status );
       $this->nationality = HTMLFormFix( $this->nationality );
       $this->maiden_name =  HTMLFormFix( $this->maiden_name );
       $this->next_of_kin_name = HTMLFormFix( $this->next_of_kin_name );
       $this->next_of_kin_relationship = HTMLFormFix( $this->next_of_kin_relationship );
       $this->next_of_kin_address =  HTMLFormFix( $this->next_of_kin_address );
       $this->next_of_kin_pob = HTMLFormFix( $this->next_of_kin_pob );
       $this->next_of_kin_phone_no = HTMLFormFix( $this->next_of_kin_phone_no );
       $this->father_name = HTMLFormFix( $this->father_name );
       $this->father_occupation = HTMLFormFix( $this->father_occupation );
       $this->father_address =  HTMLFormFix( $this->father_address );
       $this->father_phone_no =  HTMLFormFix( $this->father_phone_no );
       $this->mother_name = HTMLFormFix( $this->mother_name );
       $this->mother_occupation = HTMLFormFix( $this->mother_occupation );
       $this->mother_address = HTMLFormFix( $this->mother_address );
       $this->mother_phone_no =  HTMLFormFix( $this->mother_phone_no );

       $this->sponsor_name = HTMLFormFix( $this->sponsor_name );
       $this->sponsor_email = HTMLFormFix( $this->sponsor_email );
       $this->sponsor_occupation = HTMLFormFix( $this->sponsor_occupation );
       $this->sponsor_address = HTMLFormFix( $this->sponsor_address );
       $this->sponsor_phone_no = HTMLFormFix( $this->sponsor_phone_no );

       $this->program_applied_for = HTMLFormFix( $this->program_applied_for );
       $this->ipaddress = HTMLFormFix( $this->ipaddress );
       $this->application_timestamp = HTMLFormFix( $this->application_timestamp );
       $this->photo = HTMLFormFix( $this->photo );
       $this->declaration = HTMLFormFix( $this->declaration );
       $this->birth_certificate = HTMLFormFix( $this->birth_certificate );
       $this->credentials = HTMLFormFix( $this->credentials );
        $this->department_id = HTMLFormFix( $this->department_id );
        
         // TODO FIND A WAY TO ITERATE THROUGH ALL EXAMS AND INSTITUTIONS TO CARRYOUT FORM FIX
        //$this->exams = HTMLFormFix( $this->exam );
        //$this->institutions = HTMLFormFix( $this->institutions );

        $this->subject_combo = HTMLFormFix( $this->subject_combo );
        $this->password = HTMLFormFix( $this->password );
        $this->password2 = HTMLFormFix( $this->password2 );
        $this->home_town = HTMLFormFix( $this->home_town );
        $this->spouse_name = HTMLFormFix( $this->spouse_name );
        $this->no_of_children = HTMLFormFix( $this->no_of_children );
        $this->guardian_name = HTMLFormFix( $this->guardian_name );
        $this->guardian_address = HTMLFormFix( $this->guardian_address );
        $this->admission_type = HTMLFormFix( $this->admission_type );
        $this->admission_year = HTMLFormFix( $this->admission_year );
        $this->faculty_id = HTMLFormFix( $this->faculty_id );
        $this->sex = HTMLFormFix( $this->sex );
       
        $this->approving_admission_unit_id = HTMLFormFix( $this->approving_admission_unit_id );
        $this->approving_faculty_member_id = HTMLFormFix( $this->approving_faculty_member_id );

        $this->approving_school_officer_id = HTMLFormFix( $this->approving_school_officer_id );
        $this->approving_student_affair_officer_id = HTMLFormFix( $this->approving_student_affair_officer_id );
        $this->hod_course_approval_id = HTMLFormFix( $this->hod_course_approval_id );
        $this->dean_course_approval_id = HTMLFormFix( $this->dean_course_approval_id );

        $this->approving_hod_id =  HTMLFormFix( $this->approving_hod_id );
        $this->apply_faculty_approval_id = HTMLFormFix( $this->apply_faculty_approval_id );

		$this->approving_admission_unit_timestamp =  HTMLFormFix( $this->approving_admission_unit_timestamp );
        $this->approving_hod_timestamp = HTMLFormFix( $this->approving_hod_timestamp );
        $this->apply_faculty_approval_timestamp = HTMLFormFix( $this->apply_faculty_approval_timestamp );


        $this->title = HTMLFormFix( $this->title );
        $this->date_of_entry = HTMLFormFix( $this->date_of_entry );
        $this->matriculation_no = HTMLFormFix( $this->matriculation_no );	
    }
	
		
	    function StudentEspaceString()
		{
				
       //$this->student_id = mysql_real_escape_string( $this->student_id ) ;
       $this->firstname = mysql_real_escape_string( $this->firstname );
       $this->surname = mysql_real_escape_string( $this->surname );
       $this->othernames = mysql_real_escape_string( $this->othernames );
       $this->email = mysql_real_escape_string( $this->email );
  
       $this->postal_address = mysql_real_escape_string( $this->postal_address );
       $this->residential_address = mysql_real_escape_string( $this->residential_address );
       $this->phone_no = mysql_real_escape_string( $this->phone_no );
       $this->dob = mysql_real_escape_string( $this->dob );
       $this->place_of_birth = mysql_real_escape_string( $this->place_of_birth );
       $this->state_of_origin = mysql_real_escape_string( $this->state_of_origin );
       $this->lga =  mysql_real_escape_string( $this->lga );
       $this->marital_status = mysql_real_escape_string( $this->marital_status );
       $this->nationality = mysql_real_escape_string( $this->nationality );
       $this->maiden_name =  mysql_real_escape_string( $this->maiden_name );
       $this->next_of_kin_name = mysql_real_escape_string( $this->next_of_kin_name );
       $this->next_of_kin_relationship = mysql_real_escape_string( $this->next_of_kin_relationship );
       $this->next_of_kin_address =  mysql_real_escape_string( $this->next_of_kin_address );
       $this->next_of_kin_pob = mysql_real_escape_string( $this->next_of_kin_pob );
       $this->next_of_kin_phone_no = mysql_real_escape_string( $this->next_of_kin_phone_no );
       $this->father_name = mysql_real_escape_string( $this->father_name );
       $this->father_occupation = mysql_real_escape_string( $this->father_occupation );
       $this->father_address =  mysql_real_escape_string( $this->father_address );
       $this->father_phone_no =  mysql_real_escape_string( $this->father_phone_no );
       $this->mother_name = mysql_real_escape_string( $this->mother_name );
       $this->mother_occupation = mysql_real_escape_string( $this->mother_occupation );
       $this->mother_address = mysql_real_escape_string( $this->mother_address );
       $this->mother_phone_no =  mysql_real_escape_string( $this->mother_phone_no );

       $this->sponsor_name = mysql_real_escape_string( $this->sponsor_name );
       $this->sponsor_email = mysql_real_escape_string( $this->sponsor_email );
       $this->sponsor_occupation = mysql_real_escape_string( $this->sponsor_occupation );
       $this->sponsor_address = mysql_real_escape_string( $this->sponsor_address );
       $this->sponsor_phone_no = mysql_real_escape_string( $this->sponsor_phone_no );

       $this->program_applied_for = mysql_real_escape_string( $this->program_applied_for );
       $this->ipaddress = mysql_real_escape_string( $this->ipaddress );
       $this->application_timestamp = mysql_real_escape_string( $this->application_timestamp );
       $this->photo = mysql_real_escape_string( $this->photo );
       $this->declaration = mysql_real_escape_string( $this->declaration );
       $this->birth_certificate = mysql_real_escape_string( $this->birth_certificate );
       $this->credentials = mysql_real_escape_string( $this->credentials );
        $this->department_id = mysql_real_escape_string( $this->department_id );
        
         // TODO FIND A WAY TO ITERATE THROUGH ALL EXAMS AND INSTITUTIONS TO CARRYOUT FORM FIX
        //$this->exams = mysql_real_escape_string( $this->exam );
        //$this->institutions = mysql_real_escape_string( $this->institutions );

        $this->subject_combo = mysql_real_escape_string( $this->subject_combo );
        $this->password = mysql_real_escape_string( $this->password );
        $this->password2 = mysql_real_escape_string( $this->password2 );
        $this->home_town = mysql_real_escape_string( $this->home_town );
        $this->spouse_name = mysql_real_escape_string( $this->spouse_name );
        $this->no_of_children = mysql_real_escape_string( $this->no_of_children );
        $this->guardian_name = mysql_real_escape_string( $this->guardian_name );
        $this->guardian_address = mysql_real_escape_string( $this->guardian_address );
        $this->admission_type = mysql_real_escape_string( $this->admission_type );
        $this->admission_year = mysql_real_escape_string( $this->admission_year );
        $this->faculty_id = mysql_real_escape_string( $this->faculty_id );
        $this->sex = mysql_real_escape_string( $this->sex );
       
        $this->approving_admission_unit_id = mysql_real_escape_string( $this->approving_admission_unit_id );
        $this->approving_faculty_member_id = mysql_real_escape_string( $this->approving_faculty_member_id );

        $this->approving_school_officer_id = mysql_real_escape_string( $this->approving_school_officer_id );
        $this->approving_student_affair_officer_id = mysql_real_escape_string( $this->approving_student_affair_officer_id );
        $this->hod_course_approval_id = mysql_real_escape_string( $this->hod_course_approval_id );
        $this->dean_course_approval_id = mysql_real_escape_string( $this->dean_course_approval_id );

        $this->approving_hod_id =  mysql_real_escape_string( $this->approving_hod_id );
        $this->apply_faculty_approval_id = mysql_real_escape_string( $this->apply_faculty_approval_id );

		$this->approving_admission_unit_timestamp =  mysql_real_escape_string( $this->approving_admission_unit_timestamp );
        $this->approving_hod_timestamp = mysql_real_escape_string( $this->approving_hod_timestamp );
        $this->apply_faculty_approval_timestamp = mysql_real_escape_string( $this->apply_faculty_approval_timestamp );


        $this->title = mysql_real_escape_string( $this->title );
        $this->date_of_entry = mysql_real_escape_string( $this->date_of_entry );
        $this->matriculation_no = mysql_real_escape_string( $this->matriculation_no );	
    }	
	
	
	
	
	// mutators
	// set student id
	function setStudentId( $student_id ){ $this->student_id = $student_id; }
	function setMatric( $m ){ $this->matriculation_no = $m; }
	function setJambRegNo( $j ){ $this->jamb_reg_no = $j; }
	function setOld_matriculation_no ( $m ){ $this->old_matriculation_no = $m; }
	
	function setJambNo( $j ){ $this->jamb_no = $j; }
	function setJambScore( $s ){ $this->jamb_score = $s; }
	function setJambCentre( $s ){ $this->jamb_centre = $s; }
	
	function setApproving_admission_unit_id( $id ){ $this->approving_admission_unit_id = id; }
    function setLevelId( $id ){$this->level_id = $id; }
    function setCourseRegistrationRequest( $req ){ $this->course_registration_request = $req; }
    function setClearanceLock( $l ){ $this->clearance_lock = $l; }
	function setAcademic_session( $val ){ $this->academic_session = $val; }
	function setSemester( $val ){ $this->semester = $val; }
    function setInstitutionAttended( $institutions ){ $this->institutions = $institutions; }
	function setExam( $exam ){ $this->exam = $exam ;}
	
	function setClass( $c ){ $this->class = $c; }
	function setHouse( $c ){ $this->house = $c; }
	
    function getStudentId(){return $this->student_id;}
    function getLevelId(){return $this->level_id; }
		
    function getCourseRegistrationRequest(){ return $this->course_registration_request; }
	 

    /*
     * 
     * This function is used for storing new student in db
     *
     */
     function createStudent()
     {
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
                return FALSE;
            }


         $this->StudentEspaceString();
         //sql query to insert the student record into the table
         /*
		 $sql = "INSERT into ".STUDENT_TABLE."( firstname, surname, othernames, email, postal_address, residential_address, phone_no, dob, place_of_birth,
                                      state_of_origin, lga, marital_status, nationality, maiden_name, next_of_kin_name, next_of_kin_relationship,
                                      next_of_kin_address, next_of_kin_pob, next_of_kin_phone_no, father_name, father_address, 
                                      father_occupation, father_phone_no, mother_name, mother_occupation, mother_address, mother_phone_no,
                                      program_applied_for, ipaddress, application_timestamp, photo, birth_certificate, credentials, department_id, 
                                      password, subject_combo, sponsor_name, sponsor_email, sponsor_occupation, sponsor_address,
                                      sponsor_phone_no, title, date_of_entry, matriculation_no, sex, jamb_reg_no )
                           values( '$this->firstname', '$this->surname', '$this->othernames', '$this->email',
                                   '$this->postal_address', '$this->residential_address', '$this->phone_no', '$this->dob',
                                   '$this->place_of_birth', '$this->state_of_origin', '$this->lga', '$this->marital_status',
                                   '$this->nationality', '$this->maiden_name', '$this->next_of_kin_name', '$this->next_of_kin_relationship',
                                   '$this->next_of_kin_address', '$this->next_of_kin_pob', '$this->next_of_kin_phone_no', '$this->father_name', '$this->father_address',
                                   '$this->father_occupation', '$this->father_phone_no', '$this->mother_name', '$this->mother_occupation',
                                   '$this->mother_address', '$this->mother_phone_no', '$this->program_applied_for','$this->ipaddress',
                                   NOW(), '$this->photo', '$this->birth_certificate', '$this->credentials', '$this->department_id', 
                                   '$this->password', '$this->subject_combo', '$this->sponsor_name', '$this->sponsor_email',
                                   '$this->sponsor_occupation', '$this->sponsor_address', '$this->sponsor_phone_no',
                                   '$this->title', '$this->date_of_entry', '$this->matriculation_no', '$this->sex', '$_REQUEST[jamb_no]' 
                                     )";
			*/
		
			 $sql = "INSERT into ".STUDENT_TABLE."( firstname, surname, othernames, email, postal_address, residential_address, phone_no, dob, place_of_birth,
                                      state_of_origin, lga, marital_status, nationality, maiden_name, next_of_kin_name, next_of_kin_relationship,
                                      next_of_kin_address, next_of_kin_pob, next_of_kin_phone_no, father_name, father_address, 
                                      father_occupation, father_phone_no, mother_name, mother_occupation, mother_address, mother_phone_no,
                                      program_applied_for, ipaddress, application_timestamp, photo, birth_certificate, credentials, department_id, 
                                      password, subject_combo, sponsor_name, sponsor_email, sponsor_occupation, sponsor_address,
                                      sponsor_phone_no, title, date_of_entry, matriculation_no, sex, jamb_reg_no, jamb_score, jamb_centre, secondary_department_id )
                           values( '$this->firstname', '$this->surname', '$this->othernames', '$this->email',
                                   '$this->postal_address', '$this->residential_address', '$this->phone_no', '$this->dob',
                                   '$this->place_of_birth', '$this->state_of_origin', '$this->lga', '$this->marital_status',
                                   '$this->nationality', '$this->maiden_name', '$this->next_of_kin_name', '$this->next_of_kin_relationship',
                                   '$this->next_of_kin_address', '$this->next_of_kin_pob', '$this->next_of_kin_phone_no', '$this->father_name', '$this->father_address',
                                   '$this->father_occupation', '$this->father_phone_no', '$this->mother_name', '$this->mother_occupation',
                                   '$this->mother_address', '$this->mother_phone_no', '$this->program_applied_for','$this->ipaddress',
                                   NOW(), '$this->photo', '$this->birth_certificate', '$this->credentials', '$this->department_id', 
                                   '$this->password', '$this->subject_combo', '$this->sponsor_name', '$this->sponsor_email',
                                   '$this->sponsor_occupation', '$this->sponsor_address', '$this->sponsor_phone_no',
                                   '$this->title', '$this->date_of_entry', '$this->matriculation_no', '$this->sex',  '$this->jamb_no', '$this->jamb_score', '$this->jamb_centre',
								   '$this->secondary_department_id'
                                     )";						 
									 
			//print_r( $this->father_name .' -- ' .$sql );
         // Execute the query
         if (! $db->Query($sql)) {
             $db->Kill();
             return FALSE;
         } else {
			//get the student id
            $this->setStudentId( $db->GetLastInsertID() );
			return TRUE;
         }
            
     }


     /*
     ** This function is used for storing instution attended details into the database.
     * @return True/False if the insertion is successful
     */
     function createInstitutionAttended()
     {
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
                return FALSE;
            }

        //sql query to insert the institution attended record into the table
        if( !empty( $this->institutions ) )
            foreach($this->institutions as $inst )
            {
                 $sql = "INSERT into ".INSTITUTION_ATTENDED_TABLE."(student_id, institution_name, start_date, end_date)
                                 values('$this->student_id', '".mysql_real_escape_string( $inst[institution_name] )."', 
                                    '".mysql_real_escape_string( $inst[start_date] )."', '".mysql_real_escape_string( $inst[end_date] )."')";

				 // Execute the query
				 if (! $db->Query($sql)) {
					 $db->Kill();
					 return FALSE;	
				 }
            }

            return TRUE;
	}

	// delete institutions attended of a student
	function deleteInstitutionAttended()
     {
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
			$db->Kill();
            return FALSE;
		}
		
		$sql = "DELETE from ".INSTITUTION_ATTENDED_TABLE." where student_id = '$this->student_id'";

		 if (! $db->Query($sql)) {
			$db->Kill();
			return FALSE;	
		}	
		
		return TRUE;
	}
	
	// delete olevel exams stored for a student
	function deleteOlevelExams()
     {
        $exams = $this->getOlevelExams();	
        $db = new MySQL();
        if (! $db->Open()) {
			$db->Kill();
            return FALSE;
		}
				
		foreach( $exams as $ex ){ 
			$sql = "DELETE from ".OLEVEL_RESULT_TABLE." where exam_id ='".$ex['exam_id']."'";
				
			if ( !$db->Query( $sql ) ) {
				print_r( 'tet' . $db->Error() );
				$db->Kill();
				//return FALSE;				
			}
		}
				
		$sql2 = "DELETE from ".OLEVEL_EXAM_TABLE." where student_id ='$this->student_id'";
		if (! $db->Query($sql2)) {
				$db->Kill();
				return FALSE;				
		}
		//print_r( $sql. '<br />'. $sql2 );	
		
		//print_r( 'test' );
		return TRUE;
	}
	

     /*
     ** This function is used for storing student's olevel exam details into the database.
     * @return True/False if the insertion is successful or not
     */
     function createOlevelExam()
     {
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
                return FALSE;
            }

         //   $this->StudentHTMLFormFix();

          $ex_i = 0;

          if( !empty( $this->exams ) ){
            foreach( $this->exams as $ex ){
               //sql query to insert the exams record into the table
               if( trim( $ex[exam_name] ) != '' ) {
                        $sql = "INSERT into ".OLEVEL_EXAM_TABLE."(student_id, exam_name, exam_no, exam_date, exam_center )
                                 values('".$this->student_id."', '".mysql_real_escape_string( $ex[exam_name] )."', '".mysql_real_escape_string( $ex[exam_no] )."',
								 '".mysql_real_escape_string( $ex[exam_date] )."', '".mysql_real_escape_string( $ex[exam_center] )."')";
						
							
                         // Execute the query
                         if (! $db->Query($sql)) {
                             $db->Kill();
                             return FALSE;
                         }

                        $exrst_i = 0;
                        $ex_id = $db->GetLastInsertID();

                        foreach( $ex[result] as $rst )
                        {

                           if( trim( $rst[subject] ) != '' && trim( $rst[grade] ) != ''  )  {
                                $exrst_i++;
                                $sql = "INSERT into ".OLEVEL_RESULT_TABLE."(exam_id, subject_name, subject_grade)
                                                    values('$ex_id', '".mysql_real_escape_string( $rst[subject] )."', '".mysql_real_escape_string( $rst[grade] ) ."')";
                               // Execute the query
                               if (! $db->Query($sql)) {
                                  $db->Kill();
                                  return FALSE;
                                        }
                           }
                        $ex_i++;
                    }
                }
            }
          }
		  
		  return TRUE;
     }



    /*
     * This function is used to update student records
     * @return Boolean TRUE/FALSE the value returned depending on the success of function execution
     */
     function updateStudent()
     {

        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }

    $this->StudentEspaceString();
    //the update query to update student record.
    $sql = "update ".STUDENT_TABLE." set firstname = '$this->firstname', surname='$this->surname', othernames='$this->othernames',
                                      sex='$this->sex', postal_address ='$this->postal_address', residential_address='$this->residential_address',
                                      phone_no='$this->phone_no', dob='$this->dob', place_of_birth='$this->place_of_birth', home_town='$this->home_town',
                                      state_of_origin='$this->state_of_origin', lga='$this->lga', marital_status='$this->marital_status',
                                      next_of_kin_name='$this->next_of_kin_name', next_of_kin_relationship='$this->next_of_kin_relationship',
                                      next_of_kin_address='$this->next_of_kin_address', next_of_kin_phone_no='$this->next_of_kin_phone_no',
									  father_name='$this->father_name', 
                                      father_address='$this->father_address', father_phone_no='$this->father_phone_no',
                                      spouse_name='$this->spouse_name', no_of_children='$this->no_of_children',
                                      guardian_name ='$this->guardian_name', guardian_address='$this->guardian_address',
                                      admission_year='$this->admission_year', admission_type='$this->admission_type', subject_combo='$this->subject_combo',
                                      title='$this->title', date_of_entry='$this->date_of_entry', matriculation_no='$this->matriculation_no',
									   nationality='$this->nationality', jamb_score='$this->jamb_score',jamb_centre='$this->jamb_centre',
									  jamb_reg_no='$this->jamb_reg_no', email='$this->email', old_matriculation_no='$this->old_matriculation_no',
									  house='$this->house'									  
									  where student_id='$this->student_id'";

         // Execute the query
         if (! $db->Query($sql))
            $db->Kill();
         else
            return TRUE;

     }

    /*
     * This function is used to update screening status of a student
     *
     */
     function approveScreening($hod_dean_screening_approval_id)
     {
        $matric_no = $this->generateMatricNo();
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }

            $date_of_approval = date("Y-m-d, g:i a");
        //the update query to update the record of the department.
        $sql = "update ".STUDENT_TABLE." set hod_dean_screening_approval_id ='$hod_dean_screening_approval_id', matriculation_no= '$matric_no', hod_dean_screening_approval_timestamp ='$date_of_approval' where student_id = '$this->student_id'";

       //Execute the query
       if (! $db->Query($sql))
            $db->Kill();
       else
            return TRUE;

     }
		
     // update the password of student in db
	function changePassword( $pass )
     {
      
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }

        
        //the update query to update the record of the department.
        $sql = "update ".STUDENT_TABLE." set password ='$pass' where student_id = '$this->student_id'";
		
       //Execute the query
       if (! $db->Query($sql))
            $db->Kill();
       else
            return TRUE;

     }
	 
	 // change matric # of a student in db
	 function changeMatric( $matric )
     {
      
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }

        
        //the update query to update the record of the department.
        $sql = "update ".STUDENT_TABLE." set matriculation_no ='$matric' where student_id = '$this->student_id'";
		
       //Execute the query
       if (! $db->Query($sql))
            $db->Kill();
       else
            return TRUE;

     }
	 
	 
	 	 
	 function changeDepartment( $dept )
     {
      
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }

        
        //the update query to update the record of the department.
        $sql = "update ".STUDENT_TABLE." set department_id ='$dept' where student_id = '$this->student_id'";
		
       //Execute the query
       if (! $db->Query($sql))
            $db->Kill();
       else
            return TRUE;

     }
	 
	 
	 /*
	 *	changeAcademicSession
	 *
	 */
	 
	 function changeAcademicSession( $val = 0 )
     {
		if( !$val )
			$val = CURRENT_ACCADEMIC_SESSION;
		
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }

        
        //the update query to update the record of the department.
        $sql = "update ".STUDENT_TABLE." set academic_session = '".$val."' where student_id = '$this->student_id'";
		
		
		//Execute the query
		if (! $db->Query($sql))
            $db->Kill();
		else
            return TRUE;

     }
	 
	 /*
	 *	changeAcademicSemester - update semester of a student in db
	 *
	 */
	 
	 function changeSemester( $val = 0 )
     {
		if( !$val )
			$val = CURRENT_SEMESTER;
		
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }

        
        //the update query to update the record of the department.
        $sql = "update ".STUDENT_TABLE." set semester = '".$val."' where student_id = '$this->student_id'";
		
		
		//Execute the query
		if (! $db->Query($sql))
            $db->Kill();
		else
            return TRUE;

     }
	 
	 
	 // update the lock status of student clearance
	 function updateClearanceLock( $lock = 0, $comment = '', $by = '' )
     {
		
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) 
                $db->Kill();

        //the update query to update the record of the department.
        $sql = "update ".STUDENT_TABLE." set clearance_lock = '".$lock."', clearance_lock_comment = '".$comment."', clearance_lock_by = '".$by."' 
		where student_id = '$this->student_id'";
		
		//Execute the query
		if (! $db->Query($sql))
            $db->Kill();
		else
            return TRUE;

     }
	 
	 
		
	/*
     * allows hod approval of a student
     *
     */
     function changeApplicantHOD( $hod_id )
     {
       
        $db = new MySQL();
        if (! $db->Open()) {
                $db->Kill();
            }

        $date_of_approval = date("Y-m-d, g:i a");
        
        $sql = "update ".STUDENT_TABLE." set approving_hod_id ='$hod_id', hod_approval_timestamp ='$date_of_approval' where student_id = '$this->student_id'";

       //Execute the query
       if (! $db->Query($sql))
            $db->Kill();
       else
            return TRUE;

     }

     /*
      * change request status for registration
      *
      */

     function changeCourseRegistrationRequest( $req, $stamp = TRUE )
     {
        $db = new MySQL();
        if (! $db->Open()) {
                $db->Kill();
            }

        if( $stamp ) {
            //$date = date("Y-m-d, g:i a");
            $date = date("Y-m-d H:i:s");
			$sql = "update ".STUDENT_TABLE." set course_registration_request ='$req', course_registration_request_timestamp ='$date' where student_id = '$this->student_id'";
			//print_r( $sql );
        } else
             $sql = "update ".STUDENT_TABLE." set course_registration_request ='$req' where student_id = '$this->student_id'";

      

       if (! $db->Query($sql))
            $db->Kill();
       else
            return TRUE;


     }

	/*
     * change faculty approval status of an applicant
     *
     */
     function changeApplicantFaculty( $fac_id )
     {
       
        $db = new MySQL();
        if (! $db->Open()) {
                $db->Kill();
            }

        $date_of_approval = date("Y-m-d, g:i a");
        
        $sql = "update ".STUDENT_TABLE." set apply_faculty_approval_id ='$fac_id', apply_faculty_approval_timestamp ='$date_of_approval' where student_id = '$this->student_id'";

       //Execute the query
       if (! $db->Query($sql))
            $db->Kill();
       else
            return TRUE;

     }
		
		

    /*
     * Used to generate student matric number.
     */
	 
	 function generateMatricNo()
	 {
		
		// TODO: IF MATRIC IS ALREADY IN RIGHT FORMAT, DONT ALLOW UPDATE
		
		
		if( substr( $this->matriculation_no, 0, strlen(MATRIC_PREFIX) ) == MATRIC_PREFIX )
			return FALSE;
		
		if( !$this->department_id )
			return FALSE;
		
		$dept = new Department( $this->department_id );
		$dept->setDepartment();				
		
		$fac = new faculty( $dept->faculty_id );
		$fac->setFaculty();
		
		// serial number
		$q = 'select matriculation_no from '.STUDENT_TABLE." where matriculation_no like '%".MATRIC_PREFIX."%' ORDER BY matriculation_no DESC"; 
		$db = new MySQL();
		if (! $db->Open())	$db->Kill();
        if (! $db->Query( $q )) $db->Kill();    
		
		
		
		$rows = $db->recordsArray();
		$max = 0;
		$matric_store = array();
		
		foreach( $rows as $r ){
			
			// extract the first few digits
			$mystr = substr( $r[matriculation_no], 12 );
			
			$matric_nos[] = (int)$mystr;
			$max = (int)$mystr > $max ? (int)$mystr : $max;
					
		}
		
		sort( $matric_nos );
		$arr2 = range( $matric_nos[0] , max( $matric_nos ) ); 
		$missing_nos = array_diff( $arr2, $matric_nos );
		
		if( empty( $missing_nos )  )
			$serial = $max + 1;
		else 
			$serial = reset( $missing_nos ); 
		
		$find = array( '%prefix%', '%faculty%',  '%matricyear%', '%serial%' );
		$replace = array( MATRIC_PREFIX, $fac->faculty_code, MATRIC_YEAR, $serial  );	
		$matric = str_replace( $find, $replace, MATRIC_FORMAT );
		
		
		return ( $matric );
			
	 }
	 
	 // generate application no of a student
	  function generateApplicationNo()
	 {
		
		// serial number
		$q = 'select matriculation_no from '.STUDENT_TABLE." where matriculation_no like '".CURRENT_ACCADEMIC_SESSION."/app%' ORDER BY matriculation_no ASC"; 
		//print_r( $q );
		$db = new MySQL();
		if (! $db->Open())	$db->Kill();
        if (! $db->Query( $q )) $db->Kill();    
		
		$rows = $db->recordsArray();
		$max = 0;
		$store = array();
		
		
		foreach( $rows as $r ){
			// extract the first few digits
			$mystr = substr( $r[matriculation_no], -6 );
			
			$store[] = (int)$mystr;
			$max = (int)$mystr > $max ? (int)$mystr : $max;
					
		}
		
		sort( $store );
		$arr2 = range( $store[0] , max( $store ) ); 
		$missing_nos = array_diff( $arr2, $store );
		
		if( empty( $missing_nos ) || empty( $rows ) )
			$serial = $max + 1;
		else 
			$serial = reset( $missing_nos ); 
		
		
		$str_serial = str_pad( $serial, 6, "0", STR_PAD_LEFT );
		
		$matric = CURRENT_ACCADEMIC_SESSION . "/app/" . $str_serial ;
		
		return ( $matric );
			
	 }
	 
	 
	 

    /*
     * Used To delete student record from the database
     *@return Boolean, returns true/false depending on the success of the function
     */
     function deleteStudent()
     {
        $db = new MySQL();
         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }

        //the delete query to delete the record of the student.
        $sql = "DELETE from ".STUDENT_TABLE." where student_id = '$this->student_id'";
          //$sql = "UPDATE ".STUDENT_TABLE." set deleted=1 where student_id = '$this->student_id'";

         // Execute the query
         if (! $db->Query($sql))
            $db->Kill();
         else
            return TRUE;

     }


     /*
      *    expungeStudentCourse: delete all courses in a particluar session or semester a
      *    a student has registered for. while setting his registration status to 0
      *
      *     @param string session
      *     @param string semester
      *
      *     return boolean true if expunged from db false if not.
      *
      */
     function expungeStudentCourses( $session = CURRENT_ACCADEMIC_SESSION, $semester = FALSE )
     {
        
        $db = new MySQL();

        //open the database
        if (! $db->Open()) {
            $db->Kill();
        }
         
        $sql = "DELETE from ".STUDENT_COURSE_TABLE." where student_id = '$this->student_id' ";

         // if semester is false, delete all
         if( $semester )
            $sql .= " AND semester='".$semester."' ";

         // if session is false, delete all course details
         if( $session )
            $sql .= " AND session='".$session."' ";
		
		
		
		//print_r( $sql );
            
        // also change application status to 0
        if( $this->changeRegistrationStatus( 0 ) && $db->Query( $sql ) )
            return TRUE;
        else
            return TRUE;

     }
	
     // checks if a particular student is registered on a course
     function checkRegisteredOnCourse( $course_id, $session, $semester = FALSE )
     {
		$db = new MySQL();

        //open the database
        if (! $db->Open()) {
            $db->Kill();
        }
     	
        $sql = "SELECT * from ".STUDENT_COURSE_TABLE." where student_id = '$this->student_id' and 
        		course_id = '$course_id' AND session='".$session."' ";
	    
		if( $semester )
            $sql .= " AND semester='".$semester."' ";
		
        if (! $db->Query($sql)) $db->Kill();
		$row = $db->RowArray();
		
		return $row;
	 	
      }

     
    /*
     * Used To get student record from the database and mutate the student Obj
     * @param student_id the id of the student's whose record is needed
     */
   function getStudent()
    {
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }
            
        $sql= "SELECT * from ".STUDENT_TABLE." where student_id ='$this->student_id'";
        // Execute the query
        if (! $db->Query($sql)) $db->Kill();

            $row =$db->RowArray();
        
        $dept = new Department( $row['department_id'] );
        $dept->setDepartment();

      //hod_course_approval_id
        // Set the current object to returned values from the database.
        $this->Student( $this->student_id, $row['firstname'], $row['surname'], $row['othernames'], 
					$row['email'], $row['postal_address'],$row['residential_address'], $row['phone_no'], $row['dob'],
                   $row['place_of_birth'], $row['state_of_origin'], $row['lga'], $row['marital_status'], $row['nationality'],
					$row['maiden_name'], $row['next_of_kin_name'], $row['next_of_kin_relationship'],
                    $row['next_of_kin_address'], $row['next_of_kin_pob'], $row['next_of_kin_phone_no'], $row['father_name'],
                    $row['father_occupation'], $row['father_address'], 
			$row['father_phone_no'], $row['mother_name'], $row['mother_occupation'], 
			$row['mother_address'], $row['mother_phone_no'], $row['sponsor_name'], $row['sponsor_email'],
                        $row['sponsor_occupation'], $row['sponsor_address'], $row['sponsor_phone_no'], $row['program_applied_for'],
			$row['ipaddress'], $row['application_timestamp'], $row['photo'], '', $row['department_id'],
			$row['birth_certificate'], $row['credentials'],$row['password'], "", $row['subject_combo'], "", "",
                        $row['title'], $row['date_of_entry'], $row['matriculation_no'],  $row['sex'],
                        $row['home_town'],
                        $row['spouse_name'], $row['no_of_children'], $row['guardian_name'], $row['guardian_address'],
                	$row['admission_year'], $row['admission_type'], $dept->faculty_id, $row['approving_admission_unit_id'],
                        $row['approving_faculty_member_id'], $row['approving_school_officer_id'],
                        $row['approving_student_affair_officer_id'], $row['hod_course_approval_id'], $row['dean_course_approval_id'],
                        $row['approving_hod_id'], $row['apply_faculty_approval_id'], $row['approving_admission_unit_timestamp'],
                        $row['approving_hod_timestamp'], $row['apply_faculty_approval_timestamp'], $row['major'], $row['secondary_department_id']
                         
            );

        $this->setCourseRegistrationRequest( $row['course_registration_request'] );
		$this->setAcademic_session( $row['academic_session'] );
		$this->setSemester( $row['semester'] );
		$this->setJambRegNo( $row['jamb_reg_no'] );
		
		$this->setJambNo( $row['jamb_reg_no'] );
		$this->setJambScore( $row['jamb_score']  );		
        $this->setJambCentre( $row['jamb_centre'] );
		
		$this->setOld_matriculation_no( $row['old_matriculation_no'] ); 
		
		$this->setLevelId( $row['level_id'] );
		$this->setClass( $row['class'] );
		$this->setHouse( $row['house'] );
		
		$this->setClearanceLock( $row['clearance_lock'] );
	    return $row;
     }

     // get a student name and print in a certain format
     function printStudentName()
     {
        $db = new MySQL();
        if (! $db->Open()) {
                $db->Kill();
            }
            
         $sql= "SELECT firstname, surname from ".STUDENT_TABLE." where student_id ='$this->student_id'";
         

         if ( !$db->Query( $sql ) ) $db->Kill();
         
         $row =$db->RowArray();
         if( empty( $row ) )
            $name ='';
         else {
             $name = ucfirst( $row['firstname'] ) . ' ' . ucfirst( $row['surname'] );
         }


         return $name;
     }


    /*
     * Used To get institutions attended record from the database
     *
     */
   function getInstitututionsAttended()
    {
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }


        $sql= "SELECT * from ".INSTITUTION_ATTENDED_TABLE." where student_id ='$this->student_id'";
       
        // Execute the query
        if (! $db->Query($sql)) $db->Kill();

            $row =$db->RecordsArray();
            $this->institutions = $row;

          
        return $row;
     }


   /*
    * Used To get details of students olevel exams
    * @param student_id the id of the student whose exams details are needed
    */
   function getOlevelExams()
    {
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }

        $sql= "SELECT * from ".OLEVEL_EXAM_TABLE." where student_id ='$this->student_id'";

       
        // Execute the query
        if (! $db->Query($sql)) $db->Kill();
		
		$row =$db->RecordsArray();
		$db->Close();
		
        $i = 0;
        if(empty($row))
        return;
		$this->exams = $row;
          
		return $row;
     }

	// get the olevel exam result with a particular id
     function getExamResult( $exam_id )
     {
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }

         $sql= "SELECT * from ".OLEVEL_RESULT_TABLE." where exam_id ='$exam_id'";

       
         // Execute the query
         if (! $db->Query($sql)) $db->Kill();
         $row = $db->RecordsArray();

         
         return $row;
         //if(empty($row))
         //  return;
         //array_push( $this->exams[$i][result][], $row );
         //$i++;
     }

        /*
         * Store student change of department request in db
         * @param int $new_department_id -id of the new department
         * @param string $reason the -reason for change if department
         */
        function requestDepartmentChange($new_department_id, $reason)
        {
            //establish a db connection
            $db = new MySQL();

             //open the database
            if (! $db->Open()) {
                    $db->Kill();
                }
                
            $sql = "INSERT into ".CHANGE_OF_DEPARTMENT_TABLE."(student_id, old_department_id, new_department_id, reason_for_change)
                                values('$this->student_id', '$this->department_id', '$new_department_id', '$reason')";
            if (! $db->Query($sql))
                $db->Kill();
            else{

                return TRUE;
                
                }

        }


   /*
    * Retrieves student's request for department change
    */
   function getDepartmentChange()
     {
        //establish a db connection
        $db = new MySQL();

         //open the database
        if (! $db->Open()) {
                $db->Kill();
            }

         $sql= "SELECT * from ".CHANGE_OF_DEPARTMENT_TABLE." where student_id ='$this->student_id' AND approver_id = 0";

         // Execute the query
         if (! $db->Query($sql)) $db->Kill();
         $row = $db->RowArray();

         if( empty( $row ) )
            return FALSE;
            
         return $row;
     }

    /*
     * Allows user to approve and change students department
     * @param $user_id, the user id of the officer to approve the department change.
     * @param $approver_ipaddress the IPaddress of the school officer to approve the department change.
     * @return bolean returns true or false depending on the execution of the function
     *
     */
    function approveDepartmentChange($user_id, $approver_ipaddress)
    {   
        
		$depart = $this->getDepartmentChange();
        	
		$db = new MySQL();
         //open the database
        if (!$db->Open()) {
            $db->Kill();
        }

         
        $date_of_approval = date("Y-m-d, g:i a");
        $sql = "update ".CHANGE_OF_DEPARTMENT_TABLE." set approver_id ='$user_id', approver_ipaddress='$approver_ipaddress', approval_date='$date_of_approval' where student_id= '$this->student_id'";
		
        // Execute the query
        if (!$db->Query($sql))
            $db->Kill();
        else {
            
			
            $sql = "update ".STUDENT_TABLE." set department_id ='$depart[new_department_id]' where student_id= '$this->student_id'";
			
			$db->Close();
			$db2 = new MySQL();
            if (!$db2->Open()) {
                $db2->Kill();
            }
            if (!$db2->Query($sql))
                $db2->Kill();
            else {
                return TRUE;
            }

        }
    }

    /*
     * change picture filename in db for student
     */
       function changePicture()
       {

        $db = new MySQL();
        
        //open the database
        if (!$db->Open()) {
            $db->Kill();
        }else{
                $sql = "update ".STUDENT_TABLE." set photo ='$this->photo' where student_id= '$this->student_id'";
               // Execute the query
                if (!$db->Query($sql))
                     $db->Kill();
                else
                    return true;
            }
       }

	 // change birthcertificate filename for student  
	function changeBirthCert( $bc )
       {

        $db = new MySQL();
        
        //open the database
        if (!$db->Open()) {
            $db->Kill();
        }else{
                $sql = "update ".STUDENT_TABLE." set birth_certificate ='$bc' where student_id= '$this->student_id'";
               // Execute the query
                if (!$db->Query($sql))
                     $db->Kill();
                else
                    return true;
            }
       }	
	
	
     /*
      *  add credentials filenames of student
      *
	  */
	  
       function addCredential( $cred )
       {

        // explode credential into an array
        $credential = explode( ',', $this->credentials );
        $credential[] = $cred;

        $this->credentials = implode( ',', $credential );

        $db = new MySQL();

        //open the database
        if (!$db->Open()) {
            $db->Kill();
        }else{
                $sql = "update ".STUDENT_TABLE." set credentials ='$this->credentials' where student_id= '$this->student_id'";
               // Execute the query
                if (!$db->Query($sql))
                     $db->Kill();
                else
                    return true;
            }
       }



     /*
     *  validates an application form and ensures the form has been filled right
     *
     *   @param - none
     *   @return - errors
     *
     */
     function validateStudent()
     {
		if( !isset( $this->firstname ) || trim( $this->firstname == '' ) )
			$error[firstname] = 'Enter your first name';
                elseif(!is_string($this->firstname))
                        $error[firstname] = 'Your must enter only alphabets, no numbers or symbols';
                
		if( !isset( $this->surname ) || trim( $this->surname == '' ) ){
			$error[surname] = 'Enter your surname';
                }elseif(!is_string($this->surname)){
                        $error[surname] = 'Your must enter only alphabets, no numbers or symbols';
                }
			
		if( !isset( $this->postal_address ) || trim( $this->postal_address == '' ) )
			$error[postal_address] = 'Enter your postal address';

        
        if( !isset( $this->sex ) || trim( $this->sex == '' ) )
			$error[sex] = 'Enter your sex/gender';
				
			 	
			if ( $_GET['applicant'] != '1' &&  !$_REQUEST['jamb_reg_no'] )
            {
                if( !isset( $this->matriculation_no ) || trim( $this->matriculation_no == '' ) )
					$error[matriculation_no] = 'Enter your matriculation number.';
            
                // check if matric number already exists in the database.
                if( $this->checkMatricExist() )
                    $error[matriculation_no] = 'Matriculation number already in database. Verify matric number is correct or try <a href="'.COE_URL.'index.php?userName='.$this->matriculation_no.'">login in</a>.';
			
			
                if( !isset( $this->date_of_entry ) || trim( $this->date_of_entry ) == ''  )
					$error[date_of_entry] = 'Enter your date of entry.';
			}
			
		if( !isset( $this->phone_no ) || trim( $this->phone_no == '' ) ){
			$error[phone_no] = 'Enter your phone number';
                }
                        /*
                        *
                        * elseif(!valid_phone($this->phone_no))
                            $error[phone_no] = 'Enter a valid phone number';*/

                $dob = invalid_date($this->dob);
                if( $dob )
                    $error[dob] = $dob;

		if( !isset( $this->nationality ) || trim( $this->nationality == '' ) )
			$error[nationality] = 'Enter your nationality';	
		
		
		if( !isset( $this->lga ) || trim( $this->lga == '' ) )
			$error[lga] = 'Choose your Local government area';

     	if( !isset( $this->state_of_origin ) || trim( $this->state_of_origin == '' ) )
			$error[state_of_origin] = 'Choose your state of origin';

		       
		if( !isset( $this->father_name ) || trim( $this->father_name == '' ) )
			$error[father_name] = 'Enter a name here';

		if( !isset( $this->father_address ) || trim( $this->father_address == '' ) )
			$error[father_address] = 'Enter an address here';

		
        if( !isset( $this->father_phone_no ) || trim( $this->father_phone_no == '' ) )
			$error[father_phone_no] = 'Enter a phone number';
        elseif(!valid_phone($this->father_phone_no))
			$error[father_phone_no] = 'Enter a valid phone number';


	

		if( !isset( $this->program_applied_for ) )
			$error['program_applied_for'] = 'Select a program applied for';
			
		if( !isset( $this->declaration ) || $this->declaration != 'Agree' )
			$error['declaration'] = 'You must agree to the declaration above';

                if( !isset( $_REQUEST['jamb_reg_no'] ) ){

                }
		
		// check teller
		$sc = new scratchCard();
		$sc->setTeller( $_POST['teller'] );
	
        if( !isset( $this->department_id ) || trim( $this->department_id == '' ) )
			$error[department_id] = 'Choose your department';
	

		if( trim( $this->email ) == '' || ( !emailValid( $this->email ) ) )
			$error[email] = 'You must enter a valid email address.';
		
		return $error;
		
	 }

    /*
     *  validates an bio data form and returns errors found in form
     *  @param - none
     *  @return - errors
     *
     */
     function validateBioData()
     {
		if( !isset( $this->firstname ) || trim( $this->firstname == '' ) )
			$error[firstname] = 'Enter your first name';

		if( !isset( $this->surname ) || trim( $this->surname == '' ) )
			$error[surname] = 'Enter your surname';

		if( !isset( $this->postal_address ) || trim( $this->postal_address == '' ) )
			$error[postal_address] = 'Enter your postal address';

                //$error[dob] = invalid_date($this->dob);
                $dob = invalid_date($this->dob);
                if( $dob )
                    $error[dob] = $dob;

         if( !isset( $this->state_of_origin ) || trim( $this->state_of_origin == '' ) )
			$error[state_of_origin] = 'Choose your state of origin';

		if( !isset( $this->lga ) || trim( $this->lga == '' ) )
			$error[lga] = 'Choose your Local government area';	

			
		if( !isset( $this->matriculation_no ) || trim( $this->matriculation_no == '' ) ){
			$error[matriculation_no] = 'Enter your matriculation number.';
        }

                // check if matric number already exists in the database.
       	if( $this->checkMatricExist() )
        	$error[matriculation_no] = 'Matriculation number already in database. Verify matric number is correct or try <a href="'.COE_URL.'index.php?userName='.$this->matriculation_no.'">login in</a>.';
		
			/*
		if( isset( $this->matriculation_no ) && $this->checkOldMatricExist() )	
			$error[old_matriculation_no] = 'Matriculation number already in database. Verify old matric number is correct';
			*/
			
        if( !isset( $this->phone_no ) || trim( $this->phone_no == '' ) ){
			$error[phone_no] = 'Enter your phone number';

        } elseif(!valid_phone($this->phone_no))
                            $error[phone_no] = 'Enter a valid phone number';
            
		if( trim( $this->email ) == '' || ( !emailValid( $this->email ) ) )
			$error[email] = 'You must enter a valid email address.';
		
		
		return $error;

	 }

	 /* 
	  * generates the student Bio Data Form.
	  * 	
	  * @param action 	- file that processes the form
	  * @param error	- error generated from a submitted form after validation
	  * @returns html code of form. 	
      */
	function bioDataForm ($action, $error = array())
	{
                        $out = "\n".'<div class="long_box floatleft"><div class="heading"> Student Personal Data Form </div>
					<br/>
					<form action="'.$action.'" method="POST">
							<table class="stdTable" cellpadding="0" cellspacing="0" border="0">';
					
					
					if( AUTO_MATRICULATION && $this->generateMatricNo() )
						$error['matriculation_no'] .= ' Next matriculation no: '. $this->generateMatricNo() . ' app ' . $this->generateApplicationNo();
					
					
                    $out .= "\n".createTwoColFormLabelInput( MATRIC_NUMBER_LABEL, $this->matriculation_no, 'matriculation_no', 1, $error['matriculation_no']  );
					global $student_house;
					$out .= "\n".createTwoColFormLabelSelect( HOUSE_LABEL, $this->house, 'house', $student_house, "", 1, $error['house'] );
					
						
				
				    $out .= "\n".createTwoColFormLabelInput( SURNAME_LABEL, $this->surname, 'surname', 1, $error['surname']  );
                    $out .= "\n".createTwoColFormLabelInput( FIRST_NAME_LABEL, $this->firstname, 'firstname', 1, $error['firstname']  );
                    $out .= "\n".createTwoColFormLabelInput( OTHER_NAME_LABEL, $this->othernames, 'othernames', 0, $error['othernames']  );

                    $array_sex_status[0]['name'] = $array_sex_status[0]['value'] = 'Female';
                    $array_sex_status[1]['name'] = $array_sex_status[1]['value'] = 'Male';

                    $out .= "\n".createTwoColFormLabelSelect( SEX_LABEL, $this->sex, 'sex', $array_sex_status, "", 1, $error['sex'] );

                    $out .= "\n".createTwoColFormLabelInput( DOB_LABEL.'<br/><span class="note">DD/MM/YYYY</span>', $this->dob, 'dob', 1, $error['dob']  );
                    $out .= "\n".createTwoColFormLabelInput( NATIONALITY_LABEL, $this->nationality, 'nationality', 0, $error['nationality']  );
					
                    
                    // state of origin
		            global $nigerian_states;
		            $i = 0;
		            foreach( $nigerian_states as $na ){
		                $array_state[$i]['value'] = $na;
		                $array_state[$i]['name'] = $na;
		                $i++;
		            }

	        		$out .= "\n".createTwoColFormLabelSelect( STATE_OF_ORIGIN_LABEL, $this->state_of_origin, 'state_of_origin', $array_state, "", 1, $error['state_of_origin'] );

					
		           //L.G.As in nigeria
	                global $lgas;
		            $i = 0;
		            foreach( $lgas as $lg ){
		                $array_lga[$i]['value'] = $lg;
		                $array_lga[$i]['name'] = $lg;
		                $i++;
		            }

	        		$out .= "\n".createTwoColFormLabelSelect( LGA_LABEL, $this->lga, 'lga', $array_lga, "", 1, $error['lga'] );
                    
                    $out .= "\n".createTwoColFormLabelInput( 'Current '.POSTAL_ADDRESS_LABEL, $this->postal_address, 'postal_address', 1, $error['postal_address']  );
                    $out .= "\n".createTwoColFormLabelInput( PHONE_NO_LABEL, $this->phone_no, 'phone_no', 1, $error['phone_no']  );
                    $out .= "\n".createTwoColFormLabelInput( EMAIL_ADDRESS_LABEL, $this->email, 'email', 0, $error['email']  );
				 
					$out .= "\n".createTwoColFormLabelInput( FATHER_NAME_LABEL, $this->father_name, 'father_name', 1, $error['father_name']  );
					$out .= "\n".createTwoColFormLabelInput( FATHER_ADDRESS_LABEL, $this->father_address, 'father_address', 1, $error['father_address']  );
					$out .= "\n".createTwoColFormLabelInput( FATHER_PHONE_NO_LABEL, $this->father_phone_no, 'father_phone_no', 1, $error['father_phone_no']  );

                   
                    
                    if( isset( $_REQUEST['student_id'] ) )
                        $out .= '<input type="hidden" name="student_id" value="'.$_REQUEST['student_id'].'" />';

                    $out .= '<tr>
                            <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="update" class="stdButton" value="Update My Info"> </th>
			</tr>	
			</table>
				
			</form>
                        </div>';
            return $out;
		
	}
     
     
	 /* 
	  *generates the student application Form.
	  * 	
	  * @param action 	- file that processes the form
	  * @param error	- error generated from a submitted form after validation
	  * @returns html code of form. 	
      */
     function applicationForm( $action, $error = array(), $errorExamForm =array() )
     {
        
		if( APPLICATION_CLOSED )
			return FALSE;
		
		$form_heading = APPLICATION_HEADING;
		if ( $_GET['applicant'] != '1' ) {
			if( isset($_REQUEST['jamb_reg_no'])  )
				$form_heading = 'Jamb Registration Form';
			else 
				$form_heading = 'Student Enrolment Form';	
		}
		
		// TODO HTML FORM FIX
		$out = "\n".'<div class="heading"> '.$form_heading.' </div>
					<div class="long_box floatleft">
						<form action="'.$action.'" method="POST">
							<table class="stdTable" cellpadding="0" cellspacing="0" border="0">';
			
		$disabled="";
        if( isset($_REQUEST['jamb_reg_no']) ){
			$disabled = 'readonly="readonly"'; // TODO: LOCK THIS FIELD IF JAMB STUDENT.
			$sel_disabled = 'disabled="disabled"';
        } else
			$disabled = "";
			
			
		$out .= "\n".'<tr>
									<th colspan="2" class="tbTitle"> '.GENERAL_INFO_TITLE.' </th>
								</tr>';




                $array_title[0]['name'] = $array_title[0]['value'] = 'Mr';
                $array_title[1]['name'] = $array_title[1]['value'] = 'Mrs';
                $array_title[2]['name'] = $array_title[2]['value'] = 'Miss';
                $array_title[3]['name'] = $array_title[3]['value'] = 'Rev';
                $array_title[4]['name'] = $array_title[4]['value'] = 'Dr';
				$array_title[5]['name'] = $array_title[5]['value'] = 'Ms';


		//$out .= "\n".createTwoColFormLabelSelect( TITLE_STATUS_LABEL, $this->title, 'title', $array_title, "", 1, $error['title'] );

		$out .= "\n".createTwoColFormLabelInput( SURNAME_LABEL, $this->surname, 'surname', 1, $error['surname'], "inputTxt extendedInputTxt", $disabled  );
		$out .= "\n".createTwoColFormLabelInput( FIRST_NAME_LABEL, $this->firstname, 'firstname', 1, $error['firstname'], "inputTxt extendedInputTxt", $disabled  );
		$out .= "\n".createTwoColFormLabelInput( OTHER_NAME_LABEL, $this->othernames, 'othernames', 0, $error['othernames']  );

                $array_sex_status[0]['name'] = $array_sex_status[0]['value'] = 'Female';
                $array_sex_status[1]['name'] = $array_sex_status[1]['value'] = 'Male';

                $out .= "\n".createTwoColFormLabelSelect( SEX_LABEL, $this->sex, 'sex', $array_sex_status, "", 1, $error['sex'] );


                $out .= "\n".createTwoColFormLabelInput( POSTAL_ADDRESS_LABEL, $this->postal_address, 'postal_address', 1, $error['postal_address']  );
		$out .= "\n".createTwoColFormLabelInput( PHONE_NO_LABEL, $this->phone_no, 'phone_no', 1, $error['phone_no']  );

		if ( $_GET['applicant'] != '1' ) {
             
			if( isset($_REQUEST['jamb_reg_no'] )  ){
				$out .= "\n".'<tr><td class="formLabel">'.MATRIC_NUMBER_LABEL.'</td><td class="formBox">'.$this->matriculation_no.'
							<input type="hidden" value="'.$this->matriculation_no.'" name="matriculation_no" />
							</td></tr>';	
			} else {
				$out .= '<tr>
                            <th colspan="2" class="tbTitle"> '.MATRICULATION_TITLE.' </th>
					</tr>';
                $out .= "\n".createTwoColFormLabelInput( MATRIC_NUMBER_LABEL, $this->matriculation_no, 'matriculation_no', 1, $error['matriculation_no'] , "inputTxt extendedInputTxt", $disabled   );
				//$out .= "\n".createTwoColFormLabelInput( 'Jamb No', $_REQUEST['jamb_no'], 'jamb_no', 1, $error['jamb_no'] , "inputTxt extendedInputTxt", $disabled   );
			
			
			}	
		
		}
		
		//$out .= "\n".createTwoColFormLabelInput( 'Jamb Number', $this->jamb_reg_no, 'jamb_reg_no', 1, $error['jamb_reg_no'] , "inputTxt extendedInputTxt", $disabled   );

		//jamb_reg_no
		
		$out .= '<tr>
                            <th colspan="2" class="tbTitle"> '.PERSONAL_INFO_TITLE.' </th>
			</tr>';
		
		$out .= "\n".createTwoColFormLabelInput( DOB_LABEL.'<br/><span class="note">DD/MM/YYYY</span>', $this->dob, 'dob', 1, $error['dob']  );
		  $out .= "\n".createTwoColFormLabelInput( NATIONALITY_LABEL, $this->nationality, 'nationality', 1, $error['nationality']  );
        
		 global $nigerian_states;
	            $i = 0;
	            foreach( $nigerian_states as $na ){
	                $array_state[$i]['value'] = $na;
	                $array_state[$i]['name'] = $na;
	                $i++;
	            }

	        //$out .= "\n".createTwoColFormLabelSelect( STATE_OF_ORIGIN_LABEL, $this->state_of_origin, 'state_of_origin', $array_state, "", 1, $error['state_of_origin'] );
			 $out .= "\n".createTwoColFormLabelSelect( STATE_OF_ORIGIN_LABEL, $this->state_of_origin, 'state_of_origin', $array_state, "", 1, $error['state_of_origin'], "onchange=\"stateChange(this);\"" );

	           //L.G.As in nigeria
                   global $lgas;
	            $i = 0;
				
				$array_lga[0]['value'] = '0';
	            $array_lga[0]['name'] = 'Select LG';
				
				if( $this->lga ){
					$array_lga[1]['value'] = $this->lga;
					$array_lga[1]['name'] = $this->lga;
				}

				$out .= "\n".createTwoColFormLabelSelect( LGA_LABEL, $this->lga, 'lga', $array_lga, "", 1, $error['lga'], "id=\"lga\"" );
		
                //$out .= "\n".createTwoColFormLabelInput( ATTESTANT_EMAIL_LABEL, $this->lga, 'lga', 0, $error['lga']  );

                $array_marital_status[0]['name'] = $array_marital_status[0]['value'] = 'Single';
		$array_marital_status[1]['name'] = $array_marital_status[1]['value'] = 'Married';
                $array_marital_status[2]['name'] = $array_marital_status[2]['value'] = 'Widowed';
                $array_marital_status[3]['name'] = $array_marital_status[3]['value'] = 'Divorced';
		
				//$out .= "\n".createTwoColFormLabelSelect( MARITAL_STATUS_LABEL, $this->marital_status, 'marital_status', $array_marital_status, "", 1, $error['marital_status'] );
                //$out .= "\n".createTwoColFormLabelInput( MAIDEN_NAME_LABEL, $this->maiden_name, 'maiden_name', 0, $error['maiden_name']  );
				/*
                $out .= '<tr>
                            <th colspan="2" class="tbTitle"> '.NEXT_OF_KIN_DETAILS_TITLE.' </th>
			</tr>';
             

			 $out .= "\n".createTwoColFormLabelInput( NEXT_OF_KIN_NAME_LABEL, $this->next_of_kin_name, 'next_of_kin_name', 1, $error['next_of_kin_name']  );
                $out .= "\n".createTwoColFormLabelInput( NEXT_OF_KIN_RELATIONSHIP_LABEL, $this->next_of_kin_relationship, 'next_of_kin_relationship', 0, $error['next_of_kin_relationship']  );
                $out .= "\n".createTwoColFormLabelInput( NEXT_OF_KIN_ADDRESS_LABEL, $this->next_of_kin_address, 'next_of_kin_address', 1, $error['next_of_kin_address']  );
                $out .= "\n".createTwoColFormLabelInput( NEXT_OF_KIN_POB_LABEL, $this->next_of_kin_pob, 'next_of_kin_pob', 0, $error['next_of_kin_pob']  );
                $out .= "\n".createTwoColFormLabelInput( NEXT_OF_KIN_PHONE_NO_LABEL, $this->next_of_kin_phone_no, 'next_of_kin_phone_no', 1, $error['next_of_kin_phone_no']  );
            
				*/
				
				
				$out .= '<tr>
                            <th colspan="2" class="tbTitle"> '.PARENTS_DETAILS_TITLE.' </th>
				</tr>';
               
                $out .= "\n".createTwoColFormLabelInput( FATHER_NAME_LABEL, $this->father_name, 'father_name', 1, $error['father_name']  );
                //$out .= "\n".createTwoColFormLabelInput( FATHER_OCCUPATION_LABEL, $this->father_occupation, 'father_occupation', 0, $error['father_occupation']  );
                $out .= "\n".createTwoColFormLabelInput( FATHER_ADDRESS_LABEL, $this->father_address, 'father_address', 1, $error['father_address']  );
                $out .= "\n".createTwoColFormLabelInput( FATHER_PHONE_NO_LABEL, $this->father_phone_no, 'father_phone_no', 1, $error['father_phone_no']  );

				
			/*
			if ( $_GET['applicant']!='1' ) {	
               $out .= "\n".createTwoColFormLabelInput( MOTHER_NAME_LABEL, $this->mother_name, 'mother_name', 0, $error['mother_name']  );
                $out .= "\n".createTwoColFormLabelInput( MOTHER_OCCUPATION_LABEL, $this->mother_occupation, 'mother_occupation', 0, $error['mother_occupation']  );
                $out .= "\n".createTwoColFormLabelInput( MOTHER_ADDRESS_LABEL, $this->mother_address, 'mother_address', 0, $error['mother_address']  );
                $out .= "\n".createTwoColFormLabelInput( MOTHER_PHONE_NO_LABEL, $this->mother_phone_no, 'mother_phone_no', 0, $error['mother_phone_no']  );
 
               
				
                $out .= "\n".createTwoColFormLabelInput( SPONSOR_NAME_LABEL, $this->sponsor_name, 'sponsor_name', 1, $error['sponsor_name']  );
                $out .= "\n".createTwoColFormLabelInput( SPONSOR_EMAIL_LABEL, $this->sponsor_occupation, 'sponsor_email', 0, $error['sponsor_email']  );
                $out .= "\n".createTwoColFormLabelInput( SPONSOR_OCCUPATION_LABEL, $this->sponsor_occupation, 'sponsor_occupation', 1, $error['sponsor_occupation']  );
                $out .= "\n".createTwoColFormLabelInput( SPONSOR_ADDRESS_LABEL, $this->sponsor_address, 'sponsor_address', 1, $error['sponsor_address']  );
                $out .= "\n".createTwoColFormLabelInput( SPONSOR_PHONE_NO_LABEL, $this->sponsor_phone_no, 'sponsor_phone_no', 1, $error['sponsor_phone_no']  );
			} */
				/*
				 $out .= '<tr>
                            <th colspan="2" class="tbTitle"> '.SPONSOR_DETAILS_TITLE.' </th>
				</tr>';
				$out .= "\n".createTwoColFormLabelInput( SPONSOR_NAME_LABEL, $this->sponsor_name, 'sponsor_name', 1, $error['sponsor_name']  );
                $out .= "\n".createTwoColFormLabelInput( SPONSOR_EMAIL_LABEL, $this->sponsor_email, 'sponsor_email', 0, $error['sponsor_email']  );
                $out .= "\n".createTwoColFormLabelInput( SPONSOR_OCCUPATION_LABEL, $this->sponsor_occupation, 'sponsor_occupation', 0, $error['sponsor_occupation']  );
                $out .= "\n".createTwoColFormLabelInput( SPONSOR_ADDRESS_LABEL, $this->sponsor_address, 'sponsor_address', 1, $error['sponsor_address']  );
                $out .= "\n".createTwoColFormLabelInput( SPONSOR_PHONE_NO_LABEL, $this->sponsor_phone_no, 'sponsor_phone_no', 1, $error['sponsor_phone_no']  );
				
				*/
				
                $out .= '<tr>
                            <th colspan="2" class="tbTitle"> '.EMAIL_INFO_TITLE.' </th>
			</tr>';

                //print_r( $this );
                $out .= "\n".createTwoColFormLabelInput( EMAIL_ADDRESS_LABEL, $this->email, 'email', 1, $error['email']  );
                //$out .= "\n".createTwoColFormLabelPasswordInput( PASSWORD_LABEL, $this->password, 'password', 1, $error['password']  );
                //$out .= "\n".createTwoColFormLabelPasswordInput( RETYPE_PASSWORD_LABEL, $this->password2, 'password2', 1, $error['password']  );

                /*
                $out .='<tr>
                            <th colspan="2" class="tbTitle"> '.INSTITUTIONS_INFO_TITLE.' </th>
                        </tr>';

                $out .="\n".$this->institutionAttendedForm( $error['institution'] );
				*/
				
                //$exams = new OlevelExam();
                //$exam_errors = $error['exam'];
                // $out .="\n".$this->olevelExamForm( $errorExamForm, $error['result'] );
          
		/*	
        $out .= '<tr>
                            <th colspan="2" class="tbTitle"> Other Examinations (e.g. JAMB) </th>
			</tr>';
				$out .= "\n".createTwoColFormLabelInput( 'JAMB Registration number', $this->jamb_no, 'jamb_no', 1, $error['jamb_no']  );			
				$out .= "\n".createTwoColFormLabelInput( 'JAMB Centre', $this->jamb_centre, 'jamb_centre', 1, $error['jamb_centre']  );
				$out .= "\n".createTwoColFormLabelInput( 'JAMB Score', $this->jamb_score, 'jamb_score', 1, $error['jamb_score']  );        
        */ 
			
		$out .='<tr>
                            <th colspan="2" class="tbTitle"> '.PROGRAMME_INFO_TITLE.' <span class="required">*</span> <span class="note">Select as applicable</span></th>
			</tr> ';
                 
								
        global $array_programme;
		$array_declaration[0][value] = DECLARATION_AGREE_LABEL;	$array_declaration[1][value] =DECLARATION_REJECT_LABEL;
		
		/*$prog[0]['name'] = "Jamb Entry"; $prog[0]['value'] = "Year 1";
		$prog[1]['name'] = "Direct Entry"; $prog[1]['value'] = "Year 2";
		$prog[2]['name'] = "Pre Degree"; $prog[2]['value'] = "Pre Degree";*/
		
		
		if ( $_GET['applicant'] != '1' )	
			//$out .="\n".createTwoColFormLabelRadio( 'Programme', $this->program_applied_for , $array_programme, $error['program_applied_for'], "");
			$out .= "\n".createTwoColFormLabelSelect( 'Current Level', $this->program_applied_for, 'program_applied_for', $array_programme, "", 1, $error['program_applied_for']);			
		else
			$out .= "\n".createTwoColFormLabelSelect( 'Programme', $this->program_applied_for, 'program_applied_for', $prog, "", 1, $error['program_applied_for']);
		
		
        // $out .= "\n".createTwoColFormLabelInput( SUBJECT_COMBINATION_LABEL .'<br/><span class="note">e.g. OND, HND </span>', $this->subject_combo, 'subject_combo', 0, $error['subject_combo']  );
		
		
		
		/*
		
		
		if ( $_GET['applicant'] != '1' && !$_REQUEST['jamb_reg_no'] )
			$out .= "\n".createTwoColFormLabelInput( DATE_OF_ENTRY_LABEL, $this->date_of_entry, 'date_of_entry', 1, $error['date_of_entry']  );
        
		
		*/   
		
		global $academic_session;
		$k = 0;
		foreach( $academic_session as $acad ){
			//if( $acad['name'] != CURRENT_ACCADEMIC_SESSION ){
				$new_acad[$k]['value'] = $new_acad[$k]['name'] = $acad['name'];
				$k++;
			//}	
		}
		
		if ( $_GET['applicant'] != '1' && !$_REQUEST['jamb_reg_no'] )
			//$out .="\n".createTwoColFormLabelRadio( DATE_OF_ENTRY_LABEL, $this->date_of_entry , $new_acad, $error['date_of_entry'], "");	
			$out .= "\n".createTwoColFormLabelSelect( DATE_OF_ENTRY_LABEL, $this->date_of_entry, 'date_of_entry', $new_acad, "", 1, $error['date_of_entry']);
                $out .='<tr>
                            <th colspan="2" class="tbTitle"> '.DEPARTMENT_INFO_TITLE.' for studies. </th>
			</tr>';

		$dept = new Department();
		$columns = array("name", "id");
		$allDept = $dept->getAll( 0, $columns, 'name' );

		$i = 0;
		foreach( $allDept as $aD )
		{
			$array_dept[$i]['name'] = $aD['name'];
			$array_dept[$i]['value'] = $aD['id'];
			$i++;
		}
		
		$dept->setId( $this->department_id );
		$mydept = $dept->getDepartment();	
		
		if( isset($_REQUEST['jamb_reg_no'])  )
				$out .= "\n".'<tr><td class="formLabel">'.DEPARTMENT_LABEL.'</td><td class="formBox">'.$mydept['name'].'
							<input type="hidden" value="'.$this->department_id.'" name="'.department_id.'" />
							</td></tr>';	
		else		
			$out .= "\n".createTwoColFormLabelSelect( DEPARTMENT_LABEL, $this->department_id, 'department_id', $array_dept, "", 1, $error['department_id']);
		

                $out .= "<tr>
                             <th colspan='2' class='tbTitle'> ".DECLARATION_TITLE."<span class='required'>*</span> </th>
                         </tr>
			<tr>
			<td class='formBox' colspan=2><div class='note'>";
                if ($_GET['applicant']!='1')
                {
                    $out .= DECLARATION_APPLICANT;
                }
                else
                {
                    $out .= DECLARATION;
                }
				
                $out .= "</div></td>	
			
			</tr>".createTwoColFormLabelRadio('declaration', $this->declaration, $array_declaration, $error['declaration'], "" ); 

                 // dealing with scratch card passed into form

                $out .= ' <input type="hidden" name="scratch_card_pin" value="'.$_POST['scratch_card_pin'].'" />';
                $out .= ' <input type="hidden" name="student_id="'.$this->student_id.'" />';
                
                if(isset($_REQUEST['jamb_reg_no']))
                    $out .= ' <input type="hidden" name="jamb_reg_no" value="'.$_REQUEST['jamb_reg_no'].'" />';

                //set submit to apply by default.
                $submit = "apply";
                //if its a JAMB student set submit to update
                if(isset($_REQUEST['jamb_reg_no'])){
                    $submit ="update";
                }else
                    $submit = "apply";


                $out .= '<tr>
                            <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="'.$submit.'" class="stdButton" value="submit" > </th>
			</tr>	
			</table>
				
			</form>';
		
				
		return $out;
					
	 }
	
	
	 	


         /*
	  *generates the student Olevel exam entry Form.
	  *
	  * @param error 	        - error generated from a submitted form after validation
	  * @param error_result 	- error generated from the result form after validation
	  * @returns html code of form.
        */
	function olevelExamForm( $error = array(),  $error_result =  '' )
          {
		
		

                $out .='<tr>
                            <th colspan="2" class="tbTitle"> '.EXAM_INFO_TITLE_1.'  </th>
                       </tr>';
			
                //display first olevel exam form.
                //$out .= "\n".createTwoColFormLabelInput( EXAM_NAME_LABEL, $this->exams[0][exam_name], 'exams[0][exam_name]', 1, $error[0]['exam_name']  );
                
				global $olevelexamstypes;
	            $i = 0;
	            foreach( $olevelexamstypes as $oa ){
	                $array_oexams[$i]['value'] = $oa;
	                $array_oexams[$i]['name'] = $oa;
	                $i++;
	            }

				$out .= "\n".createTwoColFormLabelSelect( EXAM_NAME_LABEL, $this->exams[0][exam_name], 'exams[0][exam_name]', $array_oexams, "", 1, $error[0]['exam_name'] );
				
				$out .= "\n".createTwoColFormLabelInput( EXAM_DATE_LABEL.'<br/><span class="note">DD/MM/YYYY</span>', $this->exams[0][exam_date], 'exams[0][exam_date]', 1, $error[0]['exam_date']  );
                $out .= "\n".createTwoColFormLabelInput( EXAM_NUMBER_LABEL, $this->exams[0][exam_no], 'exams[0][exam_no]', 1, $error[0]['exam_no']  );
                $out .= "\n".createTwoColFormLabelInput( EXAM_CENTER_LABEL, $this->exams[0][exam_center], 'exams[0][exam_center]', 1, $error[0]['exam_center']  );

                ///display the 1st result form
                //$out .= "\n".$this->olevelResultForm(0, $error_result );
				$out .= "\n".$this->olevelResultForm(0, $error_result, FALSE );

                $out .='<tr>
                            <th colspan="2" class="tbTitle"> '.EXAM_INFO_TITLE_2.' </th>
                       </tr>';
                //display 2nd olevel exam form.
                //$out .= "\n".createTwoColFormLabelInput( EXAM_NAME_LABEL, $this->exams[1][exam_name], 'exams[1][exam_name]', 0, $error[1]['exam_name']  );
                $out .= "\n".createTwoColFormLabelSelect( EXAM_NAME_LABEL, $this->exams[1][exam_name], 'exams[1][exam_name]', $array_oexams, "", 0, $error[1]['exam_name'] );
				
				$out .= "\n".createTwoColFormLabelInput( EXAM_DATE_LABEL.'<br/><span class="note">DD/MM/YYYY</span>', $this->exams[1][exam_date], 'exams[1][exam_date]', 0, $error[1]['exam_date']  );
                $out .= "\n".createTwoColFormLabelInput( EXAM_NUMBER_LABEL, $this->exams[1][exam_no], 'exams[1][exam_no]', 0, $error[1]['exam_no']  );
                $out .= "\n".createTwoColFormLabelInput( EXAM_CENTER_LABEL, $this->exams[1][exam_center], 'exams[1][exam_center]', 0, $error[1]['exam_center']  );
                ///display the 1st result form
                //$out .= "\n".$this->olevelResultForm(1 );
				 $out .= "\n".$this->olevelResultForm( 1, "", FALSE );

		return $out;

	 }
	


         /*
		* generates the student Olevel result  Form.
		*
		* @param examIndex 	        - index of the exam (the current exam in question)
		* @param error                - error generated from the result form after validation
		* @returns html code of form.
        */
        
		/*
		
		function olevelResultForm( $examIndex, $error='' )
        {

		//print_r( $subject );

                $out .='<tr>
                                <td class="col2" colspan=2><span class="note">Exam Result, Specify your result in the  form A1, B3, C6, E8</span></td>

                        </tr>

                        <tr>
                        <td colspan="2">
                        <table class="examsTable" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                        <th class="col1" colspan=2> '.EXAM_SUBJECT_LABEL.' </th><th class="col2"> '.EXAM_GRADE_LABEL.'</th>
                                        <th class="col1" colspan=2> '.EXAM_SUBJECT_LABEL.' </th><th class="col2"> '.EXAM_GRADE_LABEL.'</th>
                                </tr>';
							
							$this->exams[$examIndex][result][0][grade] = isset( $this->exams[$examIndex][result][0][grade] ) ? $this->exams[$examIndex][result][0][grade] :  $this->exams[$examIndex][result][0][subject_grade];
							$this->exams[$examIndex][result][1][grade] = isset( $this->exams[$examIndex][result][1][grade] ) ? $this->exams[$examIndex][result][1][grade] :  $this->exams[$examIndex][result][1][subject_grade];
		
							if( isset( $this->exams[$examIndex][result][0][subject] ) ) 
								$this->exams[$examIndex][result][0][subject] = $this->exams[$examIndex][result][0][subject];
							else if( isset( $this->exams[$examIndex][result][0][subject_name] ) )
								$this->exams[$examIndex][result][0][subject] = $this->exams[$examIndex][result][0][subject_name];
							else 	
								$this->exams[$examIndex][result][0][subject] = 'English';
							
							if( isset( $this->exams[$examIndex][result][1][subject] ) ) 
								$this->exams[$examIndex][result][1][subject] = $this->exams[$examIndex][result][1][subject];
							else if( isset( $this->exams[$examIndex][result][1][subject_name] ) )
								$this->exams[$examIndex][result][1][subject] = $this->exams[$examIndex][result][1][subject_name];
							else 	
								$this->exams[$examIndex][result][1][subject] = 'Maths';
							
							
							//$this->exams[$examIndex][result][0][subject] = isset( $this->exams[$examIndex][result][0][subject] ) ? $this->exams[$examIndex][result][0][subject] :  $this->exams[$examIndex][result][0][subject_name];
							//$this->exams[$examIndex][result][1][subject] = isset( $this->exams[$examIndex][result][1][subject] ) ? $this->exams[$examIndex][result][1][subject] :  $this->exams[$examIndex][result][1][subject_name];
							
                            $out .= '<tr>';
                                    $out .= createExamTableRow( 1, $this->exams[$examIndex][result][0][subject], "exams[$examIndex][result][0][subject]", $this->exams[$examIndex][result][0][grade], "exams[$examIndex][result][0][grade]", "inputTxt smallInputTxt" );
                                    $out .= createExamTableRow( 2, $this->exams[$examIndex][result][1][subject], "exams[$examIndex][result][1][subject]", $this->exams[$examIndex][result][1][grade], "exams[$examIndex][result][1][grade]", "inputTxt smallInputTxt");
							//
                                    $out .='</tr>';
							//
                                 for( $k=2; $k<10;  ){
                                    $j=$k+1;
                                    $this->exams[$examIndex][result][$k][grade] = isset( $this->exams[$examIndex][result][$k][grade] ) ? $this->exams[$examIndex][result][$k][grade] :  $this->exams[$examIndex][result][$k][subject_grade];
									$this->exams[$examIndex][result][$j][grade] = isset( $this->exams[$examIndex][result][$j][grade] ) ? $this->exams[$examIndex][result][$j][grade] :  $this->exams[$examIndex][result][$j][subject_grade];
	
									$this->exams[$examIndex][result][$k][subject] = isset( $this->exams[$examIndex][result][$k][subject] ) ? $this->exams[$examIndex][result][$k][subject] :  $this->exams[$examIndex][result][$k][subject_name];
									$this->exams[$examIndex][result][$j][subject] = isset( $this->exams[$examIndex][result][$j][subject] ) ? $this->exams[$examIndex][result][$j][subject] :  $this->exams[$examIndex][result][$j][subject_name];
	
									
									$out .= '<tr>';
                                    $out .= createExamTableRow( $j, $this->exams[$examIndex][result][$k][subject], "exams[$examIndex][result][$k][subject]", $this->exams[$examIndex][result][$k][grade], "exams[$examIndex][result][$k][grade]" );
                                    $out .= createExamTableRow( $j+1, $this->exams[$examIndex][result][$j][subject], "exams[$examIndex][result][$j][subject]", $this->exams[$examIndex][result][$j][grade], "exams[$examIndex][result][$j][grade]" );

                                    $out .='</tr>';
                                    $k = $k + 2;
                                 }

                   $out .= '             <tr>

                            </table>
                               <br /><span class="warning">'. $error. '</span>
                             </td>
                        <tr>';

		return $out;

	 }*/
		
	 /*
		* generates the student Olevel result  Form.
		*
		* @param examIndex 	        - index of the exam (the current exam in question)
		* @param error                - error generated from the result form after validation
		* @returns html code of form.
        */
        function olevelResultForm( $examIndex, $error='', $typed_entry = TRUE )
        {

		//print_r( $subject );

                $out .='<tr>
                                <td class="col2" colspan=2><span class="note">Exam Result, Specify your result in the  form A1, B3, C6, E8</span></td>

                        </tr>

                        <tr>
                        <td colspan="2">
                        <table class="examsTable" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                        <th class="col1" colspan=2> '.EXAM_SUBJECT_LABEL.' </th><th class="col2"> '.EXAM_GRADE_LABEL.'</th>
                                        <th class="col1" colspan=2> '.EXAM_SUBJECT_LABEL.' </th><th class="col2"> '.EXAM_GRADE_LABEL.'</th>
                                </tr>';
							
							$this->exams[$examIndex][result][0][grade] = isset( $this->exams[$examIndex][result][0][grade] ) ? $this->exams[$examIndex][result][0][grade] :  $this->exams[$examIndex][result][0][subject_grade];
							$this->exams[$examIndex][result][1][grade] = isset( $this->exams[$examIndex][result][1][grade] ) ? $this->exams[$examIndex][result][1][grade] :  $this->exams[$examIndex][result][1][subject_grade];
		
							if( isset( $this->exams[$examIndex][result][0][subject] ) ) 
								$this->exams[$examIndex][result][0][subject] = $this->exams[$examIndex][result][0][subject];
							else if( isset( $this->exams[$examIndex][result][0][subject_name] ) )
								$this->exams[$examIndex][result][0][subject] = $this->exams[$examIndex][result][0][subject_name];
							else 	
								$this->exams[$examIndex][result][0][subject] = 'English';
							
							if( isset( $this->exams[$examIndex][result][1][subject] ) ) 
								$this->exams[$examIndex][result][1][subject] = $this->exams[$examIndex][result][1][subject];
							else if( isset( $this->exams[$examIndex][result][1][subject_name] ) )
								$this->exams[$examIndex][result][1][subject] = $this->exams[$examIndex][result][1][subject_name];
							else 	
								$this->exams[$examIndex][result][1][subject] = 'Maths';
							
							
							
							
							//$this->exams[$examIndex][result][0][subject] = isset( $this->exams[$examIndex][result][0][subject] ) ? $this->exams[$examIndex][result][0][subject] :  $this->exams[$examIndex][result][0][subject_name];
							//$this->exams[$examIndex][result][1][subject] = isset( $this->exams[$examIndex][result][1][subject] ) ? $this->exams[$examIndex][result][1][subject] :  $this->exams[$examIndex][result][1][subject_name];
							
                            $out .= '<tr>';
                                    $out .= createExamTableRow( 1, $this->exams[$examIndex][result][0][subject], "exams[$examIndex][result][0][subject]", $this->exams[$examIndex][result][0][grade], "exams[$examIndex][result][0][grade]", "inputTxt smallInputTxt", "", $typed_entry );
                                    $out .= createExamTableRow( 2, $this->exams[$examIndex][result][1][subject], "exams[$examIndex][result][1][subject]", $this->exams[$examIndex][result][1][grade], "exams[$examIndex][result][1][grade]", "inputTxt smallInputTxt", "", $typed_entry);
							//
                                    $out .='</tr>';
							//
                                 for( $k=2; $k<10;  ){
                                    $j=$k+1;
                                    $this->exams[$examIndex][result][$k][grade] = isset( $this->exams[$examIndex][result][$k][grade] ) ? $this->exams[$examIndex][result][$k][grade] :  $this->exams[$examIndex][result][$k][subject_grade];
									$this->exams[$examIndex][result][$j][grade] = isset( $this->exams[$examIndex][result][$j][grade] ) ? $this->exams[$examIndex][result][$j][grade] :  $this->exams[$examIndex][result][$j][subject_grade];
	
									$this->exams[$examIndex][result][$k][subject] = isset( $this->exams[$examIndex][result][$k][subject] ) ? $this->exams[$examIndex][result][$k][subject] :  $this->exams[$examIndex][result][$k][subject_name];
									$this->exams[$examIndex][result][$j][subject] = isset( $this->exams[$examIndex][result][$j][subject] ) ? $this->exams[$examIndex][result][$j][subject] :  $this->exams[$examIndex][result][$j][subject_name];
	
									
									$out .= '<tr>';
                                    
									if( $k >= 8 )
										$typed_entry = TRUE;
										
									$out .= createExamTableRow( $j, $this->exams[$examIndex][result][$k][subject], "exams[$examIndex][result][$k][subject]", $this->exams[$examIndex][result][$k][grade], "exams[$examIndex][result][$k][grade]", "inputTxt smallInputTxt", "", $typed_entry );
                                    $out .= createExamTableRow( $j+1, $this->exams[$examIndex][result][$j][subject], "exams[$examIndex][result][$j][subject]", $this->exams[$examIndex][result][$j][grade], "exams[$examIndex][result][$j][grade]", "inputTxt smallInputTxt", "", $typed_entry );

                                    $out .='</tr>';
                                    $k = $k + 2;
                                 }

                   $out .= '             <tr>

                            </table>
                               <br /><span class="warning">'. $error. '</span>
                             </td>
                        <tr>';

		return $out;

	 }
		
	// similar to funtion above but stands alone and allows for editing of only olevel exams	
	function olevelExamForm_standAlone( $action, $error,  $error_result )
    {
		$out = "\n".'<div class="heading">  </div>
					<div class="long_box floatleft">
						<form action="'.$action.'" method="POST">
							<table class="stdTable" cellpadding="0" cellspacing="0" border="0">
							<tr>
                            <th colspan="2" class="tbTitle"> '.EXAMINATION_RESULT_TITLE.' </th>
							</tr>
							';
							//olevelExamForm( $error = array(),  $error_result =  '' )
			 $out .= $this->olevelExamForm( $error,  $error_result );
			 
			 $out .= '<tr>
                            <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="update" class="stdButton" value="update" > </th>
					</tr>	
					</table>
				
			</form>';				
			
			return $out;		
		
		

	}
		

         /*
	  * generates the institution attended Form.
	  *
	  * @param error 	        - error generated from a submitted form after validation
	  * @param error_result 	- error generated from the result form after validation
	  * @returns html code of form.
        */
        function institutionAttendedForm( $error='' )
           {

                        $out .='<tr>
                        <td colspan="2">
                                <table class="examsTable" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                                <th class="col2" colspan=2> '.SCHOOL_ATTENDED_NAME_LABEL.' </th>
                                                <th class="col2"> '.DURATION_FROM_LABEL.' <span class="note">(YYYY)</span></th>
                                                <th class="col2"> '.DURATION_TO_LABEL.' <span class="note">(YYYY)</span></th>
                                        </tr>';

                                 for( $i=0; $i < 5; $i++ ){
                                    if( $i == 0 ) $spanReq = '<span class="required">*</span>';
                                    else $spanReq = '';
                                  
                                   /* $out .=     '<tr>
                                                        <td class="col1"> '.$spanReq.($i+1).'</td>
                                                        <td class="col1"><input type="text" value="'.$this->institutions[$i][institution_name].'" name="institutions['.$i.'][institution_name]" class="inputTxt extendedInputTxt" /></td>
                                                        <td class="col1"> <input type="text" value="'.$this->institutions[$i][start_date].'" name="institutions['.$i.'][start_date]" class="inputTxt smallInputTxt" /></td>
                                                        <td class="col1"> <input type="text" value="'.$this->institutions[$i][end_date].'" name="institutions['.$i.'][end_date]" class="inputTxt smallInputTxt" /></td>
                                                </tr>';*/
												
									 $out .=     '<tr>
                                                        <td class="col1"> '.$spanReq.($i+1).'</td>
                                                        
												<td class="col1"><input type="text"';
												
												if( $this->institutions[$i][institution_name] )
													$out .= 'value="'.$this->institutions[$i][institution_name].'"        
													onblur="if (this.value == \'\') {this.value = \'Secondary School\'; this.style.color= \'#999\'; }"
													onfocus="if (this.value == \'Secondary School\') {this.value = \'\'; this.style.color= \'#000\';   }"';
													
													
												else  {
													if( $i == 0 )
														$out .= 'value=\'Secondary School\' 
															onblur="if (this.value == \'\') {this.value = \'Secondary School\'; this.style.color= \'#999\'; }"
															onfocus="if (this.value == \'Secondary School\') {this.value = \'\'; this.style.color= \'#000\';   }"';
													
												
												}
												
											$out .= 'name="institutions['.$i.'][institution_name]" class="inputTxt extendedInputTxt greyed" /></td>
                                                        <td class="col1"> <input type="text" value="'.$this->institutions[$i][start_date].'" name="institutions['.$i.'][start_date]" class="inputTxt smallInputTxt" /></td>
                                                        <td class="col1"> <input type="text" value="'.$this->institutions[$i][end_date].'" name="institutions['.$i.'][end_date]" class="inputTxt smallInputTxt" /></td>
                                                </tr>';			
												
                                  }

                                $out .= '
                                        </table>
                                           <br /><span class="warning">'. $error. '</span>
                                </td>
                       <tr>';

		return $out;
        }
		
		// same as institutionAttendedForm but stands alone and useful when only editing institutions Attended
		function institutionAttendedForm_standAlone( $action, $error='' ){
			
			$out = "\n".'<div class="heading">  </div>
					<div class="long_box floatleft">
						<form action="'.$action.'" method="POST">
							<table class="stdTable" cellpadding="0" cellspacing="0" border="0">
							<tr>
                            <th colspan="2" class="tbTitle"> '.INSTITUTIONS_INFO_TITLE.' </th>
							</tr>
							';
							
			 $out .= $this->institutionAttendedForm( $error );				
			 $out .= '<tr>
                            <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="update" class="stdButton" value="update" > </th>
					</tr>	
					</table>
				
			</form>';				
			
			return $out;			
							
		
		}	
		
		//EXAMINATION_RESULT_TITLE
	
	/*
	 * form for uploading of pictures and credentials as part of the student application process
	 *
	 * @param action 	- file that processes the form
	 * @param error	- error generated from a submitted form after validation
	 * 
	 * 
	 * @returns html code of form.  
	 *
	*/
	
	function uploadForm( $action, $error )
	{
		
		
		$out = "\n".'<div class="heading"> Student Passport and Credentials </div>
                        <div class="long_box floatleft">
                                <form action="'.$action.'" method="POST" enctype="multipart/form-data">
                                        <input type=hidden name=MAX_FILE_SIZE value='.MAX_UPLOAD_FILE_SIZE.' >
                                        <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                         <th colspan="2" class="tbTitle"> Passport Photograph <span class="note">Note: All scanned documents must be less than 1MB</span></th>
                                        </tr>';
		$out .= "\n".createTwoColFormLabelFileInput( 'Passport', 'passport', ( int )PASSPORT_REQUIRED, $error['passport'] );
		
		/*
                $out .= '<tr>
                             <th colspan="2" class="tbTitle"> Birth Certificate or Sworn declaration </th>
                         </tr>';
		$out .= "\n".createTwoColFormLabelFileInput( 'Birth Certificate', 'birth_certificate', ( int )BIRTH_CERTIFICATE_REQUIRED , $error['birth_certificate'] );
		
		$out .= '				<tr>
									<th colspan="2" class="tbTitle"> Credentials </th>
								</tr>';
		$out .= "\n".createTwoColFormLabelFileInput( 'Credential 1<span class="note">(e.g. WAEC result)</span>', 'credential[0]', 1, $error['credential'][0], '' );
		$out .= "\n".createTwoColFormLabelFileInput( 'Credential 2<span class="note">(e.g. JAMB result)</span>', 'credential[1]', 0, $error['credential'][1], '' );
		$out .= "\n".createTwoColFormLabelFileInput( 'Credential 3', 'credential[2]', 0, $error['credential'][2], '' );
		$out .= "\n".createTwoColFormLabelFileInput( 'Credential 4', 'credential[3]', 0, $error['credential'][3], '' );
		$out .= "\n".createTwoColFormLabelFileInput( 'Credential 5', 'credential[4]', 0, $error['credential'][4], '' );
		*/	
		
		 //if( isset( $_REQUEST['jamb_reg_no'] ) )
         //           $cur_action = 'update';
         //        else
                    $cur_action = 'apply';

		// pass all the entered data from previous form hidden here
		$out .= '<input type="hidden" name="'.$cur_action.'" value="1" />
				 <input type="hidden" name="surname" value="'.$this->surname.'" /> '."\n".'
				 <input type="hidden" name="othernames" value="'.$this->othernames.'" />'."\n".'
				 <input type="hidden" name="firstname" value="'.$this->firstname.'" />'."\n".'
				 <input type="hidden" name="email" value="'.$this->email.'" />	'."\n".'
				 <input type="hidden" name="postal_address" value="'.$this->postal_address.'" />'."\n".'
				 <input type="hidden" name="dob" value="'.$this->dob.'" />'."\n".'
				 <input type="hidden" name="place_of_birth" value="'.$this->place_of_birth.'" />'."\n".'
				 <input type="hidden" name="state_of_origin" value="'.$this->state_of_origin.'" />'."\n".'
				 <input type="hidden" name="lga" value="'.$this->lga.'" />'."\n".'
				 <input type="hidden" name="marital_status" value="'.$this->marital_status.'" />'."\n".'
				 <input type="hidden" name="nationality" value="'.$this->nationality.'" />'."\n".'
				 <input type="hidden" name="declaration" value="Agree" />'."\n".'
				 <input type="hidden" name="program_applied_for" value="'.$this->program_applied_for.'" />'."\n".
                                 '<input type="hidden" name="scratch_card_pin" value="'.$_POST['scratch_card_pin'].'" />'.
                                 '<input type="hidden" name="password" value="'.$this->password.'" />
                                  <input type="hidden" name="password2" value="'.$this->password2.'" />
                                  <input type="hidden" name="phone_no" value="'.$this->phone_no.'" />
                                  <input type="hidden" name="maiden_name" value="'.$this->maiden_name.'" />
                                  <input type="hidden" name="next_of_kin_name" value="'.$this->next_of_kin_name.'" />
                                  <input type="hidden" name="next_of_kin_address" value="'.$this->next_of_kin_address.'" />
                                  <input type="hidden" name="next_of_kin_pob" value="'.$this->next_of_kin_pob.'" />
                                  <input type="hidden" name="next_of_kin_phone_no" value="'.$this->next_of_kin_phone_no.'" />
                                  <input type="hidden" name="next_of_kin_relationship" value="'.$this->next_of_kin_relationship.'" />
                                  <input type="hidden" name="father_name" value="'.$this->father_name.'" />
                                  <input type="hidden" name="father_address" value="'.$this->father_address.'" />
                                  <input type="hidden" name="father_occupation" value="'.$this->father_occupation.'" />
                                  <input type="hidden" name="father_phone_no" value="'.$this->father_phone_no.'" />
                                  <input type="hidden" name="mother_name" value="'.$this->mother_name.'" />
                                  <input type="hidden" name="mother_address" value="'.$this->mother_address.'" />
                                  <input type="hidden" name="mother_occupation" value="'.$this->mother_occupation.'" />
                                  <input type="hidden" name="mother_phone_no" value="'.$this->mother_phone_no.'" />
                                  <input type="hidden" name="sponsor_name" value="'.$this->sponsor_name.'" />
                                  <input type="hidden" name="sponsor_email" value="'.$this->sponsor_email.'" />
                                  <input type="hidden" name="sponsor_address" value="'.$this->sponsor_address.'" />
                                  <input type="hidden" name="sponsor_occupation" value="'.$this->sponsor_occupation.'" />
                                  <input type="hidden" name="sponsor_phone_no" value="'.$this->sponsor_phone_no.'" />
                                  <input type="hidden" name="department_id" value="'.$this->department_id.'" />
                                  <input type="hidden" name="title" value="'.$this->title.'" />
                                  <input type="hidden" name="matriculation_no" value="'.$this->matriculation_no.'" />
                                  <input type="hidden" name="sex" value="'.$this->sex.'" />
                                  <input type="hidden" name="date_of_entry" value="'.$this->date_of_entry.'" />
								  <input type="hidden" name="academic_session" value="'.$this->academic_session.'" />
                                  <input type="hidden" name="subject_combo" value="'.$this->subject_combo.'" />
                                  <input type="hidden" name="teller" value="'.$_POST['teller'].'" />
								   <input type="hidden" name="jamb_no" value="'.$this->jamb_no.'" />
                                  <input type="hidden" name="jamb_score" value="'.$this->jamb_score.'" />
								  <input type="hidden" name="jamb_centre" value="'.$this->jamb_centre.'" />
                     
                                  ';
                  
                  if( isset( $_REQUEST['jamb_reg_no'] ) ){
                      $out .= ' <input type="hidden" name="student_id" value="'.$this->student_id.'" />';
                      $out .= ' <input type="hidden" name="jamb_reg_no" value="'.$_REQUEST['jamb_reg_no'].'" />';

                  } else if ( isset( $_REQUEST['jamb_no'] ) ){
                      
                      $out .= ' <input type="hidden" name="jamb_no" value="'.$_REQUEST['jamb_no'].'" />';
				 }


                $is_i = 0;                    
                foreach( $this->institutions as $is ){
                    $out .= '<input type="hidden" name="institutions['.$is_i.'][institution_name]" value="'.$is[institution_name].'" />'."\n";
                    $out .= '<input type="hidden" name="institutions['.$is_i.'][start_date]" value="'.$is[start_date].'" />'."\n";
                    $out .= '<input type="hidden" name="institutions['.$is_i.'][end_date]" value="'.$is[end_date].'" />'."\n";
                    $is_i++;
                }
                 
                $ex_i = 0; 
                foreach( $this->exams as $ex ){
                   //$this->exam[1][exam_name], 'exam[1][exam_name]'
                    $out .= '<input type="hidden" name="exams['.$ex_i.'][exam_name]" value="'.$ex[exam_name].'" />'."\n";
                    $out .= '<input type="hidden" name="exams['.$ex_i.'][exam_date]" value="'.$ex[exam_date].'" />'."\n";
                    $out .= '<input type="hidden" name="exams['.$ex_i.'][exam_no]" value="'.$ex[exam_no].'" />'."\n";
                    $out .= '<input type="hidden" name="exams['.$ex_i.'][exam_center]" value="'.$ex[exam_center].'" />'."\n";
                   
                    $exrst_i = 0; 
                    foreach( $ex[result] as $rst )
                    {
                        $out .= '<input type ="hidden" name=" exams['.$ex_i.'][result]['.$exrst_i.'][subject]" value="'. $rst[subject].'" />'."\n";
                        $out .= '<input type ="hidden" name=" exams['.$ex_i.'][result]['.$exrst_i.'][grade]" value="'. $rst[grade].'" />'."\n";
                        $exrst_i++;
                    }

                    $ex_i++;;
                }

               

                $submit = "apply";

               
               
		$out .= '		
			<tr>
			<th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="upload" class="stdButton" value="submit" > </th>
			</tr>	
			</table>
						
			</form>';
		
		
		return $out;				
		
		
	}






      /*
       * Displays the form that allows for ability to change their passport picture of a student
       */
       function changePictureForm($action, $error)
        {
                $out = "\n".'<div class="heading"> Student Passport</div>

                                <div class="long_box floatleft">
                                        <img src="'.PASSPORT_URL.$this->photo.'" class="imageThumb" alt="passport" width="120px" />
                                        <form action="'.$action.'" method="POST" enctype="multipart/form-data">
                                                <input type=hidden name=MAX_FILE_SIZE value='.MAX_UPLOAD_FILE_SIZE.' >
                                                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                                <th colspan="2" class="tbTitle"> Passport Photograph </th>
                                                        </tr>';

               $out .= "\n".createTwoColFormLabelFileInput( 'Passport', 'passport', 1, $error );

               if( isset( $_REQUEST['student_id'] ) )
                        $out .= '<input type="hidden" name="student_id" value="'.$_REQUEST['student_id'].'" />';

               $out .= '<tr>
			<th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="upload" class="stdButton" value="submit" > </th>
			</tr>
                                              </table>
                                       </form>
                                </div>
                            </div>';

            return $out;
        }


       /*
       * Displays the form that allows for ability to change credentials of a student
       */
       function addCredentialForm($action, $error)
        {
                $out = "\n".'<div class="heading"> Student Credentials</div>

                                <div class="long_box floatleft">
                                        <form action="'.$action.'" method="POST" enctype="multipart/form-data">
                                                <input type=hidden name=MAX_FILE_SIZE value='.MAX_UPLOAD_FILE_SIZE.' >
                                                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                                <th colspan="2" class="tbTitle"> Credentials </th>
                                                        </tr>';

               $out .= "\n".createTwoColFormLabelFileInput( 'Credential', 'credential', 1, $error );

               if( isset( $_REQUEST['student_id'] ) )
                        $out .= '<input type="hidden" name="student_id" value="'.$_REQUEST['student_id'].'" />';

               $out .= '<tr>
			<th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="upload" class="stdButton" value="submit" > </th>
			</tr>
                                              </table>
                                       </form>
                                </div>
                            </div>';

            return $out;
        }

		// form for uploading a different birth certificate for student
		function changeBirthCertForm($action, $error)
        {
            $out = "\n".'
							<div class="warning_box"> This feature deletes existing birth certificate and replaces it with the one
									uploaded here</div>
							<div class="heading"> Birth Certificate Replacement Form</div>

                                <div class="long_box floatleft">
                                        <form action="'.$action.'" method="POST" enctype="multipart/form-data">
                                                <input type=hidden name=MAX_FILE_SIZE value='.MAX_UPLOAD_FILE_SIZE.' >
                                                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                                <th colspan="2" class="tbTitle"> Birth Certificate </th>
                                                        </tr>';

            $out .= "\n".createTwoColFormLabelFileInput( 'Birth Certificate', 'birth_certificate', 1, $error );

            if( isset( $_REQUEST['student_id'] ) )
                        $out .= '<input type="hidden" name="student_id" value="'.$_REQUEST['student_id'].'" />';

            $out .= '<tr>
			<th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="upload" class="stdButton" value="submit" > </th>
			</tr>
                                              </table>
                                       </form>
                                </div>
                            </div>';

            return $out;
			
        }
        
        
     /* 
	  * generates the student Bio Data Form.
	  * 	
	  * @param action 	- file that processes the form
	  * @param error	- error generated from a submitted form after validation
	  * @returns html code of form. 	
      *
	  */
	  
	function editScoreForm ($action, $error = array())
	{
    	
		$out = "\n".'
    				<div class="long_box floatleft"><div class="heading"> Edit scores for <a href="../student/profile.php?student_id='.$this->student_id.'">'.$this->firstname.' '.$this->othernames .' '.$this->surname .'</a> </div>
					<br/>
					<form action="'.$action.'" method="POST">
							<table>
								<thead>
								<tr>
									<td> Course/Assessment Title</td>
									<td> Score</td>
								</tr>
								</thead>
							';
		$out .= '<tr>
		                                        <th colspan=2 CLASS="sub_heading"> SEMESTER 1 RESULTS </th>
		                                        
		                                   </tr>';	
    	
		
		// get all the courses this particular student is registered for
    	
		$default_session = ( isset( $_SESSION['be_academic_session'] ) ) ? $_SESSION['be_academic_session'] : CURRENT_ACCADEMIC_SESSION;
		
		$sem1courses = $this->getSessionSemesterCourses( $default_session, 1 );
    	$sem2courses = $this->getSessionSemesterCourses( $default_session, 2 );
    	
		
		foreach( $sem1courses as $s1 ){
    		$crs = new course( $s1[course_id] );
	        $crs->getCourse();
	   		$crs->setSession( $default_session );
	               					
    		$out .= "\n".'<tr class="odd">';
    		$out .= "<td colspan=2>".$crs->course_title.'</td>';    		
    		$out .= '</tr>';
    		
    		
    		
    		
    		//$assess = new assessment();
	        //$assess->setCourseId( $crs->id );
	        //$assess->setSession( $session );
	        $assCrs = $crs->getAssessmentsInCourse();
			if( empty( $assCrs ) ){
				$out .= "\n";	
				
			} else {
				$count = 0;
	        	foreach( $assCrs as $ac ){
		        	$default_score = '';
		        	$score = $_REQUEST['score'];
	        		$res = new Result ( 0, $ac['id'], $this->student_id );
	        		$mscore = $res->getStudentAssessmentScore();
	        		
		        	$default_score = isset( $_REQUEST['save'] ) ? $score[ $ac['id'] ] : $mscore;
	        		$out .= "\n".'<tr class="even sub">';
			    	$out .= "<td>".$ac['title'].'</td>';
			    	$out .= '<td><input type="text" class="result_input_box" name="score['.$ac['id'].']" title="Enter Student Score" value="'.$default_score.'"  /><br /><span class="warning">'.$error[$ac['id']].'</span></td>';   		
			    	$out .= '</tr>';
			    	$count++;
			    	
	        	}
	        }
	        
    		
    	}
    	
    	$out .= '<tr>
		                                        <th colspan=2 CLASS="sub_heading"> SEMESTER 2 RESULTS </th>
		                                        
		                                   </tr>';

	    foreach( $sem2courses as $s2 ){
    		$crs = new course( $s2[course_id] );
	        $crs->getCourse();
	   		$crs->setSession( CURRENT_ACCADEMIC_SESSION );
	               					
    		$out .= "\n".'<tr class="odd">';
    		$out .= "<td colspan=2>".$crs->course_title.'</td>';    		
    		$out .= '</tr>';
    		
    		
    		
    		
    		//$assess = new assessment();
	        //$assess->setCourseId( $crs->id );
	        //$assess->setSession( $session );
	        $assCrs = $crs->getAssessmentsInCourse();
			if( empty( $assCrs ) ){
				$out .= "\n";	
				
			} else {
				$count = 0;
	        	foreach( $assCrs as $ac ){
		        	$default_score = '';
		        	$score = $_REQUEST['score'];
	        		$res = new Result ( 0, $ac['id'], $this->student_id );
	        		$mscore = $res->getStudentAssessmentScore();
	        		
		        	$default_score = isset( $_REQUEST['save'] ) ? $score[ $ac['id'] ] : $mscore;
	        		$out .= "\n".'<tr class="even sub">';
			    	$out .= "<td>".$ac['title'].'</td>';
			    	$out .= '<td><input type="text" class="result_input_box" name="score['.$ac['id'].']" title="Enter Student Score" value="'.$default_score.'"  /><br /><span class="warning">'.$error[$ac['id']].'</span></td>';   		
			    	$out .= '</tr>';
			    	$count++;
			    	
	        	}
	        }
	        
    		
    	}
    	
    	
    	$out .= '		
	    	<tr>
	                            <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="save" disabled class="stdButton" value="Save" > </th>
	                         </tr>
	    	</table>';
		$out .= '</form>';
		
		return $out;
	
	}   


	
	/*
	 * get the errors in upload form 
	 *
	 */
	
	function uploadFormErrorCheck()
	{
		
		// check all submitted images are valid png and jpg
		$acceptedFileTypes = explode(';', VALID_IMAGE_TYPES );
		
		if( PASSPORT_REQUIRED ) 
			if( isset( $_FILES['passport'] ) && ( !typeMatches( $_FILES['passport']['name'], $acceptedFileTypes ) ) ) 
				$error[passport] = 'You must submit either a jpg or png photo';
		/*
		if( $_FILES['birth_certificate']['name'] != "" ){
                    if (( !typeMatches( $_FILES['birth_certificate']['name'], $acceptedFileTypes ) ) )
			$error[birth_certificate] = 'You must submit either a jpg or png photo';
                }
		
		
		// $error['credential'][0]
		
		
		for( $i=0; $i < 5; $i++ ){
			if( trim( $_FILES['credential']['name'][$i] != '' ) ){
				if ( isset( $_FILES['credential']['name'][$i] ) && ( !typeMatches( $_FILES['credential']['name'][$i], $acceptedFileTypes ) ) ) 
				$error[credential][$i] = 'You must submit either a jpg or png photo' ;			
			}
		}
				
		// check if the the required form fields are filled
		if( PASSPORT_REQUIRED )
			if( !isset( $_FILES['passport'] ) || trim( $_FILES['passport']['name'] == '' ) )
				$error[passport] = 'You must enter a valid passport photograph';

        if( BIRTH_CERTIFICATE_REQUIRED )
            if( !isset( $_FILES['birth_certificate'] ) || trim( $_FILES['birth_certificate']['name'] == '' ) )
				$error[birth_certificate] = 'You must enter a valid birth certificate';
		
		if( trim( $_FILES['credential']['name'][0] == '' ) )
			 $error['credential'][0] = 'You must submit at least 1 credential';
			
		*/	
			
		// check to makesure the maximum file sizes are not exceeded.
		
				
		return $error;
			
	}
	
	// get error from user input into ExamForm  
	function validateExamForm()
	{
		if( !isset( $this->exams[0]['exam_name'] ) || trim( $this->exams[0]['exam_name'] == '' ) )
			$error[0][exam_name] = 'You must enter at least examination name 1';

		if( !isset( $this->exams[0]['exam_no'] ) || trim( $this->exams[0]['exam_no'] == '' ) )
			$error[0][exam_no] = 'You must enter at least examination no 1';

		if( !isset( $this->exams[0]['exam_date'] ) || trim( $this->exams[0]['exam_date'] == '' ) )
			$error[0][exam_date] = 'You must enter at least examination date 1';

		if( !isset( $this->exams[0]['exam_center'] ) || trim( $this->exams[0]['exam_center'] == '' ) )
			$error[0][exam_center] = 'You must enter at least examination center 1';

		return $error;	
		
		
	}
	
	
		// get error from user input into InsitutionAttended form  
		function validateInsitutionAttended()
			{
				$error = '';
					if( !isset( $this->institutions[0][institution_name] ) || trim( $this->institutions[0][institution_name] == '' ) ||
						!isset( $this->institutions[0][start_date] ) || trim( $this->institutions[0][start_date] == '' ) ||
						!isset( $this->institutions[0][end_date] ) || trim( $this->institutions[0][end_date] == '' ))
						   $error = 'You must enter valid data for minimum of 1 institution';
					else{
						if(!is_numeric($this->institutions[0][start_date]) || !is_numeric($this->institutions[0][end_date])){

						 $error = 'You must enter only Year(e.g 2001) in the \'from\' and \'to\' colunms';
						}else{

							if( $this->institutions[0][start_date] > $this->institutions[0][end_date] )
								$error .=' Your start date for the 1st institution attended must be earlier than the end date';
					   }
					}
					
					//check the non-compulsory fields
					$i=1;
					While( $i <=2 ){
						
						if(!isset( $this->institutions[$i][start_date] ) || trim( $this->institutions[$i][start_date] == '' ) ||
						   !isset( $this->institutions[$i][end_date] ) || trim( $this->institutions[$i][end_date] == '' )){

						}else{
							   if(is_numeric($this->institutions[$i][start_date]) || is_numeric($this->institutions[$i][end_date])){
								   if( $this->institutions[$i][start_date] > $this->institutions[$i][end_date] ){
										$sch_no='2nd';
										if( $i>'1' ){ $sch_no='3rd'; }
										$error .='<br/>Your start date for the '.$sch_no.' institution attended must be earlier than the end date';
								   }
							   }else{
								   $error = 'You must enter only Year(e.g 2001) in the \'from\' and \'to\' colunms';
							   }
						}
					$i++;
				   }

			return $error;

		 }


       /*
        * validates olevel result form
        * @param - none
        * @return - errors
        */
         function validateOlevelResult()
         {
		
                $error = '';
                if( !isset( $this->exams[0][result][0][subject] ) || trim( $this->exams[0][result][0][subject]  )  == ''||
                    !isset( $this->exams[0][result][1][subject] ) || trim( $this->exams[0][result][1][subject]  )== '' ||
                    !isset( $this->exams[0][result][2][subject] ) || trim( $this->exams[0][result][2][subject]  ) == ''||
                    !isset( $this->exams[0][result][3][subject] ) || trim( $this->exams[0][result][3][subject]  ) == ''||
                    !isset( $this->exams[0][result][4][subject] ) || trim( $this->exams[0][result][4][subject]  )== '' ||
                    !isset( $this->exams[0][result][0][grade] ) || trim( $this->exams[0][result][0][grade]  )== '' ||
                    !isset( $this->exams[0][result][1][grade] ) || trim( $this->exams[0][result][1][grade]  ) == ''||
                    !isset( $this->exams[0][result][2][grade] ) || trim( $this->exams[0][result][2][grade]  ) == ''||
                    !isset( $this->exams[0][result][3][grade] ) || trim( $this->exams[0][result][3][grade]  ) == ''||
                    !isset( $this->exams[0][result][4][grade] ) || trim( $this->exams[0][result][4][grade] == '' )
            
                )
			$error = 'You must enter at least 5 subjects and grades';
						
			// lets get all the english results for this student in exams 0 and 1
			
			
			foreach( $this->exams[1][result] as $s ){
				if( $s[subject] == 'English Language' )
					print_r( $s[grade] . ' ---> '  );	
			}
			
		return $error;
	 }
	 
	 // check if student has A, B or C in their maths and english result
	 function hasMathsAndEnglish()
	 {
	 
		$english = FALSE;
		$maths = FALSE;
		
		foreach( $this->exams[0][result] as $s )
		{
				
				if( $s[subject] == 'English Language' )
					if( substr( $s[grade], 0, 1 ) == 'A' || substr( $s[grade], 0, 1 ) == 'B' || substr( $s[grade], 0, 1 ) == 'C' )
						$english = TRUE;
				
				
				if( $s[subject] == 'Mathematics' ){
					if( substr( $s[grade], 0, 1 ) == 'A' || substr( $s[grade], 0, 1 ) == 'B' || substr( $s[grade], 0, 1 ) == 'C' )
						$maths = TRUE;		
					
				}			
		}
	 
		if(  $this->exams[1][result]  ){
			//print_r( 'in 2' );
			foreach( $this->exams[1][result] as $s )
			{
					if( $s[subject] == 'English Language' )
						if( substr( $s[grade], 0, 1 ) == 'A' || substr( $s[grade], 0, 1 ) == 'B' || substr( $s[grade], 0, 1 ) == 'C' )
							$english = TRUE;	
					
					if( $s[subject] == 'Mathematics' )
						if( substr( $s[grade], 0, 1 ) == 'A' || substr( $s[grade], 0, 1 ) == 'B' || substr( $s[grade], 0, 1 ) == 'C' )
							$maths = TRUE;				
			}
		}
		
		
		if( $maths && $english ){
			return TRUE;
		}else
			return FALSE;
			
	 
	 }


	/**
	 *
	 * Check if current email is already in the database and/or does not belong to the
	 * current student
	 *
	 * @return boolean Returns staff record row on success or FALSE on error
	 *
	 */
	function checkEmailExist()
	{
		$db = new MySQL();
		$values["email"] = MySQL::SQLValue( $this->email );
		if (! $db->Open()) $db->Kill();
		$db->SelectRows( STUDENT_TABLE, $values);
		$row = $db->RowArray();

		//when id is set then check if email matches that of the found row
		if( !empty( $row ) ){
			if( $row[id] == $this->id )
				return false;
		}

	 	return $row;
	}
	
	/**
	 *
	 * Check if current matric number is already in the database and does not belong to the
	 * current student
	 *
	 * @return boolean Returns staff record row on success or FALSE on error
	 *
	 */
	function checkMatricExist()
	{
		$db = new MySQL();
		//$values["matriculation_no"] = MySQL::SQLValue( $this->matriculation_no );
		if (! $db->Open()) $db->Kill();
		
		//$db->SelectRows( STUDENT_TABLE, $values);
		
		if( !$this->matriculation_no || trim( $this->matriculation_no ) == '' )
			return FALSE;
		
		
		$sql = "SELECT * FROM ".STUDENT_TABLE." WHERE matriculation_no='".$this->matriculation_no."' OR
					old_matriculation_no='".$this->matriculation_no."' " ;
		
		if ( ! $db->Query( $sql ) ) $db->Kill();
		
		$row = $db->RowArray();

		//when id is set then check if matric matches that of the found row
		if( !empty( $row ) ){
			if( $row[student_id] == $this->student_id )
				return false;
		}
		
		$db->__destruct();
                
	 	return $row;
	}
	
	// to check if matric exists in matric or old matric column
	function checkOldMatricExist()
	{
		$db = new MySQL();
		
		if (! $db->Open()) $db->Kill();
		
		if( !$this->old_matriculation_no || trim( $this->old_matriculation_no ) == '' )
			return FALSE;
		
		
		$sql = "SELECT * FROM ".STUDENT_TABLE." WHERE matriculation_no='".$this->old_matriculation_no."' OR
					old_matriculation_no='".$this->old_matriculation_no."' " ;
		
		if ( ! $db->Query( $sql ) ) $db->Kill();
		
		$row = $db->RowArray();

		//when id is set then check if matric matches that of the found row
		if( !empty( $row ) ){
			if( $row[student_id] == $this->student_id )
				return false;
		}
		
		$db->__destruct();
                
	 	return $row;
	}
	
	
	
	
        /*
         * checkAdmissionAproved - checks if a students admission application has been approved.
         *
         * @param       none
         * @return      boolean: TRUE | FALSE
         *
         */

        function checkAdmissionAproved()
        {
			
          if( $this->approving_admission_unit_id > 0 )
				return TRUE;
            else
                return FALSE;
			
        }
		
		// check if student has completed registration as required
		function courseRegistrationCompleteForSemester()
		{
		
			$course = new course( "" );
			$sem1crs = $this->getSessionSemesterCourses( CURRENT_ACCADEMIC_SESSION, 1 );
			$sem2crs = $this->getSessionSemesterCourses( CURRENT_ACCADEMIC_SESSION, 2 );
           
			$unregistered_sem = array();
           
			for( $i=1; $i <= NUMBER_OF_SEMESTER; $i++ ){
               		$crses = array();
               		$crses = $this->getSessionSemesterCourses( CURRENT_ACCADEMIC_SESSION, $i );
               		if( empty( $crses ) ){
               			$unregistered_sem[] = $i;
               		}
               }
               
            if( PER_SEMESTER_COURSE_REGISTRATION && !in_array( CURRENT_SEMESTER, $unregistered_sem ) 
               		|| empty( $unregistered_sem )
               		)
              		return TRUE;
			else {
               		return FALSE;
               	}	
		
		
		
		}


        /*
         * checkCourseRegAproved - checks if a students course registration request has been approved.
         *
         * @param       none
         * @return      boolean: TRUE | FALSE
         *
         */

        function checkCourseRegAproved()
        {

           
            if(  $this->course_registration_request == 0 &&
                    $this->hod_course_approval_id > 0 &&
                    $this->dean_course_approval_id > 0
                ){
                return TRUE;
            } else
                return FALSE;
        }
		
		
		// return a string description of registration status
		function courseRegStatus()
		{
			$as = $fo = FALSE;
			global $usergroups;
			
			$user = new User( $_SESSION['userID'] );
			if( $user->userWithinGroup( $usergroups['academic_sec'] ) ){
				$as = TRUE;
			}
			
			
			
			if( $user->userWithinGroup( $usergroups['faculty_officer'] ) )	
				$fo = TRUE;
			
			
			
			if( $this->academic_session != CURRENT_ACCADEMIC_SESSION || $this->semester != CURRENT_SEMESTER )	
				return 'Yet to complete course registration';
 
			
			if( $this->hod_course_approval_id == 0 && $as )
				return '<a href="?action=hod_approve_registration&student_id='.$this->student_id.'"> Approve Course Registration</a>';
			else 	
				$str .= 'Academic Secretary yet to approve course reg.';
			
			
			if( $this->hod_course_approval_id > 0 && $this->dean_course_approval_id == 0 && $fo  )
				return '<a href="?action=dean_approve_registration&student_id='.$this->student_id.'"> Approve Course Registration</a>';
			else 	
				$str = 'Faculty officer yet to approve course reg.';
	
			if( $this->hod_course_approval_id > 0 && $this->dean_course_approval_id > 0  )
				$str = 'Course Registration fully approved.';
	
			
			return $str;
		
		}
		
		
		

        /*
         *Handles the upload of passport picture file unto server.
         */
    function handlePictureUpload()
	{
                // create a unique file name for each file
		$uniquePPfilename = generateUniqueFilename( basename( $_FILES['passport']['name']) );

                // attempt to save the files in the specified directories
		$error_during_upload = FALSE;

		if( !( move_uploaded_file( $_FILES['passport']['tmp_name'], ORIGINALS_DIR.$uniquePPfilename ) ) )
			$error_during_upload = TRUE;

                // if error during upload, delete all files uploaded and return an error
		if( $error_during_upload ){
                        unlink( ORIGINALS_DIR.$uniquePPfilename );
                        return FALSE; // error during upload
                }
                
		// resize the image of the submitted files
		// as well as the thumbnails
		// and store in the appropriate directories

		// resize the photo and move to passport directory
		$PP_resized = resizeImage( ORIGINALS_DIR.$uniquePPfilename, 150, 150, 1, PASSPORT_DIR );
                unlink( ORIGINALS_DIR.$uniquePPfilename ); // remove the original

                
                if( !$PP_resized ){
			unlink( PASSPORT_DIR.$uniquePPfilename );
			return FALSE;
		}else{
			unlink( PASSPORT_DIR.$this->photo );
                        $this->photo = $uniquePPfilename;
			return TRUE;
		}

        }

	/*
 	 *	Handles the upload of birth certificate file unto server.
	 */	
	function handleBirthCertUpload()
	{
		// create a unique file name for each file
		$uniqueBCfilename = generateUniqueFilename( basename( $_FILES['birth_certificate']['name']) );

       $error_during_upload = FALSE;

		if( !( move_uploaded_file( $_FILES['birth_certificate']['tmp_name'], ORIGINALS_DIR.$uniqueBCfilename ) ) ){
			$error_during_upload = TRUE;
		}	
		
		if( $error_during_upload ){
			unlink( ORIGINALS_DIR.$uniqueBCfilename );
			return FALSE; // error during upload
        }

		
		//if(!resizeImage( ORIGINALS_DIR.$uniquePPfilename, 180, 180, 1, CREDENTIAL_DIR.'thumbnails/' ) )
		if(!resizeImage( ORIGINALS_DIR.$uniqueBCfilename, 180, 180, 1, BIRTH_CERT_DIR.'thumbnails/' ) ){
             return FALSE;
		}			

		if(!resizeImage( ORIGINALS_DIR.$uniqueBCfilename, 600, 0, 1, BIRTH_CERT_DIR ) )		
                    return FALSE;
			
		// delete existing bc
		if( trim( $this->birth_certificate ) != '' ){
		if( file_exists( BIRTH_CERT_DIR.'thumbnails/' .$this->birth_certificate ) )
			unlink ( BIRTH_CERT_DIR.'thumbnails/' .$this->birth_certificate );
		
		if( file_exists( BIRTH_CERT_DIR.$this->birth_certificate ) )	
			unlink ( BIRTH_CERT_DIR.$this->birth_certificate );
			
		}
		
        unlink( ORIGINALS_DIR.$uniqueBCfilename ); // remove the original
                    return $uniqueBCfilename;

    }

	
			
    /*
    * Handles the upload of credential files.
    */
	function handleCredentialUpload()
	{
                // create a unique file name for each file
		$uniquePPfilename = generateUniqueFilename( basename( $_FILES['credential']['name']) );

                // attempt to save the files in the specified directories
		$error_during_upload = FALSE;

		if( !( move_uploaded_file( $_FILES['credential']['tmp_name'], ORIGINALS_DIR.$uniquePPfilename ) ) )
			$error_during_upload = TRUE;

                // if error during upload, delete all files uploaded and return an error
		if( $error_during_upload ){
                        unlink( ORIGINALS_DIR.$uniquePPfilename );
                        return FALSE; // error during upload
                }

		// resize the image of the submitted files
		// as well as the thumbnails
		// and store in the appropriate directories

		// resize the photo and move to passport directory
		if(!resizeImage( ORIGINALS_DIR.$uniquePPfilename, 150, 150, 1, CREDENTIAL_DIR.'thumbnails/' ) )
                    return FALSE;

                if(!resizeImage( ORIGINALS_DIR.$uniquePPfilename, 1000, 0, 1, CREDENTIAL_DIR ) )
                    return FALSE;

                unlink( ORIGINALS_DIR.$uniquePPfilename ); // remove the original
                    return $uniquePPfilename;


        }


	/*
     * Handles the upload of passport, birth certificates and credential files unto server.
     */
    function handleUploadForm()
	{
		// TODO - check file size has not been exceeded for all uploads

		// create a unique file name for each file
                if( isset( $_FILES['passport']['name'] ) )
                    $uniquePPfilename = generateUniqueFilename( basename( $_FILES['passport']['name']) );
		

		// attempt to save the files in the specified directories
		$error_during_upload = FALSE;
		
		
		if( PASSPORT_REQUIRED )
			if( !( move_uploaded_file( $_FILES['passport']['tmp_name'], ORIGINALS_DIR.$uniquePPfilename ) ) ){
				$error_during_upload = TRUE;
			}
        
		// if error during upload, delete all files uploaded and return an error
		if( $error_during_upload ){		
			unlink( ORIGINALS_DIR.$uniquePPfilename );
			return FALSE; // error during upload
		}
		
		// resize the image of the submitted files
		// as well as the thumbnails
		// and store in the appropriate directories

		// resize the photo and move to passport directory
		$PP_resized = resizeImage( ORIGINALS_DIR.$uniquePPfilename, 150, 150, 1, PASSPORT_DIR );
		
		if( PASSPORT_REQUIRED )
			unlink( ORIGINALS_DIR.$uniquePPfilename ); // remove the original

		
		// if any of these actions above fail, return an error and delete all the files that have been created.
		if( (!$PP_resized && PASSPORT_REQUIRED ) ){
			 
			if( PASSPORT_REQUIRED )
				unlink( PASSPORT_DIR.$uniquePPfilename );
            
			return FALSE;
		} else {
			$this->photo = $uniquePPfilename;
			
			return TRUE;
		}
	}


         /**
          * function getMajor gets the student's major, whether single or double major
          * @@author: Zubair
          * @@return: String student's major Single or Double major
          */
          function getMajor(){
            $db = new MySQL();
            if (! $db->Open()) $db->Kill();
            $sql= "SELECT major from ".STUDENT_TABLE." where student_id ='$this->student_id'";
            if (! $db->Query($sql)){
                $db->Kill();
            } else{
                $result = $db->RowArray();
                                
                return $result['major'];
            }
          }

          /**
          * function getLevel gets the student's current level, whether preNCE, NCE1, II or III
          * @@author: Musty
          * @@return: String student's current level id
          */
          function retrieveLevel(){
            $db = new MySQL();
            if (! $db->Open()) $db->Kill();
            $sql= "SELECT level_id from ".STUDENT_TABLE." where student_id ='$this->student_id'";
            
            if (! $db->Query($sql)){
                $db->Kill();
            } else{
                //echo "<br>".$sql."<br>";
                $result = $db->RowArray();
                //echo "in get level";
                return $result['level_id'];
            }
          }

          /**
          * function getSemester gets the student's current Semester, whether 1 OR 2
          * @@author: Musty
          * @@return: String student's current semester id
          */
          function getSemester(){
            $db = new MySQL();
            if (! $db->Open()) $db->Kill();
            $sql= "SELECT semester from ".STUDENT_TABLE." where student_id ='$this->student_id'";
            if (! $db->Query($sql)){
                $db->Kill();
            } else{
                //echo "<br>".$sql."<br>";
                $result = $db->RowArray();
                //echo "in get level";
                return $result['semester'];
            }
          }


          /**
          * function setLevelForm enables students to set their level
          * @@author: Ibrahim
          * @@return: String form to set Level.
          */
          function setLevelForm($action, $error)
          {
                $out = "\n".'<div class="long_box floatleft"><div class="heading"> '.COURSE_REGISTRATION_HEADING.' </div>
                        <div>
                        <form action="'.$action.'" method="POST">
                        <table class="stdTable" cellpadding="0" cellspacing="0" border="0">';
                $out.= "<tr>
                             <th colspan='2' class='tbTitle'> ".LEVEL_TITLE. "</th>
                         </tr>";
				
                
                $lev = new Level();
                $levels = $lev->getAllLevels();
                
                $c = 0;
                foreach( $levels as $ls ){
                	$cp = $c+1;
                	$array_level[$c]['value'] = "$cp";
                	$array_level[$c]['name'] = $ls['name'];
                	$c++;
                }
				
               
				
                $out .= "\n".createTwoColFormLabelSelect( LEVEL_LABEL, $this->level_id, 'level_id', $array_level, "", 1, $error );

                $out .= '<tr>
                          <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="setLevel" class="stdButton" value="Next" > </th>
                            </tr>
                         </table>

                                    </form>
                                </div>
                             </div>';


			return $out;
		}
			
			

		
		
		  
		/*
		 *
         * forms for setting parameters for course registration 
         * @@author: Ibrahim
         * @@return: String form to set Level.
         *
		 */
        
		function setCourseRegParameter( $action, $error )
        {
                $out = "\n".'<div class="long_box floatleft"><div class="heading"> '.COURSE_REGISTRATION_HEADING.' </div>
                        <div>
                        <form action="'.$action.'" method="POST">
                        <table class="stdTable" cellpadding="0" cellspacing="0" border="0">';
                $out.= "<tr>
                             <th colspan='2' class='tbTitle'>Enter your course registration details </th>
                         </tr>";
				
                
                $lev = new Level();
                $levels = $lev->getAllLevels();
                
                $c = 0;
				
				
				
                foreach( $levels as $ls ){
                	$cp = $c+1;
                	$array_level[$c]['value'] = "$cp";
                	$array_level[$c]['name'] = $ls['name'];
                	$c++;
                }
				
				
				for( $i=1; $i <= NUMBER_OF_SEMESTER; $i++ ){
					$ic = $i - 1;
					$array_sem[$ic]['value'] = "$i";
                	$array_sem[$ic]['name'] = "$i";
				}
				
				
				//if( !$error || trim( $_REQUEST['level_id'] )  == '' )
				//	$this->level_id = '';
				$seme1 = $this->getSessionSemesterCourses( CURRENT_ACCADEMIC_SESSION, 1 );
				$levelid = $this->level_id;
				
				$dept = new Department( $this->department_id );
				$dept_row = $dept->getDepartment();
				$max_level =  $dept_row[duration]; 
				
				if( empty( $seme1 ) ){
					// just registering for the first time, so get my level
					// new applicants
					if( ( $this->level_id == 0 ||  $this->level_id == 1 ) && $this->date_of_entry == CURRENT_ACCADEMIC_SESSION )
						$levelid =  $this->level_id;
					else if( $this->level_id == $max_level )	
						$levelid =  $this->level_id;
					else
						$levelid =  $this->level_id + 1;
				}
				$levelid = isset( $_REQUEST[level_id] ) ? $_REQUEST[level_id] : $levelid;
				
				if( isset(  $_REQUEST[semester] ) )
					$semester_ = $_REQUEST[semester];
				else if( empty( $seme1 ) ){
					$semester_ = 1;
				} else {
					$semester_ = 2;
				}	
				
                $out .= "\n".createTwoColFormLabelSelect( CURRENT_ACCADEMIC_SESSION . ' Level', $levelid, 'level_id', $array_level, "", 1, $error['level_id'] );
				
				//$arr_ses[0]['value'] = LAST_ACCADEMIC_SESSION;	$arr_ses[0]['name'] = LAST_ACCADEMIC_SESSION;
				
				$arr_ses[1]['value'] = CURRENT_ACCADEMIC_SESSION;	$arr_ses[1]['name'] = CURRENT_ACCADEMIC_SESSION;
				
				$out .= "\n".createTwoColFormLabelSelect( SESSION_LABEL, CURRENT_ACCADEMIC_SESSION, 'session', $arr_ses, "", 1, $error['session'] );
				$out .= "\n".createTwoColFormLabelSelect( SEMESTER_LABEL, $semester_, 'semester', $array_sem, "", 1, $error['semester'] );
				$out .= "\n".createTwoColFormLabelInput( PIN_TITLE_LABEL, $_REQUEST['pin'], 'pin', 1, $error['pin']  );   
				
				
                $out .= '<tr>
                          <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="setRegParams" class="stdButton" value="Next" > </th>
                            </tr>
                         </table>

                                    </form>
                                </div>
                             </div>';


				return $out;
          }
		
		
		/**
		 *
		 *	get errors in setCourseRegParameter
		 *
		 */
		
		function validateSetCourseRegParam()
		{
			$sc = new scratchCard();
			
			$valid_sc = $sc->validateScratchCardPurpose( $_POST['pin'], 'ict', 0, $this->student_id );
			
			if( !isset( $_POST['level_id'] ) || trim( $_POST['level_id'] == '' ) )
				$error[level_id] = 'Select the new level that you are registering courses for.';
				
			if( !isset( $_POST['session'] ) || trim( $_POST['session'] == '' ) )
				$error[session] = 'Set session you are registering for';

			if( !isset( $_POST['semester'] ) || trim( $_POST['semester'] == '' ) )
				$error[semester] = 'Choose a valid semester';

			if( !isset( $_POST['pin'] ) || trim( $_POST['pin'] == '' ) ){
				$error[pin] = 'Enter a valid access code';		
			} else if( $sc->assigned() && !$sc->assignedToStudent( $_SESSION['studentUserID'] ) ) {
				$error['pin'] = 'Pin assigned to another student, contact admin for further information.'; 
			} else if( !$valid_sc ){
				
				
				$crses = $this->getSessionSemesterCourses( $_POST['session'], 1 );
						
				if( !( $this->password ==  $_POST['pin'] && 
						( $_POST['level_id'] == $this->level_id ) &&
						( $_POST['session'] == $this->academic_session ) &&
						( !PER_SEMESTER_COURSE_REGISTRATION	) &&	
						( !empty( $crses ) ) && 
						( $_POST['semester'] == 2 ) 
								
					) ) {
						
						
						if ( $sc->validateScratchCardPurpose( $_POST['pin'], 'ict', 1, $this->student_id ) ) 
							$error[pin] = 'Check that access code is valid. Your pin may have been used.';
						else if( PER_SEMESTER_COURSE_REGISTRATION && ( ( $_POST['session'] != $this->academic_session ) || ( $_POST['level_id'] != $this->level_id ) ) )
							$error[pin] = "Check that access code is valid. A new access code must be used for this semester's registration.";	
						else	
							$error[pin] = 'Check that access code is valid. Per semester/session fees must also be paid to get a correct access code.';	
				}	
			}
			
			
			
			
			return $error;
		
		}		  
		  
		  

         /**
          * function setMajorForm enables students to set their major
          * @@author: Zubair
          * @@return: String form to set major.
          */
		  
          function setMajorForm($action, $error)
          {
                $out = "\n".'<div class="long_box floatleft"><div class="heading"> '.COURSE_REGISTRATION_HEADING.' </div>
                        <div>
                        <form action="'.$action.'" method="POST">
                        <table class="stdTable" cellpadding="0" cellspacing="0" border="0">';
                $out.= "<tr>
                             <th colspan='2' class='tbTitle'> ".MAJOR_TITLE. "</th>
                         </tr>";
                $array_major[0]['value'] = 'SM';
                $array_major[1]['value'] = 'DM';
                $array_major[0]['name'] = SINGLE_MAJOR_LABEL;
                $array_major[1]['name'] = DOUBLE_MAJOR_LABEL;

                $out .= "\n".createTwoColFormLabelSelect( MAJOR_LABEL, $this->major, 'major', $array_major, "", 1, $error );

                $out .= '<tr>
                          <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="setMajor" class="stdButton" value="Next" > </th>
                            </tr>
                         </table>

                                    </form>
                                </div>
                             </div>';


				return $out;
          }


         // TODO - CHANGE FUNCTION NAME TO storeMajor
         /**
          * function setMajor sets the students major, whether single or double major
          * @@author: Zubair
          * @@return: Boolean TRUE/FALSE whether able to set the major or not
          */
          function setMajor( $major ){
            $db = new MySQL();
            if (! $db->Open()) $db->Kill();
            $sql= "Update ".STUDENT_TABLE." set major='$major' where student_id ='$this->student_id'";
            if (! $db->Query($sql)){
                $db->Kill();
            } else{
               return TRUE;
            }
          }


          /**
          * function updateLevel - update student level in db
          * @@author: Ibrahim
          * @@return: Boolean TRUE/FALSE whether able to set the major or not
          */
          function updateLevel_id(){
            $db = new MySQL();
            if (! $db->Open()) $db->Kill();
            $sql= "Update ".STUDENT_TABLE." set level_id='$this->level_id' where student_id ='$this->student_id'";
            if (! $db->Query($sql)){
                $db->Kill();
            } else{
               return TRUE;
            }
          }

		  
		  /**
          * function updateClass - update student class in db
          * @@author: Ibrahim
          * @@return: Boolean TRUE/FALSE whether able to set the major or not
          */
          function updateClass(){
            $db = new MySQL();
            if (! $db->Open()) $db->Kill();
            $sql= "Update ".STUDENT_TABLE." set class='$this->class' where student_id ='$this->student_id'";
            if (! $db->Query($sql)){
                $db->Kill();
            } else{
               return TRUE;
            }
          }
		  
		  
		   /**
          * function updateClass - update student house in db
          * @@author: Ibrahim
          * @@return: Boolean TRUE/FALSE whether able to set the major or not
          */
		  function updateHouse(){
            $db = new MySQL();
            if (! $db->Open()) $db->Kill();
            $sql= "Update ".STUDENT_TABLE." set house='$this->house' where student_id ='$this->student_id'";
            if (! $db->Query($sql)){
                $db->Kill();
            } else{
               return TRUE;
            }
          }
		  

        //TODO add secondary department to the the list of variables.

        /*
		 *
         * setSecondaryDeptForm, displays the department form
         * @param: action where the form will be processed 
         * @param: error  the error sent back after processing
         * @return: A HTML form
         *
		 */
         function setSecondaryDeptForm( $action, $error='' )
         {
                $out = "\n".'	<div class="long_box floatleft"><div class="heading"> '.COURSE_REGISTRATION_HEADING.' </div>
                <form action="'.$action.'" method="POST">
                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                    <th colspan="2" class="tbTitle"> Select your Secondary department </th>
                    </tr>';

		$dept = new Department($this->department_id);
                $dept->setDepartment();
               // $deptOptions = $dept->getOtherDepartmentsInFaculy( $this->student_id );
               $deptOptions = $dept->getAll();

                $i = 0;
		foreach( $deptOptions as $dO )
		{
			$array_dept[$i]['name'] = $dO['name'];
			$array_dept[$i]['value'] = $dO['id'];
			$i++;
		}
		$out .= "\n".createTwoColFormLabelSelect( SECONDARY_DEPARTMENT_LABEL, $this->secondary_department_id, 'secondary_department_id', $array_dept, "", 1, $error, $disabled );
                
                //$out .= '<input type="hidden" name="'.$cur_action.'" value="1" />';
                $out .= '<input type="hidden" name="major" value="'.$_REQUEST['major'].'" />';

                $out .= '<tr>
                    <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="setSecDept" class="stdButton" value="submit" > </th>
                        </tr>
                </table>
                

                </form>
                </div>';

                return $out;
        }

		// update level based on programme using (global) $array_programme
		function updateLevelFromProgramme()
		{
			// get program
			//$this->program_applied_for;
			global $array_programme;
			$level = 0;
			$i = 1;
			foreach( $array_programme as $ap ){
				if( $this->program_applied_for == $ap[value] )
					$level = $i;
				$i++;	
			}	
			
			if( $level ){
				$db = new MySQL();
				if (! $db->Open()) $db->Kill();
				
				$sql = "Update ".STUDENT_TABLE." set level_id='".$level."' where student_id='".$this->student_id."'";
				if (! $db->Query($sql))
					$db->Kill();
				//print_r( $sql );
			}	

		}	
			
         /**
          * function setSecondaryDept sets the students major, whether single or double major
          * @@author: Zubair
          * @@return: Boolean TRUE/FALSE whether able to set the secondary department or not
          */
          function setSecondaryDept( $secDept ){
            $db = new MySQL();
            if (! $db->Open()) $db->Kill();
            $sql= "Update ".STUDENT_TABLE." set secondary_department_id=".$secDept." where student_id ='$this->student_id'";
            if (! $db->Query($sql)){
                $db->Kill();
            } else{
               return TRUE;
            }
          }


         /**
          * function getSecondaryDept gets the student's secondary department
          * @@author: Zubair
          * @@return: String student's secondary department.
          */
          function getSecondaryDept(){
            $db = new MySQL();
            if (! $db->Open()) $db->Kill();
            $sql= "SELECT name, secondary_department_id from ".DEPARTMENT_TABLE." as dept, ".STUDENT_TABLE." as st where student_id ='$this->student_id' and dept.id=st.secondary_department_id";
            if (! $db->Query($sql)){
                $db->Kill();
            } else{
                $result = $db->RowArray();

                return $result['name'];
            }
          }


         /**
          * function getPrimaryDept gets the student's primary department
          * @@author: Zubair
          * @@return: String student's secondary department.
          */
          function getPrimaryDept(){
            $db = new MySQL();
            if (! $db->Open()) $db->Kill();
            $sql= "SELECT name, department_id from ".DEPARTMENT_TABLE." as dept, ".STUDENT_TABLE." as st where student_id ='$this->student_id' and dept.id=st.department_id";
            if (! $db->Query($sql)){
                $db->Kill();
            } else{
                $result = $db->RowArray();

                return $result['name'];
            }
          }


         /*
		  *
          * getSessionSemesterCourses: gets the current list of
          * courses particular to a session and semester
          *
          *
          * @@author: Ibrahim
          * @@return:
          */
          function getSessionSemesterCourses( $session, $semester, $department = FALSE ){
                
                $sql = "SELECT * FROM ".STUDENT_COURSE_TABLE."
                    as sc LEFT JOIN ".COURSE_TABLE." as c ON c.id = sc.course_id WHERE student_id='".$this->student_id."' AND session='".$session."' AND
                    sc.semester='".$semester."'";
            
				//print_r( $sql );
			
				if( $department )
					$sql .= " AND department_id = '".$department."'";
				
				$db = new MySQL();
                if (! $db->Open()) $db->Kill();
                if ( ! $db->Query( $sql ) )
                    $db->Kill();
                 else{
                     $rows = $db->RecordsArray();
                     if( !empty( $rows ) )
                        return $rows;
                     else
                        return FALSE;
                 }

          }
		  
		  
		  
		  /**
          * appliedForSession - 
          * checks if a student is registered for a particular session
          *
          *
          * @@author: 	Ibrahim
		  * @@param: 	none
          * @@return:	boolean
          */
		  
		function appliedForSession()
		{
			
			
			if( $this->academic_session == CURRENT_ACCADEMIC_SESSION )
				return TRUE;
			else
				return FALSE;
		
		  
		}
		
		/**
          * confirmStudentRegisteredForSession
          * allow student action or give relevant error message based on status of the students registration
          * for a particular session
          *
          * @@author: 	Ibrahim
		  * @@param: 	student_id - id of student
          * @@return:	boolean
          */
	
	
		function confirmRegisteredForSession()
		{
			session_start();
			
			if( isset( $_SESSION['studentUserID'] )  ){
				$this->setStudentId( $_SESSION['studentUserID'] );
				$st_row = TRUE;
			} else {
					
				$this->setMatric( $_POST['userName'] );
				$st_row = $this->checkMatricExist();
				$this->setStudentId( $st_row[student_id] );
			}
			
			$this->getStudent();
			
			global $allowed_prospect_actions;
			$userpass = isset( $_REQUEST['userPass'] ) ? $_REQUEST['userPass'] : $this->password;
			
			// if student is a prospect 
			$sc = new scratchCard();
			
			
			if( empty( $st_row ) ){
				return FALSE;
			} else if( ( $sc->validateScratchCardPurpose( $userpass, 'prospect', 'ALL' )  || 
						$sc->validateScratchCardPurpose( $userpass, 'jamb', 'ALL' )  ) 
					 ) {
					
				if ( isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], $allowed_prospect_actions ) ){
					return TRUE;
				} else {					
					$prot = new Protect();
					$prot->errorMsg = $prot->errorNoGroup;
					$prot->makeErrorHtml();
					return FALSE;
				}
				
			} else {
					
					
					if( !$this->appliedForSession() ){
					
						
					// check if the scratchcard has been used or its a new scratch card
					// card is new, so set password appropriately and register into this session
					// and set scratchcard to used
					
						
						if( $sc->validateScratchCardPurpose( $_REQUEST['userPass'], 'ict', 0, $this->student_id ) ){
							
							$this->changePassword( $_REQUEST['userPass'] );
							$this->changeAcademicSession();
							$sc->changeScratchCardStatus( $_REQUEST['userPass'] );
												
							// reset admission approval
							// $this->changeApplicationStatus( 0 );
							// reset course registration
							$this->changeRegistrationStatus( 0 );
							
							$tracker = new frontendTracker();
							$tracker->frontendTracker( 0, determineIP(), 'newsessionapplication', 0, STUDENT_TABLE, $_SESSION[studentUserID]  );
							$tracker->storeTracker();
							
							
							
						} else {
						
							// check if action is allowed if you are not registered.
							global $allowed_unregistered_actions;
							if ( ( isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], $allowed_unregistered_actions ) ) ) {
								return TRUE;
							}
							
							// card has already been used, send an error message
							$prot = new Protect();
							$prot->errorMsg = $prot->errorNoSessionRegistration;
							$prot->makeErrorHtml();
							return FALSE;
						}	
					} else {
						return TRUE;
				}
			}	
		}	
		
		/*
		 *   confirm student is registered for session / semester
		 *
		 */ 
		
		function courseRegistrationCompleteCurSession( $session = CURRENT_ACCADEMIC_SESSION )
		{
			
			$course = new course( "" );
			
			$unregistered_sem = array();
			for( $i=1; $i <= NUMBER_OF_SEMESTER; $i++ ){
               		$crses = array();
               		$crses = $this->getSessionSemesterCourses( $session, $i );
					
					
               		if( empty( $crses ) ){
               			$unregistered_sem[] = $i;
               		}
               }
            
			
			   
            if( PER_SEMESTER_COURSE_REGISTRATION && !in_array( $session, $unregistered_sem ) 
               		|| empty( $unregistered_sem ) )
				return TRUE;
			else
				return FALSE;
				
		
		}
		
		
		
         /*
          *
          * Use the function for approving or rejecting student application
          *
          * @param $newstatus(int) 1 approve, -1 to reject
          *
          *
          */
         function changeApplicationStatus( $newStatus )
         {

            $update["approving_admission_unit_id"]   = MySQL::SQLValue( $newStatus, MySQL::SQLVALUE_NUMBER);
            $update["approving_admission_unit_timestamp"]   = MySQL::SQLValue(time(), MySQL::SQLVALUE_DATETIME );

            if( !APPLICATION_APPROVED_BY_ADMISSIONS ){
                $update["approving_hod_id"]   = MySQL::SQLValue( $newStatus, MySQL::SQLVALUE_NUMBER);
                $update["hod_approval_timestamp"]   = MySQL::SQLValue(time(), MySQL::SQLVALUE_DATETIME );

                $update["apply_faculty_approval_id"]   = MySQL::SQLValue( $newStatus, MySQL::SQLVALUE_NUMBER);
                $update["apply_faculty_approval_timestamp"]   = MySQL::SQLValue(time(), MySQL::SQLVALUE_DATETIME );
            }
            
            $where["student_id"] = MySQL::SQLValue( $this->student_id, "integer" );

			$db = new MySQL();
            if (! $db->Open()){
                $db->Kill();
                return FALSE;
            } else {
				$result = $db->UpdateRows( STUDENT_TABLE, $update, $where); // Execute the update
				$db->Close();
            }
			
			// TODO - * SEND APPROPRIATE EMAIL IF APPLICATION STATUS CHANGES
			
			if( $result )return TRUE;
			else    return FALSE;
			
			
			
         }
		 
		 // Send admission email out
		 function sendAdmissionEmail( $newStatus )
		 {
			$find = array( '%institution_name%', '%student_fullname%', '%login_url%', '%student_username%',
                                                   '%student_password%', '%institution_name%', '%institution_url%',
                                                   '%receipt_url%', '%additional%'
                                                  );

			$replace = array( INSTITUTION_NAME, $this->firstname.' '.$this->surname, COE_URL , $this->matriculation_no, $this->password,
								INSTITUTION_NAME , INSTITUTION_URL, '', ''
                             );
            
			
			$subject = 'Madonna University Status Update!';
			if( $newStatus > 0 )
				$m_message = str_replace( $find, $replace, MSG_ADMISSION_APPROVED );
			else if( $newStatus < 0 )
				$m_message = str_replace( $find, $replace, MSG_ADMISSION_REJECTED );
			else if( $newStatus == 0 )
				$m_message = str_replace( $find, $replace, MSG_APPLICATION_RECEIVED );
				
			$headers = 'From: '. INSTITUTION_EMAIL . "\r\n" .
						'Reply-To: ' .INSTITUTION_EMAIL. "\r\n";
			
			$sent = FALSE;
			if( MSG_ADMISSION_ALLOW && $this->email && $this->email != '' )
				$sent = mail( $this->email, $subject, $m_message, $headers );
			
			if( !$sent )
					return FALSE;
				else 
					return TRUE;
		 }



         /*
          *
          * Use the function for approving or rejecting student registration status
          *
          * @param $newstatus(int) 1 approve, -1 to reject
          *
          *
          */
         function changeRegistrationStatus( $newStatus )
         {

            $update["hod_course_approval_id"]   = MySQL::SQLValue( $newStatus, MySQL::SQLVALUE_NUMBER);
            $update["hod_course_approval_timestamp"]   = MySQL::SQLValue(time(), MySQL::SQLVALUE_DATETIME );

			$update["dean_course_approval_id"]   = MySQL::SQLValue( $newStatus, MySQL::SQLVALUE_NUMBER);
            $update["dean_course_approval_timestamp"]   = MySQL::SQLValue(time(), MySQL::SQLVALUE_DATETIME );

            $where["student_id"] = MySQL::SQLValue( $this->student_id, "integer" );

			$db = new MySQL();
            if (! $db->Open()){
                $db->Kill();
                return FALSE;
            } else {
				$result = $db->UpdateRows( STUDENT_TABLE, $update, $where); // Execute the update
			
					if( $result )return TRUE;
				else    return FALSE;
				$db->Close();
            }
         }
		 
		 /*
          *
          * change HOD approval status for course registration
          *
          * @param $newstatus(int) 1 approve, -1 to reject
          *
          *
          */
         function HODApproveRegistration( $newStatus )
         {

            $update["hod_course_approval_id"]   = MySQL::SQLValue( $newStatus, MySQL::SQLVALUE_NUMBER);
            $update["hod_course_approval_timestamp"]   =  MySQL::SQLValue( date("Y-m-d H:i:s" ) , MySQL::SQLVALUE_DATETIME );
			
            $where["student_id"] = MySQL::SQLValue( $this->student_id, "integer" );

			$db = new MySQL();
            if (! $db->Open()){
                $db->Kill();
                return FALSE;
            } else {
			$result = $db->UpdateRows( STUDENT_TABLE, $update, $where); // Execute the update
		
                if( $result )return TRUE;
			else    return FALSE;
			$db->Close();
            }
         }
		 
		 /*
          *
          * change Dean approval status for course registration
          *
          * @param $newstatus(int) 1 approve, -1 to reject
          *
          *
          */
		 
		 function deanApproveRegistration( $newStatus )
         {

            $update["dean_course_approval_id"]   = MySQL::SQLValue( $newStatus, MySQL::SQLVALUE_NUMBER);
            $update["dean_course_approval_timestamp"]   =  MySQL::SQLValue( date("Y-m-d H:i:s" ) , MySQL::SQLVALUE_DATETIME );
			
            $where["student_id"] = MySQL::SQLValue( $this->student_id, "integer" );

			$db = new MySQL();
            if (! $db->Open()){
                $db->Kill();
                return FALSE;
            } else {
			$result = $db->UpdateRows( STUDENT_TABLE, $update, $where); // Execute the update
		
                if( $result )return TRUE;
			else    return FALSE;
			$db->Close();
            }
         }
		 
		 
		
		// get all reveived payments of a student
		function getStudentPayments()
		{
			 
			$sql = 'select *, pay.id as pay_id, rec.amount, rec.timestamp, rec.paid_by FROM '.RECEIVEDPAY_TABLE.' as rec 
					LEFT JOIN '.PAYMENT_TABLE.' as pay on rec.txn_ref = pay.txn_ref 
					LEFT JOIN '.SCRATCH_CARD_TABLE." as sc ON sc.teller=pay.txn_ref
				WHERE pay.student_id ='".$this->student_id."' OR sc.student_id='".$this->student_id."' GROUP BY rec.id ORDER BY rec.timestamp ASC";	
				
				
                $db = new MySQL();
                if (! $db->Open()) $db->Kill();
                if ( ! $db->Query( $sql ) )
                    $db->Kill();
                 else{
                     $rows = $db->RecordsArray();
					 	
                     if( !empty( $rows ) )
                        return $rows;
                     else
                        return FALSE;
                 }
				
		}
		
		// get student payments to be shown on student profile
		// TODO: merge with getStudentPayments
		function getStudentPaymentsForProfile()
		{
			
			
			$sql = "SELECT *, pay.id as payment_id FROM ".PAYMENT_TABLE." AS pay
                    LEFT JOIN ".SCRATCH_CARD_TABLE." AS sc 
					ON sc.teller = pay.txn_ref
					WHERE pay.student_id ='".$this->student_id."' OR sc.student_id='".$this->student_id."'
					ORDER BY pay.timestamp DESC
					";
			
			
			/*
			$sql = "SELECT *, pay.id as pay_id FROM ".PAYMENT_TABLE." AS pay
						WHERE pay.student_id ='".$this->student_id."' GROUP by txn_ref";			
			*/		
            /* 
			$sql = 'select *, pay.id as pay_id, rec.amount, rec.timestamp, rec.paid_by FROM '.RECEIVEDPAY_TABLE.' 
				as rec LEFT JOIN '.PAYMENT_TABLE.' as pay on rec.txn_ref = pay.txn_ref LEFT JOIN '.SCRATCH_CARD_TABLE." as sc ON sc.teller=pay.txn_ref
				WHERE pay.student_id ='".$this->student_id."' OR sc.student_id='".$this->student_id."' GROUP BY rec.id ORDER BY rec.timestamp DESC";	
			*/
				
				
                $db = new MySQL();
                if (! $db->Open()) $db->Kill();
                if ( ! $db->Query( $sql ) )
                    $db->Kill();
                 else{
                     $rows = $db->RecordsArray();
					 	
                     if( !empty( $rows ) )
                        return $rows;
                     else
                        return FALSE;
                 }
				
		}		

		
         //displays OF student profile
         function showStudent()
         {
			
			//get student credentials
            $credentials = explode( ',', $this->credentials );

            //check details of the current user.			
             	
			$ls = new layout();
			$current_user = $ls->getUser();
			
			
			if( $current_user['group_id']== 1 || $current_user['group_id']== 2 || $current_user['group_id']== 4 )
                $admin_options = '<div><div class="heading">Admin options</div>';
            else
                $admin_options = "";

			  
               if( $current_user['group_id'] == 1 || $current_user['group_id'] == 11  ) {

                    $action_list .= '<li class="red"><a href="'.COE_URL.'/admin/index.php?action=change_bio_data&student_id='.$this->student_id.'"> Update Bio-data.</a></li>';
                    $action_list .= '<li class="red"><a href="'.COE_URL.'/admin/index.php?action=change_pic&student_id='.$this->student_id.'"> Change Picture.</a></li>';
                    
					$password_text .= '<tr>
                                                    <td class="formLabel tdPadding" valign="top"> '.PIN_TITLE_LABEL.' </td><td class="formBox"><span>'.$this->password.'</span></td>
                                                </tr>';
											
					$medical = new Medical();
					$medical->setStudentId( $this->student_id );
					if( !$medical->retrieveMedical() ){
						$medstatus = '<a href="'.COE_URL.'/admin/index.php?action=medical&student_id='.$this->student_id.'">Modify record</a>';
						$medcomment = '<a href="'.COE_URL.'/admin/index.php?action=medical&student_id='.$this->student_id.'">Modify record</a>';
					} else {
						$medstatus = $medical->status;
						$medcomment = $medical->comment;
					}	
						
					$medical_status_string =  '
									<tr>
										<td class="formLabel tdPadding" valign="top">'.MEDICAL_STATUS_LABEL.'</td><td class="formBox"><span>'.$medstatus.'</span></td>
                                    </tr>';
					
					
					// check admissions
                    if( $this->checkAdmissionAproved() )
                        $action_list .= '<li>Admission Approved.</li>';
                    else if( $this->approving_admission_unit_id  < 0 )
						$action_list .= '<li>Application rejected. <a href="'.COE_URL.'/admin/index.php?action=approve_application&student_id='.$this->student_id.'"> Approve</a></li>';
					else
                        $action_list .= '<li>Awaiting approval for application.<a href="'.COE_URL.'/admin/index.php?action=approve_application&student_id='.$this->student_id.'"> Approve</a></li>';

                   // check couresReg
					/*
                   if( $this->checkCourseRegAproved() )
                        $action_list .= '<li>Course registration approved.</li>';
                    else if( $this->course_registration_request == 0 ){
                        $action_list .= '<li>Awaiting Student Registration.</a></li>';
                    } else {
                        $action_list .= '<li><a href="'.COE_URL.'/admin/index.php?action=approve_registration&student_id='.$this->student_id.'">Approve Course Registration</a>';
                    }
					*/
					
					
					
					 $action_list .= '<li>'.$this->courseRegStatus().'</li>';
					
					
					
					
					
					if( AUTO_MATRICULATION )
						$action_list .= '<li><a href="'.COE_URL.'/admin/index.php?action=generate_matric&student_id='.$this->student_id.'" onclick="return confirm(\'Are you sure you want to generate a new matric number for '.$this->firstname.' '.$this->surname.'?\')"> Generate Matric</a></li>';
					
					$action_list .= '<li><a href="'.COE_URL.'/admin/index.php?action=change_student_department&student_id='.$this->student_id.'"> Modify Department</a></li>';
					
					if( MEDICAL_RECORDS_ACTIVE )
						$action_list .= '<li><a href="'.COE_URL.'/admin/index.php?action=medical&student_id='.$this->student_id.'">Modify Medical Record</a></li>';
					
					
					$action_list .= '<li><a href="'.COE_URL.'/admin/index.php?action=communicate&matric='.$this->matriculation_no.'">Send Message</a></li>';
					$action_list .= '<li><a href="'.COE_URL.'/admin/index.php?action=change_level&student_id='.$this->student_id.'"> Change Student Class</a></li>';
					
					$action_list .= '<br />';
					
               }
				
				
                // TODO:  this out into a different function
				if( $current_user['group_id'] == 1 ) {
                    if( $this->approving_admission_unit_id == 0 ){
                        //$link .= '<li>'.'<a href="?action=approve_application&student_id='.$this->student_id.'">Approve Application</a>'.'</li>';
                        //$link .= '<li>'.'<a href="?action=reject_application&student_id='.$this->student_id.'">Reject Application</a>'.'</li>';
                        
                        $link .= '<p class="approve">';
                        $link .='<a href="'.COE_URL.'/admin/index.php?action=approve_application&student_id='.$this->student_id.'">Approve Application&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></p>';
                        $link .= '<p class="reject">';
                        $link .='<a href="'.COE_URL.'/admin/index.php?action=reject_application&student_id='.$this->student_id.'">Reject Application&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></p>';

                    } elseif($this->approving_admission_unit_id > 0 ){
                        $link .= '<p class="reject">';
                        $link .='<a href="'.COE_URL.'/admin/index.php?action=reject_application&student_id='.$this->student_id.'">Reject Application&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></p>';
                    } else{
                       $link .= '<p class="approve">';
                        $link .='<a href="index.php?action=approve_application&student_id='.$this->student_id.'">Approve Application&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></p>';
                        $link .= '<p class="reject">';
                        $link .='<a href="'.COE_URL.'/admin/index.php?action=reject_application&student_id='.$this->student_id.'">Reject Application&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></p>';
                    }

                    if( $this->course_registration_request == 1 && $this->dean_course_approval_id == 0 && $this->hod_course_approval_id == 0){
                        $link .= '<p class="approve">';
                        $link .='<a href="'.COE_URL.'/admin/index.php?action=approve_registration&student_id='.$this->student_id.'">Approve Course Registration&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></p>';
                  
                        $link .= '<p class="reject">';
                        $link .='<a href="'.COE_URL.'/admin/index.php?action=expunge_registration&student_id='.$this->student_id.'">Expunge Course Registration for session.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></p>';

                    }


		/*} else if ( $current_user['group_id'] == 2 ){
                    if( $this->apply_faculty_approval_id == 0 ){
                        $link .= '<li>'.'<a href="?action=faculty_approve_application&student_id='.$this->student_id.'">Approve Application</a>'.'</li>';
                        $link .= '<li>'.'<a href="?action=faculty_reject_application&student_id='.$this->student_id.'">Reject Application</a>'.'</li>';
                    }elseif($this->apply_faculty_approval_id >0 ){

                        $link .= '<li>'.'<a href="?action=faculty_reject_application&student_id='.$this->student_id.'">Reject Application</a>'.'</li>';
                    }else{
                        $link .= '<li>'.'<a href="?action=faculty_approve_application&student_id='.$this->student_id.'">Approve Application</a>'.'</li>';
                        $link .= '<li>'.'<a href="?action=faculty_reject_application&student_id='.$this->student_id.'">Reject Application</a>'.'</li>';
                    }
                    if( $this->approving_faculty_member_id == 0 ){
                        $link .= '<li>'.'<a href="?action=approve_screening&student_id='.$this->student_id.'">Approve Screening</a>'.'</li>';
                        $link .= '<li>'.'<a href="?action=reject_screening&student_id='.$this->student_id.'">Reject Screening</a>'.'</li>';
                    }elseif($this->approving_faculty_member_id >0 ){
                        $link .= '<li>'.'<a href="?action=reject_screening&student_id='.$this->student_id.'">Reject Screening</a>'.'</li>';
                    }else{
                        $link .= '<li>'.'<a href="?action=approve_screening&student_id='.$this->student_id.'">Approve Screening</a>'.'</li>';
                        $link .= '<li>'.'<a href="?action=reject_screening&student_id='.$this->student_id.'">Reject Screening</a>'.'</li>';
                    }

		}else if ( $current_user['group_id'] == 4 ){
                    if( $this->approving_hod_id == 0 ){
                        $link .= '<li>'.'<a href="?action=hod_approve_application&student_id='.$this->student_id.'">Approve Application</a>'.'</li>';
                        $link .= '<li>'.'<a href="?action=hod_reject_application&student_id='.$this->student_id.'">Reject Application</a>'.'</li>';
                    }elseif($this->approving_hod_id >0 ){
                        $link .= '<li>'.'<a href="?action=hod_reject_application&student_id='.$this->student_id.'">Reject Application</a>'.'</li>';
                    }else{
                        $link .= '<li>'.'<a href="?action=hod_approve_application&student_id='.$this->student_id.'">Approve Application</a>'.'</li>';
                        $link .= '<li>'.'<a href="?action=hod_reject_application&student_id='.$this->student_id.'">Reject Application</a>'.'</li>';
                    }

                    //check if student has resquested a department change
                    $deptChange = $this->getDepartmentChange();
                    if(  $deptChange ){
                        $link .= '<li>'.'<a href="?action=approve_department_change&student_id='.$this->student_id.'">Approve department change</a>'.'</li>';
                    }

		}*/
            }
	
            $i=0;
            if( !empty( $credentials ) ){
                foreach( $credentials as $cre )
                {
                  $cre_link = '';
				  if( !$_SESSION['studentUserID'] )
					$cre_link = '<a href="'.COE_URL.'/admin/index.php?action=delete_credential&student_id='.$_REQUEST['student_id'].'&credential='.$cre.'" class="icon" ><img class="icon" src="'.COE_URL.'/media/delete.png" alt="delete credential" title="delete credential" /> </a>';	
				 
				 if( trim( $cre ) != '' )
                    $credential_html_wrapper .='<li><a href="'.CREDENTIAL_URL.$cre.'" target="_blank"><img src="'.CREDENTIAL_URL.'thumbnails/'.$cre.'" alt="credential'.$i.'" title="credential '.$i.'" /></a><span>credential '.$i.'
					</span><br>
					'.$cre_link.'
					</li>';
                  $i++;
                }
            }
			
			
             //get student's institutions attended
             $this->getInstitututionsAttended();

				
			 
                $institutions_out .='
                                     <tr>
                                    <td colspan="2">
                                    <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <th class="col1" colspan=2 width="33%"> School Name </th>
                                        <th class="col1" width="33%"> From <span class="note"></span></th>
                                        <th class="col1" width="33%"> To <span class="note"></span></th>
                                   </tr>';
                  $i=1;
               if( !empty( $this->institutions ) ){
			   	foreach( $this->institutions as $inst){
                  $institutions_out .='<tr>
                                            <td class="col1"> '.$i.'</td>
                                            <td class="col1">'.$inst[institution_name].'</td>
                                            <td class="col1">'.$inst[start_date].'</td>
                                            <td class="col1">'.$inst[end_date].'</td>
                                    </tr>';
                      $i++;
                      }
                }
                     $institutions_out .='</table>';

            //get student's Olevel exam details
            $this->getOlevelExams();
            if(!empty($this->exams))
            {
                $i=0;
                    foreach($this->exams as $ex)
                    {

                        if( $ex['exam_name'] != '' ){
                            if( $i == 0 )
                                $exam_out .= '<tr>';
                            else if( $i % 2 == 0 )
                                $exam_out .= '</tr><tr>';

                            $exam_out .= '<td valign="top">


                                                <table class="miniTable">
                                                        <tr>
                                                        <td colspan="2" class="tdPadding"><p><strong>'.$ex['exam_name'].'</strong></p></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="formLabel tdPadding" valign="top"><span>Exam Num</span></td><td class="formBox"><span>'.$ex['exam_no'].'</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="formLabel tdPadding" valign="top"><span>Exam Date</span></td><td class="formBox"><span>'.$ex['exam_date'].'</span></td>
                                                    </tr>
                                                           <td class="formLabel tdPadding" valign="top"><span>Exam Center</span></td><td class="formBox"><span>'.$ex['exam_center'].'</span></td>

                                                    <tr>
                                                        <th class="tbTitle">Subject</th>
                                                        <th class="tbTitle">Grade</th>
                                                    </tr>';


                                $results = $this->getExamResult( $ex['exam_id'] );
                                $countResult = 0;
                                if( $results && !empty( $results ) )
                                    foreach( $results as $r )

                                    {
                                          if( $r['subject_name'] != '' ){
                                                $exam_out .=             ' <tr>
                                                            <td class="formLabel tdPadding" valign="top">'.$r[subject_name].'</td><td class="formBox"><span>'.$r[subject_grade].'</span></td>
                                                        </tr>
                                                               ';
                                                 $countResult++;
                                          }
                                    }

                                   $exam_out .= '
                                                    <tr>
                                                        <td class="tdPadding"><span><strong>Total Subject</strong></span></td><td class="formBox"><span><strong>'. $countResult.'</strong></span></td>
                                                    </tr>
                                        </table>
                                        </td>';

                            if( $i == ( count( $row ) - 1 ) )
                                $exam_out .= '</tr>';

                            $i++;
                        }
                    }
            }
			
			

                $dept = new Department( $this->department_id );
                $dept->setDepartment();

				
               $content = '<div id="wrapper">
                    <div id="content">
                    <h3 class="tab" title="General Student Information"><div class="tabtxt"><a href="#">'.GENERAL_INFO_TAB.'</a></div></h3>';
               
               //include_once('../config/global_group_container.inc' );
			   $group_container = array();
               global $group_container;
               
                   
				
				if( $this->clearance_lock )
					$clearance_lock_str = ' <tr>
                                                    <td class="formLabel tdPadding" valign="top" colspan=2><span class="note red">** Student Clearance Locked *** </span></td>

                                                </tr>';

			   	
				//$attendance_tab = '<div class="tab"><h3 class="tabtxt" title="Attedance"><a href="#"> Attendance </a></h3></div>	';	
				
				$my_level = new Level( $this->level_id );		
			
				$payment_tab = '';
				if( $this->checkAdmissionAproved() )
					$payment_tab = '<div class="tab"><h3 class="tabtxt" title="Payments"><a href="#">'.PAYMENT_TAB.'</a></h3></div>	';
				

				$assess_tab = '';
				$courses_tab = '';
				if( $this->checkAdmissionAproved() ){
					$assess_tab = '<div class="tab"><h3 class="tabtxt" title="Courses and Assessments"><a href="#">'.ASSESSMENT_TAB.'</a></h3></div>';
					$courses_tab = '<div class="tab"><h3 class="tabtxt" title="Courses and Assessments"><a href="#"> COURSES </a></h3></div>';	
				
				}
				
               $content .= '<div class="tab"><h3 class="tabtxt" title="Contact Information"><a href="#">'.CONTACT_INFO_TAB.'</a></h3></div>';
			   $content .= '<div class="tab"><h3 class="tabtxt" title="Attedance"><a href="#"> Attendance </a></h3></div>';	
				if( $_SESSION['userID'] )
					$content .= '<div class="tab"><h3 class="tabtxt" title="Assessments"><a href="#">'.ASSESSMENT_TAB.'</a></h3></div>';	
				$content .= '
			   
                    <div class="boxholder">
                            <div class="box">
                                    <p>
                                    <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td rowspan="2" class="tbTitle" valign="top"><img src="'.PASSPORT_URL.$this->photo.'" class="imageThumb" alt="passport" width="120px" />
                                                
                                               
                                                <br />
                                                <br />
                                               
                                                <div class="admin_option_student_profile">
                                                        <ul>
                                                                '.$action_list.'
                                                        </ul>
                                                </div></div>
                                            </td>




                                            <td valign="top">
                                            <table>
											'.$clearance_lock_str.'
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.NAME_LABEL.' </td><td class="formBox"><span>'.$this->firstname.' '.$this->othernames .' '.$this->surname .'</span></td>

                                                </tr>

                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.POSTAL_ADDRESS_LABEL.' </td><td class="formBox"><span> '.$this->postal_address .'</span></td>

                                                </tr>';
												
												/*<tr>
                                                    <td class="formLabel tdPadding" valign="top">'.RESIDENTIAL_ADDRESS_LABEL.' </td><td class="formBox"><span> '.$this->residential_address .'</span></td>
                                                </tr>*/
												
										$ses_sem_string = '-';
										if( $this->academic_session ){
											$ses_sem_string = $this->academic_session; 
											if( $this->semester == 3 ) $ses_sem_string .= ', 3rd Term.';
											else if( $this->semester == 2 ) $ses_sem_string .= ', 2nd Term.';
											else if( $this->semester == 1 ) $ses_sem_string .= ', 1st Term.';
													
										}
										
										$content .= '
												<tr>
                                                    <td class="formLabel tdPadding" valign="top">'.PHONE_NO_LABEL.' </td><td class="formBox"><span>'.$this->phone_no .'</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.EMAIL_ADDRESS_LABEL.' </td><td class="formBox"><span>'.$this->email .'</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="tdPadding"><br /><strong>'.PERSONAL_INFORMATION_TITLE.'</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.DOB_LABEL.' </td><td class="formBox"><span>'.$this->dob .'</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.STATE_OF_ORIGIN_LABEL.' </td><td class="formBox"><span>'.$this->state_of_origin .'</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.LGA_LABEL.'</td><td class="formBox"><span>'.$this->lga .'</span></td>
                                                </tr>
                                               
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.NATIONALITY_LABEL.'</td><td class="formBox"><span>'.$this->nationality .'</span></td>
                                                </tr>
                                               
                                                <tr>
                                                    <td colspan="2" class="tdPadding"><br /><strong>'.SCHOOL_INFORMATION_TITLE.'</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.MATRIC_NUMBER_LABEL.'</td><td class="formBox"><span>'.$this->matriculation_no.'</span></td>
                                                </tr>
												 
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">Class</td><td class="formBox"><span>'.$my_level->getLevelName().
													$this->class.'</span></td>
                                                </tr>
												
												<tr>
                                                    <td class="formLabel tdPadding" valign="top">'.HOUSE_LABEL.'</td><td class="formBox"><span>'.$this->house.'</span></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top"> '.DEPARTMENT_LABEL.' </td><td class="formBox"><span>'.$dept->name.'</span></td>
                                                </tr>
												'.$password_text.'
												 <tr>
                                                    <td class="formLabel tdPadding" valign="top"> Last Registration </td><td class="formBox"><span>'.$ses_sem_string.'</span></td>
                                                </tr>
												
												<tr>';
						

			
						$hostel = new Hostel();
						$hostel->setStudentId( $this->student_id );
						$hostel_alloc = $hostel->retrieveHostelWithStudentId();
						//print_r( $hostel_alloc );
						if( !$hostel_alloc )
							$hoscomment = 'No rooms booked';
						else { 
							$hostel->setBlockId( $hostel_alloc->block_id );
							$hostel->retrieveHostelBlock();
							if( $hostel_alloc->approved_by ) 
								$hoscomment = 'Allocated to '.$hostel->block_name . ', ' .$hostel_alloc->name;
							else
								$hoscomment = 'Booked '.$hostel->block_name . ', ' .$hostel_alloc->name .' (Awaiting approval)';
						}
						
						$content .= '							
									<tr><td colspan="2" class="tdPadding"><br /><strong>Hostel Allocation</strong></td>
                                                </tr>
                                               
												 <tr>
                                                    <td class="formLabel tdPadding" valign="top"> Hostel</td><td class="formBox"><span>'.$hoscomment.'</span></td>
                                                </tr>';
						
					
				
						
							$content .= '							
                                                    <td colspan="2" class="tdPadding"><br /><strong>'.MEDICAL_RECORD_TITLE.'</strong></td>
                                                </tr>
                                               '.$medical_status_str.'
												 <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.MEDICAL_COMMENT_LABEL.'</td><td class="formBox"><span>'.$medcomment.'</span></td>
                                                </tr>';
												
						$content .= '
                                            </table>
                                        </td>
                                        </tr>

                                    </table>
                                    </p>
                            </div>';

                      $content .= '
                            <div class="box">
                                    <p>
                                     <table class="stdTable" cellpadding="0" cellspacing="0" border="0">';
                                               
								$content .= '
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.FATHER_NAME_LABEL.' </td><td class="formBox"><span>'.$this->father_name .'</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.OCCUPATION_LABEL.' </td><td class="formBox"><span>'.$this->father_occupation .'</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.RESIDENTIAL_ADDRESS_LABEL.' </td><td class="formBox"><span>'.$this->father_address .'</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="formLabel tdPadding" valign="top">'.PHONE_NO_LABEL.'</td><td class="formBox"><span>'.$this->father_phone_no.'</span></td>
                                                </tr>';
												
												
                                $content .= '  </table>
                                    </p>
                            </div>';
				
						
                      $content .= '
                            <div class="box">';
							
					$attend = new Attendance( $this->student_id );
					$content .= $attend->showStudentAttendance();
					$content .= '</div>';		

					
					if( $_SESSION['userID'] ) {
						$content .= '
								<div class="box">';
						$content .= $this->printCumulativeVertical();
						$content .= '</div>';				
					}	
					
					
					$default_session = ( isset( $_SESSION['be_academic_session'] ) ) ? $_SESSION['be_academic_session'] : CURRENT_ACCADEMIC_SESSION;
                          	
			
			
			
			// course registration			
			$content .= '
				</div>	
            </div>
            </div>
		<script type="text/javascript">
			Element.cleanWhitespace(\'content\');
			init();
		</script>';

            return $content;
        }

	
		
		

	// @author Babagana Usman
	// https://babscorder.github.io	
	//Displays position of a student In a class or Level		        
	function print_postion_in_class($position){


			switch($position){
						case 1:
						
						return $position_str = $position .'<sup>st</sup>';
						break;
						case 2:
						
						return $position_str = $position .'<sup>nd</sup>';
						break;
						
						case 3:
						
						return $position_str = $position .'<sup>rd</sup>';
						break;
						
						default:
						
						return $position_str = $position .'<sup>th</sup>';
						
						}


			}		
		
		
		
		// show result for entrance exam
		function printPreEntryResults()
		{
			
			$course = new course( PRE_ENTRY_COURSE_ID );
	        $course->getCourse();
			
			$course->setSession( $this->date_of_entry );
	        $assess = new assessment();
	        $assess->setCourseId( $course->id );
	        $assess->setSession( $this->date_of_entry );
			
			$myassess = $assess->getAssessments();
			$i = 0;
			foreach( $myassess as $ma ){
				
				$result = new Result( 0, $ma[id], $this->student_id );
				$score = $result->getStudentAssessmentScore();
				if( $score ){
					$score_array[$i][title] = $ma['title'];
					$score_array[$i][score] =  $score;
					$score_array[$i][remark] = $result->remark;
					$i++;					
				}	
			}
			
			
			if( empty( $score_array ) || !$course->resultPublished() )
				return FALSE;
			
			$student =  $this->getStudent();
	        $studentlevel = new Level( $student['level_id'] );
	        if( $student['level_id'] && $student['level_id'] )
				$current_level = $studentlevel->getLevelDetails();
	        
			$sub_combo = $course->getSubjectCombo();
	
	        $dept = new Department( $this->department_id );
	        $dept->setDepartment();
	
	        $fac = new Faculty( $this->faculty_id );
	        $fac->setFaculty();
	        
			$file = fopen(PRE_ENTRY_RESULT_TEMPLATE, 'r');
			$theData = @fread($file, filesize(PRE_ENTRY_RESULT_TEMPLATE));
			@fclose($file);
			
			$institution = 'INSTITUTION_NAME';
			
			$placeholders = array("{INSTITUTION}", "{firstname}", "{othernames}", "{surname}", "{matriculation_no}", "{state}", "{faculty}", "{department}", "{dob}", "{photo}");
            $values   = array( $institution, $student['firstname'], $student['othernames'], $student['surname'], $student['matriculation_no'], $student['state_of_origin'], $fac->name, $dept->name, $student['dob'], PASSPORT_URL.$student['photo'] );
			
			$content = str_replace($placeholders, $values, $theData);
			$start_pos = strpos( $content, '{%result}' );
			$end_pos = strpos( $content, '{/%result}' );
			$length = $end_pos - $start_pos - 9;
			$sub = substr( $content, ($start_pos+9), $length );
			
			foreach( $score_array as $sa ){
				$placeholders_b = array("{assessment_name}", "{assessment_score}", "{assessment_remark}" );
				$values_b   = array( $sa[title], $sa['score'], $sa['remark'] );
				$result_content .= str_replace($placeholders_b, $values_b, $sub );
			}
			$without_result = substr( $content, 0,  $start_pos );
			
			// TODO: USE preg replace.
			return $without_result . $result_content . '</table>';
			
		}
		
		
		// print the cumulative result for a particular student horizontally
		function printCumulativeResults()
        {
			
			$student =  $this->getStudent();
			
			$course = new course();
	        $sub_combo = $course->getSubjectCombo();
			
			$studentlevel = new Level( $student['level_id'] );
			
	        if( $student['level_id'] && $student['level_id'] )
				$current_level = $studentlevel->getLevelDetails();
			
			
			$dept = new Department( $this->department_id );
	        $dept->setDepartment();
	
	        $fac = new Faculty( $this->faculty_id );
	        $fac->setFaculty();
			
			$res = new Result();
			
			$cumulative_cu_gpt = 0;
			$cumulative_unit = 0;
			
			$PG = new PowerGraphic;
			
			$s_out = "\n".'	<div class="long_box floatleft"><div class="heading"> '.STATEMENT_OF_RESULT_HEADING.
					$student[firstname].' '.strtoupper( $student[surname] ).', '.$student[othernames].' </div></div>';
			
			$s_out .= "\n".'
			   
                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                   ';
			
			$s_out .= '<tr>
                            
							<td colspan="2" class="formLabel">'.SUBJECT_COMBO_LABEL.':</td>
                         	<td colspan="3" class="tbTitle">'.$sub_combo.'</td>
							 <td rowspan="5" class="tbTitle" valign="top"><img src="'.PASSPORT_URL.$student[photo].'" class="imageThumb" alt="passport" width="120px" height="120px" />

                        </tr>';
					
			$s_out .= '<tr>
                            <td colspan="2" class="formLabel">'.MATRIC_NUMBER_LABEL.':</td>
                            <td colspan="3" class="tbTitle">'.$student[matriculation_no].'</td>
                        </tr>';
				
			
			$s_out .= '<tr>
                            <td colspan="2" class="formLabel">'.COURSE_YEAR_LABEL.':</td>
                            <td colspan="3" class="tbTitle">'.$current_level[name].'</td>
                        </tr>';

			$s_out .= '<tr>
                            <td colspan="2" class="formLabel">'.DEPARTMENT_LABEL.':</td>
                            <td colspan="3" class="tbTitle">'.$dept->name.'</td>
                        </tr>';
            
			
			//$s_out .='</table>';	
			
			// get current session 
			$as_key = 0;
			global $academic_session;
			foreach( $academic_session as $as )
			{				
				if( $student[academic_session] == $as['name'] )
					break;
				
				//$temp_session[$as_key] = $as['name'];	
				$as_key++;
			}
			
			$cum_gpt = 0;
			$cum_unit = 0;
			$pg_counter = 0;
			
			$total_gpt = 0 ;
			$total_unit = 0;							
			$total_score = 0;
			$total_sub = 0;
			
			for( $k = $as_key; $k >= ASSESSMENT_START_LEVEL; $k-- ){
				
				$td1 = '';
				$td2 = '';
				$td3 = '';
				$gp_table = '';
				$gp_sem_head = '';
				$td_cu = '';
				$td_st = '';
				
				$res_tab .= '<br /><br /><table  class="stdTable withBorders" cellpadding="0" cellspacing="0" border="1">';
				
				$col = array();
				$col_counter = 0; 
				$all_cols = 0;
					
				
				$ji = 0;
				for( $se = 1; $se <= NUMBER_OF_SEMESTER; $se++ ){
					
					$gp_sem_head = $td1 = $gp_ses_head = $td_cu = $td_st = $td2 = $td3 = '';
					
					$semcourses = $this->getSessionSemesterCourses( $academic_session[$k]['name'], $se );
					$col_counter = 0;
					$sem_gpt = 0; $sem_unit = 0;
					$sem_total = 0;
					$sem_subj = 0;
					
					if( !empty( $semcourses ) )
					{
						
						foreach( $semcourses as $s2 )
						{
							$crs = new course( $s2[course_id] );
							$crs->getCourse();
							$crs->setSession( $academic_session[$k]['name']);
							$j++;
										
							// for this particular course get all the assessments
							$assess = new assessment();
							$assess->setCourseId( $crs->id );
							$assess->setSession( $academic_session[$k]['name'] );
							
							//
							if( $crs->id ){
								
								if( $crs->resultPublished() || IGNORE_PUBLISH_RESULT ){	
									$score = $crs->getStudentCumulativeScore( $this->student_id );
									
									if( !$score || $score == 0 || $score == '' ){
										//$score = 0;
										$raw_score = 0;
									} else {
										if( $assess->countUsedWeight() != 0 ){
											$raw_score = $score ;/// $assess->countUsedWeight() * 100;
										}
									}
								
								
									$res->setScore( $score );
									$gpt = $res->gradePoint( $raw_score );
									$total_gpt += ( $gpt * $crs->getMajorUnits() );
									$sem_gpt += ( $gpt * $crs->getMajorUnits() );
									
									if( $score ){
										$total_unit += $crs->getMajorUnits();
										$sem_unit += $crs->getMajorUnits();
										
										$total_score += $raw_score ;
										$sem_total += $raw_score ;
										
										$sem_subj++;
										
										$total_sub++;
									}
								
									$col[$se] = $col_counter++;
								
									$td1 .= '<th class="sem'.$se.' ">'.$crs->course_code.' </th>';
									$td_cu .= '<td class="sem'.$se.' ">'.$crs->getMajorUnits().' </td>';
									$td_st .= '<td class="sem'.$se.' ">'. $res->getAlphaGrade( $raw_score ).' </td>';
									$td2 .= '<td class="sem'.$se.' ">'.$raw_score.' </td>';
									$td3 .= '<td class="sem'.$se.' ">'.$gpt.' </td>';
									$all_cols++;
									$td_empty = FALSE;
								} else {
									$td1 .= '<th class="sem'.$se.' ">'.$crs->course_code.' </th>';
									$td_cu .= '<td class="sem'.$se.' ">'.$crs->getMajorUnits().' </td>';
									$td_st .= '<td class="sem'.$se.' "> - </td>';
									$td2 .= '<td class="sem'.$se.' "> - </td>';
									$td3 .= '<td class="sem'.$se.' "> - </td>';
									$all_cols++;
									$td_empty = FALSE;
								
								
								}
							}
							//					
						}
					} else {
						$td_empty = TRUE;
					}
					
					if( !$td_empty ){
						
						$gp_sem_head .= '<tr><td></td>';
						$gp_sem_head .= '<th class="sum">Total/Avg</th></tr>';	
						
						$ji++;
						if( $ji == 1 )
							$gp_ses_head = '<tr><th class="tbHeading" colspan="'.($all_cols+2).'" >'.$academic_session[$k]['name'].' '.SESSION_LABEL.' </th></tr>'	;
						
						$gp_table .=  
							$gp_ses_head .
							$gp_sem_head . '
							<tr class="c_code" > <td>Course Code</td>'.$td1.'<td class="sem'.$se.'"></td></tr>
							<tr class="c_code" > <td>Credit Unit</td>'.$td_cu.'<td class="sem'.$se.'">'.$sem_unit.'</td></tr>
							<tr class="c_code" > <td>Status</td>'.$td_st.'<td class="sem'.$se.'" >'.round( ($sem_gpt ), 2).'</td></tr>
							<tr class="c_score"> <td>Raw Score</td>'.$td2.'<td class="sem'.$se.'"></td></tr>
							<tr class="c_gpt"> 	<td>G. Pt</td>'.$td3.'<td class="sem'.$se.'" >'.round( ( $sem_gpt / $sem_unit ), 2 ).'</td></tr>
						';	
						
						
						
						// TODO: REMOVE ME
						
						$my_gp_x[$pg_counter] = $academic_session[$k]['name'] . ' S'. $se;
						$my_gp_y[$pg_counter] = round( ($sem_gpt / $sem_unit ), 2 );
						
						$pg_counter++;
					}
					
				}
				
				if( !$td_empty ){
					$cum_gpt += $total_gpt;
					$cum_unit += $total_unit;	
				}
			
				$res_tab .= $gp_table . '</table>';			
			}
			
			
			
			$sheet_out = '<table>';	
			
			$sheet_out = '</table>';
						
			$cgpa = $cum_gpt / $cum_unit;
			
			$s_out .= '<tr>
                            <td colspan="2" class="formLabel"><B>'.CGPA_LABEL.':</B></td>
                            <td colspan="3" class="tbTitle"><B>'.round( $cgpa, 2 ).'</B></td>
                        </tr>';
            
			
			$s_out .='</table>';
			
			$out .= $s_out . $res_tab;
			$out .= '<a href="?action=assessment"> View Results Per Semester</a> </td>';
			
			$ik = 0;
			while( $pg_counter >= 0 )
			{
				if( !empty($my_gp_x[$pg_counter]) && !empty( $my_gp_y[$pg_counter] ) ){
					$PG->x[$ik] = $my_gp_x[$pg_counter];
					$PG->y[$ik] = $my_gp_y[$pg_counter];
					$ik++;	
				}

				
				$pg_counter--;
			}	
				
			//print_r( $PG->x );
			
			$PG->title     = 'Grade Point Total Per Semester';
			$PG->axis_x    = 'Semesters';
			$PG->axis_y    = 'GPT';
			$PG->graphic_1 = 'Current';
			$PG->type      = 4;
			$PG->skin      = 1;
			
			return $out;
		}
		
		
		// print the cumulative results for a student vertically		
		function printCumulativeVertical()
		{
			
			$student =  $this->getStudent();
			$course = new course();
	        
			$studentlevel = new Level( $student['level_id'] );
			
			if( $student['level_id'] && $student['level_id'] )
				$current_level = $studentlevel->getLevelDetails();
			
			
			$dept = new Department( $this->department_id );
	        $dept->setDepartment();
	
	        $fac = new Faculty( $this->faculty_id );
	        $fac->setFaculty();
			
			$res = new Result();
			
			$cumulative_cu_gpt = 0;
			$cumulative_unit = 0;
			
			
			//$PG = new PowerGraphic;
			
			$s_out = "\n".'	<div class="long_box floatleft"><div class="heading"> Worksheet For '.
					$student[firstname].' '.strtoupper( $student[surname] ).', '.$student[othernames].' </div></div>';
			
			$s_out .= "\n".'
			   
                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                   ';
			
			$s_out .= '<tr>
                            
							<td colspan="2" class="formLabel">'.MATRIC_NUMBER_LABEL.':</td>
                         	<td colspan="3" class="tbTitle">'.$student[matriculation_no].'</td>
							 <td rowspan="6" class="tbTitle" valign="top"><img src="'.PASSPORT_URL.$student[photo].'" class="imageThumb" alt="passport" width="120px" height="120px" />

                        </tr>';
					
			$s_out .= '<tr>
                            <td colspan="2" class="formLabel">'.SEX_LABEL.':</td>
                            <td colspan="3" class="tbTitle">'.$student[sex].'</td>
                        </tr>';
			
			$s_out .= '<tr>
                            <td colspan="2" class="formLabel">'.DOB_LABEL.':</td>
                            <td colspan="3" class="tbTitle">'.$student[dob].'</td>
                        </tr>';	
			
			$s_out .= '<tr>
                            <td colspan="2" class="formLabel">Class:</td>
                            <td colspan="3" class="tbTitle">'.$current_level[name].$student['class'].'</td>
                        </tr>';

			$s_out .= '<tr>
                            <td colspan="2" class="formLabel">House:</td>
                            <td colspan="3" class="tbTitle">'.$student[house].'</td>
                        </tr>';
			
			// get current session 
			$as_key = 0;
			global $academic_session;
			foreach( $academic_session as $as )
			{				
				if( $student[academic_session] == $as['name'] )
					break;
				$as_key++;
			}
			
			$cum_gpt = 0;
			$cum_unit = 0;
			$pg_counter = 0;
			
			$total_gpt = 0 ;
			$total_unit = 0;							
			$total_score = 0;
			$total_sub = 0;
			
			$vert_t = '
						<TABLE>
							<tr class="heading_black"> 
								<th> COURSE CODE</th> 
								<th> COURSE TITLE</th> 
								<th> TOTAL SCORE</th>
								<th> TOTAL OBTAINABLE</th>
								<th> GRADE</th>
							</tr>';
			
			//for( $k = $as_key; $k >= ASSESSMENT_START_LEVEL; $k-- ){
			for( $k = ASSESSMENT_START_LEVEL; $k <= $as_key; $k++ ){	
				$td1 = '';
				$td2 = '';
				$td3 = '';
				$gp_table = '';
				$gp_sem_head = '';
				$td_cu = '';
				$td_st = '';
				
				$res_tab .= '<br /><br /><table  class="stdTable withBorders" cellpadding="0" cellspacing="0" border="1">';
				
				$col = array();
				$col_counter = 0; 
				$all_cols = 0;
					
				
				$ji = 0;
				for( $se = 1; $se <= NUMBER_OF_SEMESTER; $se++ ){
					
					$gp_sem_head = $vert_t_r = $td1 = $gp_ses_head = $td_cu = $td_st = $td2 = $td3 = '';
					
					$semcourses = $this->getSessionSemesterCourses( $academic_session[$k]['name'], $se, GENERAL_STUDIES_DEPARTMENT_ID );
					$semcourses_2 = $this->getSessionSemesterCourses( $academic_session[$k]['name'], $se, EDUCATION_DEPARTMENT_ID );
					$col_counter = 0;
					$sem_gpt = 0; $sem_unit = 0;
					$sem_total = 0;
					$sem_subj = 0;
					$this_cg = 0;
					$total_this_cg = 0;
					
					global $usergroups;
					$inexamsofficegroup = FALSE;
					if( $_SESSION['userID'] ){
						$this->setStudentId( $_REQUEST['student_id'] );
						$user = new User( $_SESSION['userID'] );
						if( $user->userWithinGroup( $usergroups['exams_office_group'] ) )
							$inexamsofficegroup = true;
					}	
						
					if( !empty( $semcourses ) )
					{
						
						foreach( $semcourses as $s2 )
						{
							$crs = new course( $s2[course_id] );
							$crs->getCourse();
							$crs->setSession( $academic_session[$k]['name']);
							$j++;
										
							// for this particular course get all the assessments
							$assess = new assessment(); 
							$assess->setCourseId( $crs->id );
							$assess->setSession( $academic_session[$k]['name'] );
							$assess->setSemester( $se );
							$usedweight = 0;
							
							if( $crs->id ){
								
								// check if the student has 
								if( $crs->studentHasScore( $this->student_id ) ) {	
									
									if( $crs->resultPublished() || IGNORE_PUBLISH_RESULT || $inexamsofficegroup){	
										$score = $crs->getStudentCumulativeScore( $this->student_id, $se );
										if( !$score || $score == 0 || $score == '' ){
											$raw_score = 0;
										} else {
											$usedweight = $assess->countUsedWeight();
											if( $usedweight != 0 ){
												$raw_score = $score ;/// $assess->countUsedWeight() * 100;
											}
										}
									
									
										$res->setScore( $score );
										$gpt = $res->gradePoint( $raw_score );
										$total_gpt += ( $gpt * $crs->getMajorUnits() );
										$sem_gpt += ( $gpt * $crs->getMajorUnits() );
										$this_cg =  $gpt * $crs->getMajorUnits();
										
										
										if( $score ){
											$total_unit += $crs->getMajorUnits();
											$sem_unit += $crs->getMajorUnits();
											
											$total_score += $raw_score ;
											$sem_total += $raw_score ;
											
											$sem_subj++;
											
											$total_sub++;
											
											$total_this_cg += $this_cg;
										}
									
										$col[$se] = $col_counter++;
										$all_cols++;
										$td_empty = FALSE;
										
										$vert_t_r .= ' 
														<tr>
															<td>'.strtoupper( $crs->course_code ).'</td>
															<td>'.ucwords( strtolower( $crs->course_title ) ).'</td>
															<td>'.round( $raw_score ).'</td>
															<td>'.round( $usedweight ).'</td>
															<td>'.$res->getAlphaGrade( $raw_score ).'</td>
															
														</tr>
													
										';
										
										
										
									} else {
										$all_cols++;
										$td_empty = FALSE;
										$vert_t_r .= ' 
														<tr>
															<td>'.strtoupper( $crs->course_code ).'</td>
															<td>'.ucwords( strtolower( $crs->course_title ) ).'</td>
															<td> UP </td>
															<td> UP </td>
															<td> - </td>														
														</tr>
										';
									
									}
								}	
							}
							//					
						}
					} else {
						$td_empty = TRUE;
					}
					
					
					//// ->
					if( !empty( $semcourses_2 ) )
					{
						
						foreach( $semcourses_2 as $s1 )
						{
							$crs = new course( $s1[course_id] );
							$crs->getCourse();
							$crs->setSession( $academic_session[$k]['name']);
							$j++;
										
							// for this particular course get all the assessments
							$assess = new assessment(); 
							$assess->setCourseId( $crs->id );
							$assess->setSession( $academic_session[$k]['name'] );
							$assess->setSemester( $se );
							$usedweight = 0;
							
							if( $crs->id ){
								
								// check if the student has 
								if( $crs->studentHasScore( $this->student_id ) ) {	
									
									if( $crs->resultPublished() || IGNORE_PUBLISH_RESULT || $inexamsofficegroup){	
										$score = $crs->getStudentCumulativeScore( $this->student_id, $se );
										if( !$score || $score == 0 || $score == '' ){
											$raw_score = 0;
										} else {
											$usedweight = $assess->countUsedWeight();
											if( $usedweight != 0 ){
												$raw_score = $score ;/// $assess->countUsedWeight() * 100;
											}
										}
									
									
										$res->setScore( $score );
										$gpt = $res->gradePoint( $raw_score );
										
										if( $score ){
											
											$total_score += $raw_score ;
											$sem_total += $raw_score ;
											$sem_subj++;
											$total_sub++;
										}
									
										$col[$se] = $col_counter++;
										$all_cols++;
										$td_empty = FALSE;
										
										$vert_t_r_2 .= ' 
														<tr>
															<td>'.strtoupper( $crs->course_code ).'</td>
															<td>'.ucwords( strtolower( $crs->course_title ) ).'</td>
															<td>'.round( $raw_score ).'</td>
															<td>'.round( $usedweight ).'</td>
															<td></td>
															
														</tr>
													
										';
										
										
										
									} else {
										$all_cols++;
										$td_empty = FALSE;
										$vert_t_r_2 .= ' 
														<tr>
															<td>'.strtoupper( $crs->course_code ).'</td>
															<td>'.ucwords( strtolower( $crs->course_title ) ).'</td>
															<td> UP </td>
															<td> UP </td>
															<td> - </td>														
														</tr>
										';
									
									}
								}	
							}
							//					
						}
					} else {
						$td_empty_2 = TRUE;
					}
					
					
					
					
					
					
					
					
					
					if( !$td_empty ){
						
						$ji++;
						
						$vert_t .= '<tr><th class="tbHeading sum" colspan="7" >'.$academic_session[$k]['name'].' '.SESSION_LABEL.',  '.SEMESTER_LABEL .' '.$se.'</th></tr>';
						$depar = new Department( GENERAL_STUDIES_DEPARTMENT_ID );
						$mydepar = $depar->getDepartment();
						$vert_t .= '<tr><th class="sem1" colspan=5 style="text-align:center">'.$mydepar['name'].'</th></tr>';
						$vert_t .=  $vert_t_r;
						
						$depar = new Department( EDUCATION_DEPARTMENT_ID );
						$mydepar = $depar->getDepartment();
						$vert_t .= '<tr><th class="sem1" colspan=5 style="text-align:center">'.$mydepar['name'].'</th></tr>';
						$vert_t .=  $vert_t_r_2;
						
						
						
					}
					
				}
				
				if( !$td_empty ){
					
					$cum_gpt += $total_gpt;
					$cum_unit += $total_unit;	
				}
			
				
				$res_tab .= $gp_table . '</table>';			
			}
			
			
			$s_out .='</table>';
			$s_out .= "\n".'<br /><br />	<div class="long_box floatleft" style="text-algin: left;" >**DISCLAIMER: <i> 
							Results shown below are not guaranteed to be accurate, complete or correct. Students are adviced to verify results with the
							respective authority in '.INSTITUTION_NAME.'. Students are expected to collect and use officially stamped results for any official matters. 
							</i> 
							</div><br /><br /><a href="#" id="print_assessemt" onclick="window.print();return false;"><img src="'.COE_URL.'/media/print.png" border=0></a>';
							
			$vert_t .= '
						</TABLE>';
			
			
			$out .= $s_out . $vert_t;
			
			$out .= '<br /><br /><div style="text-align: left; float: left">UP: Unpublished Result.</div>';
			
			return $out;
		
		}		
			
		
		// display the master sheet of result based on set parameters
		function resultMaster( $level_id, $semester, $session, $class = FALSE )
		{
			$lockValue = 0;
	     
			$db = new MySQL();
			$course = new course();

			if (! $db->Open()) {
                $db->Kill();
                return FALSE;
			}
		 
			// get all assessment of the chosen level
			$assess = new Assessment( 0, "", "", "", "", $session, "", "", "", "", "", 0, "", $level_id, $semester );
			$my_asses = $assess->getAssessmentsOfSession();
			$my_courses = $assess->getAssessmentsOfSession( 'course_id' );
			
			// get all the students that took any of these assessments that belongs to the chosen class in the chosen session
			if( !empty ($my_asses ) ){
				$ass_qry = '(';
				foreach( $my_asses as $as )
				{
					if( $j >= 1 )
						$ass_qry .= ' OR ';
					
					$ass_qry .= ' assessment_id='.$as[id];
					$j++;
				}
				$ass_qry .= ')';
				if( $class )
					$wheresql = " AND class='".$class."'";	
					
				
				$my_sql = "SELECT * FROM ".RESULT_TABLE."
						as rs LEFT JOIN ".STUDENT_TABLE." AS st on rs.student_id = st.student_id 
						WHERE " . $ass_qry . $wheresql ." GROUP BY st.student_id ORDER BY matriculation_no";
			
				$db2 = new MySQL();
				if (! $db2->Open()) $db->Kill();
				if (! $db2->Query( $my_sql )) {
					$db2->Kill();
				}
				$student_rows = $db2->RecordsArray();
			}
			
			if( empty( $student_rows ) )
				return '<div class="notice error"> There are no student results found for your search criteria. </div>';
		 
			$out = '<table class="" align="align: center">';
            $out .= '<tr>
                        <th class="heading">S/N</th>
						<th class="heading">ADM. #</th>
						<th class="heading">NAME</th>
						<th class="heading">CLASS</th>';
			
			foreach( $my_courses as $mc ){
				
				$crs = new course( $mc['course_id'] );
				$crs_det = $crs->getCourseDetails( $mc['course_id'] );
				if( $crs_det['department_id'] == GENERAL_STUDIES_DEPARTMENT_ID ){
					$my_crs[] = $mc['course_id']; 
					$out .= '<th class="heading">'.$crs_det['course_code'].'</th>';
				}
			}
			
			$out .= '<th class="heading">Average</th>
						<th class="heading"></th>';
			$out .= ' </tr>';
		 
			if( !empty( $student_rows ) ){
					$i = 1;
					$j = 1;
					foreach( $student_rows as $srow ){
						if( $i%2 == 1 ){
							$row_out[$j]['string'] = '<tr class="odd">';
						} else {
							$row_out[$j]['string'] = '<tr class="">';
						}  
						$i++;	
						$row_out[$j]['string'] .= '
                                <td>'.$j.'</td>
								<td>'. $srow['matriculation_no'] .'</td>
								<td>'. $srow['surname'] .' '.$srow['firstname'].' '.$srow['othernames'].'</td>
								<td>'. $srow['class'] .'</td>
                                ';
						$no_courses = 0;		
						$total_perc  = 0;
						//print_r( $my_crs );
						foreach( $my_crs as $myc ){
							$this->setStudentId( $srow['student_id'] );
							$assess = new assessment();
	               			$assess->setCourseId( $myc );
	               			$assess->setSession( $session );
								
							$crs = new course( $myc );
							$crs->getCourse();
							$crs->setSession( $session );
							
							$score = $crs->getStudentCumulativeScore( $this->student_id, $semester );
							if( !$score )
								$row_out[$j]['string'] .= '<td class="'.$td_class.'"> - </td>';
							else { 
								if( SCORE_IN_PERCENTAGE )
									$perc = round( $score, 0).'%';
								else
									$perc = $score;	
									
								$pub_class = '';
									
								if( $crs->resultPublished() || IGNORE_PUBLISH_RESULT ){
									$pub_class = '';
								} else {
									$pub_class = ' unpublished';
								}
								
								$row_out[$j]['string'] .= '<td class="'.$td_class.$pub_class.'" >'.$perc.' </td>';
								$total_perc += $perc;
								$no_courses++;
							}
							//
						}	
						
						
						
						$res = new Result();
						$myres = $res->getResultComment( $srow['student_id'], $_REQUEST['academic_session'], $_REQUEST['semester'] );
						
						
						$comment_sofar = '';
						if( $myres[principal] && trim( $myres[principal] ) != '' )
							$comment_sofar = '&nbsp;&nbsp;<img src="'.COE_URL.'media/p.png" alt="Principal comment added" title="Principal comment added" >';
						
						if( $myres[house] && trim( $myres[house] )!= '' )
							$comment_sofar .= '&nbsp;&nbsp;<img src="'.COE_URL.'media/h.png" alt="House master comment added" title="House master comment added" >';
							
						if( $myres['class'] && trim( $myres['class'] ) != '' )
							$comment_sofar .= '&nbsp;&nbsp;<img src="'.COE_URL.'media/t.png" alt="Teacher comment added" title="Teacher comment added" >';	
						
						
						
						$row_out[$j]['average'] = round( ($total_perc/$no_courses), 0 );
						$row_out[$j]['string'] .= '<td class="'.$td_class.$pub_class.'" >'.$row_out[$j]['average'].' </td>';		
						$row_out[$j]['string'] .=  '<td class="'.$td_class.$pub_class.'"><a TARGET="_BLANK" href="?action=result_comment&student_id='.$this->student_id.'&semester='.$_REQUEST['semester'].'&session='.$_REQUEST['academic_session'].'&level_id='.$_REQUEST['level_id'].'&class='.$_REQUEST['class'].'"><img src="'.COE_URL.'/media/alert.png" alt="Add/Edit Comment" title="Add/Edit Comment" ></a>'.$comment_sofar.' </td>';
						
						
					
						$row_out[$j]['string'] .= '</tr>';
						//$out .= $row_out;	
						$j++;
					}
					
					foreach( $row_out as $ro )
						$out .= $ro['string'];	
					
			}		
		 
			 
			 $out .= ' </table>';
			 
			 return $out;		
		}
		
			
		function resultMasterSX( $level_id, $semester, $session, $class = FALSE ) 
		{
			// select all jss or ss courses
			global $jss_subjects;
			global $sss_subjects;
			$subjects = ( $level_id <= 3 ) ? $jss_subjects : $sss_subjects;
			
			// select all the students in the same level as selected level
			// TODO: AND ACADEMIC_SESSION = CURRENT SESSION
			$my_sql = "SELECT * FROM ".STUDENT_TABLE." WHERE level_id ='".$level_id."' ";
			if( $class )
					$my_sql .= " AND class='".$class."'";	
			
			$db2 = new MySQL();
			if (! $db2->Open()) $db->Kill();
			if (! $db2->Query( $my_sql )) {
				$db2->Kill();
			}
			$student_rows = $db2->RecordsArray();
			
			if( empty( $student_rows ) )
				return '<div class="notice error"> There are no student results found for your search criteria. </div>';
		 
			// display table head
			$out = '<table class="" align="align: center">';
            $out .= '<tr>
                        <th class="heading">S/N</th>
						<th class="heading">ADM. #</th>
						<th class="heading">NAME</th>
						<th class="heading">CLASS</th>';
			
			foreach( $subjects as $sub ){
				$crs = new course( $sub );
				$crs_det = $crs->getCourseDetails( $sub );
				$out .= '<th class="heading">'.$crs_det['course_code'].'</th>';
			}
			
			$out .= '<th class="heading">AVG</th>
					<th class="heading">Position</th>
						<th class="heading"></th>';
			$out .= ' </tr>';
			
			$ms_scores = array();
			if( !empty( $student_rows ) ){
					$i = 1;
					$j = 1;
					foreach( $student_rows as $srow ){
						$i++;	
						$ms_scores[$i]['matriculation_no'] = $srow['matriculation_no'];
						$ms_scores[$i]['name'] .= $srow['firstname'].' '.$srow['surname'];
						$ms_scores[$i]['class'] = $srow['class'];
						
						$no_courses = 0;		
						$total_perc  = 0;
						
						foreach( $subjects as $myc ){
							$this->setStudentId( $srow['student_id'] );
							$assess = new assessment();
	               			$assess->setCourseId( $myc );
	               			$assess->setSession( $session );
								
							$crs = new course( $myc );
							$crs->getCourse();
							$crs->setSession( $session );
							
							$cscore = $crs->getStudentCumulativeScore( $this->student_id, $semester );
							
							if( $cscore ){
								$score = $cscore;
								$no_courses++;
							} else 
								$score = 0;
								
							$ms_scores[$i][$myc] = ( $score ) ? $score : 0;;
							
							$total_perc += $score;
							
							
						}
						
						$res = new Result();
						$myres = $res->getResultComment( $srow['student_id'], $_REQUEST['academic_session'], $_REQUEST['semester'] );
						
						
						$comment_sofar = '';
						if( $myres[principal] && trim( $myres[principal] ) != '' )
							$comment_sofar = '&nbsp;&nbsp;<img src="'.COE_URL.'media/p.png" alt="Principal comment added" title="Principal comment added" >';
						
						if( $myres[house] && trim( $myres[house] )!= '' )
							$comment_sofar .= '&nbsp;&nbsp;<img src="'.COE_URL.'media/h.png" alt="House master comment added" title="House master comment added" >';
							
						if( $myres['class'] && trim( $myres['class'] ) != '' )
							$comment_sofar .= '&nbsp;&nbsp;<img src="'.COE_URL.'media/t.png" alt="Teacher comment added" title="Teacher comment added" >';	
						
						$ms_scores[$i]['average'] = ( $total_perc > 0 ) ? round( ( $total_perc/$no_courses ), 0 ) : 0;
						$ms_scores[$i]['link'] = '<a TARGET="_BLANK" href="?action=result_comment&student_id='.$this->student_id.'&semester='.$_REQUEST['semester'].'&session='.$_REQUEST['academic_session'].'&level_id='.$_REQUEST['level_id'].'&class='.$_REQUEST['class'].'"><img src="'.COE_URL.'/media/alert.png" alt="Add/Edit Comment" title="Add/Edit Comment" ></a>'.$comment_sofar;
						
						
						$j++;
					}		
			}

			//$c = 0;	
			foreach ($ms_scores as $key => $row) {
				$positions[$key]  = $row[average];
			}
			array_multisort( $positions, SORT_DESC, $ms_scores );
			
			$c = 1;
			foreach( $ms_scores as $ms ){
			
				$trclass = ( $c%2 == 1 ) ? '<tr class="odd">' : '<tr>';
				
				if( $c == 1 ){
					$current_position = 1;
					$current_position_str = ordinal( $current_position );
				} else if( $ms[average] == $previous_total ){
					$current_position_str = '='.ordinal( $current_position );
				} else {
					$current_position = $c;
					$current_position_str = ordinal( $current_position );
				}	
			
				$out .= '
					<tr>
						<td>'.$c.'</td>
						<td>'.$ms['matriculation_no'].'</td>
						<td>'.$ms['name'].'</td>
						<td>'.$ms['class'].'</td>';
				foreach( $subjects as $myc )
					$out .= '
						<td>'.$ms[$myc].'</td>';
				
				$out .= '
						<td>'.$ms['average'].'</td>
						<td>'.$current_position_str.'</td>
						<td>'.$ms['link'].'</td>';				
				
				$out .= '		
					</tr>';
				
				$previous_total  = $ms[average];
				$c++;
			}	
			
			
			
			
			
			
			
			$out .= '</table>';
			
			return $out;
			
			// iterate through student and display the cumulative score	


		}	
			
			
		/**
		@@ author : Gbenga Adebayo
		TODO: GET RID OFF
		*/
		function countStudentCourses( $department_id ){
         $deleteValue = 0;
     
         $db = new MySQL();
         if (! $db->Open())$db->Kill();
         
         $query = "SELECT cous.course_code,dm_credit_unit, acc.id , scous.course_id FROM ".COURSE_TABLE." AS cous LEFT JOIN ".STUDENT_COURSE_TABLE." AS scous on cous.id = scous.course_id LEFT JOIN ".ASSESSMENT_TABLE." AS acc on cous.id = acc.course_id WHERE scous.student_id =".$this->student_id."  AND department_id = ".$department_id."  AND deleted = ".$deleteValue." GROUP BY course_code ";
         //print_r($query);
         $db->Query( $query );
         if( !$db->Query($query) ) {
             return FALSE;
         }
		 $courses = $db->RowCount();
		 
		  if(empty($courses))
			return FALSE;
		  
		  return $courses;
										
		}
		
		// TODO: GET RID OFF
		// get all courses a student has registered for
		function allStudentCourses()
		{
			 $deleteValue = 0;
		 
			 $db = new MySQL();
			 if (! $db->Open())$db->Kill();
			 
			 //$query = "SELECT cous.course_code,dm_credit_unit, acc.id , scous.course_id, scous.session FROM ".COURSE_TABLE." AS cous LEFT JOIN ".STUDENT_COURSE_TABLE." AS scous on cous.id = scous.course_id LEFT JOIN ".ASSESSMENT_TABLE." AS acc on cous.id = acc.course_id WHERE scous.student_id =".$this->student_id."  AND deleted = ".$deleteValue." GROUP BY course_code ";
			  $query = "SELECT * FROM ".STUDENT_COURSE_TABLE."
                    WHERE student_id='".$this->student_id."'";
			 
			 $db->Query( $query );
			 if( !$db->Query($query) ) {
				 return FALSE;
			 }
			 
			 return $db->RecordsArray();			
		}
		
		// calculate key results and mutate score_average, cumulative_grade_point, total_credit_units, total_subjects
		function setResults()
		{
			$crss = $this->allStudentCourses();
			$count = 0;
			
			$raw_score = 0;
			$total_gpt = 0 ;
			$total_unit = 0;							
			$total_score = 0;
			$total_sub = 0;
			$res = new Result();
			
			foreach( $crss as $cr ){
				$course = new course( $cr['course_id'] );
				$course->getCourse();
				$course->setSession( $cr['session'] ); 
				
				$assess = new assessment();
				$assess->setCourseId( $cr['course_id']);
				$assess->setSession( $cr['session'] );
				
				$score = $course->getStudentCumulativeScore( $this->student_id );
				
				
				if( !$score || $score == 0 || $score == '' ){
					$raw_score = 0;
				} else {
					$raw_score = $score;
				}
				
				$res->setScore( $score );
				$gpt = $res->gradePoint( $raw_score );
				$total_gpt += ( $gpt * $course->getMajorUnits() );
				
				if( $score ){
					$total_unit += $course->getMajorUnits();
					$total_score += $raw_score ;
					$total_sub++;
				}
				
				
			}
			
			$this->score_average = ( $total_score / $total_sub ) ;				// average percentage for student
			$this->cumulative_grade_point = ( $total_gpt / $total_unit );	// Cumulative Grade Point for student	
			$this->total_credit_units = $total_unit;			// current total credit load for student	
			$this->total_subjects = $total_sub;
			
			return( TRUE );	
		}

			
		
		
		
		/*
		 * TODO: GET RID OF
		 * @@ author : Gbenga Adebayo
		 *
		 */
		function getAllStudentScores()
		{
		
			$db = new MySQL();

			if (! $db->Open()) {
                $db->Kill();
                return FALSE;
			}
		   
		    $sql ="SELECT * FROM ".RESULT_TABLE." WHERE student_id=".$this->student_id." ";
			if (! $db->Query( $sql ))
                 $db->Kill();
			 
			$row = $db->RecordsArray();			
	
			return $row;
		}
	
	
		/*
		*
		* TODO: GET RID OF
		* @@ author : Gbenga Adebayo
		*
		*/
		function cumulative(){
			$score = $this->getAllStudentScores();
			$result = new Result();
			$count = 0;
			
			foreach( $score as $sc )
			{
				$gpt = $result->gradePoint( $sc['score'] );
				$count = $count + $gpt;
			}
		
			return( $count );
		}
		
		
		
				
		/*
		 * function adminCummulative to show the cummulative result for a department and a level
		 * @@ author : Gbenga
		 * @@ return : department_id, $level_id
		 *
		 */
		function adminCummulative($department_id, $level_id){

			$course = new course();
			$level = new Level();
			$dept = new Department( $this->department_id );
			$dept->setDepartment();
			
			$res = new Result();
			$cumulative_cu_gpt = 0;
			$cumulative_unit = 0;
			$lockValue = 0;
			
			 $db = new MySQL();
			
			if (! $db->Open()) {
                $db->Kill();
                return FALSE;
			}
		 
			$query = "SELECT * FROM ".STUDENT_TABLE." WHERE department_id=".$department_id." AND level_id=".$level_id." ORDER BY matriculation_no";	   
					
		
			if (! $db->Query( $query )) {
				$db->Kill();
			}
			
			$out = '<table class="" align="align: center">';
            $out .= '<tr>
                        <th class="">ID</th>
						<th class="">NAME</th>
                        <th class="">MATRIC NUMBER</th>';
			
			$cum_gpt = 0;
			$cum_unit = 0;
			
			$out .= '<th class="">AVG %</th>';
			$out .= '<th class="">TNOC</th>';
			$out .='<th class="">TCU</th>';
            $out .='<th>CGPA </th>';
            $out .='<th>Remark</th>';
            $out .= ' </tr>';
			
			$student_rows = $db->RecordsArray();
			
			if( !empty( $student_rows ) ){
				$i = 1;
				$j = 1;
                foreach( $student_rows as $srow ){
					if( $i%2 == 1 ){
                        $out .= '<tr class="dgRowsnormTR">';
                        $td_class = 'dgRownorm';
                    } else {
						$out .= '<tr class="dgRowsaltTR">';
                        $td_class = 'dgRowalt';
                    }  
                    
					$i++;
					
					$out .= '
                                <td>'.$j.'</td>
								<td>'. $srow['surname'] .' '.$srow['firstname'].' '.$srow['othernames'].'</td>
                                <td>'. $srow['matriculation_no'] .'</td>
                                ';
					$j++;
                    $res = '-';
					
					$this->student_id = $srow['student_id'];
					
					
					$this->setResults();
					
					$out .= '<td class="'.$td_class.'">'.round( $this->score_average, 1 ).'</td>';
					$out .= '<td class="'.$td_class.'">'.$this->total_subjects.'</td>';
					$out .= '<td class="'.$td_class.'">'.$this->total_credit_units.'</td>';
					$out .= '<td class="'.$td_class.'">'.round( $this->cumulative_grade_point, 1).'</td>';
					$out .= '<td class="'.$td_class.'"></td>';
					
					$out .= '</tr>';
				}
			} else {
				print_r( 'no students to show you' );
			}
			
			
			
			
			$out .= '</table>';
			 $out .= ' <div class="long_box notice">
							<h3>Legend</h3>
							<p class="note">
							<br />
								<b> TNOC: </b> Total Number of Courses <br />
								<b> TCU: </b> Total Credit Unit <br />
								<b> CGPA: </b> Cumulative Grade Point Average <br />
								
							</p>
						</div>
						';
			
			
			
			return $out;
			
		}
		
		// Display of score sheet for all students within a subject.
		// TODO: MOVE TO COURSE.INC
		function scoreSheet( $course_id, $session, $department_id = 0, $semester = 0 )
		{
			$course = new course();
			$course->setCourseId( $_REQUEST['course_id'] );
            $course->getCourse();
			$course->setSession( $_REQUEST['academic_session'] ) ;
			$course->setSemester( $_REQUEST['semester'] ) ;
			$course->level_id = $_REQUEST['level_id'];
			
			$dept = new Department( $course->department_id );
			$dept->setDepartment();
			
			$fac = new Faculty( $dept->faculty_id );
			$fac->setFaculty();
			
			$lev = new Level( $course->level_id );
			
			$user = new user();
			$head = $user->getUser( $course->course_head_id );
			
			$admin_user = new User( $_SESSION['userID'] );
			$edit_lock = FALSE;
			
			$edit_lock = ( ( $course->resultPublished() || $course->resultReviewed() ) && $_SESSION['userID'] != POWER_EXAMS_OFFICER ) ? TRUE: FALSE;
			
			
			$s_out_1 .= "\n".'
			   <div class="long_box floatleft">
                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                   ';
			
			
			
			$s_out_1 .= '<tr class="gray_row">
                            <td colspan="1" class="formLabel">Level</td>
                            <td colspan="3" class="tbTitle">'.$lev->getLevelName().'</td>
                        </tr>';	
		
			$s_out_1 .= '<tr class="gray_row">
                            <td class="formLabel">Session</td>
                            <td class="tbTitle">'.$_REQUEST['academic_session'].'</td>
							
							<td class="formLabel">Term:</td>
                            <td class="tbTitle">'.$_REQUEST[semester].'</td>
							
                        </tr>';
		
			$s_out_1 .= '<tr class="gray_row">
                            <td class="formLabel">Subject code</td>
                            <td class="tbTitle">'.$course->course_code.'</td>
							
							 <td class="formLabel"></td>
                            <td class="tbTitle"></td>
							
                        </tr>';
						
			$s_out_1 .= '<tr class="gray_row">
                            <td class="formLabel">Subject Title</td>
                            <td class="tbTitle">'.$course->course_title.'</td>
							
							<td class="formLabel">Subject Teacher:</td>
                            <td class="tbTitle">'.$head['userName'].'</td>
							
                        </tr>';			
		
		
			$assessments = $course->getAssessmentsInCourse( $_REQUEST['semester'] );
			
			if( empty( $assessments ) )
				return '<div class="notice error"> There are no stored assessments for this course, for this session. </div>';
			
			$s_out .= '<table class="" align="align: center">';
            $s_out .= '<tr class="green_row">
                        <th class="">S/N</th>
						<th class="">Admission No</th>
						<th class="">Class</th>';
				
			$stud_as = array();
			//$j = 0;
			
			$ass_qry = '(';
			foreach( $assessments as $as ){
				$s_out .= '<th class="">'.$as['title'].'</th>';
				$stud_as[] = $as[id];
				if( $j >= 1 )
					$ass_qry .= ' OR ';
					$ass_qry .= ' assessment_id='.$as[id];
				
				$j++;
			}
			$ass_qry .= ')';
			
			$s_out .= '<th class="">Total</th>';
			$s_out .= '<th class="">Position</th>';
			$s_out .= '<th class="">Grade</th>';
			$s_out .= '<th class="">Remark</th>';
            $s_out .= '</tr>';
			$result_table_head = $s_out;
			
			
			if( $_REQUEST['class'] )
				$wheresql = " AND class='".$_REQUEST['class']."'";		
				
			$my_sql = "SELECT * FROM ".RESULT_TABLE."
						as rs LEFT JOIN ".STUDENT_TABLE." AS st on rs.student_id = st.student_id 
						WHERE " . $ass_qry . $wheresql ." GROUP BY st.student_id ORDER BY matriculation_no";
			
			$db2 = new MySQL();
			if (! $db2->Open()) $db->Kill();
			if (! $db2->Query( $my_sql )) {
				$db2->Kill();
			}
			
			$student_rows = $db2->RecordsArray();
			if( empty( $student_rows ) )
				return '<div class="notice error"> There are no student results for this course, for this session. </div>';

			$i = 1;
			$j = 1;
			
			$total = 0;
			
			global $alpha_grades;
			
			$c = 0;
			$new_grade[$c][value] = 'Defects';
			$new_grade[$c][count] = 0;
			foreach( $alpha_grades as $k=>$ag ){
				$c++;
				$new_grade[$c][value] = $k;
				$new_grade[$c][count] = 0;
				
			}
			
			
			$failed = 0;
			$passed = 0;
			$total_count = 0;
			
			foreach( $student_rows as $srow ){
				$_s_out = '';
				if( $i%2 == 1 ){
					$_s_out .= '<tr class="odd">';
					$td_class = 'dgRownorm';
				} else {
					$_s_out .= '<tr>';
					$td_class = 'dgRowalt';
				}  
				$i++;	
				$scores_row[$i][matriculation_no] = $srow['matriculation_no'];
				$scores_row[$i]['class'] = $srow['class'];	
				
				$_s_out .= '
					<td>'.$j.'</td>
					<td>'. $srow['matriculation_no'] .'</td>
					<td>'. $srow['class'] .'</td>
					';
				$res__ = 0;
				
				$hasResult = FALSE;
				foreach( $stud_as as $a ){
					$result = new result( 0, $a, $srow['student_id'] );
					
					if( $res = $result->getStudentAssessmentScore() )
						$hasResult = TRUE;
						
					$res__ =  round( $res, 0 );
					$_s_out .= '<td>'.$res__.'</td>';
					
					$scores_row[$i][$a] = $res__;
				}
				
				
				$total = $course->getStudentCumulativeScore( $srow['student_id'], $_REQUEST['semester'] );				
				$total__ =  round( $total, 0 );
				$_s_out .= '<td>'.$total__.'</td>';
				$scores_row[$i]['total'] = $total__ ;
				
				
				
				$agrade = $result->getAlphaGrade( $total__ );
				$_s_out .= '<td>'.$agrade.'</td>';
				$scores_row[$i]['alpha'] = $agrade;
				
				$c = 0;
				foreach( $new_grade as $ng ){
					if( $ng[value] == $agrade )
						$new_grade[$c][count]++;
					$c++;
				}	
				
				$total_count++;
				
				$passmark = ( $course->passmark && $course->passmark > 0 ) ? $course->passmark : PASS_MARK;
				
				if( $total >= $passmark  ){
					$remark = 'Passed ' ;
					$passed++;
				} else {
					$remark = 'Failed' ;
					$failed++;
				}
				
				$_s_out .= '<td>'.$remark.'</td>';
				$scores_row[$i]['remark'] = $remark;
				$_s_out .= '</tr>';
				$j++;
				
				if( $hasResult )
					$s_out .= $_s_out;	
			}
			
			$s_out .= '</table>';
			
			
			$s_out_1 .= '<tr class="gray_row" >
                            <td class="formLabel">Passed</td>
                            <td class="tbTitle">'.round( ( $passed / $total_count * 100 ), 0 ).'%</td>
							
							<td class="formLabel">Failed:</td>
                            <td class="tbTitle">'.round( ( $failed / $total_count * 100), 0 ).'%</td>
							
                        </tr>';			
		
			$review = $course->resultReviewed();
			$ruser = new User( $review );
			$reviewer = $ruser->getUser( $review );
			
			if( !$review )
				$s_out_1 .= '<tr class="gray_row">
                            <td colspan=4 class="tbTitle"><i>Have you reviewed the scores for this course? <a href="index.php?action=review_result&session='.$session.'&course_id='. $course_id.'&semester='.$_REQUEST['semester'].'&level_id='. $_REQUEST['level_id'].'"> Mark this score sheet as reviewed now</a></i></td>
                          </tr>';
			else{
				$s_out_1 .= '<tr class="gray_row">
                            <td colspan=4 class="tbTitle"><i>Results Reviewed by '.$reviewer[userName].'. <a href="index.php?action=review_result&unreview=1&session='.$session.'&course_id='.$course_id.'&semester='. $_REQUEST['semester'].'&level_id='. $_REQUEST['level_id'].'"> Change review status.</a></i></td>
                          </tr>';
				if( !$course->resultPublished() )
					$s_out_1 .= '<tr class="gray_row">
                            <td colspan=4 class="tbTitle"><i>Results Unpublished. <a href="index.php?action=publish_result&session='.$session.'&course_id='. $course_id.'&semester='.$_REQUEST['semester'].'&level_id='. $_REQUEST['level_id'].'"> Publish Now </a></i></td>
                          </tr>';
				else
					$s_out_1 .= '<tr class="gray_row">
                            <td colspan=4 class="tbTitle"><i>Results Published . <a href="index.php?action=publish_result&session='.$session.'&course_id='. $course_id.'&semester='.$_REQUEST['semester'].'&level_id='. $_REQUEST['level_id'].'"> UnPublish Now </a></i></td>
                          </tr>';
			
			}			
			$s_out_1 .= '</table>';
			
			
						
			$s_out_2 = '<table>';
			//$s_out_2 .= '<th rowspan=2> Result Analysis';
			//$s_out_2 .= '</th>';
			$s_out_2_r1 .= '<tr>';
			$s_out_2_r2 .= '<tr>';
			$s_out_2_r3 .= '<tr>';
			
			$new_grade = array_reverse( $new_grade );
			foreach( $new_grade as $ngr ){
				$s_out_2_r1 .= '<td>'.$ngr['value'].'</td>';
				$s_out_2_r2 .= '<td>'.$ngr['count'].'</td>';
				$perc = round( ( $ngr['count'] / $total_count * 100 ), 0);
				$s_out_2_r3 .= '<td>'.$perc.'%</td>';
			}
			$s_out_2_r1 .= '</tr>';
			$s_out_2_r2 .= '</tr>';
			$s_out_2_r3 .= '</tr>';
			$s_out_2 .= $s_out_2_r1 . $s_out_2_r2 . $s_out_2_r3;
			$s_out_2 .= '</table>';
			
			
			foreach ($scores_row as $key => $row) {
				$positions[$key]  = $row[total];
			}
			array_multisort($positions, SORT_DESC, $scores_row);
			
			$result_table .=  $result_table_head;
			$current_position = 0;
			$c = 1;
			foreach( $scores_row as $sr_ ){
				
				$trclass = ( $c%2 == 1 ) ? '<tr class="odd">' : '<tr>';
				
					
				
				if( $c == 1 ){
					$current_position = 1;
					$current_position_str = ordinal( $current_position );
				} else if( $sr_[total] == $previous_total ){
					$current_position_str = '='.ordinal( $current_position );
				} else {
					$current_position = $c;
					$current_position_str = ordinal( $current_position );
				}	
				//$current_position_str = $current_position . ' --> ' . $sr_[total] .' - ' .$previous_total ;
				$result_table .=  '
					'.$trclass.'
						<td>'.$c.'</td>
						<td>'.$sr_[matriculation_no].'</td>
						<td>'.$sr_['class'].'</td>
				';
				
				foreach( $stud_as as $a )
					$result_table .=  '
						<td>'.$sr_[$a].'</td>';
			
				$result_table .=  '
						<td>'.$sr_['total'].'</td>
						<td>'.$current_position_str.'</td>
						<td>'.$sr_['alpha'].'</td>
						<td>'.$sr_['remark'].'</td>
					</tr>';
				$c++;
				$previous_total  = $sr_[total];
			}
			$result_table .= '</table>';
			
			
			//return $s_out_1 .'<BR />'. $s_out_2 .'<BR />'. $s_out . '<br />' . $result_table; 
			return $s_out_1 .'<BR />'. $s_out_2 .'<BR />'. $result_table; 			
			$s_out_1 .= '</div>';
		}
		
}
?>