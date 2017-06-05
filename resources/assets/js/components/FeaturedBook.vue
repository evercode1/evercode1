<template>

    <a v-bind:href="url" target="_blank">{{ title }}</a>


</template>
<script>

    export default {

        mounted: function () {

            this.loadData();

        },

        data: function () {
            return {

                title: '',
                url: ''


            }

        },

        methods:  {

            loadData(){

                axios.get('/api/featured-book').then( (response) => {

                    this.title = response.data.title;

                    this.url = response.data.url;


                });

            },





        }
    }
</script>