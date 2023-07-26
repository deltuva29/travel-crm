<?php

namespace App\Actions\Settings;

use Exception;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;

class UpdateCustomerAvatar
{
    public function execute(HasMedia $customer, UploadedFile $avatar): bool
    {
        try {
            $fileName = strtolower(str_replace(['#', '/', '\\', ' '], '-', $avatar->getFilename()));
            $customer->clearMediaCollection('avatar');
            $sanitizeFileName = static fn($fileName) => strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));

            $customer->addMediaFromStream($avatar->get())
                ->sanitizingFileName($sanitizeFileName)
                ->usingFileName($fileName)
                ->toMediaCollection('avatar', 'customer_avatars');

            return true;
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
            return false;
        }
    }
}
