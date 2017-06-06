<template>



        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-user"></i></span>

                <div class="info-box-content">
                    <span>Total Users</span>
                    <span class="info-box-number text-center">{{ users }}</span>
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

                users: '',

            }

        },

        methods:  {

            loadData(){

                axios.get('/api/total-users').then( (response) => {

                    this.users = response.data;

                });

            }



        }
    }
</script>