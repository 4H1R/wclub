import { PageProps } from '@/@types';
import EpisodePagination from '@/components/series/episodes/show/EpisodePagination';
import EpisodeStats from '@/components/series/episodes/show/EpisodeStats';
import Video from '@/components/series/episodes/show/Video';
import ChaptersCard from '@/components/series/show/ChaptersCard';
import Description from '@/components/series/show/Description';
import SideStatsCard from '@/components/series/show/SideStatsCard';
import BreadCrumb from '@/shared/BreadCrumb';
import Head from '@/shared/Head';
import { slugifyId } from '@/utils';
import { usePage } from '@inertiajs/react';
import { GoDotFill } from 'react-icons/go';

type TPage = PageProps<{
  series: App.Data.Series.SeriesFullData;
  current_episode: App.Data.SeriesEpisode.SeriesEpisodeFullData;
}>;

export default function Show() {
  const { series, current_episode } = usePage<TPage>().props;
  const seriesSlug = slugifyId(series.id, series.title);
  const currentSeriesLink = route('series.show', [seriesSlug]);
  const totalEpisodes = series.chapters.reduce((prev, curr) => {
    prev += curr.episodes.length;
    return prev;
  }, 0);
  const isFirstEpisode = current_episode.episode_number <= 1;
  const isLastEpisode = current_episode.episode_number >= totalEpisodes;

  return (
    <div className="space-y mt-page container">
      <Head
        canonicalUrl={route('series.episodes.show', [seriesSlug, current_episode.episode_number])}
        title={current_episode.title}
        description={current_episode.title}
        titleSuffix={null}
        imageUrl={series.image?.original_url}
      />
      <BreadCrumb
        links={[
          { title: 'دوره ها', href: route('series.index') },
          { title: series.title, href: currentSeriesLink },
          { title: `قسمت ${current_episode.episode_number}`, href: '#' },
        ]}
      />
      <div className="card card-compact bg-base-200 md:card-normal">
        <div className="card-body gap-4">
          <div className="flex flex-wrap items-center justify-between gap-4">
            <h1 className="h2 text-center md:text-start">{current_episode.title}</h1>
          </div>
          <Video
            watchProgress={null}
            isLastEpisode={isLastEpisode}
            seriesSlug={seriesSlug}
            series={series}
            image={series.image}
            episode={current_episode}
          />
        </div>
      </div>
      <div className="side-grid-container">
        <div className="space-y-4 xl:col-span-7">
          <EpisodePagination
            isFirstEpisode={isFirstEpisode}
            isLastEpisode={isLastEpisode}
            currentEpisodeNumber={current_episode.episode_number}
            currentSeriesSlug={seriesSlug}
          />
          <EpisodeStats currentEpisode={current_episode} />
          {current_episode.description && (
            <div className="card card-compact bg-base-200 md:card-normal">
              <div className="card-body">
                <div className="flex items-center justify-center gap-2 md:justify-start">
                  <GoDotFill className="hidden size-4 md:block" />
                  <h2 className="h2 text-base-content md:text-start">توضیحات</h2>
                </div>
                <Description description={current_episode.description} />
              </div>
            </div>
          )}
          <ChaptersCard activeEpisodeId={current_episode.id} series={series} />
        </div>
        <div className="space-y-4 xl:col-span-3">
          <SideStatsCard series={series} />
        </div>
      </div>
    </div>
  );
}
