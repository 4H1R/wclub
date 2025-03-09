import { PageProps } from '@/@types';
import Banners from '@/components/index/Banners';
import LatestContests from '@/components/index/LatestContests';
import LatestEventPrograms from '@/components/index/LatestEventPrograms';
import LatestNews from '@/components/index/LatestNews';
import RewardPrograms from '@/components/index/RewardPrograms';
import Series from '@/components/index/Series';
import TargetGroups from '@/components/index/TargetGroups';
import config from '@/fixtures/config';
import Head from '@/shared/Head';
import { usePage } from '@inertiajs/react';

type TPage = PageProps<{
  target_groups: App.Data.TargetGroup.TargetGroupData[];
  banners: App.Data.Banner.BannerData[];
  event_programs: App.Data.EventProgram.EventProgramData[];
  reward_programs: App.Data.RewardProgram.RewardProgramData[];
  contests: App.Data.Contest.ContestData[];
  series: App.Data.Series.SeriesData[];
  news: App.Data.News.NewsData[];
}>;

export default function Index() {
  const { contests, reward_programs, news, series, event_programs, target_groups, banners } =
    usePage<TPage>().props;

  return (
    <div className="mt-page space-y container">
      <Head title={config.websiteTitle} description={config.websiteTitle} titleSuffix={null} />
      <Banners banners={banners} />
      <section className="card bg-gradient-to-b from-primary/40 to-secondary/40">
        <div className="card-body md:gap-8">
          <div className="space-y-4 text-center">
            <h1 className="text-4xl font-black leading-tight">
              با کمک باشگاه بانوان اصفهان از خدمات و امتیازات فراوان استفاده کن
            </h1>
            <p className="text-lg text-base-content/80">
              باشگاه بانوان برای بانوان از کودک تا بزرگسال توسط شهرداری اصفهان تدارک دیده شده که
              بیشترین استفاده را از شهر زیبای اصفهان ببرند.
            </p>
          </div>
          <TargetGroups targetGroups={target_groups} />
        </div>
      </section>
      <LatestNews news={news} />
      <LatestEventPrograms eventPrograms={event_programs} />
      <LatestContests contests={contests} />
      <RewardPrograms rewardPrograms={reward_programs} />
      <Series series={series} />
    </div>
  );
}
