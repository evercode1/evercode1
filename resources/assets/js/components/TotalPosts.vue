<template>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-file"></i></span>

                <div class="info-box-content">
                    <span>Total Posts</span>
                    <span class="info-box-number text-center">{{ posts }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
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

                posts: '',

            }

        },

        methods:  {

            loadData(){

                axios.get('/api/total-posts').then( (response) => {

                    this.posts = response.data;

                });

            }



        }
    }
</script>