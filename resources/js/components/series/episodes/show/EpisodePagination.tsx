import Button from '@/shared/forms/Button';
import { router } from '@inertiajs/react';
import { HiChevronLeft, HiChevronRight } from 'react-icons/hi2';

type EpisodePaginationProps = {
  isFirstEpisode: boolean;
  isLastEpisode: boolean;
  currentEpisodeNumber: number;
  currentSeriesSlug: string;
};

export default function EpisodePagination({
  isFirstEpisode,
  isLastEpisode,
  currentEpisodeNumber,
  currentSeriesSlug,
}: EpisodePaginationProps) {
  const handlePaginate = (type: 'next' | 'prev') => {
    router.get(
      route('series.episodes.show', [
        currentSeriesSlug,
        currentEpisodeNumber + (type === 'next' ? 1 : -1),
      ]),
    );
  };

  return (
    <div className="grid grid-cols-2 gap-4">
      <Button onClick={() => handlePaginate('next')} disabled={isLastEpisode} className="btn">
        <HiChevronRight strokeWidth={1} className="size-6" />
      </Button>
      <Button onClick={() => handlePaginate('prev')} disabled={isFirstEpisode} className="btn">
        <HiChevronLeft strokeWidth={1} className="size-6" />
      </Button>
    </div>
  );
}
