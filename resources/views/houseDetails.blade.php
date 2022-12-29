@extends('layouts.frontend.app')

@section('title','Home')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card my-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3><strong>{{ $house->house_name }} House - {{ $house->area->name }}</strong></h3>

                        </div>
                        <div>
                            <a class="btn btn-danger" href="{{ route('welcome') }}"> Back</a>

                            @guest
                            <a href="" onclick="guestBooking()" class="btn btn-info">Book </a>
                            @else

                            @if (Auth::user()->role_id == 3)
                            <button class="btn btn-info" type="button" onclick="renterBooking({{ $house->id }})">
                                Apply for booking
                            </button>

                            <form id="booking-form-{{ $house->id }}" action="{{ route('booking', $house->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                            </form>
                            @endif
                            @endguest
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                @include('partial.successMessage')
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>{{ $house->address }}</td>
                            </tr>
{{--                            <tr>--}}
{{--                                <th>House Name</th>--}}
{{--                                <td>{{ $house->house_name }}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>Area</th>--}}
{{--                                <td>{{ $house->area->name }}</td>--}}
{{--                            </tr>--}}
                            <tr>
                                <th>Landlord</th>
                                <td>{{ $house->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Landlord's Contact</th>
                                <td>{{ $house->contact }}</td>
                            </tr>
                            <tr>
                                <th>Pet Policy</th>
                                <td>{{ $house->pet_policy }}</td>
                            </tr>

                            <tr>
                                <th>Parking space</th>
                                <td>{{ $house->parking_lot }}</td>
                            </tr>

                            <tr>
                                <th>Internet connection</th>
                                <td>{{ $house->internet_connection }}</td>
                            </tr>

                            <tr>
                                <th>Water Availability</th>
                                <td>{{ $house->water }}</td>
                            </tr>

                            <tr>
                                <th>Balcony</th>
                                <td>{{ $house->balcony }}</td>
                            </tr>

                            <tr>
                                <th>Rent</th>
                                <td>Kshs.{{ $house->rent }}</td>
                            </tr>

                            <tr>
                                <th>Description</th>
                                <td>{{ $house->description }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($house->status == 1)
                                    <span class="btn btn-success">Available</span>
                                    @else
                                    <span class="btn btn-danger">Not Available</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Share</th>
                                <td>
                                    <div class="addthis_inline_share_toolbox"></div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="row gallery">
                        @foreach (json_decode($house->images) as $picture)
                        <div class="col-md-3">
                            <a href="{{ asset('images/'.$picture) }}">
                                <img src="{{ asset('images/'.$picture) }}" class="img-fluid m-2"
                                    style="height: 150px;width: 100%; ">
                            </a>
                        </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>


            <div id="content">
                <div class="container">
                    <div class="row justify-content-center py-5">
                        <h2 class="text-center"><strong>Similar houses as {{ $house->house_name }}</strong></h2>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                {{--                    @if(status(route('house->id', $house)))==1--}}
                                @forelse ($similar_house as $house)
                                    <div class="col-md-4">
                                        <div class="card m-3">
                                            <div class="card-header">
                                                <img src="{{ asset('storage/featured_house/'. $house->featured_image) }}" width="100%"
                                                     class="img-fluid" alt="Card image">
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
                                    <h2 class="m-auto py-2 text-white bg-dark p-3">House Not Available right now</h2>
                                @endforelse
                            </div>
                            {{ $similar_house->links() }}
                        </div>
                    </div>
                </div>
            </div>


            <div id="content">
                <div class="container">
                    <div class="row justify-content-center py-5">
                        <h2 class="text-center"><strong>You might also like</strong></h2>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                {{--                    @if(status(route('house->id', $house)))==1--}}
                                @forelse ($similar_rent as $house)
                                    <div class="col-md-4">
                                        <div class="card m-3">
                                            <div class="card-header">
                                                <img src="{{ asset('storage/featured_house/'. $house->featured_image) }}" width="100%"
                                                     class="img-fluid" alt="Card image">
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
                                    <h2 class="m-auto py-2 text-white bg-dark p-3">House Not Available right now</h2>
                                @endforelse
                            </div>
                            {{ $similar_rent->links() }}
                        </div>
                    </div>
                </div>
            </div>




                <!-- /.card-body -->
            </div>
            <!-- /.card -->





        </div>


{{--        <div class="container">--}}
{{--            <div class="row mb-5" style="border-bottom: 1px solid #ccc">--}}
{{--                <div class="col text-center">--}}
{{--                    <img class="p-3" style="height: 80px; width: auto; border-top: 1px solid #ccc; background-color: #f7f7f7" src="{{ $selectedHouse->image }}" alt="House Image">--}}
{{--                    @foreach ($houses as $house)--}}
{{--                        <a href="/?id={{ $house->id }}" style="text-decoration: none;">--}}
{{--                            <img class="p-3" style="height: 80px; width: auto;" src="{{ $house->featured_image }}" alt="Product Image">--}}
{{--                        </a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="offset-3 col-6">--}}
{{--                    <h5>Selected Product</h5>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row mb-5">--}}
{{--                <div class="offset-3 col-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="text-center" style="background-color: #ccc">--}}
{{--                            <img class="large-product-image" src="{{ $selectedHouse->featured_image }}" alt="house Image">--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <p class="card-text text-muted">{{ $selectedHouse->name }} (${{ $selectedHouse->price }})</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="offset-3 col-6">--}}
{{--                    <h5>Similar houses</h5>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @foreach ($houses as $house)--}}
{{--                <div class="row mb-5">--}}
{{--                    <div class="offset-3 col-6">--}}
{{--                        <div class="card">--}}
{{--                            <div class="text-center" style="background-color: #ccc">--}}
{{--                                <img class="large-product-image" src="{{ $house->featured_image }}" alt="Product Image">--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="card-title">Similarity: {{ round($house->similarity * 100, 1) }}%</h5>--}}
{{--                                <p class="card-text text-muted">{{ $house->name }} (${{ $house->price }})</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>--}}
{{--        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>--}}
{{--    </div>--}}



    @if ($house->reviews->count() > 0)
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card my-5">
                <div class="card-header bg-dark text-white">
                    <strong>Renter Reviews of this house ({{ $house->reviews->count() }})</strong>
                </div>

                <div class="card-body">
                    @foreach ($house->reviews as $review)
                    <div class="card mb-3">
                        <div class="card-header">
                            <img class="mr-3"
                                src="{{ $review->user->image!=null ? asset('storage/profile_photo/'. $review->user->image) : asset('storage/profile_photo/default.png') }}"
                                width="35" height="35"
                                style="border-radius: 50%"><strong>{{ $review->user->name }}</strong>
                        </div>
                        <div class="card-body">
                            <p class="text-justify">
                                {{ $review->opinion }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif



</div><!-- /.container -->

@endsection




@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    window.addEventListener('load', function() {
        baguetteBox.run('.gallery', {
            animation: 'fadeIn',
            noScrollbars: true
        });
   });

   function guestBooking(){
                Swal.fire(
                    'If you want to booking this house',
                    'Then you must have to login first as a renter',
                )
                event.preventDefault();
    }

    function renterBooking(id){
           const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure to booking this house?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        document.getElementById('booking-form-'+id).submit();

                    } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                    ) {
                    swalWithBootstrapButtons.fire(
                        'Not Now!',

                    )
                }
            })
       }

</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f5fb96836345445"></script>
@endsection



@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
@endsection
