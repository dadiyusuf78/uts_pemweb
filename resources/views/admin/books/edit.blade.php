@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.book.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.data_pelanggan.update", [$book->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="namapelanggan">{{ trans('cruds.data_pelanggan.fields.namapelanggan') }}</label>
                <input class="form-control {{ $errors->has('bookname') ? 'is-invalid' : '' }}" type="text" name="namapelanggan" id="namapelanggan" value="{{ old('namapelanggan', $data_pelanggan->namapelanggan) }}" required>
                @if($errors->has('namapelanggan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('namapelanggan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_pelanggan.fields.namapelanggan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="order">{{ trans('cruds.data_pelanggan.fields.order') }}</label>
                <input class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" type="text" name="order" id="order" value="{{ old('order', $data_pelanggan->order) }}" required>
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_pelanggan.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection