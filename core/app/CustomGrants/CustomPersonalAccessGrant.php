<?php
namespace App\CustomGrants;

use Laravel\Passport\Bridge\PersonalAccessGrant as PassportPersonalAccessGrant;

class CustomPersonalAccessGrant extends PassportPersonalAccessGrant
{
    protected function createAccessToken(ClientEntityInterface $client, $userIdentifier, array $scopes)
    {
        $user = $this->getUserEntityByIdentifier($userIdentifier);

        $token = $this->issueToken($user->getIdentifier(), $client->getIdentifier(), $scopes);

        // Add user roles to the token payload
        $token->setAttribute('role', $user->role); // Modify this according to your user model structure

        return $token;
    }
}
