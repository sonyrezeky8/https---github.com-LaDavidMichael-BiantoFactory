<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
	$email = $_POST['username'];
	$password = md5($_POST['password']);
	$sql = "SELECT * FROM admin WHERE username='$email' AND password='$password'";
	$query = mysqli_query($koneksidb, $sql);
	$results = mysqli_fetch_array($query);
	if (mysqli_num_rows($query) > 0) {
		$_SESSION['alogin'] = $_POST['username'];
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
	} else {
		echo "<script>alert('Username atau Password salah!');</script>";
	}
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

	<title>CV Bianto Factory | Admin Login</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.2/tailwind.min.css" />
</head>

<body>

	<!-- Login -->
	<!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ]
  }
  ```
-->
	<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
		<div class="max-w-md w-full space-y-8">
			<div>
				<img class="mx-auto h-14 w-auto" src="assets/images/biantofactory.png" alt="Workflow">
				<h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
					Sign in to your account
				</h2>
				<!-- <p class="mt-2 text-center text-sm text-gray-600">
					Or
					<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
						start your 14-day free trial
					</a>
				</p> -->
			</div>
			<form class="mt-8 space-y-6" method="POST">
				<input type="hidden" name="remember" value="true">
				<div class="rounded-md shadow-sm -space-y-px">
					<div>
						<label for="email-address" class="sr-only">Email address</label>
						<input id="email-address" name="username" type="username" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Username">
					</div>
					<div>
						<label for="password" class="sr-only">Password</label>
						<input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
					</div>
				</div>

				<div class="flex items-center justify-between">
					<div class="flex items-center">
						<input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
						<label for="remember_me" class="ml-2 block text-sm text-gray-900">
							Remember me
						</label>
					</div>

					<div class="text-sm">
						<a href="#" class="font-medium text-green-600 hover:text-green-500">
							Forgot your password?
						</a>
					</div>
				</div>

				<div>
					<button name="login" type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
						<span class="absolute left-0 inset-y-0 flex items-center pl-3">
							<!-- Heroicon name: solid/lock-closed -->
							<svg class="h-5 w-5 text-green-500 group-hover:text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
							</svg>
						</span>
						Sign in
					</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /Login -->

</body>

</html>