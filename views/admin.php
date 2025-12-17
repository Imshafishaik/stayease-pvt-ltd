<?php
// This would be your admin dashboard page

// Include header
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="#dashboard">Dashboard</a></li>
            <li><a href="#users">Manage Users</a></li>
            <li><a href="#properties">Manage Properties</a></li>
            <li><a href="#bookings">View Bookings</a></li>
            <li><a href="#messages">Messages</a></li>
            <li><a href="#reviews">Reviews</a></li>
            <li><a href="#settings">Settings</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1 id="dashboard">Dashboard</h1>
        <div class="dashboard-cards">
            <div class="card">
                <h3>Total Users</h3>
                <p>150</p> <!-- Example number -->
            </div>
            <div class="card">
                <h3>Total Properties</h3>
                <p>75</p> <!-- Example number -->
            </div>
            <div class="card">
                <h3>New Bookings</h3>
                <p>12</p> <!-- Example number -->
            </div>
        </div>

        <h1 id="users">Manage Users</h1>
        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example user row -->
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john.doe@example.com</td>
                    <td>Student</td>
                    <td><a href="#">Edit</a> | <a href="#">Delete</a></td>
                </tr>
                 <tr>
                    <td>2</td>
                    <td>Jane Smith</td>
                    <td>jane.smith@example.com</td>
                    <td>Owner</td>
                    <td><a href="#">Edit</a> | <a href="#">Delete</a></td>
                </tr>
            </tbody>
        </table>

    </div>

</body>
</html>

<?php
// Include footer
include 'footer.php';
?>
