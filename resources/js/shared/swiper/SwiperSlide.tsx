import { THasChildren } from '@/types';
import { cn } from '@/utils';

type SwiperSlideProps = THasChildren & {
  className?: string;
};

export default function SwiperSlide({ children, className }: SwiperSlideProps) {
  // py-[1px] is for fixing the padding issue
  return <div className={cn('swiper-slide py-[1px]', className)}>{children}</div>;
}
