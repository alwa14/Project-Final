<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <title>{{ $title }} · {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="Project Web, Project Kecil-Kecilan, Lhokseumawe, Politeknik, Politeknik Negeri Lhokseumawe">
    <meta name="description" content="Aplikasi Penjualan Baju">
    <meta name="robots" content="noindex,nofollow">
    <!-- Favicon icon -->
    <link rel="icon" type="image/ico" sizes="32x32" href="{{ url('/') }}/logo.gif">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
        @media only screen and (max-width: 600px) {
            #footer {
                position: relative;
                top: 10px;
                bottom: 0;
                left: 0;
                right: 0;
            }
        }

        @media only screen and (min-width: 600px) {
            #footer {
                position: absolute;
                bottom: 0;
                top: 770;
                left: 0;
                right: 0;
            }
        }
    </style>

</head>

<body class="h-100">

    <div class="d-flex align-items-center justify-content-center footer-custom-before">
        <div class="pt-5 mt-4">
            <div class=" text-center mt-4 pb-5">
                <img src="logo.gif" alt="PJS" height="150px">
            </div>
            {{-- <h1 class="text-center mt-4 pb-2">PJS</h1> --}}
            <div style="width: 340px;" class="pt-4 pb-5 mx-auto">
                @if (isset($pesan))
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fa-solid fa-circle-exclamation flex-shrink-0 me-2"></i>
                        <div>
                            {{ $pesan }}
                        </div>
                    </div>
                @endif
                @if (isset($success))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="fa-solid fa-circle-exclamation flex-shrink-0 me-2"></i>
                        <div>
                            {{ $success }}
                        </div>
                    </div>
                @endif
                @if (isset($gagal))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="fa-solid fa-circle-exclamation flex-shrink-0 me-2"></i>
                        <div>
                            {{ $gagal }}
                        </div>
                    </div>
                @endif
                <form method="POST" style="width: 300px;" action="home" class="mx-auto">
                    @csrf
                    @if (isset($pesan))
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                                name="username" required autofocus value="{{ $username }}" maxlength="20">
                            <label for="floatingInput">Username</label>
                        </div>
                    @else
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                                name="username" required autofocus value="" maxlength="20">
                            <label for="floatingInput">Username</label>
                        </div>
                    @endif
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                            name="password" maxlength="100">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-block btn-primary text-center"
                            style="">Login</button>
                    </div>

                </form>
                <div class="d-grid gap-2 mx-auto" style="width: 300px;">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#Registrasi">Registrasi</button>
                </div>
            </div>
        </div>
    </div>

    <div id="footer"
        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-5 px-4 px-xl-5">
        <div class="text-center text-dark">
            <button type="button" class="btn btn-link" data-bs-toggle="modal"
                data-bs-target="#Registrasi">Registrasi</button>
            <div class="d-inline-block mx-2">·</div><button type="button" class="btn btn-link" data-bs-toggle="modal"
                data-bs-target="#About">Tentang</button>
        </div>

        <div class="text-center text-dark">
            <div class="float-right text-muted d-none d-sm-block">&copy; 2022 <a href="https://github.com/alwa14"
                    target="_blank" class="text-muted">Salwa Nur. JB</a></div>
            <div class="mt-2 text-muted d-sm-none">&copy; 2022 <a href="https://github.com/alwa14" target="_blank"
                    class="text-muted">Salwa Nur. JB</a></div>
        </div>
    </div>


    <div id="modal-tentang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tentang PJS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Batal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Registrasi --}}
    <div class="modal fade" id="Registrasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RegistrasiLabel">Registrasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/') }}/register" class=" mx-auto">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Nama" placeholder="name@example.com"
                                name="nama" required maxlength="100"
                                value="{{ isset($data['nama']) ? $data['nama'] : '' }}">
                            <label for="Nama">Nama</label>
                        </div>
                        <div class="form-floating mb-3" id="container">
                            <input type="text" class="form-control" id="username" placeholder="name@example.com"
                                name="username" required maxlength="20"
                                value="{{ isset($data['username']) ? $data['username'] : '' }}">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password" maxlength="100"
                                value="{{ isset($data['password']) ? $data['password'] : '' }}">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="passkon" placeholder="Password"
                                aria-describedby="validationServer03Feedback" required maxlength="100"
                                value="{{ isset($data['password']) ? $data['password'] : '' }}">
                            <label for="passkon">Password Konfirmasi</label>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                Password tidak sama
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="checkbox" name="check" id="check" class="mx-2"
                                onclick="myFunction()">
                            <label for="check" class="text-dark">Show Password</label>

                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal About --}}
    <div class="modal fade" id="About" tabindex="-1" aria-labelledby="AboutLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AboutLabel">About</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolore placeat voluptas, vitae quasi ut
                        optio atque! Autem voluptate doloribus omnis provident dicta eos laborum asperiores, blanditiis
                        aliquid officia voluptatem cumque quaerat voluptatibus maiores animi numquam quo nesciunt.
                        Tenetur doloribus, aperiam dignissimos quo quidem vero consequatur optio beatae repellat quod
                        amet hic neque? Dolor voluptas amet architecto perferendis repudiandae officia rem consectetur
                        alias? Ipsam, veritatis. Aperiam earum facilis corporis quaerat deleniti itaque libero, ullam
                        dignissimos. Non tenetur magnam maiores voluptatibus corrupti saepe cum aliquam commodi eum
                        quidem? In at, aut quam accusantium dicta ipsum repellendus debitis nihil? Fugiat dolorum minima
                        quaerat!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("passkon");

            if (x.type === "password" && y.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";

            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#passkon').on('keyup', function() {
                let pass = $('#password').val();
                let passkon = $('#passkon').val();

                if (passkon != pass) {
                    $('#passkon').addClass("is-invalid");
                } else {
                    $('#passkon').removeClass("is-invalid");
                }

            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
</body>

</html>
