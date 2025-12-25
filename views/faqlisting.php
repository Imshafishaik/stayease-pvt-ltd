<?php include "./views/header.php";

$faqs = $faqs ?? [];

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
    <section class="faq-qna">

  <h1>Community Questions & Answers</h1>

  <div class="faq-accordion">
  <?php foreach ($faqs as $faq): ?>
    <div class="faq-item">
      <div class="faq-question"><?= htmlspecialchars($faq['question']) ?></div>
      <div class="faq-answer">
        <?php if ($faq['answer']): ?>
          <p><?= htmlspecialchars($faq['answer']) ?></p>
          <small>Answered</small>
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
    </div>
  <?php endforeach; ?>
</div>

<div class="ask-doubt-container">
  <h3>Ask your question & get it clarified</h3>
  <a href="/index.php?action=faqs">Ask Your Doubt</a>
</div>
</section>
<script>
document.querySelectorAll('.faq-item').forEach((item) => {
  const question = item.querySelector('.faq-question');
  question.addEventListener('click', () => {
    item.classList.toggle('active');
  });
});
</script>
</body>
</html>



<?php include "./views/footer.php"; ?>