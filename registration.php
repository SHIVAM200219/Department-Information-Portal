<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
            flex-direction: row;
            height: 500px;
        }

        .nav {
            margin-left: -8px;
            background-image: url("./img/background_intro.webp");
        }

        .intro {
            width: 100%;
            /* height: 500px; */
            background-color: #fbc47e;
        }

        p {
            color: #ff0505;
            opacity: 0.9;
        }

        button {
            border-radius: 5px;
            display: block;
            margin: 25px;
            width: 100px;
        }

        button:hover {
            background-color: aquamarine;
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
    <div class="content">
        <div class="nav">
            <button> <a href="index.php"> About</a></button>
            <button> <a href="login.php">Login</a></button>
            <!-- <button> <a href="new_associated_faculties.php"> New Entry for faculty</a></button>
            <button> <a href="search_associated_faculties.php"> Search for faculty</a></button>
            <button> <a href="queries.php">Courses Departments Instructors</a></button>
            <button> <a href="library.php">Library</a></button> -->

        </div>
        <div class="intro">
            <form action="" method="post">
                <p> First Name: <input type="text" name="first_name" placeholder="Enter your First Name" required="required"></p>
                <p> Last Name: <input type="text" name="last_name" placeholder="Enter your Last Name"></p>
                <p>
                    <label for="gender">Choose Gender:</label>
                    <select name="gender" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </p>
                <p> Date of Birth: <input type="date" max='1997-12-31' name="dob" placeholder="Enter your Date of Birth" required="required"></p>
                <p> Email(official): <input type="text" name="email" placeholder="Enter your E-mail" required="required"></p>
                <p> Password: <input type="password" name="password" placeholder="Enter your Password" required="required"></p>
                <p> Confirm Password: <input type="text" name="confirm_password" placeholder="Confirm your Password" required="required"></p>

                <input type="reset" value="Reset" name="reset">
                <input type="submit" value="Submit" name="submit">

            </form>

            <?php
            error_reporting(E_ERROR | E_PARSE);
            $strong_password = 0;
            $cap_character = 0;
            $small_character = 0;
            $special_character = 0;
            $numeric_character = 0;
            $duplicate_email = 0;
            $str = $_POST['password'];
            if (strlen($str) < 8  && isset($_POST['email'])) {
                echo "Password should be of minimum 8 characters <br>";
            } else if(isset($_POST['email'])) {
                $chars = str_split($str);
                foreach ($chars as $char) {

                    if ($char >= "0" && $char <= "9") {
                        $numeric_character = 1;
                    } elseif ($char >= "A" && $char <= "Z") {
                        $cap_character = 1;
                    } elseif ($char >= "a" && $char <= "z") {
                        $small_character = 1;
                    } else {
                        $special_character = 1;
                    }
                }
                echo "<br>";
                if ($small_character == 0) {
                    echo "There should be at least one Small Character<br>";
                }
                if ($cap_character == 0) {
                    echo "There should be at least one Capital Character<br>";
                }
                if ($special_character == 0) {
                    echo "There should be at least one Special Character<br>";
                }
                if ($numeric_character == 0) {
                    echo "There should be at least one Numeric Character<br>";
                }
                if ($cap_character == 1 && $small_character == 1 && $special_character == 1 && $numeric_character == 1) {
                    $strong_password = 1;
                }
            }
            if ($_POST['submit'] == "Submit") {
                if ($_POST['password'] != $_POST['confirm_password']) {
                    echo "Password didn't match while confirmation<br>";
                } elseif (!(strpos($_POST['email'], "@"))) {
                    echo "Invalid E-mail Address<br>";
                } elseif ($strong_password == 1 && $duplicate_email == 0) {
                    $servername = "localhost";
                    $port_no = 3306;
                    $username = "shivam3";
                    $password = "sks";
                    $myDB = "PortalDB";
                    try {
                        $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        echo "Connected successfully";
                        $stm = $conn->query("SELECT * FROM portaldb.userdata");
                        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                            if ($_POST['email'] == $row['email']) {
                                echo "<br>Email already exists<br>";
                                $duplicate_email = 1;
                            }
                        }

                        if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['gender']) && isset($_POST['dob']) && isset($_POST['email']) && isset($_POST['password']) && $duplicate_email == 0) {

                            $sql = "INSERT INTO PortalDB.UserData (first_name,last_name, gender, dob, email, password) VALUES (:first_name,:last_name, :gender, :dob, :email, :password)";
                            $stmt = $conn->prepare($sql);
                            $stmt->EXECUTE(
                                array(
                                    ':first_name' => $_POST['first_name'],
                                    ':last_name' => $_POST['last_name'],
                                    ':gender' => $_POST['gender'],
                                    ':dob' => $_POST['dob'],
                                    ':email' => $_POST['email'],
                                    ':password' => $_POST['password']
                                )
                            );
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                }
            }
            ?>
        </div>
    </div>
</body>

</html>