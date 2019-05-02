<?php

namespace App\Policies;

use App\Answer;
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
     * @throws AuthorizationException
     * @return bool
     */
    public function store(User $user, Question $question): bool
    {
        if ($user->id === $question->user_id) {
            throw new AuthorizationException('あなた自身の質問には回答できません。');
        }

        if ($user
            ->answers()
            ->where('question_id', $question->id)
            ->exists()
        ) {
            throw new AuthorizationException('既に回答済みです。');
        }

        if ($question->bestAnswer) {
            throw new AuthorizationException('既に解決済みの質問です。');
        }

        return true;
    }

    public function selectForBest(User $user, Answer $answer)
    {
        if ($user->id !== $answer->question->user_id) {
            throw new AuthorizationException('ベストアンサーの選択権限がありません。');
        }

        if ($answer->question->bestAnswer) {
            throw new AuthorizationException('既にベストアンサー選択済みです。');
        }

        return true;
    }
}
