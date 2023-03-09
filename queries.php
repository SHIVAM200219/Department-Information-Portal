<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFSDSAI</title>
    <style>
        .header {
            margin: 10px;
            color: black;
        }

        .header::before {
            position: absolute;
            margin-top: -10px;
            margin-left: -18px;
            width: 100%;
            height: 124px;
            content: "";
            background: url("./background.webp");
            z-index: -1;
            opacity: 0.5;
        }

        .content {
            display: flex;
            justify-content: space-around;
            background-color: aquamarine;
            width: 100%;
            height: 200px;
        }

        .seach_name {
            background-color: blueviolet;
        }

        .output {
            display: block;
            /* margin: -5px; */
            text-align: center;
            background-color: #e57fd6;
            width: 100%;
            /* height: 70%; */
            /* margin-left: -15px; */
            margin-top: -15px;
            margin-right: -30px;
            padding-top: 20px;
            flex: 1;
        }

        .section {
            display: flex;
            margin-left: -15px;
            margin-right: -15px;
        }

        .nav {

            background: url("./background_intro.webp");
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        a {
            text-decoration: none;
        }

        button {
            border-radius: 5px;
            display: block;
            margin: 25px;
            width: 100px;
        }

        .outputpar {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>
            Mehta Family School of Data Science and Artificial Intelligence <br> IIT GUWAHATI
        </h2>
        <h3>
            Welcome to our Information Portal
        </h3>
    </div>
    <div class="section">
        <div class="nav">
            <button> <a href="about.php"> About Us</a></button>
            <button> <a href="registration.php"> Registration</a></button>
            <button> <a href="login.php">Login</a></button>
            <button> <a href="new_associated_faculties.php"> New Entry for faculty</a></button>
            <button> <a href="search_associated_faculties.php"> Search for faculty</a></button>
            <button> <a href="library.php">Library</a></button>
        </div>
        <div class="outputpar">
            <div class="content">
                <div class="search_sname">
                    <form action="" method="post">
                        <h2>Name of all Students in a particular course</h2>
                        <p> Course Name: <input type="text" name="csname" placeholder="Enter Course Name" required="required">
                        </p>

                        <input type="reset" value="Reset" name="reset">
                        <input type="submit" value="Submit" name="submit1">
                    </form>
                </div>
                <div class="search_dname">
                    <form action="" method="post">
                        <h2>Name of Department which offer a particular course</h2>
                        <p> Course Name: <input type="text" name="cdname" placeholder="Enter Department Name" required="required">
                        </p>

                        <input type="reset" value="Reset" name="reset">
                        <input type="submit" value="Submit" name="submit2">
                    </form>
                </div>
                <div class="search_iname">
                    <form action="" method="post">
                        <h2>Name of all Instructors in a particular Department</h2>
                        <p> Department Name: <input type="text" name="department" placeholder="Enter Department Name" required="required">
                        </p>

                        <input type="reset" value="Reset" name="reset">
                        <input type="submit" value="Submit" name="submit3">
                    </form>
                </div>
            </div>
            <div class="output">
                <?php
                error_reporting(E_ERROR | E_PARSE);
                $flag = 0;
                $servername = "localhost";
                $port_no = 3306;
                $username = "shivam3";
                $password = "sks";
                $myDB = "PortalDB";


                try {
                    $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $s = $conn->query("SELECT * FROM portaldb.Student");
                    $e = $conn->query("SELECT * FROM portaldb.EnrolledIn");
                    $c = $conn->query("SELECT * FROM portaldb.Course");
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
                            $s = $conn->query("SELECT * FROM portaldb.Student");
                            while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
                                if ($rl == $row['RollNo']) {
                                    echo "<br>Roll No:- ", $rl, " Name:-", $row['Name'], "<br>";
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
                        $c = $conn->query("SELECT * FROM portaldb.Course");
                        while ($row = $c->fetch(PDO::FETCH_ASSOC)) {
                            if ($_POST['cdname'] == $row['CName']) {
                                $did = $row['DId'];
                                $flag2 = 1;
                            }
                        }
                        $d = $conn->query("SELECT * FROM portaldb.Department");
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
                        $d = $conn->query("SELECT * FROM portaldb.Department");
                        while ($row = $d->fetch(PDO::FETCH_ASSOC)) {
                            if ($_POST['department'] == $row['DNAME']) {
                                $did = $row['DID'];
                                $flag2 = 1;
                            }
                        }
                        $i = $conn->query("SELECT * FROM portaldb.Instructor");
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
    </div>



</body>

</html>