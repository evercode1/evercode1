<form class="form form-border mt-25"
      role="form"
      method="POST"
      action="{{ url('/reply') }}">

{{ csrf_field() }}



    <input type="hidden" name="contact_id" value="{{ $contact->id }}">

    <input type="hidden" name="user_id" value="{{ $contact->user_id }}">


    <!-- reply input -->

    <div class="form-group{{ $errors->has('reply') ? ' has-error' : '' }}">

        <label class="control-label">Your Reply</label>

        <textarea name="reply"
                  class="form-control"
                  rows="20"
                  value="{{ old('reply') }}"></textarea>


        @if ($errors->has('reply'))

            <span class="help-block">
                <strong>{{ $errors->first('reply') }}</strong>
            </span>

        @endif

    </div>

    <!-- end message input -->

    <!-- submit button -->

    <div class="form-group">

        <button type="submit"
                class="btn btn-primary btn-lg">

            Reply

        </button>

    </div>

    <!-- end submit button -->

</form>

