<div id="edit-post-modal" style="display:none;">
    <div>
        <h3>Edit Post</h3>
        <input type="hidden" id="edit-post-id">
        <label for="edit-post-title">Title:</label>
        <input type="text" id="edit-post-title">
        
        <label for="edit-post-content">Content:</label>
        <textarea id="edit-post-content"></textarea>
        
        <button id="save-edit">Save Changes</button>
        <button id="cancel-edit" onclick="closeEditModal()">Cancel</button>
    </div>
</div>

<script>
function closeEditModal() {
    document.getElementById("edit-post-modal").style.display = "none";
}

function editPost(postId) {
    fetch(`../../sql/fetch/post.php?id=${postId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById("edit-post-id").value = data.post.id;
                document.getElementById("edit-post-title").value = data.post.title;
                document.getElementById("edit-post-content").value = data.post.content;

                document.getElementById("edit-post-modal").style.display = "block";
            } else {
                console.error("Post not found");
            }
        })
        .catch(error => {
            console.error("Error fetching post:", error);
        });
}

document.getElementById("save-edit").addEventListener("click", function() {
    const postId = document.getElementById("edit-post-id").value;
    const postTitle = document.getElementById("edit-post-title").value;
    const postContent = document.getElementById("edit-post-content").value;

    fetch(`../../sql/update/post.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: postId, title: postTitle, content: postContent })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Post updated successfully!");
            location.reload(); 
        } else {
            alert("Error updating post.");
        }
    })
    .catch(error => {
        console.error("Error updating post:", error);
    });
});
</script>