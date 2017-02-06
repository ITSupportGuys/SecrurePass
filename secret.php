<?php

$con = mysqli_connect("localhost", "$User", "$Password", "$DB");

if (mysqli_connect_errno()) {
     die(mysqli_connect_error());
}

if(isset ($_GET['page'])){$page = clean($_GET['page']);}else{$page = "";}		// Set to blank if no data in the field


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IT Support Guys</title>
        <link rel="shortcut icon" href="secret/favicon.ico" type="image/x-icon">
        <link rel="icon" href="secret/favicon.ico" type="image/x-icon">

        <link href="secret/css/bootstrap.min.css" rel="stylesheet">
        <link href="secret/css/font-awesome.min.css" rel="stylesheet">
        <link href="secret/css/style.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
<?php


//######################################################
//#################### Start Pages #####################

if($page == "C"){
	$password = "";
	$username = "";
	$TTL = "";
	$SELFDESTRUCT = 0;
	
	
	if(isset ($_POST['submitted'])){
		$random = generateRandomString(25);
		$epoch = time(); // Get current epoch time
		$TTL = 24; // Default TTL in Hours
		$TTLS = $TTL * 3600; //Hours to Seconds
		$then = $epoch + $TTLS; // Add the TTL to the Epoch Time
		$gen = 0;
			
		if(isset ($_POST['username'])){$username = clean(str_replace(" ", "", $_POST['username']));}else{$username = "";}
		if(isset ($_POST['password'])){$password = clean(str_replace(" ", "", $_POST['password']));}else{$password = "";}
		if(isset ($_POST['SELFDESTRUCT'])){$SELFDESTRUCT = clean($_POST['SELFDESTRUCT']);}else{$SELFDESTRUCT = 0;}
		
		if ($password == ""){
			$password = generateRandomString(10); // Make a random password if feild is left blank
			$gen = 1;
		}
		
		$result = mysqli_query($con, "INSERT INTO `itsuppor_passwords`.`passwords` (`ID`, `USERNAME`, `PASSWORD`, `CREATED`, `RANDOM`, `SELFDESTRUCT`) VALUES (NULL, '$username', '$password', '$then', '$random', '$SELFDESTRUCT');") or die (mysql_error());
		
		?>
			<section class="securepass securepass2">
				<div class="wrapper">
					<div class="container">
						<div class="row">
							<div class="col-sm-6">
								<img src="secret/img/logo.jpg" height="110" width="220" alt="ITSG Logo" class="img-responsive">
								<h1 class="text-uppercase">Secure<span>pass</span></h1>
								<h3>Links are encrypted and auto-expire after 24 hours or when read.</h3>
								<h3>Step 2: Copy the link and send to the desired recipient.</h3>
							</div> <!-- end left section -->
							
							<div class="col-sm-6 right-section">                        
								<h3 class="text-uppercase">Send Secure<span>pass</span> Link</h3>
								
								<div class="display-group">
									<span class="display">Link:</span><BR>
									<span class="display-link"><?php echo "https://secure.itsupportguys.com/secret.php?page=R&code=$random"; ?></span>
								</div>
								
								<?php
								if ($gen == 1){
								?>
									<div class="display-group">
										<span class="display">Generated Password: </span><BR>
										<span class="read"><?php echo $password; ?></span>
									</div>
								<?php
								}
								?>
								
								
								<div class="display-group">
									<?php
										if ($SELFDESTRUCT == 1){
											echo "<span class=read>Your link will be destroyed in 24 hours or when read.</span>";
										} else {
											echo "<span class=read>Your link will be destroyed in 24 hours.</span>";
										}
									?>
								</div>
								
								<div class="list-group">
									<a href="https://www.facebook.com/itsupportguys" target="_blank"><i class="fa fa-facebook"></i></a>
									<a href="https://twitter.com/itsupportguys" target="_blank"><i class="fa fa-twitter"></i></a>
									<a href="http://www.yelp.com/biz/it-support-guys-glendale-2" target="_blank"><i class="fa fa-yelp"></i></a>
									<a href="http://www.itsupportguys.com">www.itsupportguys.com</a>
								</div>
							</div><!-- end left section -->
						</div>
					</div> <!-- end container -->
				</div> <!-- end wrapper -->
			</section>
				

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<!-- <script src="js/bootstrap.min.js"></script> -->
		</body>
		</html>
		<?php
	} else {	
		?>
		<section class="securepass">
					<div class="wrapper">
						<div class="container">
						<div class="row">
						<div class="col-sm-6">
							<img src="secret/img/logo.jpg" height="110" width="220" alt="ITSG Logo" class="img-responsive">
							<h1 class="text-uppercase">Secure<span>pass</span></h1>
							<h3>Send passwords safely with a self-destructing encrypted link.</h3>
							<h3>Step 1: Enter the username and password you would like to send securely.</h3>
						</div><!-- end left section -->

						<div class="col-sm-6 right-section">
							<h3 class="text-uppercase">Create Secure<span>pass</span> Link</h3>
							<form method="post" action="" class="form-horizontal">
								<div class="form-group">
									<label for="user_name" class="col-sm-4 control-label">User Name</label>
									<div class="col-sm-8">
										<input name="username" type="text" class="form-control" id="user_name">
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-4 control-label">Password</label>
									<div class="col-sm-8">
										<input name="password" type="password" id="password" class="passText" placeholder=""><a href="#" class="togglePassText"><img src="/secret/img/eyew.png" alt="Unmask Password" width="20px"></a>
										<script src='//assets.codepen.io/assets/common/stopExecutionOnTimeout.js?t=1'></script>
										<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
										<script>
											$('input[type=password]').each(function () {
												var el = $(this), elPH = el.attr('placeholder');
												el.addClass('offPage').before('<input type="text" class="passText" placeholder="' + elPH + '" />');
											});
											$('input[type=password]').keyup(function () {
												var elText = $(this).val();
												$('.passText').val(elText);
											});
											$('.passText').keyup(function () {
												var elText = $(this).val();
												$('input[type=password]').val(elText);
											});
											$('input[type=password], .passText').toggleClass('offPage'); 
											$('a.togglePassText').click(function (e) {
												$('input[type=password], .passText').toggleClass('offPage');
												e.preventDefault();
											});
										</script>
										<div class="help-block text-right">(leave blank to auto-generate)</div>
									</div>
								</div>
								<div class="form-group">
									 <div class="col-sm-12">
										<div class="checkbox checkbox-info">
											<input name="SELFDESTRUCT" type="checkbox" id="destroy" value="1" /checked>
											<label for="destroy" class="control-label">Destroy on read</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="hidden" name="submitted" value="1" />
										<button name="submit" type="submit" class="btn btn-info btn-block">Submit</button>
									</div>
								</div>
							</form>

							<div class="list-group">
								<a href="https://www.facebook.com/itsupportguys" target="_blank"><i class="fa fa-facebook"></i></a>
								<a href="https://twitter.com/itsupportguys" target="_blank"><i class="fa fa-twitter"></i></a>
								<a href="http://www.yelp.com/biz/it-support-guys-glendale-2" target="_blank"><i class="fa fa-yelp"></i></a>
								<a href="http://www.itsupportguys.com">www.itsupportguys.com</a>
							</div>
						</div><!-- end left section -->
						</div>
						</div> <!-- end container -->
					</div> <!-- end wrapper -->
				</section>

			</body>
		</html>
		<?php
		
	}	
} elseif ($page == "R") {
	
	if(isset ($_GET['code'])){$random = clean($_GET['code']);}else{$random = "";}
	
	$result = mysqli_query($con, "SELECT * FROM `passwords` WHERE `RANDOM` = '$random' ") or die (mysql_error());
	while ($a_row= mysqli_fetch_array($result)) {	
		$USERNAME = $a_row['USERNAME'];
		$PASSWORD = $a_row['PASSWORD'];
		$CREATED = $a_row['CREATED'];
		$SELFDESTRUCT = $a_row['SELFDESTRUCT'];
	}
	
	if($PASSWORD == "" || $random == ""){ // Message already Deleted
		?>
		<section class="securepass">
					<div class="wrapper">
						<div class="container">
						<div class="row">
						<div class="col-sm-6">
							<img src="secret/img/logo.jpg" height="110" width="220" alt="ITSG Logo" class="img-responsive">
							<h1 class="text-uppercase">Secure<span>pass</span></h1>
							<h3>Send passwords safely with a self-destructing encrypted link.</h3>
						</div><!-- end left section -->

						<div class="col-sm-6 right-section">
							<h3 class="text-uppercase">Secure<span>pass</span> Error</h3>
								<div class="form-group">
									<div class="col-sm-9">
										This message has already been destroyed or wasnt found.<BR><BR>
										Please Contact IT Support Guys.<BR><BR>
										Call us at 855-448-4897<BR><BR>
									</div>
								</div>
								
							<div class="list-group">
								<BR/><BR/><BR/><BR/><BR/><BR/><BR/>
							</div>
							
							<div class="list-group">
								<a href="https://www.facebook.com/itsupportguys" target="_blank"><i class="fa fa-facebook"></i></a>
								<a href="https://twitter.com/itsupportguys" target="_blank"><i class="fa fa-twitter"></i></a>
								<a href="http://www.yelp.com/biz/it-support-guys-glendale-2" target="_blank"><i class="fa fa-yelp"></i></a>
								<a href="http://www.itsupportguys.com">www.itsupportguys.com</a>
							</div>
						</div><!-- end left section -->
						</div>
						</div> <!-- end container -->
					</div> <!-- end wrapper -->
				</section>

			</body>
		</html>
		<?php
		
		
		
		
	}else{ // Code is good and message still valid
		
		?>
			<section class="securepass securepass2">
				<div class="wrapper">
					<div class="container">
						<div class="row">
							<div class="col-sm-6">
								<img src="secret/img/logo.jpg" height="110" width="220" alt="ITSG Logo" class="img-responsive">
								<h1 class="text-uppercase">Secure<span>pass</span></h1>
								<h3>Links are encrypted and auto-expire after 24 hours or when read.</h3>
							</div> <!-- end left section -->
							
							<div class="col-sm-6 right-section">                        
								<h3 class="text-uppercase">Retrieve Secure<span>pass</span> Link</h3>
                            
								<?php
								if ($USERNAME != ""){
								?>
									<div class="display-group">
										<span class="display">Username: </span>
										<span class="read"><?php echo $USERNAME; ?></span>
									</div>
								<?php
								}
								?>
								
								<div class="display-group">
									<span class="display">Password: </span>
									<span class="read"><?php echo $PASSWORD; ?></span>
								</div>
								
								<div class="display-group">
									<?php
									if($SELFDESTRUCT == 1){
										echo "<span class=display>This message has been destroyed.</span>";
										// Remove the DB Entry if marked for delete on read
										$result = mysqli_query($con, "DELETE FROM `itsuppor_passwords`.`passwords` WHERE `passwords`.`RANDOM` = '$random' ") or die (mysql_error());
									}else{
										$dated = $CREATED - 7200; // Adjust for Time Zone
										$destroy = date('m-d-Y H:i:s', $dated); // Convert the Epoch time to a real date
										echo "<span class=display>This entry will be destroyed on $destroy</span>";
									}
									?>
								</div>
								
								<div class="list-group">
									<a href="https://www.facebook.com/itsupportguys" target="_blank"><i class="fa fa-facebook"></i></a>
									<a href="https://twitter.com/itsupportguys" target="_blank"><i class="fa fa-twitter"></i></a>
									<a href="http://www.yelp.com/biz/it-support-guys-glendale-2" target="_blank"><i class="fa fa-yelp"></i></a>
									<a href="http://www.itsupportguys.com">www.itsupportguys.com</a>
								</div>
							</div><!-- end left section -->
						</div>
					</div> <!-- end container -->
				</div> <!-- end wrapper -->
			</section>
				

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<!-- <script src="js/bootstrap.min.js"></script> -->
		</body>
		</html>
		<?php
	}
	
} else {
		?>
	<h1>Something Happened</h1>
	<p>Contact IT Support Guys if you need help.</p>
	<p>855-448-4897</p>
	<?php
}



function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	$str = htmlspecialchars($str, ENT_QUOTES);
	return $str;
}

function generateRandomString($length) {
    //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';	// Full list (Cannot contain Symbols !!)
    $characters = '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';		// Cleaned up list for vague chars
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>