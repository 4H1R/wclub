import EventProgramCard from '@/shared/cards/EventProgramCard';
import SwiperContainer from '@/shared/swiper/SwiperContainer';
import SwiperSlide from '@/shared/swiper/SwiperSlide';
import SectionContainer from './SectionContainer';

type LatestEventProgramsProps = {
  eventPrograms: App.Data.EventProgram.EventProgramData[];
};

export default function LatestEventPrograms({ eventPrograms }: LatestEventProgramsProps) {
  return (
    <SectionContainer title="رویداد ها" href={route('event-programs.index')}>
      <SwiperContainer
        options={{ spaceBetween: 16, slidesPerView: 'auto' }}
        id="latestEventPrograms"
      >
        {eventPrograms.map((eventProgram) => (
          <SwiperSlide className="!size-auto" key={eventProgram.id}>
            <EventProgramCard hasWidth eventProgram={eventProgram} />
          </SwiperSlide>
        ))}
      </SwiperContainer>
    </SectionContainer>
  );
}
