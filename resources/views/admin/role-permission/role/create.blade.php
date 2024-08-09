@extends('admin.layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>
                        انشاء دور
                    </h4>
                    <a href="{{ route("admin.roles.index") }}" class="btn btn-danger float-end">للخلف</a>

                </div>
                <div class="card-body">
                    <form action="{{ route("admin.roles.store") }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="">الاسم</label>
                            <input type="text" name="name" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">ادخال</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection