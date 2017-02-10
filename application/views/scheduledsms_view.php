  <div class="mainpanel">

    <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="#"><i class="fa fa-home mr5"></i> Home</a></li>
        
        <li class="active">Scheduled SMS</li>
      </ol>


      <div class="panel"style="background:none">

<div class="col-md-6" style="margin:0 auto; float:none; background:#fff;padding:10px 30px;">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-left: -11px;">Schedule SMS<span id="error" style="margin-left:10px; font-weight:normal;font-size:14px;"><?php echo $this->session->flashdata('error');?></span></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="<?php echo site_url('sms_inject/mass_sms');?>" onsubmit="return validateForm()" class="form-horizontal">
            <input type="hidden" name="direct" value="smsportal/scheduledsms">
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
                  <select name="group_id" id="select2" class="form-control" style="width: 100%;">
                        <option value="0"></option>
                        <?php if(isset($groups)){foreach ($groups as $value) {?>
                          <option value="<?php echo $value['groups_id'];?>"><?php echo $value['groups_name'];?></option>
                        <?php }}?>
                      </select>
                </div>

                <div class="form-group">
                <label>Select Date Time:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text"  name="sendingDateTime" class="form-control form_datetime" readonly data-inputmask="'alias': 'yyyy-mm-dd'" value="<?php echo date('Y-m-d H:i');?>" data-mask="">
                </div>
                <!-- /.input group -->
              </div>

                <div class="form-group">
                  <label>Enter SMS</label>
                  <textarea name="smscontent" class="form-control" rows="3" placeholder="Enter Message" required></textarea>
                </div>

                
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="padding-top:15px;">
                <button type="submit" name="send" value="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

<div style="clear:both"></div>

</div>
<div style="clear:both"></div>          
            
          </div><!-- panel -->

  </div><!-- contentpanel -->
</div><!-- mainpanel -->