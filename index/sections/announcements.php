<div id="Announcement" class="p-5">
    <div class="container-fluid px-5 pt-5">
        <div class="row">
            <div class="col-lg-7">
                <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="true" data-bs-interval="2000">
                    <div class="carousel-indicators"></div>
                    <div class="carousel-inner"></div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-lg-5">
                <h4 id="announcementTitle" class="text-center fw-bold">"Announcements"</h4>
                <p id="announcementContent">Stay tuned for the latest additions to our products and rental offerings!
                    We’re constantly updating our inventory to provide you with the best options for your needs.
                    Check back often to discover new items available for rent and more.
                </p>
                <center id="announcementImage">
                    <img src="src/img/announcer.png" alt="">
                </center>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", async function() {
    console.log("DOM fully loaded and parsed.");

    try {
        const response = await fetch("sql/index/announcements.php");
        console.log("Fetch initiated.");

        const data = await response.json();
        console.log("Data fetched:", data);

        const carouselInner = document.querySelector("#carouselExampleCaptions .carousel-inner");
        const carouselIndicators = document.querySelector(".carousel-indicators");
        const announcementTitle = document.getElementById("announcementTitle");
        const announcementContent = document.getElementById("announcementContent");
        const announcementImage = document.getElementById("announcementImage");

        carouselInner.innerHTML = '';
        carouselIndicators.innerHTML = '';

        if (data.success && data.posts.length > 0) {
            console.log("Populating carousel with fetched posts.");

            data.posts.forEach((post, index) => {
                const carouselItem = document.createElement("div");
                carouselItem.className = `carousel-item${index === 0 ? " active" : ""}`;
                
                carouselItem.innerHTML = `
                    <img src="${post.image || 'src/img/default-image.jpg'}" class="d-block w-100" alt="Slide ${index + 1}">
                `;
                carouselInner.appendChild(carouselItem);

                const indicator = document.createElement("button");
                indicator.type = "button";
                indicator.setAttribute("data-bs-target", "#carouselExampleCaptions");
                indicator.setAttribute("data-bs-slide-to", index.toString());
                indicator.className = index === 0 ? "active" : "";
                indicator.setAttribute("aria-label", `Slide ${index + 1}`);
                carouselIndicators.appendChild(indicator);
            });

            if (data.posts.length > 0) {
                announcementTitle.textContent = data.posts[0].title || "";
                announcementContent.textContent = data.posts[0].content || "";

                if (announcementContent.textContent.length > 338) {
                    announcementImage.style.display = "none";
                }
            }

            const carousel = new bootstrap.Carousel(document.querySelector('#carouselExampleCaptions'), {
                interval: 2000
            });

            document.querySelector('#carouselExampleCaptions').addEventListener('slide.bs.carousel', (event) => {
                const currentIndex = event.to;
                announcementTitle.textContent = data.posts[currentIndex].title || "";
                announcementContent.textContent = data.posts[currentIndex].content || "";

                if (announcementContent.textContent.length > 338) {
                    announcementImage.style.display = "none";
                } else {
                    announcementImage.style.display = "block";
                }
            });
        } else {
            console.log("No posts found; populating carousel with default slides.");

            for (let i = 0; i < 3; i++) {
                const carouselItem = document.createElement("div");
                carouselItem.className = `carousel-item${i === 0 ? " active" : ""}`;
                
                carouselItem.innerHTML = `
                    <img src="src/img/default-image.jpg" class="d-block w-100" alt="Default Slide ${i + 1}">
                `;
                carouselInner.appendChild(carouselItem);

                const indicator = document.createElement("button");
                indicator.type = "button";
                indicator.setAttribute("data-bs-target", "#carouselExampleCaptions");
                indicator.setAttribute("data-bs-slide-to", i.toString());
                indicator.className = i === 0 ? "active" : "";
                indicator.setAttribute("aria-label", `Slide ${i + 1}`);
                carouselIndicators.appendChild(indicator);
            }
        }
    } catch (error) {
        console.error("Error fetching announcements:", error);
    }
});
</script>
