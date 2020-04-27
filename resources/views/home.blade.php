@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required>

                                    @if ($errors->has('surname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mount" class="col-md-4 col-form-label text-md-right">{{ __('Monto') }}</label>

                                <div class="col-md-6">
                                    <input id="mount" type="number" class="form-control{{ $errors->has('mount') ? ' is-invalid' : '' }}" name="mount" value="{{ old('mount') }}" required>

                                    @if ($errors->has('mount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="days" class="col-md-4 col-form-label text-md-right">{{ __('Días') }}</label>

                                <div class="col-md-6">
                                    <input id="days" type="number" class="form-control{{ $errors->has('days') ? ' is-invalid' : '' }}" name="days" value="{{ old('days') }}" required>

                                    @if ($errors->has('days'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('days') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="days" class="col-md-4 col-form-label text-md-right">{{ __('Días') }}</label>

                                <div class="col-md-6">
                                    <input id="days" type="number" class="form-control{{ $errors->has('days') ? ' is-invalid' : '' }}" name="days" value="{{ old('days') }}" required>

                                    @if ($errors->has('days'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('days') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Calcular') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
