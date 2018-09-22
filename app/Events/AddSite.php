<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddSite
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $user_id = $user->id;
        $avatar = 'img/avatar1.png';
        $url = config('app.site').'/mobile/index?user_id='.$user_id;
        $site['user_id'] = $user_id;
        $site['link'] = $url;
        $site['shortlink'] = $this->getShortLink($url);

        \DB::table('sites')->insert($site);
        $hasAvatar = \DB::table('users')->where('id', '=', $user_id)->value('avatar');
        if (!$hasAvatar) {
            \DB::table('users')->where('id', '=', $user_id)->update(['avatar'=>$avatar]);
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    function getShortLink($url)
    {
        $url_short =  file_get_contents("http://mrw.so/api.php?url=$url");
        $is_url = preg_match("/http:\/\//", $url_short);
        if (!$is_url) {
            return $this->getShortLink($url);
        }
        return $url_short;
    }
}
