<div class="container">
	
	<img style="width: 300px" src="<?php echo URL . "uploads/"; if (isset($this->scorePhoto->file)) echo htmlspecialchars($this->scorePhoto->file, ENT_QUOTES, 'UTF-8'); ?>">

	<div class="yourScore">
		<h1>Your score was: </h1>
		<p><?php echo htmlspecialchars($this->userScore->score, ENT_QUOTES, 'UTF-8'); ?></p>
	</div>

	<h1>High Scores</h1>
	<table>
		<tr>
	        <th>Username</th>
		    <th>Score</th>
		</tr>
		<?php foreach ($this->game as $game) { ?>
			<tr>
	            <td><?php if (isset($game->user_name)) echo htmlspecialchars($game->user_name, ENT_QUOTES, 'UTF-8'); ?></td>
	            <td><?php if (isset($game->score)) echo htmlspecialchars($game->score, ENT_QUOTES, 'UTF-8'); ?></td>
	        </tr>
	    <?php } ?>
	</table>
</div>