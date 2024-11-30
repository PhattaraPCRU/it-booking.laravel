@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header text-center">
                <h3>ห้องปฏิบัติการ</h3>
            </div>

            <div class="card-body">
                <form id="searchForm" action="{{ route('rooms.search') }}" method="GET" class="mb-4">
                    <div class="row" style="margin-left:43%;">
                        <div class="col-md-3">
                            <select name="roomtype" class="form-control"
                                onchange="document.getElementById('searchForm').submit();">
                                <option value="">-- เลือกประเภทห้อง --</option>
                                @foreach ($roomtypes as $roomtype)
                                    <option value="{{ $roomtype->type_id }}"
                                        {{ request('roomtype') == $roomtype->room_type ? 'selected' : '' }}>
                                        {{ $roomtype->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                <div class="container">
                    <div class="row">
                        @foreach ($rooms as $room)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                <div class="card">
                                    @php
                                        $images = json_decode($room->room_pic, true);
                                        $firstImage = is_array($images) && !empty($images) ? $images[0] : null;
                                    @endphp

                                    @if ($firstImage)
                                        <img src="{{ asset('images/' . $firstImage) }}" alt="Room Image"
                                            style="height: 200px; width: 100%; object-fit: cover;">
                                    @else
                                        <img src="{{ route('room.image', ['filename' => $room->room_pic]) }}"
                                            alt="Default Image" style="height: 200px; width: 100%; object-fit: cover;">
                                    @endif

                                    <div class="card-body">
                                        <h6 class="card-title">ห้อง : {{ $room->room_name }}</h6>
                                        <p class="card-text">
                                            ประเภท : {{ $room->roomtype->name ?? '' }} <br>
                                            ความจุ : {{ $room->capacity }} คน
                                        </p>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#detailRoomModal{{ $room->room_id }}">
                                            รายละเอียด
                                        </button>
                                        <div class="modal fade" id="detailRoomModal{{ $room->room_id }}" tabindex="-1"
                                            aria-labelledby="detailRoomModalLabel{{ $room->room_id }}" aria-hidden="true">
                                            @include('room.detail', ['room' => $room])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.querySelector('select[name="roomtype"]').addEventListener('change', function() {
            document.getElementById('searchForm').submit();
        });
    </script>
@endsection
