@extends('layouts.main')
@section('content')
<div class="container py-5">
    <div class="card col-md-6 mx-auto shadow">
        <div class="card-header bg-primary text-white">Tambah Program</div>
        <div class="card-body">
            <form action="{{ route('programs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Nama Program</label>
                    <input type="text" name="title" class="form-control" required placeholder="Misal: Madrasah Diniyah">
                </div>
                <div class="mb-3">
                    <label>Deskripsi Singkat</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Kode Ikon (FontAwesome)</label>
                    <input type="text" name="icon" class="form-control" required placeholder="fas fa-book">
                    <small class="text-muted">Cari kode ikon di <a href="https://fontawesome.com/search?m=free" target="_blank">FontAwesome</a></small>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Foto-foto Program</label>
                    <div id="image-preview-container" class="d-flex gap-3 mt-2 flex-wrap"></div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-outline-primary btn-sm fw-bold" onclick="document.getElementById('file-input-generator').click()">
                            <i class="fas fa-plus me-1"></i> Tambah Foto
                        </button>
                        <small class="text-muted ms-2">Bisa pilih satu per satu. Maks 2MB/foto.</small>
                        <input type="file" id="file-input-generator" accept="image/*" class="d-none" onchange="handleNewImage(this)">
                    </div>
                    <div id="new-inputs-container" class="d-none"></div>
                </div>

<script>
    let newImageIndex = 0;
    function handleNewImage(input) {
        if (input.files && input.files[0]) {
            let file = input.files[0];
            let reader = new FileReader();
            reader.onload = function(e) {
                let wrapperId = 'new-img-' + newImageIndex;
                let newFileInput = document.createElement('input');
                newFileInput.type = 'file';
                newFileInput.name = 'new_images[]';
                newFileInput.className = 'd-none';
                newFileInput.id = 'input-' + newImageIndex;
                
                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                newFileInput.files = dataTransfer.files;
                document.getElementById('new-inputs-container').appendChild(newFileInput);

                let previewHtml = `
                    <div class="position-relative image-wrapper" id="${wrapperId}">
                        <img src="${e.target.result}" width="120" height="90" style="object-fit: cover;" class="rounded shadow-sm border border-success">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle shadow" style="transform: translate(30%, -30%); width: 25px; height: 25px; padding: 0; display:flex; align-items:center; justify-content:center;" onclick="removeNewImage('${wrapperId}', ${newImageIndex})">
                            <i class="fas fa-times" style="font-size: 12px;"></i>
                        </button>
                    </div>`;
                document.getElementById('image-preview-container').insertAdjacentHTML('beforeend', previewHtml);
                input.value = '';
                newImageIndex++;
            }
            reader.readAsDataURL(file);
        }
    }
    function removeNewImage(wrapperId, inputIndex) {
        document.getElementById(wrapperId).remove();
        document.getElementById('input-' + inputIndex).remove();
    }
</script>
                <div class="mb-3">
                    <label class="fw-bold">Penjelasan Lengkap Program</label>
                    <textarea name="content" class="form-control" rows="5" placeholder="Tuliskan informasi lengkap tentang program ini..."></textarea>
                </div>
                <button class="btn btn-success w-100">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection