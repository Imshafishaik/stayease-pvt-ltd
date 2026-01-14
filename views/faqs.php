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
    
</body>
</html>

<section class="faq-qna">

  <h1>Community Questions & Answers</h1>

  <!-- POST QUESTION -->
  <?php if (isset($_SESSION['user_id'])): ?>
    <form class="question-form" method="post" action="/index.php?action=postfaq">
      <textarea name="question" placeholder="Ask a question..." required></textarea>
      <button type="submit">Post Question</button>
    </form>
  <?php else: ?>
    <p class="login-msg">Please log in to ask a question.</p>
  <?php endif; ?>

</section>

<?php include "./views/footer.php"; ?>