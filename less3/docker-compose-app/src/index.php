<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>task2: docker-compose-app test</h1>

    <?php
    $host = getenv('DB_HOST') ?: 'host.docker.internal';
    $port = getenv('DB_PORT') ?: '3306';
    $dbname = getenv('DB_NAME') ?: 'test_db';
    $user = getenv('DB_USER') ?: 'root';
    $password = getenv('DB_PASSWORD') ?: 'root';

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $password);        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo '<div class="success">✅ Successfully connected to MySQL database!</div>';

        $stmt = $pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<h3>Users in Database:</h3>';
        if (count($users) > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Name</th><th>Email</th></tr>';
            foreach ($users as $user) {
                echo "<tr>
                            <td>{$user['id']}</td>
                            <td>{$user['name']}</td>
                            <td>{$user['email']}</td>
                          </tr>";
            }
            echo '</table>';
        } else {
            echo '<p>No users found in database.</p>';
        }
    } catch (PDOException $e) {
        echo '<div class="error">❌ Database connection failed: ' . $e->getMessage() . '</div>';
    }
    ?>
</body>

</html>