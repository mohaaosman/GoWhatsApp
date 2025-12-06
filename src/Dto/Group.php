<?php

namespace Zifala\GoWhatsApp\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Group extends SpatieData
{
	public function __construct(
		#[MapName('JID')]
		public ?string $jid = null,
		#[MapName('OwnerJID')]
		public ?string $ownerJid = null,
		#[MapName('Name')]
		public ?string $name = null,
		#[MapName('NameSetAt')]
		public ?string $nameSetAt = null,
		#[MapName('NameSetBy')]
		public ?string $nameSetBy = null,
		#[MapName('Topic')]
		public ?string $topic = null,
		#[MapName('TopicID')]
		public ?string $topicId = null,
		#[MapName('TopicSetAt')]
		public ?string $topicSetAt = null,
		#[MapName('TopicSetBy')]
		public ?string $topicSetBy = null,
		#[MapName('TopicDeleted')]
		public ?bool $topicDeleted = null,
		#[MapName('IsLocked')]
		public ?bool $isLocked = null,
		#[MapName('IsAnnounce')]
		public ?bool $isAnnounce = null,
		#[MapName('AnnounceVersionID')]
		public ?string $announceVersionId = null,
		#[MapName('IsEphemeral')]
		public ?bool $isEphemeral = null,
		#[MapName('DisappearingTimer')]
		public ?int $disappearingTimer = null,
		#[MapName('IsIncognito')]
		public ?bool $isIncognito = null,
		#[MapName('IsParent')]
		public ?bool $isParent = null,
		#[MapName('DefaultMembershipApprovalMode')]
		public ?string $defaultMembershipApprovalMode = null,
		#[MapName('LinkedParentJID')]
		public ?string $linkedParentJid = null,
		#[MapName('IsDefaultSubGroup')]
		public ?bool $isDefaultSubGroup = null,
		#[MapName('IsJoinApprovalRequired')]
		public ?bool $isJoinApprovalRequired = null,
		#[MapName('GroupCreated')]
		public ?string $groupCreated = null,
		#[MapName('ParticipantVersionID')]
		public ?string $participantVersionId = null,
		#[MapName('Participants')]
		public ?array $participants = null,
		#[MapName('MemberAddMode')]
		public ?string $memberAddMode = null,
	) {
	}
}
