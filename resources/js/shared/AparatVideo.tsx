import { cn } from '@/utils';

type AparatVideoProps = {
  videohash: string;
  className?: string;
};

export default function AparatVideo({ videohash, className }: AparatVideoProps) {
  return (
    <div
      className={cn(
        'flex w-full items-center justify-center overflow-hidden rounded-box bg-base-200',
        className,
      )}
    >
      <div className="relative aspect-video w-full">
        <iframe
          className="absolute left-0 top-0 h-full w-full border-none"
          src={`https://www.aparat.com/video/video/embed/videohash/${videohash}/vt/frame`}
          allowFullScreen={true}
          title="Aparat Video"
        />
      </div>
    </div>
  );
}
