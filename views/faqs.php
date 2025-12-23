<?php include "./views/header.php";

$faqs = $faqs ?? [];
?>

<section class="faq-qna">

  <h1>Community Questions & Answers</h1>

  <!-- POST QUESTION -->
  <?php if (isset($_SESSION['user_id'])): ?>
    <form class="question-form" method="post" action="/index.php?action=postFaq">
      <textarea name="question" placeholder="Ask a question..." required></textarea>
      <button type="submit">Post Question</button>
    </form>
  <?php else: ?>
    <p class="login-msg">Please log in to ask a question.</p>
  <?php endif; ?>

  <!-- FAQ LIST -->
  <?php foreach ($faqs as $faq): ?>
    <div class="faq-card">
      <div class="question">
        <strong><?= htmlspecialchars($faq['asker']) ?></strong>
        <p><?= htmlspecialchars($faq['question']) ?></p>
      </div>

      <?php if ($faq['answer']): ?>
        <div class="answer">
          <p><?= htmlspecialchars($faq['answer']) ?></p>
          <small>Answered</small>
        </div>
      <?php elseif (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'House Owner'): ?>
        <form method="post" action="/index.php?action=answerFaq" class="answer-form">
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
