<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;

class EditProfile extends BaseEditProfile
{
    protected string $view = 'filament.pages.auth.edit-profile';

    public function getHeading(): string|Htmlable|null
    {
        return null;
    }

    public function defaultForm(Schema $schema): Schema
    {
        return parent::defaultForm($schema)
            ->inlineLabel(false);
    }
}
