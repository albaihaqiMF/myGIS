let data = [
    {
        name: "sales",
        data: ["30", "40", "35", "50", "49", "60", "70", "91", "125"],
    },
];

let category = [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999];

function chartLine(element = "#chart", series = data, categories = null) {
    var options = {
        chart: {
            type: "line",
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

        console.log(data.soil_moisture, data);

        return data;
    } catch (error) {
        console.log(error);
    }
}

var soilChart = chartLine("#soil_moisture");
setInterval(() => {
    getUsers()
        .then((res) => {
            soilChart.updateSeries(res.soil_moisture);
        })
        .catch((e) => {
            console.log(e);
        });
}, 5000);
