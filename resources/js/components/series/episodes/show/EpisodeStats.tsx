import { convertSecondsToTime, formatDatetime } from '@/utils';
import { digitsEnToFa, numberToWords } from '@persian-tools/persian-tools';
import { HiBookOpen, HiClock, HiFilm, HiMap } from 'react-icons/hi2';

type EpisodeStatsProps = {
  currentEpisode: App.Data.SeriesEpisode.SeriesEpisodeFullData;
};

export default function EpisodeStats({ currentEpisode }: EpisodeStatsProps) {
  const stats = [
    { Icon: HiFilm, title: 'قسمت', value: numberToWords(currentEpisode.episode_number) as string },
    {
      Icon: HiClock,
      title: 'مدت فیلم',
      value: digitsEnToFa(convertSecondsToTime(currentEpisode.video_duration_seconds)),
    },
    { Icon: HiBookOpen, title: 'فصل', value: 'فصل اول' },
    {
      Icon: HiMap,
      title: 'انتشار شده در',
      value: formatDatetime(currentEpisode.created_at),
    },
  ];

  return (
    <div className="card card-compact bg-base-200 md:card-normal">
      <div className="card-body">
        <ul className="grid grid-cols-2 gap-4 text-center lg:grid-cols-4">
          {stats.map((stat) => (
            <li key={stat.title} className="space-y-2 rounded-box bg-base-300 p-4">
              <stat.Icon className="mx-auto size-6 border-b" />
              <div className="divider m-0" />
              <p className="font-bold">{stat.title}</p>
              <p className="text-base-content/80">{stat.value}</p>
            </li>
          ))}
        </ul>
      </div>
    </div>
  );
}
