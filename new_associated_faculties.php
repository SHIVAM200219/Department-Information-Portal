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
            flex: 1;
            background-color: #fbc47e;
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

        button {
            border-radius: 5px;
            display: block;
            margin: 25px;
            width: 100px;
        }

        a {
            text-decoration: none;
        }

        p{
            color: #ff0505;
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
            <button> <a href="search_associated_faculties.php"> Search for faculty</a></button>
            <button> <a href="queries.php">Courses Departments Instructors</a></button>
            <button> <a href="library.php">Library</a></button>
        </div>
        <div class="content">
            <form action="" method="post">
                <p> Name: <input type="text" name="name" placeholder="Enter Name" required="required">
                </p>
                <p> Email(official): <input type="text" name="email" placeholder="Enter E-mail" required="required">
                </p>
                <p> Phone Number: <input type="text" name="phone" placeholder="Enter Phone Number" required="required">
                </p>
                <p> Department: <input type="text" name="department" placeholder="Enter Department Name" required="required">
                </p>
                <input type="reset" value="Reset" name="reset">
                <input type="submit" value="Submit" name="submit">
            </form>

        </div>
    </div>

    <?php
    error_reporting(E_ERROR | E_PARSE);
    if ($_POST['submit'] == "Submit") {
        $servername = "localhost";
        $port_no = 3306;
        $username = "shivam3";
        $password = "sks";
        $myDB = "PortalDB";
        try {
            $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully<br>";
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['department']) && isset($_POST['phone'])) {
                $dep_data = $conn->query("SELECT * FROM portaldb.department");
                $d;
                $id;
                $flag = 0;
                while ($row = $dep_data->fetch(PDO::FETCH_ASSOC)) {
                    if ($_POST['department'] == $row['DNAME']) {
                        $d = $row['DID'];
                        $sql_asfc = "INSERT INTO PortalDB.associated_faculties( NAME, EMAIL, PHONE) VALUES (:name, :email, :phone)";
                        $asfc_data = $conn->prepare($sql_asfc);
                        $asfc_data->EXECUTE(
                            array(
                                ':name' => $_POST['name'],
                                ':email' => $_POST['email'],
                                ':phone' => $_POST['phone']
                            )
                        );

                        $asfc_dat = $conn->query("SELECT * FROM portaldb.associated_faculties");
                        while ($row = $asfc_dat->fetch(PDO::FETCH_ASSOC)) {
                            if ($_POST['email'] == $row['EMAIL']) {
                                $id = $row['ID'];
                                $sql_works = "INSERT INTO PortalDB.Works_in(ID, DID) VALUES (:id, :did)";
                                $works_data = $conn->prepare($sql_works);
                                $works_data->EXECUTE(
                                    array(
                                        ':id' => $id,
                                        ':did' => $d
                                    )

                                );
                                $flag = 1;
                            }
                        }
                    }
                }
                if ($flag == 0) {
                    echo "No Such Department exists<br>";
                }
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    ?>
</body>

</html>