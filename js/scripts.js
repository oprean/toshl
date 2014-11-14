$(function () {
    
    var DataModel = Backbone.Model.extend({});

    var DataCollection = Backbone.Collection.extend({
        model: DataModel
    });

    var DataView = Backbone.View.extend({
        el: '#highcharts',
        initialize: function (options) {
            this.data = options.data;
        },
        render: function () {
            this.$el.highcharts({
                title: {
                    text: 'Cheltuieli anuale',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Source: Toshl.com',
                    x: -20
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: 'Cheltuieli (RON)'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: '°C'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: this.data.toJSON()
            });
        }
    });

    var items = new DataCollection(toshData);

    var view = new DataView({ data: items });

    view.render();

});