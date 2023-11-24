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