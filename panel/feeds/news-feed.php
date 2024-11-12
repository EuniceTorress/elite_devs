<?php
include '../../modal/feeds/edit-post.php';
?>
<div class="news-feed-container">
    <div class="posts" id="posts"></div>
    <div id="loading-indicator" style="display: none; text-align: center; padding: 20px;">
        Loading...
    </div>
</div>

<script>
let postCount = 0;
const postLimit = 2;
let isLoading = false;

function loadPosts() {
    if (isLoading) return;
    isLoading = true;

    document.getElementById("loading-indicator").style.display = "block";

    fetch(`../../sql/fetch/feeds.php?limit=${postLimit}&offset=${postCount}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.posts.length > 0) {
                const postsContainer = document.getElementById("posts");

                data.posts.forEach(post => {
                    const postElement = document.createElement("div");
                    const hasImages = post.images.length > 0;
                    postElement.classList.add("post");

                    let galleryClass = '';
                    if (post.images.length === 2) {
                        galleryClass = 'two';
                    } else if (post.images.length === 3) {
                        galleryClass = 'three';
                    } else if (post.images.length === 4) {
                        galleryClass = 'four';
                    }

                    const postImages = post.images.map(imgUrl => `<img src="${imgUrl}" alt="Post Image">`).join('');

                    postElement.innerHTML = `
                        <div class="post-header">
                            <h3 class="post-title">${post.title}</h3>
                            <?php if($actor == 1){ ?>
                            <div class="post-icons">
                                <span class="material-icons edit-p" onclick="editPost(${post.id})">edit_note</span>
                                <span class="material-icons del-p" onclick="deletePost(${post.id})">delete</span>
                            </div>
                            <?php } ?>

                        </div>
                        <p class="post-content">${post.content}</p>
                        ${hasImages ? `<div class="image-gallery ${galleryClass}">${postImages}</div>` : ""}
                        <span class="post-date" style="float: left;">${post.date}</span>
                    `;

                    postsContainer.appendChild(postElement);
                });

                postCount += postLimit; 
            }

            document.getElementById("loading-indicator").style.display = "none";
            isLoading = false;

            if (data.posts.length < postLimit) {
                window.removeEventListener("scroll", handleScroll); 
            }
        })
        .catch(error => {
            console.error("Error fetching posts:", error);
            isLoading = false;
            document.getElementById("loading-indicator").style.display = "none";
        });
}

function handleScroll() {
    const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
    if (scrollTop + clientHeight >= scrollHeight - 50 && !isLoading) {
        loadPosts();
    }
}

function editPost(postId) {
    console.log(`Edit post with ID: ${postId}`);
}

function deletePost(postId) {
    console.log(`Delete post with ID: ${postId}`);
}

loadPosts();
window.addEventListener("scroll", handleScroll);
</script>