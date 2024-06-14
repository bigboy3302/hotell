<?php require "../app/views/components/header.php"; ?>
<?php require "../app/views/components/navbar.php"; ?>

<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 text-gray-800 bg-custom-purple">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-4xl mt-20 ">
        <?php if ($task): ?>
            <h2 class="text-2xl font-semibold mb-4"><?= htmlspecialchars($task->title); ?></h2>
            <p class="text-gray-700 mb-2">Description: <?= htmlspecialchars($task->description); ?></p>
            <p class="text-gray-700 mb-2">Deadline: <?= htmlspecialchars($task->deadline); ?></p>
            <!-- Display priority as star emojis -->
            <p class="text-gray-700 mb-2">Priority: <?= str_repeat('⭐️', $task->priority); ?></p>
            <form action="/">
            <button class="cssbuttons-io">
  <span
    ><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="M0 0h24v24H0z" fill="none"></path>
      <path
        d="M24 12l-5.657 5.657-1.414-1.414L21.172 12l-4.243-4.243 1.414-1.414L24 12zM2.828 12l4.243 4.243-1.414 1.414L0 12l5.657-5.657L7.07 7.757 2.828 12zm6.96 9H7.66l6.552-18h2.128L9.788 21z"
        fill="currentColor"
      ></path>
    </svg>
    Tasks</span
  >
</button>
</form>
        <?php else: ?>
            <h2 class="text-2xl font-semibold mb-4">Task not found</h2>
            
        <?php endif; ?>
    </div>
</div>

<?php require "../app/views/components/footer.php"; ?>

<style>
    .cssbuttons-io {
  position: relative;
  font-family: inherit;
  font-weight: 500;
  font-size: 18px;
  letter-spacing: 0.05em;
  border-radius: 0.8em;
  cursor: pointer;
  border: none;
  background: linear-gradient(to right, #8e2de2, #4a00e0);
  color: ghostwhite;
  overflow: hidden;
}

.cssbuttons-io svg {
  width: 1.2em;
  height: 1.2em;
  margin-right: 0.5em;
}

.cssbuttons-io span {
  position: relative;
  z-index: 10;
  transition: color 0.4s;
  display: inline-flex;
  align-items: center;
  padding: 0.8em 1.2em 0.8em 1.05em;
}

.cssbuttons-io::before,
.cssbuttons-io::after {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 0;
}

.cssbuttons-io::before {
  content: "";
  background: #000;
  width: 120%;
  left: -10%;
  transform: skew(30deg);
  transition: transform 0.4s cubic-bezier(0.3, 1, 0.8, 1);
}

.cssbuttons-io:hover::before {
  transform: translate3d(100%, 0, 0);
}

.cssbuttons-io:active {
  transform: scale(0.95);
}

</style>
