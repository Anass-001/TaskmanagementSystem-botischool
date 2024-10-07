<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Afficher la liste des utilisateurs
    public function index()
    {
        // Récupérer tous les utilisateurs
        $users = User::all();

        // Retourner la vue avec la liste des utilisateurs
        return view('profile.index', ['users' => $users]);
    }

    // Afficher le formulaire de modification du profil d'un utilisateur spécifique
    public function edit($id)
    {
        // Récupérer l'utilisateur par son ID
        $user = User::findOrFail($id);

        // Vérifier que l'utilisateur connecté essaie de modifier son propre profil
        if (Auth::id() !== $user->id) {
            return redirect()->route('profile.index')->withErrors(['unauthorized' => 'Unauthorized access.']);
        }

        // Retourner la vue de modification du profil avec les informations de l'utilisateur
        return view('profile.edit', ['user' => $user]);
    }

    // Mettre à jour le profil de l'utilisateur spécifique
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Vérifier que l'utilisateur connecté essaie de modifier son propre profil
        if (Auth::id() !== $user->id) {
            return redirect()->route('profile.index')->withErrors(['unauthorized' => 'Unauthorized access.']);
        }

        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'current_password' => 'nullable|string|min:8',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Vérifier le mot de passe actuel si fourni
        if ($request->filled('current_password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->route('profile.edit', $id)->withErrors(['current_password' => 'Current password is incorrect']);
            }
        }

        // Mise à jour des informations de l'utilisateur
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Mettre à jour le mot de passe si un nouveau mot de passe est fourni
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
        }

        // Handling the profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete the old profile photo if it exists
            if ($user->profile_photo && Storage::exists('public/' . $user->profile_photo)) {
                Storage::delete('public/' . $user->profile_photo);
            }

            // Store the new profile photo
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        // Rediriger vers la page de profil avec un message de succès
        return redirect()->route('profile.edit', $id)->with('success', 'Profile updated successfully.');
    }
}
