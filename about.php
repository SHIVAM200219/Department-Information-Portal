<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <style>
        .header {
            margin: 10px;
            color: black;
        }

        .header::before {
            position: absolute;
            margin-top: -10px;
            margin-left: -20px;
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
        }

        .nav {
            margin-left: -8px;
            background-image: url("./img/background_intro.webp");
        }

        .intro {
            font-weight: bold;
            font-size: large;
            width: 100%;
            /* height: 300px; */
            /* background-repeat: no-repeat; */
        }

        .intro ::before {
            content: "";
            position: absolute;
            margin-top: -20px;
            width: 89%;
            height: 325px;
            background: url("./img/iitg_library.jpg") no-repeat center center/cover;
            z-index: -1;
            opacity: 0.4;
        }

        h3 {
            color: black;
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
            <!-- <button> <a href="registration.php"> Registration</a></button> -->
            <button> <a href="index.php">Log Out</a></button>
            <button> <a href="new_associated_faculties.php"> New Entry for faculty</a></button>
            <button> <a href="search_associated_faculties.php"> Search for faculty</a></button>
            <button> <a href="queries.php">Courses Departments Instructors</a></button>
            <button> <a href="library.php">Library</a></button>
        </div>
        <div class="intro">
            <h3>
                Data science is an emerging inter-disciplinary field that uses scientific methods, processes, algorithms and systems to extract knowledge and insights from both structured and unstructured data. The discipline of artificial intelligence involves in integrating knowledge into programs that can handle data and solve complex problems in the way human being thinks and approaches the problem. In today's context, the expertise in the domains of data science and artificial intelligence is in great demand. Lot of opportunities exists in these emerging domains. Keeping in view these latest trends, IIT Guwahati has taken active steps to start Mehta Family School of Data Science and Artificial Intelligence at IIT Guwahati so that the same can become a vibrant centre of activities in these domains, and through its undergraduate and post graduate programs, contribute in shaping a pool of highly qualified professionals in this emerging field by aligning its activities in the direction of national level initiatives.
            </h3>
        </div>
    </div>
</body>

</html>