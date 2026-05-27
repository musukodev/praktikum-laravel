<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students Edit | Laravel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    Edit Siswa

                    <a href="/student" type="button" class="btn btn-danger float-
right">Kembali</a>
                </div>
                <form action="/student/edit/{{ $student->nim }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <input name="old_nim" hidden value="{{ $student->nim }}" />
                    <div class="card-body">
                        @if(session('notifikasi'))
                        <div class="form-group">
                            <div class="alert alert-{{ session('type') }}">
                                {{ session('notifikasi') }}
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="nama">NIM <b class="text-danger">*</b></label>
                            <input required placeholder="Masukkan NIM" type="text" id="nim" name="nim"
                                class="form-control @error('nim') is-invalid @enderror"
                                value="{{ old('nim', $student->nim) }}">
                            @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama <b class="text-danger">*</b></label>
                            <input required placeholder="Masukkan Nama" type="text" id="nama" name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $student->nama) }}">
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">E-Mail <b class="text-danger">*</b></label>
                            <input required placeholder="Masukkan E-Mail" type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $student->email) }}">

                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Prodi <b class="text-danger">*</b></label>
                            <select required id="prodi" name="prodi"
                                class="form-control @error('prodi') is-invalid @enderror" required>
                                <option value="">- Pilih Prodi</option>
                                <option @if (
                                    old('prodi', $student->prodi) == 'Teknik
                                    Informatika'
                                    ) {{ 'selected' }}
                                    @endif >Teknik Informatika</option>
                                <option @if (
                                    old('prodi', $student->prodi) == 'Teknik Rekayasa
                                    Keamanan Siber'
                                    ) {{ 'selected' }} @endif>Teknik Rekayasa Keamanan Siber</option>
                                <option @if (
                                    old('prodi', $student->prodi) == 'Teknik Rekayasa
                                    Perangkat Lunak'
                                    ) {{ 'selected' }} @endif>Teknik Rekayasa Perangkat Lunak</option>
                            </select>
                            @error('prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Foto Lama</label><br>
                            @if($student->foto)
                                <img src="{{ asset('storage/students/'.$student->foto) }}" alt="Foto Lama" width="150">
                            @else
                                <span>Tidak ada foto</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Ganti Foto?</label>
                            <select id="ganti_foto" class="form-control" style="width:200px">
                                <option value="tidak">Tidak</option>
                                <option value="ya">Ya</option>
                            </select>
                        </div>
                        <div class="form-group" id="kolom_foto_baru" style="display:none">
                            <label for="foto">Foto Baru</label>
                            <input type="file" id="foto" name="foto"
                                class="form-control @error('foto') is-invalid @enderror">
                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="/student" class="btn btn-danger">Batal</a>
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965Dz00rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-
U02eT@CpHqdSJQ6hJty5KVphtPhzWj9W01c1HTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-
JjSmVgyd@p3pXB1rRibZUAYoIIy60rQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#ganti_foto').on('change', function() {
                if ($(this).val() == 'ya') {
                    $('#kolom_foto_baru').show();
                } else {
                    $('#kolom_foto_baru').hide();
                    $('#foto').val('');
                }
            });

            $('#foto').on('change', function() {
                var file = this.files[0];
                var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                var maxSize = 2 * 1024 * 1024; // 2MB

                if (file) {
                    if (!allowedTypes.includes(file.type)) {
                        alert('Tipe file harus JPEG, JPG, atau PNG!');
                        $(this).val('');
                        return;
                    }
                    if (file.size > maxSize) {
                        alert('Ukuran file maksimal 2 MB!');
                        $(this).val('');
                        return;
                    }
                }
            });
        });
    </script>
</body>

</html>