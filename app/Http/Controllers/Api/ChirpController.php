<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chirp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestPayloadValueResolver;

class ChirpController extends Controller
{
    public function index(Request $request) :JsonResponse
    {
        $chirps = Chirp::with('user:id,name') -> latest()->get();
        return response() -> json($chirps);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request -> validate([
            'message' => 'required|string|max:255'
        ]);
        
        $chirp = $request -> user() -> chirps() -> create($validated);

        return response()->json(['message' => 'Chirp Sent', 'chirp' => $chirp], 201);
    }

    public function destroy(Chirp $chirp): JsonResponse
    {
        $this -> authorize('delete', $chirp);

        $chirp -> delete();

        return response() -> json(['message' => 'Chirp Deleted']);
    }

    public function edit(Chirp $chirp): JsonResponse
    {
        $this -> authorize('update', $chirp);

        return response() -> json($chirp);
    }


    public function update(Request $request, Chirp $chirp): JsonResponse 
    {
        $this -> authorize('update', $chirp);

        $validated = $request -> validate([
            'message' => 'required|string|max:255'
        ]);

        $chirp -> update($validated);
        $chirp -> load('user');
        return response()->json(['message' => 'Chirp message updated']);
    }
}
