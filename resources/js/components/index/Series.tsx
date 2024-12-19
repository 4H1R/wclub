import SeriesCard from '@/shared/cards/SeriesCard';
import SwiperContainer from '@/shared/swiper/SwiperContainer';
import SwiperSlide from '@/shared/swiper/SwiperSlide';
import SectionContainer from './SectionContainer';

type SeriesProps = {
  series: App.Data.Series.SeriesData[];
};

export default function Series({ series }: SeriesProps) {
  if (series.length < 1) return null;

  return (
    <SectionContainer title="دوره ها" href={route('series.index')}>
      <div className="rounded-r-box bg-primary/60 py-6 md:rounded-box md:px-4">
        <SwiperContainer options={{ spaceBetween: 16, slidesPerView: 'auto' }} id="series">
          {series.map((data) => (
            <SwiperSlide className="!size-auto" key={data.id}>
              <SeriesCard hasWidth series={data} />
            </SwiperSlide>
          ))}
        </SwiperContainer>
      </div>
    </SectionContainer>
  );
}
