@extends('partials.master_admin')
@section('title', 'List comic')
@section('content')
    @include('layouts.header')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Comic</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">List comic</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card-header">
            <a href="{{ route('comic.create') }}"><button class="btn btn-success"><i class="fas fa-thin fa-plus"></i>  Add new comic</button></a>
            <button type="submit" class="delete-selected btn btn-danger m-1" id="btnDeleteAll" data-toggle="modal" data-target="#deleteAllcomic" style="display: none;">Delete all selected</button>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List comic</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%" align="center">Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Other Name</th>
                                        <th width="17%" align="center">Action</th>
                                        <th width="17%" align="center">Manager</th>
                                        <th style="width: 5%"><input type="checkbox" id="checkDeleteAll" class="checkall"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($comics as $comic)
                                        <tr id="pid{{ $comic->id }}">
                                            <td>{{ $comic->id }}</td>
                                            <td><img height="150px" src="{{ asset($comic->image) }}" alt="{{ $comic->name }}"/></td>
                                            <td>{{ $comic->name }}</td>
                                            <td>{{ $comic->other_name }}</td>
                                            <td>
                                                <div>
                                                    <button class="btn btn-block btn-success add-new-chapter" style="margin-bottom: 5%" data-href="{{ route('chapter.create', $comic->id) }}">
                                                        <i class="fas fa-circle-thin fa-plus-circle"></i>
                                                        Add new chapter
                                                    </button>
                                                </div>
                                                <div>
                                                    <button class="btn btn-block btn-primary list-chapter" data-id="{{ $comic->id }}" data-href="{{ "chapter/listChapter?comicId=".$comic->id }}">
                                                        <i class="fas fa-list"></i>
                                                        List chapter
                                                    </button>
                                                </div>

                                                <div>
                                                    <button class="btn btn-block btn-success add-new-chapter" style="margin-bottom: 5%; margin-top: 5%" data-href="{{ route('chapter.create.volume.view', $comic->id) }}">
                                                        <i class="fas fa-circle-thin fa-plus-circle"></i>
                                                        Add new volume
                                                    </button>
                                                </div>
                                                <div>
                                                    <button class="btn btn-block btn-primary list-chapter" data-id="{{ $comic->id }}" data-href="{{ "chapter/listVolume?comicId=".$comic->id }}">
                                                        <i class="fas fa-list"></i>
                                                        List volume
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row" style="margin-bottom: 5%">
                                                    <button class="success btn btn-success" data-href="{{ route('comic.update', $comic->id )}}" id="btn-update-comic" style="margin-left: 4%; margin-right: 8%">
                                                        <i class="nav-icon fas fa-edit"></i>
                                                        Edit
                                                    </button>
                                                    <input id="inputActive{{ $comic->id }}" data-id="{{ $comic->id }}"
                                                           class="toggle-class" type="checkbox" data-onstyle="success"
                                                           data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                           data-off="Inactive" {{ $comic->active == \App\Constants\Constant::ACTIVE ? 'checked' : '' }}
                                                           data-href="{{ route('comic.setActive') }}">
                                                    @include('comic.modal.delete')
                                                </div>

                                            </td>
                                            <td><input type="checkbox" value="{{ $comic->id }}" name="idP" id="idP{{ $comic->id }}" class="checkboxes"></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center">No data comic</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('comic.modal.delete_all')
    </div>
@stop
@section('js')
    <script src="{{ asset('js/comic_index.js') }}"></script>
    <script>
        var deleteAllUrl = '{{ route('comic.delete.all') }}';
    </script>
@stop
