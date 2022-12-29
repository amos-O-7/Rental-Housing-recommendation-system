@extends('layouts.backend.app')
@section('title')
    Renter - All Houses
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
               @include('partial.successMessage')

                <div class="card my-5 mx-4">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>All Available Houses ({{ $housecount }})</strong></h3>

                    </div>
                    <!-- /.card-header -->
                    @if ($houses->count() > 0)
                    <div class="">
                    <div class="table-responsive">
                      <table id="dataTableId" class="table table-bordered table-striped table-background">
                        <thead>
                        <tr>
                            <th>Area</th>
                            <th>Type</th>
                            <th>Rent</th>
                            <th>Contacts</th>
                            <th>Added at</th>
                            <th>Pet Policy</th>
                            <th>Internet</th>
                            <th>Parking</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($houses as $key=>$house)
                        <tr>
                            <td>{{ $house->area->name }}</td>
                            <td>{{ $house->house_type }}</td>
                            <td>{{ $house->rent }}</td>
                            <td>{{ $house->user->contact }}</td>
                             <td>{{ $house->created_at->toFormattedDateString() }}</td>
                            <td>{{ $house->pet_policy }}</td>
                            <td>{{ $house->internet_connection }}</td>
                            <td>{{ $house->parking_lot }}</td>
                          <td>
                            @if ($house->status == 1)
                                Available
                            @else
                                Not Available
                            @endif
                          </td>
                          <td>
                            <a href="{{ route('renter.houses.details', $house->id) }}"  class="btn btn-success m-2">Details</a>

                          </td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>

            </div> <!-- /.card-body -->
              @else
                 <h2 class="text-center text-info font-weight-bold m-3">No House Found</h2>
              @endif

               <div class="pagination">
                  {{ $houses->links() }}
                </div>

            </div>
                  <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
 @endsection

