  <div class="mainpanel">

    <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="#"><i class="fa fa-home mr5"></i> Home</a></li>
        
        <li class="active">Outbox Messages</li>
      </ol>

      <div class="panel">
        
        <div class="panel-heading">
           <div class="row">
            <div class="col-xs-12">
              <!-- Table start -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Outbox</h3>
                </div><!-- /.box-header -->
                <div class="box-body">                
                <!-- <div class="btn-group">
                  <button type="button" class="btn btn-success add">Add Intercom Number</button>
                </div> -->
                  <table id="outtab" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Destination Number</th>
                        <th>Provider</th>
                        <th>Message</th>
                        <th>Sent Date</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($outbox)){foreach ($outbox as $row) {?>
                      <tr>
                        <td><?php echo $row['DestinationNumber'];?></td>
                        <td><?php echo $row['SenderID'];?></td>
                        <td><?php echo $row['TextDecoded'];?></td>
                        <td><?php echo $rdate = $my_date = date('d-m-Y H:i', strtotime($row['SendingDateTime']));?></td>
                      </tr>
                    <?php }}else{echo '<tr><td>No data found</td><td></td><td></td><td></td></tr>';}?>
                      
                                            
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Destination Number</th>
                        <th>Provider</th>
                        <th>Message</th>
                        <th>Sent Date</th>
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