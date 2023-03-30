<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>MFSDSAI</title>
    <style>
    </style>
</head>

<body class="bg-info">
    <div class="bg-primary p-2 text-light">
        <h2>
            Mehta Family School of Data Science and Artificial Intelligence <br> IIT GUWAHATI
        </h2>
        <h3>
            Welcome to our Information Portal
        </h3>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/about.php">MFSDSAI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">LogOut</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./new_associated_faculties.php">New Entry for Faculty</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./search_associated_faculties.php">Search for Faculty</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./queries.php">Courses Departments & Instructor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./library.php">Library</a>
                </li>

        </div>
    </nav>
    <div class="d-flex flex-column my-5 py-5 bg-secondary text-light">
        <div class="d-flex justify-content-around flex-wrap">
            <div class="bg-dark m-3 p-3" style="flex:1; border-radius:50px">
                <h3 class="text-center">Name of all Students in a particular course</h3>
                <form class="p-5" action="" method="post">
                    <p> Course Name: <input type="text" name="csname" placeholder="Enter Course Name" required="required">
                    </p>
                    <button type="reset" value="Reset" name="reset" class="btn btn-danger m-2">Reset</button>
                    <button type="submit" value="Submit" name="submit1" class="btn btn-success m-2">Submit</button>

                </form>
            </div>
            <div class="bg-dark m-3 p-3" style="flex:1; border-radius:50px">
                <h3 class="text-center">Name of Department which offer a particular course</h3>
                <form class="p-5" action="" method="post">
                    <p> Course Name: <input type="text" name="cdname" placeholder="Enter Department Name" required="required">
                    </p>

                    <button type="reset" value="Reset" name="reset" class="btn btn-danger m-2">Reset</button>
                    <button type="submit" value="Submit" name="submit2" class="btn btn-success m-2">Submit</button>

                </form>
            </div>
            <div class="bg-dark m-3 p-3" style="flex:1; border-radius:50px">
                <h3 class="text-center">Name of all Instructors in a particular Department</h3>
                <form class="p-5" action="" method="post">
                    <p> Department Name: <input type="text" name="department" placeholder="Enter Department Name" required="required">
                    </p>
                    <button type="reset" value="Reset" name="reset" class="btn btn-danger m-2">Reset</button>
                    <button type="submit" value="Submit" name="submit3" class="btn btn-success m-2">Submit</button>

                </form>
            </div>
        </div>
        <div class="bg-success text-light text-center  m-auto w-50" style="border-radius:15px">
            <?php
            error_reporting(E_ERROR | E_PARSE);
            $flag = 0;
            $servername = "localhost";
            $port_no = 3306;
            $username = "id20433779_shivam";
            $password = "Portaldb@123";
            $myDB = "id20433779_portaldb";


            try {
                $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $s = $conn->query("SELECT * FROM id20433779_portaldb.student");
                $e = $conn->query("SELECT * FROM id20433779_portaldb.enrolledin");
                $c = $conn->query("SELECT * FROM id20433779_portaldb.course");
                if ($_POST['submit1'] == "Submit") {
                    $flag1 = 0;
                    $dep;
                    $cid;
                    $roll = array();
                    while ($row = $c->fetch(PDO::FETCH_ASSOC)) {
                        if ($_POST['csname'] == $row['CName']) {
                            $flag1 = 1;
                            $cid = $row['CId'];
                            echo " Course:-  ", $row['CName'], "<br>";
                        }
                    }
                    while ($row = $e->fetch(PDO::FETCH_ASSOC)) {
                        if ($cid == $row['CId']) {
                            $roll[] = $row['RollNo'];
                        }
                    }
                    foreach ($roll as $rl) {
                        $s = $conn->query("SELECT * FROM id20433779_portaldb.student");
                        while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
                            if ($rl == $row['RollNo']) {
                                echo "<br>Roll No:- ", $rl,"<br> Name:-", $row['Name'], "<br>";
                            }
                        }
                    }

                    if ($flag1 == 0) {
                        echo "No Such Course exists<br>";
                    }
                }
                if ($_POST['submit2'] == "Submit") {
                    $did;
                    $flag2 = 0;
                    $c = $conn->query("SELECT * FROM id20433779_portaldb.course");
                    while ($row = $c->fetch(PDO::FETCH_ASSOC)) {
                        if ($_POST['cdname'] == $row['CName']) {
                            $did = $row['DId'];
                            $flag2 = 1;
                        }
                    }
                    $d = $conn->query("SELECT * FROM id20433779_portaldb.department");
                    while ($row = $d->fetch(PDO::FETCH_ASSOC)) {
                        if ($did == $row['DID']) {
                            echo $_POST['cdname'], ":-\t", $row['DNAME'];
                        }
                    }
                    if ($flag2 == 0) {
                        echo "No Such Course exists<br>";
                    }
                }
                if ($_POST['submit3'] == "Submit") {
                    $did;
                    $flag3 = 0;
                    echo $_POST['department'], "<br><br>";
                    $d = $conn->query("SELECT * FROM id20433779_portaldb.department");
                    while ($row = $d->fetch(PDO::FETCH_ASSOC)) {
                        if ($_POST['department'] == $row['DNAME']) {
                            $did = $row['DID'];
                            $flag2 = 1;
                        }
                    }
                    $i = $conn->query("SELECT * FROM id20433779_portaldb.instructor");
                    while ($row = $i->fetch(PDO::FETCH_ASSOC)) {
                        if ($did == $row['DId']) {
                            echo $row['InsName'], "<br>";
                        }
                    }
                    if ($flag2 == 0) {
                        echo "No Instructor exists<br>";
                    }
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>