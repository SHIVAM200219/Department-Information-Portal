<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Associated Faculties</title>
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
            background: url("./img/background.webp");
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
            text-align: center;
            background-color: #e57fd6;
            height: 70%;
            margin-top: -15px;
            padding-top: 20px;
            box-sizing: border-box;
            flex: 1;
        }

        .section {
            display: flex;
            margin-left: -15px;
            margin-right: -15px;
        }

        .nav {

            background: url("./img/background_intro.webp");
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

        .outpar {
            display: flex;
            flex-direction: column;
            width: 89%;

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
            <!-- <button> <a href="registration.php"> Registration</a></button> -->
            <button> <a href="index.php">Log Out</a></button>
            <button> <a href="new_associated_faculties.php"> New Entry for faculty</a></button>
            <button> <a href="queries.php">Courses Departments Instructors</a></button>
            <button> <a href="library.php">Library</a></button>
        </div>
        <div class="outpar">
            <div class="content">
                <div class="search_name">
                    <form action="" method="post">
                        <h2>Search by Faculty Name</h2>
                        <p> Name: <input type="text" name="name" placeholder="Enter Name" required="required">
                        </p>

                        <input type="reset" value="Reset" name="reset">
                        <input type="submit" value="Submit" name="submit1">
                    </form>
                </div>
                <div class="search_dname">
                    <form action="" method="post">
                        <h2>Search by Department Name</h2>
                        <p> Department Name: <input type="text" name="department" placeholder="Enter Department Name" required="required">
                        </p>

                        <input type="reset" value="Reset" name="reset">
                        <input type="submit" value="Submit" name="submit2">
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

                //Name of the database to access
                try {
                    $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $s = $conn->query("SELECT * FROM portaldb.associated_faculties");
                    $t = $conn->query("SELECT * FROM portaldb.works_in");
                    $u = $conn->query("SELECT * FROM portaldb.department");
                    if ($_POST['submit1'] == "Submit") {
                        $flag1 = 0;
                        $dep;
                        $id;
                        $did;
                        while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
                            if ($_POST['name'] == $row['NAME']) {
                                $flag1 = 1;
                                $id = $row['ID'];
                                echo " Name:-  ", $row['NAME'], "<br> Email:- ", $row['EMAIL'], "<br> Phone No.:- ", $row['PHONE'];
                            }
                        }
                        while ($row = $t->fetch(PDO::FETCH_ASSOC)) {
                            if ($id == $row['ID']) {
                                $did = $row['DID'];
                            }
                        }
                        while ($row = $u->fetch(PDO::FETCH_ASSOC)) {
                            if ($did == $row['DID']) {
                                $dep = $row['DNAME'];
                                echo "<br>Department:- ", $dep, "<br>";
                            }
                        }
                        if ($flag1 == 0) {
                            echo "No Such Name exists<br>";
                        }
                    }
                    if ($_POST['submit2'] == "Submit") {
                        $did;
                        $id = array();
                        $flag2 = 0;
                        // $stm = $conn->query("SELECT * FROM portaldb.department");
                        while ($row = $u->fetch(PDO::FETCH_ASSOC)) {
                            if ($_POST['department'] == $row['DNAME']) {
                                $did = $row['DID'];
                                $flag2 = 1;
                                echo "<h3>{$_POST['department']}</h3>";
                            }
                        }
                        while ($row = $t->fetch(PDO::FETCH_ASSOC)) {
                            if ($did == $row['DID']) {
                                $id[] = $row['ID'];
                            }
                        }
                        while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
                            for ($x = 0; $x < count($id); $x++) {
                                if ($id[$x] == $row['ID']) {
                                    echo "Name:-  ", $row['NAME'], "<br> Email:- ", $row['EMAIL'], "<br> Phone No.:- ", $row['PHONE'], "<br><br>";
                                }
                            }
                        }
                        if ($flag2 == 0) {
                            echo "No Such Department exists<br>";
                        }
                    }


                    // echo $_POST['department'], $d;

                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
                ?>
            </div>

        </div>
    </div>



</body>

</html>