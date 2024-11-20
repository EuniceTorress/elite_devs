<style>
.end-userdashboard {
    display: flex;
    flex-direction: row;
    margin-bottom: 2rem;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
}

.end-userdashboard .reservation-section1,
.end-userdashboard .reservation-section2 {
    width: 48%;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.end-userdashboard .reservation-section1,
.end-userdashboard .reservation-section2 {
    background-color: #fff;
}

.end-userdashboard h1 {
    font-size: 22px;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

.end-userdashboard .status-cards {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}

.end-userdashboard .card {
    background-color: #fff;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    width: 30%;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.end-userdashboard .card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
}

.end-userdashboard .card p {
    font-size: 14px;
    margin-top: 10px;
    color: #555;
}

.end-userdashboard .card .count {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
}

/* Status Cards - Styles Based on Card Type */
.end-userdashboard .card.pending {
    background-color: #fff3e0;
    border-left: 6px solid #ffb74d;
    color: #f57c00;
}

.end-userdashboard .card.approved {
    background-color: #e8f5e9;
    border-left: 6px solid #66bb6a;
    color: #388e3c;
}

.end-userdashboard .card.declined {
    background-color: #ffebee;
    border-left: 6px solid #f44336;
    color: #d32f2f;
}

.material-icons {
    font-size: 40px;
    margin-bottom: 10px;
    color: inherit;
}
</style>

<div class="end-userdashboard">
    <div class="reservation-section1">
        <h1>Stock Reservations</h1>
        <div class="status-cards">
            <div class="card pending">
                <span class="material-icons">hourglass_empty</span>
                <p>Pending</p>
                <span class="count">5</span>
            </div>
            <div class="card approved">
                <span class="material-icons">check_circle</span>
                <p>Approved</p>
                <span class="count">12</span>
            </div>
            <div class="card declined">
                <span class="material-icons">cancel</span>
                <p>Declined</p>
                <span class="count">2</span>
            </div>
        </div>
    </div>

    <div class="reservation-section2">
        <h1>Facility Rentals</h1>
        <div class="status-cards">
            <div class="card pending">
                <span class="material-icons">hourglass_empty</span>
                <p>Pending</p>
                <span class="count">3</span>
            </div>
            <div class="card approved">
                <span class="material-icons">check_circle</span>
                <p>Approved</p>
                <span class="count">8</span>
            </div>
            <div class="card declined">
                <span class="material-icons">cancel</span>
                <p>Declined</p>
                <span class="count">1</span>
            </div>
        </div>
    </div>
</div>
