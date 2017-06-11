<template>

    <div class="row">

        <div class="col-lg-12">

            <h1>Support Requests</h1>

            <search-box></search-box>

            <div class="pull-right">

                <grid-count></grid-count>

            </div>



            <section class="panel mt-25">
                <div class="panel-title"></div>

                <div class="panel-body">

                    <table class="table table-bordered table-striped table-responsive">

                        <table-head></table-head>

                        <tbody>

                        <tr v-for="row in gridData">

                            <td>

                                {{ row.Id }}

                            </td>

                            <td>

                                {{ row.User }}

                            </td>

                            <td>

                                {{ row.Topic }}

                            </td>



                            <td>

                                 <a v-bind:href="'/contact/' + row.Id">{{ trimMessage(row.Message) }}</a>

                            </td>

                            <td>

                                {{ showStatus(row.Status) }}

                            </td>


                            <td>

                                {{ row.Created }}

                            </td>



                            <td >

                                <a v-bind:href="'/contact/' + row.Id + '/edit'">

                                    <button type="button" class="btn btn-default">

                                        Edit

                                    </button>

                                </a>

                                    <button class="btn btn-danger pull-right mr-10"
                                            @click="confirmDelete(row.Id)">

                                        Delete

                                    </button>



                            </td>

                        </tr>

                        </tbody>

                    </table>

                </div>

                <page-number></page-number>

            </section>

            <pagination></pagination>

        </div>

    </div>

</template>

<script>

    var gridData = require('../utilities/gridData');


    export default {

        components: {'pagination' : require('./Pagination'),
            'search-box' : require('./SearchBox'),
            'grid-count' : require('./GridCount'),
            'page-number' : require('./PageNumber'),
            'table-head' : require('./TableHead')},

        mounted: function () {

            gridData.loadData('api/contact-data', this);


        },
        data: function () {
            return {
                query: '',
                gridColumns: ['Id','User', 'Topic', 'Message', 'Status', 'Created'],
                gridData: [],
                total: null,
                next_page_url: null,
                prev_page_url: null,
                last_page: null,
                current_page: null,
                pages: [],
                first_page_url: null,
                last_page_url: null,
                go_to_page: null,
                sortOrder: 1,
                sortKey: '',
                createUrl: '/contact/create',
                showCreateButton: false
            }
        },

        methods: {

            sortBy: function (key){
                this.sortKey = key;
                this.sortOrder = (this.sortOrder == 1) ? -1 : 1;
                this.getData(1);
            },

            search: function(query){
                this.getData(query);
            },


            getData:  function(request){

                gridData.getQueryData(request, 'api/contact-data', this);

            },

            setPageNumbers: function(){
                for (var i = 1; i <= this.last_page; i++) {
                    this.pages.push(i);
                }
            },

            checkPage: function(page){
                return page == this.current_page;
            },

            resetPageNumbers: function(){
                this.pages = [];
                for (var i = 1; i <= this.last_page; i++) {
                    this.pages.push(i);
                }
            },

            checkUrlNotNull: function(url){
                return url != null;
            },

            clearPageNumberInputBox: function(){
                return this.go_to_page = '';
            },

            pageInRange: function(){
                return this.go_to_page <= parseInt(this.last_page);
            },

            trimMessage: function(message){

                return message.substring(0, 10) + '...';


            },

            showStatus:  function(status){

                switch(status){

                    case 1 :

                        return 'Open';
                        break;

                    case 0 :

                        return 'Closed';
                        break;

                }

            },

            confirmDelete: function (id){

                if(confirm("Are you sure you want to delete?")){

                    axios.post('/contact-delete/' + id)
                            .then(response => {

                        gridData.loadData('api/contact-data', this);

                })


                }



            }

        }

    }

</script>