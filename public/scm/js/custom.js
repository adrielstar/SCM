var lineChartData = {
    labels: labels,
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(170,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: data
        }
    ]
};

//all the data types for graphs
var dataTypes = {
    temperature:"&deg;C",
    airPressure:"Pascal",
    humidity:"%",
    battery:"mV"
};

//Set temperature data type as default
$("#data-type").html(dataTypes["temperature"]);

var ctx = document.getElementById("canvas").getContext("2d");
var myLine = new Chart(ctx).Line(lineChartData, {
    responsive: true
});

$(".thingsspeak-data").click(function () {
    window.myLine.destroy();
    lineChartData.datasets[0].data = window[this.id];

    var ctx = document.getElementById("canvas").getContext("2d");
    myLine = new Chart(ctx).Line(lineChartData, {
        responsive: true
    });
});

//    temperature in degree celsius
//    air pressure in pascal
//    humidity in %
//    battery in mv