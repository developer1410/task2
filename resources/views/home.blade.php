@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Top up balance</div>

                    <div class="card-body">
                        <form method="POST" action=" {{route('add_credits')}} ">
                            @csrf

                            <div class="form-group row">
                                <label for="balance_amount"
                                       class="col-md-4 col-form-label text-md-right">Amount: </label>

                                <div class="col-md-6">
                                    <input
                                        id="balance_amount"
                                        type="number"
                                        class="form-control @error('balance_amount') is-invalid @enderror"
                                        name="balance_amount" value="{{ old('balance_amount') }}" required
                                        autocomplete="off"
                                        autofocus
                                    >
                                    @error('balance_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add to balance
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Create deposit</div>

                    <div class="card-body">
                        <form method="POST" action=" {{route('create_deposit')}} ">
                            @csrf

                            <div class="form-group row">
                                <label for="deposit_amount" class="col-md-4 col-form-label text-md-right">Deposit
                                    Amount: </label>

                                <div class="col-md-6">
                                    <input
                                        id="deposit_amount"
                                        type="number"
                                        class="form-control @error('deposit_amount') is-invalid @enderror"
                                        name="deposit_amount" value="{{ old('deposit_amount') }}" required
                                        autocomplete="off"
                                        autofocus
                                    >
                                    @error('deposit_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deposit_duration" class="col-md-4 col-form-label text-md-right">Deposit
                                    duration in hours: </label>

                                <div class="col-md-6">
                                    <input
                                        id="deposit_duration"
                                        type="number"
                                        class="form-control @error('deposit_duration') is-invalid @enderror"
                                        name="deposit_duration" value="{{ old('deposit_duration') }}" required
                                        autocomplete="off"
                                        autofocus
                                    >
                                    @error('deposit_duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create deposit
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
