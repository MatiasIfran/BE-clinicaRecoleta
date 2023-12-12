<?php

namespace App\Http\Controllers;
use App\Models\CodigoPostal;

use Illuminate\Http\Request;

class CodigoPostalController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @OA\Get(
     *      path="/api/cp/all",
     *      security={{"apiAuth":{}}},
     *      operationId="getAllCodigosPostales",
     *      tags={"Codigo Postal"},
     *      summary="Obtener todos los códigos postales",
     *      description="Retorna una lista de todos los códigos postales disponibles",
     *      @OA\Response(
     *          response=200,
     *          description="Operación exitosa",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="boolean",
     *              ),
     *              @OA\Property(
     *              type="array",
     *              property="codigos_postales",
     *              @OA\Items(
     *                  type="object",
     *                      @OA\Property(
     *                          property="id",
     *                          type="number",
     *                      ),
     *                      @OA\Property(
     *                          property="codigo",
     *                          type="string",
     *                      ),
     *                      @OA\Property(
     *                          property="descripcion",
     *                          type="string",
     *                      ),
     *                      @OA\Property(
     *                          property="usuario",
     *                          type="string",
     *                      ),
     *                  )
     *              )
     *          )
     *      )
     * )
     */
    public function allCodigoPostal()
    {
        $codigosPostales = CodigoPostal::all();
        $data = [
            'status'         => true,
            'codigos_postales' => $codigosPostales,
        ];
        return response()->json($data, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/cp/id/{codigoPostalId}",
     *      security={{"apiAuth":{}}},
     *      operationId="getCodPostById",
     *      tags={"Codigo Postal"},
     *      summary="Obtener codigo postal por Id",
     *      description="Retorna un array del codigo postal disponible",
     *      @OA\Parameter(
     *         in="path",
     *         name="codigoPostalId",
     *         required=true,
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operación exitosa",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="boolean",
     *              ),
     *              @OA\Property(
     *              type="array",
     *              property="codigos_postales",
     *              @OA\Items(
     *                  type="object",
     *                      @OA\Property(
     *                          property="id",
     *                          type="number",
     *                      ),
     *                      @OA\Property(
     *                          property="codigo",
     *                          type="string",
     *                      ),
     *                      @OA\Property(
     *                          property="descripcion",
     *                          type="string",
     *                      ),
     *                      @OA\Property(
     *                          property="usuario",
     *                          type="string",
     *                      ),
     *                  )
     *              )
     *          )
     *      )
     * )
     */
    public function getCodPostById($codigoPostalId)
    {
        $codigoPostal = CodigoPostal::find($codigoPostalId);

        if (!$codigoPostal) {
            $data = [
                'status' => false,
                'error'  => 'Código postal no encontrado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'        => true,
            'codigo_postal' => $codigoPostal,
        ];
        return response()->json($data, 200);
    }

     /**
     * @OA\Get(
     *      path="/api/cp/{codigoPostalNumber}",
     *      security={{"apiAuth":{}}},
     *      operationId="getCodPostByCodigo",
     *      tags={"Codigo Postal"},
     *      summary="Obtener codigo postal por numero",
     *      description="Retorna un array del codigo postal disponible",
     *      @OA\Parameter(
     *         in="path",
     *         name="codigoPostalNumber",
     *         required=true,
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operación exitosa",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="boolean",
     *              ),
     *              @OA\Property(
     *              type="array",
     *              property="codigos_postales",
     *              @OA\Items(
     *                  type="object",
     *                      @OA\Property(
     *                          property="id",
     *                          type="number",
     *                      ),
     *                      @OA\Property(
     *                          property="codigo",
     *                          type="string",
     *                      ),
     *                      @OA\Property(
     *                          property="descripcion",
     *                          type="string",
     *                      ),
     *                      @OA\Property(
     *                          property="usuario",
     *                          type="string",
     *                      ),
     *                  )
     *              )
     *          )
     *      )
     * )
     */
    public function getCodPostByCodigo($codigo)
    {
        $codigoPostal = CodigoPostal::where('codigo', $codigo)->first();

        if (!$codigoPostal) {
            $data = [
                'status' => false,
                'error'  => 'Código postal no encontrado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'        => true,
            'codigo_postal' => $codigoPostal,
        ];
        return response()->json($data, 200);
    }
}
