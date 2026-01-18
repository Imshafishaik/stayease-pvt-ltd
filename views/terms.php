<?php
    $terms = $terms ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Terms & Conditions</title>
    <link rel="stylesheet" href="../css/terms.css">
</head>
<body>

<div class="terms-container">
    <?= html_entity_decode($terms) ?>
</div>

</body>
</html>
