  <div class="mainpanel">

    <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="#"><i class="fa fa-home mr5"></i> Home</a></li>
        
        <li class="active">Groups</li>
      </ol>

      <div class="panel">
        
        <div class="panel-heading">
           <div class="row">


            <div class="col-xs-12">
              <!-- Table start -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title" style="margin-bottom:25px; margin-top:0">Groups</h3>
                </div><!-- /.box-header --> 
<div style="clear:both"></div>          
                <div class="box-body table-responsive">                
                <div class="btn-group" style="padding:15px 0">
                  <button type="button" class="btn btn-success addgrp">Create New Group</button>
                </div>
                  <table id="grouptab" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Group Name</th>
                        <th>Last Updated date</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($groups)){foreach ($groups as $row) {?>
                      <tr>
                        <td><?php echo $row['groups_name'];?></td>
                        <td><?php echo $rdate = $my_date = date('d-m-Y H:i', strtotime($row['groups_date']));?></td>
                        <td><button id="<?php echo $row['groups_id'];?>" class="btn btn-primary updategroup">Update</button>
                        <button id="<?php echo $row['groups_id'];?>" class="btn btn-warning deletegroup">Delete</button></td>
                      </tr>
                    <?php }}else{echo '<tr><td>No data found</td><td></td><td></td></tr>';}?>   
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Group Name</th>
                        <th>Last Updated date</th>
                        <th>Tools</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        <!-- Table end -->
            </div><!-- /.col -->
          </div><!-- /.row -->
 <!--          <p>DataTables has most features enabled by default, so all you need to do to use it with one of your own tables is to call the construction function.</p> -->
        </div>

        <div class="panel-body">
          
      </div>
    </div><!-- panel -->
  </div><!-- contentpanel -->
</div><!-- mainpanel -->
<div class="modal fade" id="add_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Create Group</h3>
      </div>
      <form action="#" id="addfrm" class="form-horizontal">
      <div class="modal-body form">                  
          <div class="form-body">         
            
            <div class="form-group">
              <label for="inputEmail3" class="control-label col-md-3">Group Name<span class="error">*</span></label>
              <div class="col-sm-9">
              <input class="form-control" type="text" name="add_group_name" placeholder="Enter Group Name" required>
              </div>
            </div>     

           </div>        
          </div>
          <div class="modal-footer">
            <button type="button" id="btnAdd" onclick="addGroup()" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<div class="modal fade" id="edit_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Edit Group</h3>
      </div>
      <form action="#" id="editfrm" class="form-horizontal">
      <input type="hidden" name="edit_group_id" value="">
      <div class="modal-body form">                  
          <div class="form-body">         
            
            <div class="form-group">
              <label for="inputEmail3" class="control-label col-md-3">Group Name<span class="error">*</span></label>
              <div class="col-sm-9">
              <input class="form-control" type="text" name="edit_group_name" placeholder="Enter Group Name" required>
              </div>
            </div>

           </div>        
          </div>
          <div class="modal-footer">
            <button type="button" id="btnEditcon" onclick="editGroup()" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->