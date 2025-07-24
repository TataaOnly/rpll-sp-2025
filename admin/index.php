<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-200">
<head>
<script src="https://cdn.tailwindcss.com"></script>
    <title>PlastikHB Admin Login</title>
    <link rel="icon" href="../../images/icon.png" type="image/png">
<?php
session_start();
if(isset($_SESSION['login'])) {
    header('Location: View/layout.php?page=ubah-produk');
    exit();
}
?>
</head>
<body class="h-full">
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img class="mx-auto h-auto w-auto" src="../images/logo.png" alt="PlastikHB" />
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Admin</h2>

  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="Controller/login.php" method="POST">
      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
        </div>
        <div class="mt-2">
          <?php if (isset($_SESSION['errors']['password'])): ?>
                <div class="text-red-500 text-sm/6 mt-1"><?php echo $_SESSION['errors']['password']; ?></div>
          <?php endif; ?>
          <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>
