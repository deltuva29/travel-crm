<?php

namespace App\Http\Traits\Toast;

trait WithToast
{
    protected function showErrorToast($message): void
    {
        $this->toast('error', $message);
    }

    protected function showSuccessToast($message): void
    {
        $this->toast('success', $message);
    }

    private function toast($type, $message): void
    {
        $this->emitTo('livewire-toast', 'show', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
