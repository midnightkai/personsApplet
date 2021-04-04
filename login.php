<?php
    session_start(); 
	
		$errMsg=''; 
		if (isset($_POST['login']) 
			&& !empty($_POST['username']) 
			&& !empty($_POST['password'])) {
				
			$username = $_POST['username'];
			$password = $_POST['password'];
			$username = htmlspecialchars($username);
			$password = htmlspecialchars($password);


			if ($_POST['username'] == 'admin@admin.com' 
				&& $_POST['password'] == 'admin') {
			  
				$_SESSION['username']='admin@admin.com';
				header('Location: list.php');
				
			} else {
			    
				require '../database/database.php';
				$pdo = Database::connect();
				$sql = "SELECT * FROM person " 
				    . " WHERE username=? " 
					. " LIMIT 1"
					;
				$query=$pdo->prepare($sql);
				$query->execute(Array($username));
				$result = $query->fetch(PDO::FETCH_ASSOC);
				
				if ($result) {
					
					$password_hash_db = $result['password_hash'];
					$password_salt_db = $result['salt'];
					$password_hash    = MD5($password + $password_salt_db);
					
					if(!strcmp($password_hash, $password_hash_db)) {
						$_SESSION['username'] = $result['username'];
						header('Location: list.php');
					}

					else {
						$errMsg='Login failure: wrong password';
					}
				}
				
			else 
				$errMsg='Login failure: wrong username or password';
			}
		}
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>Crud Applet with Login</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
		
	</head>

	<body>
		
		
		<div class="container">
			<h1>Crud Applet with Login</h1>
		    <h2>Login</h2> 
		
			<form action="" method="post">
				
				<input type="text" class="form-control" 
				name="username" placeholder="admin@admin.com" 
				required autofocus /><br />
				
				<input type="password" class="form-control"
				name="password" placeholder="admin" required /><br />
				
				<button class="btn btn-lg btn-primary btn-block" 
				type="submit" name="login">Login</button>
				
				<button class="btn btn-lg btn-secondary btn-block" 
				onclick="window.location.href = 'register.php';";
				type="button" name="join">Join</button>
				
				<p style="color: red;"><?php echo $errMsg; ?></p>
			   
			</form>

		</div> 

	</body>
	
</html>