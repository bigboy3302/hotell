<?php require "../app/views/components/header.php"; ?>
<?php require "../app/views/components/navbar.php"; ?>

<div class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('iphone-background.jpg');">
  <div class="bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center">Create a Task</h1>
    <form class="text-center" method="POST" action="/create">
      
      <?php if (isset($_SESSION['user_id'])) { ?>
          <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
      <?php } ?>
      
      <div class="mb-4">
        <label for="title" class="block text-gray-700 text-sm font-semibold mb-2">Title</label>
        <input type="text" id="title" name="title" value="<?= $_POST["title"] ?? "" ?>" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
        <?php if (isset($errors["title"])) { ?>
          <p class="text-red-500 text-sm"><?= $errors["title"] ?></p>
        <?php } ?>
      </div>
      <div class="mb-4">
        <label for="description" class="block text-gray-700 text-sm font-semibold mb-2">Description</label>
        <textarea id="description" name="description" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required><?= $_POST["description"] ?? "" ?></textarea>
        <?php if (isset($errors["description"])) { ?>
          <p class="text-red-500 text-sm"><?= $errors["description"] ?></p>
        <?php } ?>
      </div>
      <div class="mb-4">
        <label for="deadline" class="block text-gray-700 text-sm font-semibold mb-2">Deadline</label>
        <input type="date" id="deadline" name="deadline" value="<?= $_POST["deadline"] ?? "" ?>" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500" required>
        <?php if (isset($errors["deadline"])) { ?>
          <p class="text-red-500 text-sm"><?= $errors["deadline"] ?></p>
        <?php } ?>
      </div>
      
      <!-- Priority Selection -->
      <div class="mb-4">
        <label for="priority" class="block text-gray-700 text-sm font-semibold mb-2">Priority</label>
        <select id="priority" name="priority" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500">
          <option value="1">⭐</option>
          <option value="2">⭐⭐</option>
          <option value="3">⭐⭐⭐</option>
          <option value="4">⭐⭐⭐⭐</option>
          <option value="5">⭐⭐⭐⭐⭐</option>
        </select>
      </div>
      
      
      <button type="submit" class="relative border hover:border-sky-600 duration-500 group cursor-pointer text-sky-50  overflow-hidden h-14 w-56 rounded-md bg-sky-800 p-2 flex justify-center items-center font-extrabold">
  <div class="absolute z-10 w-48 h-48 rounded-full group-hover:scale-150 transition-all  duration-500 ease-in-out bg-sky-900 delay-150 group-hover:delay-75"></div>
  <div class="absolute z-10 w-40 h-40 rounded-full group-hover:scale-150 transition-all  duration-500 ease-in-out bg-sky-800 delay-150 group-hover:delay-100"></div>
  <div class="absolute z-10 w-32 h-32 rounded-full group-hover:scale-150 transition-all  duration-500 ease-in-out bg-sky-700 delay-150 group-hover:delay-150"></div>
  <div class="absolute z-10 w-24 h-24 rounded-full group-hover:scale-150 transition-all  duration-500 ease-in-out bg-sky-600 delay-150 group-hover:delay-200"></div>
  <div class="absolute z-10 w-16 h-16 rounded-full group-hover:scale-150 transition-all  duration-500 ease-in-out bg-sky-500 delay-150 group-hover:delay-300"></div>
  <p class="z-10">Discover More</p>
</button>

    </form>
  </div>
</div>

<?php require "../app/views/components/footer.php"; ?>