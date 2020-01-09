<?php
/**
 * Created by: PhpStorm.
 * UserCreated: Nam Nguyen
 * DateCreated: 10/12/19 20:11
 */

namespace App\Contracts;


use App\Models\Channel;

interface Channels
{
    /**
     * @return Channel[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function all();
    /**
     * @param string $code
     * @return Channel
     */
    public function findByCode(string $code): ?Channel;

    /**
     * @param array $data
     * @return Channel
     */
    public function create(array $data): Channel;

    /**
     * @param Channel $channel
     * @param array $data
     * @return Channel
     */
    public function update(Channel $channel, array $data): Channel;
}
