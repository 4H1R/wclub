import { PageProps } from '@/@types';
import GardenCard from '@/shared/cards/GardenCard';
import DesktopSortBy from '@/shared/filtering/DesktopSortBy';
import MobileSortBy from '@/shared/filtering/MobileSortBy';
import Head from '@/shared/Head';
import NoRecords from '@/shared/NoRecords';
import Pagination from '@/shared/Pagination';
import Search from '@/shared/Search';
import { PaginatedCollection } from '@/types';
import { usePage } from '@inertiajs/react';

type TPage = PageProps<{
  gardens: PaginatedCollection<App.Data.Garden.GardenData>;
}>;

const sorts = [
  { label: 'جدیدترین', value: '-created_at' },
  { label: 'تعداد کم', value: 'max_participants' },
  { label: 'تعداد بالا', value: '-max_participants' },
  { label: 'قدیمی ترین', value: 'created_at' },
];

export default function Index() {
  const { gardens } = usePage<TPage>().props;
  const url = usePage().url;

  return (
    <div className="space-y container">
      <Head title="باغ های بانوان" description="باغ های بانوان" />
      <div className="flex items-center gap-2 overflow-x-auto pt-4">
        <MobileSortBy options={sorts} />
      </div>
      <div className="flex flex-col gap-2 md:flex-row md:items-center md:justify-between lg:flex-col lg:items-start lg:justify-normal">
        <h1 className="h1 text-base-content">باغ های بانوان</h1>
        <div className="flex items-center justify-between gap-4 lg:w-full">
          <DesktopSortBy options={sorts} />
          <Search key={url} />
        </div>
      </div>
      {gardens.meta.total < 1 && <NoRecords />}
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        {gardens.data.map((garden) => (
          <GardenCard key={garden.id} garden={garden} />
        ))}
      </div>
      <Pagination data={gardens} />
    </div>
  );
}
