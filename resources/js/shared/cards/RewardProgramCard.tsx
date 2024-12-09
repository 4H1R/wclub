import { cn, slugifyId } from '@/utils';
import { Link } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import { useEffect, useState } from 'react';
import { HiStar } from 'react-icons/hi2';

type RewardProgramCardProps = {
  rewardProgram: App.Data.RewardProgram.RewardProgramData;
  showScoreTooltipForCoupleOfSeconds?: boolean;
};

export default function RewardProgramCard({
  rewardProgram,
  showScoreTooltipForCoupleOfSeconds = false,
}: RewardProgramCardProps) {
  const [showTooltip, setShowTooltip] = useState(showScoreTooltipForCoupleOfSeconds);
  const href = route('reward-programs.show', [slugifyId(rewardProgram.id, rewardProgram.title)]);

  useEffect(() => {
    if (!showTooltip) return;
    setTimeout(() => {
      setShowTooltip(false);
    }, 3_000);
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  return (
    <div key={rewardProgram.id} className="card h-full bg-base-100 shadow">
      <Link href={href}>
        <figure className="h-44 w-full bg-base-200"></figure>
      </Link>
      <div className="card-body">
        <h2 className="card-title">{rewardProgram.title}</h2>
        {rewardProgram.short_description && (
          <p className="text-sm">{rewardProgram.short_description}</p>
        )}

        <div className="flex flex-wrap items-center gap-2">
          {rewardProgram.categories.map((category) => (
            <span key={category.id} className="badge badge-md mt-2 bg-base-200">
              {category.title}
            </span>
          ))}
          <div
            className={cn('tooltip tooltip-top tooltip-info', {
              'tooltip-open animate-bounce': showTooltip,
            })}
            data-tip="امتیاز مورد نیاز"
          >
            <div className="badge badge-lg flex items-center justify-center gap-2 bg-base-200 text-yellow-600">
              <HiStar className="size-4" />
              <span className="font-fa-display">
                {digitsEnToFa(addCommas(rewardProgram.required_score))}
              </span>
            </div>
          </div>
        </div>
        <Link className="btn mt-4 md:mt-auto" href={href}>
          اطلاعات بیشتر
        </Link>
      </div>
    </div>
  );
}
