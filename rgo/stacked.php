 <style>
    #stackchartWrapper {
      width: 60%;
      height: 85%;
      position: relative;
    }

    #stackchartWrapper h2 {
      margin-bottom: 20px;
    }

    #stackchart:hover {
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
    }

    .stackchartTitle {
      text-align: justify;
      color: #333;
      font-size: 1.5em;
      font-weight: 600;
      font-family: Arial, sans-serif;
    }

    #stackchart {
      flex-grow: 1;
      width: 100%;
      border-radius: 12px;
      background: transparent;
      border: 1px solid rgba(255, 204, 188, 0.7);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s ease-in-out;
      display: flex;
      flex-direction: column;
      padding: 25px;
      box-sizing: border-box;
    }

    .noDataMessage {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 1.2em;
      color: #999;
      text-align: center;
      font-family: Arial, sans-serif;
    }

    .filter {
      margin-bottom: 20px;
      font-family: Arial, sans-serif;
    }

    .filter select {
      padding: 5px;
      font-size: 1em;
    }

    .filter label {
      margin-right: 10px;
      font-size: 1em;
    }
  </style>

  <div id="stackchartWrapper">
    <h2 class="stackchartTitle">Inventory Overview</h2>
    <canvas id="stackchart"></canvas>
    <div id="noDataMessage" class="noDataMessage" style="display: none;">
      No data available.
    </div>
  </div>

  <script>
    function loadStocksForStackChart() {
      const month = document.getElementById('month').value;
      const year = document.getElementById('year').value;
      const ctx = document.getElementById('stackchart').getContext('2d');

      const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient1.addColorStop(0, 'rgba(255, 99, 132, 0.6)');
      gradient1.addColorStop(1, 'rgba(255, 99, 132, 0.2)');

      const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient2.addColorStop(0, 'rgba(54, 162, 235, 0.6)');
      gradient2.addColorStop(1, 'rgba(54, 162, 235, 0.2)');

      const gradient3 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient3.addColorStop(0, 'rgba(75, 192, 192, 0.6)');
      gradient3.addColorStop(1, 'rgba(75, 192, 192, 0.2)');

      fetch(`../../sql/dashboard/stacked.php?month=${month}&year=${year}`)
        .then(response => response.json())
        .then(data => {
          const categories = [...new Set(data.map(item => item.category))];
          const products = [...new Set(data.map(item => item.name))];

          const datasets = products.map((product, index) => {
            return {
              label: product,
              data: categories.map(category => {
                const productData = data.filter(item => item.category === category && item.name === product);
                return productData.length > 0 ? productData[0].total_inv : 0;
              }),
              backgroundColor: index % 3 === 0 ? gradient1 : index % 3 === 1 ? gradient2 : gradient3,
              borderColor: 'rgba(0, 0, 0, 0.1)',
              borderWidth: 1,
              hoverBackgroundColor: 'rgba(255, 99, 132, 0.8)',
            };
          });

          const chartData = {
            labels: categories,
            datasets: datasets,
          };

          const config = {
            type: 'bar',
            data: chartData,
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                tooltip: {
                  backgroundColor: '#ffffff',
                  titleColor: '#333',
                  bodyColor: '#333',
                  borderColor: '#ccc',
                  borderWidth: 1,
                  mode: 'nearest',
                  intersect: true,
                  callbacks: {
                    label: function(tooltipItem) {
                      return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                    }
                  }
                },
                legend: {
                  display: false, 
                }
              },
              scales: {
                x: {
                  stacked: true,
                  ticks: {
                    font: {
                      size: 14,
                      weight: 'bold'
                    }
                  }
                },
                y: {
                  stacked: true,
                  beginAtZero: true,
                  ticks: {
                    font: {
                      size: 14,
                      weight: 'bold'
                    },
                    stepSize: 5
                  }
                }
              },
              animation: {
                duration: 1000,
                easing: 'easeInOutBounce'
              }
            }
          };

          new Chart(ctx, config);
        })
        .catch(error => {
          document.getElementById('noDataMessage').style.display = 'block';
          console.error('Error fetching data:', error);
        });
    }

    document.getElementById('month').addEventListener('change', loadStocksForStackChart);
    document.getElementById('year').addEventListener('change', loadStocksForStackChart);

    loadStocksForStackChart();
  </script>