<template>
    <div  id="app"> </div>
</template>

<script>
    var Highcharts = require('highcharts');
    export default {
        name : "Chart",
        props : {
            series : {
                type: Array,
                required: true
            }
        },

        data : function() {
            return {
                target: undefined
            }
        },
        methods: {
            drawChart(){

            }
        },
        mounted : function() {
            this.drawChart()
            this.target = Highcharts.chart(this.$el, {
                chart: {
                    type: "line"
                },
                title: {
                    text: 'Monthly Average Temperature',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Source: WorldClimate.com',
                    x: -20
                },
                xAxis: {
                    categories: [0, 20, 40, 50, 70, 90, 99, 100]
                },
                yAxis: {
                    title: {
                        text: "Total Onboarded"
                    },
                    labels: {
                        format: "{value}%"
                    },
                    min: 0,
                    max: 100
                },
                tooltip: {
                    valueSuffix: "%"
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: this.series
            });
        },
        beforeDestroy: function() {
            this.target.destroy();
        },
    }
</script>
