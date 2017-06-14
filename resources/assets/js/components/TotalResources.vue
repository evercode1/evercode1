<template>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="/blogresource"><div class="info-box">
                <span class="info-box-icon"><i class="glyphicon glyphicon-gift"></i></span>

                <div class="info-box-content">
                    <span class="text-center">Resources</span>
                    <span class="info-box-number text-center">{{ resources }}</span>
                </div>
                <!-- /.info-box-content -->
            </div></a>
            <!-- /.info-box -->
        </div>


</template>

<script>

    export default {

        mounted: function () {

            this.loadData();

        },

        data: function () {
            return {

                resources: '',

            }

        },

        methods:  {

            loadData(){

                axios.get('/api/total-resources').then( (response) => {

                    this.resources = response.data;

                });

            }



        }
    }
</script>