
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Records</h1>

        <h2>Students</h2>
        <?php
        // Database connection parameters
        $host = "db"; // Service name defined in docker-compose.yml
        $username = "php_docker";
        $password = "password";
        $dbname = "php_docker";
        
        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch students data
        $sql_students = "SELECT * FROM students";
        $result_students = $conn->query($sql_students);

        if ($result_students->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Name</th><th>Date of Birth</th><th>Email</th></tr>';
            while($row = $result_students->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['dob'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No students found.';
        }

        // Close connection
        $conn->close();
        ?>

        <h2>Courses</h2>
        <?php
        // Create connection again (since mysqli_close() was used in previous section)
        $conn = new mysqli($host, $username, $password, $dbname);

        // Fetch courses data
        $sql_courses = "SELECT * FROM courses";
        $result_courses = $conn->query($sql_courses);

        if ($result_courses->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Name</th><th>Description</th></tr>';
            while($row = $result_courses->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No courses found.';
        }

        // Close connection
        $conn->close();
        ?>

        <h2>Enrollments</h2>
        <?php
        // Create connection again
        $conn = new mysqli($host, $username, $password, $dbname);

        // Fetch enrollments data
        $sql_enrollments = "SELECT students.name AS student_name, courses.name AS course_name, enrollments.enrollment_date 
                            FROM enrollments 
                            JOIN students ON enrollments.student_id = students.id 
                            JOIN courses ON enrollments.course_id = courses.id";
        $result_enrollments = $conn->query($sql_enrollments);

        if ($result_enrollments->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Student Name</th><th>Course Name</th><th>Enrollment Date</th></tr>';
            while($row = $result_enrollments->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['student_name'] . '</td>';
                echo '<td>' . $row['course_name'] . '</td>';
                echo '<td>' . $row['enrollment_date'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No enrollments found.';
        }

        // Close connection
        $conn->close();
        ?>
    </div>
</body>
</html>