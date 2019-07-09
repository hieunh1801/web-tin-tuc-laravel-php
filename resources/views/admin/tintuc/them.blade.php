 @extends('admin.layout.index')
 @section('content')
    <!-- Page Content -->
 <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12" style="padding-bottom:120px">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="idTheLoai" id="TheLoai">
                            @foreach ($theloai as $item)
                            <option value="{{$item->id}}">{{$item->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" name="idLoaiTin" id="LoaiTin">
                                @foreach ($loaitin as $item)
                                <option value="{{$item->id}}">{{$item->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" />
                    </div>
                   
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea class="form-control" name="TomTat" placeholder="Nhập tóm tắt" rows="3"></textarea>
                    </div>
                   
                    <div class="form-group">
                        <label>Nội dung</label>
                        <div id="toolbar-container"></div>
                        <div id="editor" style="height: 500px; border-width: 1px; border-style: solid"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Thêm tin tức</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper --> 
@endsection
@section('script')
{{-- <script type="text/javascript" language="javascript" src="admin_assets/ckeditor5-build-decoupled-document/ckeditor.js" ></script> --}}
{{-- <script type="text/javascript" language="javascript" src="admin_assets/ckeditor5-build-classic/ckeditor.js" ></script> --}}
{{-- <script type="text/javascript" language="javascript" src="admin_assets/ckeditor/ckeditor.js" ></script> --}}
<script>

    $(document).ready(function() {
        /*
             DecoupledEditor
        */
        DecoupledEditor.create( document.querySelector( '#editor' ))
        .then( editor => {
            const toolbarContainer = document.querySelector( '#toolbar-container' );
            toolbarContainer.appendChild( editor.ui.view.toolbar.element );
        } )
        .catch( err => {
            console.error( err.stack );
        } );
        
        /*
            Editor Clasical
        */
        // ClassicEditor.create( document.querySelector( '#editor' ), {
        //     toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        //     heading: {
        //         options: [
        //             { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
        //             { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
        //             { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
        //         ]
        //     }
        // } )
        // .catch( error => {
        //     console.log( error );
        // } );


        ////////////////
        //////////////// Call Ajax khi thay đổi thể loại => load lại danh sách loại tin
        ////////////////
        $("#TheLoai").change(function() {
            var idTheLoai =$(this).val();
            console.log('Select theloai id =', idTheLoai);
            $.get("admin/ajax/loaitin/"+idTheLoai, function(data) {
                console.log(data);
                $("#LoaiTin").html(data);
            })
        })
    })
</script>
@endsection