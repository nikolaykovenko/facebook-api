<?php
/**
 * @package NCMS
 * @author Nikolay Kovenko <nikolay.kovenko@gmail.com>
 * @date 08.03.15
 */

namespace app\ncms\core;
use yii\base\Model;

/**
 * Базовый контроллер приложения
 * @package app\ncms\core
 */
abstract class Controller extends \yii\web\Controller
{

    /**
     * @var array массив переменных
     */
    protected $variables = [];

    /**
     * Устанавливает значение переменной для представления
     * @param string $variable
     * @param mixed $value
     * @return $this
     */
    public function setVariable($variable, $value)
    {
        $this->variables[$variable] = $value;
        return $this;
    }

    /**
     * Возвращает значение переменной
     * @param string $variable
     * @return mixed
     */
    public function getVariable($variable)
    {
        if (isset($this->variables[$variable])) {
            return $this->variables[$variable];
        }
        
        return null;
    }

    /**
     * @inheritdoc
     */
    public function renderAjax($view, $params = [])
    {
        $params = array_merge($this->variables, $params);
        return parent::renderAjax($view, ['ajaxVariables' => $params]);
    }

    /**
     * @inheritdoc
     */
    public function render($view, $params = [])
    {
        $params = array_merge($this->variables, $params);
        return parent::render($view, $params);
    }

    /**
     * Записывает в переменную контроллера все ошибки валидации для модели
     * @param Model $model
     * @return $this
     */
    protected function modelsValidationErrorsToAjax(Model $model)
    {
        $allErrors = [];
        
        $errors = $model->getErrors();
        foreach ($errors as $field => $fieldErrors) {
            foreach ($fieldErrors as $error) {
                if (!in_array($error, $allErrors)) {
                    $allErrors[] = $error;
                }
            }
        }
        
        $this
            ->setVariable('result', 'error')
            ->setVariable('message', implode("\n", $allErrors));
        
        return $this;
    }
}
