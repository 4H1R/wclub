import NewsCard from '@/shared/cards/NewsCard';
import SwiperContainer from '@/shared/swiper/SwiperContainer';
import SwiperSlide from '@/shared/swiper/SwiperSlide';
import SectionContainer from './SectionContainer';

type LatestNewsProps = {
  news: App.Data.News.NewsData[];
};

export default function LatestNews({ news }: LatestNewsProps) {
  if (news.length < 1) return null;

  return (
    <SectionContainer title="اخبار" href={route('news.index')}>
      <SwiperContainer options={{ spaceBetween: 16, slidesPerView: 'auto' }} id="latestNews">
        {news.map((data) => (
          <SwiperSlide className="!size-auto" key={data.id}>
            <NewsCard hasWidth news={data} />
          </SwiperSlide>
        ))}
      </SwiperContainer>
    </SectionContainer>
  );
}
