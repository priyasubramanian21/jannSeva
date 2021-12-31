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


	var form = $('<form action="level" method="post">' +
		'<input type="text" name="api_url" value="' + strArray[0] + '" />' +
		'</form>');
	$('body').append(form);
	form.submit();


	/*window.location.replace(
		"level=" +
			strArray[0]
	);*/
});


(function ($) {
	'use strict';

	//Defaults configuration
	var defaults = {
		url: null,
		values: null,
		method: "POST",
		target: null,
		traditional: false,
		redirectTop: false
	};

	/**
	 * jQuery Redirect
	 * @param {string} url - Url of the redirection
	 * @param {Object} values - (optional) An object with the data to send. If not present will look for values as QueryString in the target url.
	 * @param {string} method - (optional) The HTTP verb can be GET or POST (defaults to POST)
	 * @param {string} target - (optional) The target of the form. "_blank" will open the url in a new window.
	 * @param {boolean} traditional - (optional) This provides the same function as jquery's ajax function. The brackets are omitted on the field name if its an array.  This allows arrays to work with MVC.net among others.
	 * @param {boolean} redirectTop - (optional) If its called from a iframe, force to navigate the top window.
	 *//**
	 * jQuery Redirect
	 * @param {string} opts - Options object
	 * @param {string} opts.url - Url of the redirection
	 * @param {Object} opts.values - (optional) An object with the data to send. If not present will look for values as QueryString in the target url.
	 * @param {string} opts.method - (optional) The HTTP verb can be GET or POST (defaults to POST)
	 * @param {string} opts.target - (optional) The target of the form. "_blank" will open the url in a new window.
	 * @param {boolean} opts.traditional - (optional) This provides the same function as jquery's ajax function. The brackets are omitted on the field name if its an array.  This allows arrays to work with MVC.net among others.
	 * @param {boolean} opts.redirectTop - (optional) If its called from a iframe, force to navigate the top window.
	 */
	$.redirect = function (url, values, method, target, traditional, redirectTop) {
		var opts = url;
		if (typeof url !== "object") {
			var opts = {
				url: url,
				values: values,
				method: method,
				target: target,
				traditional: traditional,
				redirectTop: redirectTop
			};
		}

		var config = $.extend({}, defaults, opts);
		var generatedForm = $.redirect.getForm(config.url, config.values, config.method, config.target, config.traditional);
		$('body', config.redirectTop ? window.top.document : undefined).append(generatedForm.form);
		generatedForm.submit();
		generatedForm.form.remove();
	};

	$.redirect.getForm = function (url, values, method, target, traditional) {
		method = (method && ["GET", "POST", "PUT", "DELETE"].indexOf(method.toUpperCase()) !== -1) ? method.toUpperCase() : 'POST';

		url = url.split("#");
		var hash = url[1] ? ("#" + url[1]) : "";
		url = url[0];

		if (!values) {
			var obj = $.parseUrl(url);
			url = obj.url;
			values = obj.params;
		}

		values = removeNulls(values);

		var form = $('<form>')
			.attr("method", method)
			.attr("action", url + hash);


		if (target) {
			form.attr("target", target);
		}

		var submit = form[0].submit;
		iterateValues(values, [], form, null, traditional);

		return { form: form, submit: function () { submit.call(form[0]); } };
	}

	//Utility Functions
	/**
	 * Url and QueryString Parser.
	 * @param {string} url - a Url to parse.
	 * @returns {object} an object with the parsed url with the following structure {url: URL, params:{ KEY: VALUE }}
	 */
	$.parseUrl = function (url) {

		if (url.indexOf('?') === -1) {
			return {
				url: url,
				params: {}
			};
		}
		var parts = url.split('?'),
			query_string = parts[1],
			elems = query_string.split('&');
		url = parts[0];

		var i, pair, obj = {};
		for (i = 0; i < elems.length; i += 1) {
			pair = elems[i].split('=');
			obj[pair[0]] = pair[1];
		}

		return {
			url: url,
			params: obj
		};
	};

	//Private Functions
	var getInput = function (name, value, parent, array, traditional) {
		var parentString;
		if (parent.length > 0) {
			parentString = parent[0];
			var i;
			for (i = 1; i < parent.length; i += 1) {
				parentString += "[" + parent[i] + "]";
			}

			if (array) {
				if (traditional)
					name = parentString;
				else
					name = parentString + "[" + name + "]";
			} else {
				name = parentString + "[" + name + "]";
			}
		}

		return $("<input>").attr("type", "hidden")
			.attr("name", name)
			.attr("value", value);
	};

	var iterateValues = function (values, parent, form, isArray, traditional) {
		var i, iterateParent = [];
		Object.keys(values).forEach(function (i) {
			if (typeof values[i] === "object") {
				iterateParent = parent.slice();
				iterateParent.push(i);
				iterateValues(values[i], iterateParent, form, Array.isArray(values[i]), traditional);
			} else {
				form.append(getInput(i, values[i], parent, isArray, traditional));
			}
		});
	};

	var removeNulls = function (values) {
		var propNames = Object.getOwnPropertyNames(values);
		for (var i = 0; i < propNames.length; i++) {
			var propName = propNames[i];
			if (values[propName] === null || values[propName] === undefined) {
				delete values[propName];
			} else if (typeof values[propName] === 'object') {
				values[propName] = removeNulls(values[propName]);
			} else if (values[propName].length < 1) {
				delete values[propName];
			}
		}
		return values;
	};
}(window.jQuery || window.Zepto || window.jqlite));