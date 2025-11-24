<?php

namespace App\Services;

class CacheService
{
    public function getIndexCacheKey(int $targetGroupId, ?int $topicId)
    {
        return sprintf('index#%s#%s', $targetGroupId, $topicId ?? 'all');
    }

    public function getTargetGroupsCacheKey()
    {
        return 'target_groups';
    }

    public function getEventProgramCategoriesCacheKey()
    {
        return 'event_program_categories';
    }

    public function getTopicsCacheKey()
    {
        return 'topics';
    }

    public function getIsfahanSSOTokenCacheKey(string $phone)
    {
        return 'isfahan_sso_token_'.$phone;
    }
}
