<?php require "../App/views/components/head.php"; ?>
<?php require "../App/views/components/navbar.php"; ?>

<h1 class="center">ADMIN COMMANDS</h1>

<div class="button-container">
    <form action="/create-ap">
        <button>Create apartment</button>
    </form>
    <form action="/admin-add-amount">
        <button>Change room amount</button>
    </form>
</div>

<?php require "../App/views/components/footer.php"; ?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
    }

    .center {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .button-container {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    form {
        margin: 0;
    }

    button {
        background-color: #5E503F;
        color: #EAE0D5;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 16px;
    }

    button:hover {
        background-color: #C6AC8F;
    }
</style>
