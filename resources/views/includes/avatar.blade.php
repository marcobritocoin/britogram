@if(Auth::user()->image)
    <div class="container-avatar">
        <!-- <img src="{{ url('/user/avatar/'.Auth::user()->image) }}" width="40px" height="40px" /> -->
        <img class="avatar" src="{{ route('user.avatar', ['filename' => Auth::user()->image]) }}" />
    </div>
@endif