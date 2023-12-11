<?php


namespace App\Enum;

enum UserRole
{
    const PDG = 'PDG';
    const EMPLOYE = 'EMPLOYE';
    const DG = 'DG';
    const ADMIN = 'ADMIN';

    public static function getRoles(): array
    {
        return [
            self::PDG => 'PDG',
            self::EMPLOYE => 'EMPLOYE',
            self::DG => 'DG',
            self::ADMIN => 'ADMIN',
        ];
    }
}

enum UserStatus
{
    const DG = 'DG';
    const SAV = 'SAV';
    const COMMERCIAL = 'COMMERCIAL';

    public static function getRoles(): array
    {
        return [
            self::DG => 'DG',
            self::SAV => 'SAV',
            self::COMMERCIAL => 'COMMERCIAL',
        ];
    }
}
