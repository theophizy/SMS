
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
  <footer class="main-footer" >
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong> Copyright &copy; <?php echo date('Y');?> <a href=""><font color="#FF3300"><strong>I</strong></font><font color="#009933"><strong>school</strong></font></a>.</strong> All rights
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
