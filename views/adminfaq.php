<?php include "./header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminfaq.css"> 
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<h2>Unanswered FAQs</h2>

<?php if (empty($faqs)): ?>
    <p>All FAQs are answered</p>
<?php endif; ?>

<?php foreach ($faqs as $faq): ?>
    <div class="faq-box">
        <p><strong>Q:</strong> <?= htmlspecialchars($faq['question']) ?></p>

        <textarea id="answer-<?= $faq['faq_id'] ?>" placeholder="Write answer..."></textarea>
        <button onclick="submitAnswer(<?= $faq['faq_id'] ?>)">Submit</button>
    </div>
<?php endforeach; ?>

<script>
function submitAnswer(faqId) {
    const answer = document.getElementById("answer-" + faqId).value;

    fetch("/index.php?action=answer_faq", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `faq_id=${faqId}&answer=${encodeURIComponent(answer)}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            location.reload();
        } else {
            alert(data.message);
        }
    });
}
</script>

<?php include "./footer.php"; ?>
