<!doctype html>
<html lang="en">
  <head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Register</title>
  </head>
  <body>
    <div class="container mt-5">
      <div class="d-flex justify-content-center">
        <div class="card" style="width: 30rem;">
          <div class="div card-body">
            <form action="{{ route('register') }}" method="POST">
              @csrf
          
              <div class="mb-3">
                  <label class="form-label" for="name">Nama:</label>
                  <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                  @error('name')
                      <div>{{ $message }}</div>
                  @enderror
              </div>
          
              <div class="mb-3">
                  <label class="form-label">Jenis Kelamin:</label>
                  <label class="form-label"><input class="form-check-input" type="radio" name="gender" value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}> Laki-laki</label>
                  <label class="form-label"><input class="form-check-input" type="radio" name="gender" value="Perempuan" {{ old('gender') == 'Perempuan' ? 'checked' : '' }}> Perempuan</label>
                  @error('gender')
                      <div>{{ $message }}</div>
                  @enderror
              </div>
          
              <div class="mb-3">
                  <label class="form-label">Hobi:</label>
                  <label class="form-label"><input class="form-check-input" type="checkbox" name="hobby[]" value="Membaca" {{ in_array('Membaca', old('hobby', [])) ? 'checked' : '' }}> Membaca</label>
                  <label class="form-label"><input class="form-check-input" type="checkbox" name="hobby[]" value="Olahraga" {{ in_array('Olahraga', old('hobby', [])) ? 'checked' : '' }}> Olahraga</label>
                  <label class="form-label"><input class="form-check-input" type="checkbox" name="hobby[]" value="Musik" {{ in_array('Musik', old('hobby', [])) ? 'checked' : '' }}> Musik</label>
                  @error('hobby')
                      <div>{{ $message }}</div>
                  @enderror
              </div>
          
              <div class="mb-3">
                  <label class="form-label" for="email">Email:</label>
                  <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                  @error('email')
                      <div>{{ $message }}</div>
                  @enderror
              </div>
          
              <div class="mb-3">
                  <label class="form-label" for="phone">Telp:</label>
                  <input class="form-control" type="tel" name="phone" id="phone" value="{{ old('phone') }}" pattern="[0-9]+">
                  @error('phone')
                  <div>{{ $message }}</div>
                  @enderror
              </div>
        
              <div class="mb-3">
                <label class="form-label" for="username">Username:</label>
                <input class="form-control" type="text" name="username" id="username" value="{{ old('username') }}" maxlength="10">
                @error('username')
                    <div>{{ $message }}</div>
                @enderror
              </div>
            
              <div class="mb-3">
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" name="password" id="password">
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
              </div>
            
              <div class="d-flex justify-content-center m-3">
                <button class="btn btn-primary m-2" type="submit">Daftar</button>
                <button class="btn btn-secondary m-2" type="reset">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-5">
      <h3>Data Registrasi</h3>
      <div class="row mb-3">
        <div class="col-md-3">
            <form action="{{ route('register.create') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari nama atau email" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-secondary">Cari</button>
                </div>
            </form>
        </div>
        <div class="col-md-9">
          <div class="d-flex justify-content-center">
              <p class="p-2">Filter data berdarkan:</p>
                <form action="{{ route('register.create') }}" method="GET" class="mr-2">
                    <select name="gender" id="gender" class="form-select" onchange="this.form.submit()">
                        <option value="">Pilih jenis kelamin</option>
                        <option value="Laki-laki" {{ request('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ request('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </form>
                <form action="{{ route('register.create') }}" method="GET" class="mr-2">
                    <select name="hobby" id="hobby" class="form-select" onchange="this.form.submit()">
                        <option value="">Pilih hobi</option>
                        <option value="membaca" {{ request('hobby') == 'membaca' ? 'selected' : '' }}>Membaca</option>
                        <option value="menulis" {{ request('hobby') == 'menulis' ? 'selected' : '' }}>Menulis</option>
                        <option value="berenang" {{ request('hobby') == 'berenang' ? 'selected' : '' }}>Berenang</option>
                        <option value="bermain game" {{ request('hobby') == 'bermain game' ? 'selected' : '' }}>Bermain game</option>
                    </select>
                </form>
                <p class="p-2">Sorting data berdarkan:</p>
                <form action="{{ route('register.create') }}" method="GET" class="mr-2">
                    <input type="hidden" name="sort_by" value="name">
                    <input type="hidden" name="sort_direction" value="{{ request('sort_direction') == 'asc' ? 'desc' : 'asc' }}">
                    <button type="submit" class="btn btn-success {{ request('sort_by') == 'name' ? 'text-primary' : '' }}">
                        Nama {!! request('sort_by') == 'name' ? '<i class="fa fa-sort-' . (request('sort_direction') == 'asc' ? 'up' : 'down') . '"></i>' : '' !!}
                    </button>
                </form>
                <form action="{{ route('register.create') }}" method="GET" class="mr-2">
                    <input type="hidden" name="sort_by" value="gender">
                    <input type="hidden" name="sort_direction" value="{{ request('sort_direction') == 'asc' ? 'desc' : 'asc' }}">
                    <button type="submit" class="btn btn-warning {{ request('sort_by') == 'gender' ? 'text-primary' : '' }}">
                        Jenis Kelamin {!! request('sort_by') == 'gender' ? '<i class="fa fa-sort-' . (request('sort_direction') == 'asc' ? 'up' : 'down') . '"></i>' : '' !!}
                    </button>
                </form>
                <form action="{{ route('register.create') }}" method="GET" class="mr-2">
                    <input type="hidden" name="sort_by" value="email">
                    <input type="hidden" name="sort_direction" value="{{ request('sort_direction') == 'asc' ? 'desc' : 'asc' }}">
                    <button type="submit" class="btn btn-info {{ request('sort_by') == 'email' ? 'text-primary' : '' }}">
                        Email {!! request('sort_by') == 'email' ? '<i class="fa fa-sort-' . (request('sort_direction') == 'asc' ? 'up' : 'down') . '"></i>' : '' !!}
                   </button>
                </form>
            </div>
        </div>                  
      </div>
    
      <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Hobi</th>
                <th>Email</th>
                <th>Telp</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations as $registration)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $registration->name }}</td>
                    <td>{{ $registration->gender }}</td>
                    <td>{{ $registration->hobby }}</td>
                    <td>{{ $registration->email }}</td>
                    <td>{{ $registration->phone }}</td>
                    <td>{{ $registration->username }}</td>
                    <td>
                      <form action="{{ route('register.destroy', $registration->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>