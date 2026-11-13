<?php
require_once __DIR__ . '/components/news.php';

try {
  $news = fetchNews(apisfulApiKey());
  $newsError = false;
} catch (RuntimeException $exception) {
  error_log('News: ' . $exception->getMessage());
  $news = [];
  $newsError = true;
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Updates - Liveries for Running Train</title>
  <meta name="description" content="I am not affiliated with the game developer." />
  <meta robots="index, follow" />
  <meta name="keywords" content="Running Train, train liveries, custom textures, game mods, train skins" />
  <meta property="og:title" content="Updates - Liveries for Running Train" />
  <meta property="og:description" content="See the latest updates for this website." />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
</head>

<body>
  <div class="container">
    <?php include('components/header.php'); ?>

    <div class="section instructions-section">
      <h1 class="h2">Updates</h1>

      <p>This page provides the latest updates and announcements for this website.
      </p>

      <p><br /></p>

      <?php if ($newsError): ?>
        <p>News is temporarily unavailable. Please try again later.</p>
      <?php elseif (!$news): ?>
        <p>There are no updates yet.</p>
      <?php else: ?>
        <ol class="updates-list">
          <?php foreach ($news as $item): ?>
            <li>
              <h2 class="h3 update-title"><?= htmlspecialchars($item['title'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></h2>
              <p class="date"><em><?= htmlspecialchars($item['date'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></em></p>
              <?= $item['description'] ?>
            </li>
          <?php endforeach; ?>
        </ol>
      <?php endif; ?>
    </div>

    <?php include('components/footer.php'); ?>
  </div>

  <script src="js/server.js"></script>
</body>

</html>