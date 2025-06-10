import SharedCardProperties from '@/components/cards/SharedCardProperties';
import { cn, slugifyId } from '@/utils';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import { HiStar } from 'react-icons/hi2';
import BaseCard from './BaseCard';

type RewardProgramCardProps = {
  rewardProgram: App.Data.RewardProgram.RewardProgramData;
  showTooltip?: boolean;
  hasWidth?: boolean;
};

export default function RewardProgramCard({
  rewardProgram,
  showTooltip = false,
  hasWidth = false,
}: RewardProgramCardProps) {
  const href = route('reward-programs.show', [slugifyId(rewardProgram.id, rewardProgram.title)]);

  return (
    <BaseCard
      data={rewardProgram}
      href={href}
      hasWidth={hasWidth}
      bodyEndChildren={
        <>
          <div className="flex flex-wrap items-center gap-1 pb-6 pt-2">
            <div
              className={cn('tooltip tooltip-top', {
                'tooltip-open animate-bounce': showTooltip,
              })}
              data-tip="امتیاز مورد نیاز"
            >
              <div className="badge badge-lg flex items-center justify-center gap-2 bg-yellow-600 text-white">
                <HiStar className="size-4" />
                <span className="font-fa-display">
                  {digitsEnToFa(addCommas(rewardProgram.required_score))}
                </span>
              </div>
            </div>
          </div>
          <SharedCardProperties
            categories={rewardProgram.categories}
            targetGroups={rewardProgram.target_groups}
          />
        </>
      }
    />
  );
}
