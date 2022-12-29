@extends('layouts.frontend.app')

@section('title','Home')

@section('content')

    <div id="content">
        <div class="container">
            <div class="row justify-content-center py-5">
                <h2 class="text-center"><strong>Available One Bedrooms</strong></h2>
                <hr>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        {{--                    @if(status(route('house->id', $house)))==1--}}
                        @forelse ($houses as $house)
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
                            <h2 class="m-auto py-2 text-white bg-dark p-3">No One bedrooms available at the moment</h2>
                        @endforelse


                    </div>
                    {{ $houses->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
    function guestBooking(){
                Swal.fire({
                    title: 'To book a house, You Need To Login First as a Renter!',
                    showClass: {
                        popup: 'animated fadeInDown faster'
                    },
                    hideClass: {
                        popup: 'animated fadeOutUp faster'
                    }
                    })
            }
</script>
@endsection
