let data = [
    {
        name: "sales",
        data: [0, 0, 0, 0, 0, 0, 0],
    },
];

let category = [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999];

function chartLine(element = "#chart", series = data, categories = null) {
    var options = {
        chart: {
            type: "line",
        },
        stroke: {
            curve: "smooth",
        },
        series: series,
        xaxis: {
            categories: categories,
        },
    };

    var chart = new ApexCharts(document.querySelector(element), options);

    chart.render();

    return chart;
}

chartLine();

async function getUsers() {
    let url = "/api/node/get";
    try {
        let res = await fetch(url);

        let data = await res.json();

        return data;
    } catch (error) {
        console.log(error);
    }
}

var soilChart = chartLine("#soil_moisture");
var humidityChart = chartLine("#humidity");
var tempChart = chartLine("#temp");
setInterval(() => {
    getUsers()
        .then((res) => {
            soilChart.updateSeries(res.soil_moisture);
            humidityChart.updateSeries(res.humidity);
            tempChart.updateSeries(res.temp);
        })
        .catch((e) => {
            console.log(e);
        });
}, 5000);
