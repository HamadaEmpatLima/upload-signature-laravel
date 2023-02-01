<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepository;
    private $fileService;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
        $this->fileService = new FileService;
    }

    public function me()
    {
        $user = Auth::user();

        $user = $this->userRepository->me($user->id);

        return response()->json([
            'status' => 'success',
            'data'   => $user
        ]);
    }

    public function find(int $id)
    {
        $user = $this->userRepository->find($id);

        return response()->json([
            'status' => 'success',
            'data'   => $user
        ]);
    }

    public function findByEmail(string $email)
    {
        $user = $this->userRepository->findByEmail($email);

        return response()->json([
            'status' => 'success',
            'data'   => $user
        ]);
    }

    public function update(UserRequest $request, int $id)
    {
        $formData = $request->all();
        $user = $this->userRepository->find($id);
        if (!$user) {
            return response()->json([
                'status' => 'fail',
                'message' => 'User not found'
            ]);
        }

        if ($request->hasFile('picture')) {
            $formData['picture'] = $this->fileService->storeReturnUrl($request->content, 'picture', 'picture');
            if ($user->picture) {
                $this->fileService->destroyByUrl($user->picture);
            }
        }
        $user = $this->userRepository->update($formData, $id);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function destroy(int $id)
    {
        $user = $this->userRepository->find($id);
        if ($user) {
            if ($user->picture) {
                $this->fileService->destroyByUrl($user->content);
            }
        }
        $this->userRepository->delete($id);
        return response()->json([
            'status'  => 'success',
            'message' => 'User has been deleted!',
        ]);
    }
}
