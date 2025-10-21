<?php 

include('header.php');
include('dbconnect.php');



 ?>


<div class="container-fluid">
	

      <?php include('menubar.php')?> 
	<?php 

	 $date = date("Y m, d h:i a");
	 
$today=date("Y/m/d",strtotime($date));

$query1=mysqli_query($dbcon,"SELECT * FROM case_table where DATE_FORMAT(date_added,'$today')='$today'");
	$counter=mysqli_num_rows($query1);

        if ($counter==0)
        {
          $counter=101;
        }
        else
        {
          $counter=100+$counter+1;
        }
    

       $trans_id=date('y').date('m').date('d').$counter;
	 

	?>

	

<div class="container-fluid">

	<div class="col-md-2"></div>
	<div class="col-md-8">
		<ul class="list-group" id="myinfo" >

			<li class="list-group-item" id="mylist"></li>

		</ul>
			<div class="panel panel-success">
					  	<div class="panel-heading">
					  		
					  		<h3 class="panel-title">Complainant Details</h3>
					  	</div>
			<div class="panel-body">

			 
				<div class="container-fluid">
					<form class="form-horizontal" id="addhere" role="form">

						<div class="form-row">
                        	<div class="col-md-6">
					       		<div class="form-group">
					       		 <label for="">Name of Complainant:</label>
					       		 <input type="hidden" name="uid" value="<?php echo $trans_id?>">
					        		<input type="text" name="name" class="form-control" id="name" placeholder="Enter Name"
					    		autofocus=""  >
					       		</div>
					   		</div>

					   		<div class="col-md-6">
					  		<div class="form-group">
					    		<label for="">Tel Phone:</label>
					    		<input type="text"  name="tel" class="form-control"  maxlength="10" onkeypress="return isNumberKey(event)" placeholder="Phone Number" >
					  			</div>
					  		</div>
					  	</div>


						<div class="form-row">
                        	<div class="col-md-6">
					       		<div class="form-group">
					       		 <label for="">Occupation:</label>
					       		 
					        		<input type="text" name="occ" class="form-control" id="nid" placeholder="Enter Occupation"
					    		autofocus=""  >
					       		</div>

					       		<div class="col-md-6">
					       		<div class="form-group">
									    <label for="">Gender:</label>
									    <select class="form-control" name="gender" id ="idcrime">
									    <option selected="selected" value="">Select</option>

											<option value="Male"> Male</option>
											<option value="Female"> Female</option>
										
										 </select>
										 </div>
										</div>
                          
					   	</div>
					
					   		
					 

					  	<div class="form-row">
                        	<div class="col-md-6">
					  				<div class="form-group">
					   				 <label for="">Age:</label>
					   				 <input type="number" name="age" class="form-control" id="addrs" placeholder="Age"  >
					  				</div>
					  		</div>
					  		<div class="col-md-6">
					  			<div class="form-group">
					    		<label for="">Address:</label>
					    		<input type="text" name="addrs" class="form-control py-4" id="digaddrs"  placeholder="Address" >
					  			</div>
					  		</div>
					  	</div>
			<div class="form-row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="">Region:</label>
      <select class="form-control" name="region" id="region" required>
        <option value="">Select Region</option>
        <?php
        include('dbconnect2.php');
        $regions = mysqli_query($dbcon, "SELECT DISTINCT region FROM regions ORDER BY region ASC");
        while ($row = mysqli_fetch_assoc($regions)) {
          echo '<option value="' . htmlspecialchars($row['region']) . '">' . htmlspecialchars($row['region']) . '</option>';
        }
        ?>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label for="">District/Municipal:</label>
      <select class="form-control" name="district" id="district" required>
        <option value="">Select District</option>
        <?php
        // if you want to show all districts regardless of region:
        $districts = mysqli_query($dbcon, "SELECT DISTINCT district FROM regions ORDER BY district ASC");
        while ($row = mysqli_fetch_assoc($districts)) {
          echo '<option value="' . htmlspecialchars($row['district']) . '">' . htmlspecialchars($row['district']) . '</option>';
        }
        ?>
      </select>
    </div>
  </div>
</div>

					<div class="form-row">
                        <div class="col-md-6">
					  		<div class="form-group">
					    		<label for="">Location:</label>
					    		<input type="text" name="loc" class="form-control" id="loc" placeholder="Enter Location" >
					  		</div>
					  	</div>
					  		<div class="col-md-6">
					  	<div class="form-group">
									    <label for="">Select Crime Type:</label>
									    <select class="form-control" name="crime_type" id="crime">
									    <option selected="selected" value="">Select</option>

									    	<?php
			
										//Get all unions from database
										$sql = mysqli_query($dbcon,"select * from crime_type");
										while($row = mysqli_fetch_assoc($sql)){ ?>

											<option value="<?php echo $row['des'] ?>"> <?php echo $row['des']?> </option>
										<?php
										}

										?> </select>
										 </div>
										</div>
					  




					  </div>
					  <div class="form-group">
					  <button  type="submit" name="save_case" class="btn btn-success form-control">Save and Continue
					  <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
					  </button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>

<?php include('scripts.php'); ?>
<script type="text/javascript">

	$(document).on('submit', '#addhere', function(event) {
				
		event.preventDefault();
		// This removes the error messages from the page
		$(".list-group-item").remove();
		
		
		var formData = $(this).serialize();

			$.ajax({
					url: 'savecompl.php',
					type: 'POST',
					data: formData,
					dataType: 'json',
					success: function(response){

						if(response.error){
							
							var len = response[0].length;

							for(var i=0; i<len; i++){

							$('#myinfo').append('<li class="list-group-item alert alert-danger"> ' + response[0][i] + '</li>');
													}
										}
				
						else{	
							
							window.location=response.url;
							
							

						}

					},
					
					
			error: function(xhr, status, error) {
        console.log("AJAX error:", error);
	console.log("Response:", xhr.responseText);
    }	
			});

	});

</script>

<script>
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;

	return true;
}
</script>

</body>
</html>