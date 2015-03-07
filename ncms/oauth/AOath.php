<?php
/**
 * @package NCMS
 * @author Nikolay Kovenko <nikolay.kovenko@gmail.com>
 * @date 07.03.15
 */

namespace app\ncms\oauth;

use yii\base\Component;

/**
 * Абстрактный класс для oAuth авторизации
 * @package app\ncms\oauth
 */
abstract class AOath extends Component
{
    /**
     * Возвращает url для авторизации
     * @return string
     */
    abstract public function loginRedirectUrl();

    /**
     * Получает токен от системы
     * @return array с ключами token, apiUserId и apiController 
     * @throws \Exception в случае неудачи
     */
    abstract public function response();

    /**
     * Возвращает информацию о пользователю по токену
     * @param string $token
     * @return array
     * @throws \Exception в случае ошибки
     */
    abstract public function getUserInfo($token);

    /**
     * Возвращает последниии записи пользователя
     * @param string $token
     * @param int $postsNumber
     * @return array
     * @throws \Exception в случае ошибки
     */
    abstract public function getLastPosts($token, $postsNumber = 5);

    /**
     * Возвращает уникальный идентификатор api
     * @return string
     */
    abstract public function apiID();
}
