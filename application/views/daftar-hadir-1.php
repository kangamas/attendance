<!DOCTYPE html>
<html>
<head>
	<title>Form Registrasi</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
</head>
<body style="background-color: gray;">
	<div class="container mt-3">
		<div class="row">
			<div class="col-md-3">
				<?php $this->load->view('left-nav'); ?>
			</div>
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Daftar Hadir Sesi 1</h5>
						<!-- <form> -->
						  <div class="form-group row">
						    <!-- <label for="inputid" class="col-sm-2 col-form-label">No Anggota</label> -->
						    <div class="col-sm-10">
						    	<input type="text" class="form-control" id="inputid" name="inputid" placeholder="input ID Anggota" required>
						    </div>
						    <div class="col-sm-2">
						    	<button type="button" class="btn btn-primary mb-2" id="btn_update">Submit</button>
						    </div>
						  </div>
						<!-- </form> -->
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
								<table class="table">
									<thead class="thead-dark">
										<tr>
											<th scope="col">No</th>
											<th scope="col">ID Anggota</th>
											<th scope="col">Nama</th>
											<th scope="col">Jam Entry</th>
											<th scope="col">Status</th>
										</tr>
									</thead>
									<tbody id="show_data">
									</tbody>
								</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="col-md-3"></div> -->
		</div>
	</div>
	<!-- =================================================================================== -->
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jQuery v3.3.1.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
	<script type="text/javascript">
		$(document).ready(function(){
			tampil_list_member();

			function tampil_list_member(){
				$.ajax({
			        type  : 'ajax',
			        url   : '<?php echo base_url()?>attendance/attendance_1',
			        async : false,
			        dataType : 'json',
			        success : function(data){
			            var html = '';
			            var i;
			            var no=1;
			            for(i=0; i<data.length; i++){
			            	var no1 = no++;
			                html += '<tr>'+
			                  		'<td>'+no1+'</td>'+
			                        '<td>'+data[i].member_id+'</td>'+
			                        '<td>'+data[i].member_name+'</td>'+
			                        '<td>'+data[i].time_entry+'</td>'+
			                        '<td>'+data[i].status+'</td>'+
			                        '</tr>';
			            }
			            $('#show_data').html(html);
			        }

			    });
			}
			//Update On enter
			$('#inputid').keypress(function(e){
				if (e.which == 13 || event.keyCode == 13) {

		            var member_id=$('#inputid').val();
		            $.ajax({
		                type : "POST",
		                url   : '<?php echo base_url()?>attendance/update_attendance_1',
		                dataType : "JSON",
		                data : {member_id:member_id},
		                success: function(data){
		                    $('[name="inputid"]').val("");
		                    // $('#ModalaEdit').modal('hide');
		                    tampil_list_member();
		                }
		            });
		            return false;

	            }
	        });

	        //Update On button press
			$('#btn_update').on('click',function(){
				// if (e.which == 13 || event.keyCode == 13) {

		            var member_id=$('#inputid').val();
		            $.ajax({
		                type : "POST",
		                url   : '<?php echo base_url()?>attendance/update_attendance_1',
		                dataType : "JSON",
		                data : {member_id:member_id},
		                success: function(data){
		                    $('[name="inputid"]').val("");
		                    // $('#ModalaEdit').modal('hide');
		                    tampil_list_member();
		                }
		            });
		            return false;

	            // }
	        });
		});
	</script>
</body>
</html>