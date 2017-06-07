<template>



        <div v-html="signature.body">

        </div>



</template>

<script>

    export default {

        mounted: function () {

            this.loadData();

        },

        data: function () {
            return {

                signature: [],

            }

        },

        methods:  {

            loadData(){

                axios.get('/api/signature-data').then( (response) => {

                    this.signature = response.data;

                });

            }



        }
    }
</script>

