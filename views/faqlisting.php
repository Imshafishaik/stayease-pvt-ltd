<?php include "./views/header.php";

$faqs = $faqs ?? [];
print_r($faqs);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/faq.css"/>
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<section class="faq-qna">

  <h1>Community Questions & Answers</h1>

  <!-- FAQ LIST -->
  <?php foreach ($faqs as $faq): ?>
    <div class="faq-card">
      <!-- <div class="question">
        <strong><?= htmlspecialchars($faq['asker']) ?></strong>
        <p><?= htmlspecialchars($faq['question']) ?></p>
      </div> -->

      <?php if ($faq['answer']): ?>
        <div class="answer">
          <p><?= htmlspecialchars($faq['answer']) ?></p>
          <small>Answered</small>
        </div>
      <?php elseif (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'owner'): ?>
        <form method="post" action="/index.php?action=postanswer" class="answer-form">
          <input type="hidden" name="faq_id" value="<?= $faq['faq_id'] ?>">
          <textarea name="answer" placeholder="Write an answer..." required></textarea>
          <button type="submit">Answer</button>
        </form>
      <?php else: ?>
        <p class="pending">Waiting for answer</p>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>

</section>

<?php include "./views/footer.php"; ?>