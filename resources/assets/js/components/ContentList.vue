<template>



            <ul class="dropdown-menu" style="background-color:white;">

                <li><a href="/content">All</a></li>
                <li v-for="item in contents"><a v-bind:href="'/content/' + item.id">{{ item.name }}</a></li>
            </ul>






</template>

<script>

    export default {

        mounted: function () {

            this.loadData();

        },

        data: function () {
            return {

                contents: {},

            }

        },

        methods:  {

            loadData(){

                axios.get('/api/content-list').then( (response) => {

                    this.contents = response.data;

                });

            }



        }
    }
</script>