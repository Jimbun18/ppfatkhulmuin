@extends('layouts.main')

@section('title', 'Donasi Pesantren')

@section('content')
<div class="container py-5">
    
    <a href="/" class="btn btn-outline-success mb-4 rounded-pill btn-sm fw-bold">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
    </a>

    <div class="text-center mb-5">
        <small class="text-success fw-bold text-uppercase ls-1">Mari Berbagi</small>
        <h2 class="fw-bold text-nu display-6 mb-3 font-serif">Salurkan Donasi Anda</h2>
        <div style="width: 80px; height: 4px; background: #ffc107; margin: 0 auto;"></div>
    </div>

    <div class="row g-4 align-items-stretch justify-content-center">
        <div class="col-md-5">
            <div class="bg-nu text-white p-4 p-md-5 rounded-4 h-100 shadow">
                <h4 class="fw-bold mb-4 font-serif">Rekening Donasi</h4>
                
                @php
                    // Memecah No Rekening dan Atas Nama menggunakan tanda |
                    $rek1 = explode('|', $rekening_1->content ?? '7123 4567 8900|A.N YAYASAN PP FATHUL MU\'IN');
                    $rek2 = explode('|', $rekening_2->content ?? '1234 0100 9999 501|A.N PEMBANGUNAN MASJID');
                @endphp

                <div class="bg-white bg-opacity-10 p-4 rounded-3 mb-3 border border-light border-opacity-25">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-university fa-2x me-3 text-white"></i>
                        <div>
                            <small class="opacity-75 d-block">{{ $rekening_1->title ?? 'Bank Syariah Indonesia (BSI)' }}</small>
                            <h3 class="fw-bold mb-0" style="letter-spacing: 2px;">{{ $rek1[0] ?? '-' }}</h3>
                            <small class="text-warning fw-bold">{{ $rek1[1] ?? '-' }}</small>
                        </div>
                    </div>
                </div>

                <div class="bg-white bg-opacity-10 p-4 rounded-3 border border-light border-opacity-25">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-university fa-2x me-3 text-white"></i>
                        <div>
                            <small class="opacity-75 d-block">{{ $rekening_2->title ?? 'Bank BRI' }}</small>
                            <h3 class="fw-bold mb-0" style="letter-spacing: 2px;">{{ $rek2[0] ?? '-' }}</h3>
                            <small class="text-warning fw-bold">{{ $rek2[1] ?? '-' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="bg-white p-4 p-md-5 rounded-4 h-100 shadow border">
                <h4 class="fw-bold mb-4 font-serif">Konfirmasi Donasi</h4>
                
                <form id="formDonasi">
                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold">Nama Donatur</label>
                        <input type="text" id="namaDonatur" class="form-control form-control-lg bg-light border-0" placeholder="Masukkan nama Anda" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold">Tujuan Donasi</label>
                        <select id="tujuanDonasi" class="form-select form-select-lg bg-light border-0">
                            <option value="Pembangunan Fisik">Pembangunan Fisik</option>
                            <option value="Operasional Pesantren">Operasional Pesantren</option>
                            <option value="Beasiswa Santri">Beasiswa Santri</option>
                            <option value="Infaq / Sedekah Umum">Infaq / Sedekah Umum</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small text-muted fw-bold">Nominal Donasi (Rp)</label>
                        <input type="number" id="nominalDonasi" class="form-control form-control-lg bg-light border-0" placeholder="Contoh: 500000" required>
                    </div>

                    <button type="button" onclick="kirimKonfirmasiWA()" class="btn btn-warning btn-lg w-100 fw-bold shadow-sm text-dark mt-2">
                        <i class="fab fa-whatsapp fs-5 me-2"></i> Konfirmasi via WA
                    </button>
                    <small class="d-block text-center text-muted mt-3">
                        Anda akan diarahkan ke WhatsApp Admin untuk mengirim bukti transfer.
                    </small>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function kirimKonfirmasiWA() {
    var nama = document.getElementById('namaDonatur').value;
    var tujuan = document.getElementById('tujuanDonasi').value;
    var nominal = document.getElementById('nominalDonasi').value;

    if(!nama || !nominal) {
        alert('Mohon isi Nama Donatur dan Nominal Donasi terlebih dahulu.');
        return;
    }

    // Format Rupiah
    var formatRupiah = new Intl.NumberFormat('id-ID').format(nominal);

    // Nomor WA Admin PP Fathul Mu'in
    var noWA = "6285727777834"; 

    // Pesan
    var pesan = "Assalamu'alaikum Admin,\n\nSaya ingin mengkonfirmasi donasi dengan rincian berikut:\n\n" +
                "👤 *Nama*: " + nama + "\n" +
                "🎯 *Tujuan*: " + tujuan + "\n" +
                "💰 *Nominal*: Rp " + formatRupiah + "\n\n" +
                "Berikut saya lampirkan foto bukti transfernya. Terima kasih.";

    // Arahkan ke WA
    window.open("https://api.whatsapp.com/send?phone=" + noWA + "&text=" + encodeURIComponent(pesan), '_blank');
}
</script>
@endsection