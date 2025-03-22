import { cn, slugifyId } from '@/utils';
import { Link } from '@inertiajs/react';
import Image from '../images/Image';

type GardenCardProps = {
  garden: App.Data.Garden.GardenData;
  hasWidth?: boolean;
  className?: string;
};

export default function GardenCard({ garden, hasWidth = false, className }: GardenCardProps) {
  const href = route('gardens.show', [slugifyId(garden.id, garden.title)]);

  return (
    <div className={cn('card h-full bg-base-100 shadow', { 'w-[22rem]': hasWidth }, className)}>
      <Link href={href}>
        <figure className="h-44 w-full bg-base-200 lg:h-56">
          {garden.image && (
            <Image className="size-full" src={garden.image?.original_url} alt={garden.title} />
          )}
        </figure>
      </Link>
      <div className="card-body h-full">
        <h2 className="card-title">{garden.title}</h2>
        <p className="mb-4 line-clamp-4 max-h-fit text-sm text-base-content/80">{garden.address}</p>
        <Link className="btn mt-auto" href={href}>
          <span>اطلاعات بیشتر</span>
        </Link>
      </div>
    </div>
  );
}
