<?php
$conn = mysqli_connect("localhost", "root", "", "ruetcare_database");
// CREATE TABLE `ruetcare_database`.`excom_2023_24`(
//     `id` INT NOT NULL AUTO_INCREMENT,
//     `name` VARCHAR(40) NOT NULL,
//     `position` VARCHAR(40) NOT NULL,
//     `social_link` TEXT NULL,
//     PRIMARY KEY(`id`)
// ) ENGINE = InnoDB;
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Import Excel To MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form class="m-4 p-4 shadow" action="" method="post" enctype="multipart/form-data">
            <h2>Enter an Exel file with attribute values name, position, socail_link (value only)</h2>
            <input class="form-control mt-2" type="file" name="excel" required value="">
            <button class="btn btn-success mt-2" type="submit" name="import">Import</button>
        </form>
        <hr>
        <table class="m-4 p-4 shadow table table-striped">
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Position</td>
                <td>Socialid_Link</td>
            </tr>
            <?php
            $rows = mysqli_query($conn, "SELECT * FROM excom_2023_24");
            foreach ($rows as $row) :
            ?>
                <tr>
                    <td> <?php echo $row["id"]; ?> </td>
                    <td> <?php echo $row["name"]; ?> </td>
                    <td> <?php echo $row["position"]; ?> </td>
                    <td> <a href="<?php echo $row["social_link"]; ?>"> <?php echo $row["social_link"]; ?> </a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php
        if (isset($_POST["import"])) {
            $fileName = $_FILES["excel"]["name"];
            $fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));
            $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

            $targetDirectory = "uploads/" . $newFileName;
            move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

            error_reporting(0);
            ini_set('display_errors', 0);

            require 'excelReader/excel_reader2.php';
            require 'excelReader/SpreadsheetReader.php';

            $reader = new SpreadsheetReader($targetDirectory);
            foreach ($reader as $key => $row) {
                $name = $row[0];
                $position = $row[1];
                $social_link = $row[2];
                mysqli_query($conn, "INSERT INTO excom_2023_24 VALUES('', '$name', '$position', '$social_link')");
            }

            echo
            "
                <script>
                alert('Succesfully Imported');
                document.location.href = '';
                </script>
                ";
        }
        ?>

        <div>
            <br><br><br>
            <a href="https://www.youtube.com/watch?v=yTo22GBGPzs&list=WL&index=95">Tutorial Link</a>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>