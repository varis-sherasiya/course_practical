@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{ route('users.index') }}">User Management</a>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>First Name:</strong>
                            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                placeholder="First Name" class="form-control">
                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Middle Name:</strong>
                            <input type="text" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}"
                                placeholder="Middle Name" class="form-control">
                            @error('middle_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Last Name:</strong>
                            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                placeholder="Last Name" class="form-control">
                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Personal Email:</strong>
                            <input type="email" name="personal_email"
                                value="{{ old('personal_email', $user->personal_email) }}" placeholder="Personal Email"
                                class="form-control">
                            @error('personal_email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Work Email:</strong>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                placeholder="Work Email" class="form-control">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Phone No.:</strong>
                            <input type="text" name="phone_no" value="{{ old('phone_no', $user->phone_no) }}"
                                placeholder="Phone No." class="form-control">
                            @error('phone_no')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Mobile No.:</strong>
                            <input type="text" name="mobile_no" value="{{ old('mobile_no', $user->mobile_no) }}"
                                placeholder="Mobile No." class="form-control">
                            @error('mobile_no')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Address:</strong>
                            <textarea name="address" placeholder="Address" class="form-control">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Country:</strong>
                            <select name="country_id" id="country" class="select2 form-control">
                                <option></option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('country_id', $user->city->state->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>State:</strong>
                            <select name="state_id" id="state" class="select2 form-control">
                                <option></option>
                                @if ($user->city)
                                    @foreach ($user->city->state()->get() as $state)
                                        <option value="{{ $state->id }}"
                                            {{ old('state_id', $user->city->state_id) == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('state_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>City:</strong>
                            <select name="city_id" id="city" class="select2 form-control">
                                <option></option>
                                @if ($user->city)
                                    @foreach ($user->city->state->cities()->get() as $city)
                                        <option value="{{ $city->id }}"
                                            {{ old('city_id', $user->city_id) == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('city_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Zip Code:</strong>
                            <input type="text" name="zip_code" value="{{ old('zip_code', $user->zip_code) }}"
                                placeholder="Zip Code" class="form-control">
                            @error('zip_code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Role:</strong>
                            <select name="roles[]" class="form-control select2" multiple="multiple">
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ in_array($value, old('roles', $userRole)) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Password:</strong>
                            <input type="password" name="password" placeholder="Password" class="form-control">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Confirm Password:</strong>
                            <input type="password" name="confirm-password" placeholder="Confirm Password"
                                class="form-control">
                            @error('confirm-password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i
                                class="fa-solid fa-floppy-disk"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            // Fetch States when a country is selected
            $('#country').change(function() {
                let countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        url: "{{ route('get.states', '') }}/" + countryId,
                        type: 'GET',
                        success: function(res) {
                            $('#state').empty().append('<option></option>');
                            $('#city').empty().append(
                                '<option></option>'); // Clear city as well
                            $.each(res, function(key, value) {
                                $('#state').append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#state').empty().append('<option></option>');
                    $('#city').empty().append('<option></option>');
                }
            });

            // Fetch Cities when a state is selected
            $('#state').change(function() {
                let stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: "{{ route('get.cities', '') }}/" + stateId,
                        type: 'GET',
                        success: function(res) {
                            $('#city').empty().append('<option></option>');
                            $.each(res, function(key, value) {
                                $('#city').append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city').empty().append('<option></option>');
                }
            });
        });
    </script>
@endpush
