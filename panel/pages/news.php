<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="news-feed">
                <div class="news-card">
                    <div class="card-header">
                        <h4>Example News Title</h4>
                    </div>
                    <div class="card-body">
                        <img src="example-image.jpg" alt="News Image" class="news-image">
                        <p>This is a short preview of the news content...</p>
                    </div>
                    <div class="card-footer">
                        <button class="view-more-btn">View More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .container-fluid {
        padding: 20px;
    }

    .news-feed {
        margin-top: 40px;
    }

    .news-card {
        background-color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px; 
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-left: 5px solid maroon; 
    }

    .news-card:hover {
        transform: translateY(-5px); 
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); 
    }

    .card-header h4 {
        margin: 0;
        font-size: 1rem; 
        color: maroon;
        font-weight: bold;
    }

    .card-body p {
        margin: 10px 0;
        font-size: 0.8rem;
        color: black; 
        line-height: 1.5; 
    }

    .news-image {
        width: 100%;
        height: auto;
        border-radius: 10px; 
        margin-top: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); 
        max-height: 250px; 
        object-fit: cover;
    }

    .card-footer {
        text-align: right;
    }

    .view-more-btn {
        background-color: maroon; 
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.8rem; 
        transition: background-color 0.3s ease, box-shadow 0.3s ease; 
    }

    .view-more-btn:hover {
        background-color: #b30000;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); 
    }

    .container-fluid {
        padding: 40px;
        background-color: #f0f0f0; 
    }

    @media (max-width: 768px) {
        .news-card {
            padding: 15px;
        }
        
        .card-header h4 {
            font-size: 0.9rem;
        }

        .view-more-btn {
            padding: 8px 16px;
        }

        .news-image {
            max-height: 200px;
        }
    }
</style>
