<?php

namespace Webtown\UtilityBundle\Entity;

interface CrudPermissionInterface
{
    public function canEdit($user);
    public function canDelete($user);
}
