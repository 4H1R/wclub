import { PageProps } from '@/@types';
import ContestCard from '@/shared/cards/ContestCard';
import EventProgramCard from '@/shared/cards/EventProgramCard';
import RewardProgramCard from '@/shared/cards/RewardProgramCard';
import SeriesCard from '@/shared/cards/SeriesCard';
import NoRecords from '@/shared/NoRecords';
import SwiperContainer from '@/shared/swiper/SwiperContainer';
import SwiperSlide from '@/shared/swiper/SwiperSlide';
import { usePage } from '@inertiajs/react';
import { GoDotFill } from 'react-icons/go';

type TPage = PageProps<{
  event_programs: App.Data.EventProgram.EventProgramData[];
  reward_programs: App.Data.RewardProgram.RewardProgramData[];
  contests: App.Data.Contest.ContestData[];
  series: App.Data.Series.SeriesData[];
}>;

const searchList = [
  {
    name: 'event_programs',
    title: 'رویداد ها',
    Card: EventProgramCard,
    cardDataName: 'eventProgram',
  },
  {
    name: 'reward_programs',
    title: 'خدمات',
    Card: RewardProgramCard,
    cardDataName: 'rewardProgram',
  },
  {
    name: 'contests',
    title: 'چالش و مسابقات',
    Card: ContestCard,
    cardDataName: 'contest',
  },
  {
    name: 'series',
    title: 'دوره ها',
    Card: SeriesCard,
    cardDataName: 'series',
  },
] as const;

export default function SearchResults() {
  const pageProps = usePage<TPage>().props;
  const finalSearchList = searchList.filter((search) => pageProps[search.name].length > 0);

  return (
    <>
      {finalSearchList.length < 1 && <NoRecords />}
      {finalSearchList.map((search) => (
        <div key={search.name} className="space-y-4">
          <div className="flex items-center gap-2 text-base-content/80">
            <GoDotFill className="size-3" />
            <h2 className="h2">{search.title}</h2>
          </div>
          <SwiperContainer
            className="first:pr-1 last:pl-1"
            options={{ spaceBetween: 16, slidesPerView: 'auto' }}
            id={search.name}
          >
            {pageProps[search.name].map((data) => (
              <SwiperSlide className="!size-auto py-2" key={data.id}>
                {/* @ts-expect-error we know it has the cardDataName property */}
                <search.Card {...{ [search.cardDataName]: data, hasWidth: true }} />
              </SwiperSlide>
            ))}
          </SwiperContainer>
        </div>
      ))}
    </>
  );
}
