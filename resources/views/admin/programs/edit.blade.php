@extends('layouts.main')

@section('title', 'Edit Program')

@section('content')
<div class="container py-5">
    <div class="card col-md-6 mx-auto shadow">
        <div class="card-header bg-warning text-dark fw-bold">Edit Program Pendidikan</div>
        <div class="card-body">
            <form action="{{ route('programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
                @csrf 
                @method('PUT') <div class="mb-3">
                    <label>Nama Program</label>
                    <input type="text" name="title" class="form-control" value="{{ $program->title }}" required>
                </div>
                
                <div class="mb-3">
                    <label>Deskripsi Singkat</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ $program->description }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label>Kode Ikon (FontAwesome)</label>
                    <input type="text" name="icon" class="form-control" value="{{ $program->icon }}" required>
                    <small class="text-muted">Contoh: fas fa-book</small>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Foto-foto Program</label>
                    
                    <div id="image-preview-container" class="d-flex gap-3 mt-2 flex-wrap">
                        
                        @if(!empty($program->images))
                            @foreach($program->images as $img)
                                <div class="position-relative image-wrapper" id="existing-{{ $loop->index }}">
                                    <img src="{{ asset('storage/' . $img) }}" width="120" height="90" style="object-fit: cover;" class="rounded shadow-sm border">
                                    <input type="hidden" name="existing_images[]" value="{{ $img }}">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle" style="transform: translate(30%, -30%); width: 25px; height: 25px; padding: 0; display:flex; align-items:center; justify-content:center;" onclick="removeExistingImage('existing-{{ $loop->index }}')">
                                        <i class="fas fa-times" style="font-size: 12px;"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>

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

    // Fungsi menghapus foto lama (hanya dari tampilan, akan terhapus di DB saat disubmit)
    function removeExistingImage(id) {
        document.getElementById(id).remove();
    }

    // Fungsi saat admin memilih foto baru
    function handleNewImage(input) {
        if (input.files && input.files[0]) {
            let file = input.files[0];
            let reader = new FileReader();

            reader.onload = function(e) {
                let wrapperId = 'new-img-' + newImageIndex;
                
                // Buat kloningan input file untuk dikirim ke server
                let newFileInput = document.createElement('input');
                newFileInput.type = 'file';
                newFileInput.name = 'new_images[]';
                newFileInput.className = 'd-none';
                newFileInput.id = 'input-' + newImageIndex;
                
                // Transfer file ke input baru (Hanya berfungsi di browser modern)
                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                newFileInput.files = dataTransfer.files;
                
                // Masukkan input baru ke dalam form
                document.getElementById('new-inputs-container').appendChild(newFileInput);

                // Buat kotak Preview Gambar
                let previewHtml = `
                    <div class="position-relative image-wrapper" id="${wrapperId}">
                        <img src="${e.target.result}" width="120" height="90" style="object-fit: cover;" class="rounded shadow-sm border border-success">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle shadow" style="transform: translate(30%, -30%); width: 25px; height: 25px; padding: 0; display:flex; align-items:center; justify-content:center;" onclick="removeNewImage('${wrapperId}', ${newImageIndex})">
                            <i class="fas fa-times" style="font-size: 12px;"></i>
                        </button>
                    </div>
                `;
                
                // Tampilkan di layar
                document.getElementById('image-preview-container').insertAdjacentHTML('beforeend', previewHtml);
                
                // Reset input generator agar bisa pilih file lagi
                input.value = '';
                newImageIndex++;
            }

            reader.readAsDataURL(file);
        }
    }

    // Fungsi menghapus preview foto baru
    function removeNewImage(wrapperId, inputIndex) {
        document.getElementById(wrapperId).remove(); // Hapus Preview
        document.getElementById('input-' + inputIndex).remove(); // Hapus File dari Form
    }
</script>
            <div class="mb-3">
                <label class="fw-bold">Penjelasan Lengkap Program</label>
                <textarea name="content" class="form-control" rows="5">{{ $program->content }}</textarea>
            </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('programs.index') }}" class="btn btn-secondary">Batal</a>
                    <button class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection