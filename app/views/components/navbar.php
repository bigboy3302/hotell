<?php require "../app/views/components/header.php" ?>

<header class="bg-gray-800 py-4 shadow-md fixed top-0 w-full z-50">
    <nav class="container mx-auto flex justify-between items-center px-4">
        <div class="flex items-center space-x-4">
            <a href="/" class="text-white text-lg font-semibold">Home</a>
            <a href="/create" class="text-white text-lg font-semibold">Create Task</a>
            <a href="/calendar" class="text-white text-lg font-semibold">Calendar</a>
        </div>

        <?php if (isset($_SESSION["email"])): ?>
            <div class="relative flex items-center space-x-4">
                <span id="user-email" class="text-white text-lg cursor-pointer hover:text-blue-300 transition duration-500 bg-gray-700 px-2 py-1 rounded">Welcome, <?= htmlspecialchars($_SESSION["email"]) ?></span>
                <form id="logout-form" method="POST" action="/logout" class="hidden absolute top-full mt-2 transition duration-500">
                    <button type="submit" class="text-white text-lg font-semibold bg-gray-700 py-2 px-4 rounded">Log Out</button>
                </form>
            </div>
        <?php else: ?>
            <a href="/login" class="text-white text-lg font-semibold">Login</a>
        <?php endif; ?>
    </nav>
</header>

<script src="../public/js/nav.js"></script>

<?php require "../app/views/components/footer.php" ?>