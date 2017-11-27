<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$loginError = null;
		$passwordError = null;
		$nameError = null;
		$forenameError = null;
		
		// keep track post values
		$login = $_POST['login'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$forename = $_POST['forename'];
		
		// validate input
		$valid = true;
		if (empty($login)) {
			$loginError = 'Svp entrez un login';
			$valid = false;
		}
		if (empty($password)) {
			$passwordError = 'Svp entrez un mot de passe';
			$valid = false;
		}
		
		if (empty($name)) {
			$nameError = 'Svp entrez un nom';
			$valid = false;
		} 
		
		if (empty($forename)) {
			$forenameError = 'Svp entrez un prénom';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO customers (login,password,name,forename) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($login,$password,$name,$forename));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Crée un client</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
						<div class="control-group <?php echo !empty($loginError)?'error':'';?>">
					    <label class="control-label">Login</label>
					    <div class="controls">
					      	<input name="login" type="text"  placeholder="Login" value="<?php echo !empty($login)?$login:'';?>">
					      	<?php if (!empty($loginError)): ?>
					      		<span class="help-inline"><?php echo $loginError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
					    <label class="control-label">Password</label>
					    <div class="controls">
					      	<input name="password" type="text"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
					      	<?php if (!empty($passwordError)): ?>
					      		<span class="help-inline"><?php echo $passwordError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($forenameError)?'error':'';?>">
					    <label class="control-label">Forename</label>
					    <div class="controls">
					      	<input name="forename" type="text" placeholder="Forename" value="<?php echo !empty($forename)?$forename:'';?>">
					      	<?php if (!empty($forenameError)): ?>
					      		<span class="help-inline"><?php echo $forenameError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>