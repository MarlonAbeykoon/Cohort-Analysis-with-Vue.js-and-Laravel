<template>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="container" style="min-width: 100%; max-width:100%; height: 600px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var Highcharts = require('highcharts');

    export default {
        name: 'app',
        data () {
            return {
                chart: null,
                series: []
            }
        },
        mounted(){
            this.drawChart();
            const self = this;
            axios.get('http://localhost:8000/api/chart').then(function(response) {
                console.log(response);

                if(response.status === 200){
                    self.series = response.data.series;
                    self.drawChart();
                }
            }).catch(function(err){
                console.log(err)
            });

        },
        methods: {

            drawChart() {
                if (this.chart) {
                    this.chart.destroy();
                }
                this.chart = Highcharts.chart(this.$el, {
                    chart: {
                        type: "line"
                    },
                    title: {
                        text: 'Weekly Retention Curve',
                        x: -20 //center
                    },
                    xAxis: {
                        categories: ['0 week later', '1 week later', '2 weeks later', '3 weeks later', '4 weeks later', '5 weeks later', '6 weeks later', '7 weeks later']
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
            }

        }
    }
</script>