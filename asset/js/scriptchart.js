var barOptions_stacked = {
	tooltips: {
		enabled: false,
	},
	hover: {
		animationDuration: 0,
	},
	scales: {
		xAxes: [
			{
				ticks: {
					beginAtZero: true,
					fontFamily: "'Open Sans Bold', sans-serif",
					fontSize: 11,
				},
				scaleLabel: {
					display: false,
				},
				gridLines: {},
				stacked: true,
			},
		],
		yAxes: [
			{
				gridLines: {
					display: false,
					color: "#fff",
					zeroLineColor: "#fff",
					zeroLineWidth: 0,
				},
				ticks: {
					fontFamily: "'Open Sans Bold', sans-serif",
					fontSize: 11,
					display: false,
				},
				stacked: true,
			},
		],
	},
	legend: {
		display: false,
	},

	animation: {
		onComplete: function () {
			var chartInstance = this.chart;
			var ctx = chartInstance.ctx;
			ctx.textAlign = "left";
			ctx.font = "9px Open Sans";
			ctx.fillStyle = "#fff";

			// Chart.helpers.each(this.data.datasets.forEach(function (dataset, i) {
			//     var meta = chartInstance.controller.getDatasetMeta(i);
			//     Chart.helpers.each(meta.data.forEach(function (bar, index) {
			//         data = dataset.data[index];
			//         // if(i==0){
			//         //     ctx.fillText(data, 50, bar._model.y+4);
			//         // } else {
			//         //     ctx.fillText(data, bar._model.x-25, bar._model.y+4);
			//         // }
			//     }),this)
			// }),this);
		},
	},
	pointLabelFontFamily: "Quadon Extra Bold",
	scaleFontFamily: "Quadon Extra Bold",
};

var ctx = document.getElementById("Chart1");
var st1red = document.getElementById("st1red").value;
var st2red = document.getElementById("st2red").value;
var st3red = document.getElementById("st3red").value;
var st4red = document.getElementById("st4red").value;
var st5red = document.getElementById("st5red").value;

var st1orange = document.getElementById("st1orange").value;
var st1yellow = document.getElementById("st1yellow").value;
var st1green = document.getElementById("st1green").value;

var st2orange = document.getElementById("st2orange").value;
var st2yellow = document.getElementById("st2yellow").value;
var st2green = document.getElementById("st2green").value;

var st3orange = document.getElementById("st3orange").value;
var st3yellow = document.getElementById("st3yellow").value;
var st3green = document.getElementById("st3green").value;

var st4orange = document.getElementById("st4orange").value;
var st4yellow = document.getElementById("st4yellow").value;
var st4green = document.getElementById("st4green").value;

var st5orange = document.getElementById("st5orange").value;
var st5yellow = document.getElementById("st5yellow").value;
var st5green = document.getElementById("st5green").value;

var st1per = document.getElementById("st1per").value;
var st2per = document.getElementById("st2per").value;
var st3per = document.getElementById("st3per").value;
var st4per = document.getElementById("st4per").value;
var st5per = document.getElementById("st5per").value;

var myChart = new Chart(ctx, {
	type: "bar",
	data: {
		labels: [
			"1 Stage -" + st1per + "%",
			"2 Stage -" + st2per + "%",
			"3 Stage -" + st3per + "%",
			"4 Stage -" + st4per + "%",
			"5 Stage -" + st5per + "%",
		],

		datasets: [
			{
				data: [st1red, st2red, st3red, st4red, st5red],
				backgroundColor: "#FF0000",

				// hoverBackgroundColor: "rgba(50,90,100,1)"
			},
			{
				data: [st1orange, st2orange, st3orange, st4orange, st5orange],
				backgroundColor: "#FFA500",
				// hoverBackgroundColor: "rgba(140,85,100,1)"
			},
			{
				data: [st1yellow, st2yellow, st3yellow, st4yellow, st5yellow],
				backgroundColor: "#FFFF00",
				// hoverBackgroundColor: "rgba(140,85,100,1)"
			},
			{
				data: [st1green, st2green, st3green, st4green, st5green],
				backgroundColor: "#008000",
				// hoverBackgroundColor: "rgba(46,185,235,1)"
			},
			{
				data: [20, 40, 60, 80, 100],
				backgroundColor: "#00000000",
				// hoverBackgroundColor: "rgba(46,185,235,1)"
			},
		],
	},

	options: barOptions_stacked,
});

$("#Chart1").click(function (evt) {
	var activePoints = myChart.getElementsAtEventForMode(
		evt,
		"point",
		myChart.options
	);
	var firstPoint = activePoints[0];
	var label = myChart.data.labels[firstPoint._index];
	var strArray = label.split(" ");

	window.location.replace(
		"http://localhost/jannSeva/dashBoard/rest/level/index.php?level=" +
			strArray[0]
	);
});
