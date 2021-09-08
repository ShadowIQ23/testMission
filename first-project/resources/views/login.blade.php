@extends('welcome')

@section('content')

    <div class="container">

        <div class="row">

            <h1>Login</h1>

        </div>

        <div class="row">

            <form method="post">

                @csrf

                @if ($errors->any())

                    <div class="alert alert-danger" role="alert">

                        Please fix the following errors

                    </div>

                @endif

                <div class="form-group">

                    <label for="title">Login</label>

                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="login" placeholder="Login" value="">

                    @error('title')

                    <div class="invalid-feedback">{{ $message }}</div>

                    @enderror

                </div>

                <div class="form-group">

                    <label for="url">Password</label>

                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="password" placeholder="password" value="">

                    @error('url')

                    <div class="invalid-feedback">{{ $message }}</div>

                    @enderror

                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>

        </div>

    </div>

@endsection
