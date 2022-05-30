<?php 
/* 
* Copyright (c) 2022 Flavio Ansovini (perniciousflyer@gmail.com)  
* This code is a part of the ochin project (https://github.com/ochin-space)
* For license details see the LICENSE.md file included in the project. 
*/
require 'helper/init.php';
$dbConstructor->createTable_template();

if(isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"]==true)) 
{
    $rows = $dbConstructor->getRows_template();
    if(isset($_POST['delete'])) {
        $dbConstructor->deleteRow_template($_POST['id']);
    }
    if(isset($_POST['update'])) {
        $dbConstructor->updateRow_template($_POST['id'], $_POST['en'], $_POST['name'], $_POST['cmd_line'], $_POST['description']);
    }
    if(isset($_POST['add'])) {
        $dbConstructor->insertRow_template('','','','');
    }
?>

<html>
<head>
<link href="css/loader.css" rel="stylesheet">
<script type="text/javascript" src=<?php echo Config::jQueryPath;?>></script> 
<!-- Required meta tags for Bootstrap 5-->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link href=<?php echo Config::bootstrapCSSpath;?> rel="stylesheet">
<!-- Bootstrap js -->
<script src=<?php echo Config::bootstrapJSpath;?>></script>
<?php include Config::topbar_path;?>
<title>öchìn Web GUI</title>
</head>
    <body style="background-color:#f2f2f2;">
        <div class="container-xl">
			<div class="row">	
				<div class="col-sm-10">			
					<div class=" display-2 text-dark mt-2 mb-4 font-weight-normal text-center">Empty Template</div>
				</div>
				<div class="col-sm-2 ">		
					<div class="d-flex justify-content-end mb-2 mt-5" >
						<button type="button" class="d-flex me-4" name="info" style="background-color: Transparent; border: none;"  title="Click for info about this page" data-bs-toggle='modal' data-bs-target='#infoModal'"><img  width="40" height="40" src="icons/info.png"></button>
					</div>
				</div>        
				<div id="loader" class=""></div>
				<div class="row p-3 rounded-2" style="background-color:white;">
					<div class="row">
						<div class="fs-3 text-muted">Template table</div>
					</div>
					<div class="d-flex justify-content-end  mb-2 mt-2" >
						<div class="d-flex pe-3 pt-1">Add New Service</div>
						<button type="button" class="d-flex me-4" name="add" value="add" style="background-color: Transparent; border: none;" data-bs-toggle='modal' title="Click to add a new Service" data-bs-target='#addModal' data-bs-name="add"><img  width="30" height="30" src="icons/add.png"></button>
					</div>
					<div class="row">
						<div class="table-responsive" style="max-height:600px;">
							<table  class="table table-light table-striped" id="autoexecTable">
								<thead>
									<tr>
										<th scope="col">Enable</th>
										<th scope="col">Name</th>
										<th scope="col">Command line</th>
										<th scope="col">Description</th>
										<th scope="col"></th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($rows as $index=>$row) : ?>
										<tr>
											<td width='1%' white-space='nowrap'><?php if($row['en']=='true') { echo '<img src="icons/check.png" width="25" height="25"/>'; } else { echo '<img src="icons/uncheck.png" width="25" height="25"/>'; }?></td>
											<td value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></td>
											<td value="<?php echo $row['cmd_line']; ?>"><?php echo $row['cmd_line']; ?></td>                                    
											<td value="<?php echo $row['description']; ?>"><?php echo $row['description']; ?></td>
											<td width='1%' white-space='nowrap'>
												<button type='button' class='btn btn-primary btn-sm' title="Click to edit the Service" data-bs-toggle='modal' data-bs-target='#editModal' data-bs-id="<?php echo $row['id'];?>"  
												data-bs-enable="<?php echo $row['en'];?>" data-bs-name="<?php echo $row['name'];?>" data-bs-description="<?php echo $row['description'];?>"
												data-bs-cmd_line="<?php echo $row['cmd_line'];?>">
												Edit</button>
											</td>          
											<td width='1%' white-space='nowrap'>
												<button type='button' class='btn btn-primary btn-sm' title="Click to delete the Service" data-bs-toggle='modal' data-bs-target='#deleteModal' data-bs-id="<?php echo $row['id'];?>">
												Delete</button>
											</td> 
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
        </div>


        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Are you sure you want to add a line?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type='button' class="btn btn-primary" data-bs-dismiss="modal" onclick="insertRow()">Yes</button> 
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></div>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editModalLabel">Edit</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form>
							<div class="mb-3">
								<input hidden type="text" class="form-control" id="recipient-id">
							</div>
							<div class="form-check mb-3">
								<input class="form-check-input" type="checkbox" value="" id="enableCmdLn">
								<label class="form-check-label" for="flexCheckDefault">Enable</label>
							</div>
							<div class="mb-3">
								<label for="recipient-name" class="col-form-label">Name:</label>
								<input type="text" class="form-control" id="recipient-name" placeholder="Insert the name" value="">
							</div>
							<div class="mb-3">
								<label for="recipient-cmd_line" class="col-form-label ">Command line:</label>
								<input class="form-control" id="recipient-cmd_line" placeholder="Insert the command line"></input>
							</div>
							<div class="mb-3">
								<label for="recipient-description" class="col-form-label">Description:</label>
								<textarea type="text" class="form-control" id="recipient-description"  placeholder="Insert the description" value=""></textarea>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="updateRow()">Update</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete this Service?</h5>
                    </div>
					<input hidden type="text" class="form-control" id="recipient-id">
                    <div class="modal-footer">
                        <button type='button' class="btn btn-primary" data-bs-dismiss="modal" onclick="deleteRow()">Yes</button> 
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></div>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" >
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editModalLabel">Template guide</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body"  style="height: 80vh; overflow-y: auto;">
						<p><?php include('info.html'); ?></p>
					</div>					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>

<script>

function insertRow()
{
	document.getElementById('loader').innerHTML = '<div class="loader"></div>';
    $.ajax({
        type : "POST",  //type of method
        url  : "index.php",  //your page
        data: "add=1",
        success: function(msg)
        {
            location.reload(true);
        },
        error: function() {  }
    });
}

function deleteRow()
{
	document.getElementById('loader').innerHTML = '<div class="loader"></div>';
    id = document.getElementById('recipient-id').value;
    
    $.ajax({
        type : "POST",  //type of method
        url  : "index.php",  //your page
        data: "delete=1&id=" + id,
        success: function(msg)
        {
            location.reload(true);
        },
        error: function() { }
    });
}

function updateRow()
{
	document.getElementById('loader').innerHTML = '<div class="loader"></div>';
    id = document.getElementById('recipient-id').value;
    en = document.getElementById('enableCmdLn').checked;
    name = document.getElementById('recipient-name').value.replace(/\s/g, "_");	//remove the spaces
    cmd_line = document.getElementById('recipient-cmd_line').value;  
    description = document.getElementById('recipient-description').value;
    $.ajax({
        type : "POST",  //type of method
        url  : "index.php",  //your page
        data: "update=1&id=" + id + "&en=" + en + "&name=" + name + "&cmd_line=" + cmd_line + "&description=" + description,
        success: function(msg)
        {
            location.reload(true);
        },
        error: function() {  }
    });
}

var editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  button = event.relatedTarget;
  var id = button.getAttribute('data-bs-id');
  var enableCmdLn = button.getAttribute('data-bs-enable');
  var name = button.getAttribute('data-bs-name');
  var cmd_line = button.getAttribute('data-bs-cmd_line');  
  var description = button.getAttribute('data-bs-description');
  // Update the modal's content.
  document.getElementById('recipient-id').value = id;
  var isTrueSet = (enableCmdLn === 'true');
  document.getElementById('enableCmdLn').checked = isTrueSet;
  document.getElementById('recipient-name').value = name;
  document.getElementById('recipient-cmd_line').value = cmd_line;
  document.getElementById('recipient-description').value = description;
})

var deleteModal = document.getElementById('deleteModal');
deleteModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  button = event.relatedTarget;
  // Extract info from data-bs-* attributes
  var id = button.getAttribute('data-bs-id');
  document.getElementById('recipient-id').value = id;
})
</script>
<?php } else header("Location:../../login.php"); ?>
