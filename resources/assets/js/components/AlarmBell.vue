<template>
<div>
    <a href="/support-messages"><i class="fa fa-bell mt-18" aria-hidden="true"></i> <div class="mt-7">{{ count }} </div> </a>
</div>
</template>

<script>

    export default {

        mounted: function () {

            this.loadData();

        },

        data: function () {
            return {

                count: '',

            }

        },

        methods:  {

            loadData(){

                axios.get('/api/alarm-data').then( (response) => {

                    this.count = response.data;

                });

            }



        }
    }
</script>