<div class="container">
    <a href="<?php echo URL; ?>photo/upload">Upload</a>

    <h3>List of photos</h3>
    <table>
        <thead style="background-color: #ddd; font-weight: bold;">
        <tr>
            <td>Image</td>
            <td>Author</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->photo as $photo) { ?>
            <tr>
                <td width="250"><img src="<?php echo URL . "uploads/"; if (isset($photo->file)) echo htmlspecialchars($photo->file, ENT_QUOTES, 'UTF-8'); ?>"></td>
                <td><?php if (isset($photo->author)) echo htmlspecialchars($photo->author, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><a href="<?php echo URL . 'game/play/' . htmlspecialchars($photo->id, ENT_QUOTES, 'UTF-8'); ?>">Play</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
