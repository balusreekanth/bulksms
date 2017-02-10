  <div class="mainpanel">

    <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="#"><i class="fa fa-home mr5"></i> Home</a></li>
        
        <li class="active">Info</li>
      </ol>

      <div class="panel">
        
        <div class="panel-heading">
          <?php if(isset($info)){ foreach ($info as $key => $value) {?>
           <div class="row">
            <div class="col-sm-8 col-md-9 col-lg-10 people-list">
              <!-- Table start -->
              <div class="panel panel-profile list-view">
              <div class="panel-body people-info">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="info-group">
                      <label>IMEI Number</label>
                      <?php echo $value['IMEI'];?>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="info-group">
                      <label>Signal Strength</label>
                      <?php echo $value['Signal'];?>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="info-group">
                      <label>Battery</label>
                      <?php echo $value['Battery'];?>
                    </div>
                  </div>
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="info-group">
                      <label>Sent</label>
                      <h4><?php echo $value['Sent'];?></h4>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="info-group">
                      <label>Received</label>
                      <h4><?php echo $value['Received'];?></h4>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="info-group">
                      <label>Capability</label>
                      Send: <?php echo $value['Send'];?>, Receive: <?php echo $value['Receive'];?> 
                    </div>
                  </div>
                </div><!-- row -->
              </div>
            </div><!-- panel -->
        <!-- Table end -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <?php }}?>
        </div>

        <div class="panel-body">
          
      </div>
    </div><!-- panel -->
  </div><!-- contentpanel -->
</div><!-- mainpanel -->