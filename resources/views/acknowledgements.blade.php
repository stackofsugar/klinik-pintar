@extends('layouts.main')

@section('title', 'Acknowledgements')

@section('content')
    <div class="container">
        <h1 class="text-center fw-bold mb-1">Acknowledgements</h1>
        <p class="text-center text-muted">Pustaka dan aset terlisensi yang kami gunakan</p>
        <div class="row justify-content-center">
            <div class="col-12 col-xl-8">
                <table class="table link-child-dark">
                    <thead>
                        <tr>
                            <th scope="col">Sumber</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Lisensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a class="link-dark" href="https://unsplash.com/" target="_blank">Unsplash</a></td>
                            <td>Aset Foto Stok</td>
                            <td><a class="link-dark" href="https://unsplash.com/license" target="_blank">Lisensi
                                    Unsplash</a></td>
                        </tr>
                        <tr>
                            <td><a class="link-dark" href="https://pixabay.com/" target="_blank">Pixabay</a></td>
                            <td>Aset Foto Stok</td>
                            <td><a class="link-dark" href="https://pixabay.com/service/license/" target="_blank">Lisensi
                                    Pixabay</a></td>
                        </tr>
                        <tr>
                            <td><a class="link-dark" href="https://this-person-does-not-exist.com/en"
                                    target="_blank">This Person Does Not Exist</a></td>
                            <td><em>GAN-generated Avatars</em></td>
                            <td><a class="link-dark" href="https://creativecommons.org/publicdomain/mark/1.0/"
                                    target="_blank">Public Domain</a></td>
                        </tr>
                        <tr>
                            <td><a class="link-dark" href="https://www.embedgooglemap.net/" target="_blank">Embed
                                    Google Map</a></td>
                            <td><em>Google Maps Embed</em></td>
                            <td><a target="_blank">-</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
