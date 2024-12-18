import { cn, convertSecondsToTime, slugifyId } from '@/utils';
import { Link } from '@inertiajs/react';
import { digitsEnToFa, numberToWords } from '@persian-tools/persian-tools';
import { GoDotFill } from 'react-icons/go';
import { HiClock, HiLockClosed, HiOutlineEye, HiOutlineLockClosed } from 'react-icons/hi2';

type ChaptersCardProps = {
  series: App.Data.Series.SeriesFullData;
  activeEpisodeId?: number;
};

export default function ChaptersCard({ series, activeEpisodeId }: ChaptersCardProps) {
  const episodes = series.chapters.flatMap((chapter) => chapter.episodes);

  return (
    <div id="chapters" className="card card-compact bg-base-200 md:card-normal">
      <div className="card-body gap-4">
        <div className="flex items-center justify-center gap-2 md:justify-start">
          <GoDotFill className="hidden size-4 md:block" />
          <h2 className="h2 text-base-content md:text-start">جلسات دوره</h2>
        </div>
        {series.chapters.map((chapter, i) => {
          const isOpenByDefault = Boolean(
            activeEpisodeId && chapter.episodes.some((episode) => episode.id === activeEpisodeId),
          );

          return (
            <div
              key={chapter.id}
              className="collapse collapse-arrow border border-base-300 bg-base-300"
            >
              <input defaultChecked={isOpenByDefault} type="checkbox" className="peer" />
              <div className="collapse-title flex text-xl font-medium">
                <span>فصل {numberToWords(i + 1, { ordinal: true }) as string}</span>
                <div className="divider divider-horizontal" />
                <span>{chapter.title}</span>
              </div>
              <div className="collapse-content space-y-4">
                {chapter.episodes.map((episode) => {
                  const episodeIndex = episodes.findIndex((e) => episode.id === e.id) + 1;
                  const hasAccess = series.is_owned;
                  const Icon = hasAccess ? HiOutlineEye : HiOutlineLockClosed;
                  const isActive = episode.id === activeEpisodeId;
                  const watchProgress = null;
                  const episodeLink = route('series.episodes.show', [
                    slugifyId(series.id, series.title),
                    episodeIndex,
                  ]);
                  const watchProgressValue = 0;

                  return (
                    <div
                      key={episode.id}
                      className={cn('card card-compact bg-base-200', {
                        'bg-base-200/50': episodeIndex === 1,
                        'bg-gradient-to-r from-secondary/40 to-primary/40': isActive,
                      })}
                    >
                      <div className="card-body flex-row flex-wrap items-center justify-between gap-4">
                        <div className="flex items-center lg:w-2/4">
                          <div
                            className={cn('min-w-10 bg-secondary/20', {
                              'radial-progress items-center text-primary': Boolean(watchProgress),
                              'flex size-10 items-center justify-center rounded-full p-1':
                                !watchProgressValue,
                              'bg-primary/40': Boolean(watchProgress),
                            })}
                            // eslint-disable-next-line @typescript-eslint/no-explicit-any
                            style={{ '--value': watchProgressValue, '--size': '2.6rem' } as any}
                          >
                            <span className="font-fa-display text-2xl text-base-content">
                              {hasAccess ? (
                                digitsEnToFa(episodeIndex)
                              ) : (
                                <HiLockClosed className="size-6" />
                              )}
                            </span>
                          </div>
                          <div className="divider divider-horizontal" />
                          <Link href={episodeLink} className="font-bold hover:text-primary">
                            {episode.title}
                          </Link>
                        </div>
                        {!isActive && (
                          <>
                            <div className="flex items-center gap-2">
                              <span className="text-sm">
                                {digitsEnToFa(
                                  convertSecondsToTime(episode.video_duration_seconds, true),
                                )}
                              </span>
                              <HiClock className="size-4" />
                            </div>
                            <Link className="btn btn-neutral btn-xs" href={episodeLink}>
                              <span>مشاهده</span>
                              <Icon className="size-4" />
                            </Link>
                          </>
                        )}
                      </div>
                    </div>
                  );
                })}
              </div>
            </div>
          );
        })}
      </div>
    </div>
  );
}
