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
              <h3 class="box-title" style="margin-left: -11px;">Settings<span id="error" style="margin-left:10px; font-weight:normal;font-size:14px;"><?php echo $this->session->flashdata('error');?></span></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="<?php echo site_url('smsportal/savesettings'); ?>" class="form-horizontal">
            <input type="hidden" value="<?php if(isset($settings)){echo $settings[0]['settings_id'];}?>" name="settingid">
              <div class="box-body">
                <div class="form-group">
                  <label>Balance USSD code</label>
                  <input type="text"  name="ussdcode" value="<?php if(isset($settings)){echo $settings[0]['settings_ussdcode'];}?>" class="form-control">
                </div>
                <div class="form-group">
                  <label>Balance USSD option</label>
                  <input type="text"  name="ussdoption" value="<?php if(isset($settings)){echo $settings[0]['settings_option'];}?>" class="form-control">
                </div>
                <div class="form-group">
                  <label>OptOut Message</label>
                  <input type="text"  name="optoutmsg" value="<?php if(isset($settings)){echo $settings[0]['settings_optoutmsg'];}?>" class="form-control">
                </div>

                
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="padding-top:15px;">
                <button type="submit" name="send" value="send" class="btn btn-info pull-right">Update</button>
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