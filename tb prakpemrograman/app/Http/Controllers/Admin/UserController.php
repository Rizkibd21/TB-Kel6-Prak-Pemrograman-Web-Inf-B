<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('role');
        $query = User::query();

        if ($role) {
            $query->where('role', $role);
        }

        $users = $query->latest()->paginate(10);

        return view('admin.users.index', compact('users', 'role'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,dosen,mahasiswa'],
            'nidn' => ['nullable', 'required_if:role,dosen', 'string'],
            'nim' => ['nullable', 'required_if:role,mahasiswa', 'string'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'nidn' => $validated['nidn'] ?? null,
            'nim' => $validated['nim'] ?? null,
        ]);

        return redirect()->route('admin.users.index', ['role' => $user->role])->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'in:admin,dosen,mahasiswa'],
            'nidn' => ['nullable', 'string'],
            'nim' => ['nullable', 'string'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'nidn' => $validated['nidn'],
            'nim' => $validated['nim'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index', ['role' => $user->role])->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $role = $user->role;
        $user->delete();

        return redirect()->route('admin.users.index', ['role' => $role])->with('success', 'User deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:4096',
        ]);

        $file = $request->file('file');

        if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
            $row = 0;
            $success = 0;

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $row++;
                // Expect format: Name, Email, NIM/NIDN, Role, Password(Optional)
                if ($row == 1 && strtolower($data[0]) == 'name') {
                    continue;
                } // Skip header

                try {
                    $name = $data[0] ?? null;
                    $email = $data[1] ?? null;
                    $id_num = $data[2] ?? null; // NIM or NIDN
                    $role = isset($data[3]) ? strtolower($data[3]) : 'mahasiswa';
                    $password = isset($data[4]) && ! empty($data[4]) ? $data[4] : 'password123';

                    if ($name && $email) {
                        User::updateOrCreate(
                            ['email' => $email],
                            [
                                'name' => $name,
                                'role' => $role, // Default student
                                'nim' => $role === 'mahasiswa' ? $id_num : null,
                                'nidn' => $role === 'dosen' ? $id_num : null,
                                'password' => Hash::make($password),
                            ]
                        );
                        $success++;
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }
            fclose($handle);

            return back()->with('success', "$success Data users berhasil diimpor.");
        }

        return back()->with('error', 'Gagal membaca file.');
    }
}
