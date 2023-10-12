<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">

    <title>
        <?php echo "Fout" ?>
    </title>

    <style>
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
    </style>

</head>

<body>
    <?php
    $session = \Config\Services::session();
    ?>
    <div class="container text-center">
        <h1 class="headline">Fout</h1>
        <?= nl2br(esc($exception->getMessage())) ?>
        <br>
        <br>
        <?php
        try {
            echo current_url();
        } catch (Exception $e) {
            echo 'Url niet beschikbaar of gevonden.';
        }
        ?>
        <br>
        <?php
        try {
            if (isset($_SESSION['user_id'])) {
                echo "user_id: " . $_SESSION['user_id'];
            } else {
                echo "user_id: 0";
            }
        } catch (Exception $e) {
            echo 'Kon user_id niet ophalen';
        }
        echo '<br>';
        try {
            if (isset($_SESSION['useraccount_id'])) {
                echo "useraccount_id: " . $_SESSION['useraccount_id'];
            } else {
                echo "useraccount_id: 0";
            }
        } catch (Exception $e) {
            echo 'Kon useraccount_id niet ophalen';
        }
        ?>
        <?php
        try {
            ?>
            <p><b><?= esc(clean_path($file)) ?></b> at line <b><?= esc($line) ?></b></p>
            <br>
            <?= esc(date('H:i:s a')) ?>
            <p class="lead">Er is iets fout gegaan, neem contact met ons op.</p>
            <?php
        } catch (Exception $exception) {
            echo "Kon error logs niet ophalen";
        }
        ?>
    </div>
</body>
</html>