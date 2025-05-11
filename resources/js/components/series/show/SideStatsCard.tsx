import { seriesStatusTranslation } from '@/enums';
import { convertSecondsToTime, formatDatetime } from '@/utils';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import {
  HiCalendarDateRange,
  HiClock,
  HiInboxStack,
  HiSignal,
  HiSquare3Stack3D,
  HiUsers,
} from 'react-icons/hi2';

type SideStatsCardProps = {
  series: App.Data.Series.SeriesFullData;
};

export default function SideStatsCard({ series }: SideStatsCardProps) {
  const stats = [
    {
      Icon: HiUsers,
      title: 'شرکت کنندگان',
      value: digitsEnToFa(addCommas(series.owned_users_count)),
    },
    {
      Icon: HiSignal,
      title: 'وضعیت',
      value: seriesStatusTranslation[series.status],
    },
    {
      Icon: HiSquare3Stack3D,
      title: 'تعداد جلسات',
      value: digitsEnToFa(addCommas(series.episodes_count)),
    },
    {
      Icon: HiInboxStack,
      title: 'تعداد فصل ها',
      value: digitsEnToFa(addCommas(series.chapters.length)),
    },
    {
      Icon: HiClock,
      title: 'مدت دوره',
      value: digitsEnToFa(convertSecondsToTime(series.episodes_duration_seconds)),
    },
    {
      Icon: HiCalendarDateRange,
      title: 'منتشر شده در',
      value: formatDatetime(series.published_at),
    },
  ];

  return (
    <ul className="grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3">
      {stats.map((stat) => (
        <li key={stat.title} className="card card-compact max-h-min bg-base-200 text-center">
          <div className="min-h-30 card-body items-center md:min-h-36">
            <stat.Icon className="size-8 text-base-content/90" />
            <span className="font-light text-base-content/80">{stat.title}</span>
            <span className="mt-auto font-bold">{stat.value}</span>
          </div>
        </li>
      ))}
    </ul>
  );
}
