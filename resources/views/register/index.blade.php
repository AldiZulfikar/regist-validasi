<!doctype html>
<html lang="en">
  <head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet"> 
    <title>Register</title>
  </head>
  <body>
  <div class="wrap">
      <div class="regis col-10 mx-auto">
        <div class="hero ">
          <h1 class="col-md-6">Lets Create User Together to manage your list</h1>
          <p class="col-md-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci consectetur quibusdam ab inventore laudantium officiis at facere distinctio alias ipsum necessitatibus esse sit rem error, laborum cupiditate asperiores, hic velit?</p>
        </div>
      <div class="d-flex mt-4">
          <div class=" col-10">
            <div class="div">
              <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3 ">
                    <input class="input-fleid col-7" placeholder="What your Name... " type="text" name="name" id="name" value="{{ old('name') }}">
                    @error('name')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
            
               <div class="d-flex col-12 col-md-7 flex-wrap justify-between">
                <div class="mb-3 col-6">
                  <label class="form-label">gender ...</label> 
                  <br>
                  <label class="form-label"><input class="form-check-input" type="radio" name="gender" value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}> Laki-laki</label>
                  <label class="form-label"><input class="form-check-input" type="radio" name="gender" value="Perempuan" {{ old('gender') == 'Perempuan' ? 'checked' : '' }}> Perempuan</label>
                  @error('gender')
                      <div>{{ $message }}</div>
                  @enderror
              </div>
          
              <div class="mb-3">
                  <label class="form-label">Your Hobby ...</label>
                  <br>
                  <label class="form-label"><input class="form-check-input" type="checkbox" name="hobby[]" value="Membaca" {{ in_array('Membaca', old('hobby', [])) ? 'checked' : '' }}> Membaca</label>
                  <label class="form-label"><input class="form-check-input" type="checkbox" name="hobby[]" value="Olahraga" {{ in_array('Olahraga', old('hobby', [])) ? 'checked' : '' }}> Olahraga</label>
                  <label class="form-label"><input class="form-check-input" type="checkbox" name="hobby[]" value="Musik" {{ in_array('Musik', old('hobby', [])) ? 'checked' : '' }}> Musik</label>
                  @error('hobby')
                      <div>{{ $message }}</div>
                  @enderror
              </div>
          
               </div>
               
                <div class="d-flex  flex-wrap ">
                  <div class="mb-3">
                    <input class="input-fleid flex" placeholder="Your Email ..." type="email" name="email" id="email" value="{{ old('email') }}">
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                  </div>
              
                  <div class="mb-3 col-6 ms-md-3 ms-0">
                      <input class="input-fleid flex" placeholder="Your Phone ..." type="tel" name="phone" id="phone" value="{{ old('phone') }}" pattern="[0-9]+">
                      @error('phone')
                      <div>{{ $message }}</div>
                      @enderror
                  </div>
                </div>
                
                <div class="d-flex  flex-wrap ">
                <div class="mb-3">
                  <input class="input-fleid flex" placeholder="Create Username ..." type="text" name="username" id="username" value="{{ old('username') }}" maxlength="10">
                  @error('username')
                      <div>{{ $message }}</div>
                  @enderror
                </div>
              
                <div class="mb-3 ms-md-3 ms-0">
                  <input class="input-fleid flex" placeholder="Create Password ..." type="password" name="password" id="password">
                  @error('password')
                      <div>{{ $message }}</div>
                  @enderror
                </div>
                </div>
              
                <div class="d-flex ">
                  <button class="btn btn-light " type="submit">Daftar</button>
                  <button class="btn btn-secondary ms-3" type="reset">Reset</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      {{-- list  user --}}
      <div class="container  mt-5">
        <h1 class="text-md-end text-center mb-5">List Of User </h1>
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
            <div class="d-flex flex-wrap justify-content-between">
              {{-- filter data --}}
                <div class="filter mt-3 mt-md-0 col-12 col-md-7 d-flex">
                  <p class="p-2">Filter data:</p>
                  <form action="{{ route('register.create') }}" method="GET" class="mr-2">
                      <select name="gender" id="gender" class="form-select" onchange="this.form.submit()">
                          <option value="">Choose Gender</option>
                          <option value="Laki-laki" {{ request('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                          <option value="Perempuan" {{ request('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                      </select>
                  </form>
                  <form action="{{ route('register.create') }}" method="GET" class="mx-2">
                      <select name="hobby" id="hobby" class="form-select" onchange="this.form.submit()">
                          <option value="">Choose Hobby</option>
                          <option value="membaca" {{ request('hobby') == 'membaca' ? 'selected' : '' }}>Membaca</option>
                          <option value="olahraga" {{ request('hobby') == 'olahraga' ? 'selected' : '' }}>olahraga</option>
                          <option value="musik" {{ request('hobby') == 'musik' ? 'selected' : '' }}>musik</option>
                      </select>
                  </form>
                </div>
                {{-- sort Data --}}
                <div class="short col-md-5 col-12 d-flex justify-content-between">
                  <p class="p-2 ">Sort Data By:</p>
                  <div class="form-short d-flex col-7 justify-content-between">
                    <form action="{{ route('register.create') }}" method="GET" class="mr-2">
                      <input type="hidden" name="sort_by" value="name">
                      <input type="hidden" name="sort_direction" value="{{ request('sort_direction') == 'asc' ? 'desc' : 'asc' }}">
                      <button type="submit" class="d-flex btn btn-sort {{ request('sort_by') == 'name' ? 'text-sort' : '' }}">
                          Nama {!! request('sort_by') == 'name' ? '<i class="ms-2 bi bi-sort-' . (request('sort_direction') == 'asc' ? 'up' : 'down') . '"></i>' : '' !!}
                      </button>
                  </form>

                  <form action="{{ route('register.create') }}" method="GET" class="mr-2">
                      <input type="hidden" name="sort_by" value="email">
                      <input type="hidden" name="sort_direction" value="{{ request('sort_direction') == 'asc' ? 'desc' : 'asc' }}">
                      <button type="submit" class="d-flex btn btn-sort {{ request('sort_by') == 'email' ? 'text-sort' : '' }}">
                          Email {!! request('sort_by') == 'email' ? '<i class="ms-2 bi bi-sort-' . (request('sort_direction') == 'asc' ? 'up' : 'down') . '"></i>' : '' !!}
                     </button>
                  </form>
                  </div>
                </div>
              </div>
          </div>                  
        </div>
      
       <div class="wrap-table">
        <table class="table  bg-light mt-0 mt-md-3 table-striped">
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
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
       </div>
      </div>
      </div>
  </body>
</html>