<?php

/***************************************************************
 *
 * Description of StudentTemplate
 * This class inherits the student class and isolates the results templates here
 * such that for new installations only this class needs to be changed.
 *
 * @author Ibrahim
 *
 **************************************************************
 *
 */

// FSS ILORIN TEMPLATE 
class StudentTemplate extends Student
{
	
	
		function StudentTemplate( $student_id = 0 )
		{
			$this->student_id =  $student_id;
		
		}
		
		// View of results for the current student for current semester & session	
      function printResults( $be_view = FALSE )
        {
        	
        	$db = new MySQL();
	        if ( !$db->Open() ) {
	                $db->Kill();
	            }
	            
	        $course = new course();
	        $res = new Result();
	        
			$student =  $this->getStudent();
	        $studentlevel = new Level( $student['level_id'] );
	        
			if( $student['level_id'] )
				$current_level = $studentlevel->getLevelDetails();
	        
			 	
	        $dept = new Department( $this->department_id );
	        $dept->setDepartment();

	        $fac = new Faculty( $this->faculty_id );
	        $fac->setFaculty();
			
			$result = new Result();
	        
			$default_session = ( isset( $_REQUEST['session'] ) && trim( $_REQUEST['session'] ) != '' ) ? $_REQUEST['session'] : CURRENT_ACCADEMIC_SESSION;
			$default_semester = ( isset( $_REQUEST['semester'] ) && trim( $_REQUEST['semester'] ) != ''  ) ? $_REQUEST['semester'] : 1;
			
			// student medical records including height and w
			$medical = new Medical();
			$medical->setStudentId( $this->student_id );
			$medical->retrieveMedical();
			
	       /* 	#################################
				TEMPLATE MODIFICATION STARTS HERE
				################################## */
			
			/* ## COGNITIVE ABILITY STARTS HERE ## */
			
			// cognitive ability header
			// MODIFY IF NECESSARY
			
			$sc_out .= '<style>
                            .subunit td{
                                font-style: italic;
                            }

                            .subtotal td{
                                font-weight: bold;
                               border-bottom: 2px solid #ccc;
                            }

                            .subunithead td{
                                font-weight: bold;
                               border-top: 2px solid #ccc;
                            }
                            </style>
                        ';
			
			global $assessment_name_special;
			global $special_levels; 
			$sc_out .= ' 


                <table class="stdTable withBorders" cellpadding="0" cellspacing="0" border="1">
               			<tr>
								<th colspan=26 class="heading">COGNITIVE ABILITY</th>
						</tr>';
						
			$sc_out .= '  			<tr>
		                                        <th rowspan=2 class="kg"> S/N </>
												<th rowspan=2 class="kg"> Subjects</th>';
												
			global $assessment_name;
			
			if( in_array( $student['level_id'], $special_levels ) ){
			    foreach( $assessment_name_special as $as )
			        $sc_out .= '<th class="kg"> '.$as['name'].' </th>';
			} else
    			foreach( $assessment_name as $as )
    			    $sc_out .= '<th class="kg"> '.$as['name'].' </th>';
			
			$sc_out .= '';
			$sc_out .= '	<th colspan=5 class="kg"> Terms Summary </th>
							<th rowspan=2 class="hg">  Grade </th>
							<th rowspan=2 class="hg">  Remark </th>';
													
												
												
			$sc_out .= ' 				</tr>						
												';
			
			$sc_out .= ' 
               			<tr>';
		    
			
			
			if( in_array( $student['level_id'], $special_levels ) ){
			    foreach( $assessment_name_special as $as ){
			        if( $student['level_id'] <= 3 )
			            $sc_out .= '<th class="kg"> '.$as['weight_junior'].' </th>';
			        else
			            $sc_out .= '<th class="kg"> '.$as['weight_senior'].' </th>';
			    }
			} else {
    			foreach( $assessment_name as $as ){
    				if( $student['level_id'] <= 3 )
    					$sc_out .= '<th class="kg"> '.$as['weight_junior'].' </th>';
    				else	
    					$sc_out .= '<th class="kg"> '.$as['weight_senior'].' </th>';
    			}	
			}
			
			global $default_jss_assessment;
			global $default_sss_assessment;
			global $default_special_assessment;
			if( in_array( $student['level_id'], $special_levels ) )
			    $assessment_to_use =  $default_special_assessment;
			else if( $student['level_id'] < 3 )
				$assessment_to_use =  $default_jss_assessment;
			else 			
			    $assessment_to_use =  $default_sss_assessment;
			
			
			$sc_out .= '<th class="kg"> Obt. </th>';									
			$sc_out .= '									
												<th class="lg">Total </th>
												<th class="kg">Highest</th>
												<th class="kg">Lowest</th>
												<th class="kg">Average</th>											
						</tr>
												';
			


			$i = 0;
            $remark = '';
            // print_r(  $default_session .' --- '. $default_semester );
			// get all the cognitive ability courses for the chosen department and semester
			
            
            
            /* ----------------------- start junior class -------------------------------------------------- */
            if( $student['level_id'] <= 3 ){
                
                global $jss_subjects_nf;
                global $jss_subjects_nf_jss3;
                
                if( $student['level_id'] == 3 )
                    $jss_subjects_nf = $jss_subjects_nf_jss3;
                    
                    
                foreach( $jss_subjects_nf as $jk => $jval ) {
                    
                    $session = $_REQUEST['session'];
                    $crs = new course( $jk );
                    $crs->getCourse();
                    $crs->setSession( $default_session );
                    $crs->level_id = $_REQUEST['level_id'];
                    $i++;
                    
                    $allClassScores = array();
                    $allClassScores = $crs->temp_getAllScoreOnACourse( $default_semester, $this->class );
                    
                    $assess = new assessment();
                    $assess->setCourseId( $crs->id );
                    $assess->setSession( $default_session );
                    $assess->setSemester( $default_semester );
                    $crs->setSemester( $default_semester );
                    
                    
                    if( $crs->resultPublished() || IGNORE_PUBLISH_RESULT ){
                        
                        $trclass = '';
                        $mrspan = '';
                        if( is_array( $jval ) ){
                            $trclass = ' class="subunithead" ';
                            $mrspan = 'colspan=11';
                        }    
                        $sc_out	.='
    								<tr '.$trclass.'>
    														<td>'.$i.'</td>
    														<td '.$mrspan.'>'.$crs->course_title.'</td>';
                        
                        $weight_total = 0;
                        $score_total = 0;
                        $score_string = '';
                        
                        if( !is_array( $jval ) ){
                            foreach( $assessment_to_use as $as ){
                                
                                $crs_assess = $crs->getAssessmentsInCourse( $default_semester, $as[title] );
                                $result = new Result( 0, $crs_assess[0][id], $this->student_id );
                                $ass_score = $result->getStudentAssessmentScore();
                                
                                if( $ass_score !== FALSE ){
                                    $weight_total += $crs_assess[0][weight];
                                    if ( $crs_assess[0][weight] > 0 && $ass_score ){
                                        $score_total += $ass_score;
                                        $score_string .= '	<td>'.$ass_score.'</td>';
                                    } else
                                        $score_string .= '	<td> - </td>';
                                } else
                                    $score_string .= '	<td> - </td>';
                            }
                            
                            $max = 0;
                            
                            // maximum score for this subject in this class
                            if(!empty($allClassScores))
                                foreach( $allClassScores as $as )
                                    if( $max < $as[total] )
                                        $max = $as[total];
                                        
                                        // minimum score for this subject in this class
                           $min = $max;
                           if(!empty($allClassScores))
                                foreach( $allClassScores as $as )
                                    if( $min > $as[total] && $as[total] != 0  )
                                        $min = $as[total];
                                                    
                            
                            $sc_out	.= $score_string;
                            $sc_out	.= '
    											<td class="kg"> '.$weight_total.'</td>
    											<td  class="lg"> '.$score_total.'</td>
                                                <td  class="kg"> '.$max.'</td>
    											<td  class="kg"> '.$min.'</td>
    											<td class="kg">'.( ( $max + $min ) / 2 ).'</td>
                                            ';
                            
                            $agrade_str = $result->getAlphaGradeJunior( $score_total );
                            $remark_str = $result->getGradeRemarkJunior( $score_total );
                            
                            
                            $sc_out	.= '	<td class="hg"> '.$agrade_str.'</td>';
                            $sc_out	.= '	<td class="hg"> <strong>'.$remark_str.'</strong></td>';
                            
                        }
                       
                        
                        $sc_out .= '</tr>';
                        
                        
                        
                        $weight_total2 = 0;
                        $score_total2 = 0;
                        $score_string2 = '';
                        $sub_score_total = 0;
                        $sub_weight_total = 0;
                        $agrade_str_2 = '-';
                        $remark_str_2 = '-';
                        
                        foreach( $assessment_to_use as $as )
                            $total_sub["$as[title]"] = 0;
                        
                        if( is_array( $jval ) ){
                            foreach( $jval as $v ){
                                $crs2 = new course( $v );
                                $crs2->getCourse();
                                $crs2->setSession( $default_session );
                                $crs2->level_id = $_REQUEST['level_id'];
                                
                                $allClassScores2 = array();
                                //$allClassScores2 = $crs2->getAllScoreOnACourse( $default_semester, $this->class );
                                $allClassScores2 = $crs2->temp_getAllScoreOnACourse( $default_semester, $this->class );
                                
                                $score_string2 = '';
                                $sc_out	.='
        													<tr class="subunit">
        														<td></td>
        														<td>'.$crs2->course_title.'</td>';
                                
                                
                                
                                
                                $weight_total2 = $score_total2 = 0;
                                foreach( $assessment_to_use as $as ){
                                    
                                    
                                    $crs_assess2 = $crs2->getAssessmentsInCourse( $default_semester, $as[title] );
                                    $result2 = new Result( 0, $crs_assess2[0][id], $this->student_id );
                                    $ass_score2 = $result2->getStudentAssessmentScore();
                                    
                                    if( $ass_score2 !== FALSE ){
                                        $weight_total2 += $crs_assess2[0][weight];
                                        if ( $crs_assess2[0][weight] > 0 && $ass_score2 ){
                                            $score_total2 += $ass_score2;
                                            $total_sub["$as[title]"] += $ass_score2;
                                            $score_string2 .= '	<td>'.$ass_score2.'</td>';
                                        } else
                                            $score_string2 .= '	<td> - </td>';
                                    } else
                                        $score_string2 .= '	<td> - </td>';
                                }
                                
                                
                                $max2 = 0;
                                
                                // maximum score for this subject in this class
                                if(!empty($allClassScores2))
                                    foreach( $allClassScores2 as $as2 )
                                        if( $max2 < $as2[total] )
                                            $max2 = $as2[total];
                                            
                                    $min2 = $max2;
                                    if(!empty($allClassScores2))
                                        foreach( $allClassScores2 as $as2 )
                                            if( $min2 > $as2[total] && $as2[total] != 0  )
                                                $min2 = $as2[total];
                                                
                                
                                $sc_out	.= $score_string2;
                                $sub_score_total += $score_total2;
                                $sub_weight_total += $weight_total2;
                                $sc_out	.= '
    											<td class="kg"> '.$weight_total2.'</td>
    											<td  class="lg"> '.$score_total2.'</td>';
                                
                                $sc_out .= '<td  class="kg"> '.$max2.'</td>
                                <td  class="kg"> '.$min2.'</td>
                                <td class="kg">'.( ( $max2 + $min2 ) / 2 ).'</td>
                                ';
    
                                $sc_out .= '</tr>';
                            }  
                            
                            $sc_out	.='
        													<tr class="subtotal">
        														<td></td>
        														<td>Total</td>';
                            foreach( $assessment_to_use as $as )
                                $sc_out .= '<td>'.$total_sub["$as[title]"].'</td>';
                            
                            $sc_out	.=' <td>'.$sub_weight_total.'</td>
        									<td>'.$sub_score_total.'</td>';
                            
                            $agrade_str_2 = $result->getAlphaGradeJunior( $sub_score_total );
                            $remark_str_2 = $result->getGradeRemarkJunior( $sub_score_total );
                            
                            /*
                            $sc_out .= '<td  class="kg"> '.$max.'</td>
    											<td  class="kg"> '.$min.'</td>
    											<td class="kg"> '.( ( $max + $min ) / 2 ).'</td>';*/
                            $sc_out .= '<td  class="kg"> - </td>
    											<td  class="kg">  - </td>
    											<td class="kg"> - </td>';
                            
                            $sc_out	.= '	<td class="hg"> '.$agrade_str_2.'</td>';
                            $sc_out	.= '	<td class="hg"> <strong>'.$remark_str_2.'</strong></td>';
                                
                            $sc_out .= '</tr>';
                            
                        }
                        
                        
                    }
                
                }
                // ----------------------- end junior class -------------------------------------------------- /
            } else {            
            
                $semcourses = $this->getSessionSemesterCourses( $default_session, $default_semester, GENERAL_STUDIES_DEPARTMENT_ID );
    			if( !empty( $semcourses ) ){
    			
    			
    				foreach( $semcourses as $s2 )
    	            {
    	               		$session = $_REQUEST['session']; 
    	               		$crs = new course( $s2[course_id] );
    	               		$crs->getCourse();
    	               		$crs->setSession( $default_session );
    						
    						$crs->level_id = $_REQUEST['level_id'];
    	               		$i++;
    						
    	               		// get all student scores for all current level for this semester
    						$allLevelScore = array();
    						$allLevelScore = $crs->getAllScoreOnACourse( $default_semester);
    						
    						// sort the student scores
    						if( $allLevelScore) {				
    							foreach ($allLevelScore as $key => $row) {
    								$level_positions[$key]  = $row[total];
    							}
    							
    							array_multisort( $level_positions, SORT_DESC, $allLevelScore );
    						}
    						
    						$counter = 1;
    						$subj_level_pos = 0;
    						
    						// get the student position in this level
    						foreach( $allLevelScore as $ms ){
    			
    							if( $counter == 1 ){
    								$current_position = 1;
    								$current_position_str = ordinal( $current_position );
    							} else if( $ms[total] == $previous_total ){
    								$current_position_str = '='.ordinal( $current_position );
    							} else {
    								$current_position = $counter;
    								$current_position_str = ordinal( $current_position );
    							}	
    							
    							if( $ms[mystudent_id] == $this->student_id )
    								$subj_level_pos = $current_position_str;
    								
    							$previous_total = $ms[total];
    							$counter++;
    						}
    						
    						// display of the student position for this subject and for this level
    						$subj_level_pos = $subj_level_pos . ' / ' . ( $counter  - 1 );
    						
    						
    						// get all the scores for this subject but for only this class
    						$allClassScores = array();
    						$allClassScores = $crs->temp_getAllScoreOnACourse( $default_semester, $this->class );
    						
    						//$allClassScores = $crs->getAllScoreOnACourse( $default_semester, $this->class );
    						if( !empty( $allClassScores ) ){				
    							foreach ($allClassScores as $key => $row) {
    								$class_positions[$key]  = $row[total];
    							}
    							array_multisort( $class_positions, SORT_DESC, $allClassScores );
    						}
    						
    							
    						$class_counter = 1;
    						$class_pos = 0;
    						
    						// calculating students position in class for this subject
    						foreach( $allClassScores as $cp ){
    			
    							if( $class_counter == 1 ){
    								$current_class_position = 1;
    								$current_class_position_str = ordinal( $current_class_position );
    							} else if( $cp[total] == $previous_total_class ){
    								$current_class_position_str = '='.ordinal( $current_class_position );
    							} else {
    								$current_class_position = $class_counter;
    								$current_class_position_str = ordinal( $current_class_position );
    							}	
    							
    							if( $cp[mystudent_id] == $this->student_id )
    								$class_pos = $current_class_position_str;
    								
    							$previous_total_class = $cp[total];
    							$class_counter++;
    						}
    						
    						// display of class poisiton for this student and for this subject
    						$class_pos = $class_pos . ' / ' . ( $class_counter  - 1 );
    						
    						
    	               		// for this particular course get all the assessments
    	               		$assess = new assessment();
    	               		$assess->setCourseId( $crs->id );
    	               		$assess->setSession( $default_session );
    	               		$assess->setSemester( $default_semester );
    						$crs->setSemester( $default_semester );
    						
    						$ca_1_score = 0;
    						if( $crs->resultPublished() || IGNORE_PUBLISH_RESULT ){
    							
    							$sc_out	.='				
    													<tr>
    														<td>'.$i.'</td>	
    														<td>'.$crs->course_title.'</td>';
    							
    							$weight_total = 0;
    							$score_total = 0;
    							$score_string = '';		
    							
    							foreach( $assessment_to_use as $as ){
    								
    								$crs_assess = $crs->getAssessmentsInCourse( $default_semester, $as[title] );
    								$result = new Result( 0, $crs_assess[0][id], $this->student_id );
    								$ass_score = $result->getStudentAssessmentScore();
    								
    								if( $ass_score !== FALSE ){
    									$weight_total += $crs_assess[0][weight];
    									if ( $crs_assess[0][weight] > 0 && $ass_score ){
    										$score_total += $ass_score;
    										$score_string .= '	<td>'.$ass_score.'</td>';
    									} else 
    										$score_string .= '	<td> - </td>';
    								} else 
    									$score_string .= '	<td> - </td>';
    							}
    							
    							
    							$sc_out	.= $score_string;
    							
    							$max = 0; 
    							
    							// maximum score for this subject in this class
    							if(!empty($allClassScores))					
    								foreach( $allClassScores as $as )
    									if( $max < $as[total] )
    										$max = $as[total];
    							
    							// minimum score for this subject in this class
    							$min = $max;
    							if(!empty($allClassScores))
    								foreach( $allClassScores as $as )
    									if( $min > $as[total] && $as[total] != 0  )
    										$min = $as[total];							
    							
    						
    							//$total_score = ($test1_score + $test2_score + $exam_score);
    							
    							// Display of scores and other info per subject row
    							// MODIFY IF NECESSARY
    							
    							$sc_out	.= '	
    											<td class="kg"> '.$weight_total.'</td>
    											
    											<td  class="lg"> '.$score_total.'</td>
    											<td  class="kg"> '.$max.'</td>
    											<td  class="kg"> '.$min.'</td>
    											<td class="kg">'.( ( $max + $min ) / 2 ).'</td>
    											'; // Summary of terms work
    							
    							if( $student['level_id'] <= 3 ){
    								$agrade_str = $result->getAlphaGradeJunior( $score_total );
    								$remark_str = $result->getGradeRemarkJunior( $score_total );
    							} else {
    								$agrade_str = $result->getAlphaGrade( $score_total );
    								$remark_str = $result->getGradeRemark( $score_total );
    							}
    							
    							$sc_out	.= '	<td class="hg"> '.$agrade_str.'</td>';
    							$sc_out	.= '	<td class="hg"> <strong>'.$remark_str.'</strong></td>';
    							$sc_out	.='
    										</tr>			
    										';
    								
    						}  		
    	            //}
    			     }
			     }
            }
			$sc_out .= '</table>';
			
			/* ------------- END --------------*/
			
			

			
			
			/* ## COGNITIVE ABILITY ENDS HERE ## */	
			
			/* ## AFFECTIVE SKILLS STARTS HERE ## */	
			$effcourses = $this->getSessionSemesterCourses( $default_session, $default_semester, EFFECTIVE_DEVELOPMENT_ID );
			$sc_out .='<table><tr><td>';
			$sc_out .= '<br /><br /><table class="stdTable withBorders" cellpadding="0" cellspacing="0" border="1">
			<tr>
								<th colspan=9 class="heading">B. SKILLS</th>
						</tr>';
						
						
						$grades=array(
						'five'=>5,
						'four'=>4,
						'three'=>3,
						'two'=>2,
						'one'=>1
						
						
						
						
						);
						
						
						$sc_out.='<tr>
		                                        <th rowspan=2 class="kg">TRAITS</>
												<th  class="kg"> POOR</th>
												<th  class="kg">FAIR</th>
												<th class="kg">GOOD</th>
												<th  class="kg">VERY GOOD </th>
												<th  class="kg">EXCELLENT</th>
												
												
												
												
												
												<tr>';
			$j = 0;	
			if(is_array($effcourses) || is_object($effcourses))	{	
			foreach( $effcourses as $s2 )
	            {
	               					
	               		$session = $_REQUEST['session']; 
	               		$crs = new course( $s2[course_id] );
	               		$crs->getCourse();
	               		$crs->setSession( $default_session );
						$crs->setSemester( $default_semester );
						$crs->level_id = $_REQUEST['level_id'];
	               		$j++;
	               		
	               		// for this particular course get all the assessments
	               		$assess = new assessment();
	               		$assess->setCourseId( $crs->id );
	               		$assess->setSession( $default_session );
	               		$assess->setSemester( $default_semester );
						
						$ca_1_score = 0;
						if( $crs->resultPublished() || IGNORE_PUBLISH_RESULT ){
							$psy_score = 0;
							$psy_assess = $crs->getAssessmentsInCourse( $default_semester, '' );
							$result = new Result( 0, $psy_assess[0][id], $this->student_id );
							$psy_score = $result->getStudentAssessmentScore();
							
							if($psy_score )
							
							
								( $j%2 == 0)? $class = 'class="odd"': $class = 'class="even"';
								$sc_out	.='				
													<tr '.$class.'>
														
														<td>'.$crs->course_title.'</td>';
							
								// get ca1 assessment
									
									
								$sc_out	.= '	<td>'.($psy_score == $grades['one']? '&#x2714' : '').'</td>';
								$sc_out	.= '	<td >'.($psy_score == $grades['two']? '&#x2714' : '').'</td>';
								$sc_out	.= '	<td>'.($psy_score == $grades['three']? '&#x2714' : '').'</td>';	
								$sc_out	.= '	<td>'.($psy_score == $grades['four']? '&#x2714' : '').'</td>';									
								$sc_out	.= '	<td>'.($psy_score == $grades['five']? '&#x2714': '').'</td>';
								
								
								
								
								
								$sc_out	.='							
											
											</tr>
											';
							
							
							
						}  		
	            }
			}
			$sc_out .= '</table>';
			/* ## AFFECTIVE SKILLS ENDS HERE ## */	
			
			
			
			/* ## PSYCHOMOTOR STARTS HERE ## */
			
			$psycourses = $this->getSessionSemesterCourses( $default_session, $default_semester, EDUCATION_DEPARTMENT_ID );
			
			// MODIFY IF NECESSARY
			// Display of header
			$sc_out .='</td><td>';
			$sc_out .= '<br /><br /><table class="stdTable withBorders" cellpadding="0" cellspacing="0" border="1">
			<tr>
								<th colspan=9 class="heading">C. BEHAVIOUR </th>
						</tr>';
						
						
						$grades=array(
						'five'=>5,
						'four'=>4,
						'three'=>3,
						'two'=>2,
						'one'=>1
						
						
						
						
						);
						
						
						$sc_out.='<tr>
		                                         <th rowspan=2 class="kg">TRAITS</>
												 
												 <th  class="kg">POOR</th>
												 <th  class="kg">FAIR</th>
												 <th class="kg">GOOD</th>
												 <th  class="kg">VERY GOOD </th>
												<th  class="kg">EXCELLENT</th>
												
												
												
												
												
												<tr>';
							$j = 0;	
			if(is_array($psycourses) || is_object($psycourses))	{	
			foreach( $psycourses as $s2 )
	            {
	               					
	               		$session = $_REQUEST['session']; 
	               		$crs = new course( $s2[course_id] );
	               		$crs->getCourse();
	               		$crs->setSession( $default_session );
						$crs->setSemester( $default_semester );
						$crs->level_id = $_REQUEST['level_id'];
	               		$j++;
	               		
	               		// for this particular course get all the assessments
	               		$assess = new assessment();
	               		$assess->setCourseId( $crs->id );
	               		$assess->setSession( $default_session );
	               		$assess->setSemester( $default_semester );
						
						$ca_1_score = 0;
						if( $crs->resultPublished() || IGNORE_PUBLISH_RESULT ){
							$psy_score = 0;
							$psy_assess = $crs->getAssessmentsInCourse( $default_semester, 'Other' );
							$result = new Result( 0, $psy_assess[0][id], $this->student_id );
							$psy_score = $result->getStudentAssessmentScore();
							if( $psy_score ){
							
							
								( $j%2 == 0)? $class = 'class="odd"': $class = 'class="even"';
								$sc_out	.='				
													<tr '.$class.'>
														
														<td>'.$crs->course_title.'</td>';
							
								// get ca1 assessment
									
								$sc_out	.= '	<td>'.($psy_score == $grades['one']? '&#x2714' : '').'</td>';
								$sc_out	.= '	<td >'.($psy_score == $grades['two']? '&#x2714' : '').'</td>';
								$sc_out	.= '	<td>'.($psy_score == $grades['three']? '&#x2714' : '').'</td>';	
								$sc_out	.= '	<td>'.($psy_score == $grades['four']? '&#x2714' : '').'</td>';									
								$sc_out	.= '	<td>'.($psy_score == $grades['five']? '&#x2714': '').'</td>';
								
								
								
								
								
								$sc_out	.='							
											
											</tr>
											';
							}
						}  		
	            }
			}	
			$sc_out .= '</table>';
			$sc_out .= '</td></tr></table>';

			/* ## PSYCHOMOTOR SKILLS ENDS HERE ## */	
			
			
			
			// calculates the overall class position for a student
			// TODO FOR ALL CLASS POSITIONS
			$classPositionInClass = array();
			$classPositionInClass = $crs->getAllScoreOnAllCourses( $default_semester, $this->class );
			
			
			if( !empty( $classPositionInClass ) ){				
				foreach ( $classPositionInClass as $key => $row ) {
					$class_positions_[$key]  = $row[average];
				}
				
				array_multisort( $class_positions_, SORT_DESC, $classPositionInClass );
			}
			
			$c_counter = 1;
			$c_pos = 0;
						
			foreach( $classPositionInClass as $cp ){
				//print_r( $cp[mystudent_id] . '-->' .$cp[average] .'<br /> ');
				if( $c_counter == 1 ){
					$c_position = 1;
					$c_position_str = ordinal( $c_position );
				} else if( $cp[average] == $p_total_class ){
					$c_position_str = '='.ordinal( $c_position );
				} else {
					$c_position = $c_counter;
					$c_position_str = ordinal( $c_position );
				}	
				
				if( $cp[mystudent_id] == $this->student_id )
					$c_pos = $c_position_str;
				
				$p_total_class = $cp[average];
				$c_counter++;
			}
			
			// display of overall student position 
			// MODIFY IF NECESSARY	
			$classPosition_str = $c_pos . ' of ' . ( $c_counter - 1 ) .' Students';
			
			
			// display of student attendance information
			$attend = new Attendance( $student[student_id], $default_session, $default_semester );
			$attend_arr = $attend->getAnAttendance();
			
			// MODIFY IF NECESSARY
				
     	
			/* ## START GENERAL STUDENT INFORMATION AND COMMENTS ## */	
			global $academic_semester;
				
				// PRINCIPAL, TEACHER AND HOUSE MASTER COMMENT FOR THE TERM 
			$res = new Result();
			$myres = $res->getResultComment( $student['student_id'], $default_session, $default_semester );	
				
				$comment_out .= '<div style="width:100%;"> <table class="stdTable" cellpadding="0" cellspacing="0" border="0">';
				
				$comment_out .= '<tr>
                            <td class="formLabel" style="width:175px;" >Form Teacher Remark:</td>
                            <td class="tbTitle"><i>'.$myres["class"].'</i></td>
						</tr>';		
                
				$comment_out .= '<tr>
                            <td class="formLabel">House Master Remark:</td>
                            <td class="tbTitle"><i>'.$myres["house"].'</i></td>
						</tr>';		
				
				$comment_out .= '<tr>
                            <td class="formLabel">Principal Remark:</td>
                            <td class="tbTitle"><i>'.$myres["principal"].'</i></td>
						</tr>';		
				
                $comment_out .= '
						</table></div>';		
						
				
				
                $out .= $this->pageHeading( $be_view, $student, $default_session, $default_semester, $classPosition_str );
				
				/* ## END GENERAL STUDENT INFORMATION  AND COMMENTS  ## */		
			
				
				
				
				
				if( !$be_view )
						$out .= "\n".'<br /><br />	<div class="long_box floatleft" style="text-align: left;">**DISCLAIMER: <i> 
							To ascertain accuracy of results, parents are adviced to verify results with the
							respective authority in '.INSTITUTION_NAME.'. 
							</i> 
							</div><br /><br />';	
					$out .= $att_out;
					$out .= $sc_out;		

					if( !$be_view )
						$out .= $comment_out;		
		
            				
		/*	
		 * 
		 * TODO		
        } else {
               		$out	.= $form .'				
	               								<tr>
	               									<td colspan="5"> There are currently no results for this term.</td>	
	               									
	               								</tr>
	               					
	               					';
        }*/	
               	                    
            $out	.=	'	</table>';
                
	        return $out;
	        
        }

		
		// printing of thirdterm result
        function printThirdTermResults( $be_view = FALSE )
        {
        	
        	$db = new MySQL();
	        if ( !$db->Open() ) {
	                $db->Kill();
	            }
	            
	        $course = new course();
	        $res = new Result();
	        $student =  $this->getStudent();
		    $studentlevel = new Level( $student['level_id'] );
	        if( $student['level_id'] )
				$current_level = $studentlevel->getLevelDetails();
	        
	        $dept = new Department( $this->department_id );
	        $dept->setDepartment();

	        $fac = new Faculty( $this->faculty_id );
	        $fac->setFaculty();
	        
			// student medical records including height and weight
			$medical = new Medical();
			$medical->setStudentId( $this->student_id );
			$medical->retrieveMedical();
			
			$default_session = ( isset( $_REQUEST['session'] ) && trim( $_REQUEST['session'] ) != '' ) ? $_REQUEST['session'] : CURRENT_ACCADEMIC_SESSION;
			$default_semester = ( isset( $_REQUEST['semester'] ) && trim( $_REQUEST['semester'] ) != ''  ) ? $_REQUEST['semester'] : 1;
			
			
						
			global $academic_session;
			global $academic_semester;
				
			
			
			
			$sc_out .= ' <table class="stdTable withBorders" cellpadding="0" cellspacing="0" border="1">
               			<tr>
								<th colspan=26 class="heading">COGNITIVE ABILITY</th>
						</tr>';
						
			$sc_out .= '  			<tr>
		                                        <th rowspan=2 class="kg"> S/N </>
												<th rowspan=2 class="kg"> Subjects</th>
												<th rowspan=2 class="lg"> 1st Term </th>
												<th rowspan=2 class="lg"> 2nd Term </th>
												';
												
			global $assessment_name;
			foreach( $assessment_name as $as )
				$sc_out .= '<th class="kg"> '.$as['name'].' </th>';
			
			$sc_out .= '';
			$sc_out .= '	
							
							<th colspan=2 class="lg"> 3rd Terms Summary </th>
							<th colspan=5 rowspan=1 class="hg"> Annual Total </th>
							';
													
												
												
			$sc_out .= ' 				</tr>						
												';
			
			$sc_out .= ' 
               			<tr>';
		     
			foreach( $assessment_name as $as ){
				if( $student['level_id'] <= 3 )
					$sc_out .= '<th class="kg"> '.$as['weight_junior'].' </th>';
				else	
					$sc_out .= '<th class="kg"> '.$as['weight_senior'].' </th>';
			}	
				
			$sc_out .= '<th class="lg"> Obt. </th>';									
			$sc_out .= '<th class="lg"> Mark </th>';
			$sc_out .= '<th class="hg"> Obt. </th>';									
			$sc_out .= '<th class="hg"> Mark </th>
			<th class="hg"> Average </th>
			<th class="hg"> Grade </th>
			<th class="hg"> Remark </th></tr>';
												
			
		
			$i = 0;
            $remark = '';
			$total_average = 0;
            // get all the cognitive ability courses for the chosen department and semester
			$semcourses = $this->getSessionSemesterCourses( $default_session, $default_semester, GENERAL_STUDIES_DEPARTMENT_ID );
			
			if( !empty( $semcourses ) ){
			
			
				foreach( $semcourses as $s2 )
	            {
	               		
								
	               		$session = $_REQUEST['session']; 
	               		
						$crs = new course( $s2[course_id] );
	               		$crs->getCourse();
	               		$crs->setSession( $default_session );
						$crs->setSemester( $default_semester );
						$crs->level_id = $_REQUEST['level_id'];
	               		$i++;
						
	               		$allLevelScore = array();
						$allLevelScore = $crs->getAllScoreOnACourse( $default_semester);
						
						if( !empty($allLevelScore) ){				
							foreach ($allLevelScore as $key => $row) {
								$level_positions[$key]  = $row[total];
							}
							array_multisort( $level_positions, SORT_DESC, $allLevelScore ); // resultarray
						}

						
						$counter = 1;
						$subj_level_pos = 0;
						
						foreach( $allLevelScore as $ms ){
			
							if( $counter == 1 ){
								$current_position = 1;
								$current_position_str = ordinal( $current_position );
							} else if( $ms[total] == $previous_total ){
								$current_position_str = '='.ordinal( $current_position );
							} else {
								$current_position = $counter;
								$current_position_str = ordinal( $current_position );
							}	
							
							if( $ms[mystudent_id] == $this->student_id )
								$subj_level_pos = $current_position_str;
								
							$previous_total = $ms[total];
							$counter++;
						}
						
						$subj_level_pos = $subj_level_pos . ' / ' . ( $counter  - 1 );
						
						
						// calculating students position in class
						$allClassScores = array();
						$allClassScores = $crs->temp_getAllScoreOnACourse( $default_semester, $this->class );
						if( !empty( $allClassScores ) ){				
							foreach ($allClassScores as $key => $row) {
								$class_positions[$key]  = $row[total];
							}
							array_multisort( $class_positions, SORT_DESC, $allClassScores );
						}
						
							
						
						$class_counter = 1;
						$class_pos = 0;
						
						foreach( $allClassScores as $cp ){
			
							if( $class_counter == 1 ){
								$current_class_position = 1;
								$current_class_position_str = ordinal( $current_class_position );
							} else if( $cp[total] == $previous_total_class ){
								$current_class_position_str = '='.ordinal( $current_class_position );
							} else {
								$current_class_position = $class_counter;
								$current_class_position_str = ordinal( $current_class_position );
							}	
							
							if( $cp[mystudent_id] == $this->student_id )
								$class_pos = $current_class_position_str;
								
							$previous_total_class = $cp[total];
							$class_counter++;
						}
						
						$class_pos = $class_pos . ' / ' . ( $class_counter  - 1 );
						
	               		// for this particular course get all the assessments
	               		$assess = new assessment();
	               		$assess->setCourseId( $crs->id );
	               		$assess->setSession( $default_session );
	               		$assess->setSemester( $default_semester );
						
						
						if( $crs->resultPublished() || IGNORE_PUBLISH_RESULT ){
						
							
							$sc_out	.='				
													<tr>
														<td>'.$i.'</td>	
														<td>'.$crs->course_title.'</td>';
														// get 1st Term assement total
							
							
							global $default_jss_assessment;
							global $default_sss_assessment;
							if( $student['level_id'] <= 3 ){
								$assessment_to_use =  $default_jss_assessment;
								
							} else {			
								$assessment_to_use =  $default_sss_assessment;
								
							}
							$_out = '';
							
							
							// FIRST TERM	
							$weight_1 = 0;
							$t1_score_tot = 0;
							$has_result_1 = FALSE;
							
							foreach( $assessment_to_use as $as ){
								$t1_assess = $crs->getAssessmentsInCourse( 1, $as[title] );
								$result1 = new Result( 0, $t1_assess[0][id], $this->student_id );
								$t1_score = $result1->getStudentAssessmentScore();
								
								
								if( $t1_score !== FALSE && trim( $t1_score ) != ''  ){
									$weight_1 += $t1_assess[0][weight];
									if ( $t1_assess[0][weight] > 0 && $t1_score )
										$t1_score_tot += $t1_score;
									$has_result_1 = TRUE;
								}
								
							}
							//$nscore = $crs->getStudentCumulativeScore( $this->student_id, 1 );							
							$_out .= $has_result_1 ? '<td CLASS="lg">'.$t1_score_tot.'</td>' : '<td CLASS="lg"> - </td>';
								
							// SECOND TERM	
							$weight_2 = 0;
							$t2_tot_score = 0;
							$has_result_2 = FALSE;
							
							foreach( $assessment_to_use as $as ){
								$t2_assess = $crs->getAssessmentsInCourse( 2, $as[title] );
								$result2 = new Result( 0, $t2_assess[0][id], $this->student_id );
								$t2_score = $result2->getStudentAssessmentScore();
								
								if( $t2_score !== FALSE  && trim( $t2_score ) != ''  ){
									$weight_2 += $t2_assess[0][weight];
									if ( $t2_assess[0][weight] > 0 && $t2_score )
										$t2_tot_score += $t2_score;
									$has_result_2 = TRUE;	
								}		
							}
							
							$_out .= $has_result_2 ? '<td CLASS="lg">'.$t2_tot_score.'</td>' : '<td CLASS="lg"> - </td>';
							// THIRD TERM RESULT
							
							$weight_3 = 0;
							$t3_total_score = 0;
							$no_of_assessments = 0;
							$has_result_3 = FALSE;								
							foreach( $assessment_to_use as $as ){
								$t3_att_assess = $crs->getAssessmentsInCourse( 3, $as[title] );
								$result3 = new Result( 0, $t3_att_assess[0][id], $this->student_id );
								$t3_score = $result3->getStudentAssessmentScore();
								$_out .= $t3_score ? '<td>'.$t3_score.'</td>' : '<td> - </td>';	
								
								
								if( $t3_score !== FALSE  && trim( $t3_score ) != '' ){
									$weight_3 += $t3_att_assess[0][weight];
									if ( $t3_att_assess[0][weight] > 0 && $t3_score )
										$t3_total_score += $t3_score;
									
									$has_result_3 = TRUE;
								}	
								$no_of_assessments++;
							}
							
							
							$weight_tot = $weight_1 + $weight_2 + $weight_3;
							$tot_score = $t1_score_tot + $t2_tot_score + $t3_total_score;
							
							
							if( $has_result_3 ){
								$_out .= '
								<td class="lg">'.$weight_3.'</td>
								<td class="lg">'.$t3_total_score.'</td>
									';
							} else {
								$_out .= '
								<td class="lg"> - </td>
								<td class="lg"> - </td>
									';
							}
							//$annual_weight=300;
							//$annaul_result = ( $first_term_summary_result + $second_term_summary_result + $third_term_summary_result )/3;
							
							
							$annualAllClassScores = $crs->getAllScoreOnACourse( FALSE, $this->class );
							if(!empty($annualAllClassScores))					
								foreach( $annualAllClassScores as $as )
									if( $max < $as[total] )
										$max = $as[total];
							
							$min = $max;
							if(!empty($annualAllClassScores))
								foreach( $annualAllClassScores as $as )
									if( $min > $as[total] && $as[total] != 0  )
										$min = $as[total];
										
										
							$annaul_average	=  ( ($max/3) + ($min/3) ) / 2;
							
							
							$max = 0; 
							$counter = 0;
							$avg_total = 0;

							//$sc_out	.= '	
							//				<td class="lg">'.$first_term_summary_result.'</td>'; 

							//$sc_out	.= '	
							//				<td class="lg">'.$second_term_summary_result.'</td>
							//				'; 
							
							$sc_out	.= $_out;
							$average__ = $tot_score / $weight_tot * 100;
							$total_average += $average__ ; 
							$total_score += $tot_score ;
							$avg_str = ( round( $average__ ) >= 40 ) ? round( $average__ ).'%' : '<font color=red>'.round( $average__ ).'%</font>' ;
							
							$sc_out	.= '	<td class="hg"> '.$weight_tot.' </td> 
									<td class="hg"> '.$tot_score.'</td>
									
									<td class="hg"> '.$avg_str.'</td>';
									
							if( $student['level_id'] <= 3 ){
								$agrade_str = $result3->getAlphaGradeJunior( $average__ );
								$remark_str = $result3->getGradeRemarkJunior( $average__ );
							} else {
								$agrade_str = $result3->getAlphaGrade( $average__ );
								$remark_str = $result3->getGradeRemark( $average__ );
							}
							
							$sc_out	.= '	<td class="hg"> '.$agrade_str.'</td>';
							$sc_out	.= '	<td class="hg"> <strong>'.$remark_str.'</strong></td>';		
									
									
							//$sc_out	.= '	<td class="hg"> '.$result3->getAlphaGrade( $average__ ).'</td>';
							//$sc_out	.= '	<td class="hg"> '.$result3->getGradeRemark( $average__ ).'</td>';
							$sc_out	.='
										</tr>			
										';					
								
							
								
						}  
					
	            }
			//}
			$no_of_subjects = $i;
			$colspan = 10 +  $no_of_assessments;
			$sc_out .= '
						<tr>
								<td style="text-align:right" class="lg" colspan="'.$colspan.'">No of Subjects</td>
								<td class="lg">'.$no_of_subjects.'</td>
						</tr>
						<tr>
								<td style="text-align:right" align="right" class="lg" colspan="'.$colspan.'">Total</td>
								<td class="lg">'.round(  $total_score ).'</td>
						</tr>
						<tr>
								<td style="text-align:right" align="right" class="lg" colspan="'.$colspan.'">Average</td>
								<td class="lg">'.round(  $total_average / $no_of_subjects  ).'%</td>
						</tr>';
			
			
			$sc_out .= '</table>';
			
			
			$overAllPositionArray = array();
			$overAllTotals = array();	
         
			$overAllPositionArray = $crs->getAllScoreOnAllCourses();
			
			if( !empty( $overAllPositionArray ) ){				
				foreach ( $overAllPositionArray as $key => $row ) {
					/*$level_positions_[$key]  = $row[total];*/
					$level_positions_[$key]  = $row[average];
				}
				
				array_multisort( $level_positions_, SORT_DESC, $overAllPositionArray );
			}
			
			$o_counter = 1;
			$o_pos = 0;
						
			foreach( $overAllPositionArray as $cp ){
				//print_r( $cp[mystudent_id] .' - ' . $cp[total] .'<br />' );
				
				if( $o_counter == 1 ){
					$o_position = 1;
					$o_position_str = ordinal( $o_position );
				} else if( $cp[average] == $o_total_class ){
					$o_position_str = '='.ordinal( $o_position );
				} else {
					$o_position = $o_counter;
					$o_position_str = ordinal( $o_position );
				}	
				
				if( $cp[mystudent_id] == $this->student_id )
					$o_pos = $o_position_str;
				
				$o_total_class = $cp[average];
				$o_counter++;
			}
				
			$print_position_str = $overallPosition_str = $o_pos . ' of ' . ( $o_counter - 1 ) .' Students';
			
			
			
			$overAllpositionInClass=array();
			$overAllClassTotals = array();
			$overAllpositionInClass =$crs->getAllScoreOnAllCourses( FALSE, $this->class);

			if( !empty( $overAllpositionInClass ) ){				
				foreach ( $overAllpositionInClass as $key => $row ) {
					$class_positions_[$key]  = $row[average];
				}
				
				array_multisort( $class_positions_, SORT_DESC, $overAllpositionInClass );
			}
			
			$c_counter = 1;
			$c_pos = 0;
			//print_r( $overAllpositionInClass );
			
			foreach( $overAllpositionInClass as $cp ){
				
				if( $c_counter == 1 ){
					$c_position = 1;
					$c_position_str = ordinal( $c_position );
				} else if( $cp[average] == $c_total_class ){
					$c_position_str = '='.ordinal( $c_position );
				} else {
					$c_position = $c_counter;
					$c_position_str = ordinal( $c_position );
				}	
				
				if( $cp[mystudent_id] == $this->student_id )
					$c_pos = $c_position_str;
				
				$c_total_class = $cp[average];
				$c_counter++;
			}
				
			$print_class_position_str = $overallClassPosition_str = $c_pos . ' of ' . ( $c_counter - 1 ) .' Students';
			
			/* ## AFFECTIVE SKILLS STARTS HERE ## */	
			$effcourses = $this->getSessionSemesterCourses( $default_session, $default_semester, EFFECTIVE_DEVELOPMENT_ID );
			$sc_out .='<table><tr><td>';
			$sc_out .= '<br /><br /><table class="stdTable withBorders" cellpadding="0" cellspacing="0" border="1">
			<tr>
								<th colspan=9 class="heading">B. SKILLS</th>
						</tr>';
						
						
						$grades=array(
						'five'=>5,
						'four'=>4,
						'three'=>3,
						'two'=>2,
						'one'=>1
						
						
						
						
						);
						
						
						$sc_out.='<tr>
		                                        <th rowspan=2 class="kg">TRAITS</>
												<th  class="kg"> POOR</th>
												<th  class="kg">FAIR</th>
												<th class="kg">GOOD</th>
												<th  class="kg">VERY GOOD </th>
												<th  class="kg">EXCELLENT</th>
												
												
												
												
												
												<tr>';
			$j = 0;	
			if(is_array($effcourses) || is_object($effcourses))	{	
			foreach( $effcourses as $s2 )
	            {
	               					
	               		$session = $_REQUEST['session']; 
	               		$crs = new course( $s2[course_id] );
	               		$crs->getCourse();
	               		$crs->setSession( $default_session );
						$crs->setSemester( $default_semester );
						$crs->level_id = $_REQUEST['level_id'];
	               		$j++;
	               		
	               		// for this particular course get all the assessments
	               		$assess = new assessment();
	               		$assess->setCourseId( $crs->id );
	               		$assess->setSession( $default_session );
	               		$assess->setSemester( $default_semester );
						
						$ca_1_score = 0;
						if( $crs->resultPublished() || IGNORE_PUBLISH_RESULT ){
						
							$psy_assess = $crs->getAssessmentsInCourse( $default_semester, '' );
							$result = new Result( 0, $psy_assess[0][id], $this->student_id );
							$psy_score = $result->getStudentAssessmentScore();
							
							if($psy_score )
							
							
								( $j%2 == 0)? $class = 'class="odd"': $class = 'class="even"';
								$sc_out	.='				
													<tr '.$class.'>
														
														<td>'.$crs->course_title.'</td>';
							
								// get ca1 assessment
									
									
								$sc_out	.= '	<td>'.($psy_score == $grades['one']? '&#x2714' : '').'</td>';
								$sc_out	.= '	<td >'.($psy_score == $grades['two']? '&#x2714' : '').'</td>';
								$sc_out	.= '	<td>'.($psy_score == $grades['three']? '&#x2714' : '').'</td>';	
								$sc_out	.= '	<td>'.($psy_score == $grades['four']? '&#x2714' : '').'</td>';									
								$sc_out	.= '	<td>'.($psy_score == $grades['five']? '&#x2714': '').'</td>';
								
								
								
								
								
								$sc_out	.='							
											
											</tr>
											';
							
							
							
						}  		
	            }
			}
			$sc_out .= '</table>';
			/* ## AFFECTIVE SKILLS ENDS HERE ## */	
			
			
			
			/* ## PSYCHOMOTOR STARTS HERE ## */
			
			$psycourses = $this->getSessionSemesterCourses( $default_session, $default_semester, EDUCATION_DEPARTMENT_ID );
			
			// MODIFY IF NECESSARY
			// Display of header
			$sc_out .='</td><td>';
			$sc_out .= '<br /><br /><table class="stdTable withBorders" cellpadding="0" cellspacing="0" border="1">
			<tr>
								<th colspan=9 class="heading">C. BEHAVIOUR </th>
						</tr>';
						
						
						$grades=array(
						'five'=>5,
						'four'=>4,
						'three'=>3,
						'two'=>2,
						'one'=>1
						
						
						
						
						);
						
						
						$sc_out.='<tr>
		                                         <th rowspan=2 class="kg">TRAITS</>
												 
												 <th  class="kg">POOR</th>
												 <th  class="kg">FAIR</th>
												 <th class="kg">GOOD</th>
												 <th  class="kg">VERY GOOD </th>
												<th  class="kg">EXCELLENT</th>
												
												
												
												
												
												<tr>';
							$j = 0;	
			if(is_array($psycourses) || is_object($psycourses))	{	
			foreach( $psycourses as $s2 )
	            {
	               					
	               		$session = $_REQUEST['session']; 
	               		$crs = new course( $s2[course_id] );
	               		$crs->getCourse();
	               		$crs->setSession( $default_session );
						$crs->setSemester( $default_semester );
						$crs->level_id = $_REQUEST['level_id'];
	               		$j++;
	               		
	               		// for this particular course get all the assessments
	               		$assess = new assessment();
	               		$assess->setCourseId( $crs->id );
	               		$assess->setSession( $default_session );
	               		$assess->setSemester( $default_semester );
						
						$ca_1_score = 0;
						if( $crs->resultPublished() || IGNORE_PUBLISH_RESULT ){
						
							$psy_assess = $crs->getAssessmentsInCourse( $default_semester, 'Other' );
							$result = new Result( 0, $psy_assess[0][id], $this->student_id );
							$psy_score = $result->getStudentAssessmentScore();
							if( $psy_score ){
							
							
								( $j%2 == 0)? $class = 'class="odd"': $class = 'class="even"';
								$sc_out	.='				
													<tr '.$class.'>
														
														<td>'.$crs->course_title.'</td>';
							
								// get ca1 assessment
									
								$sc_out	.= '	<td>'.($psy_score == $grades['one']? '&#x2714' : '').'</td>';
								$sc_out	.= '	<td >'.($psy_score == $grades['two']? '&#x2714' : '').'</td>';
								$sc_out	.= '	<td>'.($psy_score == $grades['three']? '&#x2714' : '').'</td>';	
								$sc_out	.= '	<td>'.($psy_score == $grades['four']? '&#x2714' : '').'</td>';									
								$sc_out	.= '	<td>'.($psy_score == $grades['five']? '&#x2714': '').'</td>';
								
								
								
								
								
								$sc_out	.='							
											
											</tr>
											';
							}
						}  		
	            }
			}	
			$sc_out .= '</table>';
			$sc_out .= '</td></tr></table>';
			
			/* ## PSYCHOMOTOR SKILLS ENDS HERE ## */	
			
			$sc_out .= '<table>
						<tbody>
						<tr>
								<th colspan="9" class="heading">SCALE</th>
						</tr>
					<tr>
						
					
                            <td class="formLabel"><strong>5-</strong><i>Excellent degree of observable trait </i></td>
							<td class="formLabel"><strong>4-</strong><i>Good level of observable trait</i></td>
							<td class="formLabel"><strong>3-</strong><i>Fair in observable trait</i></td>
							
							
                         </tr>
						
                                                                                                                                                                                               
                
                         <tr>
                            <td class="formLabel"><strong>2-</strong><i>Poor in observable trait</i></td>
                            <td class="formLabel"><strong>2-</strong><i>No observable trait</i></td>
                           
                         </tr>	
													 
					 </tbody>
					 </table><br /><br />';
			
			
			
			
			
			
			
			
			
			$attend = new Attendance( $student[student_id], $default_session, $default_semester );
			$attend_arr = $attend->getAnAttendance();
				// PRINCIPAL, TEACHER AND HOUSE MASTER COMMENT FOR THE TERM 
				$res = new Result();
				$myres = $res->getResultComment( $student['student_id'], $default_session, $default_semester );	
				
				$comment_out .= '<div style="width:100%;"> <table class="stdTable" cellpadding="0" cellspacing="0" border="0">';
				
				$comment_out .= '<tr>
                            <td class="formLabel" style="width:175px;" >Form Teacher Remark:</td>
                            <td class="tbTitle"><strong><i>'.$myres["class"].'</i></strong></td>
						</tr>';		
                	
				
				$comment_out .= '<tr>
                            <td class="formLabel">Principal Remark:</td>
                            <td class="tbTitle"><strong><i>'.$myres["principal"].'</i></strong></td>
						</tr>';		
				
                $comment_out .= '
						</table></div>';		
						
				
				
				if( !$be_view )
					$out .= $this->pageHeading( $be_view, $student, $default_session, $default_semester, $print_class_position_str );
				
					// $out .= $this->pageHeading( $be_view, $student, $default_session, $default_semester, $classPosition_str );
				
				
				
				if( !$be_view )
						$out .= "\n".'<br /><br />	<div class="long_box floatleft" style="text-align: left;">**DISCLAIMER: <i> 
							To ascertain accuracy of results, parents are adviced to verify results with the
							respective authority in '.INSTITUTION_NAME.'. 
							</i> 
							</div><br /><br />';	
					
				$out .= $sc_out;		
				
				$out .= $comment_out;	
					
					
               	} else {
               		$out	.= $form .'						
	               								<tr>
	               									<td colspan="5"> There are currently no results for this term.</td>	
	               									
	               								</tr>
	               					
	               					';
               	}	
               	                    
            $out	.=	'	</table>';
                
	        return $out;
	        
        }
		
		
		function pageHeading( $be_view = FALSE, $student, $default_session, $default_semester, $classPosition_str )
		{
			
			global $academic_session;
			global $academic_semester;
			
			$dept = new Department( $this->department_id );
	        $dept->setDepartment();

	        $fac = new Faculty( $this->faculty_id );
	        $fac->setFaculty();
			
	        $studentlevel = new Level( $student['level_id'] );
	        
	        if( $student['level_id'] )
	            $current_level = $studentlevel->getLevelDetails();
	        
			$birthDate = explode("/", $student[dob]);
			$age = ( date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") )
					? ((date("Y") - $birthDate[2]) - 1)
					: (date("Y") - $birthDate[2]);
				
						
			if( $student['level_id'] > 3 )
				$level_str =  $dept->department_code .($student['level_id'] - 3) .$student['class'];
			else
				 $level_str = $current_level[name].''.$student['class'];
			
			$attend = new Attendance( $student[student_id], $default_session, $default_semester );
			$attend_arr = $attend->getAnAttendance();
			
			
			 $head_out = '
				<div class="print_head print_only">
                    <table>
						<TR>	
                             <td style="text-align: center;">
                                <img src="'.RESULT_LOGO.'" alt="college logo" />
                            </td>
							<td style="text-align: center;">
                              '.RESULT_PRINT_HEAD.'
                            </td>
							<td style="text-align: center;">
								<img src="'.PASSPORT_URL.$student[photo].'" class="imageThumb" alt="passport" width="120px" height="120px" />
							</td>
                        </tr>
                    </table>
                </div>';
			
				$file = '?action=assessment';
				
				// !important. js to hide or show the show results page
				$form = "<script type='text/javascript'>
					function showDiv(id, id2, id3) {
						document.getElementById(id).style.display = 'block';
						document.getElementById(id2).style.display = 'none';
						document.getElementById(id3).style.display = 'block';
					}
					
					function hideDiv(id, id2, id3) {
						document.getElementById(id).style.display = 'none';
						document.getElementById(id2).style.display = 'block';
						document.getElementById(id3).style.display = 'none';
					}
					</script>";
				
					
				
				$form .= '
							<div class="hidden">';
				
				$form .=	'
							<div id="hide" style="display: none; width: 100%; text-align: right">
								<a style="text-decoration:none" href="#" onclick="'."hideDiv('searchform', 'show', 'hide' ); return false;".' ">
									&nbsp;&nbsp;&nbsp;Hide search form &nbsp;<img src="'.COE_URL.'/media/closeup.png" border=0>&nbsp;&nbsp;&nbsp;
								</a>
							</div>
							<div id="show" style="width: 100%; text-align: right;">
								<a style="text-decoration:none" href="#" onclick="'."showDiv('searchform', 'show', 'hide' ); return false;".' ">
									&nbsp;&nbsp;&nbsp;Search for other results &nbsp;&nbsp;<img src="'.COE_URL.'/media/opendown.png" border=0>&nbsp;&nbsp;&nbsp;
								</a>
							</div>
										';
				// !important end
				
				$form .= '
							<div id="searchform" style="display: none;">
							<form action="'.$file.'" method="POST">
							<table class="stdTable" cellpadding="0" cellspacing="0" border="0">
						';
						
				
				
				$lev = new Level();
                $levels = $lev->getAllLevels();
                
                $c = 0;
                foreach( $levels as $ls ){
                	$cp = $c+1;
                	$array_level[$c]['value'] = "$cp";
                	$array_level[$c]['name'] = $ls['name'];
                	$c++;
                }
				
				
				$form .= '<input type="hidden" name="session" value="'.$default_session.'" />';
				$form .= '<input type="hidden" name="level_id" value="'.$_REQUEST['level_id'].'" />';
				$form .= "\n".createTwoColFormLabelSelect( 'Choose Term:', $default_semester, 'semester', $academic_semester, "inputTxt mediumInputTxt", 1, $error['semester'] );

				
				$form .= '<tr>
                            <TH></TH>
							<th><input type="submit" name="Change" class="stdButton" STYLE="float: left;" value="View Results" > </th>
                         </tr>
                        </table>
                            </form>
						</div>	
						</div>				
                     ';
				
			if( !$be_view )
				$head_out .= $form;
			
		      
		    global $special_levels;
		    if( in_array( $student['level_id'], $special_levels ) )
		        $mock_str = '(Mock Exams)';
		    
		    $head_out .= "\n".'<h3> Progress Report '.$academic_semester[$default_semester]['name'].' '.$default_session.' '.$mock_str.'</h3><br />';
			$head_out .= "\n".'
                <table class="stdTable" cellpadding="0" cellspacing="0" border="0">
                   ';

				$head_out .= '<tr>
                            <td colspan="2" class="formLabel">'.NAME_LABEL.':</td>
                            <td colspan="2" class="tbTitle">'.$student[firstname].' '.strtoupper( $student[surname] ).', '.$student[othernames].'</td>
                            
							<td colspan="2" class="formLabel">'.SEX_LABEL.':</td>
                            <td colspan="2" class="tbTitle">'.$student[sex].'</td>
							
							</tr>';
				
                $head_out .= '<tr>
                            <td colspan="2" class="formLabel">Current Class:</td>
                            <td colspan="2" class="tbTitle">'.$level_str.'</td>
							<td colspan="2" class="formLabel">'.MATRIC_NUMBER_LABEL.':</td>
                            <td colspan="2" class="tbTitle">'.$student[matriculation_no].'</td>
							
                        </tr>';
				/*
				 $head_out .= '<tr>
                             <td colspan="2" class="formLabel">Department:</td>
                            <td colspan="2" class="tbTitle">'.$fac->name.'</td>
							<td colspan="2" class="formLabel">Course:</td>
                            <td colspan="2" class="tbTitle">'.$dept->department_code.'</td>
						 </tr>';
						 
				 $head_out .= '<tr>
                             <td colspan="2" class="formLabel">State of Origin:</td>
                            <td colspan="2" class="tbTitle">'.$student[state_of_origin].'</td>
							<td colspan="2" class="formLabel">House:</td>
                         	<td colspan="2" class="tbTitle">'.$student[house].'</td>
						 </tr>';	
				*/		
				// Display of student position
				
				if( $student['level_id'] <= 3 )
					$head_out .= '<tr>		
                            <td colspan="2" class="formLabel">Position:</td>
                            <td colspan="2" class="tbTitle">'.$classPosition_str.'</td>
							<td colspan="2" class="formLabel"></td>
                            <td colspan="2" class="tbTitle"></td>
                        </tr>';	
						
				$head_out .= '</table>';

				
			return $head_out;
		
		
		}
		
		
}

?>