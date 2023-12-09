<?php


namespace App\Enum;

enum UserRole
{
    const PDG = 'PDG';
    const EMPLOYE = 'EMPLOYE';
    const DIRECTEUR_GENERAL = 'DIRECTEUR_GENERAL';
    const ADMIN = 'ADMIN';

    public static function getRoles(): array
    {
        return [
            self::PDG => 'PDG',
            self::EMPLOYE => 'Employe',
            self::DIRECTEUR_GENERAL => 'Directeur General',
            self::ADMIN => 'Admin',
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