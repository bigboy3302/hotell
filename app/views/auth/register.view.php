<?php 
require "../app/views/components/header.php";
?>

<div class="flex items-center justify-center min-h-screen bg-gray-100 relative">
  <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('https://a2ru.org/wp-content/uploads/2021/06/free-seamless-tileable-patterns-40.jpg'); filter: blur(80px);"></div>
  <div class="w-full max-w-md z-10">
    <div class="bg-white shadow-xl rounded-lg py-10 px-12 mt-4">
      <div class="mb-4">
        <h1 class="text-3xl font-semibold text-center text-gray-800">Register</h1>
      </div>
      <form method="POST" class="space-y-4">
        <div>
            <label for="username" class="block text-gray-700 text-sm font-semibold mb-2">Username</label>
            <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
            <?php if(isset($errors["username"])) { ?>
                <span style="color: red;"><?php echo $errors["username"]; ?></span>
            <?php } ?>
        </div>
        <div>
            <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
            <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
            <?php if(isset($errors["email"])) { ?>
                <span style="color: red;"><?php echo $errors["email"]; ?></span>
            <?php } ?>
        </div>
        <div>
            <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password <span class="text-sm text-gray-600">(must be at least 8 characters long, containing at least 1 uppercase, 1 lowercase, 1 digit, and 1 special character)</span>:</label>
            <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
        </div>
        <div>
            <label for="confirm_password" class="block text-gray-700 text-sm font-semibold mb-2">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
            <?php if(isset($errors["confirm_password"])) { ?>
                <span style="color: red;"><?php echo $errors["confirm_password"]; ?></span>
            <?php } ?>
        </div>
        <div class="flex items-center justify-between mb-6">
            <a href="/login" class="text-sm text-blue-600 hover:underline">Already have an account?</a>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Register</button>
      </form>
    </div>
  </div>
</div>

<?php require "../app/views/components/footer.php"; ?>
