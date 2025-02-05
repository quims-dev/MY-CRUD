<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "diary"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $entry_date = $_POST['entry_date'];  

    $sql = "INSERT INTO diary_entries (title, content, entry_date) VALUES ('$title', '$content', '$entry_date')";
    if ($conn->query($sql) === TRUE) {
        $successMessage = "New record created successfully!";
    } else {
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM diary_entries WHERE id = $id";
    $conn->query($sql);
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM diary_entries WHERE id = $id";
    $result = $conn->query($sql);
    $entry = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $entry_date = $_POST['entry_date'];  

    $sql = "UPDATE diary_entries SET title='$title', content='$content', entry_date='$entry_date' WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM diary_entries ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dear Diary 💗</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet"> <!-- Add Google Font -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;  
            background: linear-gradient(135deg, #FF9A8B, #FFC3A0, #FFB6B9);
            background-size: 400% 400%;
            animation: gradientBackground 15s ease infinite;
            height: 100vh;
            color: white;
        }

        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        h1 {
            font-family: 'Dancing Script', cursive; 
            color: #5e3a8c;
            font-weight: bold;
            font-size: 3rem; 
            text-align: center;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }

        .form-group label {
            color: #5e3a8c;
        }

        .btn-primary {
            background-color: #6a4c93;
            border-color: #6a4c93;
        }

        .btn-primary:hover {
            background-color: #5e3a8c;
            border-color: #5e3a8c;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .table thead {
            background-color: #6a4c93;
            color: white;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #6a4c93;
        }

        .alert {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            background-color: #e0f7fa;
            color: #00796b;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .form-group input, .form-group textarea {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            border: 1px solid #f0f0f0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group input:focus, .form-group textarea:focus {
            border-color: #6a4c93;
        }

        .table-bordered {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
        }

        .btn {
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">My Dear Diary 💗</h1>

        <?php if (isset($successMessage)): ?>
            <div class="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php elseif (isset($errorMessage)): ?>
            <div class="alert" style="background-color: #f8d7da; color: #721c24;">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <form action="index.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required value="<?php echo isset($entry) ? $entry['title'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required><?php echo isset($entry) ? $entry['content'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="entry_date">Date</label>
                <input type="date" class="form-control" id="entry_date" name="entry_date" required value="<?php echo isset($entry) ? $entry['entry_date'] : ''; ?>">
            </div>
            <?php if (isset($entry)): ?>
                <input type="hidden" name="id" value="<?php echo $entry['id']; ?>">
                <button type="submit" name="update" class="btn btn-primary">Update Entry</button>
            <?php else: ?>
                <button type="submit" name="submit" class="btn btn-success">Add Entry</button>
            <?php endif; ?>
        </form>

        <h2 class="mt-5 text-center">◆ Diary Entries ◆</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo substr($row['content'], 0, 100); ?>...</td>
                        <td><?php echo $row['entry_date']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
                            <!-- Add Mark as Favorite Button -->
                            <a href="index.php?favorite=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Mark as Favorite</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
