<?php

namespace backend\modules\logs;

use Yii;
use yii\base\BaseObject;
use yii\caching\FileDependency;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;


class Log extends BaseObject
{
    private $_name;
    private $_alias;
    private $_stamp;
    private $_fileName;

    public function __construct($name, $alias, $stamp = null, $config = [])
    {
        $this->_name = $name;
        $this->_alias = $alias;
        $this->_stamp = $stamp;
        $this->_fileName = static::extractFileName($alias, $stamp);
        parent::__construct($config);
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getAlias()
    {
        return $this->_alias;
    }

    public function getStamp()
    {
        return $this->_stamp;
    }

    public function getSlug()
    {
        return static::extractSlug($this->_name);
    }

    public function getFileName()
    {
        return $this->_fileName;
    }

    public function getIsExist()
    {
        return file_exists($this->getFileName());
    }

    public function getSize()
    {
        return $this->getIsExist() ? filesize($this->getFileName()) : null;
    }

    public function getUpdatedAt()
    {
        return $this->getIsExist() ? filemtime($this->getFileName()) : null;
    }

    public function getDownloadName()
    {
        return $this->getSlug() . '.log';
    }

    public function getCounts($force = false)
    {
        if (!$this->getIsExist()) return [];

        $key = $this->getFileName() . '#counts';
        if (!$force && ($counts = Yii::$app->cache->get($key)) !== false) {
            return $counts;
        }

        $counts = [];
        if ($h = fopen($this->getFileName(), 'r')) {
            while (($line = fgets($h)) !== false) {
                if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $line)) {
                    if (preg_match('/^[\d\-\: ]+\[.*\]\[.*\]\[.*\]\[(.*)\]/U', $line, $m)) {
                        $level = $m[1];
                        if (!isset($counts[$level])) $counts[$level] = 0;
                        $counts[$level]++;
                    }
                }
            }
            fclose($h);
            Yii::$app->cache->set($key, $counts, 0, new FileDependency([
                'fileName' => $this->getFileName(),
            ]));
        }

        return $counts;
    }

    public function archive($stamp)
    {
        if ($this->getStamp() === null && $this->getIsExist()) {
            rename($this->getFileName(), static::extractFileName($this->getAlias(), $stamp));
            return true;
        } else {
            return false;
        }
    }

    public static function extractSlug($name)
    {
        return Inflector::slug($name);
    }

    public static function extractFileName($alias, $stamp = null)
    {
        $fileName = FileHelper::normalizePath(Yii::getAlias($alias, false));
        if ($stamp === null) return $fileName;

        $info = pathinfo($fileName);
        return strtr('{dir}/{name}.{stamp}.{ext}', [
            '{dir}' => $info['dirname'],
            '{name}' => $info['filename'],
            '{ext}' => $info['extension'],
            '{stamp}' => $stamp,
        ]);
    }

    public static function extractFileStamp($alias, $fileName)
    {
        $originName = FileHelper::normalizePath(Yii::getAlias($alias, false));
        $origInfo = pathinfo($originName);
        $fileInfo = pathinfo($fileName);
        if (
            $origInfo['dirname'] === $fileInfo['dirname'] &&
            $origInfo['extension'] === $fileInfo['extension'] &&
            strpos($fileInfo['filename'], $origInfo['filename']) === 0
        ) {
            return substr($fileInfo['filename'], strlen($origInfo['filename']) + 1);
        } else {
            return null;
        }
    }
}