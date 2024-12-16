import ContestCard from '@/shared/cards/ContestCard';
import SwiperContainer from '@/shared/swiper/SwiperContainer';
import SwiperSlide from '@/shared/swiper/SwiperSlide';
import SectionContainer from './SectionContainer';

type LatestContestsProps = {
  contests: App.Data.Contest.ContestData[];
};

export default function LatestContests({ contests }: LatestContestsProps) {
  if (contests.length < 1) return null;

  return (
    <SectionContainer title="چالش ها و مسابقات" href={route('contests.index')}>
      <div className="rounded-r-box bg-secondary/60 py-6 md:rounded-box md:px-4">
        <SwiperContainer options={{ spaceBetween: 16, slidesPerView: 'auto' }} id="LatestContests">
          {contests.map((contest) => (
            <SwiperSlide className="!size-auto" key={contest.id}>
              <ContestCard hasWidth contest={contest} />
            </SwiperSlide>
          ))}
        </SwiperContainer>
      </div>
    </SectionContainer>
  );
}
