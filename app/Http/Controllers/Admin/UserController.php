<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:doctor,receptionist',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'avatar' => 'nullable|url|max:500',
            'specialization' => 'required_if:role,doctor|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'qualification' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'consultation_fee' => 'nullable|numeric|min:0',
            'shift' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        if ($validated['role'] === 'doctor') {
            Doctor::create([
                'user_id' => $user->id,
                'avatar' => $validated['avatar'] ?? null,
                'specialization' => $validated['specialization'],
                'experience' => $validated['experience'] ?? 0,
                'qualification' => $validated['qualification'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'consultation_fee' => $validated['consultation_fee'] ?? 0,
            ]);
        } elseif ($validated['role'] === 'receptionist') {
            Receptionist::create([
                'user_id' => $user->id,
                'shift' => $validated['shift'] ?? null,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Tạo tài khoản thành công.');
    }

    public function edit($id)
    {
        $user = User::with(['doctor', 'receptionist', 'patient'])->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
            'avatar' => 'nullable|url|max:500',
            'specialization' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'qualification' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'consultation_fee' => 'nullable|numeric|min:0',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'status' => $validated['status'],
        ]);

        if ($validated['password']) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        // Cập nhật thông tin bác sĩ nếu có
        if ($user->role === 'doctor' && $user->doctor) {
            $user->doctor->update([
                'avatar' => $validated['avatar'] ?? null,
                'specialization' => $validated['specialization'] ?? $user->doctor->specialization,
                'experience' => $validated['experience'] ?? $user->doctor->experience,
                'qualification' => $validated['qualification'] ?? $user->doctor->qualification,
                'bio' => $validated['bio'] ?? $user->doctor->bio,
                'consultation_fee' => $validated['consultation_fee'] ?? $user->doctor->consultation_fee,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role === 'patient') {
            $user->delete();
        } else {
            return back()->withErrors(['error' => 'Chỉ có thể xóa tài khoản bệnh nhân.']);
        }

        return redirect()->route('admin.users.index')->with('success', 'Xóa thành công.');
    }
}

