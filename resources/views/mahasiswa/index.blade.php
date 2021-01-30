@extends('layout/main')

@section('title', 'Data Mahasiswa')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
            <h1 class="mt-3">Daftar Mahasiswa</h1>

            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Email</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- < ?php foreach($mahasiswa as $mhs) ?> //cara php biasa -->
                    @foreach($mahasiswa as $mhs)
                    <tr>
                        <!-- karna pake foeach bawaan blade maka kebuka var/objek loop yg didalamnya ada properti iteration -->
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->email }}</td>
                        <td>{{ $mhs->jurusan }}</td>
                        <td>
                            <a href="" class="badge bg-warning">edit</a>
                            <a href="" class="badge bg-danger">delete</a>
                        </td>
                    </tr>
                    <!-- < ?php endforeach; ?> //cara php biasa -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection