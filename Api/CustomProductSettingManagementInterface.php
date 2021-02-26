<?php

namespace Lof\CustomProduct\Api;

interface CustomProductSettingManagementInterface
{
    /**
     * @param string $path
     * @return mixed
     */
    public function getSetting($path);
}
