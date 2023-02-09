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
                        <h1>{{ $comic->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">List chapter</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card-header">
            <a href="{{ route('chapter.create.volume.view', $comic->id) }}"><button class="btn btn-success"><i class="fas fa-thin fa-plus"></i>  Add new volume</button></a>
            {{--            <button type="submit" class="delete-selected btn btn-danger m-1" id="btnDeleteAll" data-toggle="modal" data-target="#deleteAllcomic" style="display: none;">Delete all selected</button>--}}
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List volume</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%" align="center">Id</th>
                                        <th width="30%">Volume</th>
                                        <th>Volume Name</th>
                                        <th>Amount chapter</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($chapters as $chapter)
                                        <tr id="pid{{ $chapter->id }}">
                                            <td>{{ $chapter->id }}</td>
                                            <td>{{ "Volume ".$chapter->chapter }}</td>
                                            <td>{{ $chapter->name }}</td>
                                            <td>{{ $chapter->amountChapter }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center">No data comic's volume</td>
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
    </div>
@stop
@section('js')
    {{--    <script src="{{ asset('js/comic_index.js') }}"></script>--}}
    {{--    <script>--}}
    {{--        var deleteAllUrl = '{{ route('comic.delete.all') }}';--}}
    {{--    </script>--}}
@stop
