@extends('admin.layouts.app')

@section('content')


<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between">
                    <h4>
                        المهام
                        {{-- @can('create role') --}}
                        {{-- @endcan --}}
                    </h4>
                    <a href="{{ route("admin.roles.create") }}" class="btn btn-primary float-end">اضافة</a>

                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th width="40%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td 
                                @can('تعديل المهام')
                                class="update-link" data-route="{{route('admin.roles.edit',$role->id)}}"
                                @endcan
                                
                                >{{ $role->name }}</td>
                                <td>
                                 
                                    <a href="{{route("admin.role.addPermission",$role->id)}}" class="btn btn-teal btn-sm">
                                        الصلاحيات
                                    </a>

                                    {{-- @can('تعديل المهام')
                                    <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-success btn-sm">
                                        تعديل الاسم
                                    </a>
                                    @endcan

                                    @can('حذف المهام')
                                    <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-danger btn-sm mx-2">
                                        حذف
                                    </a>
                                    @endcan --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection