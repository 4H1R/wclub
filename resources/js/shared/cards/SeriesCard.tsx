import SharedCardProperties from '@/components/cards/SharedCardProperties';
import { seriesStatusTranslation } from '@/enums';
import { cn, convertSecondsToTime, slugifyId } from '@/utils';
import { digitsEnToFa } from '@persian-tools/persian-tools';
import { GoDotFill } from 'react-icons/go';
import Price from '../Price';
import BaseCard from './BaseCard';

type SeriesCardProps = {
  series: App.Data.Series.SeriesData;
  hasWidth?: boolean;
};

export default function SeriesCard({ series, hasWidth = false }: SeriesCardProps) {
  const href = route('series.show', [slugifyId(series.id, series.title)]);

  return (
    <BaseCard
      data={series}
      href={href}
      hasWidth={hasWidth}
      bodyStartChildren={
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
      }
      bodyEndChildren={
        <>
          <SharedCardProperties
            targetGroups={series.target_groups}
            categories={series.categories}
          />
          <div className="mt-4 flex items-center justify-between gap-2">
            <span className="badge rounded-none bg-base-200 text-base-content/80">
              {digitsEnToFa(convertSecondsToTime(series.episodes_duration_seconds))}
            </span>
            <Price price={series.price} previousPrice={series.previous_price} />
          </div>
        </>
      }
    />
  );
}
