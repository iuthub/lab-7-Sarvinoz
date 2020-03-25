<?php  

include('connection.php');
include('utils.php');
//printf($usersRepo->getUserStmt);
//print_r($usersRepo->getUser("rick"));
$username = '';
$fullname = '';
$password = '';
$confirm_pwd = '';
$email = '';

$isValid = '';

if($isPost) {
	$username = $_REQUEST["username"];
	$fullname = $_REQUEST["fullname"];
	$password = $_REQUEST["pwd"];
	$confirm_pwd = $_REQUEST["confirm_pwd"];
	$email = $_REQUEST["email"];
}

$usernamePattern = '/^\w{4,}$/i';
$passwordPattern = '/^\w{4,}$/i';
$emailPattern = '/^[a-zA-Z0-9\._]{4,}@[a-zA-Z0-9]{2,}\.\w{2,}$/';

$isValid = true;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Blog - Registration Form</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
		<?php include('header.php'); ?>

		<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<form action="register.php" method="post">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" required value="<?= $username ?>" />
						<?php if ($isPost && !preg_match($usernamePattern, $username)){ ?>
							<?php $isValid = false; ?>
							<span style="color: red">Requires at least 4 symbols</span>
						<?php } ?>
					</li>
					<li>
						<label for="fullname">Full Name</label>
						<input type="text" name="fullname" id="fullname" required value="<?= $fullname ?>" />
						<?php if ($isPost && !preg_match($usernamePattern, $fullname)){ ?>
							<?php $isValid = false; ?>
							<span style="color: red">Requires at least 4 symbols</span>
						<?php } ?>
					</li>
					<li>
						<label for="email">Email</label>
						<input type="email" name="email" id="email" value="<?= $email ?>" />
						<?php if ($isPost && !preg_match($emailPattern, $email)){ ?>
							<?php $isValid = false; ?>
							<span style="color: red">Email is not valid</span>
						<?php } ?>
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" id="pwd" required value="<?= $password ?>" />
						<?php if ($isPost && !preg_match($passwordPattern, $password)){ ?>
							<?php $isValid = false; ?>
							<span style="color: red">Requires at least 4 symbols</span>
						<?php } ?>
					</li>
					<li>
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" name="confirm_pwd" id="confirm_pwd" required value="<?= $password ?>" />
					</li>
					<li>
						<input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
						<?php
						if($isPost && !$usersRepo->getUser($username) && $isValid) {
							$usersRepo->addUser($username, $password, $fullname, $email);
							header('Location: index.php');
						}
						?>
					</li>
				</ul>
		</form>
	</body>
</html>