<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialRequest;
use App\Libs\StatusCode;
use App\Libs\LogMes;
use App\Models\Material;
use App\Models\MaterialsLog;
use App\Search\MaterialSearch\MaterialSearch;
use Illuminate\Http\Request;
use DB,Auth;

class MaterialController extends BaseController
{
    public function index(Request $request)
    {
        $materials = MaterialSearch::apply($request)->paginate(10);
        $materials->appends(['name' => $request->get('name')]);

        return view('material.index', compact('materials'));
    }

    public function create(Material $material)
    {
        return view('material.create_and_edit', compact('material'));
    }

    public function store(MaterialRequest $request, Material $material)
    {
        $material->fill($request->all());
        $material->recent_deposit_time = time();
        $material->create_user         = Auth::id();
        $material->save();
        $this->logs(LogMes::CREATE_MES, $material);

        $msg = '创建成功';

        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }

    public function edit(Material $material)
    {
        return view('material.create_and_edit', compact('material'));
    }

    public function update(MaterialRequest $request, Material $material)
    {
        $material->update($request->all());
        $this->logs(LogMes::EDIT_MES, $material);
        $msg = '更新成功';

        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }

    public function destroy(Material $material)
    {
        $material->delete();
        $this->logs(LogMes::DELETE_MES, $material);
        $msg = '删除成功';

        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }

    public function exchangeStatus(Material $material)
    {
        $material->status = !$material->status;
        $material->save();
        $this->logs(LogMes::STATUS_CHANGE, $material);

        $msg = '操作成功';

        return $this->responseJson(StatusCode::SUCCESS, $msg);
    }

    public function adjust_form(Material $material)
    {
        return view('material.adjust_stock', compact('material'));
    }

    public function adjust(MaterialRequest $request, Material $material)
    {
        $data = array_filter($request->only(['adjust_status', 'amount']));
        DB::beginTransaction();
        try {
            $stock = $material->stock;
            if ($data['adjust_status'] == "inc") {
                $material->stock = $stock + $data['amount'];
            } else {
                $material->stock = $stock - $data['amount'];
            }

            $material->recent_deposit_time = time();
            $material->save();
            $this->logs(LogMes::UPDATE_MES, $material);

            DB::commit();

            $msg = '操作成功';
            return $this->responseJson(StatusCode::SUCCESS, $msg);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;

            $msg = '系统异常';
            return $this->responseJson(StatusCode::INTERNAL_SERVER_ERROR, $msg);
        }
    }

    private function logs($content, $material)
    {
        $material_log = new MaterialsLog();
        $material_log->content = $content . '--' . $material->name;
        $material_log->admin_id = Auth::id();
        $material_log->save();
    }
}
