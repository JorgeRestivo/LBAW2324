<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Adicione lógica para recuperar informações do perfil aqui
        return view('profile.profile'); // Certifique-se de criar esta visão em resources/views/profile/index.blade.php
    }

    public function show()
    {
        return view('profile.index');
    }

    public function editProfilePhotoForm()
    {
        return view('profile.edit_photo');
    }

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // ajuste os tipos de imagem conforme necessário
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            // Salvar a nova foto
            $image = $request->file('profile_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile_photos'), $imageName);

            // Atualizar o caminho da foto no banco de dados
            $user->profile_photo = $imageName;
            $user->save();
        }

        return redirect()->route('profile.show')->with('success', 'Profile photo updated successfully.');
    }
}