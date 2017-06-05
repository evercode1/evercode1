<template>

    <div class="sidebar-module">
        <h4>Categories</h4>
        <ol class="list-unstyled">

            <li v-for="category in categories"><a v-bind:href="'/post-by-category/' + category.id">
                {{ category.name }} - {{ postsCount(category.posts) }}</a></li>

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

                categories: [],

            }

        },

        methods:  {

            loadData(){

                axios.get('/api/category-list').then( (response) => {

                    this.categories = response.data;

                });

            },

            postsCount(posts){

                return Object.keys(posts).length;


            }

        }
    }
</script>