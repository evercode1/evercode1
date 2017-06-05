<template>

    <div class="sidebar-module">
        <h4>Resources</h4>
        <ol class="list-unstyled">

            <li v-for="resource in resources"><a v-bind:href="resource.Url" target="_blank">{{ resource.Title }}</a></li>

        </ol>
    </div>


</template>

<script>

    export default {

        mounted: function () {

            this.loadData();

        },

        data: function () {
            return {

                resources: [],

            }

        },

        methods:  {

            loadData(){

                axios.get('/api/blog-resource-data').then( (response) => {

                    this.resources = response.data.data;

                });

            }



        }
    }
</script>