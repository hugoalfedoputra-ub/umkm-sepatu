$(document).ready(function () {
    // Event listener untuk perubahan pada select chart_type
    document
        .querySelector('select[name="chart_type"]')
        .addEventListener("change", function () {
            var chartType = this.value;
            fetchChartData(chartType);
        });

    if (window.location.pathname.includes("admin-dashboard")) {
        fetchChartData(
            document.querySelector('select[name="chart_type"]').value || "sales"
        );
        //   fetchRecentOrders();
    }

    function fetchChartData(chartType) {
        fetch(`/admin/get-chart-data?chart_type=${chartType}`)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                updateChart(data.months, data.chartData, chartType);
            })
            .catch((error) =>
                console.error("Error fetching chart data:", error)
            );
    }

    function updateChart(months, chartData, chartType) {
        var chartOptions = {
            chart: {
                type: chartType === "status" ? "bar" : "line",
                height: 350,
            },
            series: [],
            xaxis: {
                categories: months,
            },
        };

        if (chartType === "status") {
            for (var status in chartData) {
                chartOptions.series.push({
                    name: status.charAt(0).toUpperCase() + status.slice(1),
                    data: chartData[status],
                });
            }
        } else if (chartType === "sales") {
            chartOptions.series.push({
                name: "Terjual",
                data: chartData["selesai"],
            });
        }

        var chartElement = document.querySelector("#sales_chart");
        chartElement.innerHTML = "";
        var chart = new ApexCharts(chartElement, chartOptions);
        chart.render();
    }

    // Event listener untuk form sorting dan searching
    //  $("#sort-form").on("submit", function (e) {
    //      e.preventDefault();
    //      fetchRecentOrders();
    //  });

    //  function fetchRecentOrders(url = "/admin-dashboard/get-recent-orders") {
    //      var formData = $("#sort-form").serialize();
    //      $.ajax({
    //          url: url,
    //          type: "GET",
    //          data: formData,
    //          success: function (response) {
    //              $("#recent-orders-container").html(response.html);
    //          },
    //          error: function (xhr) {
    //              console.error("Error fetching recent orders:", xhr);
    //          },
    //      });
    //  }
});
