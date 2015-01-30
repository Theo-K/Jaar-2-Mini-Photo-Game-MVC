<div class="container">
    <a href="<?php echo URL; ?>photo/upload">Upload</a>

    <h3>List of photos</h3>
    <table>
        <thead style="background-color: #ddd; font-weight: bold;">
        <tr>
            <td>Id</td>
            <td>Image</td>
            <td>Latitude</td>
            <td>Longitude</td>
            <td>Author</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->photo as $photo) { ?>
            <tr>
                <td><?php if (isset($photo->id)) echo htmlspecialchars($photo->id, ENT_QUOTES, 'UTF-8'); ?></td>
                <td width="250"><img src="<?php echo "uploads/"; if (isset($photo->file)) echo htmlspecialchars($photo->file, ENT_QUOTES, 'UTF-8'); ?>"></td>
                <td><?php if (isset($photo->latitude)) echo htmlspecialchars($photo->latitude, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php if (isset($photo->longitude)) echo htmlspecialchars($photo->longitude, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php if (isset($photo->author)) echo htmlspecialchars($photo->author, ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
