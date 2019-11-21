<?php

namespace backend\modules\logs;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\web\Application;


class Module extends \yii\base\Module implements BootstrapInterface
{

    public $controllerNamespace = 'backend\modules\logs\controllers';

    public $aliases = [];

    public $levelClasses = [
        'trace' => 'label-default',
        'info' => 'label-info',
        'warning' => 'label-warning',
        'error' => 'label-danger',
    ];

    public $defaultLevelClass = 'label-default';


    public function bootstrap($app)
    {
        if ($app instanceof Application) {
            $app->getUrlManager()->addRules([
                $this->id => $this->id . '/default/index',
                $this->id . '/<action:\w+>/<slug:[\w-]+>' => $this->id . '/default/<action>',
                $this->id . '/<action:\w+>' => $this->id . '/default/<action>',
            ], false);
        } else {
            throw new InvalidConfigException('Can use for web application only.');
        }
    }

    public function getLogs()
    {
        $logs = [];
        foreach ($this->aliases as $name => $alias) {
            $logs[] = new Log($name, $alias);
        }

        return $logs;
    }

    public function findLog($slug, $stamp)
    {
        foreach ($this->aliases as $name => $alias) {
            if ($slug === Log::extractSlug($name)) {
                return new Log($name, $alias, $stamp);
            }
        }

        return null;
    }

    public function getHistory(Log $log)
    {
        $logs = [];
        foreach (glob(Log::extractFileName($log->alias, '*')) as $fileName) {
            $logs[] = new Log($log->name, $log->alias, Log::extractFileStamp($log->alias, $fileName));
        }

        return $logs;
    }

    public function getTotalCount()
    {
        $total = 0;
        foreach ($this->getLogs() as $log) {
            foreach ($log->getCounts() as $count) {
                $total += $count;
            }
        }

        return $total;
    }
}
