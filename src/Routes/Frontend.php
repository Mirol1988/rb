<?php

declare(strict_types=1);

namespace Rb\Routes;

use Rb\Infrastructure\Application\Routes;

class Frontend implements Routes
{
    public function value(): array
    {
        return [
            'GET,OPTIONS /version' => 'site/version',

            'GET,OPTIONS /partner' => 'partner/index',

            'POST,OPTIONS /top' => 'feed-sport/top-list',
            'POST,OPTIONS /sports' => 'feed-sport/list',
            'POST,OPTIONS /sports/<id:[\d+]+>/line' => 'feed-sport/view-line-sport',

            'GET,OPTIONS /matches/types' => 'feed-match/view-type-list',
            'GET,OPTIONS /matches/periods' => 'feed-match/view-period-list',
            'GET,OPTIONS /matches/live/translation/<id:[\d+]+>' => 'feed-match/live-translation',
            'POST,OPTIONS /matches/lives' => 'feed-match/view-count-match-live',
            'POST,OPTIONS /matches/<id:[\d+]+>' => 'feed-match/view',
            'POST,OPTIONS /matches' => 'feed-match/list',
            'POST,OPTIONS /matches/desktop' => 'feed-match/view-desktop-list',
            'POST,OPTIONS /matches/desktop/live' => 'feed-match/view-desktop-live-list',
            'POST,OPTIONS /matches/desktop/full-live' => 'feed-match/view-desktop-full-live-list',
            'POST,OPTIONS /matches/desktop/full-pre-match' => 'feed-match/view-desktop-full-pre-match-list',
            'POST,OPTIONS /matches/<id:[\d+]+>/line' => 'feed-match/view-line-match',

            'GET,OPTIONS /stakes/types' => 'feed-stake/view-type-list',
            'POST,OPTIONS /stakes/<id:[\d+]+>' => 'feed-stake/view-stake-list',

            'POST,OPTIONS /championships' => 'feed-championship/list',
            'POST,OPTIONS /championships/<id:[\d+]+>/line' => 'feed-championship/view-line-championship',

            'POST,OPTIONS /tournaments' => 'feed-tournament/list',
            'POST,OPTIONS /tournaments/<id:[\d+]+>/line' => 'feed-tournament/view-line-tournament',

            'GET,OPTIONS /betting/coupon' => '/betting-optional/list',
            'POST,OPTIONS /betting/add' => '/betting-optional/add',
            'DELETE,OPTIONS /betting/remove-stake' => '/betting-optional/remove-stake',

            'GET,OPTIONS /betting/max-coupon-amount' => '/betting/max-coupon-amount',
            'POST,OPTIONS /betting/repeat-bet' => '/betting/repeat-bet',
            'PUT,OPTIONS /betting/update-stake' => '/betting/update-stake',
            'POST,OPTIONS /betting/place-bet' => '/betting/place-bet',
            'POST,OPTIONS /betting/history' => '/betting/view-history',
            'POST,OPTIONS /betting/cashout' => '/betting/cashout',
            'POST,OPTIONS /betting/view-cashout' => '/betting/view-cashout',

            'POST,OPTIONS /favorites/events/<id:[\d+]+>' => '/favorite/create-event',
            'POST,OPTIONS /favorites/tournaments/<id:[\d+]+>' => '/favorite/create-tournament',
            'DELETE,OPTIONS /favorites/events/<id:[\d+]+>' => '/favorite/delete-event',
            'DELETE,OPTIONS /favorites/tournaments/<id:[\d+]+>' => '/favorite/delete-tournament',
            'GET,OPTIONS /favorites/tournaments' => '/favorite/view-tournament-list',
            'GET,OPTIONS /favorites/events' => '/favorite/view-event-list',
            'GET,OPTIONS /favorites' => '/favorite/list',
            'POST,OPTIONS /favorites/matches' => '/favorite/view-match-list',

            'POST,OPTIONS /url-verification' => '/url/verify',

            'POST,OPTIONS /stake-settings' => '/stake-setting/save',
            'GET,OPTIONS /stake-settings' => '/stake-setting/view',
            'GET,OPTIONS /stake-settings/bonuses' => '/stake-setting/view-bonus-list',
            'GET,OPTIONS /stake-settings/priorities' => '/stake-setting/view-priority-list',

            'GET,OPTIONS /sockets/create' => '/socket/create',
            'GET,OPTIONS /sockets/delete' => '/socket/delete',
            'GET,OPTIONS /sockets/update' => '/socket/update',
            'GET,OPTIONS /sockets/top-match' => '/socket/view-top-match',
            'GET,OPTIONS /sockets/match-is-live' => '/socket/send-match-is-live',

            'GET,OPTIONS /histories' => '/history/save',

            'POST,OPTIONS /write-off' => '/write-off/index',
        ];
    }
}