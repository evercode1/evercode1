<template>

    <div class="sidebar-module">
        <h4>Archives</h4>
        <ol class="list-unstyled">
            <li v-for="archive in archives"><a v-bind:href="'/post-by-date/' + formatMonth(archive.month) + '-' + archive.year">{{ formatMonth(archive.month) }}  {{ archive.year}} - {{ archive.count }}</a></li>

        </ol>
    </div>

</template>



<script>

    export default {

        mounted() {

            this.loadData();

        },

        data() {

            return {

                archives: [],

            }

        },

        methods:  {

            loadData(){

                axios.get('/api/archives').then( (response) => {

                    this.archives = response.data;

                });

            },

            postsCount(posts){

                return Object.keys(posts).length;


            },

            formatMonth(month){

                switch(month){

                    case 1 :

                       month = 'January';

                       return month;

                       break;

                    case 2 :

                        month = 'February';

                        return month;

                        break;

                    case 3 :

                        month = 'March';

                        return month;

                        break;

                    case 4 :

                        month = 'April';

                        return month;

                        break;

                    case 5 :

                        month = 'May';

                        return month;

                        break;


                    case 6 :

                        month = 'June';

                        return month;

                        break;

                    case 7 :

                        month = 'July';

                        return month;

                        break;

                    case 8 :

                        month = 'August';

                        return month;

                        break;

                    case 9 :

                        month = 'September';

                        return month;

                        break;

                    case 10 :

                        month = 'October';

                        return month;

                        break;

                    case 11 :

                        month = 'November';

                        return month;

                        break;

                    case 12 :

                        month = 'December';

                        return month;

                        break;




                }

            }

        }
    }
</script>