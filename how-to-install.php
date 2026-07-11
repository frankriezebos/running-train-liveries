<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>How to install - Liveries for Running Train</title>
  <meta name="description" content="Learn how you to install livery textures for Running Train" />
  <meta robots="index, follow" />
  <meta name="keywords" content="Running Train, train liveries, custom textures, game mods, train skins" />
  <meta property="og:title" content="How to install - Liveries for Running Train" />
  <meta property="og:description" content="Learn how you to install livery textures for Running Train" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <div class="container">
    <?php include('components/header.php'); ?>

    <div class="section instructions-section">
      <h1 class="h2">How to install?</h1>

      <div id="app" class="vue-tabs">
        <ul class="tabs">
          <li v-for="(tab, index) in tabs" :key="index" class="tab">
            <button @click="activeTab = index" :class="activeTab === index ? 'active' : ''">{{tab}}</button>
          </li>
        </ul>

        <ul class="form-row">
          <template v-for="(tab, index) in tabs" :key="index">
            <li v-if="activeTab === index" class="tab">
              <h2 class="h3">{{tab}}</h2>

              <ol v-if="index === 0">
                <li>Download the texture and place it in the
                  appropriate folder for your train model within C:\Program Files
                  (x86)\Steam\steamapps\common\RUNNING
                  TRAIN\RunningTrain\Content\UGC\Textures\[train model] </li>

                <li>Recommended: you can make a
                  backup of the original empty blueprint file first.</li>

                <li>Rename the
                  downloaded file to tex3.jpg or tex4.jpg and replace. For DC85 there is an extra empty slot (tex2.jpg)
                </li>
              </ol>

              <ol v-else-if="index === 1">
                <li>Download the thumbnail to C:\Program Files (x86)\Steam\steamapps\common\RUNNING
                  TRAIN\RunningTrain\Content\UGC\Textures\[train model]\thumb</li>

                <li>Recommended: backup existing thumb file</li>

                <li>Rename downloaded file to thumb3.jpg / thumb4.jpg. For DC85 you can also use thumb2.jpg</li>
              </ol>

              <ol v-else-if="index === 2">
                <li>Download the dir file to C:\Program Files (x86)\Steam\steamapps\common\RUNNING
                  TRAIN\RunningTrain\Content\UGC\Textures\[train model]</li>

                <li>Recommended: backup existing dir file</li>

                <li>Rename downloaded file to dir.png.</li>
              </ol>

              <p v-if="index === 0">
                By the way, 1500 reskins also work on 1100 and vice-versa.
              </p>
            </li>
          </template>
        </ul>
      </div>
    </div>

    <?php include('components/footer.php'); ?>
  </div>

  <script src="js/server.js"></script>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

  <script>
  const {
    createApp,
    ref
  } = Vue

  createApp({
    setup() {
      const tabs = ref(['Texture', 'Thumbnail', 'Dir']);
      const activeTab = ref(0);
      return {
        tabs,
        activeTab
      }
    }
  }).mount('#app')
  </script>

</body>

</html>