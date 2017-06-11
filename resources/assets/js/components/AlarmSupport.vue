<template>
<div>

    <a href="/open-contacts" v-bind:class="isActive">

        <i class="fa fa-bell mt-18" aria-hidden="true"></i>

        <div class="mt-7" v-show="count > 0">{{ count }}

        </div>

    </a>

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

                axios.get('/api/alarm-support-data').then( (response) => {

                    this.count = response.data;

                });

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

<style>

    .alarm {

        color: #ffd42a;
    }

    a.alarm:hover {

        color: white;
    }

    .no-alarm {

        color: #f9ffff;
    }

    a.no-alarm:hover {

        color: yellow;
    }

</style>