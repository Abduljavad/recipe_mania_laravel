@section('back-button')
<a class="navbar-brand " href="{{ url('/') }}">
    <img src="{{env('BACK_BUTTON','https://cdn-icons-png.flaticon.com/512/93/93634.png')}}" style="height:30px" alt="back-button">
</a>
@endsection