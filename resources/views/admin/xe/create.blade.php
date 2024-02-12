@extends('layouts.index')

@section('content')
    @include('admin.nav')


    <div class="row mt-4">
        <div class="col-8 offset-2">
            <div class="card rounded-lg border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between align-items-center py-3">
                        <div>
                            <h5 class="card-title">Thêm mới xe</h5>
                        </div>
                        <div>
                            <a href="{{ route('xe.index') }}" class="btn btn-outline-info"><i class="fas fa-list-ul"></i> Danh
                                sách</a>
                        </div>
                    </div>
                    @include('layouts.notification')
                    <form action="{{ route('xe.store') }}" class="mb-3" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <span>Dòng xe</span>
                                <strong class="important" aria-label="Required">(*)</strong>
                                <select class="form-control{{ $errors->has('iddongxe') ? ' is-invalid' : '' }}"
                                    name="iddongxe" id="dongXe" onchange="hideErrorAndClass()">
                                    <option selected disabled>Chọn dòng xe</option>
                                    @foreach ($dongXe as $dongXe)
                                        <option value="{{ $dongXe->iddongxe }}">{{ $dongXe->tendongxe }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('iddongxe'))
                                    <span class="invalid-feedback" role="alert" id="dongxe-error">
                                        <strong>{{ $errors->first('iddongxe') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <span>Hãng xe</span>
                                <strong class="important" aria-label="Required">(*)</strong>
                                <select class="form-control{{ $errors->has('idhangxe') ? ' is-invalid' : '' }}"
                                    name="idhangxe" id="hangXe" onchange="hideErrorAndClass()">
                                    <option selected disabled>Chọn hãng xe</option>
                                    @foreach ($hangXe as $hangXe)
                                        <option value="{{ $hangXe->idhangxe }}">{{ $hangXe->tenhangxe }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->any())
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('idhangxe') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-row my-2">
                            <div class="col-md-12">
                                <span>Tên xe</span>
                                <strong class="important" aria-label="Required">(*)</strong>

                                <input type="text" class="form-control{{ $errors->has('tenxe') ? ' is-invalid' : '' }}"
                                    id="tenXe" name="tenxe" placeholder="Nhập tên xe" value="{{ old('tenxe') }}"
                                    onchange="hideErrorAndClass()">

                                @if ($errors->any())
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tenxe') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row my-2">
                            <div class="col-md-6">
                                <span>Biển số xe</span>
                                <strong class="important" aria-label="Required">(*)</strong>
                                <input type="text" class="form-control{{ $errors->has('bienso') ? ' is-invalid' : '' }}"
                                    id="bienSo" name="bienso" placeholder="Nhập biển số xe" value="{{ old('bienso') }}"
                                    onchange="hideErrorAndClass()">

                                @if ($errors->any())
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bienso') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <span>Giá thuê</span>
                                <strong class="important" aria-label="Required">(*)</strong>
                                <input type="text" class="form-control{{ $errors->has('gia') ? ' is-invalid' : '' }}"
                                    id="giaThue" name="gia" placeholder="Nhập giá thuê" value="{{ old('gia') }}"
                                    onchange="hideErrorAndClass()">

                                @if ($errors->has('gia'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row my-3">
                            <div class="form-group col-md-4">
                                <label for="truyenDong">Truyền động</label>
                                <select class="form-control" name="truyendong" id="truyenDong">
                                    <option selected disabled>Chọn truyền động xe</option>
                                    <option value="Số tự động">Số tự động</option>
                                    <option value="Số sàn">Số sàn</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nhienLieu">Nhiên liệu</label>
                                <select class="form-control" name="nhienlieu" id="nhienLieu">
                                    <option selected disabled>Chọn nhiên liệu xe</option>
                                    <option value="Xăng">Xăng</option>
                                    <option value="Điện">Điện</option>
                                    <option value="Dầu">Dầu</option>

                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="nhienlieutieuhao_km">Nhiên liệu tiêu hao lít/Km</label>
                                <input type="text"
                                    class="form-control{{ $errors->has('nhienlieutieuhao_km') ? ' is-invalid' : '' }}"
                                    id="nhienlieutieuhao_km" name="nhienlieutieuhao_km"
                                    placeholder="Nhập nhiên liệu tiêu hao" value="{{ old('nhienlieutieuhao_km') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <span>Miêu tả</span>
                            <textarea class="form-control{{ $errors->has('mieuta') ? ' is-invalid' : '' }}" name="mieuta" id="moTa"
                                rows="3" placeholder="Nhập miêu tả"></textarea>
                        </div>
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div class="form-group">
                                <span>Chọn hình</span>
                                <strong class="important" aria-label="Required">(*)</strong>
                                <input type="file" class="form-control-file" id="inputHinh" name="hinhxe[]" multiple>

                                <strong class="text-danger">{{ $errors->first('hinhxe') }}</strong>
                                <div id="preview"></div>
                            </div>
                            <div>
                                <button type="reset" class="btn btn-secondary mr-3"><i class="fas fa-sync-alt"></i> Làm
                                    mới</button>
                                <button type="submit" class="btn btn-success btn-add"><i class="fas fa-plus"></i>
                                    Thêm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImages() {
    var preview = document.querySelector('#preview');
    var files   = document.querySelector('input[type=file]').files;

    // Xóa tất cả các phần tử con của phần tử #preview
    while (preview.firstChild) {
        preview.removeChild(preview.firstChild);
    }

    function readAndPreview(file) {
        // Make sure `file` is a `File` object
        if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
            var reader = new FileReader();

            reader.addEventListener("load", function () {
                var imageContainer = document.createElement('div');
                imageContainer.className = 'preview-image-container';

                var image = new Image();
                image.height = 100;
                image.title = file.name;
                image.src = this.result;
                imageContainer.appendChild(image);

                var deleteIcon = document.createElement('span');
                deleteIcon.className = 'delete-icon';
                deleteIcon.innerHTML = '&#10006;'; // Unicode character for "x"
                deleteIcon.addEventListener('click', function() {
                    // Xóa hình ảnh khi biểu tượng "x" được click
                    imageContainer.remove();
                });
                imageContainer.appendChild(deleteIcon);

                preview.appendChild(imageContainer);
            }, false);

            reader.readAsDataURL(file);
        }
    }

    if (files) {
        [].forEach.call(files, readAndPreview);
    }
}

document.querySelector('input[type=file]').addEventListener('change', previewImages);

    </script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>



    <script>
        function hideErrorAndClass() {
            var selectBox = document.getElementById('dongXe');
            selectBox.classList.remove('is-invalid');
            var errorDiv = document.getElementById('dongxe-error');
            if (errorDiv) {
                errorDiv.style.display = 'none';
            }
        }
    </script>
@endsection
