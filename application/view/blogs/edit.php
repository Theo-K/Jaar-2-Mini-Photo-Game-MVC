<div class="container">
    <h2>You are in the View: application/view/blogs/edit.php (everything in this box comes from that file)</h2>
    <!-- add blog form -->
    <div>
        <h3>Edit a blog entry</h3>
        <form action="<?php echo URL; ?>blogs/updateEntry" method="POST">
            <label>Title</label>
            <input autofocus type="text" name="title" value="<?php echo htmlspecialchars($this->blogs->title, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>Content</label>
            <input type="text" name="content" value="<?php echo htmlspecialchars($this->blogs->content, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="hidden" name="blog_id" value="<?php echo htmlspecialchars($this->blogs->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="submit" name="submit_update_blog" value="Update" />
        </form>
    </div>
</div>

