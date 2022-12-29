@extends('layouts.frontend.app')

@section('title')

@endsection

@section('content')
    <div id="search">
        <div class="container-fluid">
            <div class="row justify-content-center py-4">
                <h2 class="text-center"><strong>Select and fill your preferences</strong></h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <form action="{{ route('search') }}" method="GET">
                        @csrf
                        <div class="row justify-content-center">
                            @if(session('search'))
                                <div class="alert alert-danger mt-3" id="alert" roles="alert">
                                    {{ session('search') }}
                                </div>
                            @endif
                        </div>
                        <div class="row">
{{--                            <div class="form-group col-md-2">--}}
{{--                                <input type="text" name="address" placeholder="search an area" class="form-control">--}}
{{--                                <select class="form-control" name="area" placeholder="">--}}
{{--                                    <option value="">area</option>--}}
{{--                                    <option value="1">Gate A</option>--}}
{{--                                    <option value="2">Gate B</option>--}}
{{--                                    <option value="3">Gate C</option>--}}
{{--                                    <option value="4">Oasis</option>--}}
{{--                                    <option value="5">Gachororo</option>--}}
{{--                                    <option value="6">High point</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="form-group col-md-2">
                                <select class="form-control" name="pet_policy">
                                    <option value="">Pet Policies</option>
                                    <option>Allow pets</option>
                                    <option>No Pets</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control" name="house_type">
                                    <option>House type</option>
                                    <option>Bedsitter</option>
                                    <option>One Bedroom</option>
                                    <option>Two Bedroom</option>
                                    <option>Three Bedroom</option>
                                    <option>Single Room</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control">
                                    <option value="">Need Parking space</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
{{--                            <div class="form-group col-md-2">--}}
{{--                                <select class="form-control" name="internet">--}}
{{--                                    <option value="">Type of connection</option>--}}
{{--                                    <option value="1">Fibre</option>--}}
{{--                                    <option value="2">Normal</option>--}}
{{--                                    <option value="3">No internet</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="form-group col-md-2">
                                <select class="form-control" name="water">
                                    <option value="">Water availability</option>
                                    <option>Borehole Water</option>
                                    <option>Line Water</option>
                                    <option>Not available</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" name="rent" placeholder="rent" class="form-control">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Click me to find the house of your choice</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="content">
       <div style="margin-left: 130px" class="">
        <div class="row justify-content-center py-2">
            <h1><strong>Available Houses</strong></h1>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-11">

                   <div style="width: 100%" class="row">
                        @forelse ($houses as $house)
                            <div class="col-md-4">
                                <div style="border-style: none" class="card m-0 house-card">
                                    <div class="card-header">
                                        <div class="row gallery">
                                        <a href="{{ asset('storage/featured_house/'. $house->featured_image) }}">
                                        <img style="margin: 0px; padding: 0px"  src="{{ asset('storage/featured_house/'. $house->featured_image) }}" height="250px" width="100%" class="img-fluid" alt="Card image">
                                        </a>
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 5px" class="card-footer">
                                        <p><h3 style="font-size: small;"><a href="{{ route('house.details', $house->id) }}">
                                                {{ $house->house_name }}</a> </h3>
                                        <strong style="margin-left: 0px"><i class="fas fa-map-marker-alt"> {{ $house->area->name }}, Juja </i> </strong>
                                        <p><strong><i class="fas fa-home"> {{ $house->house_type }}, Kshs {{ $house->rent }}</i></strong></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h2 class="m-auto py-2 text-white bg-dark p-3">Your dream house is currently unavailable</h2>
                        @endforelse
                   </div>

                   <div class="panel-heading my-4" style="display:flex; justify-content:center;align-items:center;">
                       <a href="{{ route('house.all') }}" class="btn btn-dark">See All Houses</a>
                    </div>


            </div>

            <div class="row">
                <div class="col-md-11">
                <ul class="list-group sort">
                    <li class="list-group-item bg-dark text-light sidebar-heading"><strong>Search By Range</strong></li>
                    <form action="{{ route('searchByRange') }}" method="get" class="mt-2">
                        <div class="form-group">
                            <input type="number" class="form-control" required name="digit1" placeholder="enter range (lower value)">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" required name="digit2" placeholder="enter range (upper value)">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success btn-block">Search</button>
                        </div>
                    </form>
                </ul>




                    <ul class="list-group sort">
                        <li class="list-group-item bg-dark text-light sidebar-heading"><strong>Sort By Rent</strong></li>
                        <li class="list-group-item order"><a href="{{ route('highToLow') }}">High to low</a></li>
                        <li class="list-group-item order"><a href="{{ route('lowToHigh') }}">Low to High</a></li>
                        <li class="list-group-item order"><a href="{{ route('welcome') }}">Normal Order</a></li>
                    </ul>



                    <ul class="list-group area-show">
                        <li class="list-group-item bg-dark text-light sidebar-heading"><strong>Areas</strong></li>
                        @forelse ($areas as $area)
                            <li class="list-group-item all-areas">
                                <a href="{{ route('available.area.house', $area->id) }}" class="area-name">{{ $area->name }} <strong>({{ $area->houses->count() }})</strong></a>
                            </li>
                        @empty
                            <li class="list-group-item">Area not found</li>
                        @endforelse

                    </ul>

{{--                    <ul class="list-group area-show">--}}
{{--                        <li class="list-group-item bg-dark text-light sidebar-heading"><strong>House Types</strong></li>--}}
{{--                        @forelse ($house_types as $house_type)--}}
{{--                            <li class="list-group-item all-areas">--}}
{{--                                <a href="{{ route('available.house_type.house', $house->id) }}" class="area-name">{{ $house_type->name }} <strong>({{ $house_type->houses->count() }})</strong></a>--}}
{{--                            </li>--}}
{{--                        @empty--}}
{{--                            <li class="list-group-item">House type not found</li>--}}
{{--                        @endforelse--}}

{{--                    </ul>--}}

            </div>
            </div>
        </div>

       </div>
    </div>



    <div class="section-4 bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<img src="{{ asset('frontend/img/why.jpg') }}" class="section-4-img img-fluid" width="500px;" height="500px;">
				</div>
				<div class="col-md-5">
					<h1 class="text-white">Why Choose Us?</h1>

					<p class="para-1">Lorem ipsum dolor sit amet, consectetur adipisicing elitim id est laborum.dolore magna alsint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laboro.	</p>
                    <a href="#" style="text-decoration: none">Join Us</a>
				</div>
			</div>
		</div>
	</div>



    <section id="our-story">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h1 class="story">Our Story</h1>
              <p class="pera">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>

              <p class="pera">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua Ut enim.</p>
            </div>
            <div class="col-md-6">
              <img src="{{ asset('frontend/img/about-us.png') }}" class="img-fluid">
            </div>
          </div>
        </div>
      </section>



@endsection
