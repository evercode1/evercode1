<form class="form form-border mt-25"
      role="form"
      method="POST"
      action="{{ url('/category/'. $category->id) }}">

{{ method_field('PATCH') }}
{{ csrf_field() }}

<!-- category name input -->

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

        <label class="control-label">Category Name</label>

        <input type="text"
               class="form-control"
               name="name"
               value="{{ $category->name }}" />

        @if ($errors->has('name'))

            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>

        @endif

    </div>

    <!-- end category  name input -->


    <!-- submit button -->

    <div class="form-group">

        <button type="submit"
                class="btn btn-primary btn-lg">

            Create

        </button>

    </div>

    <!-- end submit button -->

</form>

