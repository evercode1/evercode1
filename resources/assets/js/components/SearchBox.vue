<template>
    
    <div>
        <form class="navbar-form navbar-right mr-10">
            <input type="text" v-model="q" v-on:keyup.enter.prevent="search(q)" class="form-control" placeholder="Search...">
        </form>
    </div>

</template>


<script>

    export default {

        mounted: function () {



        },

        data: function () {
            return {

                q: '',

            }

        },

        methods:  {


            search(q){


                $.get( "/search?q=" + q, function( data ) {
                    console.log( data );
                });

            }

        }
    }
</script>