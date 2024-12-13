import { THasChildren } from '@/types';
import { cn } from '@/utils';

type SwiperSlideProps = THasChildren & {
  className?: string;
};

export default function SwiperSlide({ children, className }: SwiperSlideProps) {
  return <div className={cn('swiper-slide', className)}>{children}</div>;
}
