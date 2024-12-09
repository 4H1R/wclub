import { PageProps } from '@/@types';
import RewardProgramCard from '@/shared/cards/RewardProgramCard';
import NoRecords from '@/shared/NoRecords';
import Pagination from '@/shared/Pagination';
import Search from '@/shared/Search';
import { PaginatedCollection } from '@/types';
import { usePage } from '@inertiajs/react';

type TPage = PageProps<{
  reward_programs: PaginatedCollection<App.Data.RewardProgram.RewardProgramData>;
}>;

export default function Index() {
  const { reward_programs } = usePage<TPage>().props;
  const url = usePage().url;

  return (
    <div className="space-y container">
      <div className="flex flex-wrap items-center justify-between gap-4">
        <h1 className="h1 text-base-content">خدمات</h1>
        <Search key={url} />
      </div>
      {reward_programs.meta.total < 1 && <NoRecords />}
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        {reward_programs.data.map((rewardProgram, i) => (
          <RewardProgramCard
            showScoreTooltipForCoupleOfSeconds={i === 0 && reward_programs.meta.current_page === 1}
            key={rewardProgram.id}
            rewardProgram={rewardProgram}
          />
        ))}
      </div>
      <Pagination data={reward_programs} />
    </div>
  );
}
