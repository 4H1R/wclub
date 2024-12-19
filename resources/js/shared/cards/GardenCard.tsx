import SwiperContainer from '@/shared/swiper/SwiperContainer';
import SwiperSlide from '@/shared/swiper/SwiperSlide';
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
    <div className={cn('card h-full bg-base-100 shadow', { 'w-[20rem]': hasWidth }, className)}>
      {garden.images.length < 1 && <figure className="min-h-44 w-full bg-base-200 lg:min-h-56" />}
      <SwiperContainer id={`gardenImages#${garden.id}`} options={{ slidesPerView: 'auto' }}>
        {garden.images.map((image) => (
          <SwiperSlide className="!size-auto" key={image.id}>
            <figure className="min-h-44 w-full lg:min-h-56">
              <Image className="size-full" src={image.original_url} alt={garden.title} />
            </figure>
          </SwiperSlide>
        ))}
      </SwiperContainer>
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
