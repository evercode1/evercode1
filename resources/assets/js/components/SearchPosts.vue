<script>

    export default {

        mounted: function () {



        },

        data: function () {
            return {

                query: '',

            }

        },

        methods:  {

            loadData(){

                axios.get('/api/alarm-data').then( (response) => {

                    this.count = response.data;

                });

            },

            search(query){


                console.log('query');

            }

        },



        computed:
        {
            isActive(){


                return this.count ? 'alarm' : 'no-alarm';

            }

        }
    }
</script>