import SearchResults from '@/components/search/SearchResults';
import Head from '@/shared/Head';
import Search from '@/shared/Search';
import { usePage } from '@inertiajs/react';
import get from 'lodash/get';
import { useEffect } from 'react';
import { FaExclamation } from 'react-icons/fa6';

export default function Index() {
  const url = usePage().url;
  const query = get(route().queryParams, 'filter.query', '');

  useEffect(() => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }, []);

  return (
    <div className="space-y mt-page container">
      <Head title="جست و جو" description="جست و جو" />
      <div className="flex flex-wrap items-center justify-between gap-4">
        <h1 className="h1 text-base-content">جست و جو</h1>
        <Search key={url} />
      </div>
      {query ? (
        <SearchResults />
      ) : (
        <div className="card-bordered col-span-full flex h-44 flex-col items-center justify-center gap-4 rounded-box bg-base-100 px-2 text-center shadow">
          <div className="rounded-full bg-base-200 p-4">
            <FaExclamation className="size-6" />
          </div>
          <h3 className="text-xl font-bold">لطفا کلمه مورد نظر خود را جست و جو کنید</h3>
        </div>
      )}
    </div>
  );
}
