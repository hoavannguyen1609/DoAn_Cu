<?php $this->render('block/head',$contentLogin);?>
<body>
	<video id="vidbg" preload="auto" autoplay="true" loop="loop" muted volume="0">
		<source type="video/mp4" src="<?php echo _WEB_ROOT .'/public/assets/video/Ipad.mp4'?>">
	</video>
	<div>
		<div class="center-container">
			<div class="header-w3l wow swing center" data-wow-duration="2">
				<h1>CellphoneS Login Form</h1>
			</div>
			<div class="main-content-agile">
				<div class="sub-main-w3">	
					<div data-wow-duration="1" class="wthree-pro wow bounce">
						<h2>Login Here</h2>
					</div>
					<form method="post" class="wow fadeIn" data-wow-duration="1" id="loginForm">
						<input placeholder="Username" name="Name" class="user wow rollIn" type="text" autocomplete="off" autofocus>
						<span class="icon1 wow rollIn"><i class="fa fa-user" aria-hidden="true"></i></span><br><br>
						<input  placeholder="Password" name="Password" class="pass wow lightSpeedIn" type="password" autocomplete="off">
						<span class="icon2 wow lightSpeedIn"><i class="fa fa-unlock" aria-hidden="true"></i></span><br>
						<div class="sub-w3l">
							<h6><a href="#">Forgot Password?</a></h6>
							<div class="right-w3l wow fadeIn" data-wow-duration="1" data-wow-delay="1">
								<input type="submit" value="Login">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="footer">
				<p>&copy; 2021 CellphoneS Login Form. All rights reserved | Design by <a href="<?php echo _WEB_ROOT ?>">Cellphones</a></p>
			</div>
		</div>
	</div>
	<base href="<?php echo _WEB_ROOT ?>">
</body>
</html>