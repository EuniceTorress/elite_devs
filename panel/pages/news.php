<div class="news-content">
    <div class="news-box">
        <div class="box-header">
            <h3>News Title</h3>
            <input type="text" id="news-title" class="news-title-input" placeholder="Enter title...">
        </div>
        <div class="box-body">
            <h4>News Content</h4>
            <textarea id="news-content" class="news-content-textarea" rows="5" placeholder="Enter content..."></textarea>
            <button class="add-media-btn">
                <i class="bi bi-plus-circle"></i> Add Media
            </button>
        </div>
        <div class="box-footer">
            <button class="publish-btn">Publish</button>
        </div>
    </div>
</div>


<style>
    .news-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh; /* Adjust height as needed */
    padding: 20px;
  }


.news-box {
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow */
    padding: 50px; /* Increase padding to make the box bigger */
    margin-bottom: 20px;
    width: 80%; /* Adjust width as needed */
    max-width: 800px; /* Optional: Set a maximum width to limit growth */
    height: auto; /* Allow height to adjust based on content */
}

.box-header h3 {
    margin-bottom: 15px;
    font-family: 'Times New Roman';
}

.news-title-input {
    width: calc(100% - 32px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 18px; /* Increase font size */
    font-family: 'Calibri';


}

.box-body {
    margin-bottom: 50px;
}

.box-body h4 {
    margin-bottom: 15px;
    font-family: 'Times New Roman';
    font-weight: bold;
}

.news-content-textarea {
    width: calc(100% - 32px); /* Adjusted width to accommodate button */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: vertical;
    font-size: 18px;
    font-family: 'Calibri';
    
}

.add-media-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
}

.add-media-btn i {
    margin-right: 5px;
}

.publish-btn {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    float: right;
}

.publish-btn:hover,
.add-media-btn:hover {
    opacity: 0.8;
}

</style>