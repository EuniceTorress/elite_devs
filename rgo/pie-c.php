<style>

    .pie-chart-container {
      width: 39%;
      height: 450px;
      padding: 20px;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .pie-chart-container h2 {
      font-size: 28px;
      color: #333;
      margin-bottom: 15px;
      font-weight: 500;
      text-transform: uppercase;
    }

    .pie-chart-container canvas {
      width: 100% !important;
      height: 100% !important;
    }

    .pie-chart-container .legend {
      display: flex;
      justify-content: space-around;
      margin-top: 10px;
      font-size: 14px;
      color: #555;
    }

    .legend span {
      padding: 5px 10px;
      border-radius: 50px;
      font-weight: 500;
      color: #fff;
      text-transform: capitalize;
      background-color: rgba(0, 0, 0, 0.2);
    }

    .pie-chart-container .data-labels {
      font-size: 16px;
      color: #333;
      font-weight: 600;
    }

    #pieChartCanvas {
      width: 100%;
      height: auto;
    }
  </style>
    <canvas id="pieChartCanvas"></canvas>
    </div>
  <script>
    const dummyData = {
      values: [50, 30, 20],
    };

    function create3DPieChart(data) {
      const ctx = document.getElementById('pieChartCanvas').getContext('2d');

      const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient1.addColorStop(0, 'rgba(78, 115, 223, 1)');
      gradient1.addColorStop(1, 'rgba(78, 115, 223, 0.2)');

      const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient2.addColorStop(0, 'rgba(28, 200, 138, 1)');
      gradient2.addColorStop(1, 'rgba(28, 200, 138, 0.2)');

      const gradient3 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient3.addColorStop(0, 'rgba(231, 74, 59, 1)');
      gradient3.addColorStop(1, 'rgba(231, 74, 59, 0.2)');

      const chartData = {
        labels: ['Beginning Inventory', 'Sales', 'Delivery'], // Labels for each section
        datasets: [{
          data: data.values,
          backgroundColor: [gradient1, gradient2, gradient3], // Gradient colors for each section
          borderColor: '#fff',
          borderWidth: 4,
          hoverOffset: 15,
          shadowOffsetX: 4,
          shadowOffsetY: 4,
          shadowBlur: 10,
          shadowColor: 'rgba(0, 0, 0, 0.4)',
        }]
      };

      const config = {
        type: 'pie',
        data: chartData,
        options: {
          responsive: true,
          plugins: {
            tooltip: {
              backgroundColor: 'rgba(0, 0, 0, 0.8)',
              titleColor: '#fff',
              bodyColor: '#fff',
              callbacks: {
                label: function(tooltipItem) {
                  return tooltipItem.label + ': ' + tooltipItem.raw + ' items';
                }
              }
            },
            legend: {
              display: false,
            },
            datalabels: {
              display: true,
              color: '#fff',
              font: {
                size: 16,
                weight: 'bold'
              },
              formatter: (value, context) => {
                const total = context.dataset.data.reduce((sum, val) => sum + val, 0);
                const percentage = ((value / total) * 100).toFixed(2);
                return percentage + '%';
              }
            }
          },
          animation: {
            animateRotate: true,
            animateScale: true,
          },
          rotation: -0.1,
        },
      };

      const pieChartCanvas = new Chart(ctx, config);
    }

    // Create the pie chart using the dummy data
    create3DPieChart(dummyData);
  </script>
</body>
</html>
