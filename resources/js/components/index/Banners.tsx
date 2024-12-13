import Image from '@/shared/images/Image';
import SwiperContainer from '@/shared/swiper/SwiperContainer';
import SwiperSlide from '@/shared/swiper/SwiperSlide';
import { Link } from '@inertiajs/react';

type BannersProps = {
  banners: App.Data.Banner.BannerData[];
};

export default function Banners({ banners }: BannersProps) {
  if (banners.length < 1) return null;

  return (
    <SwiperContainer
      hasPagination={banners.length > 1}
      id="banners"
      className="h-[15rem] w-full rounded-box sm:h-[20rem] md:h-[25rem] lg:h-[30rem]"
    >
      {banners.map((banner) => (
        <SwiperSlide className="relative" key={banner.id}>
          <Link className="size-full" href={banner.link}>
            <Image
              src="/images/banner.png"
              className="size-full rounded-box object-cover"
              alt={banner.title}
            />
          </Link>
        </SwiperSlide>
      ))}
    </SwiperContainer>
  );
}
