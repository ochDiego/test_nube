<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MangaResource;
use App\Models\Manga;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $mangas = Manga::latest()->get();

            // Respuesta
            return response()->json([
                'message' => 'Lista de mangas',
                'error' => false,
                'data' => MangaResource::collection($mangas),
            ], 200);
        } catch (Exception $e) {

            // Respuesta en caso de algun error
            return response()->json([
                'message' => 'Error al desplegar lista de mangas',
                'error' => true,
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'titulo' => 'required|string|max:255|unique:mangas',
                'portada' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'categoria_id' => 'required|exists:categorias,id',
            ]);

            // Almacena la imagen de portada
            $path = $request->file('portada')->store('images', 'public');

            $manga = Manga::create([
                'titulo' => $request->titulo,
                'portada' => $path,
                'categoria_id' => $request->categoria_id,
            ]);

            // Respuesta
            return response()->json([
                'message' => 'Manga creado',
                'error' => false,
                'data' => MangaResource::make($manga),
            ], 201);
        } catch (ValidationException $e) {

            // Respuesta en caso de error
            return response()->json([
                'message' => 'Error de validacion',
                'error' => true,
                'data' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $manga = Manga::findOrFail($id);

            $request->validate([
                'titulo' => 'sometimes|required|string|max:255|unique:mangas,titulo,' . $manga->id,
                'portada' => 'sometimes|required|image|mimes:jpg,jpeg,png|max:2048',
                'categoria_id' => 'sometimes|required|exists:categorias,id',
            ]);

            // Si se sube una nueva imagen de portada, elimina la anterior
            if ($request->hasFile('portada')) {
                Storage::delete($manga->portada);
                $newPath = $request->file('portada')->store('images', 'public');
                $manga->portada = $newPath;
            }

            // Actualiza los campos
            $manga->update([
                'titulo' => $request->titulo,
                'portada' => $request->portada,
                'categoria_id' => $request->categoria_id,
            ]);

            // Respuesta
            return response()->json([
                'message' => 'Manga actualizado',
                'error' => false,
                'data' => MangaResource::make($manga),
            ], 200);
        } catch (ValidationException $e) {

            // Respuesta en caso de error de validacion
            return response()->json([
                'message' => 'Error de validacion',
                'error' => true,
                'data' => $e->errors(),
            ], 422);
        } catch (ModelNotFoundException $e) {

            // Respuesta en caso de que no exista el manga
            return response()->json([
                'message' => 'Manga no encontrado',
                'error' => true,
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $manga = Manga::findOrFail($id);
            Storage::delete($manga->portada);
            $manga->delete();

            // Respuesta
            return response()->json([
                'message' => 'Manga eliminado',
                'error' => false,
            ], 200);
        } catch (ModelNotFoundException $e) {

            // Respuesta en caso de que no exista el manga
            return response()->json([
                'message' => 'Manga no encontrado',
                'error' => true,
            ], 404);
        }
    }
}
