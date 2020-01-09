<?php
/**
 * Created by: PhpStorm.
 * UserCreated: Nam Nguyen
 * DateCreated: 10/12/19 20:11
 */

namespace App\Services;


use App\Contracts\Channels;
use App\Models\Channel;

class ChannelService implements Channels
{
    /**
     * @return Channel[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function all()
    {
        return Channel::all();
    }

    /**
     * @inheritDoc
     */
    public function findByCode(string $code): ?Channel
    {
        $channelInfo = Channel::where('code', '=', $code)->first();
        return $channelInfo;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Channel
    {
        $channel = new Channel();
        if ($data) {
            $channel->fill($data);
            $channel->save();
        }

        return $channel;
    }

    /**
     * @inheritDoc
     */
    public function update(Channel $channel, array $data): Channel
    {
        if ($data) {
            $channel->fill($data);
            $channel->save();
        }
        return $channel;
    }
}
