@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header" align="center">
                <h3>กลุ่มอุปกรณ์</h3>
            </div>
            <div class="card-body" width="100%">
                <div class="text-end">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#assetGroupCModal">
                        <i class="fas fa-plus"></i> เพิ่มข้อมูล
                    </button>
                </div>
                <div class="modal fade" id="assetGroupCModal" tabindex="-1" aria-labelledby="assetGroupCModalLabel"
                    aria-hidden="true">
                    @include('assetgroup.create')
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อ</th>
                            <th>ประเภทอุปกรณ์</th>
                            <th>สถานะ</th>
                            <th>ข้อมูล</th>
                            <th width="15%">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assetGroups as $assetGroup)
                            <tr>
                                <td>{{ $assetGroup->group_id }}</td>
                                <td>{{ $assetGroup->group_name }}</td>
                                <td>{{ $assetGroup->assetType->type_name }}</td>
                                <td>{!! $assetGroup->group_status
                                    ? '<span class="badge badge text-white bg-success">เปิดใช้งาน</span>'
                                    : '<span class="badge badge text-white bg-danger">ปิดใช้งาน</span>' !!}</td>
                                <td>{{ $assetGroup->specifications }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editassetGroupModal{{ $assetGroup->group_id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="modal fade" id="editassetGroupModal{{ $assetGroup->group_id }}"
                                        tabindex="-1" aria-labelledby="editassetGroupModalLabel{{ $assetGroup->group_id }}"
                                        aria-hidden="true">
                                        @include('assetgroup.edit', ['assetGroup' => $assetGroup])
                                    </div>
                                    <form action="{{ route('assetgroup.destroy', $assetGroup->group_id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
