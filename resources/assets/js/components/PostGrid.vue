<template>

    <div class="row">

        <div class="col-lg-12">

            <h1>Posts</h1>

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

                                <a v-bind:href="'/post/' + row.Id"> {{ row.Title }}</a>

                            </td>

                            <td>

                                {{ row.Author }}

                            </td>

                            <td>

                                {{ row.Category }}

                            </td>

                            <td>

                                {{ showStatus(row.Status) }}

                            </td>


                            <td>

                                {{ row.Published }}

                            </td>

                            <td>

                                    {{ row.Created }}

                            </td>

                            <td >

                                <a v-bind:href="'/post/' + row.Id + '/edit'">

                                    <button type="button" class="btn btn-default ml-10">

                                        Edit

                                    </button>

                                </a>


                                <button class="btn btn-danger pull-right margin-10"
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

            gridData.loadData('api/post-data', this);

        },
        data: function () {
            return {
                query: '',
                gridColumns: ['Id', 'Title', 'Author', 'Category', 'Status','Published', 'Created'],
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
                createUrl: '/post/create',
                showCreateButton: true
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

                gridData.getQueryData(request, 'api/post-data', this);

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

            showStatus: function(status){

                return status == 1 ? 'Published'  : 'Draft';

            },

            confirmDelete: function(id){

                if(confirm("Are you sure you want to delete?")){

                    axios.post('/post-delete/' + id)
                            .then(response => {

                                gridData.loadData('api/post-data', this);

                            })


                }



            }

        }

    }

</script>