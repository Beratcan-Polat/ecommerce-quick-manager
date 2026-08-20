<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hızlı Ürün & Stok Yönetim Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>

    <nav class="navbar navbar-dark bg-dark py-3 mb-4">
        <div class="container">
            <span class="navbar-brand navbar-brand-custom">
                <i class="bi bi-box-seam me-2"></i>Catalog Quick Manager
            </span>
            <span class="text-light small">E-Ticaret Ürün Yönetim Paneli</span>
        </div>
    </nav>

    <div class="container mb-5">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <i class="bi bi-plus-circle me-1"></i> Yeni Ürün Ekle
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Ürün Adı</label>
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" placeholder="Ör: Kablosuz Mouse">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sku" class="form-label">Stok Kodu (SKU)</label>
                                <input type="text" name="sku" id="sku"
                                       class="form-control @error('sku') is-invalid @enderror"
                                       value="{{ old('sku') }}" placeholder="Ör: SKU-001">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select name="category" id="category"
                                        class="form-select @error('category') is-invalid @enderror">
                                    <option value="">-- Kategori Seçin --</option>
                                    <option value="Elektronik" {{ old('category') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                    <option value="Giyim" {{ old('category') == 'Giyim' ? 'selected' : '' }}>Giyim</option>
                                    <option value="Ev & Yaşam" {{ old('category') == 'Ev & Yaşam' ? 'selected' : '' }}>Ev & Yaşam</option>
                                    <option value="Spor" {{ old('category') == 'Spor' ? 'selected' : '' }}>Spor</option>
                                    <option value="Kitap" {{ old('category') == 'Kitap' ? 'selected' : '' }}>Kitap</option>
                                    <option value="Oyuncak" {{ old('category') == 'Oyuncak' ? 'selected' : '' }}>Oyuncak</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Fiyat (₺)</label>
                                <input type="number" name="price" id="price" step="0.01" min="0"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price') }}" placeholder="Ör: 149.99">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="stock" class="form-label">Stok Adedi</label>
                                <input type="number" name="stock" id="stock" min="0"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ old('stock') }}" placeholder="Ör: 50">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-save me-1"></i> Ürünü Kaydet
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-table me-1"></i> Ürün Listesi</span>
                        <span class="badge bg-light text-dark">{{ $products->count() }} ürün</span>
                    </div>
                    <div class="card-body p-0">
                        @if($products->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Ürün Adı</th>
                                            <th>SKU</th>
                                            <th>Kategori</th>
                                            <th>Fiyat</th>
                                            <th>Stok Durumu</th>
                                            <th class="text-center">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $index => $product)
                                            <tr>
                                                <td class="text-muted">{{ $index + 1 }}</td>
                                                <td class="fw-semibold">{{ $product->name }}</td>
                                                <td><code>{{ $product->sku }}</code></td>
                                                <td>{{ $product->category }}</td>
                                                <td>{{ number_format($product->price, 2, ',', '.') }} ₺</td>
                                                <td>
                                                    @if($product->stock > 0)
                                                        <span class="badge badge-stock-in">
                                                            Stokta ({{ $product->stock }} adet)
                                                        </span>
                                                    @else
                                                        <span class="badge badge-stock-out">
                                                            Tükendi
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                          onsubmit="return confirm('Bu ürünü silmek istediğinize emin misiniz?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-delete" title="Sil">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted py-5">
                                <i class="bi bi-inbox" style="font-size: 2.5rem;"></i>
                                <p class="mt-2 mb-0">Henüz ürün eklenmemiş.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
