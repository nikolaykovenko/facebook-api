<?php
/**
 * @package NCMS
 * @author Nikolay Kovenko <nikolay.kovenko@gmail.com>
 * @date 07.03.15
 */

namespace app\ncms\oauth;
use yii\base\Exception;

/**
 * Фабрика для генерации объектов авторизации
 * @package app\ncms\oauth
 */
class Factory
{

    /**
     * Возвращает объект для авторизации
     * @param string $controllerName
     * @return AOath
     * @throws Exception
     */
    public static function getObject($controllerName)
    {
        $controllerName = __NAMESPACE__ . '\\' . ucfirst(strtolower($controllerName));
        
        if (class_exists($controllerName)) {
            return new $controllerName;
        }

        throw new Exception('OAth controller "' . $controllerName . '" is not found');
    }
}
