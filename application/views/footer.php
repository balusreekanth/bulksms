</section>

<script src="<?php echo base_url(); ?>lib/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>lib/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-autosize/autosize.js"></script>
<script src="<?php echo base_url(); ?>lib/select2/select2.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-toggles/toggles.js"></script>
<script src="<?php echo base_url(); ?>lib/datatables/jquery.dataTables.js"></script>
<!--<script src="<?php //echo base_url(); ?>/lib/timepicker/jquery.timepicker.js"></script>
<script src="<?php //echo base_url(); ?>/js/jquery.datetimepicker.full.js"></script>-->
<script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.js"></script>
<!--<script type="text/javascript" src="../js/locales/bootstrap-datetimepicker.fr.js"></script>-->
<script src="<?php echo base_url(); ?>lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url(); ?>lib/jquery-validate/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>js/quirk.js"></script>
<script src="<?php echo base_url();?>dist_map/mindmap.min.js"></script>
<script>

$(function(){
    // InboxTable
	$("#devtab").DataTable();
	// OutboxTable
	$("#outtab").DataTable();
	// SentTable
	$("#senttab").DataTable();
	// ContactsTable
	$("#contacttab").DataTable();
	// GroupsTable
	$("#grouptab").DataTable();
	// Date Picker
  	$(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: new Date(),
        minuteStep: 5
    });

    $('#select1, #select2, #select3').select2();

	$(".add").on("click",function(){
		$('#addfrm')[0].reset();
		$('#add_form').modal('show');
    	$('.modal-title').text('Add Contact');
	});
	$(".addgrp").on("click",function(){
		$('#addfrm')[0].reset();
		$('#add_form').modal('show');
    	$('.modal-title').text('Add Group');
	});
	$("#devtab").on("click",".delete",function(){
		var id = $(this).attr('id');
		var r = confirm("Are you sure you want to delete?");
		if (r == true) {		    
		    deleteNode(id);
		} else {		    
		    return false;
		}
	});
	$("#senttab").on("click",".deletesent",function(){
		var id = $(this).attr('id');
		var r = confirm("Are you sure you want to delete?");
		if (r == true) {		    
		    deleteSent(id);
		} else {		    
		    return false;
		}
	});
	$("#contacttab").on("click",".deletecontact",function(){
		var id = $(this).attr('id');
		var r = confirm("Are you sure you want to delete?");
		if (r == true) {		    
		    deletecontact(id);
		} else {		    
		    return false;
		}
	});
	$("#grouptab").on("click",".deletegroup",function(){
		var id = $(this).attr('id');
		var r = confirm("Are you sure you want to delete?");
		if (r == true) {		    
		    deletegroup(id);
		} else {		    
		    return false;
		}
	});
	$("#contacttab").on("click",".updatecontact",function(){
		var ids = $(this).attr('id');
		var url;
		url = "<?php echo site_url('smsportal/contactdetails')?>";
		// ajax adding data to database
		  $.ajax({
		    url : url,
		    type: "POST",
		    data: {'id':ids},
		    dataType: "JSON",
		    success: function(data)
		    {
		   		$('[name="edit_contact_name"]').val(data.contact_name);
		   		$('[name="edit_contact_number"]').val(data.contact_number);
		   		$('[name="edit_contact_email"]').val(data.contact_email);
		   		$('[name="edit_contact_group_id"]').val(data.contact_group_id);
		   		$('[name="edit_contact_id"]').val(data.contact_id);
		   		$('[name="edit_contact_address"]').val(data.contact_address);
		   		$('[name="edit_contact_status"]').val(data.contact_status);
	   			$('#edit_form').modal('show');
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
		        alert('Error in Page');
		        $('#edit_form').modal('hide');
		   		$('#editfrm')[0].reset();
		    }
		});
		$('#edit_form').modal('show'); // show bootstrap modal when complete loaded
    	$('.modal-title').text('Edit Device'); // Set title to Bootstrap modal title
	});

	$("#grouptab").on("click",".updategroup",function(){
		var ids = $(this).attr('id');
		var url;
		url = "<?php echo site_url('smsportal/groupdetails')?>";
		// ajax adding data to database
		  $.ajax({
		    url : url,
		    type: "POST",
		    data: {'id':ids},
		    dataType: "JSON",
		    success: function(data)
		    {
		   		$('[name="edit_group_name"]').val(data.groups_name);
		   		$('[name="edit_group_id"]').val(data.groups_id);
	   			$('#edit_form').modal('show');
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
		        alert('Error in Page');
		        $('#edit_form').modal('hide');
		   		$('#editfrm')[0].reset();
		    }
		});
		$('#edit_form').modal('show'); // show bootstrap modal when complete loaded
    	$('.modal-title').text('Edit Group'); // Set title to Bootstrap modal title
	});
});
function addContact()
{
	var cname = $('[name="add_contact_name"]').val();
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var cemail = $('[name="add_contact_email"]').val();
	if(cname==''){
		alert('Please enter contact name');
		$('[name="add_contact_name"]').focus();
	}else if($('[name="add_contact_number"]').val()==''){
		alert('Please enter contact number');
		$('[name="add_contact_number"]').focus();
	}else if(!re.test(cemail) && cemail != ''){
		alert('Invalid email');
		$('[name="add_contact_email"]').focus();
	}
	else{
      var url;      
      url = "<?php echo site_url('smsportal/addcontact')?>";
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#addfrm').serialize(),
            dataType: "JSON",
            success: function(data)
            {  if(data.status == true){
	               	//if success close modal and reload ajax table
	               	$('#add_form').modal('hide');
	               	alert('Added succefully');
	               	location.reload();
           		}else{
           			alert('Error in adding');
           			$('#addfrm').reset();
           		}
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error in adding');
           		$('#addfrm')[0].reset();
            }
        });
    }
}

function editContact()
{
	var cname = $('[name="edit_contact_name"]').val();
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var cemail = $('[name="edit_contact_email"]').val();
	if(cname==''){
		alert('Please enter contact name');
		$('[name="edit_contact_name"]').focus();
	}else if($('[name="edit_contact_number"]').val()==''){
		alert('Please enter contact number');
		$('[name="edit_contact_number"]').focus();
	}else if(!re.test(cemail) && cemail != ''){
		alert('Invalid email');
		$('[name="edit_contact_email"]').focus();
	}
	else{
		var url;      
    	url = "<?php echo site_url('smsportal/editcontact')?>";
    	$.ajax({
            url : url,
            type: "POST",
            data: $('#editfrm').serialize(),
            dataType: "JSON",
            success: function(data)
            {  if(data.status == true){
	               	//if success close modal and reload ajax table
	               	$('#edit_form').modal('hide');
	               	alert('Updated succefully');
	               	location.reload();
           		}else{
           			$('#edit_form').modal('hide');
           			alert('Error in update');           			
           		}
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error in update');
           		$('#edit_form').modal('hide');
            }
        });
	}
}
function deleteNode(id)
{
	var url;      
	url = "<?php echo site_url('smsportal/deleteinbox')?>";

	// ajax adding data to database
	  $.ajax({
	    url : url,
	    type: "POST",
	    data: {id: id},
	    dataType: "JSON",
	    success: function(data)
	    {  if(data.status == true){
	           	//if success close modal and reload ajax table
	           	location.reload();
	   		}else{
	   			alert('Error in delete');
	   		}
	    },
	    error: function (jqXHR, textStatus, errorThrown)
	    {
	        alert('Error in delete');
	    }
	});
}
function deleteSent(id)
{
	var url;      
	url = "<?php echo site_url('smsportal/deletesent')?>";

	// ajax adding data to database
	  $.ajax({
	    url : url,
	    type: "POST",
	    data: {id: id},
	    dataType: "JSON",
	    success: function(data)
	    {  if(data.status == true){
	           	//if success close modal and reload ajax table
	           	location.reload();
	   		}else{
	   			alert('Error in delete');
	   		}
	    },
	    error: function (jqXHR, textStatus, errorThrown)
	    {
	        alert('Error in delete');
	    }
	});
}
function deletecontact(id)
{
	var url;
	url = "<?php echo site_url('smsportal/deletecontact')?>";

	// ajax adding data to database
	  $.ajax({
	    url : url,
	    type: "POST",
	    data: {id: id},
	    dataType: "JSON",
	    success: function(data)
	    {  if(data.status == true){
	           	//if success close modal and reload ajax table
	           	location.reload();
	   		}else{
	   			alert('Error in delete');
	   		}
	    },
	    error: function (jqXHR, textStatus, errorThrown)
	    {
	        alert('Error in delete');
	    }
	});
}

function validateForm()
{
	$('#error').html('');
	if(($('[name="contact_id"]').val() == 0 && $('[name="group_id"]').val() == 0) || ($('[name="contact_id"]').val() != 0 && $('[name="group_id"]').val() != 0))
	{
		$('#error').append('<span style="color: red;">Please select any one of Contact or Group.</span>');
		return false;
	}	
}

function addGroup()
{
	var cname = $('[name="add_group_name"]').val();
	if(cname==''){
		alert('Please enter group name');
		$('[name="add_contact_name"]').focus();
	}
	else{
      var url;      
      url = "<?php echo site_url('smsportal/creategroup')?>";
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#addfrm').serialize(),
            dataType: "JSON",
            success: function(data)
            {  if(data.status == true){
	               	//if success close modal and reload ajax table
	               	$('#add_form').modal('hide');
	               	alert('Added succefully');
	               	location.reload();
           		}else{
           			alert('Error in adding');
           			$('#addfrm').reset();
           		}
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error in adding');
           		$('#addfrm')[0].reset();
            }
        });
    }
}

function editGroup()
{
	var cname = $('[name="edit_group_name"]').val();
	if(cname==''){
		alert('Please enter group name');
		$('[name="edit_group_name"]').focus();
	}
	else{
		var url;      
    	url = "<?php echo site_url('smsportal/editgroup')?>";
    	$.ajax({
            url : url,
            type: "POST",
            data: $('#editfrm').serialize(),
            dataType: "JSON",
            success: function(data)
            {  if(data.status == true){
	               	//if success close modal and reload ajax table
	               	$('#edit_form').modal('hide');
	               	alert('Updated succefully');
	               	location.reload();
           		}else{
           			$('#edit_form').modal('hide');
           			alert('Error in update');           			
           		}
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error in update');
           		$('#edit_form').modal('hide');
            }
        });
	}
}

function deletegroup(id)
{
	var url;
	url = "<?php echo site_url('smsportal/deletegroup')?>";

	// ajax adding data to database
	  $.ajax({
	    url : url,
	    type: "POST",
	    data: {id: id},
	    dataType: "JSON",
	    success: function(data)
	    {  if(data.status == true){
	           	location.reload();
	   		}else if(data.status == 'exist'){
	   			alert('This Group is assigned to Contacts.\nPlease remove contacts from this group and try again.');
	   			return false;
	   		}else{
	   			alert('Error in delete');
	   		}
	    },
	    error: function (jqXHR, textStatus, errorThrown)
	    {
	        alert('Error in delete');
	    }
	});
}

</script>
</body>
</html>