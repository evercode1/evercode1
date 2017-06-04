<div class="sidebar-module">
    <h4>Categories</h4>
    <ol class="list-unstyled">

        @foreach($categories as $category)
        <li><a href="#">{{ $category->name }}</a></li>


            @endforeach
    </ol>
</div>