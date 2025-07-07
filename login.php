<?php 
  require 'connection.php';
  checkLoginAtLogin();

  if (isset($_POST['btnLogin'])) {
  	$username = htmlspecialchars($_POST['username']);
  	$password = htmlspecialchars($_POST['password']);

  	$checkUsername = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
  	if ($data = mysqli_fetch_assoc($checkUsername)) {
  		if (password_verify($password, $data['password'])) {
  			$_SESSION = [
  				'id_user' => $data['id_user'],
  				'username' => $data['username'],
  				'id_jabatan' => $data['id_jabatan']
  			];
  			header("Location: index.php");
  		} else {
			setAlert("Password your insert is false!", "Check your Password BACK!", "error");
			header("Location: login.php");
	  	}
  	} else {
		setAlert("Username is not registered!", "Check your Username BACK!", "error");
		header("Location: login.php");
  	}
  }
?>

<!DOCTYPE html>
<html>
<head>
  <?php include 'include/css.php'; ?>
  <title>Login</title>
  <style>
	* {
	    margin: 0;
	    padding: 0;
	    box-sizing: border-box;
	}

  	body {
	    min-height: 100vh;
	    background-size: cover;
	    background-repeat: no-repeat;
	    background-image: url(assets/img/img_properties/bg-login.jpg);
	}
	
  	/* Overlay untuk efek gelap agar form lebih jelas */
  	body::before {
  		content: '';
  		position: fixed;
  		top: 0; left: 0; right: 0; bottom: 0;
  		width: 100vw;
  		height: 100vh;
  		background: rgba(0,0,0,0.35);
  		z-index: 0;
  	}
  	.container {
	    position: absolute;
	    left: 50%;
	    top: 50%;
	    transform: translate(-50%, -55%);
	}

	.col-lg-4 {
	    background: #fff;
	    border-radius: 10px;
	    padding: 2rem 1rem !important;
	    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
	}

	@media (max-width: 600px) {
	    .container {
	        max-width: 98vw;
	        padding: 0 2vw;
	    }
	    .col-lg-4 {
	        padding: 1.2rem 0.5rem !important;
	    }
	}
</style>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-4 mx-5 py-4 px-5 text-dark rounded border border-dark" style="background-color: rgba(180,190,196,.6);">
				<h3 class="text-center">KASmart</h3>
				<form method="post">
					<div class="form-group">
						<label for="username"><i class="fas fa-fw fa-user"></i> Username</label>
						<input required class="form-control rounded-pill" type="text" name="username" id="username">
					</div>
					<div class="form-group">
						<label for="password"><i class="fas fa-fw fa-lock"></i> Password</label>
						<input required class="form-control rounded-pill" type="password" name="password" id="password">
					</div>
					<div class="form-group text-right">
						<button class="btn btn-success rounded-pill" type="submit" name="btnLogin"><i class="fas fa-fw fa-sign-in-alt"></i> Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<footer style="position: absolute; bottom: 0; width: 100%; text-align: center;">
		<div style="background-color: transparent;" class="container-fluid mt-5">
			<div class="row justify-content-center">
				<div class="col-lg text-center text-white pt-4 pb-2">
					<p>&copy; Copyright 2025. By Multimedia Kreatif SMK JAYA BUANA. All Right Reserved.</p>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>