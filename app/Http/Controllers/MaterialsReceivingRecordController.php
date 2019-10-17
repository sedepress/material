<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Libs\LogMes;
use App\Libs\StatusCode;
use App\Models\Department;
use App\Models\Material;
use App\Models\MaterialsReceivingRecordsLog;
use App\Models\MaterialsReceivingRecord;
use Illuminate\Http\Request;
use App\Http\Requests\MaterialsReceivingRecordRequest;
use DB,Auth;

class MaterialsReceivingRecordController extends BaseController
{
    public function index()
    {
        $departments = Department::where('level', 0)->get();
        $records = MaterialsReceivingRecord::with(['user.department', 'material'])->paginate(10);
        return view('materials_record.index', compact('records', 'departments'));
    }

    public function create(MaterialsReceivingRecord $materialsReceivingRecord)
    {
        $materials = $this->materials();
        $users = $this->users();
        return view('materials_record.create_and_edit', compact('materials', 'users', 'materialsReceivingRecord'));
    }

    public function store(MaterialsReceivingRecordRequest $request, MaterialsReceivingRecord $materialsReceivingRecord)
    {
        DB::beginTransaction();
        try {
            $material = Material::find($request->input('material_id'));

            if ($material->decreaseStock($request->input('amount')) <= 0) {
                throw new InvalidRequestException('该物品库存不足');
            }

            $materialsReceivingRecord->fill($request->all());
            $materialsReceivingRecord->create_user = Auth::id();
            $materialsReceivingRecord->save();
            $this->logs(LogMes::CREATE_OPERATING);
            DB::commit();

            $msg = '创建成功';

            return $this->responseJson(StatusCode::SUCCESS, $msg);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;

            $msg = '系统异常';

            return $this->responseJson(StatusCode::INTERNAL_SERVER_ERROR, $msg);
        }
    }

    public function edit(MaterialsReceivingRecord $materialsReceivingRecord)
    {
        $materials = $this->materials();
        $users = $this->users();

        return view('materials_record.create_and_edit', compact('materials', 'users', 'materialsReceivingRecord'));
    }

    public function update(MaterialsReceivingRecordRequest $request, MaterialsReceivingRecord $materialsReceivingRecord)
    {
        DB::beginTransaction();
        try {
            $material = Material::find($materialsReceivingRecord->material_id);

            $diff = $materialsReceivingRecord->amount - $request->input('amount');

            if ($diff > 0) {
                if ($material->incrementStock(abs($diff)) <= 0) {
                    throw new InvalidRequestException('该物品历史领取量不为负');
                }
            }

            if ($diff < 0) {
                if ($material->decreaseStock(abs($diff)) <= 0) {
                    throw new InvalidRequestException('该物品历史领取量不为负');
                }
            }

            $materialsReceivingRecord->update($request->all());

            $this->logs(LogMes::UPDATE_OPERATING);
            DB::commit();

            $msg = '修改成功';

            return $this->responseJson(StatusCode::SUCCESS, $msg);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;

            $msg = '系统异常';

            return $this->responseJson(StatusCode::INTERNAL_SERVER_ERROR, $msg);
        }
    }

    public function destroy(MaterialsReceivingRecord $materialsReceivingRecord)
    {
        DB::beginTransaction();
        try {
            $material = Material::find($materialsReceivingRecord->material_id);
            
            if ($material->incrementStock($materialsReceivingRecord->amount) <= 0) {
                throw new InvalidRequestException('该物品历史领取量不为负');
            }

            $materialsReceivingRecord->delete();
            $this->logs(LogMes::DELETE_OPERATING);
            DB::commit();

            $msg = '删除成功';

            return $this->responseJson(StatusCode::SUCCESS, $msg);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;

            $msg = '系统异常';

            return $this->responseJson(StatusCode::INTERNAL_SERVER_ERROR, $msg);
        }
    }

    private function logs($status)
    {
        $log = new MaterialsReceivingRecordsLog();
        $log->operating_status = $status;
        $log->admin_id = Auth::id();
        $log->save();
    }
}
