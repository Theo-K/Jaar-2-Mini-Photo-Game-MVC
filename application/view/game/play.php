<div class="container">
<head>
  <style type="text/css">
    html, body { height: 100%; margin: 0; padding: 0;} 
    #map-canvas { height: 450px; width: 450px; margin: 0; padding: 0; }
    #map-canvas {float: right;}
    h1{text-align: center;}
  </style>
  
</head>

<div class="container">
  <div id="map-canvas"></div>

  <div class="photo_game">
    <div class="photo" style="width: 400px;">
      <img id="photo" src="<?php echo URL . "uploads/"; echo htmlspecialchars($this->game->file, ENT_QUOTES, 'UTF-8'); ?>" data-photoid="<?php echo $this->game->id;?>" />
    </div>
  </div>
  <button id="guess" class="game_button">Guess</button>
</div>