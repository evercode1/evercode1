<template>

    <div>


        <div class="blog-post-meta text-center">Posts By Category</div>

        <canvas id="canvass-pie" height="300" width="300"></canvas>



    </div>



</template>

<script>

    var $myPieChart;



    export default {


        data: function(){

            return {
                labels: [],
                values: [],
                name: 'Categories',
                formOptions: false,
                type: 'pie',
                period: '1year',
                startDate: '',
                endDate: ''
            };

        },

        mounted: function () {

            this.loadData();

        },



        methods: {

            loadData: function () {


                $.getJSON('api/post-pie-chart', function (data) {

                    this.labels = data.data.labels;
                    this.values = data.data.values;
                    this.setConfig();

                }.bind(this));

            },


            setConfig : function () {

                var ctx = document.getElementById('canvass-pie').getContext('2d');
                var config = {
                    type: this.type,
                    data: {
                        labels: this.labels,
                        datasets: [{
                            backgroundColor: [
                                "#2ecc71",
                                "#3498db",
                                "#95a5a6",
                                "#9b59b6",
                                "#f1c40f",
                                "#e74c3c",
                                "#34495e"
                            ],
                            data: this.values
                        }]
                    }
                };

                // destroy existing chart

                if (typeof $myPieChart !== "undefined") {

                    $myChart.destroy();

                }

                // set instance, so we can destroy when rendering new chart


                $myPieChart = new Chart( ctx, { type: 'pie', data: config.data });

            }

        }


    }


</script>