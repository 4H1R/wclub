import { PageProps } from '@/@types';
import ContestCard from '@/shared/cards/ContestCard';
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
  contests: PaginatedCollection<App.Data.Contest.ContestData>;
  categories: App.Data.Category.CategoryData[];
}>;

const sorts = [
  { label: 'جدیدترین', value: '-created_at' },
  { label: 'تعداد کم', value: 'max_participants' },
  { label: 'تعداد بالا', value: '-max_participants' },
  { label: 'قدیمی ترین', value: 'created_at' },
];

export default function Index() {
  const { contests, categories } = usePage<TPage>().props;
  const url = usePage().url;

  return (
    <div className="space-y container">
      <Head
        canonicalUrl={route('contests.index')}
        title="جالش ها و مسابفات"
        description="جالش ها و مسابفات"
      />
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
        <h1 className="h1 text-base-content">چالش ها و مسابقات</h1>
        <div className="flex items-center justify-between gap-4 lg:w-full">
          <DesktopSortBy options={sorts} />
          <Search key={url} />
        </div>
      </div>
      {contests.meta.total < 1 && <NoRecords />}
      <div className="content-grid-container">
        {contests.data.map((contest) => (
          <ContestCard key={contest.id} contest={contest} />
        ))}
      </div>
      <Pagination data={contests} />
    </div>
  );
}
