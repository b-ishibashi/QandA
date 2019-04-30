<?php

namespace App\Policies;

use App\Question;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * ユーザが質問に回答できるか
     *
     * @param User $user
     * @param Question $question
     * @return bool
     * @throws AuthorizationException
     */
    public function store(User $user, Question $question): bool
    {
        if ($user->id === $question->user_id) {
            throw new AuthorizationException('あなた自身の質問には回答できません。');
        }

        return true;
    }
}
