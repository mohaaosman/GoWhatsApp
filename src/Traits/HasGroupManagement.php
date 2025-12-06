<?php

namespace Zifala\GoWhatsApp\Traits;

use Zifala\GoWhatsApp\Requests\Group\CreateGroup;
use Zifala\GoWhatsApp\Requests\Group\JoinGroupWithLink;
use Zifala\GoWhatsApp\Requests\Group\LeaveGroup;
use Zifala\GoWhatsApp\Requests\Group\GroupInfo;
use Saloon\Data\MultipartValue;

trait HasGroupManagement
{
    public function createGroup(string $name, array $participants)
    {
        $request = new CreateGroup();
        $request->body()->set([
            'name' => $name,
            'participants' => $participants,
        ]);
        return $this->connector()->send($request);
    }

    public function joinGroup(string $link)
    {
        $request = new JoinGroupWithLink();
        $request->body()->set(['link' => $link]);
        return $this->connector()->send($request);
    }

    public function leaveGroup(string $groupId)
    {
        $request = new LeaveGroup();
        $request->body()->set(['group_id' => $groupId]);
        return $this->connector()->send($request);
    }

    public function groupInfo(string $groupId)
    {
        return $this->connector()->group()->groupInfo($groupId);
    }
}

