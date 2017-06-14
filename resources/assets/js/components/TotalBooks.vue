<template>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="/book"><div class="info-box">
                <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-book"></i></span>

                <div class="info-box-content">
                    <span class="text-center">All Books</span>
                    <span class="info-box-number text-center">{{ books }}</span>
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

                books: '',

            }

        },

        methods:  {

            loadData(){

                axios.get('/api/total-books').then( (response) => {

                    this.books = response.data;

                });

            }



        }
    }
</script>