<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editassetLocationModalLabel">แก้ไขข้อมูลประเภทอุปกรณ์</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('assetlocation.update', $assetLocation->location_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="asset_id">รหัสอุปกรณ์วิชาการ</label>
                    <select name="asset_id" id="asset_id" class="form-control" required>
                        @foreach ($assets as $asset)
                            <option value="{{ $asset->asset_id }}"
                                {{ $asset->asset_id == $assetLocation->asset_id ? 'selected' : '' }}>
                                {{ $asset->asset_ac_id }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="room_id">ห้อง</label>
                    <select name="room_id" id="room_id" class="form-control" required>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->room_id }}"
                                {{ $room->room_id == $assetLocation->room_id ? 'selected' : '' }}>
                                {{ $room->room_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="department_id">หน่วยงาน</label>
                    <select name="department_id" id="department_id" class="form-control" required>
                        <option value="" disabled selected>เลือกหน่วยงาน</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->department_id }}"
                                data-department-code="{{ $department->department_code }}"
                                {{ $department->department_id == $assetLocation->department_id ? 'selected' : '' }}>
                                {{ $department->department_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="sect_id">หน่วยงานย่อย</label>
                    <select name="sect_id" id="sect_id" class="form-control" required>
                        <option value="">เลือกหน่วยงานย่อย</option> <!-- เพิ่มตัวเลือกว่าง -->
                        @foreach ($sects as $section)
                            <option value="{{ $section->sect_id }}"
                                {{ $section->sect_id == $assetLocation->sect_id ? 'selected' : '' }}>
                                {{ $section->sect_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <script>
                    $(document).ready(function() {
                        var initialDepartmentCode = $('#department_id').find(':selected').data('department-code');
                        var initialSectId = "{{ isset($assetLocation) ? $assetLocation->sect_id : '' }}";

                        // หากมีค่า initialDepartmentCode แล้วให้ทำการโหลดข้อมูลหน่วยงานย่อย
                        if (initialDepartmentCode) {
                            loadSects(initialDepartmentCode, initialSectId);
                            $('#sect_id').prop('disabled', false);
                        }

                        $('#department_id').on('change', function() {
                            var departmentCode = $(this).find(':selected').data('department-code');

                            if (departmentCode) {
                                $('#sect_id').prop('disabled', false);
                                loadSects(departmentCode);
                            } else {
                                $('#sect_id').prop('disabled', true).empty().append(
                                    '<option value="" disabled selected>เลือกหน่วยงานย่อย</option>'
                                );
                            }
                        });

                        function loadSects(departmentCode, selectedSectId = null) {
                            $.ajax({
                                url: '/fetch-sects/' + departmentCode,
                                type: 'GET',
                                success: function(data) {
                                    $('#sect_id').empty().append(
                                        '<option value="" disabled selected>เลือกหน่วยงานย่อย</option>'
                                    );

                                    $.each(data, function(key, sect) {
                                        $('#sect_id').append('<option value="' + sect.sect_id + '"' +
                                            (sect.sect_id == selectedSectId ? ' selected' : '') +
                                            '>' + sect.sect_name + '</option>');
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error('เกิดข้อผิดพลาดในการดึงข้อมูลหน่วยงานย่อย');
                                }
                            });
                        }
                    });
                </script>


                {{-- <script>
                    $(document).ready(function() {
                        $('#department_id').change(function() {
                            var department_code = $(this).find(':selected').data(
                                'department-code'); // ดึง department_code จาก attribute data-department-code
                            var _token = $('meta[name="csrf-token"]').attr('content'); // ดึง CSRF token จาก meta tag

                            if (department_code) {
                                $.ajax({
                                    url: "/fetch-sects/" + department_code, // ส่ง department_code ผ่าน URL
                                    method: "POST",
                                    headers: {
                                        'X-CSRF-TOKEN': _token // ส่ง CSRF token ใน header
                                    },
                                    success: function(result) {
                                        // รีเซ็ตตัวเลือกใน dropdown ของ sect_id
                                        $('#sect_id').html(
                                            '<option value="" disabled selected>เลือกหน่วยงานย่อย</option>'
                                        );
                                        $.each(result, function(index, sect) {
                                            $('#sect_id').append('<option value="' + sect.sect_id +
                                                '">' + sect.sect_name + '</option>');
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('เกิดข้อผิดพลาดในการดึงข้อมูลหน่วยงานย่อย');
                                    }
                                });
                            } else {
                                $('#sect_id').html('<option value="" disabled selected>เลือกหน่วยงานย่อย</option>');
                            }
                        });
                    });
                </script> --}}





                <div class="form-group mb-3">
                    <label for="location_type">ประเภทสถานที่</label>
                    <select name="location_type" id="location_type" class="form-control" required>
                        <option value="room">room</option>
                        <option value="outside">outside</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="is_current">Is Current:</label>
                    <select name="is_current" id="is_current" class="form-control" required>
                        <option value="1" {{ $assetLocation->is_current == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $assetLocation->is_current == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
            </form>
        </div>
    </div>
</div>
{{-- <script>
    $(document).ready(function() {
        $('#sect_id').select2({
            placeholder: "เลือกหน่วยงานย่อย",
            allowClear: true // เพิ่มปุ่มลบการเลือก
        });
    });
</script> --}}
