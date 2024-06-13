<?php require "../app/views/components/header.php"; ?>

<div class="flex items-center justify-center min-h-screen bg-gray-100 relative">
  <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('https://a2ru.org/wp-content/uploads/2021/06/free-seamless-tileable-patterns-40.jpg'); filter: blur(80px);"></div>
  <div class="w-full max-w-md z-10">
    <div class="bg-white shadow-xl rounded-lg py-10 px-12 mt-4">
      <div class="mb-4">
        <h1 class="text-3xl font-semibold text-center text-gray-800">Sign in</h1>
      </div>
      <form action="/login" method="post">
        <div class="mb-4">
          <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
          <input type="text" id="email" name="email" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
          <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
        </div>
        <div class="flex items-center justify-between mb-6">
          <a href="/register" class="text-sm text-blue-600 hover:underline">Don't have an account?</a>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700">Sign in</button>
      </form>
    </div>
  </div>
</div>

<?php require "../app/views/components/footer.php"; ?>