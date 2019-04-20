<?php

namespace App\Validation;

use Illuminate\Validation\Validator as BaseValidator;

class Validator extends BaseValidator
{
    /**
     * @var null|string
     */
    protected $redirectTo;

    /**
     * ValidationException のリダイレクト先を設定
     *
     * @return $this
     */
    public function redirectTo(?string $url)
    {
        $this->redirectTo = $url;
        return $this;
    }

    /**
     * ValidationException のリダイレクト先を適用
     *
     * @param callable $callback 呼び出す処理
     * @return mixed
     */
    protected function redirectOnFailure(callable $callback)
    {
        try {
            return $callback();
        } catch (ValidationException $e) {
            throw $e->redirectTo($this->redirectTo);
        }
    }

    /**
     * Run the validator's rules against its data.
     *
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate()
    {
        return $this->redirectOnFailure(function () {
            return parent::validate();
        });
    }

    /**
     * Get the attributes and values that were validated.
     *
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validated()
    {
        return $this->redirectOnFailure(function () {
            return parent::validated();
        });
    }
}
