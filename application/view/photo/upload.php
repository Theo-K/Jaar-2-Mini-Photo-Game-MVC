<div class="container">

	<h2>Upload a picture</h2>

	<form action="<?php echo URL; ?>photo/index" method="post" enctype="multipart/form-data">
	    <p>Select image to upload: </p>
	    <input required type="file" name="fileToUpload" id="fileToUpload">
	    <input type="submit" value="Upload" name="submit">
	</form>

	<?php $this->renderFeedbackMessages(); ?>
</div>