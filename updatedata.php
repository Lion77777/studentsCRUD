<?php
    require_once './conn.php';

    $id = $_GET['id'];
    $sql = "SELECT * FROM results WHERE id=$id";

    if ($result = $conn->query($sql)) {
        if ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $grade = $row['class'];
            $marks = $row['marks'];
        }
    }

    $grade1 = $grade;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - CRUD - Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<section>
        <h1 style="text-align: center; margin: 50px 0;">Edit PHP CRUD operations with MySQL</h1>
        <div class="container">
            <form action="updatedata.php?id=<?php echo $id; ?>" method="POST">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="name">Student Name</label>
                        <input type="text" name="name" id="name" class="form-control" required="required" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="grade">Grade</label>
                        <select name="grade" id="grade" required="required" class="form-control">
                            <?php
                                for ($i = 0; $i < 5; $i++) {
                            ?>

                            <option value="<?php echo $grade; ?>">Grade <?php echo $grade; ?></option>

                            <?php
                                    if ($grade < 10) {
                                        $grade++;
                                    } else {
                                        $grade = 6;
                                    }
                                    
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="marks">Marks</label>
                        <input type="number" name="marks" required="required" id="marks" class="form-control" value="<?php echo $marks; ?>">
                    </div>
                    <div class="form-group col-lg-2" style="display: grid; align-items: flex-end;">
                        <input type="submit" name="submit" id="submit" class="btn btn-primary" >
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<?php

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $grade = $_POST['grade'];
        $marks = $_POST['marks'];

        if ($name != "" && $grade != "" && $marks != "") {
            $sql = "UPDATE results SET `name` = '$name', `class` = '$grade', `marks` = $marks WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                header("Location: index.php");
            } else {
                echo "Something went wrong. Please try again";
            }
        } else {
            echo "Name, Grade and Marks should be filled.";
        }
    }
?>