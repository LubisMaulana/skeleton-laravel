<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'page' => 'Pengguna',
        ]);
    }

    public function getData()
    {
        $users = User::select([
            'id',
            'name',
            'email',
            'role',
        ])
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan list peserta.',
            'data'    => UserResource::collection($users),
        ], 200);
    }

    public function store(StoreUserRequest $request)
    {
        $data             = $request->validated();
        $data['password'] = Hash::make($data['password']);

        try {
            $user = User::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menambahkan user.',
                'data'    => new UserResource($user),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $data = $request->validated();

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::find($id);
        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta tidak dapat ditemukan.',
            ], 404);
        }

        DB::beginTransaction();
        try {
            $user->update($data);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengubah peserta.',
                'data'    => new UserResource($user),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(int $id)
    {
        $user = User::select([
            'id',
            'name',
            'email',
            'role',
        ])
            ->where('id', $id)
            ->first();

        if ($user == null) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta tidak dapat ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan data peserta.',
            'data'    => new UserResource($user),
        ], 200);
    }

    public function destroy(int $id)
    {
        $user = User::find($id);
        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta tidak dapat ditemukan.',
            ], 404);
        }

        DB::beginTransaction();
        try {
            $user->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus peserta.',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
