import { PageProps } from '@/@types';
import NewsCard from '@/shared/cards/NewsCard';
import DesktopSortBy from '@/shared/filtering/DesktopSortBy';
import MobileSortBy from '@/shared/filtering/MobileSortBy';
import Head from '@/shared/Head';
import FilterModal from '@/shared/modals/FilterModal';
import NoRecords from '@/shared/NoRecords';
import Pagination from '@/shared/Pagination';
import Search from '@/shared/Search';
import { PaginatedCollection } from '@/types';
import { usePage } from '@inertiajs/react';
import { HiOutlineSparkles, HiOutlineStar } from 'react-icons/hi2';

type TPage = PageProps<{
  news: PaginatedCollection<App.Data.News.NewsData>;
  categories: App.Data.Category.CategoryData[];
  target_groups: App.Data.TargetGroup.TargetGroupData[];
}>;

const sorts = [
  { label: 'جدیدترین', value: '-created_at' },
  { label: 'قدیمی ترین', value: 'created_at' },
];

export default function Index() {
  const { news, categories, target_groups, active_target_group_id } = usePage<TPage>().props;
  const url = usePage().url;

  return (
    <div className="space-y container">
      <Head canonicalUrl={route('news.index')} title="اخبار" description="اخبار" />
      <div className="flex items-center gap-2 pt-4">
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
        {!active_target_group_id && (
          <FilterModal
            ButtonIcon={HiOutlineStar}
            filterId="target_groups_id"
            options={target_groups.map((group) => ({
              label: group.title,
              value: group.id.toString(),
            }))}
            title="گروه های هدف"
            modalTitle="فیلتر بر اساس گروه های هدف"
          />
        )}
      </div>
      <div className="flex flex-col gap-2 md:flex-row md:items-center md:justify-between lg:flex-col lg:items-start lg:justify-normal">
        <h1 className="h1 text-base-content">اخبار</h1>
        <div className="flex items-center justify-between gap-4 lg:w-full">
          <DesktopSortBy options={sorts} />
          <Search key={url} />
        </div>
      </div>
      {news.meta.total < 1 && <NoRecords />}
      <div className="content-grid-container">
        {news.data.map((data) => (
          <NewsCard key={data.id} news={data} />
        ))}
      </div>
      <Pagination data={news} />
    </div>
  );
}
