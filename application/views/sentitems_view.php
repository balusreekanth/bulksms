  <div class="mainpanel">

    <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="#"><i class="fa fa-home mr5"></i> Home</a></li>
        
        <li class="active">Sent Messages</li>
      </ol>

      <div class="panel">
        
        <div class="panel-heading">
           <div class="row">
            <div class="col-xs-12">
              <!-- Table start -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Sent Items</h3>
                </div><!-- /.box-header -->
                <div class="box-body">                
                <!-- <div class="btn-group">
                  <button type="button" class="btn btn-success add">Add Intercom Number</button>
                </div> -->
                  <table id="senttab" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Destination Number</th>
                        <th>Provider</th>
                        <th>Message</th>
                        <th>Received Date</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($sentitems)){foreach ($sentitems as $row) {?>
                      <tr>
                        <td><?php echo $row['DestinationNumber'];?></td>
                        <td><?php echo $row['SMSCNumber'];?></td>
                        <td><?php echo $row['TextDecoded'];?></td>
                        <td><?php echo $rdate = $my_date = date('d-m-Y H:i', strtotime($row['SendingDateTime']));?></td>
                        <td><button id="<?php echo $row['ID'];?>" class="btn btn-warning deletesent">Delete</button></td>
                      </tr>
                    <?php }}else{echo '<tr><td>No data found</td><td></td><td></td><td></td><td></td></tr>';}?>
                      
                                            
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Sender Number</th>
                        <th>Provider</th>
                        <th>Message</th>
                        <th>Received Date</th>
                        <th>Delete</th>
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