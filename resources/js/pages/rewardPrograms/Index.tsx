import { PageProps } from '@/@types';
import { useShowTooltip } from '@/hooks';
import RewardProgramCard from '@/shared/cards/RewardProgramCard';
import DesktopSortBy from '@/shared/filtering/DesktopSortBy';
import MobileSortBy from '@/shared/filtering/MobileSortBy';
import Head from '@/shared/Head';
import FilterModal from '@/shared/modals/FilterModal';
import NoRecords from '@/shared/NoRecords';
import Pagination from '@/shared/Pagination';
import Search from '@/shared/Search';
import { PaginatedCollection } from '@/types';
import { usePage } from '@inertiajs/react';
import { HiOutlineSparkles } from 'react-icons/hi2';

type TPage = PageProps<{
  reward_programs: PaginatedCollection<App.Data.RewardProgram.RewardProgramData>;
  categories: App.Data.Category.CategoryData[];
}>;

const sorts = [
  { label: 'پیشفرض', value: '' },
  { label: 'بیشترین امتیاز', value: '-required_score' },
  { label: 'کمترین امتیاز', value: 'required_score' },
  { label: 'جدیدترین', value: '-created_at' },
  { label: 'قدیمی ترین', value: 'created_at' },
];

export default function Index() {
  const { reward_programs, categories } = usePage<TPage>().props;
  const showTooltip = useShowTooltip();
  const url = usePage().url;

  return (
    <div className="space-y container">
      <Head title="خدمات" description="خدمات" />
      <div className="flex items-center gap-2 overflow-x-auto pt-4">
        <MobileSortBy options={sorts} />
        <FilterModal
          ButtonIcon={HiOutlineSparkles}
          filterId="categories_id"
          options={categories.map((category) => ({
            label: category.title,
            value: category.id.toString(),
          }))}
          title="دسته بندی ها"
          modalTitle="فیلتر بر اساس دسته بندی ها"
        />
      </div>
      <div className="flex flex-col gap-2 md:flex-row md:items-center md:justify-between lg:flex-col lg:items-start lg:justify-normal">
        <h1 className="h1 text-base-content">خدمات</h1>
        <div className="flex items-center justify-between gap-4 lg:w-full">
          <DesktopSortBy options={sorts} />
          <Search key={url} />
        </div>
      </div>
      {reward_programs.meta.total < 1 && <NoRecords />}
      <div className="content-grid-container">
        {reward_programs.data.map((rewardProgram, i) => (
          <RewardProgramCard
            showTooltip={showTooltip && i === 0}
            key={rewardProgram.id}
            rewardProgram={rewardProgram}
          />
        ))}
      </div>
      <Pagination data={reward_programs} />
    </div>
  );
}
