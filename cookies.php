<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cookies - Liveries for Running Train</title>
  <meta name="description" content="Cookies" />
  <meta robots="index, follow" />
  <meta name="keywords" content="Running Train, train liveries, custom textures, game mods, train skins" />
  <meta property="og:title" content="Cookies - Liveries for Running Train" />
  <meta property="og:description" content="Cookies" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
</head>

<body>
  <div class="container">
    <?php include('components/header.php'); ?>

    <div class="section instructions-section">
      <h1 class="h2">
        <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg"
          class="heading-icon">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M3.431 1.787C5.312 0.44 7.539 0 9.037 0H10.042C10.3072 0 10.5616 0.105357 10.7491 0.292893C10.9366 0.48043 11.042 0.734784 11.042 1V4H13.056C13.3212 4 13.5756 4.10536 13.7631 4.29289C13.9506 4.48043 14.056 4.73478 14.056 5V7H17.075C17.3402 7 17.5946 7.10536 17.7821 7.29289C17.9696 7.48043 18.075 7.73478 18.075 8V9C18.075 12.503 16.68 14.808 14.778 16.206C12.928 17.566 10.691 18 9.038 18C7.385 18 5.148 17.566 3.296 16.206C1.395 14.808 0 12.503 0 9C0 5.472 1.5 3.172 3.431 1.787ZM6.023 4C5.75778 4 5.50343 4.10536 5.31589 4.29289C5.12836 4.48043 5.023 4.73478 5.023 5C5.023 5.26522 5.12836 5.51957 5.31589 5.70711C5.50343 5.89464 5.75778 6 6.023 6C6.28822 6 6.54357 5.89464 6.73111 5.70711C6.91864 5.51957 7.024 5.26522 7.024 5C7.024 4.73478 6.91864 4.48043 6.73111 4.29289C6.54357 4.10536 6.28822 4 6.023 4ZM3.013 9C3.013 8.73478 3.11836 8.48043 3.30589 8.29289C3.49343 8.10536 3.74778 8 4.013 8H4.015C4.28022 8 4.53457 8.10536 4.72211 8.29289C4.90964 8.48043 5.015 8.73478 5.015 9C5.015 9.26522 4.90964 9.51957 4.72211 9.70711C4.53457 9.89464 4.28022 10 4.015 10H4.014C3.74878 10 3.49443 9.89464 3.30689 9.70711C3.11936 9.51957 3.013 9.26522 3.013 9ZM9.037 9C8.77178 9 8.51743 9.10536 8.32989 9.29289C8.14236 9.48043 8.037 9.73478 8.037 10C8.037 10.2652 8.14236 10.5196 8.32989 10.7071C8.51743 10.8946 8.77178 11 9.037 11C9.30222 11 9.55757 10.8946 9.74511 10.7071C9.93264 10.5196 10.038 10.2652 10.038 10C10.038 9.73478 9.93264 9.48043 9.74511 9.29289C9.55757 9.10536 9.30222 9 9.037 9ZM6.027 13C6.027 12.7348 6.13236 12.4804 6.31989 12.2929C6.50743 12.1054 6.76178 12 7.027 12H7.029C7.29422 12 7.54857 12.1054 7.73611 12.2929C7.92364 12.4804 8.029 12.7348 8.029 13C8.029 13.2652 7.92364 13.5196 7.73611 13.7071C7.54857 13.8946 7.29422 14 7.029 14H7.028C6.76278 14 6.50843 13.8946 6.32089 13.7071C6.13336 13.5196 6.027 13.2652 6.027 13ZM13.056 11C12.7908 11 12.5364 11.1054 12.3489 11.2929C12.1614 11.4804 12.056 11.7348 12.056 12C12.056 12.2652 12.1614 12.5196 12.3489 12.7071C12.5364 12.8946 12.7908 13 13.056 13C13.3212 13 13.5756 12.8946 13.7631 12.7071C13.9506 12.5196 14.056 12.2652 14.056 12C14.056 11.7348 13.9506 11.4804 13.7631 11.2929C13.5756 11.1054 13.3212 11 13.056 11Z"
            fill="white" />
        </svg>

        Cookies
      </h1>

      <p>This website uses cookies to enable you to like a livery and save that cookie into your browser to prevent
        multiple likes from the same user.</p>

      <p><br />Current cookie status: <span id="cookie-status"></span></p>

      <div class="cookie-buttons">
        <button class="button" id="agreeCookies">Accept Cookies</button>
        <button class="button" id="cookieDisagreeBtn">Decline Cookies</button>
      </div>
    </div>

    <?php include('components/footer.php'); ?>
  </div>

  <script src="js/server.js"></script>
  <script src="js/cookie-consent.js"></script>
</body>

</html>