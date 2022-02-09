<?php
/* 
 * Copyright notice
 *
 *  (c) 2012 Ibrahim Mohammed (ibrahim.mohammed@izybrand.com)
 *  All rights reserved
 *
 *  This script is part of the Webleaves Portal. Webleaves Portal is
 *  COPYRIGHTED. The software may not be redistributed and/or modified
 *  without appropriate authorisation from Izy Brand ltd. The use of
 *  the software is subject to terms and conditons indicated
 *  in http://www.izybrand.com
 *
 *  This copyright notice MUST APPEAR in all copies of the script!

 * Created on 15 April 2011
 ***************************************************************/

/**
 * Results class: assessment/result definition, manipulation
 *
 * @author dan
 * 
 */

/*TODO:
 * 
 * 1. function to cummulate all assessment belonging to a course
 * 2. function to compute CGPA
 * 3. function to search for student    //Refer to search from student 
 * 4. function to display individual student result
 * 5. function to display multiple student scores.
 * 
 */


class Result {
   
	var $id;
	var $assessment_id;
	var $student_id;
	var $score;
	var $last_edit;
	var $last_editor_id;
	var $lock;
	var $remark;


    /**
     * constructor for Result class
     *
     */
     function Result ( $id = 0, $assessment_id = 0, $student_id = 0, $score = 0, $lock = 0, $last_edit = '', $last_editor_id = '', $remark = '' )
     {
     	
		$this->id = $id;
     	$this->assessment_id = $assessment_id;
     	$this->student_id = $student_id;
     	$this->score = $score;
     	$this->last_edit = $last_edit;
     	$this->lock = $lock;
     	$this->last_editor_id = $last_editor_id;   
		$this->remark = $remark;
     }
	
	 // mutator	
     function setId( $v ){ $this->id = $v; }
	 function setScore( $v ){ $this->score = $v; }

     /**
     * Description of createNewAssessment:
     * create a new assessment
     *
     * @return a boolean. TRUE for success and FALSE for failure
     * 
     */
     
     function createNewAssessmentScore (){

         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $sql = "INSERT into ".RESULT_TABLE."( student_id, assessment_id, score, lock_score, last_editor_id, remark )
                VALUES( '$this->student_id', '$this->assessment_id', '$this->score', '$this->lock', '$_SESSION[userID]', '$this->remark' )";
		
         
         if (! $db->Query( $sql )) {
            $db->Kill();
            return false;

         }else {
            return true;
         }
     }

     
     /**
     * Description of updateAssessment:
     * create a new assessment
     *
     * @return a boolean. TRUE for success and FALSE for failure
     */
     function updateAssessmentScore (){

         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $query = "UPDATE ".RESULT_TABLE." SET student_id = '".$this->student_id."', assessment_id = '".$this->assessment_id."', student_score = '".$this->student_score."'
                    WHERE id = ".$this->id." AND deleted = 0";
         
         //echo $query;
         if (! $db->Query( $query )) {
            $db->Kill();
            return false;

         }else {
            return true;
         }
     }
	
	

     /**
     * Description of deleteAssessment:
     * delete an assessment
     *
     * @return a boolean. TRUE for success and FALSE for failure
     */
     function deleteAssessmentScore(){

         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $query = "DELETE FROM ".RESULT_TABLE." where student_id = '".$this->student_id."' AND assessment_id = '".$this->assessment_id."'";
         
         if (! $db->Query( $query )) {
            $db->Kill();
            return false;

         }else {
            return true;
         }
     }
         
	// delete all the scores stored for a particular assessment 
     function deleteAllAssessmentScore(){

         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $query = "DELETE FROM ".RESULT_TABLE." where assessment_id = '".$this->assessment_id."'";
         
         if (! $db->Query( $query )) {
            $db->Kill();
            return false;

         }else {
            return true;
         }
     }
		 
     
    /*
	 *
     * Description of getStudentAssessmentScore: get the a student's score for current assessment  
	 * while at the same time mutating this object with the returned score
     *
     * @return a value STUDENT_SCORE
     *
	 */

     function getStudentAssessmentScore(){
        
         $db = new MySQL();
         if (! $db->Open())$db->Kill();

		 if( !$this->assessment_id )
			return FALSE;
		 
         $query = "SELECT * FROM ".RESULT_TABLE." WHERE assessment_id = '".$this->assessment_id."'
            AND student_id = '".$this->student_id."'";
		
         $db->Query( $query );
         if ( ! $db->Query( $query ) )
            $db->Kill();
         
         else {
             $row = $db->RowArray();  		
           
             if( !empty( $row ) ){
             	
             	$this->Result( $row[id], $row[assessment_id], $row[student_id], $row[score], $row[lock_score], 
             					$row[last_edit], $row[last_editor_id], $row[remark] );
             	return $row[score];
             } else 
             	return FALSE;
         }
     }

     /*
	 *
     * Description of getStudentAssessmentScoreDetails: get result row from db for current student and assessment
     *
     * @return a value STUDENT_SCORE
	 *
     */

     function getStudentAssessmentScoreDetails(){
         $deleteValue = 0;

         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $query = "SELECT * FROM ".RESULT_TABLE." WHERE assessment_id = '".$this->assessment_id."'
            AND student_id = '".$this->student_id."' AND deleted = ".$deleteValue;
         
         $db->Query( $query );
         if ( ! $db->Query( $query ) )
            $db->Kill();
         else{
             $row = $db->RowArray();
             return $row;
         }
     }
     
     /*
      * returns the alpha equivalent of the
      * result score
      * 
      */
     function getAlphaGrade( $score = 0  ){
     	
     	
     	
     	global $alpha_grades;
		if( !$score )
			$score = $this->score;
			
		if( trim( $score ) == '' )
			$score = 0;
			
     	$alph = '';
     	foreach( $alpha_grades as $k=>$v ){
     		if( $score  != '' )
	     		if( $v <= round( (double) $score ) ){
	     			$alph = $k;
	     		}
     	}
     	//print_r( $v );
     	return $alph;		
     }
	 
	 
	   /*
      * returns the alpha equivalent of the
      * result score
      * 
      */
     function getAlphaGradeJunior( $score = 0  ){
     	
     	
     	
     	global $alpha_grades_junior;
		if( !$score )
			$score = $this->score;
			
		if( trim( $score ) == '' )
			$score = 0;
			
     	$alph = '';
     	foreach( $alpha_grades_junior as $k=>$v ){
     		if( $score  != '' )
	     		if( $v <= round( (double) $score ) ){
	     			$alph = $k;
	     		}
     	}
     	//print_r( $v );
     	return $alph;		
     }
	 
	 
	 /*
      * returns the comment equivalent of the
      * result score
      * 
      */
     function getGradeRemark( $score = 0  ){
     	
     	
     	
     	global $grade_remark;
		if( !$score )
			$score = $this->score;
			
		if( trim( $score ) == '' )
			$score = 0;
			
     	$alph = '';
     	foreach( $grade_remark as $k=>$v ){
     		if( $score  != '' )
	     		if( $v <= round( (double)$score ) ){
	     			$alph = $k;
	     		}
     	}
     	
     	return $alph;		
     }
	 
	 
	  /*
      * returns the comment equivalent of the
      * result score
      * 
      */
     function getGradeRemarkJunior( $score = 0  ){
     	
     	
     	
     	global $grade_remark_junior;
		if( !$score )
			$score = $this->score;
			
		if( trim( $score ) == '' )
			$score = 0;
			
     	$alph = '';
     	foreach( $grade_remark_junior as $k=>$v ){
     		if( $score  != '' )
	     		if( $v <= round( (double)$score ) ){
	     			$alph = $k;
	     		}
     	}
     	
     	return $alph;		
     }
	 
	 
	 
	 
	 // Get the different comments on a student for a particular session and semester
	 function getResultComment( $student_id, $session, $semester ){
	 
		$db = new MySQL();
			 if (! $db->Open())$db->Kill();
			 
			$sql = "SELECT * FROM ".RESULT_COMMENT_TABLE." WHERE student_id='".$student_id."' AND session='".$session."' 
					AND semester='".$semester."' ";
			
			if( $db->Query( $sql ) )
				return ( $db->RowArray() );
			else
				return FALSE;
	 
	 }
	 
	 // form for setting the different comments on a student for a particular semester and session
	 function resultCommentForm( $student_id, $session, $semester )
	 {
		
		// ensure that the student_id, session are set at the minimum
		if( !$session || !$student_id  )
			return FALSE;
		
		$out .= "\n".'<div class="heading"> Add/Edit Student Comment </div>

                <form action="'.$action.'" method="POST">
                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">';
        
		$princy = file( PRINCIPAL_COMMENT_TEMPLATE, FILE_IGNORE_NEW_LINES);
		$i = 0;
		foreach( $princy as $p ){
			$p_arr[$i]['name'] = $p_arr[$i]['value'] = $p;
			$i++;
		}
		
		$teacher = file( TEACHER_COMMENT_TEMPLATE, FILE_IGNORE_NEW_LINES);
		$i = 0;
		foreach( $teacher as $t ){
			$t_arr[$i]['name'] = $t_arr[$i]['value'] = $t;
			$i++;
		}
		
		$house = file( HOUSE_COMMENT_TEMPLATE, FILE_IGNORE_NEW_LINES);
		$i = 0;
		foreach( $house as $h ){
			$h_arr[$i]['name'] = $h_arr[$i]['value'] = $h;
			$i++;
		}
		
		$comm_arr = $this->getResultComment( $student_id, $session, $semester );;
		$out .= "\n".createTwoColFormLabelSelect( 'Principal Comment', $comm_arr['principal'], 'principal_comment', $p_arr, "", 0, $error['principal_comment'] );
		$out .= "\n".createTwoColFormLabelSelect( 'Teacher Comment', $comm_arr['class'], 'teacher_comment', $t_arr, "", 0, $error['teacher_comment'] );
		$out .= "\n".createTwoColFormLabelSelect( 'House Master Comment', $comm_arr['house'], 'house_comment', $h_arr, "", 0, $error['house_comment'] );
		$out .= '<tr>
                            <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="Save" class="stdButton" value="Save" > </th>
                         </tr>
                        </table>
                            </form>
                    ';
 
		return $out;
	 
	 }
		
	// delete comments on a student for session & semester	
	function deleteResultComment( $student_id, $session, $semester )
	{
		 $db = new MySQL();
			 if (! $db->Open())$db->Kill();
			 
			 if( !$student_id || !$semester || !$session )
				return FALSE;
			  
			 $sql = "DELETE FROM ".RESULT_COMMENT_TABLE." WHERE student_id = '$student_id' AND semester = '$semester' AND session = '$session' ";
			 
			 if ( $db->Query( $sql ) )
				return TRUE;
			 else
				return FALSE;
	
	}
	
	
	// store different comments (ie principal, class head and house master ) in db
		function storeResultComment( $student_id, $session, $semester, $principal, $class, $house )
		{
		
			 $db = new MySQL();
			 if (! $db->Open())$db->Kill();
				
			 $query = "INSERT INTO ".RESULT_COMMENT_TABLE." (student_id, session, semester, class, principal, house, user_id  )
                    VALUES ('".$student_id."', '".$session."', '".$semester."', '".$class."',
                            '".$principal."', '".$house."', '".$_SESSION['userID'] ."')";
			
			//print_r( $query );
			
			 if (! $db->Query( $query )) {
				$db->Kill();
				return false;
			 } else 
				return true;
		}
		
	 
	 
	 /*
      * returns the grade point equivalent of the
      * result
      * 
      */
     function gradePoint( $score = 0 ){
     	
     	
     	
     	global $gpt;
		
     	//$pt = '';
		
		$pt = 0;
		if( !$score )
			$score = $this->score;
			
		if( trim( $score ) == '' )
			$score = 0;
		
     	foreach( $gpt as $k=>$v ){
     		if( $score != '' ){
	     		if( $v <= (double)$score ){
	     			$pt = $k;
	     		} 
			}
			
			
				
				
     	}
     	
     	return $pt;		
     }
     

     /*function configMasterSheet
      * display form to set master sheet parameters
      *
      */
     function configureMasterSheet( $action, $errors ){

         $department_id = $this->department_id;
         $faculty = new Faculty($this->faculty_id);
         $department = new Department($this->department_id);
         $course = new Course("");

         //$course->getFacultyCourses($this->faculty_id);

         $department->setDepartment();
         $department_name = $department->getName();

        $out = "\n".'<div class="long_box floatleft"><div class="heading"> RESULT MASTER SHEET CONFIGURATION </div>

                <form action="'.$action.'" method="POST">
                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                    <th colspan="2" class="tbTitle"> Master Sheet config for '.$department_name.' </th>
                    </tr>';

		$out .= '<tr>
                            <td class="formLabel">Semester</td>
                            <td class="tbTitle"><input type="radio" name="semester" value="1">First
                            <input type="radio" name="semester" value="2">Second</td>
                        </tr>';

                $out .= '<tr><td class="formLabel">Level</td><td class="formBox">
                            <select name="level_id"><option value="">--Select--</option>';
                    $i = 1;
                    $select = '';
                    global $academic_level;
                    //print_r($usergroup);
                    foreach ( $academic_level as $k ){
                        $value = $academic_level[$i][id];
                        if ( isset( $default_type ) && trim( $default_type ) == $value ){
                            $select = 'selected';
                        }else{
                            $select = '';
                        }
                        $out .='<option value="'.$value.'" '.$select.'>'.$academic_level[$i][title].'</option>';
                        $i++;
                    }

                $out .= '</select></td>
                        </tr>';

                //$out .= "\n".createTwoColFormLabelInput( 'Number of Courses', $_REQUEST[number_of_courses], 'number_of_courses', 1, $error['number_of_courses'], '1', '' );
                $out .= '<tr>
                            <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="setnumber" class="stdButton" value="Next" > </th>
                         </tr>';

                //echo 'in generate course registration form '.$total_credit_load.'<br>';
                $out .= '</table>
                            </form>
                        </div>
                     </div>';

		return $out;
     }

	 // TODO: TEST FOR USE AND DELETE IF UNNECESSARY
     /*function setMasterSheetCourses
      * display foom so set master sheet parameters
      *
      */
     function setMasterSheetCourses( $action, $errors ){

         $level_id = $_REQUEST[level_id];
         $level_name = getLevelName($level_id);

         $semester = $_REQUEST[semester];
         $number_of_courses = $_REQUEST[number_of_courses];
         $department_id = $this->department_id;

         $faculty = new Faculty($this->faculty_id);
         $department = new Department($this->department_id);
         $course = new Course("");
         $faculty_courses = $course->getFacultyCourses($this->faculty_id, $semester);
         $faculty_courses_count = $course->countFacultyCourses($this->faculty_id, $semester);
         echo 'faculty course count is '.$faculty_courses_count;

         $department->setDepartment();
         $department_name = $department->getName();

        $out = "\n".'<div class="long_box floatleft"><div class="heading"> RESULT MASTER SHEET CONFIGURATION </div>

                <form action="'.$action.'" method="POST">
                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                    <th colspan="2" class="tbTitle"> Master Sheet config for '.$department_name.' </th>
                    </tr>';

		$out .= '<tr>
                            <td class="formLabel">Level</td>
                            <td class="tbTitle">'.$level_name.'</td>
                        </tr>';

                $out .= '<tr><td class="formLabel">Semester</td><td class="formBox">
                            '.$semester.'</td>
                        </tr>';

                    $out .= '<tr><td class="formLabel">Select Courses</td><td class="formBox">
                            <ul class="checklist">';
                    $i = 1;
                    $select = '';
                    foreach ( $faculty_courses as $fc ){
                        $value = $faculty_courses[$i][id];
                        if ( isset( $default_type ) && trim( $default_type ) == $value ){
                            $select = 'selected';
                        }else{
                            $select = '';
                        }
                        $out .= '<li><label for=""><input name="course'.$i.'" value="'.$value.'" type="checkbox">'.$faculty_courses[$i][course_code].'</label></li>';
                        //$out .='<input type="checkbox" value="'.$value.'" '.$select.'>'.$faculty_courses[$i][course_code];
                        $i++;
                    }
                 $out .= '</ul></td>
                        </tr>';

                //$out .= "\n".createTwoColFormLabelInput( 'Number of Courses', $_REQUEST[number_of_courses], 'number_of_courses', 1, $error['number_of_courses'], '1', '' );
                $out .= '<tr>
                            <th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="setnumber" class="stdButton" value="Next" > </th>
                         </tr>';

                //echo 'in generate course registration form '.$total_credit_load.'<br>';
                $out .= '</table>
                            <input type="hidden" name="faculty_course_count" value="'.$faculty_courses_count.'">
                            <input type="hidden" name="level_id" value="'.$level_id.'">
                            <input type="hidden" name="semester" value="'.$semester.'">
                            <input type="hidden" name="department_id" value="'.$department_id.'">
                            </form>
                        </div>
                     </div>';

		return $out;
     }


      /*
      * generates results master sheet
      *
      * @param String action        - file that processes the form
      * @param String error         - error generated from a submitted form after validation
      * @returns html code of form.
      */

     //TODO: MOVE ALL MESSAGES TO LANGUAGE FILE //done.
     function generateResultMasterSheet( $action, $error )
     {
         /* TODO
         * 1. create update level function in Student.inc
         * 2. function to set session and year and student level_id
         */
         
		 $department_id = $this->department_id;
         $faculty = new Faculty( $this->faculty_id );
         $department = new Department( $this->department_id );
         $course = new Course("");
         
         $department->setDepartment();
         $department_name = $department->getName();

         $level_id = $_REQUEST[level_id];
         $level_name = protect::getLevelName( $level_id );
         
         //$current_level = $this->getLevelDetails($level);

        //get student datails and preload form using $_SESSION[studentUserID]
        /*$db = new MySQL();
			if (! $db->Open()) {
                $db->Kill();
           }

        $sql= "SELECT * FROM ".STUDENT_TABLE." where student_id ='$_SESSION[studentUserID]'";

        if (! $db->Query($sql)) $db->Kill();
        $student = $db->RowArray();*/
        //$student_id = $student[major];

        /*$course = new course( $course_id );
        $assessment_course = $course->getCourseDetails( $course_id );
        $registered_students = $course->getRegisteredStudentsForThisCourse();*/

   	

        $out = "\n".'<div class="long_box_ floatleft centeralign"><div class="heading">SKOOLBOARD </div>

                <form action="'.$action.'" method="POST">
                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                    <th colspan="9" class="tbTitle"> EXAMINATION RESULT SHEET: <u>'.$level_name.' Master Sheet for'.CURRENT_ACCADEMIC_SESSION.' Academic Session</u> </th>
                    <th colspan="3" class="tbTitle"> SEMESTER <u>'.CURRENT_SEMESTER.'</u> </th>
                    <th colspan="5" class="tbTitle"> YEAR '.$level_id.'</th>
                    <th colspan="5" class="tbTitle"> COURSE: <u>'.$department_name.'</u> </th>
                    </tr>';

		$out .= '<tr>
                            <td colspan="11" class="tbTitle"><span '.ELECTIVE_COURSE_CSS.'>SUBJECTS</span></td>
                            <td colspan="11" class="tbTitle">KEY TO GRADE</td>
                        </tr>';

                $out .='<tr>
                            <th class="heading"> S/NO </th>
                            <th class="heading"> EXAM NO </th>
                            <th class="heading"> NAME </th>';
                //get all courses
                $courses = $course->getDepartmentLevelCourses( $level_id, $department_id );
                    $i = 0;
                    $count  = 1;
                    foreach ( $courses as $cs ){
                        $out .='   <th class="heading"> '.$courses[$i][course_code].' </th>';
                        //$assessment_id = $courses[$i][course_code];
                        $count++;
                        $i++;
                    }
                        /*for ($i = 1; $i<=10; $i++){
                             $out .='   <th class="heading"> COURSE'.$i.' </th>';
                         }*/
                 $out .='   <th class="heading"> OCO SUBJECT </th>
                            <th class="heading" style="direction: rtl;"> OCO SCORES </th>
                            <th class="heading"> TGV </th>
                            <th class="heading"> BF </th>
                            <th class="heading"> GTGV </th>
                            <th class="heading"> GTGV * CL </th>
                            <th class="heading"> TOTAL CH </th>
                            <th class="heading"> CGPA </th>
                            <th class="heading"> REMARKS </th>
                        </tr>';

                        //echo '<br> course id '.$current_course[course_id];
                        //<td class="formLabel">'.$current_course[course_title].'<input type="checkbox" name="compulsory_course'.$sn.'" value="'.$current_course[course_id].'" '.$select.'  '.$activate.'></td>
                    for ($student = 1; $student<= 20; $student++)    {
                        $out .= '<tr style="color:blue;">
                                    <td class="formLabel">'.$student.'</td>
                                    <td class="formLabel">SDC/BFS/DPAA/09/0'.$student.'</td>
                                    <td class="formLabel">DEMO Student '.$student.'</td>';
                                    for ($i = 1; $i<=10; $i++){
                                         $out .='<td class="formLabel">50<sup '.FAILED_COURSE_CSS.'>3</sup></td>';
                                     }
                        $out .= '  <td class="formLabel"></td>
                                    <td class="formLabel"></td>
                                    <td class="formLabel"></td>
                                    <td class="formLabel"></td>
                                   <td class="formLabel"></td>
                                    <td class="formLabel"></td>
                                    <td class="formLabel"></td>
                                    <td class="formLabel"></td>
                                    <td class="formLabel"></td>
                                </tr>';
                    }

                //echo 'in generate course registration form '.$total_credit_load.'<br>';
                $out .= '</table>
                            </form>
                        </div>
                     </div>';

		return $out;
     }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  
}

?>