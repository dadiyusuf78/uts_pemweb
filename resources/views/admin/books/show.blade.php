@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.data_pelanggan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data_pelanggan.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pelanggan.fields.id') }}
                        </th>
                        <td>
                            {{ $data_pelanggan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pelanggan.fields.namapelanggan') }}
                        </th>
                        <td>
                            {{ $data_pelanggan->namapelanggan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pelanggan.fields.order') }}
                        </th>
                        <td>
                            {{ $data_pelanggan->order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data_pelanggan.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection