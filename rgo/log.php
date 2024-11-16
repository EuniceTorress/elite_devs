   <style>

        .activity-log-container{
            width: 100%;
            border-radius: 12px;
        }

        .d-header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        #logs-c {
            padding: 20px;
            height: 400px;
            width: 38%;
            border-radius: 12px;
            border: 1px solid rgba(255, 204, 188, 0.7);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            background: transparent;
        }

        #logs-c h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .filter-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        #filterIcon {
            font-size: 30px;
            cursor: pointer;
        }

        .log-selector {
            display: none; 
            position: absolute;
            top: 60px;
            right: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 200px;
            z-index: 100;
        }

        .log-selector button {
            padding: 10px;
            border: none;
            background-color: #fff;
            color: #555;
            text-align: left;
            cursor: pointer;
            width: 100%;
            border-bottom: 1px solid #ddd;
        }

        .log-selector button:hover {
            background-color: #f1f1f1;
        }

        .log-selector button:last-child {
            border-bottom: none;
        }

        .activity-list {
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
            margin-bottom: 20px;
            padding-right: 10px;
        }

        #logs-c ul {
            list-style: none;
            padding: 0;
        }

        #logs-c li {
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #logs-c li.insert {
            background-color: #e0f7e0;
            border-left: 5px solid #4CAF50;
        }

        #logs-c li.update {
            background-color: #fff8e1;
            border-left: 5px solid #FFC107;
        }

        #logs-c li.delete {
            background-color: #ffebee;
            border-left: 5px solid #F44336;
        }

        #logs-c li:hover {
            transform: translateX(10px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="dashboard" id="logs-c">
        <div class="activity-log-container">
            <div class="d-header">
                <h2>Activity Log</h2>

                <div class="filter-container">
                    <span class="material-icons" id="filterIcon" onclick="toggleDropdown()">filter_list</span>
                    
                    <div class="log-selector" id="logSelector">
                        <button onclick="filterLog('all')">All Activities</button>
                        <button onclick="filterLog('insert')">Inserts</button>
                        <button onclick="filterLog('update')">Updates</button>
                        <button onclick="filterLog('delete')">Deletes</button>
                    </div>
                </div>
            </div>

            <div class="activity-list">
                <ul id="activity-log">
                </ul>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', () => {
    fetchActivityLogs();

    function fetchActivityLogs() {
        fetch('../../sql/dashboard/logs.php')
            .then(response => response.json())
            .then(data => {
                activityLogs = data.map(log => {
                    const logDate = new Date(log.date);
                    const formattedDate = logDate.toLocaleDateString('en-US', {
                        year: 'numeric', month: '2-digit', day: '2-digit'
                    });

                    let actionText = '';
                    let actionClass = '';

                    if (log.action === 'insert') {
                        actionText = `${log.description} on ${formattedDate}.`;
                        actionClass = 'insert';
                    } else if (log.action === 'update') {
                        actionText = `Stock Updated on ${formattedDate}.`;
                        actionClass = 'update';
                    } else if (log.action === 'delete') {
                        actionText = `Stock Deleted on ${formattedDate}.`;
                        actionClass = 'delete';
                    }

                    return { text: actionText, class: actionClass, date: formattedDate };
                });

                renderActivityLog();
            })
            .catch(error => console.error('Error fetching activity logs:', error));
    }

    function renderActivityLog() {
        const activityLogElement = document.getElementById('activity-log');
        activityLogElement.innerHTML = '';

        activityLogs.forEach(log => {
            const li = document.createElement('li');
            li.classList.add(log.class);
            li.textContent = log.text;
            activityLogElement.appendChild(li);
        });
    }
});

    </script>
