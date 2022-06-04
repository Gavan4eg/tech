@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Inventory</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('inventory.add') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
                {{--                <div class="col-md-6">--}}
                {{--                    <a href="{{ route('users.export') }}" class="btn btn-sm btn-success">--}}
                {{--                        <i class="fas fa-check"></i> Export To Excel--}}
                {{--                    </a>--}}
                {{--                </div>--}}
            </div>
        </div>

        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Inventory</h6>

            </div>
            <div  class="card-body">
                <div  class="table-responsive">
                    <table id="myTable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Inventory name</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Сondition</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date</th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($inventory as $i)
                            <tr>
                                <th scope="row">{{ $i->name }}</th>
                                <td>{{ $i->name_inventory }}</td>
                                <td>{{ $i->stock }}</td>
                                <td>{{ $i->condition }}</td>
                                <td>{{ $i->description }}</td>
                                <td>{{ $i->created_at }}</td>


                                <td style="display: flex;">
                                    <a href="{{ route('inventory.edit', $i->id) }}" class="btn btn-primary m-2"><i
                                            aria-hidden="true" class="fa fa-pen"></i>
                                    </a> <a href="{{ route('inventory.delete', $i->id) }}"
                                            class="btn btn-danger m-2"><i
                                            aria-hidden="true" class="fas fa-trash"></i></a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection
