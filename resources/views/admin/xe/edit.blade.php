@extends('layouts.index')

@section('content')
    @include('admin.nav')

    <div class="row mt-4">
        <div class="col-8 offset-2">
            <div class="card rounded-lg border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between align-items-center py-3">
                        <div>
                            <h5 class="card-title">Cập nhật xe <small class="text-muted">{{ $xe->tenxe }}</small></h5>
                        </div>
                        <div>
                            <a href="{{ route('xe.index') }}" class="btn btn-outline-info"><i class="fas fa-list-ul"></i> Danh
                                sách</a>
                        </div>
                    </div>
                    @include('layouts.notification')
                    <form action="{{ route('xe.update', $xe->idxe) }}" class="mb-3" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="loaiXe">Dòng xe</label>
                                <select class="form-control{{ $errors->has('iddongxe') ? ' is-invalid' : '' }}"
                                    name="iddongxe" id="dongXe">
                                    <option selected disabled>Chọn dòng xe</option>
                                    @foreach ($dongXe as $dongXe)
                                        <option value="{{ $dongXe->iddongxe }}"
                                            {{ $xe->iddongxe == $dongXe->iddongxe ? 'selected' : '' }}>
                                            {{ $dongXe->tendongxe }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('iddongxe'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('iddongxe') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <span>Hãng xe</span>
                                <em class="important" aria-label="Required">*</em>
                                <select class="form-control{{ $errors->has('idhangxe') ? ' is-invalid' : '' }}"
                                    name="idhangxe" id="hangXe" onchange="hideErrorAndClass()">
                                    <option selected disabled>Chọn hãng xe</option>
                                    @foreach ($hangXe as $hangXe)
                                        <option value="{{ $hangXe->idhangxe }}"
                                            {{ $xe->idhangxe == $hangXe->idhangxe ? 'selected' : '' }}>
                                            {{ $hangXe->tenhangxe }}</option>
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
                                <label for="tenXe">Tên xe</label>
                                <input type="text" class="form-control{{ $errors->has('tenxe') ? ' is-invalid' : '' }}"
                                    id="tenXe" name="tenxe" placeholder="Nhập tên xe" value="{{ $xe->tenxe }}">

                                @if ($errors->has('tenxe'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tenxe') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row my-2">

                            <div class="col-md-6">
                                <label for="bienSo">Biển số xe</label>
                                <input type="text" class="form-control" id="bienSo" disabled
                                    value="{{ $xe->bienso }}">
                            </div>
                            <div class="col-md-6">
                                <label for="gia">Giá thuê</label>
                                <input type="text" class="form-control{{ $errors->has('gia') ? ' is-invalid' : '' }}"
                                    id="gia" name="gia" placeholder="Nhập giá thuê" value="{{ $xe->gia }}">

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
                                    <option value="Số tự động" {{ $xe->truyendong == 'Số tự động' ? 'selected' : '' }}>Số
                                        tự động</option>
                                    <option value="Số sàn" {{ $xe->truyendong == 'Số sàn' ? 'selected' : '' }}>Số sàn
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nhienLieu">Nhiên liệu</label>
                                <select class="form-control" name="nhienlieu" id="nhienLieu">
                                    <option selected disabled>Chọn nhiên liệu xe</option>
                                    <option value="Xăng" {{ $xe->nhienlieu == 'Xăng' ? 'selected' : '' }}>Xăng</option>
                                    <option value="Điện" {{ $xe->nhienlieu == 'Điện' ? 'selected' : '' }}>Điện</option>
                                    <option value="Dầu" {{ $xe->nhienlieu == 'Dầu' ? 'selected' : '' }}>Dầu</option>

                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="nhienlieutieuhao_km">Nhiên liệu tiêu hao lít/Km</label>
                                <input type="text"
                                    class="form-control{{ $errors->has('nhienlieutieuhao_km') ? ' is-invalid' : '' }}"
                                    id="nhienlieutieuhao_km" name="nhienlieutieuhao_km"
                                    placeholder="Nhập nhiên liệu tiêu hao" value="{{ $xe->nhienlieutieuhao_km }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mieuTa">Miêu tả</label>
                            <textarea class="form-control{{ $errors->has('mieuta') ? ' is-invalid' : '' }}" name="mieuta" id="mieuTa"
                                rows="3" placeholder="Nhập miêu tả">{{ $xe->mieuta }}</textarea>

                            @if ($errors->has('mieuta'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mieuta') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div class="form-group">
                                <label for="inputHinhXe">Chọn hình</label>

                                <input type="file" class="form-control-file" id="inputHinhXe" name="hinhxe"
                                    multiple='multiple'>
                                <div class="preview" style="padding:5px; border: 1px solid black; margin-top: 5px">
                                    @if ($hinhXeArr)
                                        @foreach ($hinhXeArr as $url)
                                            <img src="{{ $url }}" style="width:20%">
                                        @endforeach
                                    @endif

                                </div>
                                <strong class="text-danger">{{ $errors->first('hinhxe') }}</strong>
                            </div>

                        </div>
                        <div class="d-flex flex-row-reverse">
                            <div>
                                <button type="reset" class="btn btn-secondary mr-3"><i class="fas fa-sync-alt"></i> Làm
                                    mới</button>
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Cập
                                    nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
