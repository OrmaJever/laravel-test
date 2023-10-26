<?php

namespace App\Service;

use App\Exceptions\ErrorResponse;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    public function get(array $filter, User $user): Collection
    {
        $query = Post::query()
            ->orderBy('id', $filter['sort'] ?? 'desc')
            ->offset($filter['offset'] ?? 0)
            ->limit($filter['limit'] ?? 10);

        if(isset($filter['user_id'])) {
            $query->where('user_id', $filter['user_id']);
        }


        // якщо користувач бере пости зі своїм user_id то повертаемо всі пости, а не тільки активні
        if(!isset($filter['user_id']) || $user->id != $filter['user_id']) {
            $query->where('is_active', true);
        }

        if(isset($filter['created_at'])) {
            $query->whereDate('created_at', $filter['created_at']);
        }

        // сюди вже єластік чи сфинкс проситься :)
        if(isset($filter['text'])) {
            $query->whereRaw('text like ?', '%' . $filter['text'] . '%');
        }

        return $query->get();
    }

    /**
     * @throws ErrorResponse
     */
    public function create(array $data, User $user): Post
    {
        $data['is_active'] && $this->check($user);

        $data['user_id'] = $user->id;

        return Post::create($data);
    }

    /**
     * @throws ErrorResponse
     */
    public function update(int $id, array $data, User $user): Post
    {
        $post = Post::find($id);

        if(!$post) {
            throw new ErrorResponse('Post does not exist');
        }

        $this->check($user);

        $post->update($data);

        return $post->refresh();
    }

    /**
     * @throws ErrorResponse
     */
    protected function check(User $user): void
    {
        if(!$user->plan_id) {
            throw new ErrorResponse('Need subscription');
        }

        // це не дуже гарний спосіб брати кількість постів користувача, тому що кожен раз треба перераховувати всю таблицю
        // краще було бі створити поле posts_count в таблиці users і оновлювати його, але для цього прикладу зійде :)
        $postCount = Post::query()
            ->where('user_id', $user->id)
            ->where('created_at', '>=', $user->plan_activate_date)
            ->where('is_active', true)
            ->count();

        if($postCount >= $user->plan->publication_count) {
            throw new ErrorResponse('You have reached your post limit for this month');
        }
    }
}
