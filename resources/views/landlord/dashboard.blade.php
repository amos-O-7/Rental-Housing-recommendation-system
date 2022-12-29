@extends('layouts.backend.app')
@section('title')
    Landlord Dashboard
@endsection
<style>
    .welcome{
        padding: 10px;
    }
    .icon{
        color: #18355d !important;
        font-size:55px !important;
        padding-bottom: 20px;
    }


    .col-md-3{
        background-color: inherit;
        transition: 1s;
        height: 200px;
        padding: 20px;
        margin: 20px 33px;
    }
    .number{
        color:#18355d;
    }
    .boxs{
        margin-top: 30px;
    }

    .col-md-3:hover{
        background: rgb(79, 99, 143)
    }
 </style>
@section('content')
<div class="container">
    <div class="row text-center boxes">
        <div class="col-md-3">
            <i  class="fa fa-map-marker icon" aria-hidden="true"></i>
            <a href="{{ route('landlord.area.index') }}"  class="nav-link">
            <h3 class="number">Areas</h3>
            </a>
                <h3 class="number">
                    <span class="counter">{{ $areas->count() }}</span>
                </h3>
        </div>
        <div class="col-md-3">
            <i class="fa fa-home icon" aria-hidden="true"></i>
            <a href="{{ route('landlord.house.index') }}"  class="nav-link">
            <h3 class="number">Your Houses</h3>
            </a>
            <h3 class="number"><span class="counter">{{ $houses->count() }}</span></h3>
        </div>
        <div class="col-md-3">
            <i class="fas fa-users-cog icon"></i>
{{--            <a href="{{ route('landlord.renter.index') }}"  class="nav-link">--}}
            <h3 class="number">Renters</h3>
{{--            </a>--}}
            <h3 class="number"><span class="counter">{{ $renters->count() }}</span></h3>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.counterup.min.js') }}"></script>
<script>
    $('.counter').counterUp({
        delay: 100,
        time: 2000
    });
</script>

@endsection
