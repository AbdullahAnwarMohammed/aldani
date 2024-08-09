@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>المهام : {{ $role->name }}
                    </h4>
                    <a href="{{route("admin.roles.index")}}" class="btn btn-danger float-end">للخلف</a>

                </div>
                <div class="card-body">
                    <form action="{{route("admin.role.updatePermission",$role->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            @error('permission')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <label for="" class="my-2">الصلاحيات</label>

                            <div class="row">
                                @foreach ($permissions as $permission)
                                <div class="col-md-2">
                                    <label>
                                        <input
                                            type="checkbox"
                                            name="permission[]"
                                            value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                        />
                                        {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection