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
enum ClientStatus
{
    const SUSPECT = 'SUSPECT';
    const LEAD = 'LEAD';
    const PROSPECT = 'PROSPECT';
    const CLIENT = 'CLIENT';

    public static function getClientStatus(): array
    {
        return [
            self::SUSPECT => 'SUSPECT',
            self::LEAD => 'LEAD',
            self::PROSPECT => 'PROSPECT',
            self::CLIENT => 'CLIENT',
        ];
    }
}

enum CommandeStatus
{
    const en_cours = 'en_cours';
    const effectue = 'effectue';
    const annule = 'annule';

    public static function getCommandeStatus(): array
    {
        return [
            self::en_cours => 'en_cours',
            self::effectue => 'effectue',
            self::annule => 'annule',
        ];
    }
}
