@extends('layouts.seller')

@section('title', 'Posting Produk')

@section('content')
<style>
.product-create{--ink:#30251f;--muted:#81736b;--line:#eadfd7;--accent:#8b5e45;max-width:1120px;margin:0 auto;padding-bottom:36px;color:var(--ink)}
.product-create *{box-sizing:border-box}
.product-create .hero{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:24px}
.product-create .eyebrow{display:inline-block;background:#f5ece5;border:1px solid #ead9cd;border-radius:999px;padding:6px 11px;color:var(--accent);font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:12px}
.product-create h1{margin:0;font-size:clamp(25px,3vw,34px);letter-spacing:-.04em;line-height:1.15}
.product-create .hero p{margin:9px 0 0;color:var(--muted);font-size:14px;line-height:1.6}
.product-create .step{display:flex;align-items:center;gap:10px;padding:11px 14px;border:1px solid var(--line);border-radius:14px;background:#fffdfb;color:var(--muted);font-size:12px;font-weight:700}
.product-create .step strong{display:grid;place-items:center;width:28px;height:28px;border-radius:9px;background:var(--accent);color:white}
.product-create .alert{border:1px solid #efc9c1;background:#fff5f2;color:#8c382d;border-radius:14px;padding:15px 18px;margin-bottom:20px;font-size:13px}
.product-create .alert strong{display:block;margin-bottom:6px}.product-create .alert ul{margin:0;padding-left:19px;line-height:1.7}
.product-create .card{background:#fffdfb;border:1px solid var(--line);border-radius:20px;box-shadow:0 12px 34px rgba(66,43,29,.055);overflow:hidden}
.product-create .card-head{display:flex;align-items:flex-start;gap:13px;padding:22px 25px;border-bottom:1px solid #f0e8e2;background:linear-gradient(110deg,#fffaf6,#fffdfb 72%)}
.product-create .card-icon{display:grid;place-items:center;width:42px;height:42px;flex:0 0 auto;border-radius:13px;background:#f2e6dc;color:var(--accent);font-size:20px}
.product-create .card-head h2{margin:1px 0 4px;font-size:17px}.product-create .card-head p{margin:0;color:var(--muted);font-size:12px;line-height:1.6}
.product-create .form{padding:25px}.product-create .section+.section{border-top:1px solid #f0e8e2;margin-top:27px;padding-top:25px}
.product-create .section-title{display:flex;align-items:center;gap:9px;margin:0 0 17px;color:#5b4436;font-size:13px;font-weight:800}
.product-create .section-title span{display:grid;place-items:center;width:25px;height:25px;border-radius:8px;background:#f5eee8;color:var(--accent);font-size:12px}
.product-create .grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px 20px}.product-create .field{min-width:0}.product-create .field.full{grid-column:1/-1}
.product-create label{display:flex;gap:5px;margin-bottom:8px;color:#49382e;font-size:12px;font-weight:800}.product-create .required{color:#b44e3d}
.product-create input:not([type=file]),.product-create select,.product-create textarea{display:block;width:100%;min-height:46px;border:1px solid #e5d9d0;border-radius:11px;padding:11px 13px;background:#fff;color:var(--ink);font:inherit;font-size:13px;outline:none;transition:border-color .18s,box-shadow .18s}
.product-create textarea{min-height:130px;resize:vertical;line-height:1.65}.product-create input::placeholder,.product-create textarea::placeholder{color:#b2a59d}
.product-create input:not([type=file]):focus,.product-create select:focus,.product-create textarea:focus{border-color:#ad8064;box-shadow:0 0 0 3px rgba(139,94,69,.12);background:#fffdfa}
.product-create .help{display:block;margin-top:7px;color:#91837a;font-size:11px;line-height:1.6}
.product-create .upload{border:1.5px dashed #d9c5b6;border-radius:14px;padding:20px;background:#fffaf6}
.product-create .upload-top{display:flex;align-items:center;gap:13px;margin-bottom:13px}.product-create .upload-icon{display:grid;place-items:center;width:42px;height:42px;border-radius:12px;background:#f0e2d7;color:var(--accent);font-size:20px}
.product-create .upload-top strong{display:block;font-size:12px;margin-bottom:4px}.product-create .upload-top small{display:block;color:var(--muted);font-size:11px}
.product-create input[type=file]{width:100%;padding:10px;border:1px solid #e7dcd4;border-radius:10px;background:#fff;color:#78685e;font-size:12px}
.product-create input[type=file]::file-selector-button{border:0;border-radius:7px;padding:8px 11px;margin-right:10px;background:#efe3d9;color:#704832;font-size:11px;font-weight:800;cursor:pointer}
.product-create .preview{display:grid;grid-template-columns:repeat(auto-fill,minmax(88px,1fr));gap:10px;margin-top:13px}
.product-create .preview img{width:100%;height:88px;object-fit:cover;border-radius:10px;border:1px solid var(--line);background:#fff}
.product-create .actions{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:27px;padding-top:20px;border-top:1px solid #f0e8e2}
.product-create .actions-note{color:#94867d;font-size:11px}.product-create .buttons{display:flex;gap:10px}
.product-create .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:43px;border:1px solid transparent;border-radius:10px;padding:0 17px;text-decoration:none;font-size:12px;font-weight:800;cursor:pointer;transition:transform .18s,background .18s}
.product-create .btn:hover{transform:translateY(-1px)}.product-create .btn-primary{background:var(--accent);color:#fff;box-shadow:0 6px 14px rgba(112,72,50,.16)}.product-create .btn-primary:hover{background:#704832}
.product-create .btn-secondary{background:#fff;border-color:#e5d9d0;color:#6f5b4e}.product-create .btn-secondary:hover{background:#faf4ef}
@media(max-width:700px){.product-create .hero{align-items:flex-start;flex-direction:column}.product-create .step{align-self:flex-start}.product-create .card-head,.product-create .form{padding:18px}.product-create .grid{grid-template-columns:1fr;gap:16px}.product-create .field.full{grid-column:auto}.product-create .actions{align-items:stretch;flex-direction:column}.product-create .buttons{width:100%}.product-create .btn{flex:1}}
</style>

<div class="product-create">
    <header class="hero">
        <div>
            <span class="eyebrow">Katalog Toko PinTa</span>
            <h1>Posting Produk</h1>
            <p>Isi detail produk dengan jelas agar calon pembeli lebih mudah mengenalinya.</p>
        </div>
        <div class="step"><strong>1</strong><span>Informasi produk</span></div>
    </header>

    @if ($errors->any())
        <div class="alert" role="alert">
            <strong>Periksa kembali data yang kamu masukkan.</strong>
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <section class="card">
        <div class="card-head">
            <div class="card-icon" aria-hidden="true">✦</div>
            <div>
                <h2>Informasi Produk</h2>
                <p>Lengkapi informasi di bawah ini. Kolom bertanda <span style="color:#b44e3d">*</span> wajib diisi.</p>
            </div>
        </div>

        <form class="form" action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="section">
                <h3 class="section-title"><span>01</span> Identitas produk</h3>
                <div class="grid">
                    <div class="field">
                        <label for="title">Nama Produk <span class="required">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" maxlength="150" required placeholder="Contoh: Kamera Canon EOS M10">
                    </div>
                    <div class="field">
                        <label for="category_id">Kategori Produk <span class="required">*</span></label>
                        <select name="category_id" id="category_id" required>
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field full">
                        <label for="description">Deskripsi Produk <span class="required">*</span></label>
                        <textarea name="description" id="description" rows="5" required placeholder="Ceritakan kondisi, spesifikasi, kelengkapan, dan detail penting lainnya...">{{ old('description') }}</textarea>
                        <small class="help">Deskripsi yang lengkap membantu pembeli memahami produk sebelum menghubungimu.</small>
                    </div>
                </div>
            </div>

            <div class="section">
                <h3 class="section-title"><span>02</span> Kondisi dan lokasi</h3>
                <div class="grid">
                    <div class="field">
                        <label for="item_condition">Kondisi Barang <span class="required">*</span></label>
                        <select name="item_condition" id="item_condition" required>
                            <option value="">Pilih kondisi</option>
                            <option value="like_new" {{ old('item_condition') == 'like_new' ? 'selected' : '' }}>Like New</option>
                            <option value="good" {{ old('item_condition') == 'good' ? 'selected' : '' }}>Good</option>
                            <option value="fair" {{ old('item_condition') == 'fair' ? 'selected' : '' }}>Fair</option>
                            <option value="needs_repair" {{ old('item_condition') == 'needs_repair' ? 'selected' : '' }}>Needs Repair</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="location">Lokasi Barang <span class="required">*</span></label>
                        <input type="text" name="location" id="location" maxlength="150" value="{{ old('location') }}" required placeholder="Contoh: Palembang, Sumatera Selatan">
                    </div>
                </div>
            </div>

            <div class="section">
                <h3 class="section-title"><span>03</span> Harga dan metode penjualan</h3>
                <div class="grid">
                    <div class="field">
                        <label for="sale_mode">Mode Penjualan <span class="required">*</span></label>
                        <select name="sale_mode" id="sale_mode" required>
                            <option value="">Pilih mode penjualan</option>
                            <option value="direct" {{ old('sale_mode') == 'direct' ? 'selected' : '' }}>Direct (Jual Langsung)</option>
                            <option value="auction" {{ old('sale_mode') == 'auction' ? 'selected' : '' }}>Auction (Lelang)</option>
                            <option value="barter" {{ old('sale_mode') == 'barter' ? 'selected' : '' }}>Barter (Tukar Barang)</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="price">Harga Produk (Rp)</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" min="0" step="0.01" placeholder="Contoh: 150000">
                        <small class="help">Wajib untuk penjualan langsung dan lelang. Untuk barter, harga boleh dikosongkan.</small>
                    </div>
                </div>
            </div>

            <div class="section">
                <h3 class="section-title"><span>04</span> Foto produk</h3>
                <div class="field">
                    <label for="images">Foto Produk <span class="required">*</span></label>
                    <div class="upload">
                        <div class="upload-top">
                            <div class="upload-icon" aria-hidden="true">▧</div>
                            <div><strong>Tambahkan foto terbaik produkmu</strong><small>Pilih satu atau beberapa gambar sekaligus.</small></div>
                        </div>
                        <input type="file" name="images[]" id="images" accept="image/jpeg,image/png,image/webp" multiple required>
                        <small class="help">Maksimal 5 gambar, masing-masing maksimal 2 MB. Gambar pertama akan menjadi foto utama.</small>
                        <div class="preview" id="image-preview" aria-live="polite"></div>
                    </div>
                </div>
            </div>

            <div class="actions">
                <span class="actions-note"><span class="required">*</span> Pastikan informasi produk sudah benar sebelum disimpan.</span>
                <div class="buttons">
                    <a href="{{ route('seller.products.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Produk <span aria-hidden="true">→</span></button>
                </div>
            </div>
        </form>
    </section>
</div>

<script>
(function () {
    const input = document.getElementById('images');
    const preview = document.getElementById('image-preview');
    if (!input || !preview) return;

    input.addEventListener('change', function () {
        preview.innerHTML = '';
        Array.from(input.files || []).slice(0, 5).forEach(function (file) {
            if (!file.type.startsWith('image/')) return;
            const image = document.createElement('img');
            const reader = new FileReader();
            reader.onload = function (event) {
                image.src = event.target.result;
                image.alt = file.name;
            };
            reader.readAsDataURL(file);
            preview.appendChild(image);
        });
    });
})();
</script>
@endsection
