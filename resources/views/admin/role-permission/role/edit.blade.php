@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>تعديل المهام</h3>
                        <div>

                            <form onsubmit="return confirm('سوف تقوم بالحذف')" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('admin.roles.index') }}" class="btn btn-dark float-end">للخلف</a>
                                <button class="btn btn-danger  mx-2">حذف</button>

                            </form>
                     
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="">الاسم</label>
                                <input type="text" name="name" value="{{ $role->name }}" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-teal">حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
