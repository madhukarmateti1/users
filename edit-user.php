<?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_GET['edit']))
	{
		$editid=$_GET['edit'];
	}


	
if(isset($_POST['submit']))
  {
	//$username=$_POST['username'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $colours=$_POST['colours'];
    $idedit=$_POST['idedit'];
    //$password=md5($_POST['password']);


	$sql="UPDATE users SET firstname=(:firstname),lastname=(:lastname), email=(:email), gender=(:gender), colours=(:colours) WHERE id=(:idedit)";
	$query = $dbh->prepare($sql);

    //$query-> bindParam(':username', $username, PDO::PARAM_STR);    
    $query-> bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $query-> bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':gender', $gender, PDO::PARAM_STR);
    $query-> bindParam(':colours', $colours, PDO::PARAM_STR);
    $query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
    //$query-> bindParam(':password', $password, PDO::PARAM_STR);
	$query->execute(); 
	$msg="User Details Updated Successfully";
	echo "<script type='text/javascript'>alert('$msg');</script>";
    echo "<script type='text/javascript'> document.location = 'userlist.php'; </script>";
}    
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Edit User</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">

	<style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
	background: #dd3d36;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>
</head>

<body>
<?php
		echo $sql = "SELECT * from users where id = :editid"; 
		$query = $dbh -> prepare($sql);
		$query->bindParam(':editid',$editid,PDO::PARAM_INT);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3 class="page-title">Edit User : <?php echo htmlentities($result->firstname); ?></h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Info</div>
			<!--<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>-->

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">
	<div class="form-group">
	<!--<label class="col-sm-2 control-label">User Name</label>
	<div class="col-sm-4">
	<input type="text" name="username" class="form-control" readonly="readonly" value="<?php //echo htmlentities($result->username);?>">
	</div>-->
	<label class="col-sm-2 control-label">First Name<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="firstname" class="form-control" required value="<?php echo htmlentities($result->firstname);?>">
	</div>
	<label class="col-sm-2 control-label">Last Name<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="lastname" class="form-control" required value="<?php echo htmlentities($result->lastname);?>">
	</div>
	<label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="email" name="email" class="form-control" required value="<?php echo htmlentities($result->email);?>">
	</div>
	</div>

<div class="form-group">
<label class="col-sm-2 control-label">Gender<span style="color:red">*</span></label>
<div class="col-sm-4">
<select name="gender" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Male" <?php if(htmlentities($result->gender)=="Male") { echo "Selected";}?>>Male</option>
                            <option value="Female" <?php if(htmlentities($result->gender)=="Female") {echo "Selected";}?>>Female</option>
                            </select>
</div>
<label class="col-sm-2 control-label">Colours<span style="color:red">*</span></label>
<div class="col-sm-4">
<select name="colours" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Yellow" <?php if(htmlentities($result->colours)=="Yellow") { echo "Selected";}?>>Yellow</option>
                            <option value="Orange" <?php if(htmlentities($result->colours)=="Orange") {echo "Selected";}?>>Orange</option>
                            <option value="Brown" <?php if(htmlentities($result->colours)=="Brown") {echo "Selected";}?>>Brown</option>
                            </select>
</div>
</div>


<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<input type="hidden" name="idedit" value="<?php echo htmlentities($result->id);?>" >
</div>
</div>


<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
	</div>
</div>

</form>
									</div>
								</div>
							</div>
						</div>
						
					

					</div>
				</div>
				
			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
	</script>

</body>
</html>
<?php } ?>