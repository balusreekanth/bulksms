  <div class="mainpanel">

    <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="#"><i class="fa fa-home mr5"></i> Home</a></li>
        
        <li class="active">Contacts</li>
      </ol>

      <div class="panel">
        
        <div class="panel-heading">
           <div class="row">


            <div class="col-xs-12">
              <!-- Table start -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title" style="margin-bottom:25px; margin-top:0">Contacts</h3>
                </div><!-- /.box-header -->
<div style="clear:both"></div>
 <div class="col-xs-12" style="padding-left:0">
 <form action="<?php echo site_url('smsportal/export')?>" method="post" enctype="multipart/form-data">
           <div class="panel-heading" style="padding:0 0 10px 0">
              <h4 class="panel-title">Upload Contacts  <span style="margin-left:15px; font-size:14px;">  <?php echo $this->session->flashdata('error');?> </span></h4>
              
            </div>
           <div class="col-md-4" style="padding-left:0">
<div class="form-group">
                  <label for="exampleInputFile">Select File</label>
                  <input type="file" id="upload" name="upload"/>
                  <p class="help-block">File format should be .xls, .xlsx or .csv  <a href="<?php echo base_url('sample/sample.xlsx');?>">Download sample file</a> </p>
                </div>
           </div>
           <div class="col-md-4">
           <div class="form-group">
                <label>Select Group</label>
                <select name="group_id" id="select1" data-placeholder="Select Group" class="form-control" style="width: 100%;">
                  <option value="0"></option>
                  <?php if(isset($groups)){foreach ($groups as $value) {?>
                  <option value="<?php echo $value['groups_id'];?>"><?php echo $value['groups_name'];?></option>
                  <?php }}?>
                </select>
              </div>
           </div>
           <div class="col-md-4">
           <button type="submit" value="Submit" class="btn btn-primary" style="margin-top:21px;">Upload</button>
           </div>
           </form>
           </div>
<div style="clear:both"></div>          
                <div class="box-body table-responsive">                
                <div class="btn-group" style="padding:15px 0">
                  <button type="button" class="btn btn-success add">Add New Contact</button>
                </div>
                  <table id="contacttab" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Group</th>
                        <th>Added date</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($contacts)){foreach ($contacts as $row) {?>
                      <tr>
                        <td><?php echo $row['contact_name'];?></td>
                        <td><?php echo $row['contact_number'];?></td>
                        <td><?php echo $row['contact_email'];?></td>
                        <td><?php echo $row['contact_address'];?></td>
                        <td><?php echo $row['contact_status'];?></td>
                        <td><?php echo $row['groups_name'];?></td>
                        <td><?php echo $rdate = $my_date = date('d-m-Y H:i', strtotime($row['contact_date']));?></td>
                        <td><button id="<?php echo $row['contact_id'];?>" class="btn btn-primary updatecontact">Update</button>
                        <button id="<?php echo $row['contact_id'];?>" class="btn btn-warning deletecontact">Delete</button></td>
                      </tr>
                    <?php }}else{echo '<tr><td>No data found</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';}?>   
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Group</th>
                        <th>Added date</th>
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
        <h3 class="modal-title">Add Contact</h3>
      </div>
      <form action="#" id="addfrm" class="form-horizontal">
      <div class="modal-body form">                  
          <div class="form-body">         
            
            <div class="form-group">
              <label for="inputEmail3" class="control-label col-md-3">Name<span class="error">*</span></label>
              <div class="col-sm-9">
              <input class="form-control" type="text" name="add_contact_name" placeholder="Enter Contact Name" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Number<span class="error">*</span></label>
              <div class="col-md-9">
              <input class="form-control" type="text" name="add_contact_number" placeholder="Enter Contact Number">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Contact Email</label>
              <div class="col-md-9">
              <input class="form-control" type="text" name="add_contact_email" placeholder="Enter Contact Email" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Select Groups</label>
              <div class="col-md-9">
              <select class="form-control" name="add_contact_group_id">
                <option value="0"></option>
                <?php if(isset($groups)){foreach ($groups as $value) {?>
                  <option value="<?php echo $value['groups_id'];?>"><?php echo $value['groups_name'];?></option>
                <?php }}?>
                
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Contact Address</label>
              <div class="col-md-9">                
                <textarea name="add_contact_address" class="form-control" rows="3" placeholder="Enter Contact Address"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Contact Status</label>
              <div class="col-md-9">
              <select name="add_contact_status">
                <option value="1">ON</option>
                <option value="0">Off</option>                
              </select>
              </div>
            </div>

           </div>        
          </div>
          <div class="modal-footer">
            <button type="button" id="btnAdd" onclick="addContact()" class="btn btn-primary">Submit</button>
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
        <h3 class="modal-title">Edit Contact</h3>
      </div>
      <form action="#" id="editfrm" class="form-horizontal">
      <input type="hidden" name="edit_contact_id" value="">
      <div class="modal-body form">                  
          <div class="form-body">         
            
            <div class="form-group">
              <label for="inputEmail3" class="control-label col-md-3">Name<span class="error">*</span></label>
              <div class="col-sm-9">
              <input class="form-control" type="text" name="edit_contact_name" placeholder="Enter Contact Name" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Number<span class="error">*</span></label>
              <div class="col-md-9">
              <input class="form-control" type="text" name="edit_contact_number" placeholder="Enter Contact Number">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Contact Email</label>
              <div class="col-md-9">
              <input class="form-control" type="text" name="edit_contact_email" placeholder="Enter Contact Email" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Select Groups</label>
              <div class="col-md-9">
              <select class="form-control" name="edit_contact_group_id" id="select4">
                <option value="0"></option>
                <?php if(isset($groups)){foreach ($groups as $value) {?>
                  <option value="<?php echo $value['groups_id'];?>"><?php echo $value['groups_name'];?></option>
                <?php }}?>
                
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Contact Address</label>
              <div class="col-md-9">                
                <textarea name="edit_contact_address" class="form-control" rows="3" placeholder="Enter Contact Address"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Contact Status</label>
              <div class="col-md-9">
              <select name="edit_contact_status">
                <option value="0">Off</option>
                <option value="1">ON</option>
              </select>
              </div>
            </div>

           </div>        
          </div>
          <div class="modal-footer">
            <button type="button" id="btnEditcon" onclick="editContact()" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->