import { cn, slugifyId } from '@/utils';
import { Link } from '@inertiajs/react';
import Image from '../images/Image';

type ContestCardProps = {
  contest: App.Data.Contest.ContestData;
  hasWidth?: boolean;
  className?: string;
};

export default function ContestCard({ contest, hasWidth = false, className }: ContestCardProps) {
  const href = route('contests.show', [slugifyId(contest.id, contest.title)]);

  return (
    <div className={cn('card h-full bg-base-100 shadow', { 'w-[20rem]': hasWidth }, className)}>
      <Link href={href}>
        <figure className="h-44 w-full bg-base-200 lg:h-56">
          {contest.image && (
            <Image className="size-full" src={contest.image?.original_url} alt={contest.title} />
          )}
        </figure>
      </Link>
      <div className="card-body h-full">
        <h2 className="card-title">{contest.title}</h2>
        {contest.short_description && (
          <p className="line-clamp-4 max-h-fit text-sm text-base-content/80">
            {contest.short_description}
          </p>
        )}
        {contest.categories.length > 0 && (
          <div className="flex flex-wrap items-center gap-1 pb-6 pt-2">
            {contest.categories.map((category) => (
              <span key={category.id} className="badge badge-md bg-base-200">
                {category.title}
              </span>
            ))}
          </div>
        )}
        <Link className="btn mt-auto" href={href}>
          <span>اطلاعات بیشتر</span>
        </Link>
      </div>
    </div>
  );
}
