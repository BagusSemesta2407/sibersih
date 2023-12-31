@extends('layouts.base')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                    Data User
                    <a href="{{ route('operator.user.create') }}"
                        class="btn btn-outline-primary block float-end">
                        Tambah
                    </a>
                </div>


                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Induk</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $item->nomor_induk }}
                                    </td>
                                    <td>
                                        {{ $item->username }}
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>

                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('operator.user.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pen"></i>
                                            </a>
                                            &nbsp;

                                            <button class="btn btn-sm btn-danger delete"
                                                data-url="{{ route('operator.user.destroy', $item->id) }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    </div>
@endsection
