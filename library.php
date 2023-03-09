<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mid-Sem</title>
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

        input {
            border-radius: 15px;
            border-color: transparent;
        }

        .content {
            display: block;
            text-align: center;
            background-color: #f37dd7;
            width: 100%;
        }

        .page {
            display: flex;
        }

        .nav {
            margin-left: -8px;
            background-image: url("./background_intro.webp");
        }

        button {
            border-radius: 5px;
            display: block;
            margin: 25px;
            width: 100px;
        }

        .output {
            text-align: center;
        }

        a {
            text-decoration: none;
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
    <div class="page">

        <div class="nav">
            <button> <a href="about.php"> About Us</a></button>
            <button> <a href="registration.php">Registration</a></button>
            <button> <a href="login.php">Login</a></button>
            <button> <a href="new_associated_faculties.php"> New Entry for faculty</a></button>
            <button> <a href="search_associated_faculties.php"> Search for faculty</a></button>
            <button> <a href="queries.php">Courses Departments Instructors</a></button>
            <button> <a href="library.php">Library</a></button>

        </div>
        <div class="content">
            <div class="book">
                <form action="" method="post">
                    <p>Name of the book: <input type="text" name="bkname" placeholder="Enter Book Name" required="required"> </p>
                    <input type="submit" value="Submit" name="submit">
                </form>
            </div>
            <div class="output">
                <?php
                error_reporting(E_ERROR || E_PARSE);
                if ($_POST['submit'] == "Submit") {
                    $servername = "localhost";
                    $port_no = 3306;
                    $username = "shivam3";
                    $password = "sks";
                    $myDB = "PortalDB";
                    try {
                        $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        if (isset($_POST['bkname'])) {
                            $b = $conn->query("SELECT* FROM PortalDB.books");
                            $r = $conn->query("SELECT* FROM PortalDB.reserves");
                            $s = $conn->query("SELECT* FROM PortalDB.students");
                            $flag1 = 0;
                            $b_id;
                            $s_id;
                            echo "<br> <br> Reservation status: \t";
                            while ($row = $b->fetch(PDO::FETCH_ASSOC)) {
                                if ($_POST['bkname'] == $row['bname']) {
                                    $b_id = $row['bid'];
                                    $flag1 = 1;
                                }
                            }
                            while ($row = $r->fetch(PDO::FETCH_ASSOC)) {
                                if ($b_id == $row['bid']) {
                                    $s_id = $row['sid'];
                                    $flag2 = 1;
                                }
                            }
                            if ($flag2 == 1) {
                                while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
                                    if ($s_id == $row['sid']) {
                                        echo "Issued by ", $row['sname'];
                                    }
                                }
                            }

                            if ($flag1 == 0) {
                                echo "Book is not in our repository <br>";
                            }
                            if ($flag2 == 0 && $flag1 == 1) {
                                echo "Book is available to rent <br>";
                            }
                        }
                    } catch (PDOException $e) {
                        echo "Connection Failed <br>" . $e->getMessage();
                    }
                }
                ?>
            </div>
        </div>


    </div>
</body>

</html>