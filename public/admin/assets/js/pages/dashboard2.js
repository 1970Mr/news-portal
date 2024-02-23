// Countdown
$(".counter-down").incrementalCounter({digits:'auto'});


// Sells chart
Chart.defaults.global.defaultFontFamily = "IranSans";
var randomScalingFactor = function() {
    return Math.round(Math.floor(Math.random() * 6000)*1000)+15000000;
};
var config2 = {
    type: "line",
    data: {
        labels: ["فروردین", "اردی بهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
        datasets: [{
            backgroundColor: "rgba(69,39,160,0.2)",
            borderColor: "#4527a0",
            borderWidth: 2,
            label: "درآمد ماهانه(تومان)", 
            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
        }]
    },
    options: {
        maintainAspectRatio: false,
        responsive: true,
        title:{
            display:true
        },
        hover: {
            mode: "nearest",
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: "ماه"
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: "درآمد به تومان"
                },
                ticks: {
                    suggestedMin: 8000000
                },
            }]
        }
    }
};


// Gender pie Chart
var config1 = {
    type: 'pie',
    data: {
        labels: ["بانو", "آقا"],
        datasets: [{
            backgroundColor: [
                "#53a96b", 
                "#4527a0"
            ],
            borderWidth: 3,
            label: "جنسیت خریداران",
            data: [45, 55]
        }]
    },
    options: {
        responsive: true
    }
};
window.onload = function() {
    var ctx1 = document.getElementById("pie").getContext("2d");
    window.pie1 = new Chart(ctx1, config1);
    
    var ctx = document.getElementById("line").getContext("2d");
    window.line1 = new Chart(ctx, config2);
};



// َMap
var map;
var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";
AmCharts.ready(function() {
    map = new AmCharts.AmMap();
    map.imagesSettings = {
        rollOverColor: "#ffbd15",
        rollOverScale: 3,
        selectedScale: 5,
        selectedColor: "#575757"
    };
    map.areasSettings = {
        autoZoom: true,
        rollOverBrightness: 10,
        selectedBrightness: 100,
        unlistedAreasColor: "#14b9d6"
    };
    var dataProvider = {
        mapVar: AmCharts.maps.iranHigh,
        images: [
            {svgPath:targetSVG, zoomLevel:5, scale:0.5, title:"تهران: 5,500,000,000 تومان", latitude:35.7061, longitude:51.4358},
            {svgPath:targetSVG, zoomLevel:5, scale:0.5, title:"شیراز: 3,010,000,000 تومان", latitude:29.5, longitude:52.5},
            {svgPath:targetSVG, zoomLevel:5, scale:0.5, title:"یزد: 1,180,000,000 تومان", latitude:32, longitude:55},
            {svgPath:targetSVG, zoomLevel:5, scale:0.5, title:"مشهد: 1,550,000,000 تومان", latitude:36.5, longitude:59},
            {svgPath:targetSVG, zoomLevel:5, scale:0.5, title:"تبریز: 1,545,000,000 تومان", latitude:38.7061, longitude:45},
            {svgPath:targetSVG, zoomLevel:5, scale:0.5, title:"اصفهان: 4,100,000,000 تومان", latitude:33, longitude:52.4358},
            {svgPath:targetSVG, zoomLevel:5, scale:0.5, title:"بندرعباس: 1,200,000,000 تومان", latitude:27.5, longitude:56},
            {svgPath:targetSVG, zoomLevel:5, scale:0.5, title:"زاهدان: 1,050,500,000 تومان", latitude:29, longitude:60.5},
        ]
    };
    map.dataProvider = dataProvider;
    map.write("map");
});