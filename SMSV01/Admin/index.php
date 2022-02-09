<?php
session_start();
if(!isset($_SESSION['USERNAME'])){
echo "<script>
location='../'
</script>";	
}


$role = $_SESSION["ROLE"];
require_once('../classes/class.staff.php');
include_once('../classes/class.Feeitem.php');

$feeitem = new FeeItem();
$students = new Students();
$staffAction = new Staff();
if(!empty($students->viewStudentbyIDofStatusAlumni())){
	
	$feeitem->moveDebtorsHistoryofAlumni();
	
	//$students->viewStudentbyIDForGraduation();
}
//$studentclass = new StudentClasses();
//$availableSession = new Session_class();
//$term = new Term();
//$subject = new Subject();
//$createscore = new Scores();
//$database = new Database();
  $staffAction->staff_id = $_SESSION['USERNAME'];
 $staffAction->viewStaffbyID();
	

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" href="../imageupload/logo.jpg ">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>VS45</b>TECH</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><!--4 --></span>
            </a>
            <ul class="dropdown-menu">
             <!--
              <li class="header">You have 4 messages</li> -->
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message 
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                    -->
                  </li>
                  <!-- end message -->
                  <li>
                   <!--
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a> -->
                  </li>
                  <li>
                   <!--
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a> -->
                  </li>
                  <li>
                   <!--
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>-->
                  </li>
                  <li>
                   <!--
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a> -->
                  </li>
                </ul>
              </li>
               <!--
              <li class="footer"><a href="#">See All Messages</a></li> -->
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
               <!--
              <span class="label label-warning">10</span> -->
            </a>
            <ul class="dropdown-menu">
             <!--
              <li class="header">You have 10 notifications</li> -->
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                   <!--
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a> -->
                  </li>
                  <li>
                   <!--
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a> -->
                  </li>
                  <li>
                   <!--
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a> -->
                  </li>
                  <li>
                   <!--
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a> -->
                  </li>
                  <li>
                   <!--
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>-->
                  </li>
                </ul>
              </li>
               <!--
              <li class="footer"><a href="#">View all</a></li> -->
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
               <!--
              <span class="label label-danger">9</span> -->
            </a>
            <ul class="dropdown-menu">
             <!--
              <li class="header">You have 9 tasks</li> -->
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                   <!--
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>-->
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                   <!--
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>-->
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                   <!--
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>-->
                  </li>
                  <!-- end task item -->
                  <!-- Task item <li>
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                   -->
                  <!-- end task item -->
                </ul>
              </li>
               <!--
              <li class="footer">
                <a href="#">View all tasks</a>
              </li> -->
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <?php
               if(!empty($staffAction->image)){
					 ?>
					
                    <img src="<?php echo $staffAction->image;?>" width="50" height="50">
                    <?php }else{?>
              <span class="fa fa-user" ><?php   echo $_SESSION["ID"];?>
			  </span>
               <?php }?>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <?php
               if(!empty($staffAction->image)){
					 ?>
					
                    <img src="<?php echo $staffAction->image;?>" width="80" height="80">
                    <?php }?>

                <p>
                <?php   echo $_SESSION["ID"];?>
         
                  <small><p> <?php   echo $_SESSION["ROLE"];?></p>
         </small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
               
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="staff_profile.php" target="iframe_info" class="btn btn-default ">Profile</a>
                   
                </div>
                <div class="pull-left">
                  <a href="change_password.php" target="iframe_info" class="btn btn-default "> Password</a>
                   
                </div>
                <div class="pull-right">
                 <a href="javascript:;" data-toggle="modal" data-target="#confirmModal" class=" btn btn-default ">Sign Out</a>
                </div>
              </li>
            </ul>
          </li>
          
          
         
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           <p> <?php   echo $_SESSION["ID"];?></p>
        </div>
        <div class="pull-left info">
           <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       <!--  <li class="header">MAIN NAVIGATION</li>-->
        <?php if($role === "Cashier"){  // only cashiers section ?>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Fees Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li class="active"><a href="Create_fee_cat.php" target="iframe_info"><i class="fa fa-circle-o"></i> Create Fee Category</a></li>
             <li class="active"><a href="View_fee_cat.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Fee Category</a></li>
            <li class="active"><a href="Create_fee_item.php" target="iframe_info"><i class="fa fa-circle-o"></i> Asign Fee to Classes</a></li>
            <li class="active"><a href="cashier_view_fee_item.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Asigned Fee</a></li>
            <li class="active"><a href="pay_fee.php" target="iframe_info"><i class="fa fa-circle-o"></i> Pay Fee</a></li>
            <li class="active"><a href="close_account.php" target="iframe_info"><i class="fa fa-circle-o"></i>  Close Account</a></li>
            
          ></ul>
        </li>
		
		 <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Fee Transactions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="payment_history.php" target="iframe_info"><i class="fa fa-circle-o"></i> Payment History</a></li>
            <li class="active"><a href="debtor_history.php" target="iframe_info"><i class="fa fa-circle-o"></i> Debtors History</a></li>
           <li class="active"><a href="alumni_payment_history.php" target="iframe_info"><i class="fa fa-circle-o"></i> Alumni Payment History</a></li>
           <li class="active"><a href="alumni_debtor_history.php" target="iframe_info"><i class="fa fa-circle-o"></i>Alumni Debtors History</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Bank Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li class="active"><a href="create_bank.php" target="iframe_info"><i class="fa fa-circle-o"></i> Create Bank</a></li>
            <li class="active"><a href="view_bank.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Bank</a></li>
         
          </ul>
        </li>
		<?php  }else{?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>School Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if($role === "Admin"  || $role === "Academicofficer" || $role === "Principal"  || $role === "Dean" || $role === "Adminofficer"){ ?>
            <li class="active"><a href="school_setup.php" target="iframe_info"><i class="fa fa-circle-o"></i> Configure School</a></li>
             <li class="active"><a href="setup_academic_term.php" target="iframe_info"><i class="fa fa-circle-o"></i> Setup Academic Term</a></li>
          
           
           <li class="active"><a href="next_term_begin.php" target="iframe_info"><i class="fa fa-circle-o"></i> Next Term Begin</a></li>
           <?php } ?>
           <!--  <li class="active"><a href="create_cognitiveskills.php" target="iframe_info"><i class="fa fa-circle-o"></i> Create Cognitive Skills</a></li>-->
           <li class="active"><a href="view_cognitiveskills.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Psychomotive Skills</a></li>
         
          <!--  <li class="active"><a href="database_backup.php" target="iframe_info"><i class="fa fa-circle-o"></i> Backup Database</a></li>-->
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i>
            <span>Assessment Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <?php if($role === "Admin"  || $role === "Academicofficer" || $role === "Principal"  || $role === "Dean" || $role === "Adminofficer"){ ?>
            <li class="active"><a href="create_grade.php" target="iframe_info"><i class="fa fa-circle-o"></i> Set Grade</a></li>
            <li class="active"><a href="view_allGrades.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Grades</a></li>
            <li><a href="view_assessmentweight.php" target="iframe_info"><i class="fa fa-circle-o"></i> Manage  Assessment Type</a></li>
			 <li><a href="principal_remark.php" target="iframe_info"><i class="fa fa-circle-o"></i> Principal  Remark </a></li>
              <li><a href="manage_principal_remark.php" target="iframe_info"><i class="fa fa-circle-o"></i> Manage Principal Remark </a></li>
			<?php }else{  ?>
             <li><a href="assesment_type.php" target="iframe_info"><i class="fa fa-circle-o"></i> View  Assessment Type</a></li><?php } ?>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i>
            <span>Class Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <?php if($role === "Admin"  || $role === "Academicofficer" || $role === "Principal"  || $role === "Dean" || $role === "Adminofficer"){ ?>
            <li><a href="create_class.php" target="iframe_info"><i class="fa fa-circle-o"></i> Create Class</a></li>
              <li><a href="create_classarm.php" target="iframe_info"><i class="fa fa-circle-o"></i> Create Class Arm</a></li><?php  }?>
            <li><a href="view_allclasses.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Classes</a></li>
          
            <li><a href="view_classarm.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Class Arm</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Term/Session Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <?php if($role === "Admin"  || $role === "Academicofficer" || $role === "Principal"  || $role === "Dean" || $role === "Adminofficer"){ ?>  
            <li class="active"><a href="create_term.php" target="iframe_info"><i class="fa fa-circle-o"></i> Create Term</a></li>
            <li class="active"><a href="view_term_edit.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Term</a></li>
           <li class="active"><a href="create_session.php" target="iframe_info"><i class="fa fa-circle-o"></i> Create Session</a></li>
            <li class="active"><a href="view_session_edit.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Session</a></li><?php }else{ ?>
             <li class="active"><a href="view_session.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Session</a></li>
              <li class="active"><a href="view_term.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Term</a></li><?php } ?>
          </ul>
        </li>
        <?php if($role === "Admin"  || $role === "Academicofficer" || $role === "Principal"  || $role === "Dean" || $role === "Adminofficer"){ ?> 
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Staff Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="Register_staff.php" target="iframe_info"><i class="fa fa-circle-o"></i> Create Staff</a></li>
            <li><a href="manage_staff.php" target="iframe_info"><i class="fa fa-circle-o"></i> Manage Staff</a></li>
           
          </ul>
        </li><?php } ?>
        <!--
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Student Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <?php if($role === "Admin"  || $role === "Academicofficer" || $role === "Principal"  || $role === "Dean" || $role === "Adminofficer"){ ?>
            <li><a href="stepform.php" target="iframe_info"><i class="fa fa-circle-o"></i> Register Student</a></li>
             <li><a href="import_students.php" target="iframe_info"><i class="fa fa-circle-o"></i> Import Students</a></li>
              <li><a href="graduate_student.php" target="iframe_info"><i class="fa fa-circle-o"></i> Graduate Students</a></li>
               <li><a href="promote_student.php" target="iframe_info"><i class="fa fa-circle-o"></i> Promote Student</a></li>
			  <?php }elseif($role === "Admin"  || $role === "Academicofficer" || $role === "Principal"  || $role === "Dean" || $role === "Adminofficer"  || $role === "Formaster" ){ ?> 
          <!--  <li><a href="resultsheet.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Result</a></li> -->
           <li><a href="promote_student.php" target="iframe_info"><i class="fa fa-circle-o"></i> Promote Student</a></li><?php } ?>
            <li><a href="view_student.php" target="iframe_info"><i class="fa fa-circle-o"></i> Manage Student</a></li>
           
           
             <li><a href="view_alumni.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Alumni</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i>
            <span>Subject Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($role === "Admin"  || $role === "Academicofficer" || $role === "Principal"  || $role === "Dean" || $role === "Adminofficer"){ ?>
            <li><a href="create_subject.php" target="iframe_info"><i class="fa fa-circle-o"></i> Create Subject</a></li>
            <li><a href="view_allsubjects_edit.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Subjects</a></li>
            <li><a href="bind_subjects_to_class.php" target="iframe_info"><i class="fa fa-circle-o"></i> Bind Subject to Class</a></li>
			 <li class="active"><a href="set_subject_limit.php" target="iframe_info"><i class="fa fa-circle-o"></i> Number to be Enrolled</a></li>
              <li><a href="view_allsubjectslimits.php" target="iframe_info"><i class="fa fa-circle-o"></i> Manage Number to be Enrolled</a></li>
			<?php  }elseif( $role === "Formaster" ){
				 ?>
                 <li class="active"><a href="set_subject_limit.php" target="iframe_info"><i class="fa fa-circle-o"></i> Number to be Enrolled</a></li> 
            
           <li><a href="view_allsubjectslimits.php" target="iframe_info"><i class="fa fa-circle-o"></i> Manage Number to be Enrolled</a></li>
           <li><a href="view_allsubjects.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Subjects</a></li>
           <?php }else{?> 
            <li><a href="view_allsubjects.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Subjects</a></li>
            <?php }?> 
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle"></i> <span>Form Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="class_master.php" target="iframe_info"><i class="fa fa-circle-o"></i> Asing Form Teacher</a></li>
            <li><a href="view_master.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Form Teacher</a></li>
            <li><a href="form_master_remark.php" target="iframe_info"><i class="fa fa-circle-o"></i> Form Master Remarks</a></li>
             <li><a href="manage_remarks.php" target="iframe_info"><i class="fa fa-circle-o"></i> Manage  Remarks</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Exam Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <?php if($role === "Admin"  || $role === "Academicofficer" || $role === "Principal"  || $role === "Dean" || $role === "Adminofficer"){ ?>
           <li class="active"><a href="exam_scoring_duration.php" target="iframe_info"><i class="fa fa-circle-o"></i> Set exam scoring duration</a></li>
           <li class="active"><a href="manage_exam_scoring_duration.php" target="iframe_info"><i class="fa fa-circle-o"></i> Manage scoring duration</a></li>
            <li><a href="close_session_result.php" target="iframe_info"><i class="fa fa-circle-o"></i> Close Termly Result</a></li>
                 <li><a href="close_session_scores.php" target="iframe_info"><i class="fa fa-circle-o"></i> Close Termly Scores</a></li>
                 <li><a href="publish_result.php" target="iframe_info"><i class="fa fa-circle-o"></i> Publish Result</a></li>   
                <li><a href="attendance.php" target="iframe_info"><i class="fa fa-circle-o"></i> Student Attendance</a></li>
                <li><a href="result_privilege.php" target="iframe_info"><i class="fa fa-circle-o"></i> Result View Privileges </a></li>
                 <li><a href="prepare_student_scoring.php" target="iframe_info"><i class="fa fa-circle-o"></i> Set Students for Scoring</a></li>
                 <?php }elseif( $role === "Formaster" ){ ?>
               <li><a href="publish_result.php" target="iframe_info"><i class="fa fa-circle-o"></i> Publish Result</a></li>   
                <li><a href="attendance.php" target="iframe_info"><i class="fa fa-circle-o"></i> Student Attendance</a></li>
				 <li><a href="prepare_student_scoring.php" target="iframe_info"><i class="fa fa-circle-o"></i> Set Students for Scoring</a></li>
				<?php }?>  
            <li><a href="score2.php" target="iframe_info"><i class="fa fa-circle-o"></i> Enter Student Scores</a></li>
            <!-- <li><a href="upload_students_scores_csv.php" target="iframe_info"><i class="fa fa-circle-o"></i> Upload Scores in CSV </a></li>-->
            
            <li><a href="student_score_sheet.php" target="iframe_info"><i class="fa fa-circle-o"></i> Print Scores Sheet</a></li>
            
             <li><a href="view_class_result.php" target="iframe_info"><i class="fa fa-circle-o"></i> View  Current  Result</a></li>
              <li><a href="view_class_result_past.php" target="iframe_info"><i class="fa fa-circle-o"></i> View  Past  Result</a></li>
               
               
          </ul>
        </li>
        
         <?php if($role === "Admin" || $role === "Principal"  || $role === "Adminofficer"){ ?>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Fees Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li class="active"><a href="Create_fee_cat.php" target="iframe_info"><i class="fa fa-circle-o"></i> Create Fee Category</a></li>
             <li class="active"><a href="View_fee_cat.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Fee Category</a></li>
            <li class="active"><a href="Create_fee_item.php" target="iframe_info"><i class="fa fa-circle-o"></i> Asign Fee to Classes</a></li>
            <li class="active"><a href="View_fee_item.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Asigned Fee</a></li>
            <li class="active"><a href="pay_fee.php" target="iframe_info"><i class="fa fa-circle-o"></i> Pay Fee</a></li>
            <li class="active"><a href="close_account.php" target="iframe_info"><i class="fa fa-circle-o"></i>  Close Account</a></li>
            
          ></ul>
        </li><?php  }?>
        
        
         <?php if($role === "Admin" || $role === "Principal"  || $role === "Adminofficer" ){ ?>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Fee Transactions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="payment_history.php" target="iframe_info"><i class="fa fa-circle-o"></i> Payment History</a></li>
            <li class="active"><a href="debtor_history.php" target="iframe_info"><i class="fa fa-circle-o"></i> Debtors History</a></li>
           <li class="active"><a href="alumni_payment_history.php" target="iframe_info"><i class="fa fa-circle-o"></i> Alumni Payment History</a></li>
           <li class="active"><a href="alumni_debtor_history.php" target="iframe_info"><i class="fa fa-circle-o"></i>Alumni Debtors History</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Bank Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li class="active"><a href="create_bank.php" target="iframe_info"><i class="fa fa-circle-o"></i> Create Bank</a></li>
            <li class="active"><a href="view_bank.php" target="iframe_info"><i class="fa fa-circle-o"></i> View Bank</a></li>
         
          </ul>
        </li>
		
		<?php  }} ?>
       
        <li>
        
          <a href="calendar.html" target="iframe_info">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
            <!--  <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small> -->
            </span>
          </a>
        </li>
       
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
       <!-- 
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col
        <div class="col-lg-3 col-xs-6">
          <!-- small box
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col 
        <div class="col-lg-3 col-xs-6">
          <!-- small box 
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col 
        <div class="col-lg-3 col-xs-6">
          <!-- small box 
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col 
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row" >
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable" style="height:800px;">
         <iframe class="embed-responsive" id="iframe_info" name="iframe_info" width="100%" frameborder="0" height="1500" style="position:absolute; top: 0; left: 0; height:100%;  scroll-behavior: unset;"></iframe> 
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
           
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
             
            </div>
          </div>
          </section>
          <!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          
            <!-- /.chat -->
            
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List -->
          
          <!-- /.box -->

          <!-- Calendar -->
          
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2020 <a href="https://adminlte.io">VS45 Technologies</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
   
    <div class="tab-content">
     
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        
        
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<div class="modal fade" id="update_modal <?php   echo $_SESSION["ID"];?>" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
<form method="POST" action="../Control_classes/class_controller.php?action=Edit_class">
				<div class="modal-header">
					<h3 class="modal-title">Update User</h3>
				</div>
				<div class="modal-body">
					
					<div class="col-md-8">
						<div class="form-group">
							<label>Class Name</label>
							<input type="hidden" name="class_code" value=""/>
<input type="text" name="class_name" value="?>" class="form-control" onkeyup="this.value= this.value.toUpperCase();" required />
						</div>
						
				</div>
				
				<div class="modal-footer">
					<button name="update" type="submit" class="btn btn-primary"></span> Update</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    </div></div>
                    </form>
				</div></div></div>
                  <!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Are you sure you want to sign out?</h4>
            </div>
            <div class="modal-footer">
              <a href="Logout.php" class="btn btn-primary">Yes</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
