<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title " id="reviewRoomModalLabel">
                พิจารณาการจองห้อง
                {{-- booking_id {{ $booking->booking_id }}
                 / review_status: <spanid="currentReviewStatus">{{ $booking->review_status }}</spanid=> --}}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="reviewForm" action="{{ route('booking.review', $booking->booking_id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row mb-3">
                    <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12">
                        <input type="hidden" name="id" value="{{ $booking->booking_id }}" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- <label for="review_status" class="form-label">ผลการพิจารณา</label> --}}
                    <div class="form-group clearfix">
                        @foreach ($reviewConfig['label'] as $value => $label)
                            @if ($value != '0')
                                @php
                                    $checked = $booking->review_status == $value ? 'checked' : '';
                                    $colorClass = isset($reviewConfig['color'][$value])
                                        ? 'icheck-' . $reviewConfig['color'][$value]
                                        : 'icheck-primary';
                                @endphp
                                <div class="{{ $colorClass }} d-inline ml-2" style="margin-right: 30px;">
                                    <input type="radio" id="review_status{{ $loop->index }}" name="review_status"
                                        value="{{ $value }}" {{ $checked }}>
                                    <label for="review_status{{ $loop->index }}">&nbsp;{{ $label }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ตรวจสอบการเปลี่ยนแปลงของ radio button ที่ชื่อ review_status
        document.querySelectorAll('input[name="review_status"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                // เมื่อมีการเปลี่ยนแปลง ให้แสดงค่าที่เลือกแบบเรียลไทม์
                document.getElementById('currentReviewStatus').textContent = this.value;
            });
        });
    });
</script>
<script>
    document.getElementById('reviewForm').addEventListener('submit', function(e) {
        e.preventDefault(); // ป้องกันการ submit ทันที

        let form = this;
        Swal.fire({
            title: 'ยืนยันการบันทึกข้อมูล?',
            text: "คุณต้องการบันทึกข้อมูลการพิจารณาการจองห้องหรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // ถ้าผู้ใช้ยืนยัน ให้ทำการ submit form
            }
        })
    });

    @if (session('success'))
        Swal.fire({
            title: 'สำเร็จ!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'ตกลง'
        });
    @endif

    @if (session('error'))
        Swal.fire({
            title: 'เกิดข้อผิดพลาด!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'ตกลง'
        });
    @endif
</script>
