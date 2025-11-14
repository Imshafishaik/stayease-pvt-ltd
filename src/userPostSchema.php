<?php 
require __DIR__ . '/../config/database.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;

    if($id && $name){
        $stmt = $pdo -> prepare("INSERT INTO users(user_id,user_name) values(:id,:name)");
        $stmt->bindParam(':id',$id, PDO::PARAM_INT);
        $stmt->bindParam(':name',$name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>✅ User added successfully!</p>";
        } else {
            echo "<p style='color:red;'>❌ Failed to add user.</p>";
        }
    }else {
        echo "<p style='color:red;'>⚠️ Please fill in both ID and Name.</p>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST USER</title>
</head>
<body>  
    <form action="../public/index.php" method="POST">
        <input type="number" name="id" placeholder="Enter id" />
        <input type="text" name="name" placeholder="Enter name" />
        <button type="submit">Submit</button>
    </form>
</body>
</html>