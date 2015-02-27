var Analytics = (function() {

    var _public = {};
    var _private = {};

    _private.options = {
        legend: 'none',
        backgroundColor: 'transparent',
        lineWidth: 1,
        pointSize: 10,
        colors: ['#FFF'],
        hAxis: {
            title: '',
            gridlines: {
                color: "transparent"
            },
            textStyle: {
                color: 'transparent'
            },
            baselineColor: 'transparent',
        },
        tooltip: { 
            isHtml: true
        },
        vAxis: {
            title: '',
            gridlines: {
                color: "transparent"
            },
            textStyle: {
                color: '#FFFFFF'
            },
            baselineColor: 'transparent',
        },
    }

    _private.load = function() {
        _private.google = google;

        _private.google.load('visualization', '1.1', {
            packages: ['corechart']
        });

    }

    _public.draw = function() {

        var pagesView = JSON.parse($("#pages-view").attr('data-pages-view'));

        var views = [];

        views.push([
            'Date', 
            'Views', {
                'type': 'string', 
                'role': 
                'tooltip', 
                'p': {
                    'html': true
                }
            }
        ]);

        $.each(pagesView, function(index, view){

            views.push([view[0], view[1], '<div class="tooltip">' + view[2] + '<span>' + view[1] + ' visits</span>']);

        });

        var data = _private.google.visualization.arrayToDataTable(views);
            data.sort([{
                column: 0
            }]);

        var chart = new _private.google.visualization.LineChart(document.getElementById('pages-view'));

        chart.draw(data, _private.options);

    }

    _public.init = function() {

        _private.load();
        _private.google.setOnLoadCallback(_private.draw);

    }

    return _public;

}());

Analytics.init();

$(window).resize(function(){
    Analytics.draw();
});