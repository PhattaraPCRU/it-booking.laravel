<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editassetTypeModalLabel">แก้ไขข้อมูลห้อง</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('assettype.update', $assetType->type_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="type_name">Type Name:</label>
                    <input type="text" name="type_name" id="type_name" class="form-control"
                        value="{{ $assetType->type_name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control">{{ $assetType->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="1" {{ $assetType->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $assetType->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
