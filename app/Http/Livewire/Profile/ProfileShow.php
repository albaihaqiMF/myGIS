<?php

namespace App\Http\Livewire\Profile;

use App\Models\MasterGroup;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProfileShow extends Component
{
    public $password, $newPassword, $confirmPassword, $name, $user;

    public function mount()
    {
        $this->id = auth()->user()->id;
        $this->name = auth()->user()->name;
        $this->user = User::find($this->id);
    }

    public function updateProfile()
    {

        $this->name !== null && $this->user->update([
            'name' => $this->name
        ]);
    }

    public function updatePassword()
    {
        if (strlen($this->newPassword) >= 8) {
            if (Hash::check($this->password, $this->user->password)) {
                if ($this->newPassword == $this->confirmPassword) {
                    $this->user->update([
                        'password' => bcrypt($this->newPassword),
                    ]);
                    session()->flash('success', 'Berhasil mengganti password');
                    $this->reset([
                        'password',
                        'newPassword',
                        'confirmPassword',
                    ]);
                } else {
                    session()->flash('fail', 'Gagal ganti password');
                }
            } else {
                session()->flash('fail', 'Gagal ganti password');
            }
        } else {
            session()->flash('fail', 'Password harus terdiri dari minimal 8 karakter');
        }
    }
    public function render()
    {
        $authMasterGroup = MasterGroup::where('chief', $this->id);

        $masterGroup = $authMasterGroup->latest()->limit(5)->get();
        $moreMasterGroup = $authMasterGroup->count();
        return view('livewire.profile.profile-show', [
            'masterGroup' => $masterGroup,
            'more' => $moreMasterGroup,
            'pg' => MasterGroup::where('chief', $this->id)->where('type', 'PG')->get()->count(),
            'area' => MasterGroup::where('chief', $this->id)->where('type', 'AREA')->get()->count(),
            'loc' => MasterGroup::where('chief', $this->id)->where('type', 'LOC')->get()->count(),
            'section' => MasterGroup::where('chief', $this->id)->where('type', 'SEC')->get()->count(),
        ]);
    }
}
