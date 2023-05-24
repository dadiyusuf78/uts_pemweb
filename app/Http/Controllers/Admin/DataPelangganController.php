<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDataPelangganRequest;
use App\Http\Requests\StoreDataPelangganRequest;
use App\Http\Requests\UpdateDataPelangganRequest;
use App\Models\DataPelanggan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DataPelangganController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('data_pelanggan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DataPelanggan::query()->select(sprintf('%s.*', (new DataPelanggan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'data_pelanggan_show';
                $editGate      = 'data_pelanggan_edit';
                $deleteGate    = 'data_pelanggan_delete';
                $crudRoutePart = 'data_pelanggan_sakits';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('namapelanggan', function ($row) {
                return $row->namapasien ? $row->namapasien : '';
            });
            $table->editColumn('order', function ($row) {
                return $row->penyakit ? $row->penyakit : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.data_pelanggan.index');
    }

    public function create()
    {
        abort_if(Gate::denies('data_pelanggan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.data_pelanggan.create');
    }

    public function store(StoreDataPelangganRequest $request)
    {
        $data_pelanggan = DataPelanggan::create($request->all());

        return redirect()->route('admin.data_pelanggan.index');
    }

    public function edit(DataPelanggan $data_pelanggan)
    {
        abort_if(Gate::denies('data_pelanggan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.data_pelanggan.edit', compact('data_pelanggan'));
    }

    public function update(UpdateDataPelangganRequest $request, DataPelanggan $data_pelanggan)
    {
        $data_pelanggan->update($request->all());

        return redirect()->route('admin.data_pelanggan.index');
    }

    public function show(DataPelanggan $data_pelanggan)
    {
        abort_if(Gate::denies('data_pelanggan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.data_pelanggan.show', compact('data_pelanggan'));
    }

    public function destroy(DataPelanggan $data_pelanggan)
    {
        abort_if(Gate::denies('data_pelanggan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data_pelanggan->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataPelangganRequest $request)
    {
        $data_pelanggan = DataPelanggan::find(request('ids'));

        foreach ($data_pelanggan as $data_pelanggan) {
            $data_pelanggan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}