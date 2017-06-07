<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 col-md-2 left-nav-box">
            <ul class="left-nav-first-list-group">
                <li>Overview <span class="sr-only">(current)</span></li>
                <li><a href="/admin"><span class="glyphicon glyphicon-list-alt" style="color:#9f9f9f;"></span> &nbsp; Dashboard</a></li>
            </ul>
            <ul class="left-nav-list-group">
                <li>Posts</li>
                <li><a href="/post"><span class="glyphicon glyphicon-list-alt" style="color:#9f9f9f;"></span> &nbsp; All Posts</a></li>
                <li><a href="/post/create"><span class="glyphicon glyphicon-list-alt" style="color:#9f9f9f;"></span> &nbsp;Create New</a></li>
            </ul>
            <ul class="left-nav-list-group">
                <li>Content</li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-list-alt" style="color:#9f9f9f;"></span>
                         Content &nbsp;<span class="caret"></span></a>
                    <content-list></content-list>
                </li></ul>
            <ul class="left-nav-list-group">
                <li>Categories</li>
                <li><a href="/category"><span class="glyphicon glyphicon-list-alt" style="color:#9f9f9f;"></span> &nbsp; All Categories</a></li>
                <li><a href="/category/create"><span class="glyphicon glyphicon-list-alt" style="color:#9f9f9f;"></span> &nbsp;Create New</a></li>
            </ul>
            <ul class="left-nav-list-group">
                <li>Users</li>
                <li><a href="/user"><span class="glyphicon glyphicon-list-alt" style="color:#9f9f9f;"></span> &nbsp; All Users</a></li>
            </ul>
            <ul class="left-nav-list-group">
                <li>Books & Resources</li>
                <li><a href="/book"><span class="glyphicon glyphicon-list-alt" style="color:#9f9f9f;"></span> &nbsp; All Books</a></li>
                <li><a href="/book/create"><span class="glyphicon glyphicon-list-alt" style="color:#9f9f9f;"></span> &nbsp;Create New</a></li>
                <li><a href="/blogresource"><span class="glyphicon glyphicon-list-alt" style="color:#9f9f9f;"></span> &nbsp; All Resources</a></li>
                <li><a href="/blogresource/create"><span class="glyphicon glyphicon-list-alt" style="color:#9f9f9f;"></span> &nbsp;Create New</a></li>
            </ul>



        </div> <!-- end sidebar -->

        @yield('content')


        </div> <!-- end row -->


        </div>  <!-- end container -->

