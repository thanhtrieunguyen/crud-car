@extends('layouts.index')

@section('content')
    @include('admin.nav')

    <div class="row mt-4">
        <div class="col-12">
            <div class="card rounded-lg border-0 shadow-sm">
                <div class="card-body">
                    @include('layouts.notification')
                    <div class="d-flex flex-row justify-content-between align-items-center py-3">
                        <div>
                            <h5 class="card-title">Danh sách xe <span class="text-muted">({{ $xes->count() }} xe)</span></h5>
                        </div>
                        <div>
                            <a href="{{ route('xe.create') }}" class="btn btn-success "><i class="fas fa-plus"></i>
                                Thêm</a>
                        </div>
                    </div>
                    <table id="myTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col" colspan="2">Hình</th>
                                <th scope="col">Tên xe</th>
                                <th scope="col">Biển số</th>
                                <th scope="col">Giá thuê</th>
                                <th scope="col">Dòng xe</th>
                                <th scope="col">Hãng xe</th>
                                <th scope="col" class="text-center">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $dem = 0;
                            @endphp
                            @forelse ($xes as $xe)
                                <tr>
                                    <th scope="row">{{ ++$dem }}</th>
                                    <td class="justify-content-lg-center" style="height: 60px; width: 120px ">
                                        @php
                                            $array = json_decode($xe->hinhxe->hinhxe);
                                            $img1 = isset($array[0]) ? $array[0] : null;
                                        @endphp
                                        <div style="display: flex flex-row  ">
                                            <img src="{{ $img1 }}" class="img-fluid" alt="{{ $xe->tenxe }}">
                                        </div>
                                    </td>
                                    <td class="justify-content-lg-center" style="height: 60px; width: 120px">
                                        @php
                                            $img2 = isset($array[1]) ? $array[1] : null;
                                        @endphp
                                        <div style="display: flex flex-row  ">
                                            <img src="{{ $img2 }}" class="img-fluid" alt="{{ $xe->tenxe }}">
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ url('xe', $xe->idxe) }}">
                                            {{ $xe->tenxe }}
                                        </a>
                                    </td>
                                    <td>{{ $xe->bienso }}</td>
                                    <td>{{ number_format($xe->gia) }} đồng</td>
                                    <td>{{ $xe->dongXe->tendongxe }}</td>
                                    <td>{{ $xe->hangXe->tenhangxe }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('xe.edit', $xe->idxe) }}"
                                            class="text-primary mr-3 fa fa-edit">Cập
                                            nhật</a>
                                        <a href="#" class="text-danger js_btn_xoa_xe fa fa-trash"
                                            xe-id="{{ $xe->idxe }}">Xóa</a>
                                        <form id="js_form_xoa_xe_{{ $xe->idxe }}"
                                            action="{{ route('xe.destroy', $xe->idxe) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.js_btn_xoa_xe', function(e) {
                e.preventDefault();
                let id = $(this).attr('xe-id');
                if (confirm('Bạn có chắc chắn?')) {
                    $(`#js_form_xoa_xe_${id}`).submit();
                }
            });
        });
    </script>
@endsection
