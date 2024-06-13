<?php 
// Set the current date based on user interaction, default to the current month
$currentDate = isset($_GET['date']) ? strtotime($_GET['date']) : time();
$tasks = isset($tasks) ? $tasks : []; // Default to an empty array if not set

require "../app/views/components/header.php"; 
?>
<?php require "../app/views/components/navbar.php"; ?>

<div class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('iphone-background.jpg');">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-3/4 lg:w-2/3 xl:w-1/2">
    <!-- Navigation -->
    <div class="flex justify-between mb-4">
      <button onclick="changeMonth(-1)" class="text-gray-600 hover:text-gray-900">&lt; Prev Month</button>
      <h1 class="text-3xl font-bold text-center">
        <?= date('F Y', $currentDate) ?>
      </h1>
      <button onclick="changeMonth(1)" class="text-gray-600 hover:text-gray-900">Next Month &gt;</button>
    </div>

    <!-- Display tasks -->
    <div class="overflow-auto max-h-96">
      <div class="mt-8 grid grid-cols-7 gap-4">
        <?php 
        // Initialize an empty array to store tasks indexed by date
        $tasksByDate = [];

        // Group tasks by date
        foreach ($tasks as $task) {
            $taskDate = date('Y-m-d', strtotime($task->deadline));
            $tasksByDate[$taskDate][] = $task;
        }

        // Loop through dates for the current month
        $daysInMonth = date('t', $currentDate);
        $currentDay = strtotime(date('Y-m-01', $currentDate));
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $currentDateFormatted = date('Y-m-d', $currentDay);
            ?>
            <div class="border border-gray-300 p-2">
              <h2 class="text-lg font-semibold mb-2"><?= date('M d', $currentDay) ?></h2>
              <ul>
                <?php 
                // Check if there are tasks for this date
                if (isset($tasksByDate[$currentDateFormatted])) {
                    foreach ($tasksByDate[$currentDateFormatted] as $task) {
                        ?>
                        <li class="mb-4">
                          <h3 class="font-semibold"><?= htmlspecialchars($task->title) ?></h3>
                          <!-- Display priority as star emojis -->
                          <p class="text-gray-600 mt-2">Priority:
                            <?= str_repeat('⭐️', $task->priority) ?>
                          </p>
                          <div class="flex items-center space-x-4 mt-2">
                            <a href="/show?id=<?= $task->id ?>" class="text-blue-600 hover:underline">Show</a>
                            <form action="/delete" method="POST">
                              <input type="hidden" name="id" value="<?= $task->id ?>">
                              
                            </form>
                          </div>
                        </li>
                    <?php }
                } else {
                    echo "<p>No tasks for this date</p>";
                }
                ?>
              </ul>
            </div>
            <?php 
            // Move to the next day
            $currentDay = strtotime('+1 day', $currentDay);
        }
        ?>
      </div>
    </div>

    <!-- Output search results if available -->
    <?php if (isset($searchResults)) { ?>
      <?php if (!empty($searchResults)) { ?>
        <h2 class="text-3xl font-bold mt-8 mb-6 text-center">Search Results</h2>
        <ul>
          <?php foreach ($searchResults as $result) { ?>
            <li class="mb-8 border-b pb-4">
              <h3 class="font-semibold text-lg"><?= htmlspecialchars($result->title) ?></h3>
              <p class="text-gray-600 mt-2"><?= htmlspecialchars($result->description) ?></p>
            </li>
          <?php } ?>
        </ul>
      <?php } else { ?>
        <p class="text-center mt-8">No tasks found matching the search criteria.</p>
      <?php } ?>
    <?php } ?>

  </div>
</div>

<script>
function changeMonth(offset) {
  const currentDate = new Date(<?= json_encode(date('Y-m-d', $currentDate)) ?>);
  currentDate.setMonth(currentDate.getMonth() + offset);
  const newDate = currentDate.toISOString().split('T')[0];
  window.location.href = `?date=${newDate}`;
}
</script>

<?php require "../app/views/components/footer.php"; ?>
