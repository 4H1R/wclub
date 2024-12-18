import { cn, slugifyId } from '@/utils';
import { Link } from '@inertiajs/react';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import { HiStar } from 'react-icons/hi2';
import Image from '../images/Image';

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
    <div className={cn('card h-full bg-base-100 shadow', { 'w-[20rem]': hasWidth })}>
      <Link href={href}>
        <figure className="h-44 w-full bg-base-200 lg:h-56">
          {rewardProgram.image && (
            <Image
              className="size-full"
              src={rewardProgram.image?.original_url}
              alt={rewardProgram.title}
            />
          )}
        </figure>
      </Link>
      <div className="card-body h-full">
        <h2 className="card-title">{rewardProgram.title}</h2>
        {rewardProgram.short_description && (
          <p className="max-h-fit text-sm text-base-content/80">
            {rewardProgram.short_description}
          </p>
        )}
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
          {rewardProgram.categories.map((category) => (
            <span key={category.id} className="badge badge-md bg-base-200">
              {category.title}
            </span>
          ))}
        </div>
        <Link className="btn mt-auto" href={href}>
          اطلاعات بیشتر
        </Link>
      </div>
    </div>
  );
}
