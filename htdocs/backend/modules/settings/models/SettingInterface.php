<?php

namespace backend\modules\settings\models;

interface SettingInterface
{

    /**
     * Gets a combined map of all the settings.
     * @return array
     */
    public function getSettings();

    /**
     * Saves a setting
     *
     * @param $section
     * @param $key
     * @param $value
     * @param $type
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function setSetting($section, $key, $value, $type);

    /**
     * Deletes a settings
     *
     * @param $key
     * @param $section
     * @return boolean True on success, false on error
     */
    public function deleteSetting($section, $key);

    /**
     * Deletes all settings! Be careful!
     * @return boolean True on success, false on error
     */
    public function deleteAllSettings();

    /**
     * Activates a setting
     *
     * @param $key
     * @param $section
     * @return boolean True on success, false on error
     */
    public function activateSetting($section, $key);

    /**
     * Deactivates a setting
     *
     * @param $key
     * @param $section
     * @return boolean True on success, false on error
     */
    public function deactivateSetting($section, $key);

    /**
     * Finds a single setting
     *
     * @param $key
     * @param $section
     * @return SettingInterface single setting
     */
    public function findSetting($section, $key);
}
