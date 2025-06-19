<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campsite;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Campsite API",
 *     version="1.0.0"
 * )
 *
 * @OA\Schema(
 *   schema="Campsite",
 *   @OA\Property(property="id", type="integer"),
 *   @OA\Property(property="name", type="string"),
 *   @OA\Property(property="address", type="string"),
 *   @OA\Property(property="description", type="string"),
 *   @OA\Property(property="facilities", type="string"),
 *   @OA\Property(property="price", type="integer"),
 *   @OA\Property(property="image_url", type="string"),
 *   @OA\Property(property="latitude", type="number", format="float"),
 *   @OA\Property(property="longitude", type="number", format="float"),
 *   @OA\Property(property="created_at", type="string", format="date-time"),
 *   @OA\Property(property="updated_at", type="string", format="date-time"),
 * )
 */
class CampsiteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/campsites",
     *     summary="キャンプ場一覧取得",
     *     @OA\Parameter(
     *         name="name", in="query", description="キャンプ場名で部分検索", required=false, @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="キャンプ場リスト",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Campsite"))
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Campsite::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }

        return response()->json($query->paginate(10));
    }

    /**
     * @OA\Post(
     *     path="/api/campsites",
     *     summary="キャンプ場新規作成",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Campsite")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="作成成功",
     *         @OA\JsonContent(ref="#/components/schemas/Campsite")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $campsite = Campsite::create($request->all());
        return response()->json($campsite, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/campsites/{id}",
     *     summary="キャンプ場詳細取得",
     *     @OA\Parameter(
     *         name="id", in="path", required=true, @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="1件分のキャンプ場データ",
     *         @OA\JsonContent(ref="#/components/schemas/Campsite")
     *     )
     * )
     */
    public function show($id)
    {
        $campsite = Campsite::findOrFail($id);
        return response()->json($campsite);
    }

    /**
     * @OA\Put(
     *     path="/api/campsites/{id}",
     *     summary="キャンプ場情報更新",
     *     @OA\Parameter(
     *         name="id", in="path", required=true, @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Campsite")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="更新後データ",
     *         @OA\JsonContent(ref="#/components/schemas/Campsite")
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $campsite = Campsite::findOrFail($id);
        $campsite->update($request->all());
        return response()->json($campsite);
    }

    /**
     * @OA\Delete(
     *     path="/api/campsites/{id}",
     *     summary="キャンプ場削除",
     *     @OA\Parameter(
     *         name="id", in="path", required=true, @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="削除完了"
     *     )
     * )
     */
    public function destroy($id)
    {
        $campsite = Campsite::findOrFail($id);
        $campsite->delete();
        return response()->json(null, 204);
    }
}
