@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header" align="center">
                <h3>ข้อมูลห้อง</h3>
            </div>
            <div class="card-body">
                <div class="text-end">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createRoomModal">
                        <i class="fas fa-plus"></i> เพิ่มข้อมูล
                    </button>
                </div>
                <div class="modal fade" id="createRoomModal" tabindex="-1" aria-labelledby="createRoomModalLabel"
                    aria-hidden="true">
                    @include('room.create')
                </div>
                <br>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td width="3%" align="center">รหัสห้อง</td>
                            <td width="8%" align="center">ชื่อห้อง</td>
                            <td width="8%" align="center">ประเภทห้อง</td>
                            <td width="8%" align="center">ความจุห้อง</td>
                            <td width="8%" align="center">รูป</td>
                            <td width="8%" align="center">คำอธิบาย</td>
                            <td width="8%" align="center">อุปกรณ์ภายในห้อง</td>
                            <!-- <td width="8%" width="8%">สถานะ</td> -->
                            <td width="3%">Edit</td>
                            <td width="3%" align="center">DELETE</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <td width="3%" align="center">{{ $room->room_id }}</td>
                                <td width="8%" align="center">{{ $room->room_name }}</td>
                                <td width="8%" align="center">{{ $room->roomtype->name }}</td>
                                <td width="8%" align="center">{{ $room->capacity }}</td>
                                <td width="8%" align="center">
                                    @if ($room->room_pic)
                                        @php
                                            $images = json_decode($room->room_pic, true);
                                        @endphp
                                        @if (is_array($images) && !empty($images))
                                            <img src="{{ asset('images/' . $images[0]) }}" alt="Room Image"
                                                style="width:150px;">
                                        @endif
                                    @endif
                                </td>
                                <td width="8%" align="center">{{ $room->description }}</td>
                                <td width="8%" align="center">
                                    <a href="{{ route('room.roomasset', $room->room_id) }}"
                                        class="btn btn-info text-white">
                                        <i class="nav-icon fas fa-laptop"></i> ดูรายละเอียด</a>
                                </td>
                                <td width="3%">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editRoomModal{{ $room->room_id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="modal fade" id="editRoomModal{{ $room->room_id }}" tabindex="-1"
                                        aria-labelledby="editRoomModalLabel{{ $room->room_id }}" aria-hidden="true">
                                        @include('room.edit', ['room' => $room])
                                    </div>
                                </td>
                                <td width="3%" align="center">
                                    <form id="delete-form-{{ $room->room_id }}"
                                        action="{{ route('roomsdestroy', $room->room_id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <a href="{{ route('roomsdestroy', $room->room_id) }}" class="btn btn-danger"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this room?')) { document.getElementById('delete-form-{{ $room->room_id }}').submit(); }">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
