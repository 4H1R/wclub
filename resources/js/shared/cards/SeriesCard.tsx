import SharedCardProperties from '@/components/cards/SharedCardProperties';
import { seriesStatusTranslation } from '@/enums';
import { cn, convertSecondsToTime, slugifyId } from '@/utils';
import { Link } from '@inertiajs/react';
import { digitsEnToFa } from '@persian-tools/persian-tools';
import { GoDotFill } from 'react-icons/go';
import Image from '../images/Image';
import Price from '../Price';

type SeriesCardProps = {
  series: App.Data.Series.SeriesData;
  hasWidth?: boolean;
  className?: string;
};

export default function SeriesCard({ series, hasWidth = false, className }: SeriesCardProps) {
  const href = route('series.show', [slugifyId(series.id, series.title)]);

  return (
    <div className={cn('card h-full bg-base-100 shadow', { 'w-[22rem]': hasWidth }, className)}>
      <Link href={href}>
        <figure className="h-44 w-full bg-base-200 lg:h-56">
          {series.image && (
            <Image className="size-full" src={series.image?.original_url} alt={series.title} />
          )}
        </figure>
      </Link>
      <div className="card-body h-full">
        <div
          className={cn('flex items-center gap-1', {
            'text-base-content/80':
              series.status === ('IN_PROGRESS' satisfies App.Enums.Series.SeriesStatusEnum),
            'text-secondary-solo':
              series.status === ('FINISHED' satisfies App.Enums.Series.SeriesStatusEnum),
          })}
        >
          <GoDotFill className="size-2" />
          <span className="text-xs font-bold">{seriesStatusTranslation[series.status]}</span>
        </div>
        <h2 className="card-title">{series.title}</h2>
        <p className="line-clamp-4 max-h-fit text-sm text-base-content/80">
          {series.short_description}
        </p>
        <SharedCardProperties targetGroups={series.target_groups} categories={series.categories} />
        <div className="mt-4 flex items-center justify-between gap-2">
          <span className="badge rounded-none bg-base-200 text-base-content/80">
            {digitsEnToFa(convertSecondsToTime(series.episodes_duration_seconds))}
          </span>
          <Price price={series.price} previousPrice={series.previous_price} />
        </div>
      </div>
    </div>
  );
}
