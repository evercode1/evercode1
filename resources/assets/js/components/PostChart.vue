<template>

    <div>



        <canvas id="canvass" height="300" width="300"></canvas>

        <div class="pull-right">

            <button @click.prevent="displayOptions">options</button>

        </div>


        <div v-if="formOptions" class="col-md-3">
            <div class="form-group pull-left">
                <label for="type">chart type:</label>
                <select class="form-control" id="type" v-model="type" v-on:change="changeType">
                    <option>line</option>
                    <option>bar</option>
                </select>




                <label for="period" id="label">chart periods:</label>
                <select class="form-control" id="period" v-model="period" v-on:change="changePeriod">
                    <option value="1year">1 year</option>
                    <option value="3months">3 months</option>
                    <option value="30days">30 days</option>
                    <option value="1week">1 week</option>
                    <option value="yesterday">Yesterday</option>
                    <option value="today">Today</option>
                    <option value="Custom">Custom</option>

                </select>

            </div>
        </div>

        <div v-show="showCustom()"  class="col-sm-offset-4">

            <label for="custom-date" id="label">Choose Custom Period:</label>

            <form id="custom-date">

                <input type="date" v-model="startDate" name="start_date" value=""></input>

                &nbsp; &nbsp; to &nbsp; &nbsp;

                <input type="date" v-model="endDate" name="end_date" value=""></input>

                <button class="btn-default" @click.prevent="submitCustom()">Go!</button>


            </form>

        </div>

    </div>



</template>

<script>

    var $myChart;



    export default {


        data: function(){

            return {
                labels: [],
                values1: [],
                name: 'Posts',
                formOptions: false,
                type: 'line',
                period: '1year',
                custom: false,
                startDate: '',
                endDate: ''
            };

        },

        mounted: function () {

            this.loadData();

        },

        methods: {

            changeType: function () {

                this.setConfig();

            },

            displayOptions(){

               this.formOptions = (! this.formOptions);

            },

            loadData: function () {

                $.getJSON('api/post-chart', function (data) {

                    this.labels = data.data.labels;
                    this.values1 = data.data.values1;
                    this.setConfig();

                }.bind(this));

            },

            changePeriod: function () {

                if (this.period == 'Custom'){

                    return this.customPeriod();
                }

                this.custom = false;
                this.startDate = '';
                this.endDate = '';


                $.getJSON('api/post-chart?period=' + this.period, function (data) {

                    this.labels = data.data.labels;
                    this.values1 = data.data.values1;

                    this.setConfig();

                }.bind(this));

            },

            submitCustom:  function () {

                $.getJSON('api/post-chart?period=custom&start_date=' + this.startDate + '&end_date=' + this.endDate, function (data) {

                    this.labels = data.data.labels;
                    this.values1 = data.data.values1;

                    this.setConfig();

                }.bind(this));



                this.startDate = '';
                this.endDate = '';

            },

            customPeriod:  function () {

                this.custom = true;

            },

            showCustom:  function () {


                return this.custom == true;

            },

            setConfig : function () {

                var ctx = document.getElementById('canvass').getContext('2d');
                var config = {
                    type: this.type,
                    data: {
                        labels: this.labels,
                        datasets: [{
                            label: this.name,
                            data: this.values1,
                            fill: true,
                            // Tension - bezier curve tension of the line. Set to 0 to draw straight lines connecting points
                            // Used to be called "tension" but was renamed for consistency. The old option name continues to work for compatibility.
                            lineTension: 0.1,

                            // String - the color to fill the area under the line with if fill is true
                            backgroundColor: "rgba(75,192,192,0.4)",

                            // String - Line color
                            borderColor: "rgba(75,192,192,1)",

                            // String - cap style of the line. See https://developer.mozilla.org/en-US/docs/Web/API/CanvasRenderingContext2D/lineCap
                            borderCapStyle: 'butt',
                            borderDash: []
                        }]
                    },
                    options: {
                        responsive: false,
                        legend: {
                            position: 'bottom'
                        },
                        hover: {
                            mode: 'label'
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'months'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: '# of ' + this.name
                                }
                            }]
                        },
                        title: {
                            display: true,
                            text: this.name
                        }
                    }
                };

                // destroy existing chart

                if (typeof $myChart !== "undefined") {

                    $myChart.destroy();

                }

                // set instance, so we can destroy when rendering new chart


                $myChart = new Chart( ctx, { type: this.type, data: config.data, options:config.options });

            }

        }


    }


</script>