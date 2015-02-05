<div class="container">
    <a href="<?php echo URL; ?>photo/upload">Upload</a>

    <h3>List of photos</h3>
        <tbody>
        <?php foreach ($this->photo as $photo) { ?>
            <div class="photo" style="width: 250px;">
            	<img src="<?php echo URL . "uploads/"; if (isset($photo->file)) echo htmlspecialchars($photo->file, ENT_QUOTES, 'UTF-8'); ?>">
            	<div class="links">
            		<a href="<?php echo URL . 'game/play/' . htmlspecialchars($photo->id, ENT_QUOTES, 'UTF-8'); ?>">Play</a>-  
            		<a href="<?php echo URL . 'game/highscores/' . htmlspecialchars($photo->id, ENT_QUOTES, 'UTF-8'); ?>">Highscores</a>
            	</div>
            </div>
        <?php } ?>
        </tbody>
</div>
