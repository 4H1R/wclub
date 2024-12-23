import { THasChildren } from '@/types';
import { cn } from '@/utils';
import { useEffect, useMemo, useRef, useState } from 'react';
import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import { Navigation, Pagination } from 'swiper/modules';
import { SwiperOptions } from 'swiper/types';

type SwiperContainerProps = THasChildren & {
  id: string;
  options?: SwiperOptions;
  className?: string;
  hasPagination?: boolean;
};

export default function SwiperContainer({
  id,
  children,
  className,
  options,
  hasPagination = false,
}: SwiperContainerProps) {
  const swiperRef = useRef<HTMLDivElement>(null);
  const [swiperInstance, setSwiperInstance] = useState<Swiper | null>(null);
  const finalId = `swiper-${id}`;

  const finalOptions: SwiperOptions = useMemo(() => {
    return {
      modules: [Navigation, Pagination],
      slidesPerView: 1,
      spaceBetween: 0,
      pagination: {
        el: `.${finalId} .swiper-pagination`,
        clickable: true,
        enabled: hasPagination,
      },
      loop: false,
      navigation: {
        nextEl: `.${finalId} .swiper-button-next`,
        prevEl: `.${finalId} .swiper-button-prev`,
        enabled: false,
      },
      ...options,
    };
  }, [finalId, options, hasPagination]);

  useEffect(() => {
    if (swiperRef.current) {
      const swiper = new Swiper(swiperRef.current, finalOptions);
      setSwiperInstance(swiper);

      return () => {
        swiper.destroy(true, true);
      };
    }
  }, [finalOptions]);

  useEffect(() => {
    if (swiperInstance) swiperInstance.update();
  }, [swiperInstance]);

  return (
    <>
      <div
        ref={swiperRef}
        className={cn(finalId, 'swiper', { '!pb-10': hasPagination }, className)}
      >
        <div className="swiper-wrapper">{children}</div>
        <div className="swiper-pagination" />
        {/*<div className="swiper-button-prev" />*/}
        {/*<div className="swiper-button-next" />*/}
        <div className="swiper-scrollbar" />
      </div>
    </>
  );
}
