<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campsite;
use Illuminate\Http\Request;

class CampsiteController extends Controller
{
    // 一覧取得・検索
    public function index(Request $request)
    {
        $query = Campsite::query();

        // 検索クエリ例
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }
        // 必要に応じて条件追加

        return response()->json($query->paginate(10));
    }

    // 詳細取得
    public function show($id)
    {
        $campsite = Campsite::findOrFail($id);
        return response()->json($campsite);
    }

    // 新規作成
    public function store(Request $request)
    {
        $campsite = Campsite::create($request->all());
        return response()->json($campsite, 201);
    }

    // 編集
    public function update(Request $request, $id)
    {
        $campsite = Campsite::findOrFail($id);
        $campsite->update($request->all());
        return response()->json($campsite);
    }

    // 削除
    public function destroy($id)
    {
        $campsite = Campsite::findOrFail($id);
        $campsite->delete();
        return response()->json(null, 204);
    }
}

