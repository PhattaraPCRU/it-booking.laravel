<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="detailRoomModalLabel">รายละเอียดห้อง {{ $room->room_name }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="lightgallery-{{ $room->room_id }}" class="grid-gallery">
                @if ($room->room_pic)
                    @php
                        $images = json_decode($room->room_pic, true);
                    @endphp
                    @if (is_array($images) && !empty($images))
                        @foreach ($images as $image)
                            <a href="{{ asset('images/' . $image) }}" class="gallery-item">
                                <img src="{{ asset('images/' . $image) }}" alt="Room Image">
                            </a>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    #lightgallery-{{ $room->room_id }} {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }

    .gallery-item {
        display: block;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    .grid-gallery {
        padding: 20px;
    }
</style>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($rooms as $room)
            $('#detailRoomModalLabel').on('shown.bs.modal', function() {
                const galleryElement = document.getElementById('lightgallery-{{ $room->room_id }}');
                if (!galleryElement.getAttribute('data-lg-initialized')) {
                    lightGallery(galleryElement, {
                        selector: '.gallery-item',
                        mode: 'lg-fade',
                        download: true,
                        thumbnail: true,
                    });
                    galleryElement.setAttribute('data-lg-initialized', 'true');
                }
            });
        @endforeach
    });
</script>
