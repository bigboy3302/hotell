<?php require "../app/views/components/header.php" ?>
<?php require "../app/views/components/navbar.php" ?>
<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    echo '<link rel="stylesheet" href="Public/CSS/index.style.css">'; // Include the CSS link
    require "views/admin/listings.partial.view.php";
    die();
}
?>

<form id="search-form">
    <input type="text" id="search-input" name="search" placeholder="Search listings by name" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <select id="sort-select" name="sort">
        <option value="">Sort by</option>
        <option value="price_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : '' ?>>Lowest price first</option>
        <option value="price_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : '' ?>>Highest price first</option>
    </select>
</form>
<div id="listings-container">
  <?php require "views/admin/listings.partial.view.php"; ?>
</div>

<?php require "../app/views/components/footer.php" ?>