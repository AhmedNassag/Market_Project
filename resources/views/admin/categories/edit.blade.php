@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Content Row -->
    <div class="card shadow">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">تعديل صنف</h1>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm shadow-sm">رجوع</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">الإسم</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" />
                </div>
                <button type="submit" class="btn btn-primary btn-block">حفظ</button>
            </form>
        </div>
    </div>
    <!-- Content Row -->

</div>
@endsection