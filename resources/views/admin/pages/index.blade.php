@extends('admin.layouts.app')
@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        وحدة التحكم
                    </div>
                    <h2 class="page-title">
                        الصفحات
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.pages.create') }}" class=" btn btn-primary d-none d-sm-inline-block"
                
                        >
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            انشاء صفحة
                        </a>
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary d-sm-none btn-icon"
                    
                        >
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </div>

    

@endsection
@section('content')
@if (Session::has('delete'))
<div class="alert alert-success">{{Session::get('delete')}}</div>
@endif
<div class="row">

    <table id="pages" class="table table-bordered table-warning table-striped table-sm">
        <thead>

            <tr>
                <th>#</th>
                <th>اسم الصفحة</th>
                <th>الحالة</th>
                <th>الاجراءت</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
              @foreach ($Pages as $Item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$Item->name}}</td>
                <td>
                    @if ($Item->status == 1)
                        <span class="badge bg-success">تعمل</span>
                    @else 
                        <span class="badge bg-danger">لا تعمل</span>
                    @endif
                </td>
                <td>
                    <form action="{{route("admin.pages.destroy",$Item->id)}}" method="POST" onsubmit="return confirm('سوف تقوم بحذف الصفحة')">
                        @csrf 
                        @method('DELETE')
                        <a href="{{route("admin.pages.edit",$Item->id)}}" class="btn btn-success btn-sm" >
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                            تعديل</a>
        
                        <button type="submit" class="btn btn-danger btn-sm">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-trash-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16zm-9.489 5.14a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" /><path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" /></svg>
                            حذف</button>
                    </form>
                </td>
            </tr>

              @endforeach
        </tbody>
    </table>

    
 
</div>

@endsection

@push('js')
    <script>
        
      // Dtatables 
      $('#pages').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            }
        });
    </script>
@endpush