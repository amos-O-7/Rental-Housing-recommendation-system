@extends('layouts.backend.app')
@section('title')
   Add House
@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header">
                      <h3 class="card-title float-left"><strong>Add New House</strong></h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @include('partial.errors')

                    <form action="{{ route('landlord.house.store') }}" method="POST" enctype="multipart/form-data">
					        @csrf
					        <div class="form-group">
					          <label for="address">Location Description: </label>
					          <input type="text" class="form-control" placeholder="Location of the house" id="address" name="address" value="{{ old('address') }}">
                            </div>

                            <div class="form-group">
                                <label for="name">House Name</label>
                                <input type="text" class="form-control" placeholder="Name of your house" id="house_name" name="house_name" value="{{ old('house_name') }}">
                            </div>

                            <div class="form-group">
                                <label for="area">Area </label>
                                <select name="area_id" class="form-control" id="area_id">
                                    <option value="">select an area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}"  {{ old('area_id') == $area->id ? 'selected' : '' }} >{{ $area->name }}</option>
                                    @endforeach
                                </select>
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label for="contact">Contact: </label>--}}
{{--                                <input type="text" class="form-control" placeholder="contact" id="contact" name="contact" value="{{ old('contact') }}">--}}
{{--                            </div>--}}


                        <div class="form-group">
                                <label for="pet_policy">Pet Policy : </label>
                                <select class="form-control" placeholder="" id="pet_policy" name="pet_policy" value="{{ old('pet_policy') }}">
                                    <option>Allow pets</option>
                                    <option>No Pets</option>
                                </select>
{{--                                <input type="text" class="form-control" placeholder="Yes or No" id="pet_policy" name="Pet_policy" value="{{ old('Pet_policy') }}">--}}
                            </div>



                            <div class="form-group">
                                <label for="house_type">House Type:</label>
                                <select class="form-control" placeholder="" id="house_type" name="house_type" value="{{ old('house_type') }}">
                                    <option>Bedsitter</option>
                                    <option>One Bedroom</option>
                                    <option>Two Bedroom</option>
                                    <option>Three Bedroom</option>
                                    <option>Single Room</option>
                                </select>
                            </div>

                             <div class="form-group">
                                  <label for="parking_lot">Parking Lot:</label>
                                  <select class="form-control" placeholder="" id="parking_lot" name="parking_lot" value="{{ old('parking_lot') }}">
                                      <option>Yes</option>
                                      <option>No</option>
                                  </select>
{{--                                  <input type="text" class="form-control" placeholder="Yes or No" id="parking_lot" name="parking_lot" value="{{ old('parking_lot') }}">--}}
                             </div>

                             <div class="form-group">
                                 <label for="water">Water Availability</label>
                                 <select class="form-control" placeholder="" id="water" name="water" value="{{ old('water') }}">
                                     <option>Borehole Water</option>
                                     <option>Line Water</option>
                                     <option>Not available</option>
                                 </select>
                             </div>

                             <div class="form-group">
                                 <label for="internet_connection">Internet Connectivity</label>
                                 <select class="form-control" placeholder="connection" id="internet_connection" name="internet_connection" value="{{ old('internet_connection') }}">
                                     <option>Fibre connection</option>
                                     <option>Normal connection</option>
                                     <option>No Internet</option>
                                 </select>
                             </div>

                            <div class="form-group" >
                                <label for="balcony">Balcony</label>
                                <select class="form-control" placeholder="balcony" id="balcony" name="balcony" value="{{ old('balcony') }}">
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="rent">Rent: </label>
                                <input type="text" class="form-control" placeholder="rent" id="rent" name="rent" value="{{ old('rent') }}">
                            </div>

                            <div class="'form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" placeholder="short description" name="description" id="description" value="{{ old('description') }}"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                                <input type="file" name="featured_image" class="form-control" id="featured_image">
                            </div>

                            <div class="form-group">
                                <label for="images">House Images</label>
                                <input type="file" name="images[]" class="form-control" multiple>
                            </div>


                            <div class="form-group">
                                    <button type="submit" class="btn btn-success">Add</button>
                                    <a href="{{ URL::previous() }}" class="btn btn-danger wave-effect" >Back</a>
                            </div>
                  </form>


                    </div>

                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container -->
 @endsection
