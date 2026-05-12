<?php

namespace App\Livewire\Features\Settings;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public string $screenName = '';
    public string $name = '';
    public ?string $description = null;

    public bool $saved = false;
    public bool $submitted = false;

    public function mount(): void
    {
        $user = Auth::user();

        $this->screenName = $user->screen_name;
        $this->name = $user->name;
        $this->description = $user->description;
    }

    public function updateProfile(): void
    {
        $user = Auth::user();
        $this->saved = false;
        $this->submitted = true;

        $description = trim((string) $this->description);
        $this->description = $description === '' ? null : $description;

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $user->forceFill($validated)->save();
        $this->saved = true;
        $this->dispatch('profile-updated');
    }

    public function render(): View
    {
        return view('livewire.features.settings.profile');
    }
}
