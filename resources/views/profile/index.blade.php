@extends('layouts.app')

@section('content')
@include('flash::message')
<section class="users-edit">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <ul class="nav nav-tabs mb-2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                            <i class="ft-user mr-25"></i><span class="d-none d-sm-block">Akun</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                        <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="media mb-2">
                                <a class="mr-2" href="javascript:void(0);">
                                    <img src="{{ $data->avatar ? asset('storage/images/' . $data->avatar) : asset('assets/images/profile.png') }}" alt="users avatar" class="users-avatar-shadow rounded-circle" height="64" width="64" id="blah">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Avatar</h4>
                                    <div class="col-12 px-0 d-flex">
                                        <label class="btn btn-sm btn-primary mr-25" for="image-upload">Upload</label>
                                        <small id="filename" class="pt-1 ml-1"></small>
                                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="image-upload" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" hidden>
                                        @error('avatar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="name">Nama</label>
                                            <input
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')"
                                            type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Dimas Tifli" name="name" value="{{ $data->name ?? '' }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="username">Username</label>
                                            <input
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')"
                                            type="text" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="dimas123" name="username" value="{{ $data->username ?? '' }}" required>
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="email">Email</label>
                                            <input
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')"
                                            type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="dimas@gmail.com" name="email" value="{{ $data->email ?? '' }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="phone">Nomor HP</label>
                                            <input
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')"
                                            type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="082234897777" name="phone" value="{{ $data->phone ?? '' }}" required">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="password">Password</label><small> (opsional)</small>
                                            <div class="form-group position-relative has-icon-right">
                                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
                                                <div class="form-control-position">
                                                    <i  toggle="#password-field" class="ft-eye font-medium-5 line-height-1 text-muted icon-align toggle-password"></i>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label for="password_confirmation">Konfirmasi Password</label><small> (opsional)</small>
                                            <div class="form-group position-relative has-icon-right">
                                                <input type="password" id="password_confirmation" class="form-control" placeholder="Password" name="password_confirmation">
                                                <div class="form-control-position">
                                                    <i toggle="#password-field" class="ft-eye font-medium-5 line-height-1 text-muted icon-align toggle-confirm-password"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        // Toogle Password
        $(document).on('click', '.toggle-password', function() {
            $(this).toggleClass('ft-eye-off')
            const input = $('#password')
            input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
        })
        $(document).on('click', '.toggle-confirm-password', function() {
            $(this).toggleClass('ft-eye-off')
            const input2 = $('#password_confirmation')
            input2.attr('type') === 'password' ? input2.attr('type','text') : input2.attr('type','password')
        })
        
        // Upload Image
        $('#image-upload').change(function() {
            const filename = $('input[type=file]').val().split('\\').pop()
            const lastIndex = filename.lastIndexOf("\\")  
            $('#filename').text(filename)
        })
    })
</script>
@endsection