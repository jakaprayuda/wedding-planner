<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Login Account</title>
	<link rel="icon" sizes="16x16" href="<?php echo base_url('/img/favicon.ico'); ?>" type="image/x-icon">
	<link rel="stylesheet" href="<?= base_url('css/style1.css') ?>" />
	<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body style="background-image: url(/img/black.jpg);">
	<div id="layoutAuthentication">
		<div id="layoutAuthentication_content">
			<main>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-5">
							<div class="card shadow-lg border-0 rounded-lg mt-5">
								<div class="card-header">
									<h3 class="text-center font-weight-light my-4">Login</h3>
									<?php if (session()->getFlashdata('msg')) : ?>
										<div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
									<?php endif; ?>
								</div>
								<div class="card-body">
									<form action="/C_login/login" method="post">
										<div class="form-floating mb-3">
											<input type="email" name="username" class="form-control" id="InputForEmail" placeholder="Email address" />
											<label for="inputEmail">Email address</label>
										</div>
										<div class="form-floating mb-3">
											<input type="password" name="password" class="form-control" id="InputForPassword" placeholder="Password" />
											<label for="inputPassword">Password</label>
										</div>
										<div class="form-check mb-3">
											<input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
											<label class="form-check-label" for="inputRememberPassword">Remember Password</label>
										</div>
										<div class="d-flex align-items-center justify-content-between mt-4 mb-0">
											<a class="small" href="#">Forgot Password?</a>
											<button type="submit" class="btn btn-primary" title="Save">Submit</button>
										</div>
									</form>
								</div>
								<div class="card-footer text-center py-3">
									<div class="small"><a href="/C_login/register">Need an account? Sign up!</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
		<div id="layoutAuthentication_footer">
			<footer class="py-4 bg-light mt-auto">
				<div class="container-fluid px-4">
					<div class="d-flex align-items-center justify-content-between small">
						<div class="text-muted">Copyright &copy; Your Website 2022</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script class="u-script" type="text/javascript" src="<?= base_url('js/scripts.js') ?>"></script>
</body>

</html>