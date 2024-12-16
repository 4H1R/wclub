import RewardProgramCard from '@/shared/cards/RewardProgramCard';
import SwiperContainer from '@/shared/swiper/SwiperContainer';
import SwiperSlide from '@/shared/swiper/SwiperSlide';
import SectionContainer from './SectionContainer';

type RewardProgramsProps = {
  rewardPrograms: App.Data.RewardProgram.RewardProgramData[];
};

export default function RewardPrograms({ rewardPrograms }: RewardProgramsProps) {
  if (rewardPrograms.length < 1) return null;

  return (
    <SectionContainer title="خدمات" href={route('reward-programs.index')}>
      <SwiperContainer options={{ spaceBetween: 16, slidesPerView: 'auto' }} id="rewardPrograms">
        {rewardPrograms.map((rewardProgram) => (
          <SwiperSlide className="!size-auto" key={rewardProgram.id}>
            <RewardProgramCard hasWidth rewardProgram={rewardProgram} />
          </SwiperSlide>
        ))}
      </SwiperContainer>
    </SectionContainer>
  );
}
