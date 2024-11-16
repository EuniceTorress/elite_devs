    <script src="https://cdn.jsdelivr.net/npm/plotly.js-dist@2.10.0/plotly.min.js"></script>
    <style>
        #bubbleChart {
            min-width: 1000px;
            height: 100%;
            border-radius: 12px;
            display: flex;
            background-color: transparent;
        }

        .title {
            font-size: 18px;
            color: #777;
            text-align: center;
            margin-top: 0;
        }

        .inv-c {
            display: flex;
            flex-direction: column;
        }

        .b-c {
            height: 100%;
            padding: 0 20px;
            width: 100% !important;
            border-radius: 12px;
            border: 1px solid rgba(255, 204, 188, 0.7);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            background: transparent;
            transition: box-shadow 0.3s ease-in-out;
            justify-content: center;
            align-content: center;
            display: flex;
            position: relative;
        }

        .b-c:hover {
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }
    </style>

    <div class="inv-c">
        <h2 style="margin: 20px 0;">Stocks Overview</h2>
        <div class="b-c">
            <div id="bubbleChart"></div>
        </div>
    </div>

    <script>
    fetch('../../sql/dashboard/stocks.php')
        .then(response => response.json())
        .then(data => {
            var xData = data.items; 
            var yData = data.stockLevels; 
            
            var plotData = [{
                type: 'scatter',
                mode: 'markers',
                x: xData,
                y: yData,
                text: yData.map(function(value, index) {
                    return value + ' units'; 
                }),
                marker: {
                    size: yData, 
                    color: yData, 
                    colorscale: [
                        [0, 'rgba(255, 190, 150, 0.6)'],
                        [0.25, 'rgba(255, 152, 0, 0.6)'],
                        [0.5, 'rgba(255, 115, 64, 0.6)'],
                        [0.75, 'rgba(255, 99, 132, 0.6)'],
                        [1, 'rgba(240, 95, 160, 0.6)']
                    ],
                    showscale: true,
                    opacity: 0.7,
                    line: { width: 1, color: 'rgba(0,0,0,0.1)' }
                }
            }];

            var layout = {
                xaxis: {
                    title: 'Items',
                    showgrid: false,
                    tickangle: -45,
                    tickfont: { size: 14, color: '#888' }
                },
                yaxis: {
                    title: 'Stock Level',
                    showgrid: true,
                    zeroline: false,
                    tickfont: { size: 14, color: '#888' }
                },
                showlegend: false,
                plot_bgcolor: 'transparent',
                paper_bgcolor: 'transparent',
                margin: { l: 50, r: 50, b: 80, t: 50 },
                hovermode: 'closest',
                autosize: true,
                font: {
                    family: 'Roboto, sans-serif',
                    size: 14,
                    color: '#555'
                }
            };

            Plotly.newPlot('bubbleChart', plotData, layout);
        })
        .catch(error => console.error('Error fetching data: ', error));
</script>
