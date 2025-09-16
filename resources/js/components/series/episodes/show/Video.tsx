import VideoJS from '@/shared/VideoJs';
import Button from '@/shared/forms/Button';
import { TIcon } from '@/types';
import { cn } from '@/utils';
import { router, usePage } from '@inertiajs/react';
import { HiFilm, HiHandRaised, HiUser } from 'react-icons/hi2';
import { toast } from 'react-toastify';

type VideoMessageProps = {
  title: string;
  Icon: TIcon;
  action?: { text: string; onClick: () => void };
  image?: App.Data.Media.ImageData | null;
};

function VideoMessage({ title, Icon, action, image }: VideoMessageProps) {
  return (
    <div className="relative flex h-[60svh] flex-col items-center justify-center gap-4 rounded-box bg-base-300">
      <div
        className="absolute hidden h-full w-full rounded-box blur-sm md:block"
        style={{
          background: image ? `url(${image?.original_url})` : undefined,
          backgroundSize: 'cover',
          backgroundPosition: 'center',
        }}
      />
      <div className={cn('card z-[1] bg-none', { 'md:bg-base-200/80': Boolean(image) })}>
        <div className="card-body items-center justify-center gap-4">
          <div className="rounded-full bg-neutral p-2">
            <Icon className="size-8 text-neutral-content" />
          </div>
          <h2 className="h2 text-center text-base-content">{title}</h2>
          {action && (
            <Button className="btn btn-neutral" onClick={action.onClick}>
              {action.text}
            </Button>
          )}
        </div>
      </div>
    </div>
  );
}

type VideoProps = {
  series: App.Data.Series.SeriesFullData;
  episode: App.Data.SeriesEpisode.SeriesEpisodeFullData;
  image: App.Data.Media.ImageData | null;
  watchProgress: null;
  isLastEpisode: boolean;
  seriesSlug: string;
};

export default function Video({ series, episode, image, seriesSlug }: VideoProps) {
  const { auth } = usePage().props;

  const getStartTime = () => {
    return undefined;
  };

  if (!auth.user && series.payment_type !== 'FREE') {
    return (
      <VideoMessage
        image={image}
        action={{ text: 'حساب کاربری', onClick: () => router.get(route('auth')) }}
        Icon={HiUser}
        title="لطفا به حساب کاربری خود وارد شوید."
      />
    );
  }

  if (!episode.video) {
    return <VideoMessage Icon={HiFilm} title="این قسمت هیچ ویدیویی برای پخش ندارد." />;
  }

  if (!episode.video?.url) {
    return (
      <VideoMessage
        image={image}
        action={{
          text: 'افزودن به دوره های خود',
          onClick: () => {
            router.post(route('series.owns.store', seriesSlug), undefined, {
              onSuccess: () => {
                toast.success('این دوره به دوره های شما اضافه شد.');
              },
            });
          },
        }}
        Icon={HiHandRaised}
        title="شما به این قسمت دسترسی ندارید."
      />
    );
  }

  return (
    <VideoJS
      startTime={getStartTime()}
      options={{
        autoplay: false,
        playbackRates: [0.5, 1, 1.5, 2],
        controls: true,
        responsive: true,
        fluid: true,
        sources: [
          {
            src: episode.video.url,
            type: episode.video.mime_type,
          },
        ],
      }}
    />
  );
}
