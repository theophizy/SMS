<?php
/* 
 * Copyright notice
 *
 *  (c) 2009 Mustafa Abdulmutalib (mustafa.abdulmutalib@izybrand.com)
 *  All rights reserved
 *
 *  This script is part of the Webleaves Portal. Webleaves Portal is
 *  COPYRIGHTED. The software may not be redistributed and/or modified
 *  without appropriate authorisation from Izy Brand ltd. The use of
 *  the software is subject to terms and conditons indicated
 *  in http://www.izybrand.com
 *
 *  This copyright notice MUST APPEAR in all copies of the script!

 * Created on 10 October 2009
 ***************************************************************/

/**
 * Description of course:
 * contains all variables methods that has to
 * do with all course offered.
 *
 * @author musty
 * @contributor & editor Dan 
 * 
 */

//TODO: THE DESCRIPTIONS FOR A NUMBER OF FUNCTIONS NEED TO BE CORRECTED

class assessment {
    //put your code here
    var $id = "";
    var $title = "";
    var $description = "";
    var $weight = "";
    var $type = "";
    var $session = "";
    var $status = "";
    var $publish = "";
    var $course_id = "";
    var $attachments = "";
    var $use_assessment ="";
    var $deleted = "";
    var $user_id = "";
	var $level_id = "";
	var $semester = "";



    /*
	 *
     * constructor for assessment class
     *
     */
     function assessment ($id = 0, $title = "", $description = "", $weight = "", $type = "", $session = "", $status = "", $publish = "",
                       $course_id = "", $attachments = "", $use_assessment = "", $deleted = 0, $user_id = "", $lev = 0, $sem = 0 ){
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->course_type = $course_type;
        $this->type = $type;
        $this->session = $session;
        $this->status = $status;
        $this->publish = $publish;
        $this->weight = $weight;
        $this->course_id = $course_id;
        $this->attachments = $attachments;
        $this->use_assessment = $use_assessment;
        $this->deleted = $deleted;
        $this->user_id = $user_id;
		$this->level_id = $lev;
		$this->semester = $sem;
     }

     /*
      * Class Mutators
      */
     function setId( $v ){ $this->id = $v; }
     function setSession( $v ){ $this->session = $v; }
	 function setSemester( $v ){ $this->semester = $v; }
	 function setLevelId( $v ){ $this->level_id = $v; }
	 function setCourseId( $v ){ $this->course_id = $v; }

     /*
      * valid assessment
      * check if an assessment id provided is valid or not
      * 
      * @param assessment_id
      * @return bool true if valid, false if not
      * 
      */
     function validAssessment()
     {
     	$db = new MySQL();
        if (! $db->Open())$db->Kill();

        $sql = "SELECT * FROM ".ASSESSMENT_TABLE."
                WHERE id = ".$this->id." ";

		//print_r( $sql );
		
        $db->Query($sql);
        if( !$db->Query($sql) ) {
             return FALSE;
        } else { 
        	$details = $db->RowArray();
	        if( empty ( $details ) ){
	             return FALSE;
	        } else {
	        	return TRUE;
	        }
        }
     }
     
     
     
	/*
      * generates generates course assessment form for adding/editing course form
      *
      * @param String action        - file that processes the form
      * @param String error         - error generated from a submitted form after validation
      * @param int edit_error       - set to 1 or 0 to reload form values during edit
      * @returns html code of form.
      */

     function generateCourseAssessmentForm( $action, $error )
     {
        $course = new course();
         $assessment_course = $course->getCourseDetails( $_REQUEST['course_id'] );
		// TODO - check course id is set or assesment_course not returning empty, otherwise throw an error message
	
        // or return false
        $current_course = new course();
        $current_course->setCourseId( $_REQUEST['course_id'] );
        $current_course->getCourse();
       
        // display brief information on the course which the assessment is being entered for
        
        
        //get course level title
        $level = new Level( $assessment_course[level_id], "" );
        $course_level = $level->getLevelName();
  
		$course_type = $current_course->getMajorString();
        $credit_unit = $current_course->getMajorUnits();
         
     	$used_weight = $this->countUsedWeight();
     	
        $out = "\n".'<div class="long_box floatleft"><div class="heading">Add/Edit Assessment</div>

        <form action="'.$action.'" method="POST" enctype="multipart/form-data">
                <input type=hidden name=MAX_FILE_SIZE value='.MAX_UPLOAD_FILE_SIZE.' >
                <table>';
       	/*$out .= '	<tr>
                         <th colspan="5" class="tbTitle" style="text-align: center">Current Accademic Session: <b class="green">'.CURRENT_ACCADEMIC_SESSION.'</b></th>
                     </tr>';*/
        $out .= '	<tr>
                    <th colspan="2" class="tbTitle"> Subject Details </th>
                    </tr>';
        
        $out .= '	<tr><td class="formLabel">Title:</td>
                            <td class="formBox">'.$current_course->course_title.'</td>
                        </tr>';
        
        $out .= '	<tr><td class="formLabel">Code:</td>
                            <td class="formBox">'.$current_course->course_code.'</td>
                        </tr>';
       
        global $academic_session;
        global $academic_semester;
		$i = 0;
        
        $select = '';
		
		$default_session = ( isset( $_REQUEST['session'] ) ) ? $_REQUEST['session'] : $this->session;
		
		if ( isset( $_REQUEST['semester'] ) )
			$default_semester = $_REQUEST['semester'] ;
		else if (  $this->semester && $this->semester  != 0 )
			$default_semester = $this->semester ;
		else 
			$default_semester = CURRENT_SEMESTER;
			
		if ( isset( $_REQUEST['level_id'] ) )
			$default_level = $_REQUEST['level_id'] ;
		else if (  $this->level_id && $this->level_id  != 0 )
			$default_level = $this->level_id ;
			
		
		
        if( $_REQUEST['assessment_id'] ){
			$locked = ' disabled';
			$out .= '<input type="hidden" name="session" value="'.$default_session.'" />';
			$out .= '<input type="hidden" name="semester" value="'.$default_semester.'" />';
			$out .= '<input type="hidden" name="level_id" value="'.$default_level.'" />';
		}
		
       
        
        $lock = ''; 
                
                $out .='<tr>
                    <th colspan="2" class="tbTitle"> Assessment Details </th>
                    </tr>';
				
				 $out .= "\n".createTwoColFormLabelSelect( 'Session:', $default_session, 'session', $academic_session, "inputTxat mediumInputTxt", 1, $error['session'], $locked );
				 $out .= "\n".createTwoColFormLabelSelect( 'Term:', $default_semester, 'semester', $academic_semester, "inputTxat mediumInputTxt", 1, $error['semester'], $locked );
				 $lev = new Level();
				 $levels = $lev->getAllLevels();
                
                 $c = 0;
                 foreach( $levels as $ls ){
                	$cp = $c+1;
                	$array_level[$c]['value'] = $ls['id'];
                	$array_level[$c]['name'] = $ls['name'];
                	$c++;
                 }
                
                 $out .= "\n".createTwoColFormLabelSelect( LEVEL_LABEL, $default_level, 'level_id', $array_level, "", 1, $error['level_id'], $locked );
				
				global $assessment_name;
				$out .= "\n".createTwoColFormLabelSelect( TITLE_LABEL, $this->title, 'title', $assessment_name, "inputTxt mediumInputTxt", 1, $error['title'] );
				
                //generate possible assessment weight in range of 5%
                $cur_weight = 0;
                
				$weight_[0]['name'] = '0% of 100';
                $weight_[0]['value'] = 0;
			   
                for ( $i = 1; $i < 21; $i++ ){
                   		$weight_[$i]['name'] = $cur_weight + 5 . '% of 100';
                        $weight_[$i]['value'] = $cur_weight + 5;
                        $cur_weight += 5; 
                }
                
                global $assessment_type;
                $out .= "\n".createTwoColFormLabelSelect( 'Weight:', $this->weight, 'weight', $weight_, "inputTxt mediumInputTxt", 1, $error['weight'] );
        		
                $out .= "\n".createTwoColFormLabelSelect( 'Type:', $this->type, 'type', $assessment_type, "inputTxt mediumInputTxt", 0, $error['type'] );
               	
                
                $out .= '<tr>
                            <th colspan="2" class="tbTitle" style="text-align: center">
                			 <input type="hidden" name="course_id" value="'.$_REQUEST['course_id'].'" />
                            <input type="hidden" name="assessment_id" value="'.$_REQUEST['assessment_id'].'" />
                            <input type="hidden" name="'.$form_status.'" value="1" />
                            <input type="hidden" name="avail_weight" value="'.$avail_weight.'" />
                            <input type="submit" name="Save" class="stdButton" value="Save" >
                			</th>
                         </tr>
                        </table>
                           
                            </form>
                        </div>
                     </div>';


		return $out;
     }
	 
     

     /**
     * Description of printMyCourses:
     * get course details from courses table assigned to a course head.
     *
     * @return a row of record as an array
     */
     function printMyCourses(){
        $db = new MySQL();
		if (! $db->Open()) $db->Kill();
        
        /*
         * TODO
         * 1. move all labels to default_language.inc
         * 2. course_head_id value in course_sql statement should be supplied by $_SESSION['userID'].
         * 3. fix file attachment (single/multiple attachment)
        */
        $course_sql = "SELECT *
                FROM ".COURSE_TABLE."
                WHERE course_head_id = 10 AND deleted = 0";
        
		if (! $db->Query( $course_sql )) {
            $db->Kill();
            return false;

        } else {
            $current_course = $db->RecordsArray();
            $out = "\n".'<div class="long_box floatleft"><div class="heading"> My Current Courses </div>

                <form action="'.$action.'" method="POST">
                <table>';
             $out .= '<tr>
                         <th colspan="5" class="tbTitle" style="text-align: center">Current Academic Session: <b class="green">'.CURRENT_ACCADEMIC_SESSION.'</b></th>
                     </tr>';
             $out .='<tr>
                            <th class="heading"> '.SN_LABEL.' </th>
                            <th class="heading"> Details </th>
                            <th class="heading"> Credit Load </th>
                            <th class="heading"> Assessment Count </th>
                            <th class="heading"> Action </th>
                        </tr>';
            $count = 0;
            $sn = 0;
            $credit_unit = "";
            $course_type = "";
            
			foreach( $current_course as $cc ){
                
                $sn++;
                if ( $current_course[$count][dm_credit_unit] != 0 ){
                    $credit_unit = $current_course[$count][dm_credit_unit];
                    $course_type = 'Double Major';
                } elseif ( $current_course[$count][sm_credit_unit] != 0 ){
                    $credit_unit = $current_course[$count][sm_credit_unit];
                    $course_type = 'Single Major';
                }

                //get course level title
                $level = new Level( $current_course[$count][level_id], "" );
                $course_level = $level->getLevelName();

                $details = $current_course[$count][course_code].'<br>'.
                        $current_course[$count][course_title].'<br>'.
                        $course_level.' '.$course_type;
                $assessment_count = $this->countAssessment( $current_course[$count][id] );
                
				$action_edit = '<a href="index.php?action=assessment&course_id='.$current_course[$count][id].'&view=1" title="Edit an Assessment"><img src="../media/action_edit.png" border="0"></a>';
                $action_new = '<a href="index.php?action=assessment&course_id='.$current_course[$count][id].'&new=1" title="Create an Assessment"><img src="../media/add.png" border="0"></a>';
                
                $out .= '<tr style="color:blue;">
                    <td class="formLabel">'.$sn.'</td>
                    <td class="formLabel">'.$details.'</td>
                    <td class="formLabel">'.$credit_unit.'</td>
                    <td class="formLabel"><a href="index.php?action=assessment&course_id='.$current_course[$count][id].'&view=1" title="View all Assessments">'.$assessment_count.' Assessment(s)</a></td>
                    <td class="formLabel">'.$action_new.$action_edit.'</td>
                    </tr>';
                $count++;
            }
            $out .= '</form>
                     </table>
                     </div>
                 </div>';
        }
        return $out;
     }

	 
	// Count the number of assessment in a course	
	function countAssessment( $course_id ){
         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $assessment_sql = "SELECT * FROM ".ASSESSMENT_TABLE."
                WHERE course_id = ".$course_id." AND deleted = 0";
  
         $db->Query( $assessment_sql );
         if( $db->RowCount() == 0 ) {
             return '0';
         } else {
             $count = $db->RowCount();
             return $count;
         }
     }
   
    /*
      * validates assessment form.
      *
      *@return array errors that are containted in the form
	  *
    */
     
     function ValidateAssessmentForm()
     {
         if( !isset( $this->session ) || trim( $this->session == '' ) )
             $error[session] = 'Select current accademic session';

         if( !isset( $this->title ) || trim( $this->title== '' ) )
             $error[title] = 'Enter assessment title eg. CA';
			 
		 if( !isset( $this->level_id ) || trim( $this->level_id == '' ) )
             $error[level_id] = 'Select level';	

		if( !isset( $this->semester ) || trim( $this->semester == '' ) )
             $error[semester] = 'Select term';			
			
		
		 
         if( !isset( $this->weight ) || trim( $this->weight == '' ) ){
             $error[weight] = 'Assign weight to assessment';
         } else if( isset( $_REQUEST['edit_assessment'] ) ) {
			$current_ass = new Assessment( $_REQUEST[assessment_id] );
			$current_ass->getAssessmentDetails();
			$used_weight = $this->countUsedWeight();
			$used_weight = $used_weight - $current_ass->weight;	
			$avail_weight = TOTAL_ASSESSMENT_WEIGHT - $used_weight;
			if( ( $this->weight ) > $avail_weight )
				$error[weight] = 'Only '.$avail_weight.'% available. Assign a lesser weight.';
		  }  else if( !isset( $_REQUEST['edit_assessment'] ) ) {
			$used_weight = $this->countUsedWeight();
			$avail_weight = TOTAL_ASSESSMENT_WEIGHT - $used_weight;	
			if( ( $this->weight ) > $avail_weight )
				$error[weight] = 'Only '.$avail_weight.'% available. Assign a lesser weight.';
		 
		  }
		 
		
		 return $error;

     }

     /*
	 *
     * Description of createNewAssessment:
     * create a new assessment
     *
     * @return a boolean. TRUE for success and FALSE for failure
     */
     function createNewAssessment (){

         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $query = "INSERT INTO ".ASSESSMENT_TABLE." (session, title, weight, type, description, use_assessment,
                                                 publish, course_id, user_id, level_id, semester)
                    VALUES ('".$this->session."', '".$this->title."', '".$this->weight."', '".$this->type."',
                            '".$this->description."', '".$this->use_assessment."', '".$this->publish."', '".$this->course_id."',
                            '".$this->user_id."', '".$this->level_id."', '".$this->semester."')";

        
		 if (! $db->Query( $query )) {
            $db->Kill();
            return false;

         } else {
            return true;
         }
     }

	 
    /*
	 *
     * Description of updateAssessment:
     * edit and store assessment
     *
     * @return a boolean. TRUE for success and FALSE for failure
     *
	 */
	 
     function updateAssessment (){

         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $use_assessment = $this->use_assessment;
         if ( !$this->use_assessment ){
             $use_assessment = 0;
         }

         $publish = $this->publish;
         //To force publish to be made from publishAssessmentForm() function
         if ( !$this->publish ){
             $publish = 0;
         }

         $query = "UPDATE ".ASSESSMENT_TABLE." SET session = '".$this->session."', title = '".$this->title."', weight = '".$this->weight."',
                    type = '".$this->type."', description = '".$this->description."', use_assessment = '".$use_assessment."',
                    publish = '".$publish."', course_id = '".$this->course_id."', user_id = '".$this->user_id."'
                    WHERE id = ".$_REQUEST['assessment_id']." ";
         //echo $query;
         
             if (! $db->Query( $query )) {
                $db->Kill();
                return false;
             }else {
                 return true;
             }
         
     }

     // Get all assessment in db
     function getAssessments( $title = FALSE ){
         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $sql = "SELECT * FROM ".ASSESSMENT_TABLE."
                WHERE course_id = '".$this->course_id."' 
               
                ";
				
		if( $this->session && $this->session != 0 )
			$sql .= " AND session = '".$this->session."'";	
				
		if( $this->semester && $this->semester != 0 )
			$sql .= " AND semester = '".$this->semester."'";
			
		if( $this->level_id && $this->level_id != 0 )
			$sql .= " AND level_id = '".$this->level_id."'";	
			
		if( $title )
			$sql .= " AND title = '".trim($title)."'";	
			
		$sql .= ' ORDER BY level_id, semester';	
		 
		//print_r( $sql );
		 
         $db->Query($sql);
         if( !$db->Query($sql) ) {
             return FALSE;
         }else{
             $assessments = $db->RecordsArray();
             return $assessments;
         }
     }
	 
	 
	 // get all the assessments of a particular session
	 function getAssessmentsOfSession( $group_by = FALSE ){
         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $sql = "SELECT * FROM ".ASSESSMENT_TABLE."
                WHERE session = '".$this->session."'";
				
		if( $this->semester && $this->semester != 0 )
			$sql .= " AND semester = '".$this->semester."'";
			
		if( $this->level_id && $this->level_id != 0 )
			$sql .= " AND level_id = '".$this->level_id."'";	
		
 
		 if( $group_by )
			$sql .= ' GROUP by course_id';	
			
		$sql .= ' ORDER BY level_id, semester';	
		
		 
         $db->Query($sql);
         if( !$db->Query($sql) ) {
             return FALSE;
         } else{
             $assessments = $db->RecordsArray();
             return $assessments;
         }
     }
	 
	 
	 // get all assessment data for the current assessmnet
	 function getAssessmentDetails(){
        $db = new MySQL();
        if (! $db->Open())$db->Kill();
		
        $sql = "SELECT * FROM ".ASSESSMENT_TABLE."
	                WHERE id = ".$this->id." ";
		
		 $db->Query($sql);
         if( !$db->Query($sql) ) {
             return FALSE;
         }else{
             $details = $db->RowArray();
			 
             // initialize this current object with returned values
             $this->assessment( $this->id, $details['title'], $details['description'], $details['weight'], $details['type'], 
             					$details['session'], "",$details['publish'], $details['course_id'],$details['attachments'], 
             					$details['use_assessment'], $details['deleted'], $details['use_id'], $details['level_id'], $details['semester'] );
								//print_r( $this );
             return $details;
         }
     }

     /*
      * Show assessments for a particular course and a particular session.
	  *
      */

     function viewCourseAssessments(){
        
     	
        $course = new course(  $this->course_id  );
        $course->getCourse();
		
		$action = 'index.php?action=assessment&view_assessment=1&course_id='.$_REQUEST['course_id'];
		$out .= $this->searchForm( $action );	
        $out .= "\n".'<div class="long_box floatleft"><div class="heading">Current Assessment for '.$course->course_code.' for <u>'.$this->session.'</u></div>

                <table>';
		
		$course->session = $this->session;
		
		$actions = ' 
							<div class="notice">';
		if( !$course->resultPublished() )
			$actions .= ' 
								<a href="index.php?action=assessment&course_id='.$this->course_id.'&semester='.$this->semester.'&session='.$this->session.'&level_id='.$this->level_id.'&create_assessment=1" title="Create an Assessment"><img src="../media/add.png" border="0"></a>&nbsp;Add New Assessment
								&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; &nbsp;Download Excel Format for adding scores for <a href="index.php?action=assessment&course_id='.$this->course_id.'&session='.$this->session.'&assessment_id='.$assessment_id.'&download_format=1&type=1" title="Download format for uploading excel"> an assessment </a> or <a href="index.php?action=assessment&course_id='.$this->course_id.'&session='.$this->session.'&assessment_id='.$assessment_id.'&download_format=1&type=2" title="Download format for uploading excel"> multiple assessments </a>
								&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="index.php?action=assessment&course_id='.$this->course_id.'&session='.$this->session.'&semester='.$this->semester.'&level_id='.$this->level_id.'&assessment_id='.$assessment_id.'&overwrite_scores=1" title="Upload and overwrite scores"><img src="../media/upload.gif" border="0"></a>&nbsp;Upload scores for multiple assessments&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
								 <a href="index.php?action=publish_result&session='.$this->session.'&course_id='.$this->course_id.'&semester='.$this->semester.'&level_id='.$this->level_id.'" title="Publish Results"><img src="../media/publish.png" border="0"></a>&nbsp; Publish Results
								';
		
		if( $course->resultPublished() )
			$actions .= 		'
								<a href="index.php?action=publish_result&session='.$this->session.'&course_id='.$this->course_id.'" title="UnPublish Results"><img src="../media/publish.png" border="0"></a>&nbsp; Un-Publish Results
								';
		
		$actions .= '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="index.php?action=addCourse&course_id='.$this->course_id.'" title="Edit Course"><img src="../media/editable.png" border="0"></a>&nbsp;Edit Course
								&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="index.php?action=score_sheet&setdepartlevel=1&academic_session='.$this->session.'&semester='.$this->semester.'&level_id='.$this->level_id.'&course_id='.$this->course_id.'" title="view report sheet"><img src="../media/report.png" border="0"></a>&nbsp;View Score Sheet
		';
		
		$actions .= '</div>';				
		

		
                 $out .= '<tr>
                         <th colspan="5" class="tbTitle" style="text-align: left">Academic Session: <b class="green">'.$this->session.'</b>
                              '.$actions.'                       </th>
                     </tr>';
					 
                 $out .='<tr>
                            <th class="heading"> '.SN_LABEL.' </th>
                            <th class="heading"> Title </th>
                            <th class="heading"> Weight </th>
                            <th class="heading"> Level </th>
							<th class="heading"> Term </th>
                            <th class="heading" width= 100px> Action </th>
                        </tr>';
            
                $assessments = $this->getAssessments();
                
                if ( $assessments != '' ){
                    
                    $i = 0;
                    $count  = 1;
                    foreach ( $assessments as $as ){
                        $assessment_id = $assessments[$i][id];

                        $action_scores = '&nbsp;<a href="index.php?action=assessment&course_id='.$this->course_id.'&assessment_id='.$assessment_id.'&session='.$_REQUEST['session'].'&enter_scores=1" title="Enter Students Score for this Assessment"><img src="../media/group.png" border="0"></a>';
                        $action_upload_scores = '&nbsp;<a href="index.php?action=assessment&course_id='.$this->course_id.'&assessment_id='.$assessment_id.'&upload_scores=1" title="Upload Scores via csv for this assessment"><img src="../media/upload.gif" border="0"></a>';
						$action_delete_ass = '&nbsp;<a href="index.php?action=assessment&course_id='.$this->course_id.'&assessment_id='.$assessment_id.'&delete=1" title="Delete Assessment and Empty Scores"><img src="../media/delete.gif" border="0"></a>';
						$action_send_ass = '&nbsp;<a href="index.php?action=assessment&course_id='.$this->course_id.'&assessment_id='.$assessment_id.'&send_assessment_result=1" title="Send Assessment  Scores to Parent"><img src="../media/mail.png" border="0"></a>';
						
						 if( $assessments[$i][semester] == 1 )
							$class = 'odd';;
						 if( $assessments[$i][semester] == 2 )
							$class = 'even';;	
							
						 
                         $out .= '<tr class="'.$class.'">
                            <td class="formLabel">'.$count.'</td>
                            <td><a href="index.php?action=assessment&course_id='.$this->course_id.'&assessment_id='.$assessment_id.'&edit_assessment=1" title="Edit this assessment">'.$assessments[$i][title].'</a></td>
                            <td>'.$assessments[$i][weight].'% </td>
                            <td>'.$assessments[$i][level_id].'</td>
							<td>'.$assessments[$i][semester].'</td>
                            <td>'.$action_scores.$action_edit_scores.$action_upload_scores.$action_delete_ass.$action_send_ass.'</td>
							
                            </tr>';
                        $count++;
                        $i++;
                    }
                }else{
                    //no assessment for this course.
					
                    $out .= '<tr>
                            <td colspan="3" class="tbTitle" style="text-align: center">No Records to Display.';
							
					if( $_REQUEST['semester'] && $_REQUEST['level_id'] && $_REQUEST['session'] )
					$out .= '<a href="index.php?action=assessment&course_id='.$this->course_id.'&session='.$this->session.'&semester='.$this->semester.'&level_id='.$this->level_id.'&create_default_assessment=1" title="Create default assessment"> >> Create default set of assessments. <<';
					
					$out .= '</td>
                            </tr>';
                }
               
                
                $out .= '</table>
                        </div>
                     </div>';


		return $out;

     }

	 function multipleAssessmentsForm( $action, $error  )
	 {
		
		global $default_jss_assessment;
		global $default_sss_assessment;
		
		/*
		$default_jss_assessment[0][title] = 'ATT'; $default_jss_assessment[0][weight] = 0; $default_jss_assessment[0][type] = 'Other'; 
		$default_jss_assessment[1][title] = 'ASGT'; $default_jss_assessment[1][weight] = 0; $default_jss_assessment[1][type] = 'Assignment';
		$default_jss_assessment[2][title] = 'TEST1'; $default_jss_assessment[2][weight] = 20; $default_jss_assessment[2][type] = 'Test';
		$default_jss_assessment[3][title] = 'TEST2'; $default_jss_assessment[3][weight] = 20; $default_jss_assessment[3][type] = 'Test';
		$default_jss_assessment[4][title] = 'Exam'; $default_jss_assessment[4][weight] = 60; $default_jss_assessment[4][type] = 'Exams';
		
		$default_sss_assessment[0][title] = 'ATT'; $default_sss_assessment[0][weight] = 0; $default_sss_assessment[0][type] = 'Other'; 
		$default_sss_assessment[1][title] = 'ASGT'; $default_sss_assessment[1][weight] = 0; $default_sss_assessment[1][type] = 'Assignment';
		$default_sss_assessment[2][title] = 'TEST1'; $default_sss_assessment[2][weight] = 15; $default_sss_assessment[2][type] = 'Test';
		$default_sss_assessment[3][title] = 'TEST2'; $default_sss_assessment[3][weight] = 15; $default_sss_assessment[3][type] = 'Test';
		$default_sss_assessment[4][title] = 'Exam'; $default_sss_assessment[4][weight] = 70; $default_sss_assessment[4][type] = 'Exams';
		*/
		
		$course = new course();
         $assessment_course = $course->getCourseDetails( $_REQUEST['course_id'] );
		// TODO - check course id is set or assesment_course not returning empty, otherwise throw an error message
	
        // or return false
        $current_course = new course();
        $current_course->setCourseId( $_REQUEST['course_id'] );
        $current_course->getCourse();
       
        // display brief information on the course which the assessment is being entered for
        
        
        //get course level title
        $level = new Level( $this->level_id, "" );
        $course_level = $level->getLevelName();
  
		$course_type = $current_course->getMajorString();
        $credit_unit = $current_course->getMajorUnits();
         
     	$used_weight = $this->countUsedWeight();
		$out = "\n".'<div class="long_box floatleft"><div class="heading">Add Multiple Assessments </div>';
		$out .= '<table>';
		$out .= '	<tr>
                    <th colspan="2" class="tbTitle"> Subject Details </th>
                    </tr>';
        
        $out .= '	<tr><td class="formLabel">Title:</td>
                            <td class="formBox"><a href="index.php?action=assessment&view_assessment=1&course_id='.$this->course_id.'&session='.$this->session.'&semester='.$this->semester.'&level_id='.$this->level_id.'">'.$current_course->course_title.'</a></td>
                        </tr>';
        
        $out .= '	<tr><td class="formLabel">Code:</td>
                            <td class="formBox">'.$current_course->course_code.'</td>
                        </tr>';
		
		$out .= '	<tr><td class="formLabel">Academic Session:</td>
                            <td class="formBox">'.$this->session.'</td>
                        </tr>';		
						
		$out .= '	<tr><td class="formLabel">Level:</td>
                            <td class="formBox">'. $course_level.'</td>
                        </tr>';	

		$out .= '	<tr><td class="formLabel">Term:</td>
                            <td class="formBox">'.$this->semester.'</td>
                        </tr>';					
						
						
		$out .= '				</table>';
						
						
		$out .= "\n".'
                <form method="POST" action="'.$action.'" >
				
				<input type="hidden" name="course_id" value="'.$this->course_id.'" />
                <input type="hidden" name="session" value="'.$this->session.'" />
				<input type="hidden" name="level_id" value="'.$this->level_id.'" />
				<input type="hidden" name="semester" value="'.$this->semester.'" />
                <table>';
		
	 if( $_REQUEST['default'] )
		$default = $_REQUEST['default'];
	 else if( $this->level_id <= 3 )
		$default = $default_jss_assessment;
	 else 	
		$default = $default_sss_assessment;
	 
		$out .= '<tr>
					<th>S/N</th>
					<th>Title</th>
					<th>Weight</th>
					<th>Type</th>
				</tr>';	
		
		global $assessment_name;
		global $assessment_type;
				
		$j = 1;
		$cur_weight = 0;
        $weight_[0]['name'] = '0% of 100';
        $weight_[0]['value'] = 0;
		for ( $i = 1; $i < 21; $i++ ){
			$weight_[$i]['name'] = $cur_weight + 5 . '% of 100';
            $weight_[$i]['value'] = $cur_weight + 5;
            $cur_weight += 5; 
        }
         
        
                
		foreach( $default as $def ){
		
			$out .= '<tr>
						<td>'. $j .'</td>';
			$out .= "<td>".createFormLabelSelect( TITLE_LABEL, $def[title], 'default['.$j.'][title]', $assessment_name, "inputTxt mediumInputTxt", 1, $error[$j]['title'] ).'</td>';			
			$out .= "<td>".createFormLabelSelect( 'Weight:',  $def[weight], 'default['.$j.'][weight]', $weight_, "inputTxt mediumInputTxt", 1,  $error[$j]['weight'] );
			$out .= "<td>".createFormLabelSelect( 'Type:', $def[type],  'default['.$j.'][type]', $assessment_type, "inputTxt mediumInputTxt", 0,  $error[$j]['type'] );
			
			$out .= '</tr>';
			$j++;
		}
		
		if( !$_REQUEST['default'] )
			for( $i = 0; $i < 2; $i++ ){
			
				$out .= '<tr>
							<td>'. $j .'</td>';
				$out .= "<td>".createFormLabelSelect( TITLE_LABEL, '', 'default['.$j.'][title]', $assessment_name, "inputTxt mediumInputTxt", 1, $error[$j]['title'] ).'</td>';			
				$out .= "<td>".createFormLabelSelect( 'Weight:',  '', 'default['.$j.'][weight]', $weight_, "inputTxt mediumInputTxt", 1,  $error[$j]['weight'] );
				$out .= "<td>".createFormLabelSelect( 'Type:', '',  'default['.$j.'][type]', $assessment_type, "inputTxt mediumInputTxt", 0,  $error[$j]['type'] );
				
				$out .= '</tr>';
				$j++;
			}
		
		
		 $out .= '<tr>
					<th></th>
					<th></th>
					<th class="tbTitle" style="text-align: center">
						<input type="submit" name="Save" class="stdButton" value="Save" >
                	</th>
					<th></th>
                  </tr>';
	 
		$out .= '</form>
			</table>
		</div>';
	 
		return $out;
		
		
	 }
	
	
     /*
      * enterStudentsScore: generates an html of form for entering student scores
      *
      *
      * @param String action        - file that processes the form
      * @param String error         - error generated from a submitted form after validation
      * @returns html code of form.
      * 
      * 
      */

     function enterStudentsScore( $action, $error )
     {
     	
        $course = new course( $this->course_id );
        $course->getCourse();
		$course->session = $this->session;
		
		$user = new User( $_SESSION['userID'] );
		$exams_office_group = array( 5 ); $admin_group = array( 1 );
		$newarr = array_merge( $exams_office_group, $admin_group );
		$edit_lock = ( $course->resultPublished() ) ? TRUE: FALSE;
		if( $edit_lock )
			$disabled = 'disabled'; 
		
		
        $registered_students = $this->studentsWithScoresInAssessment();
        $assessment_details = $this->getAssessmentDetails();

        $form_title = 'Enter Students Score for '.$this->title;

        //deal with locking of assessment scores
        if ( $this->publish == 0 ){
            $lock = 'readonly = readonly';
            $current_status = '<img src="../media/lock.png" class="floatright" title="Locked: All published assessments are locked" alt="Locked" border="0">';
            $form_button = '<input type="submit" disabled=disabled name="save_scores" class="stdButton" value="Save" >';
            
        } else {
            $lock = '';
            $current_status = '<img src="../media/editable.png" class="floatright" title="Editable" alt="Editable" border="0">';
            $form_button = '<input type="submit" name="save_scores" class="stdButton" value="Save" >';
            
        }  
        
        $out = "\n".'<div class="long_box floatleft"><div class="heading">'.$form_title.$current_status.'</div>
                <form method="POST" action="'.$action.'" >
				
				<input type="hidden" name="course_id" value="'.$this->course_id.'" />
                            <input type="hidden" name="assessment_id" value="'.$this->id.'" />
                            <input type="hidden" name="session" value="'.$this->session.'" />
                            
				
                <table>';
                 $out .= '<tr>
                         <th colspan="6" class="tbTitle" style="text-align: center">Students Currently Registered for '.$course->course_code.' in 
                            <b class="green">'.$this->session.'</b> Academic Session
                        </th>
                     </tr>';
                 $out .='<tr>
                            <th class="heading"> '.SN_LABEL.' </th>
                             <th class="heading">'.LOCK_TITLE.' </th> 	
                             <th class="heading"><!--input type="checkbox" name="use_for_all" value="" title="Click to Select all students"--> '.NAME_TITLE.' </th>
                             <th class="heading"> '.MATRIC_NUMBER_LABEL.' </th>
                            <th class="heading"> '.DEPARTMENT_LABEL.' </th>
                            <th class="heading"> Enter Score </th>
                        </tr>';
			
                //get all students registerd for this course from student_course table
                if ( $registered_students ){
                    
                    $checked = '';
                    $i = 0;
                    $count  = 1;
                    foreach ( $registered_students as $rs ){

                        $student = new student( $registered_students[$i]['student_id'] );
                        $student_details = $student->getStudent();

                        //get student departments details
                        $department = new department( $student_details['department_id'] );
                        $department->setDepartment();
                        $department_name = $department->getName();

                        $student_name = strtoupper($student_details['firstname']).' '.$student_details['surname'].' '.$student_details['othername'];
                        
                        
                       	 $default_score = '';
                       	 $idInput = '';
                         $res = new Result( 0, $this->id, $registered_students[$i]['student_id'] );
                         if( $res->getStudentAssessmentScore() ){
                         	$idInput = '<input type="hidden" name="res_id['.$count.']" value="'.$res->id.'">';
                         	$default_score = $res->score;
                         	$checked = ( $res->lock == 1 ) ? 'checked' : '';
                         	
                         }
                         
                         $out .= '<tr>
                            <td class="formLabel">'.$count.'<input type="hidden" name="student['.$count.']" value="'.$registered_students[$i]['student_id'].'"></td>
                           	<td><input type="checkbox" '.$checked.' name="lock['.$count.']" title="Click to Select student" > </TD>
                            <td>'.$student_name.
                         			$idInput.'</td>
                            <td>'.$student_details['matriculation_no'].'</td>
                            <td>'.$department_name.'</td>
                            
                              <td><input type="text" '.$disabled.' class="result_input_box" name="score['.$count.']" title="Enter Student Score" value="'.$default_score.'"  /><br /><span class="warning">'.$error[$count].'</span></td>
                            </tr>';
                        $count++;
                        $i++;
                    }
                    
                }else{
                    //no assessment for this course.
                    $out .= '<tr>
                            <td colspan="6" class="tbTitle" style="text-align: center">No Records to Display</td>
                            </tr>';
                    $form_button = '';
                }
				
				if( !$edit_lock )
					$button = '<input type="submit" name="save_scores" class="stdButton" value="Save" >';
					
                $out .='<tr>
                            <th colspan="6" class="tbTitle" style="text-align: center">
								'.$button.'
								<input type="hidden" name="student_count" value="'.$count.'" />
                            	
                            </th>
                            
                         </tr>';
                $out .= '</table>
                        </form>
                        </div>
                     </div>';


		return $out;
     }
	
     
     /*
      * csvuploadform: form for uploading file 
      * 
      */
	  
     function uploadForm( $action, $error='' )
     {
     	$out = "\n".'<div class="long_box floatleft"><div class="heading">'.$form_title.$current_status.'</div>
                <form method="POST" action="'.$action.'" enctype="multipart/form-data" >';
     	
     	
     	$out .= "\n".'<input type=hidden name=MAX_FILE_SIZE value='.MAX_UPLOAD_FILE_SIZE.' >
                                        <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                         <th colspan="2" class="tbTitle"> '.$this->title.' Scores Upload <span class="note">Note: All files must be less than 1MB</span></th>
                                        </tr>';
     	
		$out .= "\n".createTwoColFormLabelFileInput( 'CSV File', 'csv', 1, $error['csv'] );
     	
     	$out .= '		
			<tr>
			<th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="upload" class="stdButton" value="submit" > </th>
			</tr>	
			</table>
						
			</form>';
     	
     	
     	return $out;
     }
     
     
     /*
      * validateUploadForm: check uploadform for errors
      * 
      */
	  
     function validateUploadForm()
     {
     	$error = array();
     	$acceptedFileTypes = array( 'csv' );
     	if( !isset( $_FILES['csv'] ) || $_FILES['csv']['name'] == '' )
     		$error[csv] = 'You must enter a valid csv file';
     	
     	
     	if( isset( $_FILES['csv'] ) && ( !typeMatches( $_FILES['csv']['name'], $acceptedFileTypes ) ) ) 
			$error[csv] = 'You must submit a csv file';
     	
     	return $error;
     }
	 
	 
	 // form for reporting assessment dispute 
	 function assessmentDisputeForm( $action, $error )
	 {
		$out = "\n".'<div class="long_box floatleft">
				<div class="heading"> Exams Dispute Form </div>
					<form method="POST" action="'.$action.'" >
						<table class="stdTable" cellpadding="0" cellspacing="0" border="0">	
					';
     	
		global $academic_session;
		$out .= "\n".createTwoColFormLabelSelect( SESSION_LABEL, $_REQUEST[SESSION], 'session', $academic_session, "inputTxt mediumInputTxt", 1, $error['session'] );

		for( $c=0; $c <= NUMBER_OF_SEMESTER; $c++ ){
        	$cp = $c;
			$array_sem[$c]['value'] = $array_sem[$c]['name'] = "$cp";
		}        
                
        $out .= "\n".createTwoColFormLabelSelect( SEMESTER_LABEL, $_REQUEST['semester'], 'semester', $array_sem, "", 1, $error['semester'] );
		$out .= "\n".createTwoColFormLabelTextarea( DISPUTE_DESCRIPTION_LABEL, $_REQUEST['description'], 'description', 0, $error['description']  );
		
		$out .= '<tr><td></td><td> 
					<p class="note"> Disputes must be described as COURSE CODE: dispute type e.g.<br /> 
					CS101: No result. <br />
					CS211: CA Skipped/Error in calculation. <br />
					CS212: Error in grade. <br />
					</p>
				</td></tr>';
		
     	$out .= '		
			<tr>
			<th colspan="2" class="tbTitle" style="text-align: center"> <input type="submit" name="send" class="stdButton" value="send request" > </th>
			</tr>	
			</table>
						
			</form>';
     	
     	
     	return $out;
	 }
	 
	 
	 
	 // validate dispute for
	 function validateDisputeForm()
	 {
		if( !isset( $_REQUEST['session'] ) || trim( $_REQUEST['session'] == '' ) )
             $error['session'] = 'Enter academic session.';	
	 
		if( !isset( $_REQUEST['semester'] ) || trim( $_REQUEST['semester'] == '' ) )
             $error['semester'] = 'Enter semester.';	
			 
		if( !isset( $_REQUEST['description'] ) || trim( $_REQUEST['description'] == '' ) )
             $error['description'] = 'Enter description of disputed exams. See examples below.';	
		
		
		return $error;
	 
	 }
	 
	 // store dispute in db
	 function storeDispute( $flow_id, $student_id )
	 {
		$sql = "INSERT into ".EXAM_DISPUTE_TABLE."( session, semester, description, closed, flow_id, student_id, timestamp )
                VALUES( '$_REQUEST[session]', '$_REQUEST[semester]', '$_REQUEST[description]', 0, '$flow_id', '$student_id', NOW() )";
				
		$db = new MySQL();
		if (! $db->Open())$db->Kill();
        
		if (! $db->Query( $sql )) {
			$db->Kill();
            return false;
        } else 
			 return $db->GetLastInsertID();	
	}
	
	// opened disputes for a student
	function getOpenedStudentDisputes( $student_id )
	{
		
		$sql = "SELECT * FROM ".EXAM_DISPUTE_TABLE." WHERE student_id='". $student_id."' AND closed = 0 ";
	
		$db = new MySQL();
		if (! $db->Open())$db->Kill();
			
		if (! $db->Query( $sql )) {
			return FALSE;
		}
		
		$disp = array();
		$disp = $db->RecordsArray();
		
		return $disp;
	
	}
	
	// all opened/closed diputes 
	function getAllStudentDisputes( $student_id )
	{
		
		$sql = "SELECT * FROM ".EXAM_DISPUTE_TABLE." WHERE student_id='". $student_id."'";
	
		$db = new MySQL();
		if (! $db->Open())$db->Kill();
			
		if (! $db->Query( $sql )) {
			return FALSE;
		}
		
		$disp = array();
		$disp = $db->RecordsArray();
		
		return $disp;
	
	}
	
	
	// get a particular dispute from db
	function getDispute( $id )
	{
		
		$sql = "SELECT * FROM ".EXAM_DISPUTE_TABLE." WHERE id='". $id."' ";
	
		$db = new MySQL();
		if (! $db->Open())$db->Kill();
			
		if (! $db->Query( $sql )) {
			return FALSE;
		}
		
		
		
		return $db->Row();
	
	}
	
	// get all opened dispustes from db
	function getOpenedDisputes()
	{
		
		$sql = "SELECT * FROM ".EXAM_DISPUTE_TABLE." WHERE closed = 0 ";
	
		$db = new MySQL();
		if (! $db->Open())$db->Kill();
			
		if (! $db->Query( $sql )) {
			return FALSE;
		}
		
		$disp = array();
		$disp = $db->RecordsArray();
		
		return $disp;
	
	}
	 
	 // update process flow for a dispute
	 function updateFlowIdDispute( $dispute_id, $flow_id )
	 {
		$db = new MySQL();
         if (! $db->Open())$db->Kill();

         $query = "UPDATE ".EXAM_DISPUTE_TABLE." SET flow_id = '".$flow_id."' WHERE id = '".$dispute_id."'";
		 
      
         if (! $db->Query( $query )) {
            return false;
            }
         else 
             return true;
	 
	 }
	 
	 // close dispute
	 function closeDispute( $dispute_id )
	 {
		$db = new MySQL();
         if (! $db->Open())$db->Kill();

         $query = "UPDATE ".EXAM_DISPUTE_TABLE." SET closed = '1' WHERE id = '".$dispute_id."'";
		 
      
         if (! $db->Query( $query )) {
            return false;
            }
         else 
             return true;
	 
	 }
	 
	 

     /*
      * form to publish Assessment Result .
      *
      * @param String action        - file that processes the form
      * @param String error         - error generated from a submitted form after validation
      * @returns html code of form.
      */

     //function publishAssessmentForm( $action, $error ){
     function publishAssessmentForm(  ){
        
         $course_id = $_REQUEST[course_id];
         $assessment_id = $_REQUEST[assessment_id];
        $form_title = 'Publish Assessment Result';
        //print_r($_REQUEST);
        $out = "\n".'<div class="long_box_ floatleft_ confirmBox"><div class="heading">'.$form_title.'</div>
                <table>';
                 $out .= '<tr style="color:blue;">
                            <td class="formLabel"><p style="color:green; text-align:center;">Do you want to publish this result?<br><br><b style="color:#ff0000;">NOTE:</b> All published result are automatically locked</p>
                                <p style="text-align:center;">
                                <a href="index.php?action=assessment&course_id='.$course_id.'&publish=1&assessment_id='.$assessment_id.'&view=1">Click to Publish</a>
                                <a href="index.php?action=assessment&course_id='.$course_id.'&cancelpublish=1&assessment_id='.$assessment_id.'&view=1" style="margin-left:20px;">Click to Cancel</a>
                                </p>
                            </td>
                            </tr>';
                $out .= '</table>
                        </div>
                     </div>';
		return $out;
     }


     /**
     * Description of publishAssessmentScores: change published status
     * set deleted on assessment table from 0 to 1
     *
     * @return a boolean. TRUE for success and FALSE for failure
     */

     function publishAssessmentScores ( $publishValue = 1 ){
         
		 $assessment_id = $_REQUEST['assessment_id'];
         $deleteValue = 0;

         $query = "UPDATE ".ASSESSMENT_TABLE." SET publish = '".$publishValue."'
                    WHERE id = ".$assessment_id;
         
         if ( $this->useAssessment() ){
             $db = new MySQL();
            if (! $db->Open())$db->Kill();
            
             if (! $db->Query( $query )) {
                $db->Kill();
                return false;
             }else {
                if ($this->lockAssessment()){
                    return TRUE;
                }else{
                    return FALSE;   //the assessment could not be published OR published but not locked.
                }
             }
         }else{
             return FALSE;
         }
         
     }

    /*
	 *
     * Description of lockAssessment:
     * create a new assessment
     *
     * @return a boolean. TRUE for success and FALSE for failure
     */
     function lockAssessment( $lock = 1 ){
        //$lock = 1;
        $assessment_id = $_REQUEST['assessment_id'];
         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $query = "UPDATE ".ASSESSMENT_TABLE." SET status = '".$lock."'
                    WHERE id = ".$assessment_id." AND deleted = 0";
         //echo $query;
         if (! $db->Query( $query )) {
            $db->Kill();
            return false;

         }else {
            return true;
         }
     }

	
     /*
      * SaveAssessmentScore
      * 
      */
     
     function saveAssessmentScore()
     {
     	
     	$student_id = $_REQUEST[student];
     	$score = $_REQUEST[score];
     	$lock = $_REQUEST[lock];
     	$res_id = $_REQUEST[res_id];
     	
     	$i = 1;
     	
     	foreach( $student_id as $sid ){
     		
     		$res = new Result();
     		if( $sid != 0 ){
				
				
     			$res->assessment_id = $_REQUEST[assessment_id];
		     	$res->student_id = $sid;
		     	$res->score = $score[$i];
		     	
		     	$res->lock = ( isset( $lock[$i] ) ) ? 1 : 0;
		     	
		     	$res->last_editor_id = $_SESSION[userID]; 
		     	
		     	
		     	if( trim( $res->score ) != '' ){
			     	
					if( isset( $res_id[$i] ) && $res_id[$i] != 0 ){ 
			     		$res->setId( $res_id[$i] );
			     		$res->deleteAssessmentScore();
			     	}
			     	
			     	$res->createNewAssessmentScore(); 
		     	}
     		}
     		
     		$i++;
     		
     	}
     	
     }
     
     
     
     /** 
      * TODO: GET RID OF
	  * Description of saveStudentsScore:
      * Stores student scores into the database
      * @param run_update is set to 0 for new scores and 1 for update scores
      * @return a boolean. TRUE for success and FALSE for failure
     
	 */
     function saveStudentsScore ( $run_update = 0 ){
         /*$db = new MySQL();
         if (! $db->Open())$db->Kill();
         */
        $count = $_REQUEST[student_count];
        $student_result = array();  //array to hold all student scores from webform

        if ( $count != 0 ){
            $sn = 0;
            for ( $i = 1; $i <= $count; $i++ ){
                $use_score_for_student = 'use_for_student_'.$i;
                $student_score = 'score_for_student_'.$i;
                $student_id = 'student_'.$i.'_id';
                $score_id = 'score_id_for_student_'.$i;
                
                if ( isset($_REQUEST[$use_score_for_student]) ){
                    if ( isset($_REQUEST[$student_score]) && $_REQUEST[$student_score] != "" ){
                        $sn++;
                        $student_result[$sn][student_id] = $_REQUEST[$student_id];
                        $student_result[$sn][student_score] = $_REQUEST[$student_score];
                        $student_result[$sn][score_id] = $_REQUEST[$score_id];
                    }else{
                        //return false: one ore more student do not have result.
                    }
                }
            }
        }
        //print_r($student_result);
         //enter records into database
        for ( $i = 1; $i <= $sn; $i++ ){
            $student_id = $student_result[$i][student_id];
            $student_score = $student_result[$i][student_score];
            $score_id = $student_result[$i][score_id];
            $assessment_id = $_REQUEST[assessment_id];

            //TODO: move querry to Result class
            /*$sql = "INSERT into ".RESULT_TABLE."( student_id, assessment_id, student_score )
                VALUES( '$student_id', '$assessment_id', '$student_score' )";
            */
            //echo $sql;
            $result = new Result( $score_id, $student_id, $assessment_id, "", "", $student_score );
            
            if ( $run_update == 1 ){
                $return_val = $result->updateAssessmentScore();
            }else{
                $return_val = $result->createNewAssessmentScore();
            }
            if ( $return_val ){
                $success = TRUE;
                //echo $sql;
            }else{
                $success = FALSE;
            }
        }
        return $success;
     }


     /*
      * countUsedWeight: return assessment weight that has been used for a particular course
      *
      * @param String action        - file that processes the form
      * @param String error         - error generated from a submitted form after validation
      * @returns html code of form.
      */

     function countUsedWeight(){
        
		
		$assessments = $this->getAssessments();
       	
        if ( $assessments ){
            $i = 0;
            $weight_count  = 0;
            foreach ( $assessments as $as ){
                $weight = $assessments[$i][weight];
                $weight_count = $weight_count + $weight;
                //echo $weight_count;
                $i++;
            }
        }else{
            //no assessment for this course.
        }
		return $weight_count;
     }

     /**
     * Description of deleteAssessment:
     * set deleted assessment from db
     *
     * @return a boolean. TRUE for success and FALSE for failure
     */

     function deleteAssessment(){
         $assessment_id = $_REQUEST['assessment_id'];
         $deleteValue = 1;
        
		 $db = new MySQL();
         if (! $db->Open())$db->Kill();
        
		 $query = "DELETE FROM ".ASSESSMENT_TABLE." WHERE id = '".$assessment_id."'";
		 
		 if (! $db->Query( $query )) {
            return FALSE;
         } else {
            return TRUE;
         }
     }

     /*
	 *
     * Description of ifAssessmentHasScores:
     *
     * @return TRUE of FALSE
     */

     function ifAssessmentHasScores( $assessement_id ){
        
		if( !$assessement_id )
			$assessement_id = $this->id;
		
        $db = new MySQL();
        if (! $db->Open())$db->Kill();

        $query = "SELECT * FROM ".RESULT_TABLE." WHERE assessment_id = '".$assessement_id."'
            AND score > 0";
         
        $db->Query( $query );
        if( ($db->RowCount() == 0) || ($db->RowCount() == '') ) {
            return FALSE;
        } else {
            return TRUE;
		}
     }
     
     /**
     * Description of useAssessment:
     *
     * @param assessment_id
     * @return a value STUDENT_SCORE
     */

     function useAssessment(){
         $deleteValue = 0;
         $assessment_id = $_REQUEST['assessment_id'];
         $db = new MySQL();
         if (! $db->Open())$db->Kill();

         $query = "SELECT * FROM ".ASSESSMENT_TABLE." WHERE id = '".$assessment_id."'
                     AND deleted = ".$deleteValue;
         //echo $query;
         $db->Query( $query );
         if ( ! $db->Query( $query ) )
            $db->Kill();
         else{
             $row = $db->RowArray();
             //echo $row[student_score];
             return $row[use_assessment];
         }
     }

	// a quick search form	
	function searchForm( $action )
	{
		 $out = "\n".'
			
				<div class="long_box">
						<div class="heading"> Quick Search
						</div>
					<form action="'.$action.'" method="POST">
					<table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                    ';
		
		global $academic_session;
        $i = 0;
        
        $select = '';
        $default_session = ( isset( $_REQUEST['academic_session'] ) ) ? $_REQUEST['academic_session'] : CURRENT_ACCADEMIC_SESSION;
        $out .= "\n".createTwoColFormLabelSelect( 'Session:', $_REQUEST['session'], 'session', $academic_session, "inputTxt mediumInputTxt", 0, $error['session'] );
  		
		
		$lev = new Level();
	    $all_lev = $lev->getAllLevels();
		 
	    $i = 0;
	    foreach( $all_lev as $aL )
	    {
			$arr_lev[$i]['name'] = $aL['name'];
	        $arr_lev[$i]['value'] = $aL['id'];
	        $i++;
	    }
	
	    $out .= "\n".createTwoColFormLabelSelect( SEARCH_LEVEL_LABEL, $_REQUEST['level_id'], 'level_id', $arr_lev, "", 0 );
		
		global $academic_semester;
        $out .= "\n".createTwoColFormLabelSelect( SEMESTER_LABEL, $_REQUEST[semester], 'semester', $academic_semester, "", 0, $error['semester'] );
        
		
		
        $out .= '<tr>
                            <th colspan="2" class="tbTitle" style="text-align: center"> 
							
							<input type="hidden" value="showcourses" name="show" />
							<input type="submit" name="search" class="stdButton" value="Search" > </th>
                         </tr>
                        </table>
					</form>
           </DIV>          
                     ';


		return $out;
		
	}
	 
	 // return all students with uploaded scores for a particular assessmnet
	 function studentsWithScoresInAssessment()
	 {
         $db = new MySQL();
         if (! $db->Open())$db->Kill();
 
         $sql = "SELECT * FROM ".RESULT_TABLE."
                WHERE assessment_id = ".$this->id;
         
		// print_r( $sql );
		 
         $db->Query($sql);
         if( !$db->Query($sql) ){
             return FALSE;
         }else{
             $students = $db->RecordsArray();
             return $students;
         }
     }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    

}
?>