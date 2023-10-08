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
                    <h1 class="h3 mb-0 text-gray-800">تعديل مستخدم</h1>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm shadow-sm">رجوع</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name">الإسم</label>
                        <input type="text" class="form-control" id="name" placeholder="الإسم" name="name" value="{{ old('name', $user->name) }}" />
                    </div>
                    <div class="form-group">
                        <label for="email">البريد الإلكترونى</label>
                        <input type="email" class="form-control" id="email" placeholder="البريد الإلكترونى" name="email" value="{{ old('email',  $user->email) }}" />
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input type="text" class="form-control" id="password" placeholder="كلمة المرور" name="password" value="{{ old('password',  $user->password) }}" />
                    </div>
                    <div class="form-group">
                        <label for="roles">الدور</label>
                        <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required>
                            @foreach($roles as $id => $roles)
                                <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">حفظ</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection