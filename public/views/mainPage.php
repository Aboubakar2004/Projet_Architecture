<!DOCTYPE html>
<html lang="en">
<?php include '../components/head.php'; ?>

<body class="text-white bg-black">
    <style>
        .active{
            font-weight: bold;
            text-transform: uppercase;
            font-size: 2rem;
        }
        .iconActive{
            display: flex;
        }
        .muteActive{
            display: flex;
        }
    </style>

    <div class="">
        <?php include '../components/mainHeader.php'; ?>
        <?php include '../components/mainPage.php'; ?>
    </div>

    <script src="../js/main.js"></script>
      <script src="../js/Help.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

<?php include '../components/footer.php'; ?>

</html>