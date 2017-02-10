  <div class="mainpanel">

    <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="#"><i class="fa fa-home mr5"></i> Home</a></li>
        
        <li class="active">Send SMS</li>
      </ol>

      <div class="panel" style="background:none">
        
        <div class="panel-heading">
           <div class="row">
            <div class="col-xs-6" style="margin:0 auto; float:none; background:#fff; padding:15px 35px;">

            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-left: -11px;">Send SMS<span id="error" style="margin-left:10px; font-weight:normal;font-size:14px;"><?php echo $this->session->flashdata('error');?></span></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="<?php echo site_url('sms_inject/mass_sms');?>" onsubmit="return validateForm()" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label>Select Contact</label>
                  <select name="contact_id" id="select1" class="form-control" style="width: 100%;">
                        <option value="0"></option>
                        <?php if(isset($contacts)){foreach ($contacts as $value) {?>
                          <option value="<?php echo $value['contact_number'];?>"><?php echo $value['contact_name'].'('.$value['contact_number'].')';?></option>
                        <?php }}?>
                      </select>
                </div>
                <div style="font-weight: bold; padding-bottom: 9px; width: 100%; text-align: center;">(OR)</div>
                <div class="form-group">
                  <label>Select Group</label>
                  <select name="group_id" id="select1" class="form-control" style="width: 100%;">
                        <option value="0"></option>
                        <?php if(isset($groups)){foreach ($groups as $value) {?>
                          <option value="<?php echo $value['groups_id'];?>"><?php echo $value['groups_name'];?></option>
                        <?php }}?>
                      </select>
                </div>
                <div class="form-group">
                  <label>Enter SMS</label>
                  <textarea name="smscontent" class="form-control" rows="3" placeholder="Enter Message" required></textarea>
                </div>

                
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="padding-top:15px;">
                <button type="submit" name="send" value="send" class="btn btn-info pull-right">Send</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

<div style="clear:both"></div>
              
        <!-- Table end -->
            </div><!-- /.col -->
          </div><!-- /.row -->
 <!--          <p>DataTables has most features enabled by default, so all you need to do to use it with one of your own tables is to call the construction function.</p> -->
        </div>

        
    </div><!-- panel -->
  </div><!-- contentpanel -->
</div><!-- mainpanel -->