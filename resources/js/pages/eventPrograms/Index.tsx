import { PageProps } from '@/@types';
import EventProgramCard from '@/shared/cards/EventProgramCard';
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
  event_programs: PaginatedCollection<App.Data.EventProgram.EventProgramData>;
  categories: App.Data.Category.CategoryData[];
}>;

const sorts = [
  { label: 'جدیدترین', value: '-created_at' },
  { label: 'تعداد کم', value: 'max_participants' },
  { label: 'تعداد بالا', value: '-max_participants' },
  { label: 'قدیمی ترین', value: 'created_at' },
];

export default function Index() {
  const { event_programs, categories } = usePage<TPage>().props;
  const url = usePage().url;

  return (
    <div className="space-y container">
      <Head
        canonicalUrl={route('event-programs.index')}
        title="رویداد ها"
        description="رویداد ها"
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
        <h1 className="h1 text-base-content">رویداد ها</h1>
        <div className="flex items-center justify-between gap-4 lg:w-full">
          <DesktopSortBy options={sorts} />
          <Search key={url} />
        </div>
      </div>
      {event_programs.meta.total < 1 && <NoRecords />}
      <div className="content-grid-container">
        {event_programs.data.map((eventProgram) => (
          <EventProgramCard key={eventProgram.id} eventProgram={eventProgram} />
        ))}
      </div>
      <Pagination data={event_programs} />
    </div>
  );
}
