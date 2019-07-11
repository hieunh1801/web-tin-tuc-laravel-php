 @extends('admin.layout.index')
 @section('content')
    <!-- Page Content -->
 <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            {{-- Handle Show Message Success --}}
            @if(session('thongbao'))
                <div class="alert alert-success">{{session('thongbao')}}</div>
            @endif

            {{-- Form Input Create new user --}}
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="" method="POST">
                    {{-- Token --}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    
                    {{-- User name --}}
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input class="form-control" name="name" placeholder="Nhập tên người dùng" value="{{old('name')}}"/>
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label>Địa chỉ email</label>
                        <input class="form-control" name="email" placeholder="Nhập địa chỉ email" value="{{old('email')}}" />
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    {{-- Password and Re-password --}}
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Nhập địa password" />
                        @if ($errors->has('password'))
                            <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Re-password</label>
                        <input class="form-control" type="password" name="re-password" placeholder="Nhập lại password" />
                        @if ($errors->has('re-password'))
                            <div class="alert alert-danger">{{ $errors->first('re-password') }}</div>
                        @endif
                    </div>

                    {{-- User role --}}
                    <div class="form-group">
                        <label>Quyền người dùng</label><br>
                        <label class="radio-inline">
                            <input name="quyen" value="0" checked="" type="radio"> Người dùng
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="1" checked="" type="radio"> Admin
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-default">Category Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper --> 
 @endsection
 