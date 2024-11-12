<div class="container-fluid" id="cFeedContainer">
    <h1>Create a New Post</h1>
    <form id="createPostForm">
        <div class="form-group">
            <label for="postTitle">Title</label>
            <input type="text" id="postTitle" name="title" placeholder="Enter the title of your post (Optional)">
        </div>

        <div class="form-group">
            <label for="postContent">Content</label>
            <textarea id="postContent" name="content" rows="5" placeholder="Write your content here (Optional)"></textarea>
        </div>

        <div class="form-group">
            <div class="upload-img">
                <button type="button" id="uploadBtn" class="upload-btn">
                    <span class="material-icons">file_upload</span>
                </button>
                <button type="button" id="addMoreBtn" class="add-more-btn" style="display: none;">
                    <span class="material-icons">add</span>
                </button>
                <button type="button" id="clearAllBtn" class="clear-all-btn" style="display: none;">
                    <span class="material-icons">delete</span> 
                </button>
            </div>
            <input type="file" id="postImages" name="images" accept="image/*" multiple style="display: none;">
            
            <div id="imagePreview" class="image-preview"></div>
        </div>

        <button type="submit" class="submit-btn">Create</button>
    </form>
</div>

<div id="imageModal" class="modal">
    <span class="close">&times;</span>
    <span class="arrow prev" id="prevImage" style="display: none;">&#10094;</span>
    <img class="modal-content" id="modalImage">
    <span class="arrow next" id="nextImage" style="display: none;">&#10095;</span>
    <div id="pageIndicator" class="page-indicator"></div> 
</div>

<script>
    let currentImageIndex = 0;
    let imagesArray = [];

    document.getElementById('uploadBtn').addEventListener('click', function() {
        document.getElementById('postImages').click(); 
    });

    document.getElementById('addMoreBtn').addEventListener('click', function() {
        document.getElementById('postImages').click(); 
    });

    document.getElementById('postImages').addEventListener('change', function(event) {
        const imagePreview = document.getElementById('imagePreview');
        
        const files = Array.from(event.target.files);
        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.createElement('div');
                previewContainer.classList.add('preview-container');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('preview-image');
                img.onclick = function() {
                    openModal(e.target.result);
                };

                const removeBtn = document.createElement('span');
                removeBtn.classList.add('remove-icon', 'material-icons');
                removeBtn.innerText = 'remove';
                removeBtn.onclick = function() {
                    const index = imagesArray.indexOf(e.target.result);
                    if (index > -1) imagesArray.splice(index, 1);
                    previewContainer.remove();
                    updateArrows();
                };

                previewContainer.appendChild(img);
                previewContainer.appendChild(removeBtn);
                imagePreview.appendChild(previewContainer);

                imagesArray.push(e.target.result);
                updateArrows();
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('uploadBtn').style.display = 'none';
        document.getElementById('addMoreBtn').style.display = 'inline-block';
        document.getElementById('clearAllBtn').style.display = 'inline-block';
    });

    document.getElementById('clearAllBtn').addEventListener('click', function() {
        document.getElementById('imagePreview').innerHTML = '';
        imagesArray = [];
        document.getElementById('uploadBtn').style.display = 'inline-block';
        document.getElementById('addMoreBtn').style.display = 'none';
        document.getElementById('clearAllBtn').style.display = 'none';
        updateArrows();
    });

    function openModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        currentImageIndex = imagesArray.indexOf(imageSrc);
        modalImage.src = imageSrc;
        modal.classList.add('show-modal');
        updateArrows();
        updatePageIndicator(); 
    }

    function updatePageIndicator() {
        const pageIndicator = document.getElementById('pageIndicator');
        pageIndicator.textContent = `${currentImageIndex + 1} / ${imagesArray.length}`;
    }

    document.getElementById('prevImage').onclick = function() {
        currentImageIndex = (currentImageIndex - 1 + imagesArray.length) % imagesArray.length;
        document.getElementById('modalImage').src = imagesArray[currentImageIndex];
        updatePageIndicator(); 
    };

    document.getElementById('nextImage').onclick = function() {
        currentImageIndex = (currentImageIndex + 1) % imagesArray.length;
        document.getElementById('modalImage').src = imagesArray[currentImageIndex];
        updatePageIndicator(); 
    };

    function updateArrows() {
        document.getElementById('prevImage').style.display = imagesArray.length > 1 ? 'block' : 'none';
        document.getElementById('nextImage').style.display = imagesArray.length > 1 ? 'block' : 'none';
    }

    document.querySelector('.close').onclick = function() {
        document.getElementById('imageModal').classList.remove('show-modal');
    };

    window.onclick = function(event) {
        const modal = document.getElementById('imageModal');
        if (event.target == modal) {
            modal.classList.remove('show-modal');
        }
    };

    document.getElementById('createPostForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const title = document.getElementById('postTitle').value.trim();
        const content = document.getElementById('postContent').value.trim();

        if (!title && !content) {
            alert('Please enter either a title or content.');
            return;
        }

        const formData = new FormData(this);
        const files = document.getElementById('postImages').files;

        for (let i = 0; i < files.length; i++) {
            formData.append('images[]', files[i]);
        }

        try {
            const response = await fetch('../../sql/insert/add-feed.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                alert('Post created successfully!');
                document.getElementById('createPostForm').reset();
                document.getElementById('imagePreview').innerHTML = '';
                imagesArray = [];
                document.getElementById('uploadBtn').style.display = 'inline-block';
                document.getElementById('addMoreBtn').style.display = 'none';
                document.getElementById('clearAllBtn').style.display = 'none';
                updateArrows();
            } else {
                alert('Failed to create post: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while creating the post.');
        }
    });
</script>
